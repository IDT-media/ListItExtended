<?php
if (!$this->CheckPermission($this->_GetModuleAlias() . '_modify_options')) return;

if(!isset($params['require']) || !isset($params['fielddef_id']))
{
	die('missing parameter, this should not happen');
}

$fielddef_id = (int)$params['fielddef_id'];
$required = (bool)$params['require'];

$query = 'UPDATE ' . cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_fielddef SET required = ? WHERE fielddef_id = ?';
$db->Execute($query, array($required, $fielddef_id));

$admintheme = cmsms()->get_variable('admintheme');
$json = new stdClass;

if ($required) {

	$json->image = $admintheme->DisplayImage('icons/system/true.gif', $this->ModLang('revert'), '', '', 'systemicon');
	$json->href = $this->CreateLink($id, 'admin_requirefielddef', $returnid, '', array('require' => 0,'fielddef_id' => $fielddef_id), '', true);
} else {

	$json->image = $admintheme->DisplayImage('icons/system/false.gif', $this->ModLang('approve'), '', '', 'systemicon');
	$json->href = $this->CreateLink($id, 'admin_requirefielddef', $returnid, '',array('require' => 1,'fielddef_id' => $fielddef_id), '', true);
}

// Fix URL for JSON output
$json->href = html_entity_decode($json->href);

header("Content-type:application/json; charset=utf-8");

$handlers = ob_list_handlers(); 
for ($cnt = 0; $cnt < sizeof($handlers); $cnt++) { ob_end_clean(); }

echo json_encode($json);
exit();
?>