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

if (!isset($params['item'])) {
    die('missing parameter, this should not happen');
}

$template = 'detail_'.$this->GetPreference($this->_GetModuleAlias() . '_default_detail_template');
if (isset($params['template_detail'])) {

	$template = 'detail_'.$params['template_detail'];
}
elseif (isset($params['detailtemplate'])) {

	$template = 'detail_'.$params['detailtemplate'];
}

if(isset($params['item'])) {
	cms_utils::set_app_data('listit2_item', $params['item']);
}	

// Summary page check
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

$identifier = is_numeric($params['item']) ? 'item_id' : 'alias';
$debug = (isset($params['debug']) ? true : false);

#---------------------
# Init item
#---------------------

$item = $this->LoadItemByIdentifier($identifier, $params['item']);

#---------------------
# Smarty processing
#---------------------

$smarty->assign('item', $item);
$smarty->assign($this->GetName() . '_item', $item); // <- Alias for $item

$smarty->assign('return_url', $this->CreatePrettyLink($id, 'default', $summarypage, '', $params, '', true));
$smarty->assign('return_link', $this->CreatePrettyLink($id, 'default', $summarypage, $this->ModLang('return_url'), $params)); 

echo $this->ProcessTemplateFromDatabase($template);

if($debug) 
	$smarty->display('string:<pre>{$item|@print_r}</pre>');

?>