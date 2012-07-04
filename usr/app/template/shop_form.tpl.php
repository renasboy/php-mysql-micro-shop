<section class="shop-form box">

<h1>Shop cart details</h1>

<?php if (!$products) { ?>
<p class="box">Cart is empty.</p>
<?php } else { ?>

<?php
$total = 0;
foreach ($products as $product) {
    $subtotal   = $product->quantity * $product->price;
    $total      += $subtotal;
    ?>
    <article class="product-box">
        <?php print $helper->image($product->img, $product->name, 40, 40); ?>
        <?php print $helper->title($product->name); ?>
        <span class="info"><?php print $product->quantity; ?> x &euro;<?php print $product->price; ?> = &euro;<?php print number_format($subtotal, 2); ?></span>
    </article>
<?php } ?>

<h2>Total: &euro;<?php print number_format($total, 2); ?></h2>

<?php } ?>

<h1>Order details</h1>

<?php
$fields     = [];
$fields[]   = $helper->form_line('text', 'name', '', 'Your name here');
$fields[]   = $helper->form_line('text', 'email', '', 'Your email here');
$fields[]   = $helper->form_line('textarea', 'address', '', 'Your address here');
$payments   = [
    'credit card'       => 'credit card',
    'debit card'        => 'debit card',
    'automatic debit'   => 'automatic debit',
    'transference'      => 'transference'
];
$fields[]   = $helper->form_line('select', 'payment', '', 'Choose your payment type', '', $payments);

$buttons    = [];
$buttons[]  = $helper->button('ready!', 'btn-blue');

print $helper->form('/shop', $fields, $buttons);
?>

</section>
