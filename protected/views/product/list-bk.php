<?php
    $baseUrl = Yii::app()->getBaseUrl(true);
?>
<ul class="product-list list">
    <?php foreach ($data as $productItem): ?>
        <li class="item flexbox">
            <div class="image">
                <a href="<?= $baseUrl; ?>/product/detail/<?= $productItem->pro_id; ?>"><img src="<?= $baseUrl.$productItem->image; ?>" alt="" /></a>
            </div>
            <div class="info">
                <a class="name" href="<?= $baseUrl; ?>/product/detail/<?= $productItem->pro_id; ?>"><?= $productItem->pro_name; ?></a>
                <p class="price"><?= number_format($productItem->price); ?> VND</p>
                <p class="desc"><?= Utils::the_excerpt($productItem->description, 50); ?></p>
            </div>
        </li>
    <?php endforeach; ?>
</ul>

<div class="wrap-paging">
    <?php
        $this->widget('CLinkPager', array(
            'pages'=>$pages,
            'header'=>'',
            'footer'=>'',
            'prevPageLabel'=>'<',
            'nextPageLabel'=>'>'
        ));
    ?>
</div>