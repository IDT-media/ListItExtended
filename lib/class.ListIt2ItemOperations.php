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

class ListIt2ItemOperations
{
	#---------------------
	# Variables
	#---------------------	
	
	public static $identifiers = array(
		'item_id' 	=> 'item_id', 
		'alias' 	=> 'alias', 
		'key1' 		=> 'key1', 
		'key2'		=> 'key2', 
		'key3'		=> 'key3'
	);

	#---------------------
	# Magic methods
	#---------------------		
	
	private function __construct() {}
	
	#---------------------
	# Database methods
	#---------------------	
	
	static final public function Save(ListIt2 &$mod, ListIt2Item &$obj)
	{
		Events::SendEvent($mod->GetName(), 'PreItemSave', array('item_object' => &$obj));

		// Check against mandatory list
		foreach(ListIt2Item::$mandatory as $rule) {
		
			if($obj->$rule == '')
				return;
		}
	
		$db = cmsms()->GetDb();
	
		//$time = $db->DBTimeStamp(time());

		$sql_start_time = $obj->start_time ? date('Y-m-d', strtotime($obj->start_time)) : NULL;
		$sql_end_time = $obj->end_time ? date('Y-m-d', strtotime($obj->end_time)) : NULL;		
		
		// Ensure that we have alias
		if ($obj->alias == ''){
		
			$obj->alias = munge_string_to_url($obj->title, true);
		}
		
		// Try grabbing owner if not set
		if (is_null($obj->owner)) {
		
			$loggedin = get_userid(false);
			if($loggedin)
				$obj->owner = $loggedin;
		}
			
		// Existing item	
		if ($obj->item_id > 0) {
		
			// update item
			$query  = 'UPDATE ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item 
					SET title = ?, alias = ?, active = ?, start_time = ?, end_time = ?, modified_time = NOW(), key1 = ?, key2 = ?, key3 = ?, owner = ?
					WHERE item_id = ?';
						
			$result = $db->Execute($query, array(
				$obj->title,
				$obj->alias,
				//$obj->category_id,
				$obj->active,
				$sql_start_time,
				$sql_end_time,
				$obj->key1,
				$obj->key2,
				$obj->key3,		
				$obj->owner,		
				$obj->item_id
			));
			
			if (!$result)
				die('FATAL SQL ERROR: ' . $db->ErrorMsg() . '<br/>QUERY: ' . $db->sql);		
		
		// New item
		} else {

			// find position before inserting new item
			$query = 'SELECT MAX(position) + 1 FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item';
			$position = $db->GetOne($query);

			if ($position == null)
				$position = 1;
			
			// check alias is unique
			$query = 'SELECT COUNT(alias) as alias FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item WHERE alias LIKE "'.$obj->alias.'%"';
			$dbresult = $db->GetOne($query);
			
			if($dbresult > 0)
				$obj->alias .= '_'.($dbresult+1);	
			
			// insert item
			$query  = 'INSERT INTO ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item 
					(title, alias, position, active, create_time, modified_time, start_time, end_time, key1, key2, key3, owner) 
					VALUES (?, ?, ?, ?, NOW(), NOW(), ?, ?, ?, ?, ?, ?)';
					
			$result = $db->Execute($query, array(
				$obj->title,
				$obj->alias,
				//$obj->category_id,
				$position,
				$obj->active,
				$sql_start_time,
				$sql_end_time,
				$obj->key1,
				$obj->key2,
				$obj->key3,
				$obj->owner
			));
			
			if (!$result)
				die('FATAL SQL ERROR: ' . $db->ErrorMsg() . '<br/>QUERY: ' . $db->sql);

			// populate $item_id for newly inserted item
			$obj->item_id = $db->Insert_ID();		
		}
	
		// Init search
		$search = cmsms()->GetModuleInstance('Search');
		if (is_object($search))
			$searchtext = $obj->title .' ';
					
		// handle inserting custom fields into database
		if(count($obj->fielddefs)) {
		
			foreach ($obj->fielddefs as $field) {
			
				$field->SetItemId($obj->item_id); // <- Remove in 1.5
				$field->EventHandler()->OnItemSave($mod);	

				// Part of search reindexing
				if(is_object($search))
					$searchtext .= $field->GetValue("string") .' ';
							
			}
		}
		
		// Reindex search
		if(is_object($search))
			$search->AddWords($mod->GetName(), $obj->item_id, 'title', $searchtext);		
		
		Events::SendEvent($mod->GetName(), 'PostItemSave', array('item_object' => &$obj));
		
	}

	static final public function Delete(ListIt2 &$mod, ListIt2Item &$obj)
	{
		Events::SendEvent($mod->GetName(), 'PreItemDelete', array('item_object' => &$obj));	
	
		$db = cmsms()->GetDb();
		
		if ($obj->item_id > 0) {

			// get details
			$query = 'SELECT * FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item WHERE item_id = ?';
			$row = $db->GetRow($query, array($obj->item_id));
			
			// delete item
			$query = 'DELETE FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item WHERE item_id = ?';
			$db->Execute($query, array($obj->item_id));
			
			// Delete from items
			$query = 'DELETE FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item_categories WHERE item_id = ?';
			$db->Execute($query, array($obj->item_id));				
			
			// Clean up sort order
			$query = 'UPDATE ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item SET position = (position - 1) WHERE position > ?';
			$db->Execute($query, array($row['position']));			
			
			// Delete field values from regular tables
			$query = 'DELETE FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_fieldval WHERE item_id = ?';
			$db->Execute($query, array($obj->item_id));			
			
			// Delete field values from any external tables (this might not belong here, double check)
			if(count($obj->fielddefs)) {
			
				foreach ((array)$obj->fielddefs as $field) {
				
					$field->EventHandler()->OnItemDelete($mod);
				} // end of foreach
			} // end of count
			
			Events::SendEvent($mod->GetName(), 'PostItemDelete', array('item_object' => &$obj));
			
			return true;
		}

		return FALSE;
	}

	static final public function Load(ListIt2 &$mod, ListIt2Item &$obj, $row = false)
	{
		Events::SendEvent($mod->GetName(), 'PreItemLoad', array('item_object' => &$obj));	
	
		// If we don't have row then attempt to load it
		if (!$row) {
	
			foreach(self::$identifiers as $db_column => $identifier) {
			
				if(!is_null($obj->$identifier)) {

					$db = cmsms()->GetDb();
				
					$query = "SELECT * FROM " . cms_db_prefix() . "module_" . $mod->_GetModuleAlias() . "_item
										WHERE $db_column = ? 
										LIMIT 1";									
										
					$row = $db->GetRow($query, array($obj->$identifier));
					
					if($row)
						break;
				}
			}
		}

		if ($row) {

			// Item table
			//$obj->id        			= $row['item_id'];
			$obj->item_id        		= $row['item_id']; // deprecated
			$obj->title        			= $row['title'];
			$obj->alias		 			= $row['alias'];
			$obj->position       		= $row['position'];			
			$obj->active       			= $row['active'];
			$obj->create_time  			= $row['create_time'];
			$obj->modified_time  		= $row['modified_time'];
			$obj->start_time   			= $row['start_time'];
			$obj->end_time     			= $row['end_time'];
			$obj->owner     			= $row['owner'];
			
			$obj->key1		 			= $row['key1'];
			$obj->key2		 			= $row['key2'];
			$obj->key3		 			= $row['key3'];
			//$obj->category_id 			= $row['category_id'];

			// Fields
			if(count($obj->fielddefs)) {
			
				foreach ((array)$obj->fielddefs as $field) {
				
					$field->SetItemId($obj->item_id); // <- Remove in 1.5
					$field->EventHandler()->OnItemLoad($mod);
			
				} // end of foreach
			} // end of count
		
			Events::SendEvent($mod->GetName(), 'PostItemLoad', array('item_object' => &$obj));
		
			return true;
		}

		return FALSE;
	}	
	
	static final public function Copy(ListIt2Item $obj)	
	{
		$obj = clone $obj;
	
		$obj->item_id = null;
		$obj->alias = null;
		$obj->position = -1;
		$obj->create_time = '';
		$obj->modified_time = '';
		$obj->key1 = null;
		$obj->key2 = null;
		$obj->key3 = null;
		$obj->owner = null;
	
		return $obj;
	}
	
} // end of class

?>