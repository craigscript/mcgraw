<?php


function getFileMakerConnection()
{
	global $FM_CONNECTION, $FM_DATABASE, $FM_HOSTSPEC, $FM_USERNAME, $FM_PASSWORD;

	if (!isset($GLOBALS['FM_CONNECTION']) || !$FM_CONNECTION)
	{
		$FM_CONNECTION = new \FileMaker();
		$FM_CONNECTION->setProperty('database', $FM_DATABASE);
		$FM_CONNECTION->setProperty('hostspec', $FM_HOSTSPEC);
		$FM_CONNECTION->setProperty('username', $FM_USERNAME);
		$FM_CONNECTION->setProperty('password', $FM_PASSWORD);
		//echo "username: " . $FM_USERNAME . " password: " . $FM_PASSWORD . "<br/>";
	}

	return $FM_CONNECTION;
}

function mysqlConnection() {
    global $con;
    $con = mysql_connect('localhost', 'mcgraw_assets', 'Indormitable123$');
}

function throwExceptionOnFMError($obj)
{
	global $FM_CONNECTION;
	
	if ($FM_CONNECTION->isError($obj))
	{
		$backtrace = debug_backtrace();
		throw new \ErrorException($obj->getMessage() . "(code: {$obj->getCode()}, file: {$backtrace[0]['file']}, line: {$backtrace[0]['line']})");
	}
}

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects:  " . var_dump($output) . "' );</script>";
}

function login($userName, $password){

    //echo "attempting login with " . $userName . " and " . $password . "<br/>";
    $hash = md5($password);
    $mysql = mysqlConnection();
    $query = "select * from where username = '$userName' and password = '$hash'";
    return $query;
}

function signup($post){
    $page = 'Users';
    $fields = getFieldNames($page);
    $fm = getFileMakerConnection();
    $cmd = $fm->newAddCommand('PHP-' . $page);
    
    $result = $cmd->execute();
    
    if ($fm->isError($result))
    {
        //echo "Error - " . $result->getMessage();
        throw new \ErrorException("New DBItem Failed ");
    }

    
    $records = $result->getRecords();
    $salt = $records[0]->_impl->_fields['salt'][0];
    $post['hash'] =  md5( $salt . $post['password']);
    $post['access'] = 'Internal';
    $dbItem = null;
    if(count($records)> 0){
        $record = $records[0];
           $dbItem = new DBItem();

        $dbItem->setDBItemFields($fields);
        $dbItem->reInit($record);
    }
    if(!empty($dbItem)){

        //$dbItem->setName();
        // echo "setting store to ";
        // //var_dump($post);
        $dbItem->preSet($post);
         $dbItem->commitToDatabase();
        // echo "record committed";
    }
}


function getDBItems($page){
$fields = getFieldNames($page);
    $fm = getFileMakerConnection();
    $cmd = $fm->newFindCommand('PHP-'.$page);
   	//cmd->addFindCriterion('username', '=='.$userName);
    
    $result = $cmd->execute();
    
    if ($fm->isError($result))
    {
    	//echo "Error - " . $result->getMessage();
	    throw new \ErrorException("Get DBItems Failed");
    }

    
    $records = $result->getRecords();

    $toReturn = [];

    foreach ($records as $record) {

    	$dbItem = new DBItem();

    $dbItem->setDBItemFields($fields);
    $dbItem->reInit($record);
    	$toReturn[] = $dbItem;
    }


    return $toReturn;
}

function getFields($page){

    $fm = getFileMakerConnection();
    $cmd = $fm->newFindCommand('PHP-FORMFIELDS');
    $cmd->addFindCriterion('page', '=='.$page);
    if($_SESSION["access"] != "Internal"){
       	$cmd->addFindCriterion('access', '==All');
       }
    $cmd->addSortRule('sort', 1, FILEMAKER_SORT_ASCEND);
    $result = $cmd->execute();
    
    if ($fm->isError($result))
    {
    	//echo "Error - " . $result->getMessage();
	    throw new \ErrorException("Get Fields Failed");
    }

    
    $records = $result->getRecords();

    $tabs = [];
    foreach ($records as $record) {
    	$field = new Field($record);
    	
        $parentTab = trim($field->parentTab);
        if(empty($parentTab)){
            if(empty($tabs[$field->tab])){
                $tabs[$field->tab] = [];
            }
            $tabs[$field->tab][] = $field;
        }else{
            if(empty($tabs[$parentTab][$field->tab])){
                $tabs[$parentTab][$field->tab] = [];

            }
            $tabs[$parentTab][$field->tab][] = $field;
/*           
            echo ("<pre>");
            var_dump($tabs[$parentTab]);
            echo("</pre>");
*/
        }
    	
    }

    
    return $tabs;
}


function getFieldNames($page){

    $fm = getFileMakerConnection();
    $cmd = $fm->newFindCommand('PHP-FORMFIELDS');
    $cmd->addFindCriterion('page', '=='.$page);
    //echo "finding fields for page " . $page . "<br>";
    //cmd->addFindCriterion('username', '=='.$userName);
    $cmd->addSortRule('sort', 1, FILEMAKER_SORT_ASCEND);
    $result = $cmd->execute();
    
    if ($fm->isError($result))
    {
        //echo "Error - " . $result->getMessage();
        throw new \ErrorException("Get Field Names Failed");
    }

    
    $records = $result->getRecords();

    $fields = [];
    foreach ($records as $record) {
        $field = new Field($record);
        $fields[] = $field->name;
    }

    return $fields;

}

function getSelectList($page){

    $fm = getFileMakerConnection();
    $cmd = $fm->newFindCommand('PHP-' . $page);
    //echo "finding fields for page " . $page . "<br>";
    //cmd->addFindCriterion('username', '=='.$userName);
    $cmd->addSortRule('name', 1, FILEMAKER_SORT_DESCEND);
    $result = $cmd->execute();
    
    if ($fm->isError($result))
    {
        //echo "Error - " . $result->getMessage();
        throw new \ErrorException("Get Field Names Failed");
    }

    
    $records = $result->getRecords();

    $items = [];
    foreach ($records as $record) {
        $items[$record->getField('id')] = $record->getField('Name');
    }

    return $items;

}

function getDBItem($dbItemID,$page){

    $fields = getFieldNames($page);
    $fm = getFileMakerConnection();
    $cmd = $fm->newFindCommand('PHP-' .$page);
    $cmd->addFindCriterion('id', '=='.$dbItemID);
    //echo "getting Item from " . "PHP-" . $page . "<br/>";
    
    $result = $cmd->execute();
    
    if ($fm->isError($result))
    {
        //echo "Error - " . $result->getMessage();
        throw new \ErrorException("Get DBItem Failed using dbItem id ". $dbItemID);
    }

    
    $records = $result->getRecords();

    $toReturn = null;
    if(count($records)> 0){
        $record = $records[0];
           $dbItem = new DBItem();

        $dbItem->setDBItemFields($fields);
        $dbItem->reInit($record);
       $toReturn = $dbItem;
    }
    return $toReturn;

}

function setDBItem($post,$page){
    $dbItemID = $post["id"];
    //echo "setting dbItem with id " . $dbItemID . "<br/>";
    $fields = getFieldNames($page);
    $fm = getFileMakerConnection();
    $cmd = $fm->newFindCommand('PHP-'.$page);
    $cmd->addFindCriterion('id', '=='.$dbItemID);
    
    $result = $cmd->execute();
    
    if ($fm->isError($result))
    {
        //echo "Error - " . $result->getMessage();
        throw new \ErrorException("Get DBItem Failed using dbItem id ". $dbItemID);
    }

    
    $records = $result->getRecords();
    //echo "found " . count($records) . "<br/>";

    $dbItem = null;
    if(count($records)> 0){
        $record = $records[0];
           $dbItem = new DBItem();

        $dbItem->setDBItemFields($fields);
        $dbItem->reInit($record);
        //echo "record reinitialized <br/>";
    }

    if(!empty($dbItem)){
        //$dbItem->setName();
         //echo "setting store to ";
         //var_dump($post);
        //echo "records id is " . $record->getField('id') . " on dbItem its " . $dbItem->id . "<br/>";
        $dbItem->preSet($post);
         $dbItem->commitToDatabase();
        //echo "record committed";
    }
}

function newDBItem($post,$page){
    $dbItemID = $post["id"];
    $fields = getFieldNames($page);
    $fm = getFileMakerConnection();
    $cmd = $fm->newAddCommand('PHP-' . $page);
    
    $result = $cmd->execute();
    
    if ($fm->isError($result))
    {
        //echo "Error - " . $result->getMessage();
        throw new \ErrorException("New DBItem Failed ");
    }

    
    $records = $result->getRecords();

    $dbItem = null;
    if(count($records)> 0){
        $record = $records[0];
           $dbItem = new DBItem();

        $dbItem->setDBItemFields($fields);
        $dbItem->reInit($record);
    }

    if(!empty($dbItem)){
        //$dbItem->setName();
        // echo "setting store to ";
        // //var_dump($post);
        $dbItem->preSet($post);
         $dbItem->commitToDatabase();
        // echo "record committed";
    }
}