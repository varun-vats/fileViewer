<?php
class FileReaderException extends Exception
{
	public function __construct($e = null, $message = "", $code = 0) {
		$this->logException($e,$message,$code);
		parent::__construct($message, $code, $e);
	}

	private function logException($e,$msg,$code) {
		$fileName = LOG_FILE_PATH."fileReadError".date("Y-m-d").".log";
		$exceptionStr = "Exception : ".$e;
		$exceptionStr .= " Message : ".$msg;
		$exceptionStr .= " Code : ".$code;
		file_put_contents($fileName,"\n".$exceptionStr,FILE_APPEND);
	}

}
