<?php
/**
 * @package WordPress
 * @subpackage goodstart
 */
?>
<?php 
$text_field = get_sub_field('text_content');
$text = $text_field;

$figure_field = get_sub_field('text_figure');
$figure_image = wp_get_attachment_image_src($figure_field, 'full');
$figure = '<img src="'.$figure_image[0].'" alt="'.get_the_title($figure_field).'" />';

$caption_field = get_sub_field('text_caption');
$caption = $caption_field;
?>

<div class="content-block text">
	<div class="container">

		<div class="row">

<?php if( get_sub_field('text_caption_position') == 'left'): // caption: Left ?>
<?php if($caption_field): ?>
			<div class="caption span3">
<?php if($figure_field): ?>
				<?php echo $figure; ?>    
<?php endif; ?>	
				<?php echo $caption; ?>    
			</div>
<?php endif; ?>
<?php endif; ?>

<?php $offset = ( get_sub_field('text_caption_position')  == 'right' ? 'offset3' : '' ); ?>
			<div class="span6 <?php echo $offset; ?>">
				<?php echo $text; ?>    
			</div>

<?php if( get_sub_field('text_caption_position') == 'right'): // caption: Right ?>
<?php if($caption_field): ?>
			<div class="caption span3">
<?php if($figure_field): ?>
				<?php echo $figure; ?>    
<?php endif; ?>	
				<?php echo $caption; ?>    
			</div>
<?php endif; ?>
<?php endif; ?>

		</div>
	</div>
</div>