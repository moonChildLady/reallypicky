<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->product_id,
);
/*
$this->menu=array(
array('label'=>'List Product','url'=>array('index')),
array('label'=>'Create Product','url'=>array('create')),
array('label'=>'Update Product','url'=>array('update','id'=>$model->product_id)),
array('label'=>'Delete Product','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->product_id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Product','url'=>array('admin')),
);*/
$criteria = new CDbCriteria();
$criteria->addCondition("parent_product_id = :t1");
$criteria->params[':t1'] = $model->product_id;
$subproducts = $model->findAll($criteria);
?>

<h1>View Product #<?php echo $model->product_id; ?></h1>
<?php echo $model->product_name; ?><br>

<!-- Lower Box -->
    <div class="order">

  		<div class="title2"><h2>確認訂單信息</h2></div>

			<!-- order form -->


<?php foreach($subproducts as $key=>$subproduct) { ?>
	<?php //echo $subproduct->product_name; ?><br>

      <!-- product into 1 -->
      <div class="atsp" style="line-height:6px; height:6px;border-bottom:1px dotted #ccc;"></div>
    	<div class="pdtrow clearfix">
	      <div class="oflp">產品</div>
        <div class="ofr" style="width:250px;"><img src="" class="pdtsfoto" />QB<br><?php echo $subproduct->product_name; ?></div>
      </div>
        
    	<div class="pdtrow clearfix">
      	<div class="oflp">單價</div>
        <div class="ofr">
        	<span class="oprice">HK$<?php echo $subproduct->price; ?></span>
          <span class="hprice">HK$<?php echo $subproduct->discount_price; ?></span>
          <div class="sprice">（含HK$<?php echo $subproduct->price-$subproduct->discount_price; ?>折扣優惠）</div>
        </div>
      </div>
      
    	<div class="pdtrow clearfix">      
        <div class="oflp">數量</div>
        <div class="ofr"><input type="button" value="-" field="quantity" class="qtyminus" /><input 
      	type="text" name="quantity[]" value="1" class="qty" /><input 
      	type="button" value="+" field="quantity" class="qtyplus" /></div>
      	<input name="product_id[]" value="<?php echo $subproduct->product_id;?>" type="hidden">
      	<input name="product_cost[]" value="<?php echo $subproduct->discount_price;?>" type="hidden">
        <!--div class="pfx">刪除&nbsp;<input type="button" value="x" class="pdtdel"/></div-->
      </div>

<?php } ?>
<?php //echo CHtml::submitButton('Check Out',array('class'=>'lbtn','tabindex'=>'5', 'name'=>'checkout')); ?>


<?php echo CHtml::link('check out', array('order/checkout', 'id'=>$model->product_id)); ?>
<?php 
//, array('id'=>$data->id,'class'=>'product_name')
/*$this->widget('booster.widgets.TbDetailView',array(
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
));*/?>

