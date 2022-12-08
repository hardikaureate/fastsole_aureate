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
 function get_carousel(id,limit){
    var newajaxurl = 'http://fastsole.nexenitlabs.com/ajaxdata.php';
 	jQuery.ajax({
		type: "POST",
		url: newajaxurl,
		data: "termid="+id+"&limit="+limit,
		success: function(response){
			jQuery('#instock').html('<div class="loading-wrap" style="display:table; width:100%; text-align:center;"><div class="loading" style="display: table-cell; vertical-align: middle;  height: 350px;  width: 100%;"><img src="http://fastsole.nexenitlabs.com/wp-content/themes/fs/wp-advanced-search/img/loading.gif" alt="loading" /></div></div>');
			jQuery('.instock').owlCarousel({
						responsive:{
						0:{
							items:1 
						},
						480:{
							items:1
						},
						768:{
							items: 1 
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
			},
			beforeSend: function(){
				jQuery('#instock').html('<div class="loading-wrap" style="display:table; width:100%; text-align:center;"><div class="loading" style="display: table-cell; vertical-align: middle;  height: 350px;  width: 100%;"><img src="http://fastsole.nexenitlabs.com/wp-content/themes/fs/wp-advanced-search/img/loading.gif" alt="loading" /></div></div>');
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
  	<div class="releases-section wow fadeInDown" data-wow-delay="0.5s">
     	<div class="container">
        	<div class="row">
               	<div class="col-md-12">
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
	                                 <a  href="#instock" onclick="get_carousel('<?php echo $first_status_id; ?>','<?php echo $first_number_of_products ; ?>')"  data-toggle="tab"><?php echo $first_status_title; ?></a>
	                              </li>
	                            <?php endif; ?>
	                            <?php if( !empty($second_status_title) ) : ?>
	                              <li>
	                                 <a href="#instock" onclick="get_carousel('<?php echo $second_status_id; ?>','<?php echo $second_number_of_products ; ?>')" data-toggle="tab"><?php echo $second_status_title; ?></a>
	                              </li>
	                            <?php endif; ?>
								<?php if( !empty($third_status_title) ) : ?>
	                              <li>
	                                 <a href="#this-week" onclick="get_carousel('<?php echo $third_status_id; ?>','<?php echo $third_number_of_products ; ?>')" data-toggle="tab"><?php echo $third_status_title; ?></a>
	                              </li>
	                            <?php endif; ?>
								<?php if( !empty($fourth_status_title) ) : ?>
		                            <li>
		                                 <a href="#best-seller" onclick="get_carousel('<?php echo $fourth_status_id; ?>','<?php echo $fourth_number_of_products ; ?>')" data-toggle="tab"><?php echo $fourth_status_title; ?></a>
		                            </li>
								<?php endif; ?>
								<?php if( !empty($fifth_status_title) ) : ?>
	                              <li>
	                                 <a href="#new-arrivals" onclick="get_carousel('<?php echo $fifth_status_id; ?>','<?php echo $fifth_number_of_products ; ?>')" data-toggle="tab"><?php echo $fifth_status_title; ?></a>
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
			                        
									<div class="active" id="instock">
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
			                           		<a href="#"><i class="fa fa-eye" aria-hidden="true"></i> <?php _e( 'View All', 'fastsole' ); ?></a>
			                           </div>

			                        </div>

								<?php endif; ?>

							<?php endif; ?>


	                  </div>

	               </div>

	            </div>

	         </div>

	      </div>
		  </div>