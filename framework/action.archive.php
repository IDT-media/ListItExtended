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

$query = $this->GetArchiveQuery($params);

Events::SendEvent($this->GetName(), 'PreRenderAction', array('action_name' => $name, 'query_object' => &$query));

#---------------------
# Check params
#---------------------

//which template to use
$archivetemplate = 'archive_'.$this->GetPreference($this->_GetModuleAlias() . '_default_archive_template');
if(isset($params['template_archive'])) {
	$archivetemplate = 'archive_'.$params['template_archive'];
}
elseif(isset($params['archivetemplate'])) {
	$archivetemplate = 'archive_'.$params['template_archive'];
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

$query->AppendTo(ListIt2Query::VARTYPE_WHERE, 'A.active = 1');
$result = $query->Execute(true);

$items = array();
while($result && $row = $result->FetchRow()) {

	$onerow = new stdClass;
	$onerow->month 					= $row['month'];
	$onerow->year 					= $row['year'];
	$onerow->count 					= $row['count'];
	$onerow->timestamp 				= mktime(0,0,0,$row['month'],1,$row['year']);
	
	$linkparams = array();
	$linkparams['filter_year'] 		= $onerow->year;
	$linkparams['filter_month'] 	= $onerow->month;
	
	listit2_utils::clean_params($params, array('returnid'));
	$linkparams = array_merge($linkparams, $params);

	$onerow->url = $this->CreatePrettyLink($id, 'default', $summarypage, '', $linkparams, '', true, $inline);

	$items[] = $onerow;
}

#---------------------
# Smarty processing
#---------------------

$smarty->assign('archives', $items);
$smarty->assign($this->GetName() .'_archives', $items); // <- Alias for $archives

echo $this->ProcessTemplateFromDatabase($archivetemplate);

if($debug) 
	$smarty->display('string:<pre>{$archives|@print_r}</pre>');

?>
