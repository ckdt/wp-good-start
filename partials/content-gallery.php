<?php
/**
 * @package WordPress
 * @subpackage goodstart
 */
?>

<?php
$images = get_sub_field('gallery_content');

$gallery_style = get_sub_field('gallery_style');

$style ='';
if( $gallery_style == 'full' ){ $style = 'span12'; }
if( $gallery_style == 'centered' ){ $style = 'span8 offset2'; }
if( $gallery_style == 'inline' ){ $style = 'span6 offset3'; }

?>

<div class="content-block gallery <?php echo $gallery_style; ?>">
	<div class="container">

		<div class="row">
			<div class="image-gallery <?php echo $style; ?>">

<?php
 
if( $images ): ?>
    <div id="slider" class="flexslider">
        <ul class="slides">
            <?php foreach( $images as $image ): ?>
                <li>
                    <img src="<?php echo $image['sizes']['image1170x780']; ?>" alt="<?php echo $image['alt']; ?>" />
                    <p><?php echo $image['caption']; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <!-- Uitdaging:
    Meerdere sliders, gekoppeld aan uniek id
    Relatieve javascript, opbasis van html settings -->
    
    <!--<div id="carousel" class="flexslider">
        <ul class="slides">
            <?php //foreach( $images as $image ): ?>
                <li>
                    <img src="<?php// echo $image['sizes']['thumbnail']; ?>" alt="<?php //echo $image['alt']; ?>" />
                </li>
            <?php //endforeach; ?>
        </ul>
    </div>-->
    
    
<?php endif; ?>

			</div>
		</div>
	</div>
</div>