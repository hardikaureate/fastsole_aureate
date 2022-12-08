<?php

/**
 * The main index template file.
 *
 * @package fastsole
 */
get_header();
?>

    <?php  get_template_part( 'template-parts/home/slider' ,'section'); ?>

    <?php get_template_part( 'template-parts/home/on-focus' ,'section'); ?>

	<?php // get_template_part( 'template-parts/home/middle-banner' ,'section'); ?>

	<?php get_template_part( 'template-parts/home/releases' ,'section'); ?>

	<?php // get_template_part( 'template-parts/home/brand' ,'section'); ?>

	<?php get_template_part( 'template-parts/home/news' ,'section'); ?>

 <?php get_footer(); ?>
