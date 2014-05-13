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
if (!$this->CheckPermission($this->_GetModuleAlias(). '_modify_option')) return;

#---------------------
# Error processing
#---------------------

$errors = array();

if(empty($params['url_prefix'])) 
	$errors[] = $this->ModLang('error_optionrequired', $this->ModLang('prompt_url_prefix'));

if(empty($params['friendlyname'])) 
	$errors[] = $this->ModLang('error_optionrequired', $this->ModLang('prompt_friendlyname'));

if(empty($params['item_title'])) 
	$errors[] = $this->ModLang('error_optionrequired', $this->ModLang('prompt_item_title'));

if(empty($params['item_singular'])) 
	$errors[] = $this->ModLang('error_optionrequired', $this->ModLang('prompt_item_singular'));

if(empty($params['item_plural'])) 
	$errors[] = $this->ModLang('error_optionrequired', $this->ModLang('prompt_item_plural'));

if(count($errors)) {

	$params = array('errors' => $errors[0], 'active_tab' => 'optiontab');
	$this->Redirect($id, 'defaultadmin', '', $params);
}

#---------------------
# Set new values
#---------------------

$this->SetPreference('friendlyname',		$params['friendlyname']);
$this->SetPreference('adminsection',		$params['adminsection']);
$this->SetPreference('moddescription',      $params['moddescription']);
$this->SetPreference('item_title',			$params['item_title']);
$this->SetPreference('sortorder',			$params['items_sortorder']);
$this->SetPreference('item_singular',		$params['item_singular']);
$this->SetPreference('item_plural',			$params['item_plural']);
$this->SetPreference('display_create_date', (isset($params['display_create_date'])?1:0));
$this->SetPreference('item_cols',			((isset($params['item_cols']) && is_array($params['item_cols'])) ? implode(',', $params['item_cols']) : ''));
$this->SetPreference('items_per_page',		$params['items_per_page']);
$this->SetPreference('url_prefix',			$params['url_prefix']);
$this->SetPreference('display_inline',		(isset($params['display_inline'])?1:0));
$this->SetPreference('subcategory',			(isset($params['subcategory'])?1:0));

// Module defaults
$this->SetPreference('detailpage',			$params['detailpage'] >= 0 ? $params['detailpage'] : NULL);
$this->SetPreference('summarypage',			$params['summarypage'] >= 0 ? $params['summarypage'] : NULL);

// Cross Module options
$this->SetPreference('reindex_search',		(isset($params['reindex_search'])?1:0));

#---------------------
# Clear admin cache
#---------------------

if(version_compare(CMS_VERSION, '1.99-alpha0', '<')) {

	foreach (glob(cms_join_path(TMP_CACHE_LOCATION, "themeinfo*.cache")) as $filename) { @unlink($filename); }
}
else {

	foreach (glob(cms_join_path(TMP_CACHE_LOCATION, "cache*.cms")) as $filename) { @unlink($filename); }
}

#---------------------
# Go back
#---------------------

$params = array('message' => 'changessaved', 'active_tab' => 'optiontab');
$this->Redirect($id, 'defaultadmin', '', $params);
?>