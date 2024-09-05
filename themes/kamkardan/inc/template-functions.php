<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package kamkardan
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function kamkardan_body_classes($classes)
{
	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter('body_class', 'kamkardan_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function kamkardan_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'kamkardan_pingback_header');


add_action('woocommerce_proceed_to_checkout', function () {
	printf('<p class="after_checkout_btn">%s</p>', get_field('after_checkout', 'options'));
}, 20);