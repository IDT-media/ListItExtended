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
# Some wackos started destroying stuff since 2012: 
#
# Tapio Löytty, <tapsa@orange-media.fi>
# Web: www.orange-media.fi
#
# Goran Ilic, <uniqu3e@gmail.com>
# Web: www.ich-mach-das.at
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
# Init objects
#---------------------

$item_query = $this->GetItemQuery($params);

Events::SendEvent($this->GetName(), 'PreRenderAction', array('action_name' => $name, 'query_object' => &$item_query));

#---------------------
# Check params
#---------------------

//which template to use
$summarytemplate = 'summary_'.$this->GetPreference($this->_GetModuleAlias() . '_default_summary_template');
if(isset($params['template_summary'])) {
	$summarytemplate = 'summary_'.$params['template_summary'];
}
elseif(isset($params['summarytemplate'])) {
	$summarytemplate = 'summary_'.$params['summarytemplate'];
}

// Detail page check
$detailpage = $this->GetPreference('detailpage', $returnid);
if(isset($params['detailpage'])) {

	if(is_numeric($params['detailpage'])) {
		$detailpage = $params['detailpage'];
	}
	else {
		if(!isset($hm))
			$hm = cmsms()->GetHierarchyManager();
		
		$detailpage = $hm->sureGetNodeByAlias($params['detailpage'])->GetId();
	}
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

$debug = (isset($params['debug']) ? true : false);
$inline = $this->GetPreference('display_inline', 0);

#---------------------
# Init items
#---------------------

$item_query->AppendTo(ListIt2Query::VARTYPE_WHERE, 'A.active = 1');
$result = $item_query->Execute(true);

$items = array();
while($result && $row = $result->FetchRow()) {

	if(!isset($this->_item_cache[$row['item_id']])) {
		
		$cache = $this->InitiateItem();
		ListIt2ItemOperations::Load($this, $cache, $row);	

		$this->_item_cache[] = $cache;
	}

	$obj = clone $this->_item_cache[$row['item_id']];
	
	$linkparams = array();
	$linkparams['item'] 			= $obj->alias;
	
	listit2_utils::clean_params($params, array('returnid'));
	$linkparams = array_merge($linkparams, $params);	
	
	$obj->url = $this->CreatePrettyLink($id, 'detail', $detailpage, '', $linkparams, '', true, $inline);	
	
	$items[$row['item_id']] = $obj;	
}

#---------------------
# Smarty processing
#---------------------

$pagenumber = $item_query->GetPageNumber();
$pagecount = $item_query->GetPageCount();

// Assign some pagination variables to smarty
if($pagenumber == 1) {

	$smarty->assign('prevpage',$this->ModLang('prevpage'));
	$smarty->assign('firstpage',$this->ModLang('firstpage'));
} else {

	$params['pagenumber'] = $pagenumber-1;
	$smarty->assign('prevpage', $this->CreatePrettyLink($id, 'default', $summarypage, $this->ModLang('prevpage'),$params, '', false, $inline));
	$smarty->assign('prevurl', $this->CreatePrettyLink($id, 'default', $summarypage,'', $params, '', true, $inline));
	$params['pagenumber'] = 1;
	$smarty->assign('firstpage', $this->CreatePrettyLink($id, 'default', $summarypage, $this->ModLang('firstpage'),$params, '', false, $inline));
	$smarty->assign('firsturl', $this->CreatePrettyLink($id, 'default', $summarypage,'', $params, '', true, $inline));
}

if($pagenumber >= $pagecount) {

	$smarty->assign('nextpage',$this->ModLang('nextpage'));
	$smarty->assign('lastpage',$this->ModLang('lastpage'));
} else {

	$params['pagenumber'] = $pagenumber+1;
	$smarty->assign('nextpage', $this->CreatePrettyLink($id, 'default', $summarypage, $this->ModLang('nextpage'), $params, '', false, $inline));
	$smarty->assign('nexturl', $this->CreatePrettyLink($id, 'default', $summarypage, '', $params, '', true, $inline));
	$params['pagenumber']=$pagecount;
	$smarty->assign('lastpage', $this->CreatePrettyLink($id, 'default', $summarypage, $this->ModLang('lastpage'), $params, '', false, $inline));
	$smarty->assign('lasturl', $this->CreatePrettyLink($id, 'default', $summarypage, '', $params, '', true, $inline));
}

$smarty->assign('pagenumber',$pagenumber);
$smarty->assign('pagecount',$pagecount);

$pagelinks = array();
while($pagecount) {

	$obj = new stdClass();

	$params['pagenumber'] = $pagecount;
	$obj->link = $this->CreatePrettyLink($id, 'default', $summarypage, $pagecount, $params, '', false, $inline);
	$obj->url = $this->CreatePrettyLink($id, 'default', $summarypage, '', $params, '', true, $inline);
	
	$pagelinks[$pagecount] = $obj;
	$pagecount--;
}

$pagelinks = array_reverse($pagelinks, true);

$smarty->assign('pagelinks', $pagelinks);
$smarty->assign('items', $items);
$smarty->assign($this->GetName() .'_items', $items); // <- Alias for $items

echo $this->ProcessTemplateFromDatabase($summarytemplate);

if($debug) 
	$smarty->display('string:<pre>{$items|@print_r}</pre>');

?>
