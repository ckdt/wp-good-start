<?php
/**
 * @package WordPress
 * @subpackage goodstart
 */
?>

<?php
$images = get_sub_field('images');
?>

<div class="content-block images">
	<div class="container">

		<div class="row">
<?php 
if( $images ): 

// global vars
$total = count($images);
$output = '';

foreach( $images as $image ):

    $caption = $image['image_caption'];
    $image = $image['image_field']; 
    $count ++;

    if($total === 1):

        $output = '<div class="offset3 span6">';
        $output .= '<img src="'.$image['sizes']['image1170x780'].'" alt="'.$image['alt'].'"  title="'.$image['title'].'" />';    
        $output .= '<div class="caption">'.$caption.'</div>';
        $output .= '</div>';   

    elseif($total === 2):

        // first has offset
        if( $count === 1 ){ 
            $output = '<div class="offset2 span4">';
        }else{
            $output .= '<div class="span4">';
        }
        $output .= '<img src="'.$image['sizes']['image1170x780'].'" alt="'.$image['alt'].'"  title="'.$image['title'].'" />';    
        $output .= '<div class="caption">'.$caption.'</div>';
        $output .= '</div>';   

    elseif($total === 3):
       
        // first has offset
        if( $count === 1 ){ 
            $output = '<div class="span4">';
        }else{
            $output .= '<div class="span4">';
        }
        $output .= '<img src="'.$image['sizes']['image1170x780'].'" alt="'.$image['alt'].'"  title="'.$image['title'].'" />';    
        $output .= '<div class="caption">'.$caption.'</div>';
        $output .= '</div>';   

     elseif($total === 4):
        
        // first has offset
        if( $count === 1 ){ 
            $output = '<div class="span3">';
        }else{
            $output .= '<div class="span3">';
        }
        $output .= '<img src="'.$image['sizes']['image1170x780'].'" alt="'.$image['alt'].'"  title="'.$image['title'].'" />';    
        $output .= '<div class="caption">'.$caption.'</div>';
        $output .= '</div>';   
    endif;

endforeach;

echo $output;

endif; 
?>


		</div>
	</div>
</div>