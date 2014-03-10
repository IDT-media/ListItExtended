<?php
if (!$this->CheckPermission($this->_GetModuleAlias() . '_modify_category')) return;

$categories = array();
if(isset($params['category_id'])) {
	$categories = array((int)$params['category_id']);
}
if(isset($params['categories']) && is_array($params['categories'])) {
	$categories = $params['categories'];
}

foreach($categories as $category_id) {	

	$this->DeleteCategoryById($category_id);
}

$handlers = ob_list_handlers(); 
for ($cnt = 0; $cnt < sizeof($handlers); $cnt++) { ob_end_clean(); }

echo $this->ModLang('deleted');
exit();
?>