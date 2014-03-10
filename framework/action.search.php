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

$template = 'search_'.$this->GetPreference($this->_GetModuleAlias() . '_default_search_template');
if(isset($params['template_search'])) {

	$template = 'search_'.$params['template_search'];
}
elseif(isset($params['searchtemplate'])) {

	$template = 'search_'.$params['searchtemplate'];
}

$summarypage = $this->GetPreference('summarypage', $returnid);
if(isset($params['summarypage'])) {

	if(is_numeric($params['summarypage'])) {
		$summarypage = $params['summarypage'];
	}
	else {
		if(!isset($hm))
			$hm = cmsms()->GetHierarchyManager();
		
		$summarypage = $hm->sureGetNodeByAlias($params['summarypage'])->GetId();
	}
}

$debug = (isset($params['debug']) ? true : false);

#---------------------
# Grap template
#---------------------

$template = $this->GetTemplate($template);

#---------------------
# Init fielddefs
#---------------------

if(stripos($template, '$fielddefs')) { // <- Load fielddefs only if we have variable request on template

	$filters = array();
	if(!empty($params['filter'])) {

		$filters = explode(',', $params['filter']);
	}

	$fielddefs = $this->GetFieldDefs($filters);
	foreach($fielddefs as $fielddef) {

		ListIt2FielddefOperations::LoadValuesForFieldDef($this, $fielddef);
	}

	$smarty->assign('fielddefs', $fielddefs);
	$smarty->assign('filterprompt', $this->ModLang('filterprompt', $this->GetPreference('item_plural', '')));
}

#---------------------
# Smarty processing
#---------------------

$smarty->assign('formstart', $this->CreateFormStart($id, 'default', $summarypage, 'post', 'multipart/form-data', false, '', $params));
$smarty->assign('formend', $this->CreateFormEnd());
$smarty->assign('modulealias', $this->_GetModuleAlias()); // Deprecated

echo $this->ProcessTemplateFromData($template);

if($debug) 
	$smarty->display('string:<pre>{$fielddefs|@print_r}</pre>');

?>
