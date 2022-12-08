<?php
	$termid = $_POST['termid'];
	$limit  = $_POST['limit'];
?>
			           	<?php //first block starts ?>
	                     	<?php if( !empty($first_status_id) ) : ?>
								<?php
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



			                           <div class="releases-view-all">

			                           		<a href="<?php echo get_term_link($termid) ?>"><i class="fa fa-eye" aria-hidden="true"></i> <?php _e( 'View All', 'fastsole' ); ?></a>

			                           </div>

			                        

								<?php endif; ?>

							<?php endif; ?>