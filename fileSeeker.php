<?php
$filePath = "test1";
                exec("wc -l ".escapeshellarg($filePath)." | cut -f1 -d' '",$output);
print_R($output);die;
$file = new SplFileObject('test');
$file->seek(898988990);     // Seek to line no. 10,000
echo $file->current(); // Print contents of that line
die;
$pos = 0 ;// Skip final new line character (Set to -1 if not present)

$lines = array();
$currentLine = '';
$numberLines = 0;
$fp = fopen("test1","r");
while(fseek($fp, $pos, SEEK_SET)!==-1) {
	if(!feof($fp)) {
		$pos++;
	}
	else{
		break;
	}
}
echo $pos;die;
while (-1 !== fseek($fp, $pos, SEEK_SET)) {
	$char = fgetc($fp);
	if (PHP_EOL == $char) {
		if($currentLine!="") {
			$numberLines ++;
			$lines[] = $currentLine;
			$currentLine = '';
		}
	} else {
		$currentLine = $currentLine.$char;
	}
	$pos++;
}
fclose($fp);
echo $pos;

print_R($lines);

