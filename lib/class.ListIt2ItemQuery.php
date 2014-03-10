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

class ListIt2ItemQuery extends ListIt2Query
{
	#---------------------
	# Attributes
	#---------------------

	private static $orderby_map = array(
		// items
		'item_id' => 'A.item_id', 'item_title' => 'A.title', 'item_position' => 'A.position', 'item_created' => 'A.create_time', 'item_modified' => 'A.modified_time', 'item_start' => 'A.start_time', 'item_end' => 'A.end_time',
		// category
		'category_id' => 'B.category_id', 'category_name' => 'B.category_name', 'category_hierarchy' => 'B.hierarchy', 'category_position' => 'B.position', // <- Not neccery valid, if JOIN to category table is not made, check this.
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

			list($order_cols, $custom_cols) = self::explode_orderby($params['orderby'], self::$orderby_map); // <- Always returning two arrays
			
			// Handle custom_* orderby stuff
			if(!empty($custom_cols)) {

				foreach($custom_cols as $index=>$obj) {
				
					$onedef = ListIt2FielddefOperations::Load($mod, 'alias', $obj->name);
					if($onedef) {
					
						$as = 'VAL' . $onedef->GetId();
						$this->AppendTo(parent::VARTYPE_JOINS, 'LEFT JOIN '.cms_db_prefix().'module_'.$mod->_GetModuleAlias().'_fieldval '.$as.' ON A.item_id = '.$as.'.item_id'); 							
						$this->AppendTo(parent::VARTYPE_WHERE, $as.'.fielddef_id = '.$db->qstr($onedef->GetId()));								
						$order_cols[$index] = $as.'.value '.$obj->order;
					}
				}
				
				ksort($order_cols);
			}
			
			if(count($order_cols)) {
			
				foreach($order_cols as $one) {
				
					$this->AppendTo(parent::VARTYPE_ORDERBY, $one);
				}
			}

		} // end of orderby;

		/*
		 * INCLUDE/EXCLUDE ITEMS
		 */					
		if(!empty($params['include_items']) || !empty($params['exclude_items'])) {
		
			if(!empty($params['include_items'])) {
			
				$array = explode(',', $params['include_items']);
				$str = "(";
			}
			
			if(!empty($params['exclude_items'])) {
			
				$array = explode(',', $params['exclude_items']);
				$str = "NOT (";
			}
			
			$count = 0;			
			foreach ($array as $alias) {  

				if ($count > 0)
					$str .= ' OR ';
						
				$str .=  is_numeric($alias) ? " A.item_id = '" . $alias . "'" : " A.alias = '" . $alias . "'";
				$count++;
			}
			$str .= ')';
			
			$this->AppendTo(parent::VARTYPE_WHERE, $str);

		} // end of include items;		
		
		/*
		 * INCLUDE/EXCLUDE CATEGORY
		 */					
		if(!empty($params['category']) || !empty($params['exclude_category'])) {
		
			if(!empty($params['category'])) {
			
				$array = explode(',', $params['category']);
				$str = "(";
			}
			
			if(!empty($params['exclude_category'])) {
			
				$array = explode(',', $params['exclude_category']);
				$str = "NOT (";
			}
			
			$count = 0;
			foreach ($array as $cat) { 

				if ($count > 0)
					$str .= ' OR ';
						
				$str .= " B.category_alias = '" . $cat . "'";
				
				if ((isset($params['subcategory']) && $params['subcategory']) || $mod->GetPreference('subcategory')) {
					
					$this->_get_subcategories($str, $cat);
				}	
				
				$count++;
			}
			$str .= ')';
			
			$this->AppendTo(parent::VARTYPE_WHERE, $str);

		} // end of category;
			
		/*
		 * SEARCH
		 */	
		if(!empty($params['search'])) {
			
				$str = $params['search'];
			
				$this->AppendTo(parent::VARTYPE_WHERE, '(A.title LIKE ? OR A.item_id IN (SELECT C.item_id FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_fieldval C WHERE C.value LIKE ?))');
				$this->AppendTo(parent::VARTYPE_QPARAMS, '%'.trim($str).'%');
				$this->AppendTo(parent::VARTYPE_QPARAMS, '%'.trim($str).'%');
			
		} // end of search
		
		/*
		 * FILTER: MONTH & YEAR
		 */	
		if(!empty($params['filter_year']) || !empty($params['filter_month'])) {

			$year = !empty($params['filter_year']) ? (int)$params['filter_year'] : date('Y');

			$start_month = !empty($params['filter_month']) ? (int)$params['filter_month'] : 1;
			$end_month = !empty($params['filter_month']) ? (int)$params['filter_month'] : 12;	
		
			$start_day = 1;
			$end_day = !empty($params['filter_month']) ? date('t',mktime(0,0,0,$start_month,$start_day,$year)) : 31;

			$timestamp1 = mktime(0,0,0,$start_month,$start_day,$year);
			$timestamp1 = $db->DbTimeStamp($timestamp1);
			
			$timestamp2 = mktime(23,59,0,$end_month,$end_day,$year);
			$timestamp2 = $db->DbTimeStamp($timestamp2);

			$this->AppendTo(parent::VARTYPE_WHERE, "(A.create_time BETWEEN $timestamp1 AND $timestamp2)");
				
		} // end of filter_year		
	
		/*
		 * TIME CONTROL
		 */	
		if(!isset($params['showall']))
			$this->AppendTo(parent::VARTYPE_WHERE, '(start_time IS NULL OR TIMESTAMPDIFF(DAY, CURDATE(), start_time) <= 0) AND (end_time IS NULL OR TIMESTAMPDIFF(DAY, end_time, CURDATE()) <= 0)');
	
		/*
		 * SEARCH_*
		 */	
		$search_clause = "A.item_id IN 
							(SELECT C.item_id FROM " . cms_db_prefix() . "module_" . $mod->_GetModuleAlias() . "_fieldval C, " . cms_db_prefix() . "module_" . $mod->_GetModuleAlias() . "_fielddef D
									WHERE C.fielddef_id = D.fielddef_id 
									AND D.alias = ?";									
					
		$fielddefs = $mod->GetFieldDefs();
		foreach($fielddefs as $fielddef) {
		
			if(!empty($params['search_'.$fielddef->GetAlias()])) {
			
				$thisparam = $params['search_'.$fielddef->GetAlias()];
				$this->AppendTo(parent::VARTYPE_QPARAMS, $fielddef->GetAlias());
				
				$thisor = array();
				foreach((array)$thisparam as $thisvalue) {
				
					$thisor[] = 'C.value = ?';
					$this->AppendTo(parent::VARTYPE_QPARAMS, $thisvalue);
				}
				
				$this->AppendTo(parent::VARTYPE_WHERE, $search_clause . " AND " . implode(" OR ", $thisor) . ")");	
			}
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
		$this->query = 'SELECT A.* FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item A 
					LEFT JOIN ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item_categories IB 
					ON A.item_id = IB.item_id 
					LEFT JOIN ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category B 
					ON IB.category_id = B.category_id ';
						
		// Merge everything to one query
		if(count($this->joins))
			$this->query .= implode(' ', $this->joins);
		
		if(count($this->where))
			$this->query .= ' WHERE ' . implode(' AND ', $this->where);

		$this->query .= ' GROUP BY A.item_id ';			
			
		if(count($this->orderby)) {
		
			$this->query .= ' ORDER BY ' . implode(', ', $this->orderby);
		} else {
		
			$this->query .= ' ORDER BY A.position ' . $mod->GetPreference('sortorder');
		}
			
		// Init params necessary to execution
		$pagecount = -1;
		$startelement = 0;
		$pagenumber = $this->GetPageNumber();
		$pagelimit = $this->GetPageLimit();
		$startelement = ($pagenumber-1) * $pagelimit;
		
		$res = $db->GetArray($this->query, $this->qparams);	
		$this->totalcount = count($res);
			
		if(isset($params['start'])) {

			$this->totalcount -= (int)$params['start'];
			$startelement = $startelement + (int)$params['start'];
		}

		$this->pagecount = (int)($this->totalcount / $pagelimit);
		if(($this->totalcount % $pagelimit) != 0) $this->pagecount++;

		$this->resultset = $db->SelectLimit($this->query, $pagelimit, $startelement, $this->qparams);
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
	
	private function _get_subcategories(&$str, $alias)
	{
		$db = $this->GetDb();
		$mod = $this->GetModuleInstance();	
	
		$query = "SELECT category_id FROM " . cms_db_prefix() . "module_" . $mod->_GetModuleAlias() . "_category WHERE category_alias = ?";
		$subcat = $db->GetOne($query, array($alias));
		
		if(!$subcat)
			return FALSE;
			
		$str .= " OR B.parent_id = '" . $subcat . "'";
		
		$query = "SELECT category_alias FROM " . cms_db_prefix() . "module_" . $mod->_GetModuleAlias() . "_category WHERE parent_id = ?";
		$dbr = $db->Execute($query, array($subcat));
		
		while($dbr && !$dbr->EOF) {

			$this->_get_subcategories($str, $dbr->fields['category_alias']);
			$dbr->MoveNext();
		}

		if($dbr) 
			$dbr->Close();			
		
	}	
	
} // end of class

?>	