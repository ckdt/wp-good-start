<?php 

/*
-------------------------------------
 Custom Video Embed Functions
-------------------------------------
*/

function gs_video_embed( $url ){
	if (strpos($url, 'youtube') > 0) {
		return gs_embed_youtube( $url );	// return youtube embed
	} elseif (strpos($url, 'vimeo') > 0) {
		return gs_embed_vimeo( $url );		// return vimeo embed
	} else {
		return null;						// return nothing
	}
}

function gs_embed_youtube( $url ){
	$id = gs_get_youtube_id( $url );
	$output = '<iframe width="560" height="315" src="//www.youtube.com/embed/'.$id.'?rel=0" frameborder="0" allowfullscreen></iframe>'.PHP_EOL;
	return $output;
}

function gs_embed_vimeo( $url ){
	$id = gs_get_vimeo_id( $url );
	$output = '<iframe src="http://player.vimeo.com/video/'.$id.'?title=0&amp;byline=0&amp;portrait=0" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'.PHP_EOL;
	return $output;
}

function gs_get_youtube_id( $url ){
	preg_match( "#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches );
	return $matches[0];
}

function gs_get_vimeo_id( $url ){
	$regex = '~
		# Match Vimeo link and embed code
		(?:<iframe [^>]*src=")?         	# If iframe match up to first quote of src
		(?:                             	# Group vimeo url
				https?:\/\/             	# Either http or https
				(?:[\w]+\.)*            	# Optional subdomains
				vimeo\.com              	# Match vimeo.com
				(?:[\/\w]*\/videos?)?   	# Optional video sub directory this handles groups links also
				\/                      	# Slash before Id
				([0-9]+)                	# $1: VIDEO_ID is numeric
				[^\s]*                  	# Not a space
		)                               	# End group
		"?                              	# Match end quote if part of src
		(?:[^>]*></iframe>)?            	# Match the end of the iframe
		(?:<p>.*</p>)?                  	# Match any title information stuff
		~ix';
	preg_match( $regex, $url, $matches );
	return $matches[1];
}
// Convert string to slug format
function gs_to_slug($string){
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
}
?>