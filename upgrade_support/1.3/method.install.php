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

/*************************************************************************
 NOTE: Database stuff needs to be upgraded here, every time you change it
*************************************************************************/

if (!is_object(cmsms())) exit;

#---------------------
# Database tables
#---------------------

$dict = NewDataDictionary($db);
$taboptarray = array('mysql' => 'TYPE=MyISAM');

$db->Execute('ALTER TABLE ' . cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_fielddef_opts MODIFY value TEXT');

$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_fieldval', 'data X');
$dict->ExecuteSQLArray($sqlarray);	

// Create item_categories table
$fields = '
	item_id I KEY NOT null,
	category_id I KEY NOT null
';

$sqlarray = $dict->CreateTableSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item_categories', $fields, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

// Update category table
$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_category', 'hierarchy_path C(255)');
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_category', 'id_hierarchy C(255)');
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_category', 'active I4');
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_category', 'create_date DT');
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_category', 'modified_date DT');
$dict->ExecuteSQLArray($sqlarray);	

$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_category', 'key1 C(255)');
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_category', 'key2 C(255)');
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_category', 'key3 C(255)');
$dict->ExecuteSQLArray($sqlarray);

// Update item table
$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item', 'modified_time DT');
$dict->ExecuteSQLArray($sqlarray);	
	
$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item', 'key1 C(255)');
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item', 'key2 C(255)');
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item', 'key3 C(255)');
$dict->ExecuteSQLArray($sqlarray);	

$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item', 'owner I');
$dict->ExecuteSQLArray($sqlarray);

// Update fieldval table
$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_fieldval', 'value_index I NOT null');
$dict->ExecuteSQLArray($sqlarray);

$db->Execute('ALTER TABLE ' . cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_fieldval DROP PRIMARY KEY, ADD PRIMARY KEY(item_id, fielddef_id, value_index)');

// Update category positions
ListIt2CategoryOperations::UpdateHierarchyPositions($this);

#---------------------
# Templates
#---------------------	

$fn = cms_join_path(LISTIT2_TEMPLATE_PATH, 'fe_category_default.tpl');
if( file_exists( $fn ) ) {
	$template = @file_get_contents($fn);
	$this->SetTemplate('category_default', $template);
	$this->SetPreference($this->_GetModuleAlias() . '_default_category_template', 'default');
}

$fn = cms_join_path(LISTIT2_TEMPLATE_PATH, 'fe_category_hierarchy.tpl');
if( file_exists( $fn ) ) {
	$template = @file_get_contents($fn);
	$this->SetTemplate('category_hierarchy', $template);
}	

#---------------------
# Events
#---------------------

$this->CreateEvent('PreRenderAction');

#---------------------
# Permissions
#---------------------

$this->CreatePermission($this->_GetModuleAlias() . '_remove_item', $this->_GetModuleAlias() . ': Remove items');
$this->CreatePermission($this->_GetModuleAlias() . '_approve_item', $this->_GetModuleAlias() . ': Approve items');
$this->CreatePermission($this->_GetModuleAlias() . '_modify_all_item', $this->_GetModuleAlias() . ': Modify all items');

#---------------------
# Templates
#---------------------	

$templates = $this->ListTemplates(parent::GetName());
foreach ($templates as $tpl_name) {

	$tpl_content = $this->GetTemplate($tpl_name, parent::GetName());		
	$this->SetTemplate($tpl_name, $tpl_content);
}
