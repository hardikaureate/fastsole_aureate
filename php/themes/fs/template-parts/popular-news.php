 <?php
/**
 *
 * This is the template that displays news in home page.
 *
 * @package fastsole
 *
 */

 $args = array(
    'post_type'  => 'post',
    'posts_per_page' =>4,
    
);
$news = new WP_Query( $args );
?>

<?php if( $news-> have_posts() ):?>
      <div class="container wow fadeInDown popular-news" data-wow-delay="0.25s">
         
         <div class="row news">
            <div class="col-md-12 margin-padding-0">

              <div class="release-header bg-white">
                <h2>Popular News</h2>
             </div>
             <div class="border-red"></div>
               <?php while( $news-> have_posts() ): $news->the_post(); ?>
               <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12 single-news margin-padding-0 border-right border-bottom">
                  <?php if( has_post_thumbnail() ) : ?>
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 margin-padding-0">
                     <div class="news-img">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full', array('class' => 'img-responsive'));?></a>
                     </div>
                     
                  </div>
                  <?php endif; ?>
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 margin-padding-0 news-title ">
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

            <?php archive_excerpt(20) ;?>

         </div>
                  </div>
               </div>
              <?php endwhile; wp_reset_postdata(); ?>
               
            </div>
         </div>
      </div>
<?php endif; ?>