<?php
if (!$this->CheckPermission($this->_GetModuleAlias() . '_modify_item')) return;

$items = array();
if(isset($params['item_id'])) {
	$items[] = (int)$params['item_id'];
}
if(isset($params['items']) && is_array($params['items'])) {
	$items = $params['items'];
}

foreach($items as $item_id) {	

	$this->DeleteItemById($item_id);
}

$handlers = ob_list_handlers(); 
for ($cnt = 0; $cnt < sizeof($handlers); $cnt++) { ob_end_clean(); }

echo $this->ModLang('deleted');
exit();
?>