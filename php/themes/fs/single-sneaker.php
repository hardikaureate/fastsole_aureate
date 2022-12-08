<?php
   /**
    * The single sneaker template file.
    * It is used to display single sneaker page.
    * @package fastsole
    */
      global $fastsole;
   get_header();
   
   ?>
<div class="container">
   <?php get_template_part('template-parts/breadcrumb'); ?>
</div>
<?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>  
<article itemscope itemtype="http://schema.org/Product" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <div class="container wow fadeInDown" data-wow-delay="0.25s">
      <div class="row margin-padding-0">
         <div class="col-xs-12 bg-white margin-padding-0">
            <div class="clearfix" id="row-stickey-product">
               <div id="stickey-product-image" class="col-md-7 col-sm-12">
                  <div class="stickey-product-inner affix-top'" id="product_side_affix">
                     <div class="product-image clearfix">
                        <div id="sneaker-main-info">
                           <div id="amazingslider-wrapper-1" style="display:block;position:relative;max-width:700px;margin:0px auto 107px;">
                              <?php $files = get_post_meta( get_the_ID(), '_sf_images', 1 );?>
                              <div id="amazingslider-1" style="display:block;position:relative;margin:0 auto;">
                                 <ul class="amazingslider-slides" style="display:none;">
                                    <?php
                                       $i = 0;
                                       
                                       foreach ( (array) $files as $attachment_id => $attachment_url ) { 
                                       
                                           $i++;
                                       
                                       	$img_alt = trim(strip_tags( get_post_meta($attachment_id, '_wp_attachment_image_alt', true) ) ); 
                                       
                                       	$img_url_array = wp_get_attachment_image_src($attachment_id, 'product-normal');
                                       
                                       	$img_url = $img_url_array[0];
                                       
                                       	$zoom_img_url_array = wp_get_attachment_image_src($attachment_id, 'product-zoom');
                                       
                                       	$zoom_img_url = $zoom_img_url_array[0];?>
                                    <li><a href="<?php echo $zoom_img_url; ?>" class="html5lightbox"><img <?php if($i==1){echo 'itemprop="image"';}?> src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>" /></a> </li>
                                    <?php } ?>  
                                 </ul>
                                 <ul class="amazingslider-thumbnails" style="display:none;">
                                    <?php
                                       foreach ( (array) $files as $attachment_id => $attachment_url ) { 
                                       
                                       	$img_alt = trim(strip_tags( get_post_meta($attachment_id, '_wp_attachment_image_alt', true) ) ); 
                                       
                                       	$thumb_img_url_array = wp_get_attachment_image_src($attachment_id, 'related-post-thumb');
                                       
                                       	$thumb_img_url = $thumb_img_url_array[0];?>
                                    <li><img src="<?php echo $thumb_img_url; ?>" alt="<?php echo $img_alt; ?>" /></li>
                                    <?php } ?> 
                                 </ul>
                              </div>
                           </div>
                           <?php get_template_part( 'template-parts/sneaker', 'info' ) ?>
                        </div>
                        <div class="wow fadeInDown visible-xs" data-wow-delay="0.25s">
                           <div itemprop="description" class="product-details">
                              <div class="short-text">
                                 <?php echo archive_excerpt(20); ?>
                              </div>
                              <div class="long-text">
                                 <?php the_content(); ?>
                                 <a href="#" class="read-less-btn">&laquo; Read Less</a>
                              </div>
                           </div>
                           <div class="margin-padding-0">
                              <div class="nav-button">
                                 <?php 
                                    $previous_link = get_previous_post_link( '%link' );
                                    $next_link = get_next_post_link( '%link' );
                                    
                                    ?>
                                 <?php if( $previous_link ) :?>
                                 <div class="nav-button-prev">
                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                    <?php echo $previous_link; ?>
                                 </div>
                                 <?php endif; ?>
                                 <?php if( $next_link ) :?>
                                 <div class="nav-button-next">
                                    <?php echo $next_link; ?>
                                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                 </div>
                                 <?php endif; ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-5 col-sm-12">
                  <div class="stocklist-container">
                     <?php get_template_part( 'template-parts/stockist' ); ?>
                  </div>
               </div>
               <div class="col-sm-12 hidden-xs" id="sneaker-description">
                  <div class="wow fadeInDown" data-wow-delay="0.25s">
                     <div itemprop="description" class="product-details">
                        <?php the_content(); ?>
                     </div>
                     <div class="margin-padding-0">
                        <div class="nav-button">
                           <?php 
                              $previous_link = get_previous_post_link( '%link' );
                              $next_link = get_next_post_link( '%link' );
                              
                              ?>
                           <?php if( $previous_link ) :?>
                           <div class="nav-button-prev">
                              <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                              <?php echo $previous_link; ?>
                           </div>
                           <?php endif; ?>
                           <?php if( $next_link ) :?>
                           <div class="nav-button-next">
                              <?php echo $next_link; ?>
                              <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                           </div>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- /.clearfix -->
         </div>
      </div>
      <div class="clearfix"></div>
   </div>
   <div class="container wow fadeInDown" data-wow-delay="0.25s">
      <div class="row margin-padding-0">
         <div class="col-xs-12 bg-white margin-padding-0">
            <div class="clearfix site-bar-height" id="test">
               <div class="col-md-12 col-sm-12 col-xs-12 wow fadeInRight" data-wow-delay="0.25s">
                  <?php get_template_part( 'template-parts/related', 'sneaker' ); ?> 
               </div>
               <!--  /.col-md-6  -->
            </div>
            <!-- /.row -->
         </div>
      </div>
   </div>
   <div class="container wow fadeInDown" data-wow-delay="0.25s">
      <div class="row margin-padding-0">
         <div class="col-xs-12 bg-white margin-padding-0">
            <div class="clearfix site-bar-height" id="test">
               <div class="col-md-12 col-sm-12 col-xs-12 wow fadeInRight" data-wow-delay="0.25s">
                  <div class=" related-product-slider">
                     <div class="related-product-slider-title">
                        <h3>Top Brands</h3>
                        <div class="border-red margin-bottom-15"></div>
                     </div>
                     <div class="related-product-slide">
                        <div class="related-product owl-carousel">
                           <?php if ( !empty( $fastsole['top-brands'] ) ) :
                              $top_brands = $fastsole['top-brands'];  ?>
                           <?php foreach ($top_brands as $brand) { ?>
                           <article <?php post_class();?> >
                              <div class="single-sneaker jj ">
                                 <div class="ih-item square colored effect6 bottom_to_top">
                                    <a href="<?php echo esc_url( $brand['url'] );?>">
                                       <div class="img">
                                          <img src="<?php echo $brand['image'];?>" class="lazyOwl img-responsive" alt="<?php echo esc_html(  $brand['title'] );?>">
                                       </div>
                                    </a>
                                 </div>
                                 <div class="sneaker-info">
                                    <div class="sneaker-title">
                                       <h2> <a href="<?php echo esc_url( $brand['url'] );?>"> <?php echo esc_html(  $brand['title'] );?> </a>  </h2>
                                    </div>
                                 </div>
                              </div>
                           </article>
                           <?php } ?>
                           <?php endif; ?>                      
                        </div>
                     </div>
                  </div>
               </div>
               <!--  /.col-md-6  -->
            </div>
            <!-- /.row -->
         </div>
      </div>
   </div>
</article>
<?php endwhile; endif;?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/rAF.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/ResizeSensor.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/sticky-sidebar.js"></script>
<?php get_footer(); ?>