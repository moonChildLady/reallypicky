<?php
$pgid = $_GET['pgid'];
$token = $_GET['token'];
$utm_source = $_GET['utm_source'];
$utm_medium = $_GET['utm_medium'];
//$utm_content = $_GET['utm_content'];
$utm_content = "20140728";
$utm_campaign = $_GET['utm_campaign'];
//echo "https://www.reallypicky.com/product/detail?token=$token&product_id=10001001&utm_source=$utm_source&utm_medium=$utm_medium&utm_content=$utm_content&utm_campaign=$utm_campaign";
//header("Location: https://www.reallypicky.com/product/detail?token=$token&product_id=$pgid");
header("Location: https://www.reallypicky.com/product/detail?token=$token&product_id=10001001&utm_source=$utm_source&utm_medium=$utm_medium&utm_content=$utm_content&utm_campaign=$utm_campaign");
?>
