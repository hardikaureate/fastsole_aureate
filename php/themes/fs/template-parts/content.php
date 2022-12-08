<article  <?php post_class();?> >

   <div class="col-md-12 col-sm-12 cat-single-news margin-padding-0 bg-white wow fadeInDown" data-wow-delay="0.3s">

      <div class="col-md-3 col-sm-6 col-xs-12 padding-left-0 article_image_wrapper">

         <div class="image_border">

            <div class="article_image">

               <a href="<?php the_permalink(); ?>">

                  <?php the_post_thumbnail('full', array('class' => 'img-responsive'));?>   

               </a>

            </div>

         </div>

         <!-- <div class="cat-news-date">

            <p><?php // echo get_the_date( 'd M' ); ?></p>

         </div> -->

         

      </div>

      <div class="col-md-9 col-sm-6 col-xs-12 padding-right-0 cat-news-body">

         <div class="news-heading">

            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

         </div>

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

            <?php wp_is_mobile() ? archive_excerpt(20) : archive_excerpt(70) ;?>

         </div>

                  

      </div>

   </div>

</article>