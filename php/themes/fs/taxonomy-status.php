<?php

/**

 * The main index template file.

 *

 * @package solefashion

 */

get_header();

?>

<?php 

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 

$archive_title = esc_html( $term->name );

?> 

      <div class="container container-xs-fluid">

         <?php get_template_part('template-parts/breadcrumb'); ?>

         <div class="row bg-white margin-padding-0 wow fadeInDown" data-wow-delay="0.75s">

            <div class="col-md-12 col-sm-12 ">

               <?php if( have_posts() ): ?>

               <div class="release-header">

                  <h2><?php echo $archive_title; ?></h2>

               </div>

               <div class="border-red hidden-xs"></div>
               <div class="border-gray visible-xs"></div>

               <div class="release-body">

                  <?php while( have_posts() ): the_post(); ?>

                  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 margin-padding-0">

                     <?php get_template_part( 'template-parts/content', 'sneaker' ) ;?>

                  </div>

                  <?php endwhile; ?>

                  <?php fs_sneaker_pagination();?>

               </div>

               <?php endif; ?>

            </div>

         </div>

      </div>

 <?php get_footer(); ?>