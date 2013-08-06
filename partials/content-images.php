<?php
/**
 * @package WordPress
 * @subpackage goodstart
 */
?>

<?php
$images = get_sub_field('images');

echo '<pre>';
var_dump($images);
echo '</pre>';

/*$gallery_style = get_sub_field('gallery_style');
$style ='';
if( $gallery_style == 'full' ){ $style = 'span12'; }
if( $gallery_style == 'centered' ){ $style = 'span8 offset2'; }
if( $gallery_style == 'inline' ){ $style = 'span6 offset3'; }
*/
?>

<div class="content-block images">
	<div class="container">

		<div class="row">

<?php
 
if( $images ): ?>
        <ul>
            <?php foreach( $images as $image ): ?>
                <li>
                    <img src="<?php echo $image['sizes']['image1170x780']; ?>" alt="<?php echo $image['alt']; ?>" />
                    <p><?php echo $image['caption']; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
<?php endif; ?>


		</div>
	</div>
</div>