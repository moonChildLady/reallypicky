<?php
$this->breadcrumbs=array(
	'Country Codes'=>array('index'),
	$model->country_code=>array('view','id'=>$model->country_code),
	'Update',
);

	$this->menu=array(
	array('label'=>'List CountryCode','url'=>array('index')),
	array('label'=>'Create CountryCode','url'=>array('create')),
	array('label'=>'View CountryCode','url'=>array('view','id'=>$model->country_code)),
	array('label'=>'Manage CountryCode','url'=>array('admin')),
	);
	?>

	<h1>Update CountryCode <?php echo $model->country_code; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>