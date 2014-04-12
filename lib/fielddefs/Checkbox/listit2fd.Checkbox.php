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

class listit2fd_Checkbox extends ListIt2FielddefBase
{
	public function __construct(&$db_info, $caller_object) 
	{	
		parent::__construct($db_info, $caller_object);
		
		$this->SetFriendlyType($this->ModLang('fielddef_'.$this->GetType()));
	}
	
	public function Validate(&$errors) 
	{
		if($this->GetValue("string") == 0 && $this->IsRequired()) {
	
			$errors[] = $this->ModLang('required_field_empty') . ' (' . $this->GetName() . ')';
		}
	}

	public function RenderForAdminListing($id, $returnid)
	{
	
		$output = '<div class="init-ajax-toggle">';
	
		$admintheme = cms_utils::get_theme_object();
		$mod = $this->GetModuleInstance(true);
	
		if ($this->GetValue("string")) {

			$output .= $mod->CreateLink($id, 'admin_togglefielddefvalue', $returnid, $admintheme->DisplayImage('icons/system/true.gif', '', '', '', 'systemicon'), array(
				'fielddef_id' => $this->GetId(),
				'item_id' => $this->GetItemId(),
				'value' => 0
			));		
		} 
		else {
		
			$output .= $mod->CreateLink($id, 'admin_togglefielddefvalue', $returnid, $admintheme->DisplayImage('icons/system/false.gif', '', '', '', 'systemicon'), array(
				'fielddef_id' => $this->GetId(),
				'item_id' => $this->GetItemId(),
				'value' => 1
			));	
		}	
		
		$output .= '</div>';
		
		return $output;
	}	
	
} // end of class
?>