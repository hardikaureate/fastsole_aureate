<?php

/**

 * The header file.

 *

 * @package Fastsole

 */

global $fastsole;

?>

<!doctype html>

<html <?php language_attributes(); ?>>

   	<head>

      	<meta charset="<?php bloginfo( 'charset' ); ?>">

      	<meta http-equiv="x-ua-compatible" content="ie=edge">

      	<meta name="viewport" content="width=device-width, initial-scale=1">
      	<meta name="mobile-web-app-capable" content="yes">

      	<?php get_template_part( 'template-parts/fs-meta-keywords' ); ?>

      	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

      	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
      	<!-- <link rel="stylesheet" href="https://use.typekit.net/hwq4jtd.css"> -->
      	<link href="https://fonts.googleapis.com/css?family=Fira+Sans:300,400,500,600" rel="stylesheet">
      	
      	<!-- <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet"> -->

      	<?php if( !empty( $fastsole['favicon'] ) ):?>

        <link href="<?php echo $fastsole['favicon']['url'];?>" rel="shortcut icon"/>

         <?php endif;?>

		<?php wp_head(); ?>

</head>

<body <?php body_class();?>>

	<!--[if lt IE 8]>

		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>

	<![endif]-->

	<div class="fakeloader1"></div>

	<?php if( !empty( $fastsole['custom-css'] ) ):?>

	<style> <?php echo $fastsole['custom-css'];?> </style>

    <?php endif;?>



	<div class="left-side-menu">

		<div class="side-menu-header">
			<a href="<?php echo esc_url( home_url( '/' ) );?>" class="sidenav-logo">

				<!-- <img src="<?php if(!empty($fastsole['footer-logo'] )){echo $fastsole['footer-logo']['url'];}?>" alt="<?php bloginfo( 'name' ); ?>"> -->
				<img src="<?php echo get_template_directory_uri();?>/img/logo.png" alt="Fastsole">

			</a>
			<a class="close-sidenav"><span class="close-icon"></span></a>
		</div>

		<?php

			wp_nav_menu(array(

				

			'theme_location' =>'primary',

			'menu_class'     => 'sidenav-menu',                   



			) );

		?>

	</div> <!-- /.left-side-menu -->


	<!-- <div class="right-side-menu">
		<a class="close-sidenav"><i class="fa fa-close" aria-hidden="true"></i></a>
	</div> -->

	<div class="right-side-menu">

		<a class="close-sidenav"><i class="fa fa-close" aria-hidden="true"></i></a>

		<a href="<?php echo esc_url( home_url( '/' ) );?>" class="sidenav-logo">

			<!-- <img src="<?php if(!empty($fastsole['footer-logo'] )){echo $fastsole['footer-logo']['url'];}?>" alt="<?php bloginfo( 'name' ); ?>"> -->
			<img src="<?php echo get_template_directory_uri();?>/img/footer-logo.png" alt="Fastsole">

		</a>

		<?php

            wp_nav_menu(array(



            'theme_location' =>'primary',

             'menu_class'    =>'sidenav-menu',                  



            ) );

        ?>

		

	</div> <!-- /.left-side-menu -->



	<div class="content-wrapper">

		<div class="content-wrapper-overlay"></div>

		

		<div class="mobile-menu-section-wrapper hidden-md hidden-lg">

			<div class="mobile-menu-section">

				<div class="container">

					<div class="row">

						<div class="col-xs-2 mobile-menu-left-col">

							<div class="mobile-menu-toggle">
								<div class="nav-mobile-menu open-left-menu">
									<span class="nav-burger-bar"></span>
									<span class="nav-burger-bar"></span>
									<span class="nav-burger-bar"></span>
								</div>

								<!-- <span class="open-left-menu">

									<i class="fa fa-bars"></i>	

									<span class="text"><?php _e( 'Menu', 'fastsole' ); ?></span>

								</span> -->
								<!-- <span class="open-right-menu">
								
									<span class="text"><?php _e( 'Menu', 'fastsole' ); ?></span>
								
									<i class="fa fa-bars"></i>	
								
								</span> -->

							</div>

						</div>

						<div class="col-xs-8">

							<div class="mobile-menu-logo">

								<a href="<?php echo esc_url( home_url( '/' ) );?>">

									<!-- <img src="<?php echo $fastsole['logo']['url'];?>" alt="<?php bloginfo( 'name' ); ?>"> -->
									<img src="<?php echo get_template_directory_uri();?>/img/logo.png" alt="Fastsole">

								</a>

							</div>

						</div>

						<div class="col-xs-2 mobile-menu-right-col">

							<div class="mobile-menu-toggle text-right">

								<!-- <span class="open-right-menu">
								
									<span class="text"><?php _e( 'Menu', 'fastsole' ); ?></span>
								
									<i class="fa fa-bars"></i>	
								
								</span> -->
								<span class="btn-search-trigger">

									<i class="fa fa-2 fa-search"></i>
								</span>
							</div>

						</div>

					</div>

				</div>

			</div> <!-- /.mobile-menu-section -->

		</div> <!-- /.mobile-menu-section-wrapper -->

		<div class="search-form-wrapper">
			<?php //  get_search_form(); ?>
			<form role="search" method="get" id="searchform"
			    class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			    <div>
			        <input type="text" value="<?php echo get_search_query(); ?>" placeholder="Type keyword here" name="s" id="s" />
			        <span class="btn-search-close"><span class="close-icon"></span></span>
			    </div>
			</form>
		</div>



<?php

if(is_front_page() ):

 get_template_part( 'template-parts/home/home' , 'menu'); 

else:

 ?>

	    <div class="header-section wow fadeInDown" data-wow-delay="0.25s">

	        <div class="header-top ">

	            <div class="container">

	                

					<div class="row">

					    <div class="col-md-3 site-logo" >

					        <div class="logo test">

					            <a href="<?php echo esc_url( home_url( '/' ) );?>">
					            	<!-- <img src="<?php if(!empty($fastsole['footer-logo'] )){echo $fastsole['logo']['url'];}?>" class="img-responsive" alt="<?php bloginfo( 'name' ); ?>"> -->
					            	<img src="<?php echo get_template_directory_uri();?>/img/logo.png" alt="fastsole">
					            </a>
								

					        </div>

					    </div>

					    <div class="col-md-6 navbar-form-col hidden-xs">

					        <?php get_search_form(); ?>

					    </div>

					    <div class="col-md-3 header-social-button col-sm-7 col-xs-9">

					        <ul>

	                     	<?php if( !empty( $fastsole['twitter-link'] ) ):?>

	                        	<li><a href="<?php echo esc_url( $fastsole['twitter-link'] ); ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

	                        <?php endif;?>



							<?php if( !empty( $fastsole['facebook-link'] ) ):?>

	                        	<li><a href="<?php echo esc_url( $fastsole['facebook-link'] ); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

	                        <?php endif;?>



	                        <?php if( !empty( $fastsole['instagram-link'] ) ):?>

	                        	<li><a href="<?php echo esc_url( $fastsole['instagram-link'] ); ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>

	                        <?php endif;?>

							

							<?php if( !empty( $fastsole['google-plus-link'] ) ):?>

	                        	<li><a href="<?php echo esc_url( $fastsole['google-plus-link'] ); ?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>

	                        <?php endif;?>

							

							<?php if( !empty( $fastsole['pintarest-link'] ) ):?>

	                        <li><a href="<?php echo esc_url( $fastsole['pintarest-link'] ); ?>" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>

	                        <?php endif;?>

	                     </ul>

					    </div>

					</div> <!-- /.row -->



	            </div>

	        </div>



	        <div class="header-bottom-wrapper">

				<div class="header-bottom inner-page-header-bottom" id="sticky-header">

		            <div class="container">

		                <div class="row">

		                    <div class="col-md-12">

		                    	<div class="bg-white clearfix">

		                    		<div class="sticky-logo-col">

										<a href="<?php echo esc_url( home_url( '/' ) );?>">
											<!-- <img src="<?php if(!empty($fastsole['footer-logo'] )){echo $fastsole['logo']['url'];}?>" class="img-responsive" alt="<?php bloginfo( 'name' ); ?>"> -->
											<img src="<?php echo get_template_directory_uri();?>/img/logo.png" alt="fastsole">
										</a>

									</div>



			                        <div class="header-middle sticky-menus-col">

			                            

			                                <?php

			                                  wp_nav_menu(array(



			                                  'theme_location' =>'primary',

			                                  'container_class'=>'stellarnav',

			                                  'container_id'   => 'main-nav',



			                                  ) );

			                                ?>

			                            

			                        </div> <!-- /.header-middle -->



									<div class="header-social-button sticky-social-col">

										<ul>

											<?php if( !empty( $fastsole['twitter-link'] ) ):?>

					                        	<li><a href="<?php echo esc_url( $fastsole['twitter-link'] ); ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

					                        <?php endif;?>



											<?php if( !empty( $fastsole['facebook-link'] ) ):?>

					                        	<li><a href="<?php echo esc_url( $fastsole['facebook-link'] ); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

					                        <?php endif;?>



					                        <?php if( !empty( $fastsole['instagram-link'] ) ):?>

					                        	<li><a href="<?php echo esc_url( $fastsole['instagram-link'] ); ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>

					                        <?php endif;?>

											

											<?php if( !empty( $fastsole['google-plus-link'] ) ):?>

					                        	<li><a href="<?php echo esc_url( $fastsole['google-plus-link'] ); ?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>

					                        <?php endif;?>

											

											<?php if( !empty( $fastsole['pintarest-link'] ) ):?>

					                        	<li><a href="<?php echo esc_url( $fastsole['pintarest-link'] ); ?>" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>

					                        <?php endif;?>

										</ul>

									</div>

		                    	</div> <!-- /.bg-white -->

		                    </div>

		                </div>

		            </div> <!-- /.container -->



		            <div class="container">

				        <div class="row">

				            <div class="col-md-12">

				                <div class="border-red"></div>

				            </div>

				        </div>

	    			</div> <!-- /.container -->

		        </div>

		    </div> <!-- /.header-bottom-wrapper -->

	    </div> <!-- /.header-section -->

<?php endif; ?>