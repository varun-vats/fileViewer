<?php
class FileViewManager {
	private $validator;
	private $fileReaderUtil;
	const MAX_RECORDS_TO_DISPLAY = 10;
	public function __construct($validator,$fileReaderUtil) {
		$this->validator = $validator;
		$this->fileReaderUtil = $fileReaderUtil;
	}
	
	public function getContents($fileData) {
		$fileStatus = array();
		try {
			$validatorResponse = $this->validator->validateParamsForFile($fileData);
			if($validatorResponse['status'] == true) {
				$fileContent = $this->fileReaderUtil->readFileContent($fileData,self::MAX_RECORDS_TO_DISPLAY);
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
			$fileStatus['reason'] = $e->getMessage();

		}
		catch(Exception $e) {
			$fileStatus['status'] = false;
			$fileStatus['reason'] = "Unknown error occured";
		}
		return $fileStatus;
	}
}
