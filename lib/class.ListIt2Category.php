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

class ListIt2Category
{
	#---------------------
	# Attributes
	#---------------------

	public $category_id = null;
	public $alias = null;	
	public $name = '';
	public $description = '';
	public $active = 1;
	public $position = 1;
	public $parent_id = -1;
	public $hierarchy = '';
	public $id_hierarchy = '';
	public $hierarchy_path = '';
	public $create_date = '';
	public $modified_date = '';
	
	public $key1 = null;
	public $key2 = null;
	public $key3 = null;
	
	public $items;
	public $children;
	static public $mandatory = array('name');
	
	#---------------------
	# Magic methods
	#---------------------		
	
	public function __construct() 
	{
		$this->items = array();
		$this->children = array();
	}
	
	public function __toString()
	{
		return (string)$this->name;
	}
	
} // end of class
?>