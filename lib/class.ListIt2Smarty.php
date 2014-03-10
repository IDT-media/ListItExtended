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

class ListIt2Smarty {

	private function __construct() {}

	static final public function loader($params, &$smarty)
	{
		$item = isset($params['item']) ? $params['item'] : 'item';
		$instance = isset($params['instance']) ? $params['instance'] : cms_utils::get_app_data('listit2_instance'); // Mandatory
		$identifier = isset($params['identifier']) ? $params['identifier'] : null;
		$value = isset($params['value']) ? $params['value'] : null; // Mandatory
		$force_array = isset($params['force_array']) ? true : false;
		$result = array();

		if(is_null($instance))
			throw new ListIt2Exception($smarty->left_delimiter . "ListIt2Loader" . $smarty->right_delimiter . ": Parameter instance is not given.");
	
		if(is_null($value))
			throw new ListIt2Exception($smarty->left_delimiter . "ListIt2Loader" . $smarty->right_delimiter . ": Parameter value is not given.");
			
		// Load wanted instance
		$instance = cmsms()->GetModuleInstance($instance);
		if(!$instance instanceof LISTIT2)
			throw new ListIt2Exception($smarty->left_delimiter . "ListIt2Loader" . $smarty->right_delimiter . ": Loaded instance is not ListIt2 instance.");
		
		// Get loader info
		switch($item) {
		
			case 'item':
				
				$loader = 'LoadItemByIdentifier';
				if(is_null($identifier))
					$identifier = 'item_id';
				break;
				
			case 'category':

				$loader = 'LoadCategoryByIdentifier';
				if(is_null($identifier))
					$identifier = 'category_id';				
				break;
				
			default:
				throw new ListIt2Exception($smarty->left_delimiter . "ListIt2Loader" . $smarty->right_delimiter . ": Unknown item type");

		} // end switch
		
		//Load
		$value = explode(',', $value);
		foreach((array)$value as $one) {
		
			$result[$one] = $instance->$loader($identifier, $one);
		}
			
		// Return singular, if singular & force array is Off
		if(count($result) == 1 && !$force_array) 		
			$result = $result[key($result)];
				
		// Assign
		if(isset($params['assign'])) {
			$smarty->assign($params['assign'], $result);			
			return;
		}
	
		return $result;
		
	} // end of loader()
	
} // end of class
?>