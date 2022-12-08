<?php
/**
 * The template for displaying single news.
 *
 * @package fastsole
 */
get_header();
get_template_part('template-parts/breadcrumb');
global $fastsole;
?>
      <div class="container">
         <h3>Hello world</h3>
         <div class="row bg-white margin-padding-0 wow fadeInDown" data-wow-delay="0.25s">
            <div class="news-content col-md-8 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-delay="0.25s">
               <?php if ( have_posts() ): while ( have_posts() ): the_post();?>
                  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                     <div class="news-content-date">
                        <h2><?php the_date( 'M' );?><br><span class="font-24"><?php echo get_the_date('d') ;?></span></h2>
                     </div>
                     <div class="news-content-heading">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                     </div>
                     <div class="news-content-info">
                        <div class="content-cat">
                           <p> <?php the_category(' , '); ?></p>
                        </div>
                        <?php if( has_tag() ): ?>
                        <div class="content-tag">
                           <p><i class="fa fa-tags" aria-hidden="true"></i><?php // the_tags('','');?></p>
                        </div>
                        <?php endif;?>
                     </div>
                     <div class="news-content-body">

                        <?php the_content(); ?>
                        
                        <div class="col-md-9 col-sm-8 col-xs-12 margin-padding-0">
                           <div class="product-share">
                              
                           </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12 margin-padding-0">

                           <?php 
                           $previous_link = get_previous_post_link( '%link', '<i class="fa fa-angle-left" aria-hidden="true"></i> Prev');
                           $next_link = get_next_post_link( '%link', 'Next <i class="fa fa-angle-right" aria-hidden="true"></i>' );

                            ?>
                           <div class="nav-button">
                              <?php if( $previous_link ) :?>
                              <div class="nav-button-prev">
                                 <?php echo $previous_link;?>
                              </div>
                           <?php endif; ?>

                           <?php if( $next_link ) :?>
                              <div class="nav-button-next">
                                 <?php echo $next_link; ?>
                              </div>
                           <?php endif; ?>
                           </div>
                        </div>
                     </div>
                  </article>
               <?php endwhile; endif;?>
            </div>

            <div class="news-sidebar col-md-4 col-sm-12 col-xs-12 wow fadeInRight" data-wow-delay="0.25s">
               <?php get_template_part( 'template-parts/recent', 'news' ) ;?>
            </div>
         </div>
      </div>
      
   <?php get_footer(); ?>