<?php
class FileReaderUtility {
	public function readFileContent($reqData){
		try {
			$fileObj = new SplFileObject($reqData['path']);
			$newCurrPage = $this->getNewCurrPage($reqData);
			$start = ($newCurrPage-1)*LINES_PER_PAGE;
			$end = $start+LINES_PER_PAGE-1;
			$pageType = $reqData['type'];
			for($i=$start;$i<=$end && $i>=0;$i++){
				$content = array();
				$fileObj->seek($i);
				if(!$fileObj->eof()) {
					$content['lineNo'] = $i+1;
					$content['line'] = $fileObj->current();
				}
				else{
					$pageType = "last";
					break;
				}

				$arrContent[] = $content;
			}
			$fileContent['content']	= $arrContent;
			$fileContent['newPage'] = $newCurrPage;
			$fileContent['type'] = $pageType;
			return $fileContent;
		}
		catch(Exception $e){
			throw new FileReaderException($e,$e->getMessage());
		}
	}

	private function getNewCurrPage($reqData){
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
			$currPage = ceil($totalLines/LINES_PER_PAGE);
		}
		$currPage = $currPage< 1 ? 1 :$currPage;
		return $currPage;
	}

	private function getTotalLines($filePath) {
		exec("wc -l ".escapeshellarg($filePath)." | cut -f1 -d' '",$output);
		return $output[0];
	}

}
