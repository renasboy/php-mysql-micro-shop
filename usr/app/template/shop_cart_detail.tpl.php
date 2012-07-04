<section class="shop-cart-detail">

<?php if (!$products) { ?>
<p class="box">Cart is empty.</p>
<?php } else { ?>

<?php print $helper->title('My shopping cart details'); ?>

<?php
$total = 0;
foreach ($products as $product) {
    $subtotal   = $product->quantity * $product->price;
    $total      += $subtotal;
    ?>
    <article class="product-box box">
        <?php print $helper->image($product->img, $product->name, 80, 80); ?>
        <?php print $helper->title($product->name); ?>
        <span class="info"><?php print $product->quantity; ?> x &euro;<?php print $product->price; ?> = &euro;<?php print number_format($subtotal, 2); ?></span>
        <a href="/cart/del/<?php print $product->sku; ?>" class="price btn-blue">remove</a>
    </article>
<?php } ?>

<h2>Total: &euro;<?php print number_format($total, 2); ?></h1>

<?php } ?>

</section>
