<?php
    $baseUrl = Yii::app()->request->baseUrl;
?>
<ul id="navigation">
    <?php foreach ($data as $cate){ ?>
        <li><a href="<?= $baseUrl; ?>/product/list/<?= $cate->cate_id; ?>" class="<?= ($cateId==$cate->cate_id)?'active':''; ?>"><?= $cate->cate_name; ?></a></li>
    <?php } ?>
</ul>