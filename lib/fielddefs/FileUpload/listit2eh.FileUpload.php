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

class listit2eh_FileUpload extends ListIt2EventHandlerBase
{
	#---------------------
	# Variables
	#---------------------	

	private $_data;

	#---------------------
	# Magic methods
	#---------------------		
	
	public function __construct(ListIt2FielddefBase &$field)
	{
		parent::__construct($field);
	}
	
	#---------------------
	# Overwritable events
	#---------------------	
	
	public function OnItemDelete(ListIt2 &$mod)
	{
		// Delete file
		$path = cms_join_path($this->GetImagePath(), $this->GetValue());
		@unlink($path);		
	}
	
	public function ItemSavePreProcess(&$errors, &$params) 
	{			
		// Check if we need delete
		if (isset($params['delete_customfield'][$this->GetId()])) {
				
			if($params['delete_customfield'][$this->GetId()] == 'delete') {
			
				// Delete file
				$path = cms_join_path($this->GetImagePath(), $this->GetValue());
				@unlink($path);
				
				// Reset value
				$this->SetValue();
			}
		}
		// Apply new value
		else {
		
			// Fill _data from $_FILES
			$files = self::_diverse_array($_FILES['m1_customfield']); // <- $id is statically part of key, not ideal.
			if(isset($files[$this->GetId()]))
				$this->_data = $files[$this->GetId()]; // <- My assumption is that $_FILES contains correct structure and there fore array is complete. Am i wrong? 1 + 1 = 2!

			// Check that _data is valid
			if(isset($this->_data) && $this->_data['error'] === 0) {				
				
				// Validate errors
				if(strpos($this->GetOptionValue('allowed'), listit2fd_FileUpload::_ext($this->_data['name'])) === FALSE) {
				
					$errors[] = $this->ModLang('error_bad_extension') . ' (' . $this->GetName() . ')';
				}
				
				// Set Value from _data
				if(empty($errors)) {
					
					$this->SetValue($this->_data['name']);
				}			
			}
		}
						
		parent::ItemSavePreProcess($errors, $params);
	}	
	
	public function ItemSavePostProcess(&$errors, &$params) 
	{
		// Move file to correct place, nothing else.
		if(isset($this->_data) && $this->_data['error'] === 0) {
		
			// Get file path
			$path = $this->GetImagePath();
			
			// Assure directory exists
			if(!is_dir($path))
				@mkdir($path, 0777, true);

			// Merge filename into path
			$path = cms_join_path($path, $this->GetValue());
				
			// Execute move.
			if(!move_uploaded_file($this->_data['tmp_name'], $path)) {
			
				$errors[] = $this->ModLang('error_file_permissions');
			}
		}
	}

	#---------------------
	# Private methods
	#---------------------	
	
	private static function _diverse_array($vector) {
		
		$result = array();
		foreach($vector as $key1 => $value1) {
		
			foreach($value1 as $key2 => $value2) {
		
				$result[$key2][$key1] = $value2;
			}
		}
		
		return $result;
	} 	
	
} // end of class

?>	