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

class listit2fd_Categories extends ListIt2FielddefBase
{
	public function __construct(&$db_info, $caller_object) 
	{	
		parent::__construct($db_info, $caller_object);
		
		$this->SetFriendlyType($this->ModLang('categories'));
	}
	
	public function IsUnique()
	{
		return true;
	}
	
	public function RenderInput($id, $returnid)
	{
		$type = $this->GetOptionValue('subtype', 'Dropdown');
		$obj = ListIt2FielddefOperations::LoadFielddefByType($type);
		
		if(is_object($obj))
			return $obj->RenderInput($id, $returnid);
			
		return false;
	}
	
	public function RenderForAdminListing($id, $returnid)
	{
		$mod = $this->GetModuleInstance(true);
		$id_list = $this->GetValue(parent::TYPE_ARRAY);
		
		$output = ListIt2CategoryOperations::GetCategoryNameFromId($mod, $id_list);
		
		return implode(', ', $output);
	}	
	
	public function GetOptions()
	{			
		$mod = $this->GetModuleInstance(true);
		$type = $this->GetOptionValue('subtype', 'Dropdown');
		$categories = ListIt2CategoryOperations::GetHierarchyList($mod);

		if($type == 'MultiSelect' || $type == 'CheckboxGroup' || $this->IsRequired())
			array_shift($categories);

		return array_flip($categories);
	}

	public function SubTypes()
	{
        return array(
            'Dropdown' => $this->ModLang('fielddef_Dropdown'),
            'MultiSelect' => $this->ModLang('fielddef_MultiSelect'),
            'RadioGroup' => $this->ModLang('fielddef_RadioGroup'),
            'CheckboxGroup' => $this->ModLang('fielddef_CheckboxGroup')
        );
	}
	
	public function Separator()
	{
		return $this->GetOptionValue('separator');	
	}	

} // end of class
?>