<?php
$this->breadcrumbs=array(
	'Exchange Rates',
);

$this->menu=array(
array('label'=>'Create ExchangeRate','url'=>array('create')),
array('label'=>'Manage ExchangeRate','url'=>array('admin')),
);
?>

<h1>Exchange Rates</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
