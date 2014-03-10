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
#
# Current available events in system:
#	- OnItemLoad(ListIt2 &$mod)
#	- OnItemSave(ListIt2 &$mod)
#	- OnItemDelete(ListIt2 &$mod)
#	- ItemSavePreProcess(Array &$errors, Array &$params) 
#	- ItemSavePostProcess(Array &$errors, Array &$params)
#
#-------------------------------------------------------------------------

class ListIt2EventHandlerBase
{
	#---------------------
	# Attributes
	#---------------------

	private $_field;
	
	#---------------------
	# Magic methods
	#---------------------		
	
	public function __construct(ListIt2FielddefBase &$field)
	{
		$this->_field	 	= $field;
	}
	
	public function __call($name, $args)
	{
		if(method_exists($this->_field, $name))
			return call_user_func_array(array($this->_field, $name), $args);
	
		return FALSE;
	}

	#---------------------
	# Overwritable events
	#---------------------		

	/**
	 * ListIt2 Field Database Save method
	 *
	 * @return void
	 */	
	public function OnItemSave(ListIt2 &$mod)
	{
		$db = cmsms()->GetDb();
	
		$query  = 'DELETE FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_fieldval WHERE item_id = ? AND fielddef_id = ?';
		$result = $db->Execute($query, array($this->GetParentItem()->item_id, $this->GetId()));
			
		if (!$result)
			die('FATAL SQL ERROR: ' . $db->ErrorMsg() . '<br/>QUERY: ' . $db->sql);
	
		$query  = 'INSERT INTO ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_fieldval (item_id, fielddef_id, value_index, value) VALUES (?,?,?,?)';
		$index = 0;
		
		foreach($this->GetValue() as $one_val) {
		
			if(!$one_val)
				continue;
		
			$result = $db->Execute($query, array($this->GetParentItem()->item_id, $this->GetId(), $index, $one_val));

			if (!$result)
				die('FATAL SQL ERROR: ' . $db->ErrorMsg() . '<br/>QUERY: ' . $db->sql);

			$index++;						
		}
	}

	/**
	 * ListIt2 Field Database Load method
	 *
	 * @return void
	 */		
	public function OnItemLoad(ListIt2 &$mod)
	{
		$db = cmsms()->GetDb();
	
		$query = "SELECT value_index, value, data FROM " . cms_db_prefix() . "module_" . $mod->_GetModuleAlias() . "_fieldval WHERE fielddef_id = ? AND item_id = ?";
		$dbr = $db->Execute($query, array($this->GetId(), $this->GetParentItem()->item_id));
	
		$input_arr = array();
		while($dbr && !$dbr->EOF) {
		
			if(!is_null($dbr->fields['data'])) {
			
				$this->SetValue(unserialize($dbr->fields['data']));
				return;
			}
		
			$input_arr[$dbr->fields['value_index']] = $dbr->fields['value'];
			$dbr->MoveNext();
		}
		
		if($dbr) 
			$dbr->Close();			
			
		$this->SetValue($input_arr); // <- Always set array, regardless of contents, check if this can fail.	
	}	

	/**
	 * Executed in edit_item action. Just before database save process is about to take place.
	 *
	 * @return void
	 */	
	public function ItemSavePreProcess(&$errors, &$params) 
	{
		$this->_field->Validate($errors);
	}	

	#---------------------
	# Utility methods
	#---------------------	

	protected function GetField()
	{
		return $this->_field;
	}

} // end of class

?>	