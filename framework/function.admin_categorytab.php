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
# Init categories
#---------------------

if (!$this->CheckPermission($this->_GetModuleAlias() . '_modify_category')) 
	return;

$admintheme = cmsms()->get_variable('admintheme');

$query_object = new ListIt2CategoryQuery($this, $params);
$result = $query_object->Execute(true);

$items = array();
while ($result && $row = $result->FetchRow()) {

	$obj = $this->InitiateCategory();
	ListIt2CategoryOperations::Load($this, $obj, $row);
	
	//$obj->depth = count(explode('.', $obj->hierarchy)) - 1;
 
    // approve
    if ($obj->active) {
        $obj->approve = $this->CreateLink($id, 'admin_approvecategory', $returnid, $admintheme->DisplayImage('icons/system/true.gif', $this->ModLang('revert'), '', '', 'systemicon'), array(
            'approve' => 0,
            'category_id' => $row['category_id']
        ));
    } else {
        $obj->approve = $this->CreateLink($id, 'admin_approvecategory', $returnid, $admintheme->DisplayImage('icons/system/false.gif', $this->ModLang('approve'), '', '', 'systemicon'), array(
            'approve' => 1,
            'category_id' => $row['category_id']
        ));
    }
    
    // edit
    $obj->editlink = $this->CreateLink($id, 'admin_editcategory', $returnid, $admintheme->DisplayImage('icons/system/edit.gif', $this->ModLang('edit'), '', '', 'systemicon'), array(
        'category_id' => $row['category_id']
    ));
	
    $obj->name = $this->CreateLink($id, 'admin_editcategory', $returnid, $obj->name, array(
        'category_id' => $row['category_id']
    ));
	
	// delete
    $obj->delete = $this->CreateLink($id, 'admin_deletecategory', $returnid, $admintheme->DisplayImage('icons/system/delete.gif', $this->ModLang('delete'), '', '', 'systemicon'), array(
        'category_id' => $row['category_id']
    ));
	
	// select box
    $obj->select = $this->CreateInputCheckbox($id, 'categories[]', $row['category_id']);
	
	$items[] = $obj;
}

#---------------------
# Smarty processing
#---------------------

$smarty->assign('items', $items);
$smarty->assign('addlink', $this->CreateLink($id, 'admin_editcategory', $returnid, $admintheme->DisplayImage('icons/system/newobject.gif', $this->ModLang('add', $this->ModLang('category')), '', '', 'systemicon') .$this->ModLang('add', $this->ModLang('category'))));
$smarty->assign('reorderlink', $this->CreateLink($id, 'admin_reordercategory', $returnid, $admintheme->DisplayImage('icons/system/reorder.gif', $this->ModLang('reorder_categories'), '', '', 'systemicon') .$this->ModLang('reorder_categories')));
 
echo $this->ModProcessTemplate('categorytab.tpl');

?>