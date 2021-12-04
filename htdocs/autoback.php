<?php
echo 1;
if($_POST){
	echo 'isPost';
	foreach($_POST as $val){
		echo $val."<br>";
	}
}
?>