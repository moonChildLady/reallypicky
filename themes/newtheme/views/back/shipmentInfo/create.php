<?php
$this->breadcrumbs=array(
	'Shipment Infos'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List ShipmentInfo','url'=>array('index')),
array('label'=>'Manage ShipmentInfo','url'=>array('admin')),
);
?>

<h1>Create ShipmentInfo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>