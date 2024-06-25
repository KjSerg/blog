<?php
$var    = variables();
$set    = $var['setting_home'];
$assets = $var['assets'];
$url    = $var['url'];
$logo   = carbon_get_theme_option( 'logo' );
?>
<!DOCTYPE html>
<html class="no-js page" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries-->
    <!-- WARNING: Respond.js doesn't work if you view the page via file://-->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <title><?php wp_title(); ?></title>
	<?php wp_head(); ?>
</head>

<body>
<main class="content">
