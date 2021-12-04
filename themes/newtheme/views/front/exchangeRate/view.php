<?php
$this->breadcrumbs=array(
	'Exchange Rates'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List ExchangeRate','url'=>array('index')),
array('label'=>'Create ExchangeRate','url'=>array('create')),
array('label'=>'Update ExchangeRate','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete ExchangeRate','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage ExchangeRate','url'=>array('admin')),
);
?>

<h1>View ExchangeRate #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'currency_from',
		'currency_to',
		'rate',
),
)); ?>
