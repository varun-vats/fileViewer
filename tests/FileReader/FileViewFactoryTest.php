<?php

class FileViewFactoryTest extends PHPUnit_Framework_TestCase
{

	public function testGetInstance() {
		$factory = FileViewFactory::getInstance();
		$classname = get_class($factory);
		$this->assertEquals($classname , 'FileViewFactory');
	}

	public function testGetFileViewManager() {
		$manager = FileViewFactory::getInstance()->getFileViewManager();
		$this->assertEquals(get_class($manager) , 'FileViewManager');
	}

}
