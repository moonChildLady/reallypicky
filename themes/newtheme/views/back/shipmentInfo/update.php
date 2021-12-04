<?php
$this->breadcrumbs=array(
	'Shipment Infos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List ShipmentInfo','url'=>array('index')),
	array('label'=>'Create ShipmentInfo','url'=>array('create')),
	array('label'=>'View ShipmentInfo','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ShipmentInfo','url'=>array('admin')),
	);
	?>

	<h1>Update ShipmentInfo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>