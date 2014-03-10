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

$sqlarray = $dict->DropTableSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item');
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->DropTableSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_fielddef');
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->DropTableSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_fielddef_opts');
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->DropTableSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_category'); // the only good cat is a dead cat
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->DropTableSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item_categories');
$dict->ExecuteSQLArray($sqlarray);

// DEPRECATED
$sqlarray = $dict->DropTableSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_template');
$dict->ExecuteSQLArray($sqlarray);

$sqlarray = $dict->DropTableSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_fieldval');
$dict->ExecuteSQLArray($sqlarray);

#---------------------
# Templates
#---------------------	

$this->DeleteTemplate();

#---------------------
# Preferences
#---------------------

$this->RemovePreference();

#---------------------
# Permissions
#---------------------

$this->RemovePermission($this->_GetModuleAlias() . '_modify_item');
$this->RemovePermission($this->_GetModuleAlias() . '_modify_category');
$this->RemovePermission($this->_GetModuleAlias() . '_modify_option');
$this->RemovePermission($this->_GetModuleAlias() . '_remove_item');
$this->RemovePermission($this->_GetModuleAlias() . '_approve_item');
$this->RemovePermission($this->_GetModuleAlias() . '_modify_all_item');

#---------------------
# Events
#---------------------

$this->RemoveEvent('PreItemSave');
$this->RemoveEvent('PostItemSave');

$this->RemoveEvent('PreItemDelete');
$this->RemoveEvent('PostItemDelete');

$this->RemoveEvent('PreItemLoad');
$this->RemoveEvent('PostItemLoad');

$this->RemoveEvent('PreRenderAction');

