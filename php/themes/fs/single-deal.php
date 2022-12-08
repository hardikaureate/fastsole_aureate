<?php

/**

 * The template for displaying single deal page.

 *

 * @package fastsole

 */

get_header();

global $fastsole;

?>
<div class="container container-xs-fluid deal-container">
  <?php get_template_part('template-parts/breadcrumb'); ?>
    <div class="row bg-white margin-padding-0 wow fadeInDown" data-wow-delay="0.25s">
      <div class="news-content deal-content col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-delay="0.5s">

               <?php if ( have_posts() ): while ( have_posts() ): the_post();?>

                  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                      <div class="index-heading ">
                        <h2><?php the_title(); ?></h2>
                        <div class="border-red margin-bottom-15 hidden-sm hidden-xs"></div>
                     </div>
                     <div class="news-content-body">
                      
                        <?php $entries = get_post_meta( get_the_ID(), '_sf_deal_group', true ); 

                            foreach ( (array) $entries as $key => $entry ):

                            if ( !empty( $entry['offer_title'] ) ) {
                               $offer_title = $entry['offer_title'] ;
                            }
                           

                            if ( !empty( $entry['offer_link'] ) ) {
                              $offer_link =   $entry['offer_link'] ;
                            }
                            
                            if ( !empty( $entry['offer_description'] ) ) {
                               $offer_desc =   $entry['offer_description'] ;
                            }
                           

                            $img = $entry['offer_image_id'];

                            $img = wp_get_attachment_image( $entry['offer_image_id'], 'news-thumb', null, array( 'class' => 'img-responsive', ) );

                            ?>

                              <div class="deal deal-single col-md-3 col-sm-6 col-xs-6 padding-left-0">

                                 <div class="col-md-12 margin-padding-0">
                                    <h2 class="deal-title"><a href="<?php if( !empty($offer_link) ){ echo esc_url( $offer_link ) ;} ?>" target="_blank" rel="nofollow"><?php if( !empty($offer_title) ){echo esc_html( $offer_title );}  ?></a></h2>

                                 </div>

                                 <div class="col-md-12 margin-padding-0">
                                    <a href="<?php if( !empty($offer_link) ){ echo esc_url( $offer_link );} ?>" target="_blank" rel="nofollow">   <?php echo $img; ?>
                                    </a>

                                 </div>
                                 <div class="col-md-12 margin-padding-0">

                                    <p class="deal-footer"><?php if( !empty($offer_desc) ){ echo esc_html( $offer_desc ); } ?></p>

                                 </div>

                              </div>

                        <?php endforeach; ?>
                     </div>
                  </article>

               <?php endwhile; endif;?>

        </div>
        
        <div class="col-md-3 col-sm-4 col-xs-12">
         
        </div>
  </div>
</div>
<?php get_footer(); ?>