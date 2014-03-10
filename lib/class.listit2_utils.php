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

class listit2_utils {

	private function __construct() {}

	static final public function &array_to_object($array)
	{
		$obj = new StdClass;
		foreach($array as $key=>$value) {
		
			$obj->$key = $value;
		}
		
		return $obj;
	}
	  
	static final public function clean_params(&$params, $list, $accesslist = false) 
	{
	
		foreach($params as $key=>$value) {
		
			if($accesslist) {

				if(!in_array($key, (array)$list)) {
				
					unset($params[$key]);	
				}			
			
			} else {
		
				if(in_array($key, (array)$list)) {
				
					unset($params[$key]);	
				}
			
			}
		}	
	}
	
	static final public function init_var($string, $params, $default = '') 
	{
		$var = $default;

		if(isset($params[$string]))
			$var = $params[$string];
						
		return $var;
	}	
	
	/**
	 * Generate alias
	 * @param string $name The string that the alias will be generated from
	 * @return string Returns the alias
	 */
	static final public function generate_alias($name)
	{
		if (!is_string($name))
			return;
	
		$alias = $name;
	
		// replace multiple spaces with single underscore
		$alias = preg_replace('/ +/', '_', $alias);
	
		// leave alphabetic characters and unscores,
		// replace everything else with an underscore
		$alias = preg_replace('/[^a-zA-Z_]/', '_', $alias);
	
		// replace multiple underscores with single underscore
		$alias = preg_replace('/_+/', '_', $alias);
	
		// convert to lowercase
		$alias = strtolower($alias);
	
		// remove underscore from start and end
		$alias = trim($alias, '_');
	
		return $alias;
	}	
	
	/**
	 * Is valid alias
	 * @param string $alias
	 * @return bool Returns true if string in question is a valid alias, or
	 * false otherwise
	 */
	static final public function is_valid_alias($alias)
	{
		if (!is_string($alias))
			return;
	
		// check alias
		// http://www.php.net/manual/en/language.variables.basics.php
		if (preg_match('/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/', $alias)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Has Prefix
	 * @param string $string The string in question
	 * @param array $prefix Array of prefixes to match against
	 * @return bool Returns true if prefix is found, or false otherwise
	 */
	static final public function has_prefix($string, $prefixes)
	{
		if (!is_string($string))
			return;
		if (!is_array($prefixes))
			return;
	
		foreach ($prefixes as $prefix)
		{
			if (strpos($string, $prefix) === 0)
			{
				return true;
			}
		}
	
		return false;
	}
	
	static final public function explode_orderby($param, $valid_cols){
	
		$order_cols = array();
		$custom_cols = array();
		$index = 0;
		
		foreach(explode(',', $param) as $col) {
		
			$col = trim($col);
			$col_parts = explode('|', $col);
	
			// column name
			$col_name = $col_parts[0];
			$col_order = 'ASC';
	
			// order column ascending or descending
			if(isset($col_parts[1])) {
				
				$col_order = (in_array($col_parts[1], array('ASC', 'DESC')) ? $col_parts[1] : 'ASC');
			}
	
			$col_order = (in_array($col_order, array('ASC', 'DESC')) ? $col_order : 'ASC');
	
			if(isset($valid_cols[$col_name])) {
			
				$order_cols[$index] = $valid_cols[$col_name] . ' ' . $col_order;
			} 
			elseif (startswith($col_name, 'custom_')) {
				
				$custom_name = substr($col_name, 7);
				$obj = new stdClass;
				$obj->name = $custom_name;
				$obj->order = $col_order;
				
				$custom_cols[$index] = $obj;
			}
			
			$index++;
		}
			
		return array($order_cols, $custom_cols);
	}	
	
} // end of class