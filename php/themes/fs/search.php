<?php

/**

 * The search template file.

 *

 * It is used to display search result page.

 *

 * @package fastsole

 */

get_header();

?>



<div class="container container-xs-fluid">
	<?php get_template_part('template-parts/breadcrumb'); ?>

	<div class="row bg-white margin-padding-0 wow fadeInDown" data-wow-delay="0.75s" style="visibility: visible; animation-delay: 0.75s; animation-name: fadeInDown;">

		<div class="search-page-container clearfix">
			
			<?php  if( have_posts() ) :?>
				
				<div class="search-term">

					<h2>Search result for "<?php echo get_search_query();?>"</h2>

				</div>

				<div class="release-header">

					<h1>Sneakers</h1>
					
				</div>

				<div class="border-red"></div>

				<div class="release-body">


					<div class="clearfix">
						<?php while( have_posts() ): the_post(); ?>

							<div class="col-md-3 col-sm-4 col-xs-6 margin-padding-0">

								<?php get_template_part( 'template-parts/content','sneaker' ) ;?>

							</div>

						<?php endwhile; ?>

					</div>
					<div class="clearfix pagination-wrapper">
						<?php fs_sneaker_pagination();?>
					</div>

				</div>

				<?php else: ?>

					<?php get_template_part( 'template-parts/content','none' ); ?>

				<?php endif; ?>

			</div>

		</div>

	</div>

	<?php get_footer(); ?>