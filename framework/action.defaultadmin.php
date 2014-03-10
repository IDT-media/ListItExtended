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

if (!is_object(cmsms())) exit;

if (!$this->CheckPermission($this->_GetModuleAlias() . '_modify_item'))
	return;

// Get prefs
$show_categories = ListIt2FielddefOperations::TestExistanceByType($this, 'Categories');
	
if (isset($params['message'])) {
	echo $this->ShowMessage($this->ModLang($params['message']));
}

if (isset($params['errors']) && count($params['errors'])) {
	echo $this->ShowErrors($params['errors']);
}

if (!empty($params['active_tab'])) {
	$tab = $params['active_tab'];
} else {
	$tab = 'itemtab';
}

echo $this->StartTabHeaders();
echo $this->SetTabHeader('itemtab', $this->GetPreference('item_plural', ''), ($tab == 'itemtab'));

if ($this->CheckPermission($this->_GetModuleAlias() . '_modify_category') && $show_categories) {
	echo $this->SetTabHeader('categorytab', $this->ModLang('categories'), ($tab == 'categorytab'));
}

if ($this->CheckPermission($this->_GetModuleAlias() . '_modify_option')) {
	echo $this->SetTabHeader('fielddeftab', $this->ModLang('fielddefs'), ($tab == 'fielddeftab'));
	echo $this->SetTabHeader('templatetab', $this->ModLang('templates'), ($tab == 'templatetab'));
	echo $this->SetTabHeader('optiontab', $this->ModLang('options'), ($tab == 'optiontab'));
}

echo $this->EndTabHeaders();
echo $this->StartTabContent();

echo $this->StartTab('itemtab', $params);
include dirname(__FILE__) . '/function.admin_itemtab.php';
echo $this->EndTab();

if ($this->CheckPermission($this->_GetModuleAlias() . '_modify_category') && $show_categories) {
	echo $this->StartTab('categorytab', $params);
	include dirname(__FILE__) . '/function.admin_categorytab.php';
	echo $this->EndTab();
}

if ($this->CheckPermission($this->_GetModuleAlias() . '_modify_option')) {
	echo $this->StartTab('fielddeftab', $params);
	include dirname(__FILE__) . '/function.admin_fielddeftab.php';
	echo $this->EndTab();
	
	echo $this->StartTab('templatetab', $params);
	include dirname(__FILE__) . '/function.admin_templatetab.php';
	echo $this->EndTab();
	
	echo $this->StartTab('optiontab', $params);
	include dirname(__FILE__) . '/function.admin_optiontab.php';
	echo $this->EndTab();
}

echo $this->EndTabContent();

?>