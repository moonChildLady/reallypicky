<?php
$this->breadcrumbs=array(
	'Order Items',
);

$this->menu=array(
array('label'=>'Create OrderItem','url'=>array('create')),
array('label'=>'Manage OrderItem','url'=>array('admin')),
);
?>

<h1>Order Items</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
