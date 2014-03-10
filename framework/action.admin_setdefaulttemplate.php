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

if (!$this->CheckPermission($this->_GetModuleAlias() . '_modify_options'))
    return;

if (!isset($params['name'])) {
    die('missing parameter, this should not happen');
}

list($tpl_type, $tpl_name) = explode('_', $params['name'], 2);

// set default template preference
$this->SetPreference($this->_GetModuleAlias() . '_default_'.$tpl_type.'_template', $tpl_name);

// all done
$this->Redirect($id, 'defaultadmin', $returnid, array('active_tab' => 'templatetab'));
?>