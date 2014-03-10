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

class ListIt2Cache extends ArrayObject
{ 
	#---------------------
	# Variables
	#---------------------	
	
	private $_identifiers;

	#---------------------
	# Magic methods
	#---------------------	
	
    public function __construct($identifiers) 
	{
		$this->_identifiers = $identifiers;
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
		if(!is_object($value))
			throw new ListIt2Exception(__METHOD__ . ": Value type must be object!");
			
		$key = reset($this->_identifiers);
	
		parent::offsetSet($value->$key, $value);
	}

    public function offsetExists($offset) 
	{
		if(parent::offsetExists($offset))
			return true;
			
		return FALSE;
    }
	
    public function offsetGet($offset) 
	{
		if(parent::offsetExists($offset))
			return parent::offsetGet($offset);
			
		return null;
    }

	#---------------------
	# Class methods
	#---------------------		

	public function GetCachedByIdentifier($identifier, $value)
	{
		if(!in_array($identifier, $this->_identifiers))
			throw new ListIt2Exception(__METHOD__ . ": Illegal identifier: $identifier!");
			
		foreach($this as $cached) {
		
			if($cached->$identifier == $value) {
			
				return $cached;			
			}
		}
		
		return null;
	}
	
} // end of class

?>