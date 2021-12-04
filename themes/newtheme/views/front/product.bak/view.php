<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->product_id,
);

$this->menu=array(
array('label'=>'List Product','url'=>array('index')),
array('label'=>'Create Product','url'=>array('create')),
array('label'=>'Update Product','url'=>array('update','id'=>$model->product_id)),
array('label'=>'Delete Product','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->product_id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Product','url'=>array('admin')),
);
?>

<h1>View Product #<?php echo $model->product_id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'product_id',
		'product_code',
		'product_name',
		'comp_id',
		'parent_product_id',
		'has_child',
		'brand_name',
		'product_desc',
		'price',
		'discount_price',
		'currency',
		'image',
		'create_date',
),
)); ?>
