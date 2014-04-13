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

/**
 * ListIt2 Fielddef Base
 *
 * @package ListIt2
 * @author Tapio Löytty
 * @since 1.3
 */
abstract class ListIt2FielddefBase implements ArrayAccess
{
	#---------------------
	# Constants
	#---------------------
	
	const TYPE_STRING 			= "string";
	const TYPE_ARRAY 			= "array";
	const TYPE_OBJECT 			= "object";

	#---------------------
	# Variables
	#---------------------	

	private $id;
	private $name;
	private $alias;
	private $description;
	private $type;
	private $friendlytype;
	private $value;
	private $originator;
	private $active;
	private $disabled;
	private $path;
	private $position;
	private $required;
	private $options;
	private $caller;
	private $item_id; // deprecated
	private $parent_array;
	
	protected $event_handler;
	
	#---------------------
	# Magic methods
	#---------------------	
	
	public function __construct(&$db_info, $caller_object = null) {
	
		$this->id = -1;
		$this->name = '';
		$this->alias = '';
		$this->description = '';
		$this->type = $db_info->type;
		$this->originator = $db_info->originator;
		$this->active = $db_info->active;
		$this->disabled = $db_info->disabled;
		$this->path = $db_info->path;		
		$this->friendlytype = $db_info->type;
		$this->value = new ListIt2FielddefValue;
		$this->position = -1;
		$this->required = 0;
		$this->options = array();
		$this->caller = null;
		$this->item_id = -1;
		
		if($caller_object instanceof CMSModule) {
		
			$this->caller = $caller_object->GetName();
		}
	}
	
	public function __get($key)
	{
		return $this->_overwrite_constants($key);	
	}
	
	public function __toString()
	{
		return (string)$this->value;
	}
	
	public function __call($name, $args)
	{
		return FALSE;
	}
	
	#---------------------
	# Array methods
	#---------------------		

    public function offsetGet($offset) 
	{			
		return $this->_overwrite_constants($offset);
    }

    public function offsetSet($offset, $value) {}
    public function offsetExists($offset) {}
    public function offsetUnset($offset) {}
	
	#---------------------
	# Private methods
	#---------------------		

	private function _overwrite_constants($key)
	{
		switch($key) {
		
			case 'name':
				return $this->GetName();
				
			case 'value':
				return $this->GetValue(self::TYPE_STRING);
								
			case 'type':
				return $this->GetType();
				
			case 'alias':
				return $this->GetAlias();	

			default:
				return null;
		}	
	}
	
	#---------------------
	# get/set methods
	#---------------------		
	
	public final function GetId() {
	
		return $this->id;
	}

	public final function SetId($value) {
	
		$this->id = $value;
	}	
	
	public final function GetName() {
	
		return $this->name;
	}

	public final function SetName($value) {
	
		$this->name = $value;
	}

	public final function GetAlias() {
	
		return $this->alias;
	}

	public final function SetAlias($value) {
	
		$this->alias = $value;
	}	
	
	public final function GetDesc() {
	
		return $this->description;
	}

	public final function SetDesc($value) {
	
		$this->description = $value;
	}		
	
	public final function GetType() {
	
		return $this->type;
	}
	
	public final function GetFriendlyType() {
	
		return $this->friendlytype;
	}

	public final function SetFriendlyType($value) {
	
		$this->friendlytype = $value;
	}

	public final function HasValue()
	{
		if($this->GetValue(self::TYPE_STRING) !== '')
			return true;
		
		return false;
	}
	
	public final function GetValue($type = self::TYPE_OBJECT) {
	
		$type = strtolower($type);
	
		switch($type) {
			case self::TYPE_STRING:
				return (string)$this->value;
			
			case self::TYPE_ARRAY:
				return (array)$this->value;
			
			default:
				return $this->value;
		}
	}

	public final function SetValue($value = array()) {
				
		$this->value = new ListIt2FielddefValue($value);
	}
	
	public final function GetOriginator() {
	
		return $this->originator;
	}

	public final function IsActive() {
	
		return $this->active ? true : false;
	}	
	
	public final function IsDisabled() {
	
		return $this->disabled ? true : false;
	}		
	
	// deprecated
	public final function GetActive() {
	
		return $this->active;
	}

	public final function GetPosition() {
	
		return $this->position;
	}

	public final function SetPosition($value) {
	
		$this->position = $value;
	}	

	public final function GetPath() {
	
		return $this->path;
	}
	
	public final function GetURLPath() {
	
		$config = cmsms()->GetConfig();
		
		$url = substr($this->GetPath(), strlen($config['root_path']));
		$url = str_replace(DIRECTORY_SEPARATOR, '/', $url);
		$url = $config['root_url'] . $url;
		
		return $url;
	}	

	public final function IsRequired() {
	
		return $this->required ? true : false;
	}
	
	public final function GetRequired() {
	
		return $this->required;
	}

	public final function SetRequired($value) {
	
		$this->required = $value;
	}	

	public final function GetItemId() {
	
		return $this->GetParentItem()->item_id;
	}
	
	public final function GetItemAlias() {
	
		return $this->GetParentItem()->alias;
	}	

	// deprecated
	public final function SetItemId($value) {
	
		$this->item_id = $value;
	}
	
	public final function GetParentArray() {
	
		if(isset($this->parent_array))
			return $this->parent_array;
			
		return FALSE;
	}

	public final function SetParentArray(ListIt2FielddefArray &$obj) {
	
		$this->parent_array = $obj;
	}	
	
	public final function GetParentItem() {
	
		if($this->GetParentArray())
			if($this->GetParentArray()->GetParentItem())
				return $this->GetParentArray()->GetParentItem();
			
		return FALSE;
	}

	#---------------------
	# Option methods
	#---------------------		

	public final function GetOptionValues()
	{
		return $this->options;
	}
	
	public final function GetOptionValue($key, $default = '')
	{
		return isset($this->options[$key]) ? $this->options[$key] : $default;
	}
	
	public final function SetOptionValue($key, $value)
	{
		$this->options[$key] = $value;
	}	

	#---------------------
	# Overwrite methods
	#---------------------	

	static public function GetModuleDeps()
	{
		return null;
	}
	
	public function GetHeaderHTML()
	{
		return null;
	}	
	
	public function IsUnique()
	{
		return FALSE;
	}
	
	public function RenderForAdminListing($id, $returnid)
	{
		return $this->GetValue(self::TYPE_STRING);
	}
	
	public function RenderForEdit($id, $returnid)
	{
		$fn = $this->GetPath() . DIRECTORY_SEPARATOR . 'admin.' . $this->GetType() . '.tpl';
		if(is_readable($fn)) {

			$smarty = cmsms()->GetSmarty();
			
			$smarty->assign('actionid', $id);
			$smarty->assign('returnid', $returnid);
		
			return $smarty->fetch($fn);
		}
	}
	
	public function RenderInput($id, $returnid)
	{		
		$fn = $this->GetPath() . DIRECTORY_SEPARATOR . 'input.' . $this->GetType() . '.tpl';
		if(is_readable($fn)) {
	
			$smarty = cmsms()->GetSmarty();
			
			$smarty->assign('actionid', $id);
			$smarty->assign('returnid', $returnid);		
	
			return $smarty->fetch($fn);
		}
	}	
	
	public function Validate(&$errors) 
	{
		if($this->GetValue(self::TYPE_STRING) == '' && $this->IsRequired()) {
	
			$errors[] = $this->ModLang('required_field_empty') . ' (' . $this->GetName() . ')';
		}
	}
	
	#---------------------
	# Event handler
	#---------------------	
	
	/************************************
	  NOTICE: Highly experimental
	************************************/
	
	// Should i make this final or not, lets leave it like this for now.
	public function EventHandler()
	{
		// Check if field has own event handler
		if(!isset($this->event_handler)) {
		
			$fn = $this->GetPath() . DIRECTORY_SEPARATOR . 'listit2eh.' . $this->GetType() . '.php';
			if(is_readable($fn)) {
			
				require_once($fn);
				
				$class = 'listit2eh_'.$this->GetType();
				if(class_exists($class))
					$this->event_handler = new $class($this);
			}
		}
		
		// Ensure that we have default event handler
		if(!isset($this->event_handler))
			$this->event_handler = new ListIt2EventHandlerBase($this);
		
		return $this->event_handler;
	}

	#---------------------
	# Module methods
	#---------------------
	
	public final function GetModuleInstance($caller = false)
	{	
		if($caller && !is_null($this->caller))
			return cmsms()->GetModuleInstance($this->caller);

		return cmsms()->GetModuleInstance($this->originator);
	}
	
	#---------------------
	# Lang methods
	#---------------------	
	
	public final function ModLang()
	{
		$args = func_get_args();
	
		return ListIt2LangOperations::lang_from_realm($this->originator, $args);
	}
	
} // end of class

/**
 * ListIt2 Fielddef value
 *
 * @package ListIt2
 * @author Tapio Löytty
 * @since 1.3.1
 */
class ListIt2FielddefValue extends ArrayObject
{ 
	#---------------------
	# Magic methods
	#--------------------- 

    public function __construct($array = array()) 
	{
        foreach((array)$array as $key => $value) {
		
            $this->offsetSet($key, $value);
        }
	}
	
	public function __toString()
	{
		return (string)implode(LISTIT2_VALUE_SEPARATOR, (array)$this);
	}
	
} // end of class
?>
