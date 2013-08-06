<?php
/**
 * @package WordPress
 * @subpackage goodstart
 */
?>
<?php
	$title = get_sub_field('chapter_title');
?>
<div class="content-block chapter">
	<div class="container">
		<div class="row">
			<div class="span12">
				<a name="<?php echo gs_to_slug($title); ?>"><?php echo $title; ?></a>
			</div>
		</div>
	</div>
</div>