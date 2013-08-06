<?php
/**
 * @package WordPress
 * @subpackage goodstart
 */
?>
<?php 
$quote_field = get_sub_field('quote_content');
$quote = $quote_field;

$quote_style = get_sub_field('quote_style');
$style ='';
if( $quote_style == 'full' ){ $style = 'span12'; }
if( $quote_style == 'centered' ){ $style = 'span8 offset2'; }
if( $quote_style == 'inline' ){ $style = 'span6 offset3'; }
?>

<div class="content-block quote">
	<div class="container">

		<div class="row">
			<div class="quote <?php echo $style; ?>">
				<blockquote>
					<h3><?php echo $quote; ?></h3>
					<?php if( get_sub_field('quote_author') ):?>
					<footer> 
						&mdash;
						<?php if( get_sub_field('quote_url') ):?>
							<a href="<?php the_sub_field('quote_url'); ?>"> <?php the_sub_field('quote_author'); ?> </a>
						<?php else: ?>
							<?php the_sub_field('quote_author'); ?>
						<?php endif; ?>
					</footer>
					<?php endif;?>
				</blockquote>    
			</div>
		</div>
	</div>
</div>