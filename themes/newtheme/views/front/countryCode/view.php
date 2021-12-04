<?php
$this->breadcrumbs=array(
	'Country Codes'=>array('index'),
	$model->country_code,
);

$this->menu=array(
array('label'=>'List CountryCode','url'=>array('index')),
array('label'=>'Create CountryCode','url'=>array('create')),
array('label'=>'Update CountryCode','url'=>array('update','id'=>$model->country_code)),
array('label'=>'Delete CountryCode','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->country_code),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage CountryCode','url'=>array('admin')),
);
?>

<h1>View CountryCode #<?php echo $model->country_code; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'country_code',
		'country_name_eng',
		'country_name_chi',
),
)); ?>
