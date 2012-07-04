<!doctype html>
<html lang="nl">
<head>

<meta charset="utf-8">
<meta name="description" content="HTML_META_DESCRIPTION">
<meta name="keywords" content="HTML_META_KEYWORDS">
<meta name="author" content="renas - renasboy@gmail.com">

<link rel="shortcut icon" href="/images/favicon.png" type="image/png">
<link rel="apple-touch-icon-precomposed" href="/images/appletouchicon.png">

<title>HTML_TITLE</title>

<?php
foreach ($css as $file) {
    print $helper->css($file);
}
foreach ($js as $file) {
    print $helper->js($file);
}
?>

</head>

<body>

<?php $view->add('header_cms'); ?>

<div class="main site-wide">
<?php $view->add('main'); ?>
</div>

<?php $view->add('footer_cms'); ?>

</body>
</html>
