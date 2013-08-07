<?php
/**
 * @package WordPress
 * @subpackage goodstart
 */
?>

<?php get_header(); ?>

<?php if ( have_posts() ): ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php if ( $cb = get_field('content_blocks') ): ?>

<?php while( has_sub_field('content_blocks') ): ?>

<?php if(get_row_layout() == 'video'): // layout: Video ?>

<?php get_template_part( 'partials/content', 'video' ); ?>

<?php elseif(get_row_layout() == 'quote'): // layout: Quote ?>

<?php get_template_part( 'partials/content', 'quote' ); ?>

<?php elseif(get_row_layout() == 'text'): // layout: Text ?>

<?php get_template_part( 'partials/content', 'text' ); ?>

<?php elseif(get_row_layout() == 'gallery'): // layout: Gallery ?>

<?php get_template_part( 'partials/content', 'gallery' ); ?>

<?php elseif(get_row_layout() == 'images'): // layout: Images ?>

<?php get_template_part( 'partials/content', 'images' ); ?>

<?php elseif(get_row_layout() == 'chapter'): // layout: Chapter ?>

<?php get_template_part( 'partials/content', 'chapter' ); ?>

<?php endif; ?>

<?php endwhile; ?>

<?php endif; ?>

<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>