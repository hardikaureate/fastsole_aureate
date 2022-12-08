<?php
/**
 * The template for displaying single news.
 *
 * @package fastsole
 */
get_header();
?>
      <div class="container">
         <?php get_template_part('template-parts/breadcrumb'); ?>
         <div class="row bg-white margin-padding-0 wow fadeInDown" data-wow-delay="0.25s">
            <div class="news-content col-md-8 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-delay="0.5s">
               <?php if ( have_posts() ): while ( have_posts() ): the_post();?>
                  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                     <div class="news-content-heading">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                     </div>
                     
                     <div class="news-content-body">
                        <?php the_content(); ?>
                     </div>
                  </article>
               <?php endwhile; endif;?>
            </div>

            <div class="news-sidebar col-md-4 col-sm-12 col-xs-12 wow fadeInRight" data-wow-delay="0.5s">
               <?php get_template_part( 'template-parts/recent', 'news' ) ;?>
            </div>
         </div>
      </div>
      
   <?php get_footer(); ?>