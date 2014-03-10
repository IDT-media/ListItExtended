<?php
if (!$this->CheckPermission($this->_GetModuleAlias() . '_modify_item')) return;

if(!isset($params['approve']) || !isset($params['item_id']))
{
	die('missing parameter, this should not happen');
}

$item_id = (int)$params['item_id'];
$active = (bool)$params['approve'];

$query = 'UPDATE ' . cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item SET active = ? WHERE item_id = ?';
$db->Execute($query, array($active, $item_id));

$handlers = ob_list_handlers(); 
for ($cnt = 0; $cnt < sizeof($handlers); $cnt++) { ob_end_clean(); }

$admintheme = cmsms()->get_variable('admintheme');
$json = new stdClass;

if ($active) {

	$json->image = $admintheme->DisplayImage('icons/system/true.gif', $this->ModLang('revert'), '', '', 'systemicon');
	$json->href = $this->CreateLink($id, 'admin_approveitem', $returnid, '', array('approve' => 0,'item_id' => $item_id), '', true);
} else {

	$json->image = $admintheme->DisplayImage('icons/system/false.gif', $this->ModLang('approve'), '', '', 'systemicon');
	$json->href = $this->CreateLink($id, 'admin_approveitem', $returnid, '',array('approve' => 1,'item_id' => $item_id), '', true);
}

// Fix URL for JSON output
$json->href = html_entity_decode($json->href);

header("Content-type:application/json; charset=utf-8");

$handlers = ob_list_handlers(); 
for ($cnt = 0; $cnt < sizeof($handlers); $cnt++) { ob_end_clean(); }

echo json_encode($json);
exit();
?>