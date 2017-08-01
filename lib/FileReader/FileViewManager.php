<?php
class FileViewManager {
	private $validator;
	private $fileReaderUtil;
	public function __construct($validator,$fileReaderUtil) {
		$this->validator = $validator;
		$this->fileReaderUtil = $fileReaderUtil;
	}
	
	public function getContents($fileData) {
		$fileStatus = array();
		try {
			$fileStatus['reason'] ='';
			$validatorResponse = $this->validator->validateParamsForFile($fileData);
			if($validatorResponse['status'] == true) {
				$fileContent = $this->fileReaderUtil->readFileContent($fileData);
				$fileStatus['status'] = true;
				$fileStatus['content']['lines'] = $fileContent['content'];
				$fileStatus['content']['newPage'] = $fileContent['newPage'];
				$fileStatus['content']['type'] = $fileContent['type'];
			}
			else {
				$fileStatus['status'] = false;
				$fileStatus['reason'] = $validatorResponse['errMsg'];
			}
		}
		catch(FileReaderException $e){
			$fileStatus['status'] = false;
			$fileStatus['reason'] = "Some error occured in reading file";

		}
		catch(Exception $e) {
			$fileStatus['status'] = false;
			$fileStatus['reason'] = "Unknown error occured";
		}
		return $fileStatus;
	}
}
