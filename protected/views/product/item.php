<?php if(!empty($data)): ?>
    <li class="item flexbox">
        <div class="image">
            <a href="<?= BASE_URL; ?>/product/detail/<?= $data->pro_id; ?>"><img src="<?= BASE_URL.$data->image; ?>" alt="" /></a>
        </div>
        <div class="info">
            <a class="name" href="<?= BASE_URL; ?>/product/detail/<?= $data->pro_id; ?>"><?= $data->pro_name; ?></a>
            <p class="price"><?= number_format($data->price); ?> VND</p>
            <p class="desc"><?= Utils::the_excerpt($data->description, 50); ?></p>
        </div>
    </li>
<?php else: ?>
    <p class="note">No data!</p>
<?php endif; ?>