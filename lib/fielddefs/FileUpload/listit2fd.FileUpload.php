<?php
#-------------------------------------------------------------------------
#
# Tapio Löytty, <tapsa@orange-media.fi>
# Web: www.orange-media.fi
#
# Goran Ilic, <uniqu3e@gmail.com>
# Web: www.ich-mach-das.at
#
#-------------------------------------------------------------------------
#
# ListIt2XDefs is a CMS Made Simple Dummy module that adds ListIt2 Module 
# Core Team supported List Definitions to ListIt2 Module.
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------

class listit2fd_FileUpload extends ListIt2FielddefBase
{
	private static $_img_types = array('gif', 'jpg', 'jpeg', 'png');

	public function __construct(&$db_info) 
	{	
		parent::__construct($db_info);
		
		$this->SetFriendlyType($this->ModLang('fielddef_'.$this->GetType()));
	}
	
	#---------------------
	# Fieldbase methods
	#---------------------	

	public function RenderForAdminListing($id, $returnid)
	{
		// Check if we have value.
		if(!$this->HasValue())
			return;
	
		// Check if we need image and if extension of filename is actually image.
		if(!$this->GetOptionValue('image') || !in_array(self::_ext($this->GetValue()), self::$_img_types))
			return $this->GetValue();

		// Check if CGSmartImage module is installed.
		$cgsi = cmsms()->GetModuleInstance('CGSmartImage');
		if(!is_object($cgsi))
			return $this->GetValue();
					
		// Check if our source file is readable.
        $path = cms_join_path($this->GetImagePath(), $this->GetValue());
		if(!is_readable($path))
			return $this->GetValue();
		
        $href = $this->GetImagePath(true) .'/'. $this->GetValue();
	
		$params['src'] = $href;
		$params['filter_croptofit'] = '48,48';
		$params['notag'] = true;
		$params['noembed'] = true;
	
		$output = cgsi_utils::process_image($params);
		
		$url = $output['output'];
		
		return '<a href="'.$href.'" class="cbox thumb"><img src="'.$url.'" width="48" height="48" /></a>';		
	}	
	
	#---------------------
	# Class methods
	#---------------------		
	
	public function GetImagePath($url = false)
	{
		$config = cmsms()->GetConfig();
		$prefix = $url ? $config['uploads_url'] : $config['uploads_path'];
		$path = cms_join_path($prefix, $this->GetOptionValue('dir'));		
	
		if(strpos($path, '{$item_id}') !== false)			
			$path = str_replace('{$item_id}', $this->GetItemId(), $path);
				
		if(strpos($path, '{$field_id}') !== false)			
			$path = str_replace('{$field_id}', $this->GetId(), $path);
				
		if($url)
			$path = str_replace(DIRECTORY_SEPARATOR, '/', $path);

		return $path;
	}

	#---------------------
	# Private methods
	#---------------------	
	
	public static function _ext($filename)
	{	
		$filename = explode('.', $filename);
		return trim(strtolower(end($filename))); // <- A bit freaky yes, but should cover all possible cases.
	}
	
} // end of class
?>