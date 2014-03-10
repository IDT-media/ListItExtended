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
# Some wackos started destroying stuff since 2012: 
#
# Tapio Löytty, <tapsa@orange-media.fi>
# Web: www.orange-media.fi
#
# Goran Ilic, <uniqu3e@gmail.com>
# Web: www.ich-mach-das.at
#
#-------------------------------------------------------------------------
#
# ListIt is a CMS Made Simple module that enables the web developer to create
# multiple lists throughout a site. It can be duplicated and given friendly
# names for easier client maintenance.
#
#-------------------------------------------------------------------------

class ListIt2Item
{
	#---------------------
	# Attributes
	#---------------------

	//public $id;
	public $item_id; // deprecated
	public $alias;
	public $title;
	public $position;
	public $active;
	public $create_time;
	public $modified_time;
	public $start_time;
	public $end_time;
	public $owner;	
	
	public $key1;
	public $key2;
	public $key3;

	public $fielddefs;
	
	static public $mandatory = array('title');
		
	#---------------------
	# Magic methods
	#---------------------		
	
	public function __construct() 
	{
		$this->item_id = null;
		$this->alias = null;
		$this->title = '';
		$this->position = -1;
		$this->active = 1;
		$this->create_time = '';
		$this->modified_time = '';
		$this->start_time = '';
		$this->end_time = '';
		$this->owner = null;
		
		$this->key1 = null;
		$this->key2 = null;
		$this->key3 = null;
		
		$this->fielddefs = new ListIt2FielddefArray(array());
	}
	
	public function __clone()
	{
		$this->fielddefs->SetParentItem($this);		
	}
	
	public function __get($key)
	{
		if(isset($this->fielddefs[$key])) 
			return $this->fielddefs[$key]->GetValue();
	}
	
	public function __set($key, $value)
	{
		if(isset($this->fielddefs[$key])) {
		
			$this->fielddefs[$key]->SetValue($value);
		}
		else {
		
			$this->$key = $value;
		}
	}	

	public function __isset($key)
	{
		if(isset($this->fielddefs[$key]) && $this->fielddefs[$key]->HasValue())
			return true;
			
		return FALSE;
	}	
	
	public function __toString()
	{
		return (string)$this->title;
	}	
	
	#---------------------
	# Utility methods
	#---------------------	
	
	// Delete this awful method. Used only by importer.
	public function SetPropertyValue($property, $value)
	{
		if(property_exists($this, $property)) {  // <- For internal properties
		
			if(is_array($value)) {
				$this->$property = $value[0];
			}
			else {
				$this->$property = $value; 
			}
		} 
		elseif(isset($this->fielddefs[$property])) { // <- For field definitions
		
			$this->$property = (array)$value;
		}
		else { // Anything else.
		
			$this->$property = $value; 
		}
	}
	
} // end of class

?>