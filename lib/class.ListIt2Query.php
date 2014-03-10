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

abstract class ListIt2Query
{
	#---------------------
	# Constants
	#---------------------
	
	const VARTYPE_JOINS 	= 'joins';
	const VARTYPE_WHERE 	= 'where';
	const VARTYPE_ORDERBY 	= 'orderby';
	const VARTYPE_QPARAMS 	= 'qparams';

	#---------------------
	# Attributes
	#---------------------
	
	private $_params;
	private $_instance;
	//private $_db;

	protected $joins;
	protected $where;
	protected $orderby;
	protected $qparams;

	protected $query; // Not set	
	protected $resultset; // Not set
	protected $totalcount; // Not set
	protected $pagecount; // Not set

	#---------------------
	# Magic methods
	#---------------------		
	
	public function __construct(ListIt2 &$mod, &$params)
	{
		//$this->_db 			= cmsms()->GetDb();	
		$this->_instance 	= $mod;
		$this->_params 		= $params;
		
		$this->joins 		= array();
		$this->where 		= array();
		$this->orderby 		= array();
		$this->qparams 		= array();
	}
	
	#---------------------
	# Abstract methods
	#---------------------	
	
	abstract protected function _query();
	
	#---------------------
	# Utility methods
	#---------------------	
		
	protected function GetDb()
	{
		return cmsms()->GetDb();
	}
	
	public function GetModuleInstance()
	{
		return $this->_instance;
	}	
	
	public function GetParams()
	{
		return $this->_params;
	}	
	
	public function SetParam($key, $value)
	{
		$this->_params[$key] = $value;
	}
	
	public function GetParam($key)
	{
		return isset($this->_params[$key]) ? $this->_params[$key] : null;
	}
		
	#---------------------
	# Database methods
	#---------------------	
	
	public function AppendTo($var, $value)
	{
		$var = strtolower($var);
		$value = (string)$value;
	
		switch($var) {
		
			case self::VARTYPE_JOINS:
				$this->joins[] = $value;
				break;
				
			case self::VARTYPE_WHERE:
				$this->where[] = $value;
				break;

			case self::VARTYPE_ORDERBY:
				$this->orderby[] = $value;
				break;

			case self::VARTYPE_QPARAMS:
				$this->qparams[] = $value;
				break;				
		
			default:
				throw new ListIt2Exception('Attempt to set unidentified VARTYPE.');
		}
		
		return true;
	}

	public function Execute($force_execute = false)
	{
		if(!isset($this->resultset) || $force_execute)
			$this->_query();
			
		return $this->resultset;
	}
	
	public function TotalCount()
	{
		if(isset($this->totalcount))
			return $this->totalcount;
			
		return null;
	}
	
	public function GetPageCount()
	{
		if(isset($this->pagecount))
			return $this->pagecount;
			
		return null;
	}
	
	public function GetPageLimit()
	{
		if(isset($this->_params['pagelimit'])) 
			return (int)$this->_params['pagelimit'];
			
		return 100000;	
	}	
	
	public function GetPageNumber()
	{
		if(isset($this->_params['pagenumber'])) 
			return (int)$this->_params['pagenumber'];
			
		if(isset($this->_params['page'])) 
			return (int)$this->_params['page'];			
			
		return 1;	
	}	

} // end of class

?>	