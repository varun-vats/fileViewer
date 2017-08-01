<?php

class FileViewManagerTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @dataProvider dataProvider
	 */
	public function testGetContents($fileData,$responseData) {
		$fileManagerObj = FileViewFactory::getInstance()->getFileVIewManager();
		$response = $fileManagerObj->getContents($fileData);
		$this->assertEquals($response['status'] , $responseData['status']);
		$this->assertEquals($response['reason'] , $responseData['reason']);
	}

	public function dataProvider(){
		return array(                       
			array(                          
				array(                      
					'path' => '/tmp/my_folder',
					'type' => 'first',
					'page' => '1'
				),
				array(
					'status' => false,
					'reason' => 'Some error occured in reading file'
				)                      
			),
			array(                          
				array(                      
					'path' => '/tmp/test',
					'type' => 'first',
					'page' => '1'
				),
				array(
					'status' => true,
					'reason' => ''
				)                      
			),
			array(                          
				array(                      
					'path' => '/tmp/test',
					'type' => 'next',
					'page' => '2'
				),
				array(
					'status' => true,
					'reason' => ''
				)                      
			),
			array(                          
				array(                      
					'path' => '/tmp/test',
					'type' => 'last',
					'page' => '434344343434'
				),
				array(
					'status' => true,
					'reason' => ''
				)                      
			),


		);
	}

}
