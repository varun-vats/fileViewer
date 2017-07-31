<?php
class FileReaderUtility {
	public function readFileContent($reqData,$recToDisp){
		try {
			$fileObj = new SplFileObject($reqData['path']);
			$newCurrPage = $this->getNewCurrPage($reqData,$recToDisp);
			$start = ($newCurrPage-1)*$recToDisp;
			$end = $start+$recToDisp-1;
			for($i=$start;$i<=$end;$i++){
				$content = array();
				$fileObj->seek($i);
				if(!$fileObj->eof()) {
					$content['lineNo'] = $i+1;
					$content['line'] = $fileObj->current();
				}
				else{
					$arrContent[] = "EOF";
					break;
				}
				$arrContent[] = $content;
			}
			$fileContent['content']	= $arrContent;
			$fileContent['newPage'] = $newCurrPage;
			return $fileContent;
		}
		catch(Exception $e){
			throw new FileReaderException($e,$e->getMessage());
		}
	}

	private function getNewCurrPage($reqData,$recToDisp){
		$pageType = $reqData['type'];
		$pageNo = $reqData['page'];
		if($pageType == "first") {
			$currPage = 1;
		}
		else if($pageType=="prev") {
			$currPage = $pageNo-1;
		}
		else if($pageType=="next"){
			$currPage = $pageNo+1;
		}
		else if($pageType == "last"){
			$totalLines = $this->getTotalLines($reqData['path']);
			$currPage = $totalLines/$recToDisp;
		}
		else{
			throw new Exception("Invalid Page Type");
		}
		return $currPage;
	}

	private function getTotalLines($filePath) {
		exec("wc -l ".escapeshellarg($filePath)." | cut -f1 -d' '",$output);
		return $output[0];
	}

}
