<?php
$this->breadcrumbs=array(
	'Members',
);

$this->menu=array(
array('label'=>'Create Member','url'=>array('create')),
array('label'=>'Manage Member','url'=>array('admin')),
);
?>

<h1>Members</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
