<?php 
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php'); 
$termid = $_POST['termid'];
$limit  = $_POST['limit'];
?>
						<?php
						if($termid!=''){
							 $args = array(
									    'post_type'  => 'sneaker',
									    'showposts' => $limit,
									    'tax_query' => array(
									      array(
									        'taxonomy'         => 'status',
									        'field'            => 'id',
									        'terms'            => $termid,
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
									   <?php 
									   $term = get_term($termid, 'status' );
									   $term_link = get_term_link( $term );
									   ?>
			                           <div class="releases-view-all"><a href="<?php echo $term_link; ?>"><i class="fa fa-eye" aria-hidden="true"></i> <?php _e( 'View All', 'fastsole' ); ?></a>
			                           </div>
                  				<?php endif;
								
								
								} ?>

							