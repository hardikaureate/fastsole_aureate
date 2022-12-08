<?php
   /**
    * The template for displaying single news.
    *
    * @package fastsole
    */
   get_header();
   global $fastsole;
   ?>
<div class="container">
   <?php get_template_part('template-parts/breadcrumb'); ?>    	
   <div class="row bg-white margin-padding-0 wow fadeInDown" data-wow-delay="0.25s">
      <div class="news-content col-md-8 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-delay="0.25s">
         <?php if ( have_posts() ): while ( have_posts() ): the_post();?>
         <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="news-content-heading">
               <h1 class="entry-title"><?php the_title(); ?></h1>
            </div>
            <div class="news-content-info">
               <div class="content-cat">
                  <p>
                     <i class="fa fa-calendar"></i>&nbsp;
                     <?php 
                        $archive_year  = get_the_time('Y'); 
                        $archive_month = get_the_time('m'); 
                        $archive_day   = get_the_time('d'); 
                        ?>
                     <a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( 'd M Y' ); ?></a>
                     &nbsp; &nbsp; <i class="fa fa-folder-open"></i> <?php the_category(' , '); ?>
                     <?php
                        if( has_tag() ){
                        	?>
                     &nbsp; &nbsp; <i class="fa fa-tags" aria-hidden="true"></i><?php the_tags(' ');?>
                     <?php
                        }
                        ?>
                  </p>
               </div>
            </div>
            <div class="news-content-body">
               <?php the_content(); ?>
            </div>
         </article>
         <?php endwhile; endif;?>
      </div>
      <div class="news-sidebar col-md-4 col-sm-12 col-xs-12 wow fadeInRight" data-wow-delay="0.25s">
         <?php get_template_part( 'template-parts/recent', 'news' ) ;?>
      </div>
   </div>
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
<?php get_footer(); ?>