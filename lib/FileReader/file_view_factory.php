<?php
class FileViewFactory {
	private static $instance;

	public static function getInstance() {
		if(! isset(self::$instance)) {
			$class = __CLASS__;
			self::$instance = new $class();
		}
		return self::$instance;
	}

	private function __construct() {

	}

	public function getFileViewManager(){
		$validator = new FileViewValidator();
		$fileReaderUtil = new FileReaderUtility();
		return new FileViewManager($validator,$fileReaderUtil);
	}

}
