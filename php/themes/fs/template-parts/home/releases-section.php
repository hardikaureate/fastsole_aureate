<?php

/**

 * The template for displaying releases section.

 *

 * This is the template that displays releases section on home page.

 *

 * @package fastsole

 *

 */
 
?>
<script>
 function get_carousel(id,limit,tabid){
    var newajaxurl = 'https://fastsole.co.uk/ajaxdata.php';
 	jQuery.ajax({
		type: "POST",
		url: newajaxurl,
		data: "termid="+id+"&limit="+limit,
		success: function(response){
			jQuery('#'+tabid+'').html(response);
			jQuery('#'+tabid+'-collapse').html('<div class="panel-body js-tabcollapse-panel-body">'+response+'</div>');
			
			jQuery('.instock').owlCarousel({
						responsive:{
						0:{
							items:1 
						},
						480:{
							items:1
						},
						768:{
							items: 2 
						},
						992:{
							items:4,  
						}
					},
					loop:true,
					margin:0,
					autoplay:true,
					autoplayTimeout:3000,
					stopOnHover:true,
					nav:true,
					navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'], 
					autoplayHoverPause:true,
					autoplaySpeed:1000			
			
			});
			return true;
			},
			beforeSend: function(){
				jQuery('#'+tabid+'').html('<div class="loading-wrap" style="display:table; width:100%; text-align:center; height:350px;"><div class="loading" style="display:table-cell; vertical-align:middle;height:450px;width:100%;"><img src="https://fastsole.co.uk/wp-content/themes/fs/wp-advanced-search/img/ajax-loader.gif" alt="loading" /></div></div>');
			jQuery('#'+tabid+'-collapse').html('<div class="panel-body js-tabcollapse-panel-body"><div class="loading-wrap" style="display:table; width:100%; text-align:center; height:350px;"><div class="loading" style="display:table-cell; vertical-align:middle;height:350px;width:100%;"><img src="https://fastsole.co.uk/wp-content/themes/fs/wp-advanced-search/img/ajax-loader.gif" alt="loading" /></div></div></div>'); 
				
				
			}
		});
	}
 </script>
 
 <?php

global $fastsole;


if ( isset( $fastsole['first_block_product_categories_title'] , $fastsole['first_block_product_categories'] ,$fastsole['first_block_product_numbers'] ) ) {

	if( !empty( $fastsole['first_block_product_categories_title'] && $fastsole['first_block_product_categories'] && $fastsole['first_block_product_numbers'] ) ){

	 $first_status_title = $fastsole['first_block_product_categories_title'];
	 $first_status_id = $fastsole['first_block_product_categories'];
	 $term = get_term_by('id', $first_status_id , 'status');
	 $first_ststus_archive_link = get_term_link( $term );
	 $first_number_of_products = $fastsole['first_block_product_numbers'];
	 
	// var_dump($first_status_id);
	 
	
	 
	}

}

if ( isset( $fastsole['second_block_product_categories_title'] , $fastsole['second_block_product_categories'] ,$fastsole['second_block_product_numbers'] ) ) {
	if( !empty( $fastsole['second_block_product_categories_title'] && $fastsole['second_block_product_categories'] && $fastsole['second_block_product_numbers'] ) ){

		 $second_status_title = $fastsole['second_block_product_categories_title'];
		 $second_status_id = $fastsole['second_block_product_categories'];
		 $term = get_term_by('id', $second_status_id , 'status');
		 $second_ststus_archive_link = get_term_link( $term );
		 $second_number_of_products = $fastsole['second_block_product_numbers'];
		 
		 //var_dump($second_status_id);
		 
	}
}

if ( isset( $fastsole['third_block_product_categories_title'] , $fastsole['third_block_product_categories'] ,$fastsole['third_block_product_numbers'] ) ) {
	if( !empty( $fastsole['third_block_product_categories_title'] && $fastsole['third_block_product_categories'] && $fastsole['third_block_product_numbers'] ) ){

		 $third_status_title = $fastsole['third_block_product_categories_title'];
		 $third_status_id = $fastsole['third_block_product_categories'];
		 $term = get_term_by('id', $third_status_id , 'status');
		 $third_ststus_archive_link = get_term_link( $term );
		 $third_number_of_products = $fastsole['third_block_product_numbers'];
		 
		// var_dump($third_status_id);
	}

}

if ( isset( $fastsole['fourth_block_product_categories_title'] , $fastsole['fourth_block_product_categories'] ,$fastsole['fourth_block_product_numbers'] ) ) {
	if( !empty( $fastsole['fourth_block_product_categories_title'] && $fastsole['fourth_block_product_categories'] && $fastsole['fourth_block_product_numbers'] ) ){
		 $fourth_status_title = $fastsole['fourth_block_product_categories_title'];
		 $fourth_status_id = $fastsole['fourth_block_product_categories'];
		 $term = get_term_by('id', $fourth_status_id , 'status');
		 $fourth_ststus_archive_link = get_term_link( $term );
		 $fourth_number_of_products = $fastsole['fourth_block_product_numbers'];
		 
		  //var_dump($fourth_status_id);
	}

}

if ( isset( $fastsole['fifth_block_product_categories_title'] , $fastsole['fifth_block_product_categories'] ,$fastsole['fifth_block_product_numbers'] ) ) {
	if( !empty( $fastsole['fifth_block_product_categories_title'] && $fastsole['fifth_block_product_categories'] && $fastsole['fifth_block_product_numbers'] ) ){

		 $fifth_status_title = $fastsole['fifth_block_product_categories_title'];
		 $fifth_status_id = $fastsole['fifth_block_product_categories'];
		 $term = get_term_by('id', $fifth_status_id , 'status');
		 $fifth_ststus_archive_link = get_term_link( $term );
		 $fifth_number_of_products = $fastsole['fifth_block_product_numbers'];
		 
		 //var_dump($fifth_status_id);
		
		 
	}

}

?>
	      <div class="releases-section wow fadeInDown" data-wow-delay="0.25s">
	         <div class="container">
	            <div class="row">

	            	<div class="visible-xs visible-sm">
	            		<?php 
		            		$status_terms = get_terms([
							    'taxonomy' => 'status',
							    'hide_empty' => false,
							]);

							foreach ($status_terms as $status_term) {
								$is_enable_front_page_render = get_term_meta( $status_term->term_id, 'is_visible_enabled_front_page', false);
								if( $is_enable_front_page_render[0] == "on" ){
								echo "<div class='col-xs-12 each-releas-section'>"; ?>
								<div class="mobile-section-title">
									<h3><?php echo $status_term->name; ?></h3>
									<a href="<?php echo home_url();?>/sneaker-release-dates/status/<?php echo $status_term->slug ?>"><i class="fa fa-eye" aria-hidden="true"></i> View All</a>
								</div>
								<?php

								$status_args = array(
									'post_type'  => 'sneaker',
									'posts_per_page' => $onfocus_number_of_products,

									'tax_query' => array(

										array(
											'taxonomy'         => 'status',
											'field'            => 'id',
											'terms'            => $status_term->term_id,
										)

									),
									'fields'                    => 'ids',
									'no_found_rows'             => true,
									'update_post_term_cache'    => false,
									'update_post_meta_cache'    => false,

								);

								$status_query = new WP_Query( $status_args );

								?>
								<?php if( $status_query-> have_posts() ): ?>
									<div class="owl-wrapper">
										<div id="<?php echo $status_term->slug;?>-carousel" class="owl-carousel">
										<?php  while( $status_query-> have_posts() ): $status_query-> the_post();?>

											<?php get_template_part( 'template-parts/content', 'sneaker' ); ?>

										<?php endwhile; wp_reset_postdata();?>
										</div>
									</div>
								
								<?php 
									echo "</div>";
								endif; ?>

								<?php }
								
							}

		            	?>
	            	</div>

	            	<!-- <div class="visible-xs visible-sm">
	            		<?php
	            			$status_blocks = [
	            				$first_block = [$first_status_title, $first_status_id, $first_status_title]
	            			];
	            			var_dump();

	            		?>
	            	</div> -->

					<div class="col-md-12 hidden-xs hidden-sm">
					

						<?php

						$args = array(
							'post_type'  => 'sneaker',
							'posts_per_page' => $onfocus_number_of_products,

							'tax_query' => array(

								array(
									'taxonomy'         => 'status',
									'field'            => 'id',
									'terms'            => $onfocus_status_id,
								)

							),

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


	               <div class="col-md-12 hidden-xs hidden-sm">
	                  <div id="exTab3" class="container">
	                     <div class="row">
	                        <div class="col-md-2 margin-padding-0">
	                           <div class="brand">
	                              <img src="<?php echo IMGPATH.'shoe_icon.png'?>" class="img-responsive" alt="">
	                              <h3> <?php _e( 'RELEASES', 'fastsole' ); ?></h3>
		                        </div>
	                        </div>
	                        <div class="col-md-10 margin-padding-0">
	                           <ul class="nav nav-tabs releases-sidebar-tabs sidebar-tabs" id="sidebar" role="tablist">
	                           	<?php if( !empty($first_status_title) ) : ?>
	                              <li class="active">
	                                 <a  href="#instock" onclick="get_carousel('<?php echo $first_status_id; ?>','<?php echo $first_number_of_products ; ?>','instock')"  data-toggle="tab"><?php echo $first_status_title; ?></a>
	                              </li>
	                            <?php endif; ?>
	                            <?php if( !empty($second_status_title) ) : ?>
	                              <li>
	                                 <a href="#comingsoon" onclick="get_carousel('<?php echo $second_status_id; ?>','<?php echo $second_number_of_products ; ?>','comingsoon')" data-toggle="tab"><?php echo $second_status_title; ?></a>
	                              </li>
	                            <?php endif; ?>
								<?php if( !empty($third_status_title) ) : ?>
	                              <li>
	                                 <a href="#onfocus" onclick="get_carousel('<?php echo $third_status_id; ?>','<?php echo $third_number_of_products ; ?>','onfocus')" data-toggle="tab"><?php echo $third_status_title; ?></a>
	                              </li>
	                            <?php endif; ?>
								<?php if( !empty($fourth_status_title) ) : ?>
		                            <li>
		                                 <a href="#delayed" onclick="get_carousel('<?php echo $fourth_status_id; ?>','<?php echo $fourth_number_of_products ; ?>','delayed')" data-toggle="tab"><?php echo $fourth_status_title; ?></a>
		                            </li>
								<?php endif; ?>
								<?php if( !empty($fifth_status_title) ) : ?>
	                              <li>
	                                 <a href="#soldout" onclick="get_carousel('<?php echo $fifth_status_id; ?>','<?php echo $fifth_number_of_products ; ?>','soldout')" data-toggle="tab"><?php echo $fifth_status_title; ?></a>
	                              </li>
	                            <?php endif; ?>
	                           </ul>
	                           <div class="border-red margin-right-30">
	                           </div>
	                        </div>
	                     </div>
	                  </div>
	               </div>

               <div class="col-md-12 hidden-xs hidden-sm">
	                  <div class="col-md-12 margin-padding-0">
	                     <div class="tab-content">
	                     	<?php //first block starts ?>
	                     	<?php if( !empty($first_status_id) ) : ?>
								<?php
									 $args = array(
									    'post_type'  => 'sneaker',
									    'showposts' => $first_number_of_products,
									    'tax_query' => array(
									      array(
									        'taxonomy'         => 'status',
									        'field'            => 'id',
									        'terms'            => $first_status_id,
									      )
									    ),
									 );
									$query = new WP_Query( $args );
								?>
								<?php if( $query-> have_posts() ): ?>
			                        
									<div class="tab-pane active" id="instock">
			                           <div  class="instock owl-carousel">

			                          <?php $counter = -1; ?>

	                              	    <?php  while( $query-> have_posts() ): $query-> the_post();?>
	                              		<?php $counter++;?>
	                              		<?php if ($counter % 2 == 0) : ?>
	                              		<?php echo '<div>'; ?>
	                              		<?php endif; ?>
				                        <?php get_template_part( 'template-parts/content', 'sneaker' ); ?>
			                            <?php if ($counter % 2 != 0) : ?>
	        							<?php echo '</div>'; ?>
	    								<?php endif; ?>
				                        <?php endwhile; 
										
										wp_reset_postdata();?>
			                           </div>


			                           <div class="releases-view-all">
			              <a href="<?php echo esc_url( $first_ststus_archive_link ); ?>"><i class="fa fa-eye" aria-hidden="true"></i> <?php _e( 'View All', 'fastsole' ); ?> </a>
			                           </div>

			                        </div>

								<?php endif; ?>

							<?php endif; ?>
                            
							   <div class="tab-pane" id="comingsoon">
							   
		                       </div>
							   <div class="tab-pane" id="onfocus">
							   
	                           </div>
	                   	       <div class="tab-pane" id="delayed">
							   
 	                           </div>
							   <div class="tab-pane" id="soldout">
							   
 	                           </div>

	                  </div>

	               </div>

	            </div>

	         </div>

	      </div>
		  </div>