<?php

/**
 * Apply styles to the visual editor
 */
add_filter('mce_css', 'tuts_mcekit_editor_style');
function tuts_mcekit_editor_style($url) {
    if ( !empty($url) )
        $url .= ',';
    // Retrieves the plugin directory URL
    // Change the path here if using different directories
    $url .= trailingslashit( get_bloginfo('template_directory') ) . '/css/editor-style.css';
    return $url;
}

/**
 * Add "Styles" drop-down
 */
add_filter( 'mce_buttons_2', 'tuts_mce_editor_buttons' );
function tuts_mce_editor_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

/**
 * Add styles/classes to the "Styles" drop-down
 */
add_filter( 'tiny_mce_before_init', 'tuts_mce_before_init' );
function tuts_mce_before_init( $settings ) {
    $style_formats = array(
    	array(
    		'title' => 'Intro',
    		'selector' => 'p',
    		'classes' => 'intro'
    	),
    	array(
    		'title' => 'Question',
    		'selector' => 'p',
    		'classes' => 'question'
    	),
    	array(
    		'title' => 'Caption',
    		'block' => 'div',
    		'classes' => 'caption',
    		'wrapper' => true
    	),
    	array(
    		'title' => 'Quote',
    		'selector' => 'p',
    		'classes' => 'quote'
    	),
    	array(
    		'title' => 'Name',
    		'inline' => 'span',
    		'classes' => 'display-name'
    	)
    );
    $settings['style_formats'] = json_encode( $style_formats );
    return $settings;
}
/* Learn TinyMCE style format options at http://www.tinymce.com/wiki.php/Configuration:formats */
/*
 * Add custom stylesheet to the website front-end with hook 'wp_enqueue_scripts'
 */
add_action('wp_enqueue_scripts', 'tuts_mcekit_editor_enqueue');
/*
 * Enqueue stylesheet, if it exists.
 */
function tuts_mcekit_editor_enqueue() {
  $StyleUrl = plugin_dir_url(__FILE__).'editor-styles.css'; // Customstyle.css is relative to the current file
  wp_enqueue_style( 'myCustomStyles', $StyleUrl );
}

?>