<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package fastsole
 */
get_header();

?>

<div class="container container-xs-fluid">
	<?php get_template_part('template-parts/breadcrumb'); ?>
	<div class="row">
		<div class=" col-lg-12 col-md-12 col-sm-12 news release-header clearfix" style="padding-bottom: 30px;">
			<h1 class="nothing-found-heading"><?php esc_html_e( 'Nothing Found', 'fastsole' ); ?></h1>
			<div class="border-red"></div>
			<div class=" col-lg-6 col-md-6 col-sm-12 col-xs-12 news padding-left-0 nothing-found-wrapper">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'solefashion' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</div>

	</div>
</div>



<?php get_footer(); ?>