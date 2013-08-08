<?php
/**
 * @package WordPress
 * @subpackage goodstart
 */
?>
		<footer>
			&copy; <?php echo date("Y"); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.
			<?php $load = microtime();print ('generated in '.number_format($load,2).' seconds.');?>	
		</footer>
	</div>
	<?php wp_footer(); ?>
</body>
</html>