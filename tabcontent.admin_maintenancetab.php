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
# ListIt is a CMS Made Simple module that enables the web developer to create
# multiple lists throughout a site. It can be duplicated and given friendly
# names for easier client maintenance.
#
#-------------------------------------------------------------------------

if (!is_object(cmsms())) exit;

#---------------------
# Smarty processing
#---------------------

$smarty->assign('startform', $this->CreateFormStart ($id, 'admin_domaintenance', $returnid));
$smarty->assign('endform', $this->CreateFormEnd());

$smarty->assign('button_fix_fielddefs', $this->CreateInputSubmit($id, 'fix_fielddefs', $this->Lang('repair')));

echo $this->ProcessTemplate('maintenancetab.tpl');

?>