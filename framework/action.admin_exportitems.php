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

// Init $exportvalues
$obj = $this->InitiateItem();
foreach($obj as $k=>$v) {

	if($v instanceof ListIt2FielddefArray) {
	
		foreach($v as $f) {
				
			$exportvalues[$f->GetAlias()] = $f->GetAlias();	
		}
	}
	else {

		$exportvalues[$k] = $k;
	}		
}
unset($obj);

$dateformat = trim(get_preference(get_userid(),'date_format_string','%Y-%m-%d'));

if(empty($dateformat)) 
	$dateformat = '%Y-%m-%d';		

$date 				= strftime($dateformat, time());
$filename 			= $this->GetName(). '-Export-' .$date;
$filename			= preg_replace('/[^\w\d\.\-\_]/','_',$filename);

$plural  		 	= $this->GetPreference('item_plural', '');
$separator 			= listit2_utils::init_var('separator', $params, ';'); // <- Default could be option 
$enclouser 			= listit2_utils::init_var('enclouser', $params, '"'); // <- Default could be option 
$sel_exportvalues 	= listit2_utils::init_var('exportvalues', $params, $exportvalues);
$filename 			= listit2_utils::init_var('filename', $params, $filename);

#---------------------
# Submit
#---------------------

if (isset($params['submit'])) {

	$headers = array();
	$output = array();
	$first = true;

	$query = 'SELECT item_id FROM ' . cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item ORDER BY position ' . $this->GetPreference('sortorder');
	$result = $db->GetCol($query);

	if($result) {

		foreach($result as $item_id) {
		
			$obj = $this->LoadItemByIdentifier('item_id', $item_id);
			$row = array();
			
			foreach($obj as $k=>$v) {

				if($v instanceof ListIt2FielddefArray) {
				
					foreach($v as $f) {
						
						if(!in_array($f->GetAlias(), $sel_exportvalues)) 
							continue;
						
						if($first)
							$headers[] = $f->GetAlias();
						
						$row[] = $f->GetValue();				
					}
				}
				else {

					if(!in_array($k, $sel_exportvalues)) continue;
				
					if($first)
						$headers[] = $k;
				
					if(is_array($v))
						$row[] = implode(',', $v);
					else
						$row[] = $v;
				}		
			}
			
			if($first)
				$output[] = $headers;
			
			$output[] = $row;
		
			unset($obj);
			$first = false;
		}
	}
		
	// Make sure filename is export friendly
	$filename = preg_replace('/[^\w\d\.\-\_]/','_',$filename);
	$filename .= '.csv';

	// Set headers
	header("Content-type:text/csv; charset=iso8859-1");
    header("Content-Disposition:attachment;filename=".$filename);

	// Clear output buffer
	$handlers = ob_list_handlers(); 
	for ($cnt = 0; $cnt < sizeof($handlers); $cnt++) { ob_end_clean(); }
	
	// Output
	$total_count = count($headers);
	foreach($output as $onerow) {
	
		$counter = 1;
		foreach($onerow as $oneitem) {
		
			$str = $enclouser . utf8_decode($oneitem) . $enclouser;
			if($counter == $total_count) {
				$str .= "\n";
			} else {
				$str .= $separator;
			}
			
			echo $str;
			$counter++;
		}
	}
	
	// Prevent including actual HTML
	exit(); 

} // end of submit

#---------------------
# Smarty processing
#---------------------

$smarty->assign('title', $this->ModLang('export', $plural));
$smarty->assign('backlink', $this->CreateBackLink('itemtab'));
$smarty->assign('startform', $this->CreateFormStart($id, 'admin_exportitems', $returnid, 'post', 'multipart/form-data', false, '', $params));

$smarty->assign('input_exportvalues', $this->CreateInputSelectList($id, 'exportvalues[]', $exportvalues, $sel_exportvalues, 10));
$smarty->assign('input_file',$this->CreateInputText($id, 'filename', $filename, 44) . '.csv');

$smarty->assign('input_separator',$this->CreateInputText($id, 'separator', $separator, 50));
$smarty->assign('input_enclouser',$this->CreateInputText($id, 'enclouser', $enclouser, 50));

$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));
$smarty->assign('endform', $this->CreateFormEnd());

echo $this->ModProcessTemplate('admin_csv_import_export.tpl');
?>