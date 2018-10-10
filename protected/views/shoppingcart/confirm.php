<?php
    $baseUrl = Yii::app()->getBaseUrl(true);
?>

    <div class="breadcrumb">
        <div class="tree">
            <a href="<?= $baseUrl; ?>">Home</a>
            <span class="separate">&gt;</span>
            <a href="<?= $baseUrl; ?>/shoppingcart/cart">Cart</a>
            <span class="separate">&gt;</span>
            <span class="text active">Confirm</span>
            <span class="separate">&gt;</span>
            <span class="text">Payment</span>
            <span class="separate">&gt;</span>
            <span class="text">Finish</span>
        </div>
    </div>

<?php if(count($data) > 0): ?>
    <form action="<?= $baseUrl ?>/shoppingcart/payment" method="post">
        <div class="list-product-cart">
            <h2 class="title">Information Order</h2>
            <table class="tbl-cart">
                <tr>
                    <th class="no">No</th>
                    <th class="name">Name</th>
                    <th class="image">Image</th>
                    <th class="quality">Quality</th>
                    <th class="price">Price</th>
                    <th class="del">Summary</th>
                </tr>
                <?php
                $i=0;
                $total = 0;
                foreach ($data as $idProd => $itemProd) {
                    $i++;
                    $total += (int)$itemProd['quality'] * (int)$itemProd['price'];
                    ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><a href="<?= $baseUrl; ?>/product/detail/<?= $idProd; ?>"><?= $itemProd['name']; ?></a></td>
                        <td><a href="<?= $baseUrl; ?>/product/detail/<?= $idProd; ?>"><img src="<?= $baseUrl . $itemProd['image']; ?>" alt=""></a></td>
                        <td><?= $itemProd['quality']; ?></td>
                        <td><?= number_format($itemProd['price']); ?> VND</td>
                        <td><?= number_format((int)$itemProd['quality'] * (int)$itemProd['price']); ?> VND</td>
                    </tr>
                <?php } ?>
            </table>
            <div class="total-money flexbox">
                <p class="text">Total: </p>
                <p class="money"><?= number_format($total); ?> VND</p>
            </div>
            <div class="check-out">
                <input class="btn-action" type="submit" value="Payment" name="payment">
            </div>
        </div>
    </form>
<?php endif; ?>