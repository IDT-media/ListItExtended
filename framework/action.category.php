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

$query_object = $this->GetCategoryQuery($params);

Events::SendEvent($this->GetName(), 'PreRenderAction', array('action_name' => $name, 'query_object' => &$query_object));

#---------------------
# Init
#---------------------

//which template to use
$template = 'category_'.$this->GetPreference($this->_GetModuleAlias() . '_default_category_template');
if(isset($params['template_category'])) {
	$template = 'category_'.$params['template_category'];
}
elseif(isset($params['categorytemplate'])) {
	$template = 'category_'.$params['categorytemplate'];
}

$debug = (isset($params['debug']) ? true : false);
$inline = $this->GetPreference('display_inline', 0);

#---------------------
# Init items
#---------------------

$query_object->AppendTo(ListIt2Query::VARTYPE_WHERE, 'B.active = 1 AND B.parent_id = -1');
$dbr = $query_object->Execute(true);

$items = array();
while($dbr && !$dbr->EOF) {

	$items[$dbr->fields['category_id']] = $dbr->fields['category_id'];
	$dbr->MoveNext();
}

if($dbr) 
	$dbr->Close();	

#---------------------
# Build hierarchy
#---------------------

// Set collapse true/false
$showparents = array();
if (isset($params['collapse'])) {

	// Grap current path
	$current_path = cms_utils::get_app_data('listit2_id_hierarchy');

	if ($current_path) {
	
		$splitted_path = explode('.', $current_path);
		foreach($splitted_path as $path) {
		
			$showparents[] = $path;
		}
	}
}

$origdepth = 1;
$prevdepth = 1;
$count = 0;
$nodelist = array();

ListIt2HierarchyManager::GetChildNodes($this, $id, $returnid, $items, $nodelist, $count, $prevdepth, $origdepth, $params, $showparents);

#---------------------
# Smarty processing
#---------------------

$smarty->assign('categories', $nodelist);

echo $this->ProcessTemplateFromDatabase($template);

?>