<?php
$this->breadcrumbs=array(
	'Country Codes'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List CountryCode','url'=>array('index')),
array('label'=>'Manage CountryCode','url'=>array('admin')),
);
?>

<h1>Create CountryCode</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>