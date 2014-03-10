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
# Tapio L�ytty, <tapsa@orange-media.fi>
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

class listit2fd_TextArea extends ListIt2FielddefBase
{
	public function __construct(&$db_info) 
	{	
		parent::__construct($db_info);
		
		$this->SetFriendlyType($this->ModLang('fielddef_'.$this->GetType()));
	}
	
	public function Validate(&$errors)
	{
		if (strlen($this->GetValue("string")) > $this->GetOptionValue('max_lenght', 6000) && $this->GetOptionValue('max_lenght')) {
		
			$errors[] = $this->ModLang('too_long') . ' (' . $this->GetName() . ')';
		}		
	
		parent::Validate($errors);
	}
		
	public function GetInput($id)
	{
		$mod = $this->GetModuleInstance();
		
		return $mod->CreateTextArea($this->GetOptionValue('wysiwyg'), $id, $this->GetValue("string"), 'customfield['.$this->GetId().']');
	}
	
} // end of class
?>