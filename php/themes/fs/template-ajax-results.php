<?php
/*
 * template-ajax-results.php
 * This file should be created in the root of your theme directory
 */


if (have_posts()) :
while( have_posts() ): the_post(); ?>
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 margin-padding-0 testdata">
    <?php get_template_part( 'template-parts/content', 'sneaker' ) ;?>
</div>
<?php endwhile;
else :
   	echo '<p>Sorry, no results matched your search.</p>';
endif;
wp_reset_query();
?>