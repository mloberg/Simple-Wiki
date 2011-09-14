<?php

	function page_title($page){
		if($page == '') return 'Home';
		// replace - and _ with spaces
		$page = str_replace('_', ' ', str_replace('-', ' ', $page));
		$page = preg_replace('/(\/)(.)/', ' $1 $2', $page);
		return ucwords($page);
	}
	
	class DirScan{
	
		private static $dir;
		private static $files = array();
		
		function __construct($dir){
			self::scan($dir);
		}
		
		function files(){
			return self::$files;
		}
		
		private static function scan($dir){
			foreach(glob($dir.'/*') as $file){
				if(is_dir($file)){
					self::scan($file);
				}else{
					array_push(self::$files, $file);
				}
			}
		}
	
	}