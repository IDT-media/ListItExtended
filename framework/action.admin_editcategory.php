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
if (!$this->CheckPermission($this->_GetModuleAlias() . '_modify_category')) return;

#---------------------
# Check params
#---------------------

if (isset($params['cancel'])) {

    $params = array('active_tab' => 'categorytab');
    $this->Redirect($id, 'defaultadmin', $returnid, $params);
}

#---------------------
# Init params
#---------------------

$category_id      			= listit2_utils::init_var('category_id', $params, -1);
$name       			 	= listit2_utils::init_var('name', $params, '');
$alias		 			 	= listit2_utils::init_var('alias', $params, '');
$description				= listit2_utils::init_var('description', $params, '');
$parent_id 				 	= listit2_utils::init_var('parent_id', $params, -1);
$active      			 	= 1;

#---------------------
# Init Item
#---------------------

$obj = $this->LoadCategoryByIdentifier('category_id', $category_id);

#---------------------
# Submit
#---------------------

if (isset($params['submit']) || isset($params['apply']) || isset($params['save_create'])) {

	$errors = array();

    // check category name
    if ($name == '') {
        $errors[] = $this->ModLang('category_name_empty');
    }

    // check alias
/*    if (!listit2_utils::is_valid_alias($alias) && !empty($alias)) {
        $errors[] = $this->ModLang('alias_invalid');
    }*/
	
	// Check for duplicate
	$parms = array();
	$query = 'SELECT * FROM ' . cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_category WHERE category_alias = ?';
	$parms[] = $alias;

	if($category_id > 0){
		$query .= ' AND category_id != ?';
		$parms[] = $category_id;
	}
	
	$exists = $db->GetOne($query, $parms);

    if ($exists) {
        $errors[] = $this->ModLang('category_alias_exists');
    }	

	// title and required fields have values, let's continue
	if (empty($errors)) {
	
		$obj->name        	= $name;
		$obj->alias		 	= $alias;
		$obj->description	= $description;
		$obj->parent_id 	= $parent_id;		
		$obj->active       	= isset($params['active']) ? 1 : 0;
		
		$this->SaveCategory($obj);
		
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
			$this->Redirect($id, 'admin_editcategory', $returnid, array(
				'message' => 'savecreate_message'
			));
		}  		    

		// show saved message
		if (isset($params['submit'])) {
			$this->Redirect($id, 'defaultadmin', $returnid, array(
				'active_tab' => 'categorytab',
				'message' => 'changessaved'
			));
			
		} else {
			echo $this->ShowMessage($this->ModLang('changessaved'));
		}
		
	} // end error check
	
} // end submit or apply
elseif($obj->category_id > 0) {

	$category_id 	= $obj->category_id;	
	$name 			= $obj->name;
	$alias		  	= $obj->alias;
	$description	= $obj->description;
	$parent_id 		= $obj->parent_id;
	$active       	= $obj->active;
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

$smarty->assign('categoryObject', $obj);

$smarty->assign('backlink', $this->CreateBackLink('categorytab'));
$smarty->assign('title',     (isset($category_id) ? $this->ModLang('edit_category') : $this->ModLang('add', $this->ModLang('category'))));

$smarty->assign('startform', $this->CreateFormStart($id, 'admin_editcategory', $returnid, 'post', 'multipart/form-data', false, '', $params));
$smarty->assign('endform', $this->CreateFormEnd());

$smarty->assign('input_category',  $this->CreateInputText($id, 'name', $name, 20));
$smarty->assign('input_alias', $this->CreateInputText($id, 'alias', $alias, 20, 255));
$smarty->assign('input_category_description', $this->CreateTextArea(true, $id, $description, 'description', '', '', '', '', '80', '3'));
$smarty->assign('input_active', $this->CreateInputcheckbox($id, 'active', 1, $active));

$smarty->assign('input_parent', $this->CreateInputDropdown($id, 'parent_id', ListIt2CategoryOperations::GetHierarchyList($this, true, $category_id), -1, $parent_id));
/*
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$smarty->assign('apply', $this->CreateInputSubmit($id, 'apply', lang('apply')));
$smarty->assign('save_create', $this->CreateInputSubmit($id, 'save_create', $this->ModLang('save_create')));
$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));
*/
echo $this->ModProcessTemplate('editcategory.tpl');

?>