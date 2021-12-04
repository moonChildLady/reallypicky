<?php
$this->breadcrumbs=array(
	'Shipment Infos',
);

$this->menu=array(
array('label'=>'Create ShipmentInfo','url'=>array('create')),
array('label'=>'Manage ShipmentInfo','url'=>array('admin')),
);
?>

<h1>Shipment Infos</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
