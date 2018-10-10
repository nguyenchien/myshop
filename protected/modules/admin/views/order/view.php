<?php
/* @var $this OrderController */
/* @var $model Order */

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$model->order_id,
);

$this->menu=array(
	//array('label'=>'List Order', 'url'=>array('index')),
	array('label'=>'Create Order', 'url'=>array('create')),
	array('label'=>'Update Order', 'url'=>array('update', 'id'=>$model->order_id)),
	array('label'=>'Delete Order', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->order_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Order', 'url'=>array('admin')),
);
?>
<h1 class="title-order-view">View Order #<?php echo $model->order_id; ?></h1>

<?php
    //Get User Info
    $user = Order::getUserByOrderID($model->order_id);
?>
<div class="wrap-item-order wrap-user-info">
    <?php if(!empty($user->user_id)): ?>
        <h2 class="title">Info User Member</h2>
        <div class="wrap-list-info">
            <ul class="list-info list-info-member">
                <li class="flexbox">
                    <p class="label">Name:</p>
                    <p class="data"><?= $user['user_name']; ?></p>
                </li>
                <li class="flexbox">
                    <p class="label">Gender:</p>
                    <p class="data"><?= $user['gender']==1?'Nam':'Nu'; ?></p>
                </li>
                <li class="flexbox">
                    <p class="label">Email:</p>
                    <p class="data"><?= $user['email']; ?></p>
                </li>
                <li class="flexbox">
                    <p class="label">Birthday:</p>
                    <p class="data"><?= $user['birthday']; ?></p>
                </li>
                <li class="flexbox">
                    <p class="label">Phone:</p>
                    <p class="data"><?= $user['phone']; ?></p>
                </li>
                <li class="flexbox">
                    <p class="label">Address:</p>
                    <p class="data"><?= $user['address']; ?></p>
                </li>
            </ul>
        </div>
    <?php else: ?>
        <h2 class="title">Info User Guess</h2>
        <div class="wrap-list-info">
            <ul class="list-info list-info-guess">
                <li class="flexbox">
                    <p class="label">Name:</p>
                    <p class="data"><?= $model->user_ship; ?></p>
                </li>
                <li class="flexbox">
                    <p class="label">Email:</p>
                    <p class="data"><?= $model->email_ship; ?></p>
                </li>
                <li class="flexbox">
                    <p class="label">Phone:</p>
                    <p class="data"><?= $model->phone_ship; ?></p>
                </li>
                <li class="flexbox">
                    <p class="label">Address:</p>
                    <p class="data"><?= $model->address_ship; ?></p>
                </li>
            </ul>
        </div>
    <?php endif; ?>
</div>

<div class="wrap-item-order wrap-info-order">
    <h2 class="title">Info Order</h2>
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data'=>$model,
        'attributes'=>array(
            //'order_id',
            array(
                'header'=>'User',
                'name' => 'user_id',
                'type' => 'raw',
                'value' => function($data){
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
                'header'=>'Total Order',
                'name' => 'total',
                'type' => 'raw',
                'value' => function($data){
                    return '<p class="total-order">'.number_format($data->total) . ' VNĐ</p>';
                }
            ),
        ),
    ));
    ?>
</div>

<?php
    // Get Order Detail
    $order_detail = Order::getOrderDetailByOrderID($model->order_id);
?>
<div class="wrap-item-order wrap-order-detail">
    <h2 class="title">Info Order Detail</h2>
    <div class="wrap-list-info flexbox">
        <?php foreach ($order_detail as $item): ?>
            <?php
                // Get product detail by product id
                $prodItem = Product::getProductDetail($item->pro_id);
            ?>
            <ul class="list-info list-order-detail">
                <li class="flexbox">
                    <p class="label">Product ID:</p>
                    <p class="data"><a target="_blank" href="<?= BASE_URL; ?>/product/detail/<?= $item->pro_id; ?>"><?= $prodItem->pro_name; ?></a></p>
                </li>
                <li class="flexbox">
                    <p class="label">Price:</p>
                    <p class="data"><?= number_format($item->price); ?> VNĐ</p>
                </li>
                <li class="flexbox">
                    <p class="label">Quality:</p>
                    <p class="data"><?= $item->quality; ?></p>
                </li>
                <li class="flexbox">
                    <p class="label">Summary:</p>
                    <p class="data"><?= number_format((int)$item->quality * (int)$item->price); ?> VNĐ</p>
                </li>
            </ul>
        <?php endforeach; ?>
    </div>
</div>
