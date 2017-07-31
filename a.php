<?php

$fp = fopen("test1","a");
$i=1;
while($i<1000000){
$text = "this sequence is $i";
$i++;
fwrite($fp,$text."\n");
}
fclose($fp);
