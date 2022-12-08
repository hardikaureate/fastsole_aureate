<?php
/**
 * The template for displaying brand section.
 *
 * This is the template that displays brand section on home page.
 *
 * @package fastsole
 *
 */
?>
<script>
 function get_carouselbrand(id,limit,tabid){
    var newajaxurl = 'https://fastsole.co.uk/ajax_brands_data.php';
 	jQuery.ajax({
 		type: "POST",
		url: newajaxurl,
		data: "termid="+id+"&limit="+limit,
		success: function( response ){
			// console.log( response );

			jQuery('#'+tabid+'').html(response);
			jQuery('#'+tabid+'-collapse').html(response);
			jQuery('.nike').owlCarousel({
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
					navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'], 
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


//var_dump($fastsole);



if ( isset( $fastsole['brand_first_block_product_categories_title'] , $fastsole['brand_first_block_product_categories'] ,$fastsole['brand_first_block_product_numbers'] ) ) {

	if( !empty( $fastsole['brand_first_block_product_categories_title'] && $fastsole['brand_first_block_product_categories'] && $fastsole['brand_first_block_product_numbers'] ) ){

	 $first_brand_title = $fastsole['brand_first_block_product_categories_title'];
	 $first_brand_id = $fastsole['brand_first_block_product_categories'];
	 $term = get_term_by('id', $first_brand_id , 'department');
	 $first_brand_archive_link = get_term_link( $term );
	 $first_number_of_products = $fastsole['brand_first_block_product_numbers'];

	 
	}
}


if ( isset( $fastsole['brand_second_block_product_categories_title'] , $fastsole['brand_second_block_product_categories'] ,$fastsole['brand_second_block_product_numbers'] ) ) {

	if( !empty( $fastsole['brand_second_block_product_categories_title'] && $fastsole['brand_second_block_product_categories'] && $fastsole['brand_second_block_product_numbers'] ) ){

		 $second_brand_title = $fastsole['brand_second_block_product_categories_title'];
		 $second_brand_id = $fastsole['brand_second_block_product_categories'];
		 $term = get_term_by('id', $second_brand_id , 'department');
		 $second_brand_archive_link = get_term_link( $term );
		 $second_number_of_products = $fastsole['brand_second_block_product_numbers'];

	}
}


if ( isset( $fastsole['brand_third_block_product_categories_title'] , $fastsole['brand_third_block_product_categories'] ,$fastsole['brand_third_block_product_numbers'] ) ) {

	if( !empty( $fastsole['brand_third_block_product_categories_title'] && $fastsole['brand_third_block_product_categories'] && $fastsole['brand_third_block_product_numbers'] ) ){

		 $third_brand_title = $fastsole['brand_third_block_product_categories_title'];
		 $third_brand_id = $fastsole['brand_third_block_product_categories'];
		 $term = get_term_by('id', $third_brand_id , 'department');
		 $third_brand_archive_link = get_term_link( $term );
		 $third_number_of_products = $fastsole['brand_third_block_product_numbers'];
	}
}


if ( isset( $fastsole['brand_fourth_block_product_categories_title'] , $fastsole['brand_fourth_block_product_categories'] ,$fastsole['brand_fourth_block_product_numbers'] ) ) {

	if( !empty( $fastsole['brand_fourth_block_product_categories_title'] && $fastsole['brand_fourth_block_product_categories'] && $fastsole['brand_fourth_block_product_numbers'] ) ){

		 $fourth_brand_title = $fastsole['brand_fourth_block_product_categories_title'];
		 $fourth_brand_id = $fastsole['brand_fourth_block_product_categories'];
		 $term = get_term_by('id', $fourth_brand_id , 'department');
		 $fourth_brand_archive_link = get_term_link( $term );
		 $fourth_number_of_products = $fastsole['brand_fourth_block_product_numbers'];
	}
}


if ( isset( $fastsole['brand_fifth_block_product_categories_title'] , $fastsole['brand_fifth_block_product_categories'] ,$fastsole['brand_fifth_block_product_numbers'] ) ) {

	if( !empty( $fastsole['brand_fifth_block_product_categories_title'] && $fastsole['brand_fifth_block_product_categories'] && $fastsole['brand_fifth_block_product_numbers'] ) ){

		 $fifth_brand_title = $fastsole['brand_fifth_block_product_categories_title'];
		 $fifth_brand_id = $fastsole['brand_fifth_block_product_categories'];
		 $term = get_term_by('id', $fifth_brand_id , 'department');
		 $fifth_brand_archive_link = get_term_link( $term );
		 $fifth_number_of_products = $fastsole['brand_fifth_block_product_numbers'];
	}
}
		//var_dump($fifth_number_of_products);
 ?>

	      <div class="releases-section brand-sec wow fadeInDown hidden-sm hidden-xs" data-wow-delay="0.25s">
	         <div class="container">
	            <div class="row">
	               <div class="col-md-12">
	                  <div id="exTab3" class="container">
	                     <div class="row">
	                        <div class="col-md-2 margin-padding-0">
	                           <div class="brand">
	                              <img src="<?php echo IMGPATH.'shoe_icon.png'?>" class="img-responsive" alt="">
	                              <h3><?php _e( 'BRANDS', 'fastsole' ); ?></h3>
	                           </div>
	                        </div>
	                        <div class="col-md-10 margin-padding-0">
	                           <ul class="nav nav-tabs brands-sidebar-tabs sidebar-tabs" id="sidebar" role="tablist">
	                              <?php if( !empty($first_brand_title) ) : ?>
	                              <li class="active">
	                                 <a  href="#nike" onclick="get_carouselbrand('<?php echo $first_brand_id; ?>','<?php echo $first_number_of_products ; ?>','nike')" data-toggle="tab"><?php echo $first_brand_title; ?></a>
	                              </li>
	                              <?php endif; ?>

	                              <?php if( !empty($second_brand_title) ) : ?>
	                              <li>
	                                 <a href="#adidas" onclick="get_carouselbrand('<?php echo $second_brand_id; ?>','<?php echo $second_number_of_products ; ?>','adidas')"  data-toggle="tab"><?php echo $second_brand_title; ?></a>
	                              </li>
	                              <?php endif; ?>

	                              <?php if( !empty($third_brand_title) ) : ?>
	                              <li>
	                                 <a href="#jordan" onclick="get_carouselbrand('<?php echo $third_brand_id; ?>','<?php echo $third_number_of_products ; ?>','jordan')" data-toggle="tab"><?php echo $third_brand_title; ?></a>
	                              </li>
	                              <?php endif; ?>

								  <?php if( !empty($fourth_brand_title) ) : ?>
	                              <li>
	                                 <a href="#nmd" onclick="get_carouselbrand('<?php echo $fourth_brand_id; ?>','<?php echo $fourth_number_of_products ; ?>','nmd')" data-toggle="tab"><?php echo $fourth_brand_title; ?></a>
	                              </li>
	                              <?php endif; ?>

	                              <?php if( !empty($fifth_brand_title) ) : ?>
	                              <li>
	                                 <a href="#eqt" onclick="get_carouselbrand('<?php echo $fifth_brand_id; ?>','<?php echo $fifth_number_of_products ; ?>','eqt')" data-toggle="tab"><?php echo $fifth_brand_title; ?></a>
	                              </li>
	                              <?php endif; ?>
	                           </ul>
	                           <div class="border-red margin-right-30">
	                           </div>
	                        </div>
	                     </div>
	                  </div>
	               </div>
	               <div class="col-md-12">
					<?php if ( !empty( $fastsole['brand-banner'] ) && !empty($fastsole['brand-banner-link']) && !empty($fastsole['brand-banner-title']) ) :?>
	                  <div class="col-md-3 margin-padding-0 brands-tab-left-banner">
	                     <a href="<?php echo esc_url( $fastsole['brand-banner-link'] ); ?>" target="_blank"><img src="<?php echo $fastsole['brand-banner'] ['url'];?>" class="img-responsive" alt="<?php echo esc_html( $fastsole['brand-banner-title'] ); ?>"></a>
	                  </div>
					<?php endif; ?>
	                  <div class="col-md-9 margin-padding-0">
	                     <div class="tab-content ">


							<?php //first block starts ?>

	                     	<?php if( !empty($first_brand_id) ) : ?>
								<?php

									 $args = array(
									    'post_type'  => 'sneaker',
									    'showposts' => 10,
									    'tax_query' => array(
									      array(
									        'taxonomy'         => 'department',
									        'field'            => 'id',
									        'terms'            => $first_brand_id,
									      )

									    ),
										'fields'                    => 'ids',
										'no_found_rows'             => true,
										'update_post_term_cache'    => false,
										'update_post_meta_cache'    => false,

									 );

							$query = new WP_Query( $args );?>

							<?php if( $query-> have_posts() ): ?>
	                        <div class="tab-pane active " id="nike">
	                           <div  class="nike owl-carousel">
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
			                             
			                        <?php endwhile; wp_reset_postdata();?>
	                           </div>

	                           <div class="releases-view-all">
	                           		<a href="<?php echo esc_url( $first_brand_archive_link ); ?>"><i class="fa fa-eye" aria-hidden="true"></i> <?php _e( 'View All', 'fastsole' ); ?></a>
	                           </div>
	                        </div>
		                    <?php endif; ?>
							<?php endif; ?>
						<?php //first block ends ?>
						
						      
							   <div class="tab-pane" id="adidas">
							   
	                           </div>
	                   	       <div class="tab-pane" id="jordan">
							   
 	                           </div>
							   <div class="tab-pane" id="nmd">
							   
 	                           </div>
							    <div class="tab-pane" id="eqt">
							   
 	                           </div>
							   

						
	                     </div>
	                  </div>
	               </div>
	            </div>
	         </div>
	      </div>