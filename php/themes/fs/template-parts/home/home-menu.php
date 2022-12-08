<?php
/**
 * The home menu part.
 *
 * @package Fastsole
 */
global $fastsole;
?>
	    <div class="header-section wow fadeInDown" data-wow-delay="0s">
	         <div class="header-top ">
	            <div class="container">
	               <div class="row">
	                  <div class="col-md-3 site-logo">
	                     <div class="logo">
	                        <a href="<?php echo esc_url( home_url( '/' ) );?>">
	                        	<!-- <img src="<?php if(!empty($fastsole['footer-logo'] )){echo $fastsole['logo']['url'];}?>" class="img-responsive" alt="<?php bloginfo( 'name' ); ?>"> -->
	                        	<img src="<?php echo get_template_directory_uri();?>/img/logo.png" alt="Fastsole">
	                        </a>
	                     </div>
	                  </div>
	                  <div class="col-md-6 navbar-form-col">
	                     <?php get_search_form(); ?>
	                  </div>
	                  <div class="col-md-3 header-social-button col-sm-7 col-xs-9">
	                     <ul>
	                     	<?php if( !empty( $fastsole['twitter-link'] ) ):?>
	                        	<li><a href="<?php echo esc_url( $fastsole['twitter-link'] ); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
	                        <?php endif;?>

							<?php if( !empty( $fastsole['facebook-link'] ) ):?>
	                        	<li><a href="<?php echo esc_url( $fastsole['facebook-link'] ); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
	                        <?php endif;?>

	                        <?php if( !empty( $fastsole['instagram-link'] ) ):?>
	                        	<li><a href="<?php echo esc_url( $fastsole['instagram-link'] ); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
	                        <?php endif;?>
							
							<?php if( !empty( $fastsole['google-plus-link'] ) ):?>
	                        	<li><a href="<?php echo esc_url( $fastsole['google-plus-link'] ); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
	                        <?php endif;?>
							
							<?php if( !empty( $fastsole['pintarest-link'] ) ):?>
	                        <li><a href="<?php echo esc_url( $fastsole['pintarest-link'] ); ?>"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
	                        <?php endif;?>
	                     </ul>
	                  </div>
	               </div>
	            </div>
			 </div> <!-- /.header-top -->

			<div class="header-bottom-wrapper">
				<div class="header-bottom" id="sticky-header">
					<div class="container">
					<div class="row bg-white margin-padding-0">
						<div class="col-md-2 margin-padding-0 sticky-brand-col">
							<div class="brand">
								<img src="<?php echo IMGPATH.'shoe_icon.png'?>" class="img-responsive" alt="">
								<h3><?php _e( 'BRANDS', 'fastsole' ); ?></h3>
								<i class="fa fa-angle-double-down" aria-hidden="true"></i>
							</div>
						</div>

						<div class="sticky-logo-col">
							<a href="<?php echo esc_url( home_url( '/' ) );?>"><img src="<?php if(!empty($fastsole['footer-logo'] )){echo $fastsole['logo']['url'];}?>" class="img-responsive" alt="<?php bloginfo( 'name' ); ?>"></a>
						</div>

						<div class="col-md-8 margin-padding-0 sticky-menus-col">
							<div class="header-middle container-fluid">
								<?php
                                  wp_nav_menu(array(

                                  'theme_location' =>'primary',
                                  'container_class'=>'stellarnav',
                                  'container_id'   => 'main-nav',

                                  ) );
                                ?>
							</div>
						</div>
						

						<div class="header-social-button sticky-social-col">
							<ul>
								<?php if( !empty( $fastsole['twitter-link'] ) ):?>
		                        	<li><a href="<?php echo esc_url( $fastsole['twitter-link'] ); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
		                        <?php endif;?>

								<?php if( !empty( $fastsole['facebook-link'] ) ):?>
		                        	<li><a href="<?php echo esc_url( $fastsole['facebook-link'] ); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
		                        <?php endif;?>

		                        <?php if( !empty( $fastsole['instagram-link'] ) ):?>
		                        	<li><a href="<?php echo esc_url( $fastsole['instagram-link'] ); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
		                        <?php endif;?>
								
								<?php if( !empty( $fastsole['google-plus-link'] ) ):?>
		                        	<li><a href="<?php echo esc_url( $fastsole['google-plus-link'] ); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
		                        <?php endif;?>
								
								<?php if( !empty( $fastsole['pintarest-link'] ) ):?>
		                        	<li><a href="<?php echo esc_url( $fastsole['pintarest-link'] ); ?>"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
		                        <?php endif;?>
							</ul>
						</div>
					</div>
					</div>

					<div class="container">
						<div class="row">
						<div class="col-md-12">
							<div class="border-red">
							</div>
						</div>
						</div>
					</div>            
	            </div>
	        </div><!-- /.header-bottom-wrapper -->
	    </div> 