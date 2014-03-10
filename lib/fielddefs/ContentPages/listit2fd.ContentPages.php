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

class listit2fd_ContentPages extends ListIt2FielddefBase
{
	private $_li2;

	public function __construct(&$db_info) 
	{	
		parent::__construct($db_info);
		
		$this->SetFriendlyType($this->ModLang('fielddef_'.$this->GetType()));
		
		$this->_li2 = cmsms()->GetModuleInstance(LISTIT2);
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
		$manager = cmsms()->GetHierarchyManager();
		$id_list = $this->GetValue(parent::TYPE_ARRAY);
		$use_name = get_site_preference('listcontent_showtitle',true);
		
		$output = array();
		foreach($id_list as $oneid) {
		
			$node = $manager->find_by_tag('id', $oneid);
			
			if($node) {
				$content = $node->getContent(FALSE, FALSE, FALSE);
			
				if($content) {
					
					$txt = $use_name ? $content->Name() : $content->MenuText();
					$output[] = $txt;
				}
			}
		}
		
		return implode(', ', $output);
	}	
	
	public function GetOptions()
	{
		$contentops = cmsms()->GetContentOperations();
				
		$result = array();
		$userid = get_userid();
		$type = $this->GetOptionValue('subtype', 'Dropdown');
		$show_all = $this->GetOptionValue('showall') ? true : false;		
		$use_name = get_site_preference('listcontent_showtitle',true);
		$allcontent = $contentops->GetAllContent(false);
		
		if ($allcontent !== FALSE && count($allcontent) > 0) {
		  
			if($type == 'Dropdown' || $type == 'RadioGroup')
				$result[-1] = lang('none');
			  
			foreach ($allcontent as $one) {
			
				// Check if object is valid
				if(!is_object($one)) 
					continue;
					
				// If it doesn't have a valid link...
				// don't include it.
				if(!$one->HasUsableLink())
					continue;
					
				// If we have a valid userid... only include pages where this user
				// has write access... or is an admin user... or has appropriate permission.
				if(!$show_all && !check_permission($userid,'Manage All Content') && !check_authorship($userid, $one->Id()))
					continue;
								
				// Don't include content types that do not want children either...
				if (!$one->WantsChildren()) 
					continue;
				
				// Else append to array.
				$txt = $use_name ? $one->Name() : $one->MenuText();
				$result[$one->Id()] = $one->Hierarchy() . '. - ' . $txt;
			}
		}

		return $result;
	}

	public function SubTypes()
	{
        return array(
            'Dropdown' => $this->_li2->ModLang('fielddef_Dropdown'),
            'MultiSelect' => $this->_li2->ModLang('fielddef_MultiSelect'),
            'RadioGroup' => $this->_li2->ModLang('fielddef_RadioGroup'),
            'CheckboxGroup' => $this->_li2->ModLang('fielddef_CheckboxGroup')
        );
	}
	
	public function Separator()
	{
		return $this->GetOptionValue('separator');	
	}	

} // end of class
?>