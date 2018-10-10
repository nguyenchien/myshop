<ul class="product-list home">
    <?php foreach ($data as $productItem): ?>
        <li class="item flexbox">
            <div class="image">
                <a href="<?= BASE_URL; ?>/product/detail/<?= $productItem->pro_id; ?>"><img src="<?= BASE_URL.$productItem->image; ?>" alt="" /></a>
            </div>
            <div class="info">
                <a class="name" href="<?= BASE_URL; ?>/product/detail/<?= $productItem->pro_id; ?>"><?= $productItem->pro_name; ?></a>
                <p class="price"><?= number_format($productItem->price); ?> VND</p>
                <p class="desc"><?= $productItem->description; ?></p>
            </div>
        </li>
    <?php endforeach; ?>
</ul>