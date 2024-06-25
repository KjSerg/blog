<?php
/**
 * blog functions and definitions
 *
 * @package blog
 */

function blog_scripts()
{
	$template_directory_uri  = get_template_directory_uri();

    wp_enqueue_style('blog-style', get_stylesheet_uri());

    wp_enqueue_style('blog-fancybox',  'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css', array(), '1.0');

    wp_enqueue_style('blog-main', $template_directory_uri . '/assets/css/main.css', array(), '1.0');

    wp_enqueue_style('blog-fix', $template_directory_uri . '/assets/css/fix.css', array(), '1.0');

	wp_enqueue_script('blog-jq', $template_directory_uri . '/assets/js/jquery.js', array(), '1.0', true);

    wp_enqueue_script('blog-fancybox',  'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', array(), '1.0', true);

    wp_enqueue_script('blog-semantic',  'https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.0/semantic.min.js', array(), '1.0', true);

    wp_enqueue_script('blog-croppie',  'https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js', array(), '1.0', true);

    wp_enqueue_script('blog-libs', $template_directory_uri . '/assets/js/libs.min.js', array(), '1.0', true);

    wp_enqueue_script('blog-scripts', $template_directory_uri . '/assets/js/main.js', array(), '1.0', true);

    wp_enqueue_script('blog-fix-scripts', $template_directory_uri . '/assets/js/fix.js', array(), '1.0', true);

    wp_localize_script('ajax-script', 'AJAX', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'blog_scripts');

get_template_part('functions/helpers');
get_template_part('functions/settings');
get_template_part('functions/carbon-settings');