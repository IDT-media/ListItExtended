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

if (isset($params['message'])) {
	echo $this->ShowMessage($this->ModLang($params['message']));
}

if (isset($params['errors']) && count($params['errors'])) {
	echo $this->ShowErrors($params['errors']);
}

if (!empty($params['active_tab'])) {
	$tab = $params['active_tab'];
} else {
	$tab = 'instancestab';
}

echo $this->StartTabHeaders();
echo $this->SetTabHeader('instancestab', $this->ModLang('instances'), ($tab == 'instancestab'));
echo $this->SetTabHeader('fielddefstab', $this->ModLang('fielddefs'), ($tab == 'fielddefstab'));
echo $this->SetTabHeader('maintenancetab', $this->ModLang('maintenance'), ($tab == 'maintenancetab'));
echo $this->SetTabHeader('optionstab', $this->ModLang('options'), ($tab == 'optionstab'));
echo $this->EndTabHeaders();

echo $this->StartTabContent();

echo $this->StartTab('instancestab', $params);
include dirname(__FILE__) . '/tabcontent.admin_instancestab.php';
echo $this->EndTab();

echo $this->StartTab('fielddefstab', $params);
include dirname(__FILE__) . '/tabcontent.admin_fielddefstab.php';
echo $this->EndTab();

echo $this->StartTab('maintenancetab', $params);
include dirname(__FILE__) . '/tabcontent.admin_maintenancetab.php';
echo $this->EndTab();

echo $this->StartTab('optionstab', $params);
include dirname(__FILE__) . '/tabcontent.admin_optionstab.php';
echo $this->EndTab();
    
echo $this->EndTabContent();

?>