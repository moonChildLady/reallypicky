<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->product_id=>array('view','id'=>$model->product_id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Product','url'=>array('index')),
	array('label'=>'Create Product','url'=>array('create')),
	array('label'=>'View Product','url'=>array('view','id'=>$model->product_id)),
	array('label'=>'Manage Product','url'=>array('admin')),
	);
	?>

	<h1>Update Product <?php echo $model->product_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>