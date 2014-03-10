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

$GLOBALS['CMS_FORCE_MODULE_LOAD'] = 1;
$themeObject = cmsms()->get_variable('admintheme');

#---------------------
# Load modules
#---------------------

$modops = cmsms()->GetModuleOperations();
$allmodules = $modops->GetAllModuleNames();
if (count($allmodules) > 0) {

	$query = "SELECT * FROM ".cms_db_prefix()."modules ORDER BY module_name";
	$result = $db->Execute($query);

	while ($result && $row = $result->FetchRow()) {

		$dbm[$row['module_name']]['Status'] = $row['status'];
		$dbm[$row['module_name']]['Version'] = $row['version'];
		$dbm[$row['module_name']]['Active'] = ($row['active'] == 1?true:false);
	}
}

$modules = $this->ListModules();
foreach($modules as $module) {

	$mod = $modops->get_module_instance($module->module_name,'',true);
	
	if(is_object($mod)) {
		
		$module->friendlyname = $mod->GetFriendlyName();
		$module->version = $dbm[$module->module_name]['Version'];

		if (version_compare($mod->GetVersion(), $dbm[$module->module_name]['Version']) > 0) {

			$module->upgradelink = $this->CreateLink($id, 'admin_upgrademodule', $returnid, $themeObject->DisplayImage('icons/system/false.gif', $this->ModLang('instance_upgrade'), '', '', 'systemicon'), array(
				'module_id' => $module->module_id
			));		
		} 
		else {
		
			$module->upgradelink = $themeObject->DisplayImage('icons/system/true.gif', $this->ModLang('instance_uptodate'), '', '', 'systemicon');
		}
	}
}

#---------------------
# Smarty processing
#---------------------

$smarty->assign('modules', $modules);

$smarty->assign('startform', $this->CreateFormStart($id, 'admin_copymodule', $returnid));
$smarty->assign('endform',   $this->CreateFormEnd());
$smarty->assign('duplicate', $this->CreateInputSubmit($id, 'duplicate', $this->ModLang('duplicate')));

echo $this->ProcessTemplate('instancestab.tpl');

?>