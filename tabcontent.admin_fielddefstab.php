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
# Load fielddefs
#---------------------

$fielddefs = ListIt2FielddefOperations::GetRegisteredFielddefs(true, true);
foreach($fielddefs as $onedef) {

	if($onedef->IsDisabled()) {
	
		$onedef->active_link = $themeObject->DisplayImage('icons/system/warning.gif', $this->ModLang('fielddef_deps_missing'), '', '', 'systemicon');
	}	
	elseif($onedef->IsActive()) {

		$onedef->active_link = $this->CreateLink($id, 'admin_togglefielddef', $returnid, $themeObject->DisplayImage('icons/system/true.gif', '', '', '', 'systemicon'), array(
			'type' => $onedef->GetType()
		));		
	} 	
	else {
	
		$onedef->active_link = $this->CreateLink($id, 'admin_togglefielddef', $returnid, $themeObject->DisplayImage('icons/system/false.gif', '', '', '', 'systemicon'), array(
			'type' => $onedef->GetType()
		));	
	}	
}

#---------------------
# Smarty processing
#---------------------

$smarty->assign('fielddefs', $fielddefs);

$smarty->assign('startform', $this->CreateFormStart($id, 'admin_scanfielddefs', $returnid));
$smarty->assign('endform',   $this->CreateFormEnd());
$smarty->assign('scan',		 $this->CreateInputSubmit($id, 'scan_fielddefs', $this->ModLang('fielddef_scan')));

echo $this->ProcessTemplate('fielddefstab.tpl');

?>