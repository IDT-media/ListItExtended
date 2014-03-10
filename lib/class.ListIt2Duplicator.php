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

class ListIt2Duplicator {

	#---------------------
	# Constants
	#---------------------
	
	const MOD_PREFIX = 'ListIt2';
	const PLACEHOLDER = '024fc70d51074c9f42ee7f917c37b4ed';

	#---------------------
	# Attributes
	#---------------------

	private $src;
	private $dst;
	private $modname;
	private static $_invalid = array('.', '..');

	#---------------------
	# Magic methods
	#---------------------		
		
	public function __construct($modname = self::PLACEHOLDER) 
	{
		$this->modname = self::MOD_PREFIX . $modname;
		$this->src = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'duplicate';
		$this->dst = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . $this->modname;
	}

	#---------------------
	# Set/Get
	#---------------------		
	
	public function SetModule($name)
	{
		$this->modname = $name;
	}
	
	public function SetSource($name)
	{
		$this->src = $name;
	}

	public function SetDestination($name)
	{
		$this->dst = $name;
	}	
	
	#---------------------
	# Runner
	#---------------------
	
	public function Run()
	{
		$this->CopyRecursive($this->src, $this->dst);
		$this->Rename();
		$this->FixModulefile();
		
		return $this->modname;
	}
		
	#---------------------
	# File handling methods
	#---------------------		

	private final function CopyRecursive($src, $dst) 
	{
		$dir = opendir($src); // <- Throw exception on failure?
		@mkdir($dst); // <- Throw exception on failure?
		
		while(false !== ( $file = readdir($dir)) ) {
		
			if (in_array($file, self::$_invalid)) continue; // <- Skip stuff we never allow to copy

			if ( is_dir($src . DIRECTORY_SEPARATOR . $file) ) { 
				$this->CopyRecursive($src . DIRECTORY_SEPARATOR . $file, $dst . DIRECTORY_SEPARATOR . $file); 
			} 
			else { 
				@copy($src . DIRECTORY_SEPARATOR . $file, $dst . DIRECTORY_SEPARATOR . $file); // <- Throw exception on failure?
			} 
		} 
		
		closedir($dir); 
	}
	
	private final function Rename() 
	{
		@rename($this->dst . DIRECTORY_SEPARATOR . self::PLACEHOLDER, 
			$this->dst . DIRECTORY_SEPARATOR . $this->modname .'.module.php'); // <- Throw exception on failure?
	}
	
	private final function FixModulefile() 
	{
		$filename = $this->dst . DIRECTORY_SEPARATOR . $this->modname .'.module.php';

		// Replacements
		$_contents = file_get_contents($filename); // <- Throw exception on failure?
		$_contents = str_replace(self::PLACEHOLDER, $this->modname, $_contents);
	
		// Write file
		$fh = @fopen($filename, 'w');
		fwrite($fh, $_contents); // <- Throw exception on failure?
		fclose($fh);	
	}	
	
} // end of class