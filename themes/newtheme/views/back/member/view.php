<?php
$this->breadcrumbs=array(
	'Members'=>array('index'),
	$model->name,
);
/*
$this->menu=array(
array('label'=>'List Member','url'=>array('index')),
array('label'=>'Create Member','url'=>array('create')),
array('label'=>'Update Member','url'=>array('update','id'=>$model->member_id)),
array('label'=>'Delete Member','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->member_id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Member','url'=>array('admin')),
);*/
?>

<h1>View Member #<?php echo $model->member_id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'email',
		'display_name',
		//'password',
		'contact_phone',
		array('label'=>'帳單地址', 'value'=>$model->bill_address),
		'title',
		'name',
		/*'member_id',*/
		'phone',
		array('label'=>'地址', 'value'=>nl2br($model->address)),
		'postal_code',
		array('label'=>'國家', 'value'=>$model->country_code),
		//'country_code',
		'country',
		'status',
		'create_date',
		'last_modified_date',
),
)); ?>
