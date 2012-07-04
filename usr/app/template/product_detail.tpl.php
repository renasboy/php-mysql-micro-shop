<section class="product-detail">

    <article class="box">
        <?php print $helper->image($product->img, $product->name, 300, 300); ?>
        <?php print $helper->title($product->name); ?>
        <span><?php print $product->sku; ?> - <?php print $product->category; ?></span>
        <a href="javascript:history.back();" class="back btn-grey">back</a>
        <a href="/cart/add/<?php print $product->sku; ?>" class="price btn-blue">&euro;<?php print $product->price; ?></a>
    </article>

</section>
