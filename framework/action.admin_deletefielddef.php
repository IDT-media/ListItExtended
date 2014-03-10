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

$fielddefs = array();
if(isset($params['fielddef_id'])) {
	$fielddefs = array((int)$params['fielddef_id']);
}
if(isset($params['fielddefs']) && is_array($params['fielddefs'])) {
	$fielddefs = $params['fielddefs'];
}

foreach ($fielddefs as $fielddef_id) {

	ListIt2FielddefOperations::Delete($this, $fielddef_id);	
}

$handlers = ob_list_handlers(); 
for ($cnt = 0; $cnt < sizeof($handlers); $cnt++) { ob_end_clean(); }

echo $this->ModLang('deleted');
exit();
?>