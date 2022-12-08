<?php
/**
 * The template for displaying Custom brand page.
  * Template Name: Brand Template
 *
 * @package fastsole
 */
get_header();

global $fastsole;
?>
<?php
$brand = get_post_meta( get_the_ID(), '_sf_custom_brand', true );
$colors = get_post_meta( get_the_ID(), '_sf_custom_brand_color', true );

//if( !empty($brand) && !empty($color) ):

?>  

<div class="container container-xs-fluid">

   <?php get_template_part('template-parts/breadcrumb'); ?>

      <div class="row bg-white margin-padding-0 wow fadeInDown" data-wow-delay="0.75s">
         
         <div class="col-md-12 col-sm-12 ">

            <?php if( have_posts() ): while( have_posts() ): the_post(); ?>

            <div class="release-header">

               <h2><?php the_title(); ?> Releases</h2>

            </div>

               <div class="border-red hidden-xs"></div>
               <div class="border-gray visible-xs"></div>

               <?php

                     $args = array(
                           'post_type' => 'sneaker',
                           'posts_per_page'         => 20,
                           'posts_per_archive_page' => 20,
                           'nopaging'               => false,
                           'paged'                  => get_query_var( 'paged' ),
                           'tax_query' => array(
                              'relation' => 'AND',
                              array(
                                 'taxonomy'         => 'department',
                                 'field'            => 'slug',
                                 'terms'            => $brand,
                              ),
                              array(
                                 'taxonomy'         => 'colour',
                                 'field'            => 'slug',
                                 'terms'            => $colors,
                              ),
                           ),

                        ); 

                  $query = new WP_Query( $args );

                  if( $query->have_posts() ): ?>

                     <div class="release-body">

                        <?php while( $query->have_posts() ): $query->the_post(); ?>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 margin-padding-0">

                           <?php get_template_part( 'template-parts/content', 'sneaker' ) ;?>

                        </div>

                        <?php endwhile;?>
                        <?php if( function_exists('pagination_bar') ): ?>
                        <nav class="pagination">
                           <?php $pages = pagination_bar( $query ); ?>

                                <ul class="pagination">

                                     <?php

                                     foreach ( $pages as $page ) {

                                       echo '<li>' . $page . '</li>';

                                     }

                                     ?>
                                 </ul>
                        </nav>
                        <?php endif;?>
                     </div>

                        <?php  wp_reset_postdata();?>

                  <?php endif; ?>

               <?php if( !empty( get_the_content() ) ): ?>
               <div class="archive-text-wrapper">
                  <div class="archive-text armore">

                     <?php the_content() ; ?>

                  </div>
               </div>
              <?php endif; ?>
              
            <?php endwhile; endif;  ?>

         </div>

      </div>

</div>  
 


      
 <?php get_footer(); ?>









