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

if (!is_object(cmsms())) exit;

#---------------------
# Init
#---------------------

if (!$this->CheckPermission($this->_GetModuleAlias() . '_modify_option'))
    return;

$systemdefs = $this->GetFieldDefs();
$fielddefs = array(
	$this->ModLang('alias') 		=> 'alias', 
	$this->ModLang('create_time') 	=> 'create_time', 
	$this->ModLang('modified_time') => 'modified_time', 
	$this->ModLang('start_time') 	=> 'start_time', 
	$this->ModLang('end_time') 		=> 'end_time'
);
foreach($systemdefs as $onedef) {

	$fielddefs[$onedef->GetName()] = $onedef->GetAlias();
}

// pagination options
$items_per_page = array(
    10 => 10,
    20 => 20,
    50 => 50,
    100 => 100,
    200 => 200,
    300 => 300,
    400 => 400,
    500 => 500,
    1000 => 1000
);

// module admin section options
$admin_sections = array(
    lang('main') => 'main',
    lang('content') => 'content',
    lang('layout') => 'layout',
    lang('usersgroups') => 'usersgroups',
    lang('extensions') => 'extensions',
    lang('siteadmin') => 'siteadmin',
    lang('myprefs') => 'myprefs',
    lang('ecommerce') => 'ecommerce'
);

// sortorder options
$sortorder      = array(
    $this->ModLang('ascending') => 'ASC',
    $this->ModLang('descending') => 'DESC'
);

$content_ops 			= cmsms()->GetContentOperations();

$display_inline     	= $this->GetPreference('display_inline', 0);
$subcategory        	= $this->GetPreference('subcategory', 0);
$display_create_date 	= $this->GetPreference('display_create_date', 0);
$reindex_search 		= $this->GetPreference('reindex_search', 0);

#---------------------
# Smarty processing
#---------------------

$smarty->assign('startform', $this->CreateFormStart($id, 'admin_editoption', $returnid));
$smarty->assign('endform', $this->CreateFormEnd());
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));

// Module Options
$smarty->assign('input_friendlyname', $this->CreateInputText($id, 'friendlyname', $this->GetPreference('friendlyname', ''), 50));
$smarty->assign('input_moddescription', $this->CreateTextArea(false, $id, $this->GetPreference('moddescription', $this->ModLang('moddescription')), 'moddescription', 'pagesmalltextarea', '', '', '', '80', '3'));
$smarty->assign('input_adminsection', $this->CreateInputDropdown($id, 'adminsection', $admin_sections, -1, $this->GetPreference('adminsection', 'content')));

// Module defaults
$smarty->assign('input_detailpage', $content_ops->CreateHierarchyDropdown('', $this->GetPreference('detailpage'), $id.'detailpage'));
$smarty->assign('input_summarypage', $content_ops->CreateHierarchyDropdown('', $this->GetPreference('summarypage'), $id.'summarypage'));

// Item options
$smarty->assign('input_item_title', $this->CreateInputText($id, 'item_title', $this->GetPreference('item_title', ''), 50));
$smarty->assign('input_item_singular', $this->CreateInputText($id, 'item_singular', $this->GetPreference('item_singular', ''), 50));
$smarty->assign('input_item_plural', $this->CreateInputText($id, 'item_plural', $this->GetPreference('item_plural', ''), 50));
$smarty->assign('input_items_per_page', $this->CreateInputDropdown($id, 'items_per_page', $items_per_page, -1, $this->GetPreference('items_per_page', 20)));
$smarty->assign('input_sortorder', $this->CreateInputDropdown($id, 'items_sortorder', $sortorder, -1, $this->GetPreference('sortorder', 'ASC')));
$smarty->assign('input_create_date', $this->CreateInputCheckbox($id, 'display_create_date', 1, $display_create_date, ($display_create_date ? 'checked="checked"' : '')));
$smarty->assign('input_item_cols', $this->CreateInputSelectList($id, 'item_cols[]', $fielddefs, explode(',', $this->GetPreference('item_cols', '')), 10));

// URL options
$smarty->assign('input_url_prefix', $this->CreateInputText($id, 'url_prefix', $this->GetPreference('url_prefix', ''), 50));
$smarty->assign('input_display_inline', $this->CreateInputCheckbox($id, 'display_inline', 1, $display_inline, ($display_inline ? 'checked="checked"' : '')));
$smarty->assign('input_subcategory', $this->CreateInputCheckbox($id, 'subcategory', 1, $subcategory, ($subcategory ? 'checked="checked"' : '')));

// Cross Module options
$smarty->assign('input_reindex_search', $this->CreateInputCheckbox($id, 'reindex_search', 1, $reindex_search, ($reindex_search ? 'checked="checked"' : '')));

echo $this->ModProcessTemplate('optiontab.tpl');

?>