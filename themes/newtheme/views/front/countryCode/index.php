<?php
$this->breadcrumbs=array(
	'Country Codes',
);

$this->menu=array(
array('label'=>'Create CountryCode','url'=>array('create')),
array('label'=>'Manage CountryCode','url'=>array('admin')),
);
?>

<h1>Country Codes</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
