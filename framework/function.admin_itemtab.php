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
# Tapio L�ytty, <tapsa@orange-media.fi>
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

if (!$this->CheckPermission($this->_GetModuleAlias() . '_modify_item'))
    return;

#---------------------
# Check Preferences
#---------------------

$singular         	= $this->GetPreference('item_singular', '');
$plural           	= $this->GetPreference('item_plural', '');
$fields           	= explode(',', $this->GetPreference('item_cols', ''));
$limit            	= $this->GetPreference('items_per_page', 20);
$dateformat       	= trim(get_preference(get_userid(),'date_format_string','%Y-%m-%d'));

if(empty($dateformat)) 
	$dateformat = '%Y-%m-%d';

#---------------------
# Init items
#---------------------	
	
$params['pagelimit'] 			= $limit;
$params['showall'] 				= true;	// <- To disable time control queries
$item_query = new ListIt2ItemQuery($this, $params);

if(!$this->CheckPermission($this->_GetModuleAlias() . '_modify_all_item')) {

	$item_query->AppendTo(ListIt2Query::VARTYPE_WHERE, 'A.owner = ?');
	$item_query->AppendTo(ListIt2Query::VARTYPE_QPARAMS, get_userid(false));
}

$result = $item_query->Execute(true);

$page = $item_query->GetPageNumber();
$totalcount = $item_query->TotalCount();

$items = array();
while ($result && $row = $result->FetchRow()) {

	$obj = $this->InitiateItem($fields);
	ListIt2ItemOperations::Load($this, $obj, $row);	
    
	// Check if we need to show any fields
    if (count($fields) > 0) {
		
		// Check static
		if (!in_array('alias', $fields)) {
			unset($obj->alias);
		}
		
		if (!in_array('create_time', $fields)) {
			unset($obj->create_time);
		} else {
			$obj->create_time = strftime($dateformat, strtotime($obj->create_time));
		}
		
		if (!in_array('modified_time', $fields)) {
			unset($obj->modified_time);
		} else {
			$obj->modified_time = strftime($dateformat, strtotime($obj->modified_time));
		}		
		
		if (in_array('start_time', $fields)) {
			$obj->start_time = !empty($obj->start_time) ? strftime($dateformat, strtotime($obj->start_time)) : '';
		}
		
		if (in_array('end_time', $fields)) {
			$obj->end_time = !empty($obj->end_time) ? strftime($dateformat, strtotime($obj->end_time)) : '';
		}			
    }
   
  	// approve
	if($this->CheckPermission($this->_GetModuleAlias() . '_approve_item')) {
	
		if ($obj->active) {
			$obj->approve = $this->CreateLink($id, 'admin_approveitem', $returnid, $admintheme->DisplayImage('icons/system/true.gif', $this->ModLang('revert'), '', '', 'systemicon'), array(
				'approve' => 0,
				'item_id' => $row['item_id']
			));
		} else {
			$obj->approve = $this->CreateLink($id, 'admin_approveitem', $returnid, $admintheme->DisplayImage('icons/system/false.gif', $this->ModLang('approve'), '', '', 'systemicon'), array(
				'approve' => 1,
				'item_id' => $row['item_id']
			));
		}
	}
    
	$linkparams = array();
	$linkparams['item_id'] = $row['item_id'];
	
	listit2_utils::clean_params($params, array('page'), true);
	$linkparams = array_merge($linkparams, $params);	
	
    // edit
    $obj->editlink = $this->CreateLink($id, 'admin_edititem', $returnid, $admintheme->DisplayImage('icons/system/edit.gif', $this->ModLang('edit'), '', '', 'systemicon'), $linkparams);
    $obj->title = $this->CreateLink($id, 'admin_edititem', $returnid, $obj->title, $linkparams);	
	
	$linkparams['mode'] = 'copy';
	
    // copy
    $obj->copylink = $this->CreateLink($id, 'admin_edititem', $returnid, $admintheme->DisplayImage('icons/system/copy.gif', $this->ModLang('copy'), '', '', 'systemicon'), $linkparams);	
	
	// delete
	if($this->CheckPermission($this->_GetModuleAlias() . '_remove_item')) {
	
		$obj->delete = $this->CreateLink($id, 'admin_deleteitem', $returnid, $admintheme->DisplayImage('icons/system/delete.gif', $this->ModLang('delete'), '', '', 'systemicon'), array(
			'item_id' => $row['item_id']
		));
	}
	
	// select box
    $obj->select = $this->CreateInputCheckbox($id, 'items[]', $row['item_id']);
	
	$items[] = $obj;
}

#---------------------
# Smarty processing
#---------------------

$smarty->assign('items', $items);
$smarty->assign('pagination', $this->CreatePagination($id, '', '', $page, $totalcount, $limit));
$smarty->assign('title', $this->GetPreference('item_singular', ''));
$smarty->assign('title_plural', $this->GetPreference('item_plural', ''));

$smarty->assign('submitorder', $this->CreateInputSubmit($id, 'submit_itemorder', $this->ModLang('submit_order')));
$smarty->assign('addlink', $this->CreateLink($id, 'admin_edititem', $returnid, $admintheme->DisplayImage('icons/system/newobject.gif', $this->ModLang('add', $singular), '', '', 'systemicon') . 
	$this->ModLang('add', $singular)));

if($this->CheckPermission($this->_GetModuleAlias() . '_modify_all_item')) {
	
	$smarty->assign('exportlink', $this->CreateLink($id, 'admin_exportitems', $returnid, $admintheme->DisplayImage('icons/system/export.gif', $this->ModLang('export', $singular), '', '', 'systemicon') . 
		$this->ModLang('export', $plural)));
	$smarty->assign('importlink', $this->CreateLink($id, 'admin_importitems', $returnid, $admintheme->DisplayImage('icons/system/import.gif', $this->ModLang('import', $singular), '', '', 'systemicon') . 
		$this->ModLang('import', $plural)));	
}	
	
echo $this->ModProcessTemplate('itemtab.tpl');

?>
