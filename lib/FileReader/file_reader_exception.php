<?php
class FileReaderException extends Exception
{
	public function __construct($e = null, $message = "", $code = 0) {
		parent::__construct($message, $code, $e);
	}

}
