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

class listit2fd_GeoCoder extends ListIt2FielddefBase
{
	public function __construct(&$db_info, $caller_object) 
	{	
		parent::__construct($db_info, $caller_object);
		
		$this->SetFriendlyType($this->ModLang('fielddef_'.$this->GetType()));
	}
	
	public function Siblings()
	{
		$caller = $this->GetModuleInstance(true);		
		$all_fields = $caller->GetFieldDefs();
		
		$output = array();
		foreach($all_fields as $field) {
		
			if($field->GetId() == $this->GetId())
				continue;
				
			$output[$field->GetId()] = $field->GetName();		
		}	
		
		return $output;
	}
	
	public function Address()
	{	
		foreach($this->GetParentArray() as $field) {
		
			if($field->GetId() == $this->GetOptionValue('address_field'))
				return $field->GetValue(self::TYPE_STRING);
		}

		return null;
	}
	
} // end of class
?>