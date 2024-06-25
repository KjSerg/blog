<?php
/* Template Name: Шаблон головної сторінки */
get_header();
$var          = variables();
$set          = $var['setting_home'];
$assets       = $var['assets'];
$url          = $var['url'];
$url_home     = $var['url_home'];
$id           = get_the_ID();
$isLighthouse = isLighthouse();
$size         = isLighthouse() ? 'thumbnail' : 'full';
$screens      = carbon_get_post_meta( $id, 'screens' );
if ( ! empty( $screens ) ) :
	foreach ( $screens as $index => $screen ) :
		if ( $screen['_type'] == 'screen_1' ) :
			if ( ! $screen['screen_off'] ) :
				?>


			<?php
			endif;
		elseif ( $screen['_type'] == 'screen_2' ):
			if ( ! $screen['screen_off'] ):
				?>

			<?php
			endif;
		endif;
	endforeach;
endif; ?>
<?php get_footer(); ?>


