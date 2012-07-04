<section class="cms-shop">

<?php print $helper->title('Order management'); ?>

<div class="management">

<div class="shop">
<?php
if (empty($shops)) {
    print 'There are currently no orders.';
}

foreach ($shops as $shop) {
    print '<article>';
    print '<b>ID: </b>';
    print $shop->id;
    print '<br>';
    print '<b>DATE: </b>';
    print $shop->created;
    print '<br>';
    print '<b>STATUS: </b>';
    print $shop->status;
    print '<br>';
    print '<b>PAYMENT: </b>';
    print $shop->payment;
    print '<br>';
    print '<b>EMAIL: </b>';
    print $shop->email;
    print '<br>';
    print '<b>NAME: </b>';
    print $shop->name;
    print '<br>';
    print '<b>ADDRESS: </b>';
    print $shop->address;
    print '<br>';
    print '<br>';
    print '<b>PRODUCTS: </b>';
    print '<br>';
    $total = 0;
    foreach ($shop->products as $product) {
        $subtotal = $product->quantity * $product->price;
        $total += $subtotal;
        print $product->quantity;
        print ' x ';
        print $product->name;
        print ' - &euro;';
        print $product->price;
        print '<br>';
    }
    print '<br>';
    print '<b>TOTAL: </b>';
    print number_format($total, 2);
    print '<br>';
    print '<br>';
    print '</article>';
}
?>
</div>

</div>

</section>
