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

class ListIt2ArchiveQuery extends ListIt2Query
{
	#---------------------
	# Attributes
	#---------------------

	private static $orderby_map = array(
		// items
		'year' => 'YEAR(A.create_time)', 'month' => 'MONTH(A.create_time)',
		// category
		'category_id' => 'B.category_id', 'category_name' => 'B.category_name',
		// functions
		'rand'=>'RAND()'
	);	
	
	#---------------------
	# Magic methods
	#---------------------		
	
	public function __construct(ListIt2 &$mod, &$params)
	{
		parent::__construct($mod, $params);
	}
		
	#---------------------
	# Query methods
	#---------------------	

	private function _append_internal()
	{
		if(isset($this->query))
			return;
			
		$db = $this->GetDb();
		$mod = $this->GetModuleInstance();
		$params = $this->GetParams();	

		/*
		 * ORDER BY
		 */
		if(isset($params['orderby'])) {

			list($order_cols, $custom_cols) = self::explode_orderby($params['orderby'], self::$orderby_map); // <- Bit broken, wasn't ment for category action, second array totally unneccery.
			
			if(count($order_cols)) {
			
				foreach($order_cols as $one) {
				
					$this->AppendTo(parent::VARTYPE_ORDERBY, $one);
				}
			}
		}
		
		/**
		 * FILTER: YEAR
		 */		
		
		if(!empty($params['filter_year'])) {
			
			$this->AppendTo(parent::VARTYPE_WHERE, 'YEAR(A.create_time) = ?');
			$this->AppendTo(parent::VARTYPE_QPARAMS, (int)$params['filter_year']);
		}
	}
		
	protected function _query()
	{
		$db = $this->GetDb();
		$mod = $this->GetModuleInstance();
		$params = $this->GetParams();
		
		$order_cols = array();
		$custom_cols = array();
		$this->_append_internal();

		// Init query
		$this->query = 'SELECT DISTINCT MONTH(A.create_time) AS month, YEAR(A.create_time) AS year, count(A.item_id) AS count FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item A 
						LEFT JOIN ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item_categories IB 
						ON A.item_id = IB.item_id 
						LEFT JOIN ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category B 
						ON IB.category_id = B.category_id ';		
		
		// Merge everything to one query
		if(count($this->joins))
			$this->query .= implode(' ', $this->joins);
		
		if(count($this->where))
			$this->query .= ' WHERE ' . implode(' AND ', $this->where);
			
		$this->query .= ' GROUP BY YEAR(A.create_time), MONTH(A.create_time) ';			

		if(count($this->orderby)) {
		
			$this->query .= ' ORDER BY ' . implode(', ', $this->orderby);
		} else {
		
			$this->query .= ' ORDER BY A.create_time DESC';
		}			
			
		$this->resultset = $db->Execute($this->query, $this->qparams);
	}	
	
	#---------------------
	# Class methods
	#---------------------		
	
	static private function explode_orderby($param, $valid_cols){
	
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

?>	