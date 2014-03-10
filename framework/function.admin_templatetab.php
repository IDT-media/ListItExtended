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

#---------------------
# Init items
#---------------------

if (!$this->CheckPermission($this->_GetModuleAlias() . '_modify_option'))
    return;
	
$admintheme = cmsms()->get_variable('admintheme');
$templates = $this->ListTemplates();
$items = array();
$addlinks = array();

foreach ($templates as $template) {

	list($tpl_type, $tpl_name) = explode('_', $template, 2);

    $onerow = new stdClass();

    $onerow->link   = $this->CreateLink($id, 'admin_edittemplate', $returnid, $tpl_name, array('name' => $template));
    $onerow->name   = $tpl_name;
    $onerow->delete = $this->CreateLink($id, 'admin_deletetemplate', $returnid, $admintheme->DisplayImage('icons/system/delete.gif', $this->ModLang('delete'), '', '', 'systemicon'), array('name' => $template));
    $onerow->edit   = $this->CreateLink($id, 'admin_edittemplate', $returnid, $admintheme->DisplayImage('icons/system/edit.gif', $this->ModLang('edit'), '', '', 'systemicon'), array('name' => $template));

	$tpl_default = $this->GetPreference($this->_GetModuleAlias() . '_default_'.$tpl_type.'_template');
	
	if($tpl_default == $tpl_name) {

		$onerow->default = $admintheme->DisplayImage('icons/system/true.gif', $this->ModLang('is_default'),'','','systemicon');
		
		if($tpl_type != 'filter') // <- For upgrade, so ppl are abel to remove all filter templates after moving stuff to search instance. (1.2.1 -> 1.2.2)
			unset($onerow->delete); // <- Disable delete button
		
	} else {
	
		$onerow->default = $this->CreateLink($id,'admin_setdefaulttemplate',$returnid,
						$admintheme->DisplayImage('icons/system/false.gif',$this->ModLang('status_default'),'','','systemicon'),array('name' => $template));
	}	
	
    $items[$tpl_type][] = $onerow;
	
	if(!isset($addlinks[$tpl_type]))
		$addlinks[$tpl_type] = $this->CreateLink($id, 'admin_edittemplate', $returnid, $admintheme->DisplayImage('icons/system/newobject.gif', $this->ModLang('add', $this->ModLang($tpl_type . 'template')), '', '', 'systemicon') . $this->ModLang('add', $this->ModLang($tpl_type . 'template')), array('type' => $tpl_type));
}

ksort($items);

#---------------------
# Smarty processing
#---------------------

$smarty->assign('items', $items);
$smarty->assign('addlinks', $addlinks);

echo $this->ModProcessTemplate('templatetab.tpl');
?>