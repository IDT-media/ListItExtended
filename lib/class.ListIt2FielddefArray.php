<?php
#-------------------------------------------------------------------------
#
# Author: Ben Malen, <ben@conceptfactory.com.au>
# Co-Maintainer: Simon Radford, <simon@conceptfactory.com.au>
# Web: www.conceptfactory.com.au
#
#-------------------------------------------------------------------------
#
# Maintainer since 2011: Jonathan Schmid, <hi@jonathanschmid.de>
# Web: www.jonathanschmid.de
#
#-------------------------------------------------------------------------
#
# ListIt is a CMS Made Simple module that enables the web developer to create
# multiple lists throughout a site. It can be duplicated and given friendly
# names for easier client maintenance.
#
#-------------------------------------------------------------------------

class ListIt2FielddefArray extends ArrayObject
{ 
	#---------------------
	# Variables
	#---------------------	
	
	private $_parent_item;

	#---------------------
	# Magic methods
	#---------------------	
	
    public function __construct($array) 
	{
        foreach($array as $key => $value) {
		
			$value->SetParentArray($this);
            $this->offsetSet($key, $value);
        }	
	}
	
	public function __toString()
	{
		return "Array";
	}	
	
	#---------------------
	# Array Object methods
	#---------------------		
	
	public function offsetSet($key, $value)
	{
		if(!$value instanceof ListIt2FielddefBase)
			die('Not an ListIt2 Fielddef Object'); // <- Put mention to admin log instead of killing script and ignore value.
			
		parent::offsetSet($key, $value);
	}

    public function offsetExists($offset) 
	{
		if(parent::offsetExists($offset))
			return true;
			
		foreach($this as $field) {
		
			if(is_object($field))
				if($field->GetAlias() == $offset)
					return true;
		}
		
		return FALSE;
    }
	
    public function offsetGet($offset) 
	{
		if(parent::offsetExists($offset)) {
			
			$obj = parent::offsetGet($offset);
			
			if(!cmsms()->is_frontend_request()) {
			
				$smarty = cmsms()->GetSmarty();
				$smarty->assign('fielddef', $obj);
			}
						
			return $obj;
		}
			
		foreach($this as $field) {
		
			if(is_object($field))
				if($field->GetAlias() == $offset) {
					
					if(!cmsms()->is_frontend_request()) {
					
						$smarty = cmsms()->GetSmarty();	
						$smarty->assign('fielddef', $field);
					}
					
					return parent::offsetGet($field->GetId());	
				}
		}
		
		return null;
    }

	#---------------------
	# Class methods
	#---------------------		

	public final function GetParentItem() {
	
		if(isset($this->_parent_item))
			return $this->_parent_item;
		
		return FALSE;
	}

	public final function SetParentItem(&$obj) {
	
		$this->_parent_item = $obj;
	}		
	
} // end of class

?>