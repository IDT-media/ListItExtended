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
# Init items
#---------------------

$allow_autoscan = $this->GetPreference('allow_autoscan', 0);
$allow_autoinstall = $this->GetPreference('allow_autoinstall', 0);

#---------------------
# Smarty processing
#---------------------

$smarty->assign('startform', $this->CreateFormStart($id, 'admin_updateoptions', $returnid));
$smarty->assign('endform', $this->CreateFormEnd());
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));

$smarty->assign('input_allow_autoscan', $this->CreateInputCheckbox($id, 'allow_autoscan', 1, $allow_autoscan, ($allow_autoscan ? 'checked="checked"' : '')));
$smarty->assign('input_allow_autoinstall', $this->CreateInputCheckbox($id, 'allow_autoinstall', 1, $allow_autoinstall, ($allow_autoinstall ? 'checked="checked"' : '')));

echo $this->ProcessTemplate('optiontab.tpl');

?>