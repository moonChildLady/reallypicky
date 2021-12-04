<?php 

$File = "pay.txt"; 
 $Handle = fopen($File, 'a');
if($_POST){
	echo 'isPost';
	foreach($_POST as $val){
		$Data = $val."\n"; 
 		fwrite($Handle, $Data); 
	}
}
fclose($Handle); 
?>