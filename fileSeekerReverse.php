<?php
$pos = -1;// Skip final new line character (Set to -1 if not present)

$lines = array();
$currentLine = '';
$numberLines = 0;
$fp = fopen("test1","r");
while (-1 !== fseek($fp, $pos, SEEK_END)) {
	$char = fgetc($fp);
	if (PHP_EOL == $char) {
		if($currentLine!="") {
			$numberLines ++;
			$lines[] = $currentLine;
			$currentLine = '';
		}
	} else {
		$currentLine = $char.$currentLine;
	}
	if($numberLines==10) {
		break;
	}
	$pos--;
}
fclose($fp);
echo $pos;

print_R($lines);

