<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List Order','url'=>array('index')),
array('label'=>'Create Order','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('order-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Orders</h1>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'order-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'order_id',
		'member_id',
		'order_status',
		'order_status_internal',
		'shipment_method',
		'shipment_cost',
		/*
		'shipment_cost_currency',
		'title',
		'name',
		'phone',
		'address',
		'postal_code',
		'country_code',
		'remarks',
		'remarks_internal',
		'total_order_price',
		'total_order_price_currency',
		'order_created_date',
		'last_order_status_update',
		*/
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
