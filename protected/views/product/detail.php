<?php
    // Register java script file
    Yii::app()->clientScript->registerScriptFile(BASE_URL.'/js/popup.js', CClientScript::POS_END);

    // Get obj category
    $cate = Product::getCateByProductID($prodItem->pro_id);

    // Base url
    $baseUrl = Yii::app()->getBaseUrl(true);
?>
<div id="about">
    <div class="breadcrumb">
        <div class="tree">
            <a href="<?= BASE_URL; ?>">Home</a>
            <span class="separate">&gt;</span>
            <a href="<?= BASE_URL; ?>/product/list/<?= $cate->cate_id; ?>"><?= $cate->cate_name; ?></a>
            <span class="separate">&gt;</span>
            <?= $prodItem->pro_name; ?>
        </div>
    </div>
    <div class="wrap-product-detail flexbox">
        <div class="photos">
            <img id="imgSource" src="<?= BASE_URL.$prodItem->image; ?>" alt="">
        </div>
        <div class="description">
            <div class="wrap-name-price flexbox">
                <p id="nameSource" class="name"><?= $prodItem->pro_name; ?></p>
                <p id="priceSource" class="price"><?= number_format($prodItem->price); ?> VND</p>
            </div>
            <div id="desSource" class="des"><?= $prodItem->description; ?></div>
            <h3 class="title">Short features:</h3>
            <p class="meta-des"><?= $prodItem->meta_description; ?></p>
            <a id="addToCart" class="add-to-cart" href="javascript:void(0)" onclick="addCart(<?= $prodItem->pro_id; ?>);">Add to cart</a>
        </div>
    </div>
</div>

<?php if (count($productsSameCate)>0) : ?>
    <img src="<?= WP_URL; ?>/images/title6.gif" alt="" width="537" height="23" class="pad25">
    <ul class="product-list detail">
        <?php foreach ($productsSameCate as $productItem): ?>
            <li class="item flexbox">
                <div class="image">
                    <a href="<?= BASE_URL ; ?>/product/detail/<?= $productItem->pro_id; ?>"><img src="<?= BASE_URL.$productItem->image; ?>" alt="" /></a>
                </div>
                <div class="info">
                    <a class="name" href="<?= BASE_URL; ?>/product/detail/<?= $productItem->pro_id; ?>"><?= $productItem->pro_name; ?></a>
                    <p class="price"><?= number_format($productItem->price); ?> VND</p>
                    <p class="desc"><?= Utils::the_excerpt($productItem->description, 50); ?></p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<script type="text/javascript">
    function addCart(id) {
        var num = 0;
        var url = "<?= BASE_URL; ?>";
        var quality = 0;
        var totalMoney = 0;
        var rowCart = "<tr>";
        rowCart += "<th>No</th>";
        rowCart += "<th>Name</th>";
        rowCart += "<th>Image</th>";
        rowCart += "<th>Quality</th>";
        rowCart += "<th>Price</th>";
        rowCart += "<th>Summary</th>";
        rowCart += "</tr>";
        $.post(url + "/shoppingcart/addCart", {"product_id": id}, function (data) {
            $.each(data, function (idProd, cart) {
                quality += cart.quality;
                totalMoney += cart.quality*cart.price;
                num ++;
                rowCart += "<tr>";
                rowCart += "<td>"+num+"</td>";
                rowCart += "<td><a href='"+url+"/product/detail/"+idProd+"'>"+cart.name+"</a></td>";
                rowCart += "<td><a href='"+url+"/product/detail/"+idProd+"'><img src='"+url+cart.image +"'></a></td>";
                rowCart += "<td>";
                rowCart += "<div class='wrap-input-cart flexbox'>";
                rowCart += "<input id='sl_"+idProd+"' type='text' value='"+accounting.formatNumber(cart.quality)+"'>";
                rowCart += "<a class='edit' href='javascript:void(0)' onclick='editCart("+idProd+")'>Edit</a>";
                rowCart += "<a class='delete' href='javascript:void(0)' onclick='deleteCart("+idProd+")'>Delete</a>";
                rowCart += "</div>";
                rowCart += "</td>";
                rowCart += "<td>"+accounting.formatNumber(cart.price)+"</td>";
                rowCart += "<td><span id='summaryCartPop-"+idProd+"'>"+accounting.formatNumber(cart.quality*cart.price)+"</span> VND</td>";
                rowCart += "</tr>";
            });
            $("#quaCart").text(quality);
            $("#tblCart").html(rowCart);
            $("#totalMoney").text(accounting.formatNumber(totalMoney));
        }, 'json');
    }

    // Sửa số lượng trong giỏ hàng
    function editCart(id) {
        var url = "<?= $baseUrl; ?>";
        var sl = $("#sl_"+id).val();
        var summary_cart_pop = 0;
        var total_pop = 0;
        var qualityPop = 0;
        $.post(url + "/shoppingcart/updateCartPopup", {"product_id": id, "sl": sl}, function (data) {
            $.each(data, function (idProd, cart){
                summary_cart_pop = cart.quality*cart.price;
                total_pop += summary_cart_pop;
                qualityPop += cart.quality;
                $("#summaryCartPop-"+idProd).text(accounting.formatNumber(summary_cart_pop));
            });
            $("#totalMoney").empty().text(accounting.formatNumber(total_pop));
            $("#quaCart").empty().text(accounting.formatNumber(qualityPop));
        }, 'json');
    }

    // Xóa số lượng trong giỏ hàng
    function deleteCart(id) {
        var url = "<?= $baseUrl; ?>";
        var flagDelete = confirm("Are you sure !");
        var summary_cart_pop = 0;
        var total_pop = 0;
        var qualityPop = 0;
        if(flagDelete === true){
            $.post(url + "/shoppingcart/deleteCartPopup", {"product_id": id}, function (data) {
                $.each(data, function (idProd, cart){
                    summary_cart_pop = cart.quality*cart.price;
                    total_pop += summary_cart_pop;
                    qualityPop += cart.quality;
                });
                $("#totalMoney").empty().text(accounting.formatNumber(total_pop));
                $("#quaCart").empty().text(accounting.formatNumber(qualityPop));

                // Thông báo khi giỏ hàng không có sản phẩm.
                if(parseInt(data.length) <= 0){
                    $("#containerPopupCart .content").html("<p class='note-cart'>No item in cart. <a href='"+url+"'>Click here</a> to continue shopping.</p>");
                    $(".go-to-cart").remove();
                }
            }, 'json');

            // Cập nhật lại table cart, sau khi xóa.
            $(document).on('click', '.delete', function (e) {
                $(e.toElement).parents('tr').remove();
            });
        }
    }

    $(document).ready(function () {
        // Call Popup
        Popup.init();

        // Close Popup when click outside
        $("#containerPopupCart").on('click', function (e) {
            var currentEl = $(e.toElement);
            if(currentEl.hasClass('container-popup-cart-overflow')){
                Popup.closePopup();
            }
        });
    });
</script>

<div id="containerPopupCart" class="container-popup-cart" style="display: none;">
    <div id="wrapPopupCart" class="wrap-popup-cart">
        <div class="wrap-thanks flexbox">
            <p class="thanks">Thank you for booking on <a href="<?= BASE_URL ?>">EShop</a>. Here is the information that you have ordered</p>
            <a id="closePopup" href="#">Close</a>
        </div>
        <h2 class="title">Information Order</h2>
        <div class="content">
            <table id="tblCart" class="tbl-cart"></table>
            <div class="total-money flexbox">
                <p class="text">Total: </p>
                <p class="money"><span id="totalMoney"></span> VND</p>
            </div>
        </div>
        <p class="go-to-cart"><a href="<?= BASE_URL; ?>/shoppingcart/cart">Go to cart</a></p>
    </div>
</div>