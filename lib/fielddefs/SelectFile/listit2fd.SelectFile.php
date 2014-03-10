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

class listit2fd_SelectFile extends ListIt2FielddefBase
{
	public function __construct(&$db_info) 
	{	
		parent::__construct($db_info);
		
		$this->SetFriendlyType($this->ModLang('fielddef_'.$this->GetType()));
	}
	
	public function GetFiles()
	{
		$config = cmsms()->GetConfig();
		
		$path = cms_join_path($config['uploads_path'], $this->GetOptionValue('dir'));

		if (!is_dir($path)) {
			@mkdir($path);
		}

		$allowed = ($this->GetOptionValue('allowed') != '' ? explode(',',$this->GetOptionValue('allowed')) : array(
			'jpg',
			'gif',
			'png'
		));

		$invalid = array('.','..');
		$exclude_prefix = explode(',', $this->GetOptionValue('exclude_prefix'));
		
		$images = array();
		if ($handle = opendir($path)) {
			while (false !== ($file = readdir($handle))) {
			
				if(in_array($file, $invalid)) continue;
				
				foreach($exclude_prefix as $one) {
				
					if(startswith($file, $one) && !empty($one)) continue 2;
				}
				
				foreach($allowed as $ext) {
				
					if(endswith($file, $ext)) {
					
						$images[$file] = $file;
					}
				
				}
			}

			closedir($handle);
		}

		asort($images);
		$images = array_merge(array(''=>$this->ModLang('select_one')), $images);
			
		return $images;
	}
	
} // end of class
?>