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

$taboptarray = array('mysql' => 'TYPE=MyISAM');
$dict = NewDataDictionary($db);

if( version_compare($oldversion, '1.2') < 0 ) {

	// Instance tables
	$fields = '
		module_id I KEY AUTO,
		module_name C(160)
	';

	$sqlarray = $dict->CreateTableSQL(cms_db_prefix() . 'module_listit2_instances', $fields, $taboptarray);
	$dict->ExecuteSQLArray($sqlarray);
	
} // end of 1.1 -> 1.2 upgrade

if( version_compare($oldversion, '1.3') < 0 ) {

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
	
	// Events
	$this->AddEventHandler('Core', 'ModuleInstalled', false);
	$this->AddEventHandler('Core', 'ModuleUninstalled', false);
	$this->AddEventHandler('Core', 'ModuleUpgraded', false);

	// Preferences
	$this->SetPreference('allow_autoscan', 0);
	$this->SetPreference('allow_autoinstall', 1);
		
	// Create instance from original
	$mod_name = $this->GetName() . 'Original';
	
	$duplicator = new ListIt2Duplicator();
	$duplicator->SetModule($mod_name);
	$duplicator->SetDestination(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . $mod_name);
	$duplicator->Run();
	
	// Fix files for this spesific upgrade
	$duplicator->SetSource(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'upgrade_support' . DIRECTORY_SEPARATOR . '1.3');
	$duplicator->Run();
		
} // end of 1.2.2 -> 1.3 upgrade

if( version_compare($oldversion, '1.4-beta2') < 0 ) {

	// Smarty plugins
	$this->RegisterSmartyPlugin('ListIt2Loader','function', array('ListIt2Smarty', 'loader'));

} // end of 1.3 -> 1.4-beta2 upgrade

if( version_compare($oldversion, '1.4.1') < 0 ) {

	// Events
	$this->AddEventHandler('Core', 'ContentPostCompile', false);

} // end of 1.4 -> 1.4.1 upgrade