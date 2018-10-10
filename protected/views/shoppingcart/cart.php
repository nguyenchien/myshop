<?php
    $baseUrl = Yii::app()->getBaseUrl(true);
?>

<div class="breadcrumb">
    <div class="tree">
        <a href="<?= $baseUrl; ?>">Home</a>
        <span class="separate">&gt;</span>
        <span class="text active">Cart</span>
        <span class="separate">&gt;</span>
        <span class="text">Confirm</span>
        <span class="separate">&gt;</span>
        <span class="text">Payment</span>
        <span class="separate">&gt;</span>
        <span class="text">Finish</span>
    </div>
</div>

<?php if(count($data) > 0): ?>
    <div class="list-product-cart" id="listProductCart">
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
                    <td>
                        <div class="wrap-input-cart flexbox">
                            <input id="sl_<?= $idProd; ?>" type="text" value="<?= $itemProd['quality']; ?>">
                            <a class="edit" href="javascript:void(0)" onclick="editCart(<?= $idProd; ?>);">Edit</a>
                            <a class="delete" href="javascript:void(0)" onclick="deleteCart(<?= $idProd; ?>);">Delete</a>
                        </div>
                    </td>
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
            <a class="btn-action" href="<?= $baseUrl; ?>/shoppingcart/confirm">Confirm</a>
        </div>
    </div>
<?php else: ?>
    <p class="note-cart">No item in cart. <a href="<?= $baseUrl; ?>">Click here</a> to continue shopping.</p>
<?php endif; ?>

<script type="text/javascript">
    function editCart(id) {
        var url = "<?= $baseUrl; ?>";
        var sl = $("#sl_"+id).val();
        if(sl <= 0){
            alert("Số lượng phải từ 1 trở lên.");
        }
        $.post(url + "/shoppingcart/updateCart", {"product_id": id, "sl": sl}, function (data) {
            $("#quaCart").text(data);
            $("#listProductCart").load(url + "/shoppingcart/cart #listProductCart");
        });
    }

    function deleteCart(id) {
        var url = "<?= $baseUrl; ?>";
        var flagDelete = confirm("Are you sure !");
        if(flagDelete === true){
            $.post(url + "/shoppingcart/deleteCart", {"product_id": id}, function (data) {
                $("#quaCart").text(data);
                // Load lai data sau khi xoa
                $("#listProductCart").load(url + "/shoppingcart/cart #listProductCart");
                if(parseInt(data) === 0){
                    $("#content").append("<p class='note-cart'>No item in cart. <a href='"+url+"'>Click here</a> to continue shopping.</p>");
                }
            });
        }
    }
</script>
