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

class listit2eh_Categories extends ListIt2EventHandlerBase
{
	#---------------------
	# Magic methods
	#---------------------		
	
	public function __construct(ListIt2FielddefBase &$field)
	{
		parent::__construct($field);
	}
	
	#---------------------
	# Database methods
	#---------------------	
	
	/**
	 * ListIt2 Field Database Save method
	 *
	 * @package ListIt2
	 * @since 1.4-beta2
	 * @return void
	 */	
	public function OnItemSave(ListIt2 &$mod)
	{
		$db = cmsms()->GetDb();
	
		$query  = 'DELETE FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item_categories WHERE item_id = ?';
		$result = $db->Execute($query, array($this->GetParentItem()->item_id));

		$query  = 'INSERT INTO ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item_categories (item_id, category_id) VALUES (?,?)';

		if(count($this->GetValue())) {
		
			foreach ($this->GetValue() as $category_id) {		
		
				$result = $db->Execute($query, array($this->GetParentItem()->item_id, $category_id));

				if (!$result)
					die('FATAL SQL ERROR: ' . $db->ErrorMsg() . '<br/>QUERY: ' . $db->sql);
			}
		}
	}
	
	/**
	 * ListIt2 Field Database Load method
	 *
	 * @package ListIt2
	 * @since 1.4-beta2
	 * @return void
	 */		
	public function OnItemLoad(ListIt2 &$mod)
	{
		$db = cmsms()->GetDb();
	
		$query = 'SELECT B.category_id FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category B 
					LEFT JOIN ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item_categories IB 
					ON B.category_id = IB.category_id 
					WHERE IB.item_id = ? 
					AND B.active = 1';			
		
		$this->SetValue($db->GetCol($query, array($this->GetParentItem()->item_id)));
	}	
	
} // end of class

?>	