<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Product','url'=>array('index')),
array('label'=>'Create Product','url'=>array('create')),
array('label'=>'Update Product','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Product','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Product','url'=>array('admin')),
);
?>

<h1>View Product #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'product_code',
		'product_name',
		'comp_id',
		'brand_name',
		'product_desc',
		'type1',
		'price1',
		'discount_price1',
		'currency1',
		'type2',
		'price2',
		'discount_price2',
		'currency2',
		'type3',
		'price3',
		'discount_price3',
		'currency3',
),
)); ?>
