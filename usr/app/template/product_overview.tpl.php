<section class="product-overview">

    <?php if (!$products) { ?>
    <p class="box">No results found.</p>
    <?php } else { ?>

    <?php foreach ($products as $product) { ?>
    <article class="product-box box">
        <?php print $helper->image($product->img, $product->name, 80, 80); ?>
        <?php print $helper->title($product->name); ?>
        <span class="info"><?php print $product->sku; ?> - <?php print $product->category; ?></span>
        <a href="/product/<?php print $product->category_seo; ?>/<?php print $product->sku; ?>" class="more-info">more info &raquo;</a>
        <a href="/cart/add/<?php print $product->sku; ?>" class="price btn-blue">&euro;<?php print $product->price; ?></a>
    </article>
    <?php } ?>

    <?php } ?>

    <a href="javascript:history.back();" class="back btn-grey">back</a>

</section>
