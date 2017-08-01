<?php

class FileReaderUtilityTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @dataProvider dataProvider
	 */
	public function testReadFileContent($fileData,$responseData) {
		$fileReaderObj =  new FileReaderUtility();
		$response = $fileReaderObj->readFileContent($fileData);
		$this->assertEquals($response['type'] , $responseData['type']);
		$this->assertEquals($response['newPage'] , $responseData['newPage']);
	}

	public function dataProvider(){
		return array(                       
			array(                          
				array(                      
					'path' => '/tmp/test',
					'type' => 'first',
					'page' => 1
				),
				array(
					'type' => 'first',
					'newPage' => 1
				)                      
			),
			array(                          
				array(                      
					'path' => '/tmp/test',
					'type' => 'prev',
					'page' => 1
				),
				array(
					'type' => 'prev',
					'newPage' => 1
				)                      
			),
			array(                          
				array(                      
					'path' => '/tmp/test',
					'type' => 'next',
					'page' => 2
				),
				array(
					'type' => 'next',
					'newPage' => 3
				)                      
			),
			array(                          
				array(                      
					'path' => '/tmp/test',
					'type' => 'prev',
					'page' => 10
				),
				array(
					'type' => 'prev',
					'newPage' => 9
				)                      
			),
			array(
				array(
					'path' => '/tmp/test',
					'type' => 'last',
					'page' => 1
				),
				array(
					'type' => 'last',
					'newPage' => 17
				)
			),
			array(
				array(
					'path' => '/tmp/test',
					'type' => 'next',
					'page' => 16
				),
				array(
					'type' => 'last',
					'newPage' => 17
				)
			),
			array(
				array(
					'path' => '/tmp/test',
					'type' => 'first',
					'page' => 17
				),
				array(
					'type' => 'first',
					'newPage' => 1
				)
			)
		);
	}

}
