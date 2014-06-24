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
if (!$this->CheckPermission($this->_GetModuleAlias() . '_modify_item')) return;

#---------------------
# Check params
#---------------------

if (isset($params['cancel'])) {

	listit2_utils::clean_params($params, array('page'), true);
	$params['active_tab'] = 'itemtab';
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
}

#---------------------
# Init params
#---------------------

$mode	      				= listit2_utils::init_var('mode', $params, 'edit');
$item_id      				= listit2_utils::init_var('item_id', $params, -1);
$title       			 	= listit2_utils::init_var('title', $params, '');
$alias		 			 	= listit2_utils::init_var('alias', $params, '');
$time_control 				= listit2_utils::init_var('time_control', $params, 0);
$active      			 	= 1;

$start_time = '';
$end_time = '';
if ($time_control) {
	$start_time = $params['start_time'];
	$end_time   = $params['end_time'];
}

#---------------------
# Init Item
#---------------------

$obj = $this->LoadItemByIdentifier('item_id', $item_id);
if($mode == 'copy')	
	$obj = ListIt2ItemOperations::Copy($obj);

#---------------------
# Handle custom fields
#---------------------

if (isset($params['customfield'])) {

	foreach ((array)$params['customfield'] as $fldid => $value) {
	
		if(isset($obj->fielddefs[$fldid]))
			$obj->fielddefs[$fldid]->SetValue($value);
	}
}

#---------------------
# Submit
#---------------------

if (isset($params['submit']) || isset($params['apply']) || isset($params['save_create'])) {

	$errors = array();
	
	// check title
	if (empty($title)) {
	
		$errors[] = $this->ModLang('item_title_empty');
	}
/*	
    // check alias
    if (!listit2_utils::is_valid_alias($alias) && !empty($alias)) {
        $errors[] = $this->ModLang('alias_invalid');
    }
*/	
	// Check for duplicate
    if ($item_id > 0) {
	
        $query = 'SELECT item_id FROM ' . cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item WHERE alias = ? AND item_id != ?';
        $exists = $db->GetOne($query, array($alias, $item_id));
    } else {	
	
        $query = 'SELECT item_id FROM ' . cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item WHERE alias = ?';
        $exists = $db->GetOne($query, array($alias));
    }	

    if ($exists) {
        $errors[] = $this->ModLang('item_alias_exists');
    }	

	// check if start date is less end date
	if ($time_control && $start_time && $end_time && strtotime($start_time) > strtotime($end_time)) {
	
		$errors[] = $this->ModLang('error_startgreaterend');
	}
	
	// PreProcess & Validations
	foreach($obj->fielddefs as $field) {
	
		$field->EventHandler()->ItemSavePreProcess($errors, $params);
	}
	
	// title and required fields have values, let's continue
	if (empty($errors)) {
	
		$obj->title        	= $title;
		$obj->alias		 	= $alias;
		$obj->active       	= isset($params['active']) ? 1 : 0;
		$obj->start_time   	= $start_time;
		$obj->end_time     	= $end_time;
		//$obj->categories	= $categories;
		//$obj->category_id = $category_id;
				
		// Save item to database
		$this->SaveItem($obj);
		
		// PostProcess
		foreach($obj->fielddefs as $field) {
		
			$field->EventHandler()->ItemSavePostProcess($errors, $params);
		}

		// if apply and ajax           
		if (isset($params['apply']) && isset($params['ajax'])) {
			$response = '<EditItem>';
			$response .= '<Response>Success</Response>';
			$response .= '<Details><![CDATA[' . $this->ModLang('changessaved') . ']]></Details>';               
			$response .= '</EditItem>';
			echo $response;
			return;
		} 
		
		// if save and create new
		if (isset($params['save_create']) ) {
			$this->Redirect($id, 'admin_edititem', $returnid, array(
				'message' => 'savecreate_message'
			));
		}  		    

		// show saved message
		if (isset($params['submit'])) {
		
			listit2_utils::clean_params($params, array('page'), true);
			$params['active_tab'] = 'itemtab';
			$params['message'] = 'changessaved';
			$this->Redirect($id, 'defaultadmin', $returnid, $params);
			
		} else {
			echo $this->ShowMessage($this->ModLang('changessaved'));
		}
		
	} // end error check
	
} // end submit or apply
elseif($obj->item_id > 0 || $mode == 'copy') {

	$item_id		= $obj->item_id;
	$title 			= $obj->title;
	$alias		  	= $obj->alias;
	$active       	= $obj->active;
	$start_time   	= $obj->start_time;
	$end_time     	= $obj->end_time;
	
	if(!empty($start_time)|| !empty($end_time)) {
		$time_control = 1;
	}
	//$categories	= $obj->categories;
	//$category_id 	= $obj->category_id;
}

#---------------------
# Message control
#---------------------

// display errors if there are any
if (!empty($errors)) {
    if (isset($params['apply']) && isset($params['ajax'])) {
        $response = '<EditItem>';
        $response .= '<Response>Error</Response>';
        $response .= '<Details><![CDATA[';
        foreach ($errors as $error) {
            $response .= '<li>' . $error . '</li>';
        }
        $response .= ']]></Details>';
        $response .= '</EditItem>';
        echo $response;
        return;
    } else {
        echo $this->ShowErrors($errors);
    }
}

if(isset($params['message']) && empty($errors)) 
    echo $this->ShowMessage($this->ModLang('changessaved_create'));

#---------------------
# Smarty processing
#---------------------

$smarty->assign('itemObject', $obj);

$smarty->assign('backlink', $this->CreateBackLink('itemtab'));
$smarty->assign('title', ($item_id > 0 ? $this->ModLang('edit') . ' ' . $this->GetPreference('item_singular', '') : $this->ModLang('add', $this->GetPreference('item_singular', ''))));
$smarty->assign('startform', $this->CreateFormStart($id, 'admin_edititem', $returnid, 'post', 'multipart/form-data', false, '', $params));
$smarty->assign('endform', $this->CreateFormEnd());

$smarty->assign('input_title', $this->CreateInputText($id, 'title', $title, 50));
$smarty->assign('input_alias', $this->CreateInputText($id, 'alias', $alias, 50));
$smarty->assign('input_time_control', $this->CreateInputcheckbox($id, 'time_control', 1, $time_control, 'onclick="togglecollapse(\'expiryinfo\');"'));
$smarty->assign('use_time_control', $time_control);
$smarty->assign('input_start_time', $this->CreateInputText($id, 'start_time', $start_time, 20));
$smarty->assign('input_end_time', $this->CreateInputText($id, 'end_time', $end_time, 20));

if($this->CheckPermission($this->_GetModuleAlias() . '_approve_item'))
	$smarty->assign('input_active', $this->CreateInputcheckbox($id, 'active', 1, $active));

/*
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$smarty->assign('apply', $this->CreateInputSubmit($id, 'apply', lang('apply')));
$smarty->assign('save_create', $this->CreateInputSubmit($id, 'save_create', $this->ModLang('save_create')));
$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));
*/

echo $this->ModProcessTemplate('edititem.tpl');

?>