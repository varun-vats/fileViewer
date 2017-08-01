<?php

class FileViewValidatorTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @dataProvider dataProvider
	 */
	public function testValidateParamsForFile($fileData,$responseData) {
		$fileValidatorObj =  new FileViewValidator();
		$response = $fileValidatorObj->validateParamsForFile($fileData);
		$this->assertEquals($response['status'] , $responseData['status']);
		$this->assertEquals($response['errMsg'] , $responseData['errMsg']);
	}

	public function dataProvider(){
		return array(                       
			array(                          
				array(                      
					'path' => '/var/www/fileViewer/controller/viewFile.php',
					'type' => 'first',
					'page' => '1'
				),
				array(
					'status' => false,
					'errMsg' => 'Enter valid file path'
				)                      
			),
			array(                          
				array(                      
					'path' => '/tmp/rfddfk34',
					'type' => 'first',
					'page' => '1'
				),
				array(
					'status' => false,
					'errMsg' => 'Enter valid file path'
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
					'errMsg' => ''
				)                      
			),
			array(                          
				array(                      
					'path' => '/tmp/test',
					'type' => 'lastfsd',
					'page' => '434344343434'
				),
				array(
					'status' => false,
					'errMsg' => 'Invalid action type'
				)                      
			),
			array(
				array(
					'path' => '/tmp/test',
					'type' => 'first',
					'page' => '434344343434'
				),
				array(
					'status' => true,
					'errMsg' => ''
				)
			),
			array(
				array(
					'path' => '/tmp/test',
					'type' => 'prev',
					'page' => '2'
				),
				array(
					'status' => true,
					'errMsg' => ''
				)
			),
			array(
				array(
					'path' => '/tmp/test',
					'type' => 'next',
					'page' => '434344343434'
				),
				array(
					'status' => true,
					'errMsg' => ''
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
					'errMsg' => ''
				)
			),
			array(
				array(
					'path' => '/tmp/test',
					'type' => 'first',
					'page' => '-2'
				),
				array(
					'status' => false,
					'errMsg' => 'Invalid page'
				)
			),
			array(
				array(
					'path' => '/tmp/test',
					'type' => 'next',
					'page' => 'dsjksd'
				),
				array(
					'status' => false,
					'errMsg' => 'Invalid page'
				)
			),
			array(
				array(
					'path' => '/tmp/test',
					'type' => 'last',
					'page' => '0'
				),
				array(
					'status' => false,
					'errMsg' => 'Invalid page'
				)
			)



		);
	}

}
