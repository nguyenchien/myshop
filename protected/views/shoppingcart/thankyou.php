<?php
    $baseUrl = Yii::app()->getBaseUrl(true);
?>

<div class="breadcrumb">
    <div class="tree">
        <a href="<?= $baseUrl; ?>">Home</a>
        <span class="separate">&gt;</span>
        <span class="text">Cart</span>
        <span class="separate">&gt;</span>
        <span class="text">Confirm</span>
        <span class="separate">&gt;</span>
        <span class="text">Payment</span>
        <span class="separate">&gt;</span>
        <span class="text active">Finish</span>
    </div>
</div>

<div class="thank-you">
    <p class="text">Thank you for shopping! Please check your email for more information.</p>
    <p class="text"><a href="<?= $baseUrl ?>">Click here</a> to continue shopping.</p>
</div>