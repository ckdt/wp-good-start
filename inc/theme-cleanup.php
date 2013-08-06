<?php

/**
 * Clean up wp_head()
 *
 * Remove unnecessary <link>'s
 * Remove inline CSS used by Recent Comments widget
 * Remove inline CSS used by posts with galleries
 * Remove self-closing tag and change ''s to "'s on rel_canonical()
 */
function gs_head_cleanup() {
	// Originally from http://wpengineer.com/1438/wordpress-header/
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );

	add_filter( 'use_default_gallery_style', '__return_null' );
}

add_action( 'init', 'gs_head_cleanup' );

/**
 * Remove the WordPress version from RSS feeds
 */
add_filter( 'the_generator', '__return_false' );

/**
 * Clean up language_attributes() used in <html> tag
 *
 * Change lang="en-US" to lang="en"
 * Remove dir="ltr"
 */
function gs_language_attributes() {
	$attributes = array();
	$output = '';

	if ( function_exists( 'is_rtl' ) ) {
		if ( is_rtl() == 'rtl' ) {
			$attributes[] = 'dir="rtl"';
		}
	}

	$lang = get_bloginfo( 'language' );

	if ( $lang && $lang !== 'en-US' ) {
		$attributes[] = "lang=\"$lang\"";
	} else {
		$attributes[] = 'lang="en"';
	}

	$output = implode( ' ', $attributes );
	$output = apply_filters( 'gs_language_attributes', $output );

	return $output;
}

add_filter( 'language_attributes', 'gs_language_attributes' );

/**
 * Clean up output of stylesheet <link> tags
 */
function gs_clean_style_tag( $input ) {
	preg_match_all( "!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches );
	// Only display media if it's print
	$media = $matches[3][0] === 'print' ? ' media="print"' : '';
	return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
}

add_filter( 'style_loader_tag', 'gs_clean_style_tag' );

/**
 * Add and remove body_class() classes
 */
function gs_body_class( $classes ) {
	// Add post/page slug
	if ( is_single() || is_page() && !is_front_page() ) {
		$classes[] = basename( get_permalink() );
	}

	// Remove unnecessary classes
	$home_id_class = 'page-id-' . get_option( 'page_on_front' );
	$remove_classes = array(
		'page-template-default',
		$home_id_class
	);
	$classes = array_diff( $classes, $remove_classes );

	return $classes;
}

add_filter( 'body_class', 'gs_body_class' );

/**
 * Remove unnecessary dashboard widgets
 *
 * @link http://www.deluxeblogtips.com/2011/01/remove-dashboard-widgets-in-wordpress.html
 */
function gs_remove_dashboard_widgets() {
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
}

add_action( 'admin_init', 'gs_remove_dashboard_widgets' );

/**
 * Clean up the_excerpt()
 */
function gs_excerpt_length( $length ) {
	return 40;
}

function gs_excerpt_more( $more ) {
	return ' &hellip; <a href="' . get_permalink() . '">' . __( 'Continued', 'vast' ) . '</a>';
}

add_filter( 'excerpt_length', 'gs_excerpt_length' );
add_filter( 'excerpt_more', 'gs_excerpt_more' );

/**
 * Don't return the default description in the RSS feed if it hasn't been changed
 */
function gs_remove_default_description( $bloginfo ) {
	$default_tagline = 'Just another WordPress site';

	return ( $bloginfo === $default_tagline ) ? '' : $bloginfo;
}

add_filter( 'get_bloginfo_rss', 'gs_remove_default_description' );

/**
 * Redirects search results from /?s=query to /search/query/, converts %20 to +
 *
 * @link http://txfx.net/wordpress-plugins/nice-search/
 */
function gs_nice_search_redirect() {
	if ( is_search() && strpos( $_SERVER['REQUEST_URI'], '/wp-admin/' ) === false && strpos( $_SERVER['REQUEST_URI'], '/search/' ) === false ) {
		wp_redirect( home_url( '/search/' . str_replace( array( ' ', '%20' ), array( '+', '+' ), urlencode( get_query_var( 's' ) ) ) ), 301 );
		exit();
	}
}

add_action( 'template_redirect', 'gs_nice_search_redirect' );

/**
 * Fix for get_search_query() returning +'s between search terms
 */
function gs_search_query( $escaped = true ) {
	$query = apply_filters( 'gs_search_query', get_query_var( 's' ) );

	if ( $escaped ) {
		$query = esc_attr( $query );
	}

	return urldecode( $query );
}

add_filter( 'get_search_query', 'gs_search_query' );

/**
 * Fix for empty search queries redirecting to home page
 *
 * @link http://wordpress.org/support/topic/blank-search-sends-you-to-the-homepage#post-1772565
 * @link http://core.trac.wordpress.org/ticket/11330
 */
function gs_request_filter( $query_vars ) {
	if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
		$query_vars['s'] = ' ';
	}

	return $query_vars;
}

add_filter( 'request', 'gs_request_filter' );

/**
 * Flush rewrite rules when activating theme to get permalinks to work with registered custom post types
 */
function gs_rewrite_flush() {
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'gs_rewrite_flush' );

?>
