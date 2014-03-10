<?php
/**
 *
 * Copyright:
 *
 * IDT Media - Goran Ilic & Tapio Löytty
 * Web: www.i-do-this.com
 * Email: hi@i-do-this.com
 *
 *
 * Authors:
 *
 * Goran Ilic, <ja@ich-mach-das.at>
 * Web: www.ich-mach-das.at
 * 
 * Tapio Löytty, <tapsa@orange-media.fi>
 * Web: www.orange-media.fi
 *
 * License:
 *-------------------------------------------------------------------------
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 * Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
 *
 * ------------------------------------------------------------------------- */

namespace ListIt2;
 
 /**
 * IDT Class
 *
 * @package IDT Media modules
 * @author Tapio Löytty
 * @version 1.0
 */
class IDT
{
	#---------------------
	# Magic methods
	#---------------------		
	
	private function __construct() {}

	#---------------------
	# Classs methods
	#---------------------		
	
	static final public function getModuleHelp()
	{
		$cache = cms_join_path(TMP_CACHE_LOCATION, 'idt_module_help.cache');
		if(file_exists($cache))
			return @file_get_contents($cache);
					
		if($source = @file_get_contents('http://server.idt-media.com/index.php?page=idt-module-help&showtemplate=false'))
			@file_put_contents($cache, $source);
		
		return $source;
	}
	
} // end of class
?>