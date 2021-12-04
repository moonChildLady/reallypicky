<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Order','url'=>array('index')),
array('label'=>'Create Order','url'=>array('create')),
array('label'=>'Update Order','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Order','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Order','url'=>array('admin')),
);
?>

<h1>View Order #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'member_id',
		'order_status',
		'order_status_internal',
		'shipment_cost',
		'shipment_cost_currency',
		'title',
		'name',
		'phone',
		'address',
		'postal_code',
		'country',
		'remarks',
		'remarks_internal',
		'total_order_price',
		'total_order_price_currency',
		'order_created_date',
		'last_order_status_update',
),
)); ?>
