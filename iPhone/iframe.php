<?php
	$sizes = array("16G","64G","128G");
	//0=sliver,1=gold,2=grey
	$colors = array("sliver","gold","grey");
	//0=I6,1=I6+
	$models = array("I6","I6+");
	$locations = array("R409"=>"Causeway Bay","R485"=>"Festival Walk","R428"=>"ifc mall");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$result =  $_POST["result"];
$idcard = $_POST["idcard"];
$tel = $_POST["tel"];
$sms_ = $_POST["sms"];
$location = $_POST["location"];
$jscode = file_get_contents("jscode");
$sms = file_get_contents("sms");
$output2_ = str_replace("your_phone", $tel, $sms);
$output2 = str_replace("your_code", $sms_, $output2_);

$model_ = explode("-",$result)[0];
$color_ = explode("-",$result)[1];
$size_ = explode("-",$result)[2];
$model_index = array_search($model_,$models);
$size_index = array_search($size_,$sizes);
$color_index = array_search($color_,$colors);

$output = str_replace("xxxx", $idcard, $jscode);

$output = str_replace("PHONE_MODEL", $model_index, $output);
$output = str_replace("PHONE_SIZE", $size_index, $output);
$output = str_replace("PHONE_COLOR", $color_index, $output);
$output = str_replace("LOCATION", $location, $output);
}
?>
<form action="" method="POST">
	tel:<input type="tel" name="tel" value="<?php echo $tel; ?>">
	sms:<input type="text" name="sms" value="<?php echo $sms_; ?>">
	location:
	<select name="location">
		<?php foreach ($locations as $key => $value) {
			echo "<option value='".$key."'>".$value."</option>";
		}?>
	</select>
	idcard:<input type="idcard" name="idcard" value="<?php echo $idcard; ?>"><br>
	<!--input type="submit" value="submit"-->

<?php
foreach($models as $key=>$model){
	foreach ($colors as $key2 => $color) {
		foreach ($sizes as $key => $size) {
			echo '<input type="submit" name="result" value="'.$model."-".$color."-".$size.'">';
		}
	echo "<br>";
	}

}
?>
</form>
<textarea rows="10" cols="50"><?php echo $output2;?></textarea>
<textarea rows="30" cols="150"><?php echo $output;?></textarea>