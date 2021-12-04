<?php
$this->breadcrumbs=array(
	'Order Items'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List OrderItem','url'=>array('index')),
array('label'=>'Create OrderItem','url'=>array('create')),
array('label'=>'Update OrderItem','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete OrderItem','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage OrderItem','url'=>array('admin')),
);
?>

<h1>View OrderItem #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'order_id',
		'product_id',
		'type',
		'quantity',
		'price',
		'currency',
),
)); ?>
