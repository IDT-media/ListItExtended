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

	$params['active_tab'] = 'itemtab';
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
}

$csv_mimetypes = array(
    'text/csv',
    'text/plain',
    'application/csv',
    'text/comma-separated-values',
    'application/excel',
    'application/vnd.ms-excel',
    'application/vnd.msexcel',
    'text/anytext',
    'application/octet-stream',
    'application/txt',
);

$admintheme 		= cms_utils::get_theme_object();	
$dest_path 			= cms_join_path(TMP_CACHE_LOCATION, $this->GetName() . '_CSV_FILE.csv');
$file_values		= array();
$template 			= 'admin_csv_import_export.tpl';
$plural  		 	= $this->GetPreference('item_plural', '');
$separator 			= listit2_utils::init_var('separator', $params, ';'); // <- Default could be option 
$enclouser 			= listit2_utils::init_var('enclouser', $params, '"'); // <- Default could be option 
$import_values 		= listit2_utils::init_var('import_values', $params, array());

#---------------------
# Load item variables
#---------------------

$database_values = array();
$_invalid_values = array('create_time', 'modified_time');
$item = $this->InitiateItem();

foreach($item as $k=>$v) {

	if($v instanceof ListIt2FielddefArray) {
	
		foreach($v as $f) {

			$obj = new stdClass;
		
			if(in_array($f->GetAlias(), $_invalid_values))
				continue;
			
			$obj->alias = $f->GetAlias();
			$obj->required = $f->IsRequired() ? 1 : 0;
			$obj->required_image = $f->IsRequired() ? $admintheme->DisplayImage('icons/system/true.gif', '','','','systemicon') : $admintheme->DisplayImage('icons/system/false.gif','','','','systemicon');
			$obj->help = $f->GetDesc();

			$database_values[] = $obj;
		}
	}
	else {
	
		$obj = new stdClass;
	
		if(in_array($k, $_invalid_values))
			continue;
			
		$obj->alias = $k;
		$obj->required = in_array($k, ListIt2Item::$mandatory) ? 1 : 0;
		$obj->required_image = in_array($k, ListIt2Item::$mandatory) ? $admintheme->DisplayImage('icons/system/true.gif', '','','','systemicon') : $admintheme->DisplayImage('icons/system/false.gif','','','','systemicon');
		$obj->help = $this->ModLang('item_var_help_'. $k);
		
		$database_values[] = $obj;
	}

}

unset($item);

#---------------------
# Go back
#---------------------

if (isset($params['previous'])) {

	unset($params['submit']);
	unset($params['previous']);
}

#---------------------
# Do import
#---------------------

if (isset($params['do_import'])) {
		
	$errors = array();

	foreach($database_values as $obj) {
	
		if($obj->required) {
		
			if(!$import_values[$obj->alias])
				$errors[] = $this->ModLang('required_field_empty') . ' (' . $obj->alias . ')';
		}
	}
	
	if(empty($errors)) {

		$database_values = array();
		
		// Initiate CsvIterator
		$csv = new ListIt2CsvIterator($dest_path, true, $separator, $enclouser);

		// Collect data from file
		while ($csv->next()) {

			$row = $csv->current();
			
			foreach($import_values as $alias => $index) {
			
				if($index) {
				
					$database_values[$csv->key()][$alias] = $row[$index];
				}
				else {
				
					unset($import_values[$alias]);
				}
			}
		}
			
		// Import data to database
		foreach($database_values as $item_values) {
		
			$obj = $this->InitiateItem();
			
			foreach($item_values as $key=>$value) {

				if($key == 'item_id' && !is_numeric($value))
					continue;
			
				$key 	= utf8_encode($key);
				$value 	= explode(LISTIT2_VALUE_SEPARATOR, utf8_encode($value));
			
				$obj->SetPropertyValue($key, $value);
				if($key == 'item_id')
					ListIt2ItemOperations::Load($this, $obj); // <- Try loading item if we actually got ID.
			}
							
			$this->SaveItem($obj);
			
			unset($obj);
		}
		
		// Redirect back to listing
		$params = array('active_tab'=>'itemtab');
		$this->Redirect($id, 'defaultadmin', $returnid, $params);
	
	} // end of error check
}

#---------------------
# Submit
#---------------------

if (isset($params['submit'])) {

	if (!isset($params['do_import'])) {

		$errors = array();

		// Start file validation
		$_file = $_FILES[$id.'csvfile'];
		if(!isset($_file['name']) || $_file['name'] == '') {

			$errors[] = $this->ModLang('error_file_empty');
		} 
		/* DISABLE UNTIL FURTHER NOTICE!
		if(!in_array($_file['type'], $csv_mimetypes)) {
		
			$errors[] = $this->ModLang('error_file_nocsv');
		}
		*/	
		if(empty($errors)) {
		
			if(!move_uploaded_file($_file['tmp_name'], $dest_path)) {
			
				$errors[] = $this->ModLang('error_file_permissions');
			}	
		}
	}
	
	// No file validation errors, read file
	if(empty($errors) || isset($params['do_import'])) {
	
		// Initiate CsvIterator
		$csv = new ListIt2CsvIterator($dest_path, false, $separator, $enclouser);
		$csv->next();
		$tmp = $csv->current();
		$csv->tearDown();
		
		// Build dropdown array
		$file_values = array(0 => lang('none'));
		foreach($tmp as $tmpval) {
		
			$file_values[$tmpval] = utf8_encode($tmpval);
		}
		
		$template = 'admin_csv_import.tpl';	
	}
		
	
} // end of submit

#---------------------
# Smarty processing
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

// Part 1
$smarty->assign('input_file',$this->CreateFileUploadInput($id, 'csvfile', '', 25));
$smarty->assign('input_separator',$this->CreateInputText($id, 'separator', $separator, 50));
$smarty->assign('input_enclouser',$this->CreateInputText($id, 'enclouser', $enclouser, 50));

// Part 2
$smarty->assign('database_values', $database_values);
$smarty->assign('file_values', $file_values);

$smarty->assign('title', $this->ModLang('import', $plural));
$smarty->assign('backlink', $this->CreateBackLink('itemtab'));
$smarty->assign('startform', $this->CreateFormStart($id, 'admin_importitems', $returnid, 'post', 'multipart/form-data', false, '', $params));
$smarty->assign('endform', $this->CreateFormEnd());

$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$smarty->assign('previous', $this->CreateInputSubmit($id, 'previous', lang('previous')));
$smarty->assign('do_import', $this->CreateInputSubmit($id, 'do_import', lang('submit')));
$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));

echo $this->ModProcessTemplate($template);
?>