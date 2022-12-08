<?php

/**

 * The home slider file.

 *

 * @package fastsole

 */

global $fastsole;

?>
      <div class="slider-section  wow fadeInDown" data-wow-delay="0.5s">
         <div class="container">
	            <div class="row">
	               <div class="col-md-2 margin-padding-right-0 brand-menu-col">
	                  <div class="brand-menu">
	                    <?php
				            wp_nav_menu(array(
					            'theme_location' =>'brand-menu',                  
				            ) );
				        ?>
	                     <div class="cat-all">
	                        <h4> <a href="<?php echo get_post_type_archive_link( 'sneaker' ); ?>"><?php _e( 'All brands', 'fastsole' ); ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a> </h4>
	                     </div>
	                  </div>
	               </div>
	               <div class="col-sm-8 margin-padding-0 slider-section-slides">
					<?php 
	               	if ( !empty( $fastsole['home-slider'] ) ) :
	                $slides = $fastsole['home-slider'];

	                ?>

	                  <div class="nivoSlider" id="slider">

	                  	<?php foreach ($slides as $slide) { ?>

	                     <a href="<?php echo esc_url( $slide['url'] );?>"><img src="<?php echo $slide['image'];?>" class="img-responsive" alt="<?php echo esc_html(  $slide['title'] );?>"></a>

						<?php } ?>

	                  </div>

					<?php endif; ?>

	               </div>

	               <div class="col-sm-2 header-banner slider-section-banners">

					<?php if ( !empty( $fastsole['slider-banner-1'] ) && !empty($fastsole['slider-banner-1-link']) && !empty($fastsole['slider-banner-1-title']) ) :?>

	                  <div class="col-md-12 padding-left-0">

	                     <a href="<?php echo esc_url( $fastsole['slider-banner-1-link'] ); ?>" target="_blank"><img src="<?php echo $fastsole['slider-banner-1'] ['url'];?>" class="img-responsive" alt="<?php echo esc_html( $fastsole['slider-banner-1-title'] ); ?>"></a>

	                  </div>

	                 <?php endif; ?>



	                 <?php if ( !empty( $fastsole['slider-banner-2'] )&& !empty($fastsole['slider-banner-2-link']) && !empty($fastsole['slider-banner-2-title']) ) :?>

	                  <div class="col-md-12 padding-left-0">

	                     <a href="<?php echo esc_url( $fastsole['slider-banner-2-link'] ); ?>" target="_blank"><img src="<?php echo $fastsole['slider-banner-2'] ['url']?>" class="img-responsive" alt="<?php echo esc_html( $fastsole['slider-banner-2-title'] ); ?>"></a>

	                  </div>

	                  <?php endif; ?>

	               </div>

	            </div>

	         </div>

	      </div>

