<section class="cms-category">

<?php print $helper->title('Product management'); ?>

<div class="management">

<div class="products list">
<?php
if (empty($products)) {
    print 'There are currently no products.';
}
else {
    print $helper->subtitle('Click one product to delete it.');
}

foreach ($products as $product) {
    print '<a href="/cms/remove/product/' . $product->sku . '">';
    print $helper->image($product->img, '', 80, 80);
    print '</a>';
}
?>
</div>

<?php print $helper->subtitle('Add new product'); ?>

<?php
$options = [];
foreach ($categories as $_category) {
    $options[$_category->id] = $_category->name;
}
$fields     = [];
$fields[]   = $helper->form_line('hidden', 'id');
$fields[]   = $helper->form_line('select', 'category_id', '', 'Select product category here', '', $options);
$fields[]   = $helper->form_line('text', 'name', '', 'Enter product name here');
$fields[]   = $helper->form_line('text', 'sku', '', 'Enter product SKU here');
$fields[]   = $helper->form_line('text', 'price', '', 'Enter product price here');
$fields[]   = $helper->form_line('image', 'file');

$buttons    = [];
$buttons[]  = $helper->button('ready!', 'btn-blue');

print $helper->form('/cms/save/product', $fields, $buttons);
?>

</div>

</section>
