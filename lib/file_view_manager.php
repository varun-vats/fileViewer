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
		$validatorResponse = $this->validator->validateParamsForFile($fileData);
		if($validatorResponse['status'] == true) {
			$fileContent = $this->fileReaderUtil->readFileContent($fileData,self::MAX_RECORDS_TO_DISPLAY);
			$fileStatus['status'] = true;
			$fileStatus['content']['lines'] = $fileContent['content'];
			$fileStatus['content']['newPage'] = $fileContent['newPage'];
		}
		else {
			$fileStatus['status'] = false;
			$fileStatus['reason'] = $validatorResponse['errMsg'];
		}
		return $fileStatus;
	}
}
