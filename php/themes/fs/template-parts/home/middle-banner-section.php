<?php
/**
 * The mid banner section file.
 *
 * @package fastsole
 */
global $fastsole;
?>
          <div class="middle-banner-section">
             <div class="container">
	            <div class="row">
	               <div class="col-md-12 middle-banner">
	               	<?php if ( !empty( $fastsole['mid-banner-1'] ) && !empty($fastsole['mid-banner-1-link']) && !empty($fastsole['mid-banner-1-title'])) :?>
	                  <div class="col-sm-6 middle-banner-single wow fadeInLeft" data-wow-delay="0.25s">
	                     <a href="<?php echo esc_url( $fastsole['mid-banner-1-link'] ); ?>" ><img src="<?php echo $fastsole['mid-banner-1'] ['url'];?>" class="img-responsive" alt="<?php echo esc_html( $fastsole['mid-banner-1-title'] ); ?>"></a>
	                  </div>
	                <?php endif; ?>

	                <?php if ( !empty( $fastsole['mid-banner-2'] ) && !empty($fastsole['mid-banner-2-link']) && !empty($fastsole['mid-banner-2-title'])) :?>
	                  <div class="col-sm-6 middle-banner-single wow fadeInRight" data-wow-delay="0.25s">
	                     <a href="<?php echo esc_url( $fastsole['mid-banner-2-link'] ); ?>"><img src="<?php echo $fastsole['mid-banner-2'] ['url'];?>" class="img-responsive" alt="<?php echo esc_html( $fastsole['mid-banner-2-title'] ); ?>"></a>
	                  </div>
	                <?php endif; ?>
	               </div>
	            </div>
	         </div>
	      </div>
