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
 NOTE: Switch to use version_compare()
*************************************************************************/

if (!is_object(cmsms())) exit;

$taboptarray = array('mysql' => 'TYPE=MyISAM');
$dict = NewDataDictionary($db);

switch ($oldversion) {
	case '1.0 Beta' :
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_template', 'type C(255)');
		$dict->ExecuteSQLArray($sqlarray);
		$db->Execute('UPDATE ' . cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_template SET type = "summary"');

		$query = 'INSERT INTO ' . cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_template (name, content, type) VALUES(?, ?, ?)';
		$db->Execute($query, array('default', $this->GetTemplateFromFile('fe_detail_default'), 'detail'));
		$db->Execute($query, array('debug',  $this->GetTemplateFromFile('fe_detail_debug'), 'detail'));

		$this->SetPreference('url_prefix', munge_string_to_url($this->GetName(), true));

		$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item', 'alias C(255)');
		$dict->ExecuteSQLArray($sqlarray);

		$dbresult = $db->Execute('SELECT item_id, title FROM ' . cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item');
		while($dbresult && $row = $dbresult->FetchRow()) {
			$alias = munge_string_to_url($row['title'], true);
			$db->Execute('UPDATE ' . cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item SET alias = ? WHERE item_id = ?', array($alias, $row['item_id']));
		}

	case '1.0' :
		$query = 'INSERT INTO ' . cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_template (name, content, type) VALUES(?, ?, ?)';
		$db->Execute($query, array('accordion', $this->GetTemplateFromFile('fe_summary_accordion'), 'summary'));

		$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item', 'start_time D');
		$dict->ExecuteSQLArray($sqlarray);
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item', 'end_time D');
		$dict->ExecuteSQLArray($sqlarray);

	case '1.0.3':
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item', 'create_time DT');
		$dict->ExecuteSQLArray($sqlarray);
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_category', 'category_description X');
		$dict->ExecuteSQLArray($sqlarray);
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_category', 'parent_id I');
		$dict->ExecuteSQLArray($sqlarray);
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_category', 'hierarchy C(255)');
		$dict->ExecuteSQLArray($sqlarray);
		$db->Execute('UPDATE ' . cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_category SET parent_id = -1');
		
		ListIt2CategoryOperations::UpdateHierarchyPositions($this);
		
		$db->Execute($query, array('default', $this->GetTemplateFromFile('fe_search_default'), 'search'));
		$db->Execute($query, array('searchresults', $this->GetTemplateFromFile('fe_summary_searchresults'), 'summary'));
		$db->Execute($query, array('default', $this->GetTemplateFromFile('fe_filter_default'), 'filter'));

}

if( version_compare($oldversion, '1.2') < 0 ) {

	// Modify databae
	$db->Execute('ALTER TABLE ' . cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_fielddef MODIFY extra TEXT');
	
	// Set preferences
	$this->SetPreference('sortorder', 'ASC');
    $this->SetPreference('adminsection', 'content');

	$this->SetPreference($this->_GetModuleAlias() . 'default_summary_template', 'default');
	$this->SetPreference($this->_GetModuleAlias() . 'default_detail_template', 'default');
	$this->SetPreference($this->_GetModuleAlias() . 'default_filter_template', 'default');
	$this->SetPreference($this->_GetModuleAlias() . 'default_search_template', 'default');
    $this->SetPreference($this->_GetModuleAlias() . '_default_category', '1');
	
	// Updating from old template types
	$query = "SELECT * FROM " . cms_db_prefix() . "module_" . $this->_GetModuleAlias() . "_template";
	$dbr = $db->Execute($query);
	
	while($dbr && $row = $dbr->FetchRow()){
	
		$this->SetTemplate($row['type'] . '_' . $row['name'], $row['content']);
		if($row['tpl_default']) {
		
			$this->SetPreference($this->_GetModuleAlias() . '_default_'.$row['type'].'_template', $row['name']);
		}
	}
	
} // end of 1.1 -> 1.2 upgrade

if( version_compare($oldversion, '1.3') < 0 ) {

	// create fielddef options table
	$fields = '
		fielddef_id I KEY,
		name C(255) KEY,
		value C(255)
	';

	$sqlarray = $dict->CreateTableSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_fielddef_opts', $fields, $taboptarray);
	$dict->ExecuteSQLArray($sqlarray);
	
	// create events
	$this->CreateEvent('PreItemSave');
	$this->CreateEvent('PostItemSave');

	$this->CreateEvent('PreItemDelete');
	$this->CreateEvent('PostItemDelete');

	$this->CreateEvent('PreItemLoad');
	$this->CreateEvent('PostItemLoad');	
	
} // end of 1.2.2 -> 1.3 upgrade

if( version_compare($oldversion, '1.3.2') < 0 ) {

	// Modify databae
	$db->Execute('ALTER TABLE ' . cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_fielddef_opts MODIFY value TEXT');
	
	$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_fieldval', 'data X');
	$dict->ExecuteSQLArray($sqlarray);	
	
} // end of 1.3 -> 1.3.2 upgrade

if( version_compare($oldversion, '1.4-beta1') < 0 ) {

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
	
	// Update fieldval table
	$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_fieldval', 'value_index I NOT null');
	$dict->ExecuteSQLArray($sqlarray);
	
	$db->Execute('ALTER TABLE ' . cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_fieldval DROP PRIMARY KEY, ADD PRIMARY KEY(item_id, fielddef_id, value_index)');	

	// Update category positions
	ListIt2CategoryOperations::UpdateHierarchyPositions($this);
	
	// Update templates
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

	// Update events
	$this->CreateEvent('PreRenderAction');
	
	// Update item categories
	$query = 'SELECT item_id, category_id FROM ' . cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item';
	$dbr = $db->Execute($query);

	while($dbr && $row = $dbr->FetchRow()) {

		$query = 'INSERT INTO ' . cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item_categories (item_id, category_id) VALUES (?, ?)';
		$db->Execute($query, array($row['item_id'], $row['category_id']));
	}	
	
} // end of 1.3.2 -> 1.4-beta1 upgrade

if( version_compare($oldversion, '1.4-beta2') < 0 ) {
	
	// Update item table
	$sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item', 'owner I');
	$dict->ExecuteSQLArray($sqlarray);

	// Update permissions
	$this->CreatePermission($this->_GetModuleAlias() . '_remove_item', $this->_GetModuleAlias() . ': Remove items');
	$this->CreatePermission($this->_GetModuleAlias() . '_approve_item', $this->_GetModuleAlias() . ': Approve items');
	$this->CreatePermission($this->_GetModuleAlias() . '_modify_all_item', $this->_GetModuleAlias() . ': Modify all items');	

} // end of 1.4-beta1 -> 1.4-beta2 upgrade

if( version_compare($oldversion, '1.4.1') < 0 ) {
	
	// Archive templates
	$fn = cms_join_path(LISTIT2_TEMPLATE_PATH, 'fe_archive_default.tpl');
	if( file_exists( $fn ) ) {
		$template = @file_get_contents($fn);
		$this->SetTemplate('archive_default', $template);
		$this->SetPreference($this->_GetModuleAlias() . '_default_archive_template', 'default');
	}

} // end of 1.4 -> 1.4.1 upgrade