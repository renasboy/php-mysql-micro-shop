<section class="category-overview">

    <?php if (!$categories) { ?>
    <p class="box">No results found.</p>
    <?php } else { ?>

    <?php foreach ($categories as $category) { ?>
    <article class="category-box box">
        <?php print $helper->image($category->img, $category->name, 80, 80); ?>
        <?php print $helper->title($category->name); ?>
        <span class="info">Total number of products: <?php print !empty($category->total_products) ? $category->total_products : 0; ?></span>
        <a href="/product/<?php print $category->seo; ?>" class="price btn-blue">see products &raquo;</a>
    </article>
    <?php } ?>

    <?php } ?>

</section>
