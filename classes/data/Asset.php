<?php

/**
 * Provides structure to the information from  get account info.
 * Used during login verification
 *
 * @author erik
 */
class Asset extends \mcs\FMRecordTemplate
{
	public $id;
    public $name;

    public $store;
    public $toSet;

    public $assetFields = [];

    public function setAssetFields($assetFields){
    	//echo "setting assetfields to " ;
    	//var_dump($assetFields);
    	$this->assetFields = $assetFields;
    	//echo "asset fields set" ;
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
		foreach($this->assetFields as $field){
			//echo "getting field " . $field . " to " . $this->getField($field) . "<br/>";
			$this->store[$field] = $this->getField($field); 
		}
		
	}
	
	public function toArray(){

	    return array_merge($this->store, ["id"=>$this->id]);
	}

	public function setName(){

        //echo "Set field using |Name|Test| on asset " . $asset->id . "<br/>";
		$this->setField("Name", "Test");
		$this->commit();
	}
	
	public function commitToDatabase(){
		$changed = 0;
		foreach($this->assetFields as $field){
			
			if($this->toSet[$field] != $this->store[$field]){
				$changed = $changed + 1;
			//echo "Set field using |" . $field . "|". $this->toSet[$field] . "| on asset " . $this->id . "<br/>";
			$this->setField($field ,$this->toSet[$field]);
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
