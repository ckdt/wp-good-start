<?php
/*
-------------------------------------
 GOOD START - Require Functions
-------------------------------------
*/
require_once ('inc/theme-plugins.php'); 

require_once ('inc/theme-cleanup.php'); 

require_once ('inc/theme-utils.php'); 

require_once ('inc/theme-tinymce.php'); 
/*
-------------------------------------
 GOOD START - Theme Support
-------------------------------------
*/

// Enable language support
load_theme_textdomain( 'goodstart', get_template_directory() . '/lang' );

// Enable thumbnail support
add_theme_support('post-thumbnails');

// Set thumbnail sizes
add_image_size('image1170x780', 1170, 780, true);			// Full sizes

// Enable Menu support
register_nav_menu('main-nav', 'Main Nav');					// Main menu
register_nav_menu('sub-nav', 'Sub Nav');					// Sub menu

// Enable Page exceprt support
add_post_type_support('page', 'excerpt');

// Register scripts
function gs_enqueue_scripts() {
	if ( !is_admin() ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', "http" . ( $_SERVER['SERVER_PORT'] == 443 ? "s" : "" ) . "://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", false, null );
		wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-2.6.2.min.js' );
		wp_register_script( 'main', get_template_directory_uri() . '/js/scripts.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'modernizr' );
		wp_enqueue_script( 'main' );
	}
}

add_action( 'wp_enqueue_scripts', 'gs_enqueue_scripts' );





/*
-------------------------------------
 GOOD START - Misc Optimisations
-------------------------------------
*/


/*
-------------------------------------
 GOOD START - Custom Fields
-------------------------------------
*/

add_filter( 'acf/fields/wysiwyg/toolbars', 'gs_register_toolbar' );

function gs_register_toolbar( $toolbars )
{
	// Uncomment to view format of $toolbars
	$toolbars['Minimal' ] = array();
	$toolbars['Minimal' ][1] = array('bold' , 'italic' , 'underline', 'link', 'unlink' );
	
	/*if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false )
	{
	    unset( $toolbars['Full' ][2][$key] );
	}*/
	// remove the 'Basic' toolbar completely
	//unset( $toolbars['Basic' ] );
	return $toolbars;
}

function gs_chapter_index(){
	global $post;
	$chapters = array();

	$cb = get_field('content_blocks');
	foreach ($cb as $block) {
		if($block['acf_fc_layout'] == 'chapter'){
			array_push($chapters, $block['chapter_title']);
		}
	}

	$output = '<ol class="chapters">';
	foreach ($chapters as $chapter) {
		$output .= '<li><a href="#'.gs_to_slug($chapter).'">'.$chapter.'</a></li>';
	}
	$output .= '</ol>';

	echo $output;
}

?>