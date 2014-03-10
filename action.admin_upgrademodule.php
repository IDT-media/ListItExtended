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

if (!$this->CheckPermission($this->_GetModuleAlias() . '_modify_option')) return;

if (!isset($params['module_id']))
	throw new ListIt2Exception('Missing parameter, this should not happen!');

$GLOBALS['CMS_FORCE_MODULE_LOAD'] = 1;

$modops = cmsms()->GetModuleOperations();
$modules = $this->ListModules();
$modname = $modules[$params['module_id']]->module_name;

$modops->UpgradeModule($modname);

// all done
$this->Redirect($id, 'defaultadmin', $returnid, array('active_tab' => 'instancestab', 'message' => 'instance_moduleupgraded'));

?>