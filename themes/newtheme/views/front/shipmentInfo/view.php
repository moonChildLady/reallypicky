<?php
$this->breadcrumbs=array(
	'Shipment Infos'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List ShipmentInfo','url'=>array('index')),
array('label'=>'Create ShipmentInfo','url'=>array('create')),
array('label'=>'Update ShipmentInfo','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete ShipmentInfo','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage ShipmentInfo','url'=>array('admin')),
);
?>

<h1>View ShipmentInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'comp_id',
		'destination_country_codes',
		'destination_name',
		'shipment_method',
		'est_shipment_days',
		'shipment_cost1',
		'shipment_order_price1',
		'shipment_order_price_currency_1',
		'shipment_cost2',
		'shipment_order_price2',
		'shipment_order_price_currency_2',
),
)); ?>
