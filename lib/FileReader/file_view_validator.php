<?php
class FileViewValidator{
	public function validateParamsForFile($fileData) {
		$msg = '';
		$status = $this->validateFilePath($fileData['path']);
		if($status) {
			$status = $this->validatePage($fileData['page']);
			if($status){
				$status = $this->validateActionType($fileData['type']);
				if(!$status) {
					$msg = "Invalid action type";
				}
			}
			else {
				$msg = "Invalid page";
			}
		}
		else {
			$msg = "Enter valid file path";
		}
		$validationStatus['status'] = $status;
		$validationStatus['errMsg'] = $msg;
		return $validationStatus;		
	}

	private function validateFilePath($filePath){
		$pathArr = explode(SERVER_LOG_DIR,$filePath);
		if($pathArr[0]=="" && file_exists($filePath)) {
			return true;
		}
		else {
			return false;
		}
	}
	private function validatePage($pageName){
		if(is_numeric($pageName) && $pageName>0) {
			return true;
		}
		else{
			return "false";
		}
	}
	private function validateActionType($actionType) {
		if(in_array($actionType,VALID_ACTIONS)) {
			return true;
		}
		else{
			return false;
		}
	}

}
