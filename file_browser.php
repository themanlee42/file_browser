<?php
/**
 * 
 * @author Jason Lee
 * @license MIT
 * @date 7/8/2015
 * 
 * Simple Ajax File Browser
 */
class fileBrowserException extends Exception {
}
class fileBrowser {
	protected $directory;
	protected $files = array ();
	
	/**
	 *
	 * @param string $currentDir        	
	 */
	function __construct($currentDir) {
		$this->scanDir ( $currentDir );
	}
	
	/**
	 *
	 * @return string
	 */
	public function getDirectory() {
		return $this->directory;
	}
	
	/**
	 *
	 * @return array
	 */
	public function getFiles() {
		return $this->files;
	}
	
	/**
	 *
	 * Need to modify later to take base64 encoded string for unicode 
	 * @param string $currentDir        	
	 * @return boolean
	 */
	public function scanDir($currentDir) {
		$this->directory = $currentDir;
		$this->files = array ();
		return $this->_scanDir ();
	}
	
	/**
	 *
	 * @return boolean
	 */
	private function _scanDir() {
		try {
			if (is_dir ( $this->directory )) {
				// scan all files
				$handle = @opendir ( $this->directory );
				while ( false !== ($filename = @readdir ( $handle )) ) {
					$this->files [] = $this->directory . '/' . $filename;
				}
				@closedir ( $handle );
			} else {
				if (is_file ( $this->directory )) {
					return false;
				}
			}
			
			sort($this->files);
			
		} catch ( fileBrowserException $e ) {
			// handle error
		}
		return true;
	}
	

	/**
	 *
	 *	check if it's a directory
	 *  force sort directory to the top of array
	 *  remove . and .. directory
	 *
	 * @return array
	 *
	 */
	public function getList() {
	
		$tempDirs = array();
		$tempFiles = array();
		$list = array();
	
		$count = 0;
		foreach ( $this->getFiles() as $file ) {
			$basename = basename($file);
			if($basename == '.' || $basename == '..'){
				continue;
			}
				
			if (is_dir ( $file )) {
				$tempDirs[$count] = array('type'=>'D','base'=>$basename,'full'=>$file);
			}
			else if(is_file($file)){
				$tempFiles[$count] = array('type'=>'F','base'=>$basename,'full'=>$file);
			}
			$count++;
	
		}
	
		$list = $tempDirs + $tempFiles;
	
		return $list;
	}
	

	/**
	 *
	 * @return string
	 */
	public function getListJson() {
			
		return json_encode($this->getList());
	}
	
}

?>