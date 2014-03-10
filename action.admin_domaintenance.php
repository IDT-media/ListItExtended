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
$parms = array('active_tab' => 'maintenancetab');

#---------------------
# Fix fielddef tables
#---------------------

if(isset($params['fix_fielddefs'])) {

	$type_map = array(
			'textbox' => 'TextInput',
			'dropdown' => 'Dropdown',
			'hierarchy' => 'ContentPages',
			'checkbox' => 'Checkbox',
			'textarea' => 'TextArea',
			'gallery' => 'GalleryDropdown',
			'select_date' => 'SelectDate',
			'upload_file' => 'GBFilePicker',
			'select_file' => 'SelectFile'
	);

	$modules = $this->ListModules();
	
	foreach($modules as $module) {

		$mod = cmsms()->GetModuleInstance($module->module_name);
		
		if(is_object($mod)) {
			
			foreach($type_map as $old_type=>$new_type) {

				$query  = 'UPDATE ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_fielddef SET type = ? WHERE type = ?';
				$result = $db->Execute($query, array($new_type, $old_type));
			}
		}
	}
	
	$parms['message'] = 'message_fielddefs_fixed';
}

#---------------------
# Redirect
#---------------------

$this->Redirect($id, 'defaultadmin', $returnid, $parms);

?>