<?php
if (!$this->CheckPermission($this->_GetModuleAlias() . '_modify_category')) return;

if(!isset($params['approve']) || !isset($params['category_id']))
{
	die('missing parameter, this should not happen');
}

$category_id = (int)$params['category_id'];
$active = (bool)$params['approve'];

$query = 'UPDATE ' . cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_category SET active = ? WHERE category_id = ?';
$db->Execute($query, array($active, $category_id));

$admintheme = cms_utils::get_theme_object();
$json = new stdClass;

if ($active) {

	$json->image = $admintheme->DisplayImage('icons/system/true.gif', $this->ModLang('revert'), '', '', 'systemicon');
	$json->href = $this->CreateLink($id, 'admin_approvecategory', $returnid, '', array('approve' => 0,'category_id' => $category_id), '', true);
} else {

	$json->image = $admintheme->DisplayImage('icons/system/false.gif', $this->ModLang('approve'), '', '', 'systemicon');
	$json->href = $this->CreateLink($id, 'admin_approvecategory', $returnid, '',array('approve' => 1,'category_id' => $category_id), '', true);
}

// Fix URL for JSON output
$json->href = html_entity_decode($json->href);

header("Content-type:application/json; charset=utf-8");

$handlers = ob_list_handlers(); 
for ($cnt = 0; $cnt < sizeof($handlers); $cnt++) { ob_end_clean(); }

echo json_encode($json);
exit();
?>