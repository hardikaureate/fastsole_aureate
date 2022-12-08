<?php
/**
 * The template for displaying Coming Soon section.
 *
 * This is the template that displays Coming Soon section on home page.
 *
 * @package fastsole
 *
 */
global $fastsole;

if ( isset( $fastsole['coming_soon_product_categories_title'] , $fastsole['coming_soon_product_categories'] ,$fastsole['coming_soon_product_numbers'] ) ) {

    if( !empty( $fastsole['coming_soon_product_categories_title'] && $fastsole['coming_soon_product_categories'] && $fastsole['coming_soon_product_numbers'] ) ){

        $coming_soon_title = $fastsole['coming_soon_product_categories_title'];
        $coming_soon_status_id = $fastsole['coming_soon_product_categories'];
		$term = get_term_by('id', $coming_soon_status_id , 'status');
		$coming_soon_ststus_archive_link = get_term_link( $term );
		$coming_soon_number_of_products = $fastsole['coming_soon_product_numbers'];

	}
}
?>

<?php if( !empty($coming_soon_status_id) ) : ?>

	<div class="onfocus-slider wow fadeInDown" data-wow-delay="0.25s">
		<div class="container">
			<div class="row on-focus-slider">
				<div class="col-md-12 onfocus-header">
					<div class="on-focus-header">
						<div class="col-md-2 margin-padding-0">
							<?php if( !empty($coming_soon_title) ) : ?>
								<div class="brand hidden-xs hidden-sm">

									<h3><?php echo $coming_soon_title; ?></h3>
								</div>
								<div class="visible-xs visible-sm">
                                <!-- <img src="<?php echo IMGPATH.'shoe_icon.png'?>" class="img-responsive" alt=""> -->

									<div class="mobile-section-title">
										<h3>Coming Soon</h3>
										<a href="<?php echo esc_url( $coming_soon_ststus_archive_link ); ?>"><i class="fa fa-eye" aria-hidden="true"></i> <?php _e( 'View All', 'fastsole' ); ?></a>
									</div>
								</div>
							<?php endif; ?>
						</div>
						<div class="col-md-10 on-focus-header-border coming-soon-header-border hidden-xs hidden-sm">
							<div class="col-md-9">
							</div>
							<div class="col-md-3">
								<div class="on-focus-header-right">
									<a href="<?php echo esc_url( $coming_soon_ststus_archive_link ); ?>"><i class="fa fa-eye" aria-hidden="true"></i> <?php _e( 'View All', 'fastsole' ); ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="container hidden-xs hidden-sm">
					<div class="row">
						<div class="col-md-12">
							<div class="border-red">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-12 margin-padding-0">
						<?php

						$args = array(
							'post_type'  => 'sneaker',
							'posts_per_page' => $coming_soon_number_of_products,

							'tax_query' => array(

								array(
									'taxonomy'         => 'status',
									'field'            => 'id',
									'terms'            => $coming_soon_status_id,
								)
							),
							'fields'                    => 'ids',
							'no_found_rows'             => true,
							'update_post_term_cache'    => false,
							'update_post_meta_cache'    => false,

						);

						$query = new WP_Query( $args );

						?>
						<?php if( $query-> have_posts() ): ?>
							<div id="on-focus" class="owl-carousel">
								<?php  while( $query-> have_posts() ): $query-> the_post();?>

									<?php get_template_part( 'template-parts/content', 'sneaker' ); ?>

								<?php endwhile; wp_reset_postdata();?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
