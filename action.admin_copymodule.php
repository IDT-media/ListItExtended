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
# Check params
#---------------------

if (isset($params['cancel'])) {

    $params = array('active_tab' => 'instancestab');
    $this->Redirect($id, 'defaultadmin', $returnid, $params);
}

$module_name = '';
if(isset($params['module_name'])) {

	$module_name = $params['module_name'];
}

$invalid_names = array('listit2', 'original', 'xdefs', 'loader');
$modules = $this->ListModules();
foreach($modules as $mod) {

	$mod->module_name = substr($mod->module_name, strlen(ListIt2Duplicator::MOD_PREFIX));
	$invalid_names[] = strtolower($mod->module_name);
}

#---------------------
# Submit
#---------------------

if (isset($params['submit'])) {

	$errors = array();
	
	if(empty($module_name)) {
	
		$errors[] = $this->ModLang('module_name_empty');
	}
	
	if(preg_match('/[^0-9a-zA-Z]/', $module_name)) {
	
		$errors[] = $this->ModLang('module_name_invalid');
	}
	
	if(in_array(strtolower($module_name), $invalid_names)) {
	
		$errors[] = $this->ModLang('module_name_invalid');
	}	

	if (empty($errors)) {
	
		$duplicator = new ListIt2Duplicator($module_name);
		$module_fullname = $duplicator->Run();
		
		if($this->GetPreference('allow_autoinstall')) {
		
			$modops = cmsms()->GetModuleOperations();
			$modops->InstallModule($module_fullname);
		}
		
		$params = array('message' => 'modulecopied','active_tab' => 'instancestab');
		$this->Redirect($id, 'defaultadmin', '', $params);  
	}
}

#---------------------
# Error handling
#---------------------

if (!empty($errors)) {

    echo $this->ShowErrors($errors);
}

#---------------------
# Smarty processing
#---------------------

$smarty->assign('startform', $this->CreateFormStart ($id, 'admin_copymodule', $returnid, 'post', 'multipart/form-data', false, '', $params));
$smarty->assign('endform', $this->CreateFormEnd());

$smarty->assign('input_module_name', $this->CreateInputText($id, 'module_name', $module_name, 40));

$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));

echo $this->ProcessTemplate('copymodule.tpl');

?>