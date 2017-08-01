<?php

class FileReaderExceptionTest extends PHPUnit_Framework_TestCase
{

	public function testcreateObject() {
		$exception = new Exception("This is exception while reading file");
		$fileName = LOG_FILE_PATH."fileReadError".date("Y-m-d").".log";
		$obj = new FileReaderException($exception);
		$currTime = time();
		$time = filemtime($fileName);
		$this->assertEquals($currTime , $time);
	}

}
