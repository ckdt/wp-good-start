<?php
/*
-------------------------------------
 GOOD START - Require Functions
-------------------------------------
*/
require_once ('inc/theme-plugins.php'); 

require_once ('inc/theme-cleanup.php'); 

require_once ('inc/theme-utils.php'); 
/*
-------------------------------------
 GOOD START - Theme Support
-------------------------------------
*/
add_theme_support('post-thumbnails');						// Post Thumbnails
add_image_size('image1170x780', 1170, 780, true);			// Full sizes

register_nav_menu('main-nav', 'Main Nav');					// Register menu
register_nav_menu('sub-nav', 'Sub Nav');					// Register menu

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
	
	if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false )
	{
	    unset( $toolbars['Full' ][2][$key] );
	}
	// remove the 'Basic' toolbar completely
	//unset( $toolbars['Basic' ] );
	return $toolbars;
}

$style_settings = array(
    'quote' => array(
         'inline' => 'offset3 span6',
         'centered' => 'offset2 span8',
         'full' => 'span12'
    ),
    'video' => array(
         'inline' => 'offset3 span6',
         'centered' => 'offset2 span8',
         'full' => 'span12'
    ),
    'text' => array(
         'inline' => 'offset3 span6'
    )
);

function gs_get_style($k,$v = 'inline'){
	global $style_settings;
	return $k.' '.$style_settings[$k][$v];
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