<?php

/**
 * Provides structure to the information from  get account info.
 * Used during login verification
 *
 * @author erik
 */
class Field extends \mcs\FMRecordTemplate
{

    public $name;
    public $tab;
    public $width;
    public $type;
    public $choices;
    public $related = false;

	protected function readFields()
	{
		$this->name = $this->getField('name');
		$this->tab = $this->getField('_c_tab');
		$this->parentTab = $this->getField('_c_parent_tab');
		$this->width = $this->getField('width');
		$this->type = $this->getField('type');
		$this->choices = [];
		if (strpos($this->getField('choices'), '[') !== false) {
			$search = str_replace("[", "",$this->getField('choices'));
			$search = str_replace("]", "",$search);
			$temp = [];
			$temp[] = "";
			$temp = $temp + getSelectList($search);
			$this->choices = $temp;
			$this->related = $search;
		}else{
			$temp = explode("\n",$this->getField('choices'));
			foreach ($temp as $key => $value) {
				$this->choices[$value] = $value;
			}
		}


		//var_dump($this->choices);
	//echo "<br/>";
	}


	
	public function toArray(){
	    return [
		"name"=>$this->name,
		"tab"=>$this->tab,
		"width"=>$this->width,
		"type"=>$this->type
	    ];
	}
	
//	public function commitToRecord(){
//	    //$this->setField('user', $this->user);
//	    $this->commit();
//	}

}
