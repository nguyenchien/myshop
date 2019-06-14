<?php
/* @var $this OrderController */
/* @var $model Order */

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Order', 'url'=>array('index')),
	array('label'=>'Create Order', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	return false;
});
$('.search-form form').submit(function(){
	$('#order-grid').yiiGridView('update', {
		data: $(this).serialize(),
		
		/*
		    Hiển thị dữ liệu trả về theo dạng ajax của Yii
		    Tham khảo: file jquery.yiigridview.js, line 269
		*/
		success: function (data) {
            var newData =  $('<div>' + data + '</div>');
            $('#ordersStatistic').replaceWith($('#ordersStatistic', newData));
            $('#order-grid').replaceWith($('#order-grid', newData));
            $('#tabsManageOrders li a').each(function () {
                if ($(this).hasClass('active')) { 
                    $(this).trigger('click');
                }
            });
		}
	});
	return false;
});
");
?>

<h1>Manage Orders</h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:block">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<div class="wrap-manage-orders">
    <ul id="tabsManageOrders" class="tabs-manage-orders flexbox">
        <li><a href="#ordersGrid" class="active">View Orders</a></li>
        <li><a href="#ordersStatistic">View Statistic</a></li>
    </ul>
    <div class="wrap-content">
        <div id="ordersGrid" class="orders-item orders-grid" style="display: block">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'order-grid',
                'dataProvider'=>$model->search(),
                'filter'=>$model,
                'columns'=>array(
                    array(
                        'header'=>'No.',
                        'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                        'htmlOptions' => array('style' => 'text-align:center;')
                    ),
                    array(
                        'header'=>'Order ID',
                        'name'=>'order_id',
                        'type'=>'raw',
                        'htmlOptions' => array('style' => 'text-align:center;'),
                        'value'=> function($data){
                            return $data->order_id;
                        }
                    ),
                    array(
                        'header'=>'Order User',
                        'name'=>'user_id',
                        'type'=>'raw',
                        'value'=> function($data){
                            if($data->user_id != 0){
                                $userInfo = Users::getUserInfo($data->user_id);
                                return $userInfo->user_name;
                            }else{
                                return "User Guess";
                            }
                        }
                    ),
                    array(
                        'header'=>'Order Date',
                        'name' => 'order_date',
                        'type' => 'raw',
                        'value' => function($data){
                            $date = new DateTime($data->order_date);
                            return $date->format('d-m-Y H:i:s');
                        }
                    ),
                    array(
                        'header'=>'Modified Date',
                        'name' => 'modified_date',
                        'type' => 'raw',
                        'value' => function($data){
                            if($data->modified_date != ''){
                                $date = new DateTime($data->modified_date);
                                return $date->format('d-m-Y H:i:s');
                            }
                        }
                    ),
                    array(
                        'header'=>'Total Order',
                        'name' => 'total',
                        'type' => 'raw',
                        'value' => function($data){
                            return number_format($data->total) . ' VNĐ';
                        }
                    ),
                    'status',
                    array(
                        'header'=>'User Ship',
                        'name' => 'user_ship',
                        'type' => 'raw',
                        'value' => function($data){
                            if($data->user_id != 0){
                                $userInfo = Users::getUserInfo($data->user_id);
                                return $userInfo->user_name;
                            }else{
                                return $data->user_ship;
                            }
                        }
                    ),
                    array(
                        'header'=>'Email Ship',
                        'name' => 'email_ship',
                        'type' => 'raw',
                        'value' => function($data){
                            if($data->user_id != 0){
                                $userInfo = Users::getUserInfo($data->user_id);
                                return $userInfo->email;
                            }else{
                                return $data->email_ship;
                            }
                        }
                    ),
                    array(
                        'header'=>'Address Ship',
                        'name' => 'address_ship',
                        'type' => 'raw',
                        'value' => function($data){
                            if($data->user_id != 0){
                                $userInfo = Users::getUserInfo($data->user_id);
                                return $userInfo->address;
                            }else{
                                return $data->address_ship;
                            }
                        }
                    ),
                    array(
                        'header'=>'Phone Ship',
                        'name' => 'phone_ship',
                        'type' => 'raw',
                        'value' => function($data){
                            if($data->user_id != 0){
                                $userInfo = Users::getUserInfo($data->user_id);
                                return $userInfo->phone;
                            }else{
                                return $data->phone_ship;
                            }
                        }
                    ),
                    array(
                        'class'=>'CButtonColumn',
                        'template'=>'{view} {update} {delete} {pdf}',
                        'buttons'=>array(
                            'pdf' => array(
                                'options' => array(
                                    'title' => 'Print PDF',
                                    'class' => 'btn-admin pdf'
                                ),
                                'label' => '<img src="'.BASE_URL.'/images/pdficon.png">',
                                'url' => function($data) { return Yii::app()->createUrl('admin/report/orderReceptionPdf', array('id' => $data->order_id));}
                            )
                        ),
                    ),
                ),
            )); ?>
        </div>

        <?php
            /*==========================================================================================================
             * Thống kê doanh thu theo category
            ==========================================================================================================*/
        ?>
        <div id="ordersStatistic" class="orders-item orders-statistic">
            <div class="wrap-statistic wrap-statistic-cates">
                <h2 class="title">Statistic Category</h2>
                <table class="tbl-admin tbl-statistic-cates">
                    <tr>
                        <th>No.</th>
                        <th>Category Name</th>
                        <th>Summary</th>
                    </tr>
                    <?php
                        $i = 0;
                        $data = $model->search3();
                        foreach ($data as $item) {
                            $i ++;
                            $cate = Category::getCateName($item['cate_id']);
                    ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td class="name"><a target="_blank" href="<?= BASE_URL; ?>/product/list/<?= $cate->cate_id; ?>"><?= $cate->cate_name; ?></a></td>
                        <td class="number bold"><?= number_format($item['summary']); ?> VND</td>
                    </tr>
                    <?php } ?>
                </table>
            </div>

            <?php
                /*======================================================================================================
                 * Thống kê doanh thu theo sản phẩm
                ======================================================================================================*/
            ?>
            <div class="wrap-statistic wrap-statistic-products">
                <h2 class="title">Statistic Products</h2>
                <table class="tbl-admin tbl-statistic-products">
                    <tr>
                        <th>No.</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quality</th>
                        <th>Summary</th>
                    </tr>
                    <?php
                        $i = 0;
                        $data = $model->search2();
                        $total_revenue = 0;
                        foreach ($data as $item) {
                            $i ++;
                            $total_revenue += $item['summary'];
                            $product = Product::getProductDetail($item['pro_id']);
                    ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td class="name"><a target="_blank" href="<?= BASE_URL; ?>/product/detail/<?= $item['pro_id']; ?>"><?= $product->pro_name; ?></a></td>
                        <td class="number"><?= number_format($item['price']); ?> VND</td>
                        <td><?= $item['quality']; ?></td>
                        <td class="number bold"><?= number_format($item['summary']); ?> VND</td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="total-revenue flexbox">
                <p class="text">Total Revenue:</p>
                <p class="money"><?= number_format($total_revenue); ?> VND</p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#tabsManageOrders li a").click(function (e) {
            $(this).addClass('active').parents('li').siblings().find('a').removeClass('active');
            e.preventDefault();
            $('.orders-item').hide();
            var tabSelect = $(this).attr('href');
            $(tabSelect).fadeIn();
        });
    });
</script>