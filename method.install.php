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

#---------------------
# Database tables
#---------------------

$dict = NewDataDictionary($db);
$taboptarray = array('mysql' => 'TYPE=MyISAM');

// instance tables
$fields = '
    module_id I KEY AUTO,
    module_name C(160)
';

$sqlarray = $dict->CreateTableSQL(cms_db_prefix() . 'module_listit2_instances', $fields, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

// Fielddef tables
$fields = '
	type C(255) KEY,
	originator C(255),
	path C(255),
	active I4,
	disabled I4
';

$sqlarray = $dict->CreateTableSQL(cms_db_prefix() . 'module_listit2_fielddefs', $fields, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

#---------------------
# Events
#---------------------

$this->AddEventHandler('Core', 'ContentPostCompile', false);
$this->AddEventHandler('Core', 'ModuleInstalled', false);
$this->AddEventHandler('Core', 'ModuleUninstalled', false);
$this->AddEventHandler('Core', 'ModuleUpgraded', false);

#---------------------
# Preferences
#---------------------

$this->SetPreference('allow_autoscan', 0);
$this->SetPreference('allow_autoinstall', 1);

#---------------------
# Smarty plugins
#---------------------

$this->RegisterSmartyPlugin('ListIt2Loader','function', array('ListIt2Smarty', 'loader'));

#---------------------
# Scan fielddefs
#---------------------

ListIt2FielddefOperations::ScanModules();

