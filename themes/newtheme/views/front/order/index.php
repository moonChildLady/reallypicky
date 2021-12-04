<?php
$this->breadcrumbs=array(
	'Orders',
);
/*
$this->menu=array(
array('label'=>'Create Order','url'=>array('create')),
array('label'=>'Manage Order','url'=>array('admin')),
);*/
//var_dump($usersession);
?>
<div class="shupper">

    	<!-- message Box 1 -->
			<div class="messagebox">
		<div class="title2"><h2>訂單狀態</h2></div>
<?php $this->widget('zii.widgets.CListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
'summaryText'=>'共有{count}張訂單，第{page}/{pages}頁',
//'template'=>"{items}{pager}"
'pager' => array(
    'maxButtonCount' => '10',
    'prevPageLabel'=>'上一頁',
    'nextPageLabel'=>'下一頁',
     'header'=>'',
),
)); ?>
</div>
</div>
    <div class="order">
   		<div class="fbtn"><a href="/">返回活動首頁</a></div>
    </div>