<?php
/**
 * The template for displaying recent news.
 *
 * This is the template that displays recent news in single news page.
 *
 * @package fastsole
 *
 */
global $fastsole;
?>

 <?php
   $args = array(
               'post_type'  => 'post',
               'posts_per_page' => 14,
               'post__not_in' => array( $post->ID ),
            );

   $query = new WP_Query( $args );

   ?>
<?php if( $query->have_posts() ): ?>
<div class="content-related-news ">
   <h2 class="content-related-news-heading recent-news">Recent News</h2>
   <div class="border-red margin-bottom-15"></div>
      <?php  while( $query->have_posts() ): $query->the_post(); ?>
            <div class="margin-padding-0 col-md-12 col-sm-4 col-xs-12 single-related-news wow fadeInDown" data-wow-delay="0.25s">
               <div class="col-md-5 col-sm-12 margin-padding-0">
                        <div class="related-news-img">
                         <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?></a>
                        </div>
               </div>
               <div class="col-md-7 col-sm-12 padding-right-0">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
               </div>
            </div>
      <?php endwhile; wp_reset_postdata();?>
</div>
<?php endif; ?>
