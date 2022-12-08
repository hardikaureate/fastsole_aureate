 <?php
/**
 *
 * This is the template that displays news in home page.
 *
 * @package fastsole
 *
 */
global $fastsole;

 $args = array(
    'post_type'  => 'post',
    'posts_per_page' =>12,
    
);

$news = new WP_Query( $args );
?>


 <!-- news section starts -->
 		<?php if( $news-> have_posts() ):?>
	      <div class="news-section wow fadeInDown" data-wow-delay="0.25s">
	         <div class="container">
	            <div class="row">
	               <div class="col-xs-12 news-header hidden-xs hidden-sm">
	                  <div class="col-xs-6 news-header-left">
	                     <h3><i class="fa fa-lightbulb-o" aria-hidden="true"></i> &nbsp; <?php esc_html_e( 'NEWS', 'fastsole' ); ?></h3>
	                  </div>
	                  <div class="col-xs-6 news-header-right">
	                     <h4><a href="https://fastsole.co.uk/sneaker-news/"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp; <?php esc_html_e( 'View All', 'fastsole' ); ?></a></h4>
	                  </div>
	               </div>

					<div class="mobile-section-title mobile-news-section-title visible-xs visible-sm">
						<h3>News</h3>
						<a href="<?php echo home_url();?>/sneaker-news/"><i class="fa fa-eye" aria-hidden="true"></i> View All</a>
					</div>

	            </div>
	            <div class="row news">
	               <div class="col-md-12 margin-padding-0">

					<?php while( $news-> have_posts() ): $news->the_post(); ?>
	                  <div class="col-sm-6 single-news margin-padding-0 border-right border-bottom">
	                  	<?php if( has_post_thumbnail() ) : ?>
	                     <div class="col-md-6 margin-padding-0">
	                        <div class="news-img">
	                           <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full', array('class' => 'img-responsive'));?></a>
	                        </div>
	                        <!-- <div class="news-date">
	                           <p><?php echo get_the_date( 'd M' ); ?></p>
	                        </div> -->
	                     </div>
	                	<?php endif; ?>
	                     <div class="col-md-6 margin-padding-0 news-title ">
	                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	                       <div class="news-info">
                      <div class="posted-in">
                         <p>
                            <i class="fa fa-calendar"></i>
                            <?php 
                               $archive_year  = get_the_time('Y'); 
                               $archive_month = get_the_time('m'); 
                               $archive_day   = get_the_time('d'); 
                            ?>
                            <a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( 'd M' ); ?></a>

                         </p>
                      </div>
                         <?php if( has_tag() ):?>

                          <div class="post-tag">

                             <p><i class="fa fa-folder-open"></i> <?php the_category(' , '); ?></p>

                          </div>

                          <?php endif;?>
                     </div>
	                        <div class="news-body">
	                           <?php archive_excerpt(20);?>
	                        </div>
	                     </div>
	                  </div>
	                <?php endwhile; wp_reset_postdata(); ?>

			           
	            </div>

	                 
	               </div>
	         </div>
	      </div>
	  <?php endif; ?>
	      <!-- news section ends -->

	      