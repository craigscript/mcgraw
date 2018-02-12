<?php

/**
 * Provides structure to the information from  get account info.
 * Used during login verification
 *
 * @author erik
 */
class DBItem extends \mcs\FMRecordTemplate
{
	public $id;
    public $name;

    public $store;
    public $toSet;

    public $dbItemFields = [];
    public $friendMap = [];

    public function setDBItemFields($dbItemFields){
    	//echo "setting dbItemfields to " ;
    	//var_dump($dbItemFields);
    	$this->dbItemFields = $dbItemFields;
    	//echo "dbItem fields set" ;
    }

    public function setStore($store){
    	$this->store = $store; 
    }

    public function preSet($toSet){
    	$this->toSet = $toSet;
    }

	protected function readFields()
	{
		$this->name = $this->getField('Name');
		$this->id = $this->getField('id');
		foreach($this->dbItemFields as $field){
			//echo "getting field " . $field . " to " . $this->getField($field) . "<br/>";
			$this->store[$field] = $this->getField($field); 
			$this->friendMap[friendly($field)] = $field;
		}
		
	}
	
	public function toArray(){

	    return array_merge($this->store, ["id"=>$this->id]);
	}

	public function setName(){

        //echo "Set field using |Name|Test| on dbItem " . $dbItem->id . "<br/>";
		$this->setField("Name", "Test");
		$this->commit();
	}
	
	public function commitToDatabase(){
		//echo "committing to database " . count($this->dbItemFields);
		$changed = 0;
		foreach($this->dbItemFields as $field){
			//echo $this->toSet[friendly($field)] . " = " . $this->store[$field] . " for field " . $field . "</br>";
			if($this->toSet[friendly($field)] != $this->store[$field]){
				$changed = $changed + 1;
			//echo "Set field using |" . $field . "|". $this->toSet[friendly($field)] . "| on dbItem " . $this->id . "</br>";
			$this->setField($field ,$this->toSet[friendly($field)]);
		}
			
		}
		//echo $changed . " objects changed ";
		if($changed > 0){
			//echo  "committing";
	   if($this->commit()){
	   	//echo "commit successful";
	   }else{
	   	//echo "commit failed";
	   }
	}
	   
	}

}
