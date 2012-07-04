<section class="cms-category">

<?php print $helper->title('Category management'); ?>

<div class="management">


<div class="categories list">
<?php
if (empty($categories)) {
    print 'There are currently no categories.';
}
else {
    print $helper->subtitle('Click one category to delete it.');
}

foreach ($categories as $category) {
    print '<a href="/cms/remove/category/' . $category->seo . '">';
    print $helper->image($category->img, $category->name, 80, 80);
    print '</a>';
}
?>
</div>

<?php print $helper->subtitle('Add new category'); ?>

<?php
$fields     = [];
$fields[]   = $helper->form_line('hidden', 'id');
$fields[]   = $helper->form_line('text', 'name', '', 'Enter category name here');
$fields[]   = $helper->form_line('image', 'file');

$buttons    = [];
$buttons[]  = $helper->button('ready!', 'btn-blue');

print $helper->form('/cms/save/category', $fields, $buttons);
?>

</div>

</section>
