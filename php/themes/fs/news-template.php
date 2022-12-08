<?php
/**
* The news template file.
 *
 * It is used to display news page.
 *
 * Template Name: News Template
 *
 * @package fastsole
 */
get_header();
get_template_part('template-parts/breadcrumb');
global $fastsole;
?>
<?php  if( have_posts() ) :?>
      <div class="container">
         <div class="row margin-padding-0">
          
                  
            <?php while( have_posts() ): the_post();?>
               <?php get_template_part( 'template-parts/content' ) ;?>
            <?php endwhile; ?>

         </div>
      </div>
      <div class="container pagination-container wow fadeInDown" data-wow-delay="0.5s">
         <div class="row">
            <div class="col-md-12">
               <?php fastsole_pagination();?>
            </div>
         </div>
      </div>
       
      <?php get_template_part( 'template-parts/popular', 'news' ); ?>

      <?php else: ?>
         <?php get_template_part( 'template-parts/content','none' ); ?>
      <?php endif; ?>
 <?php get_footer(); ?>