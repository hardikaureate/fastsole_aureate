<?php
   /**
    * The template for displaying Top-Brands section.
    *
    * This is the template that displays Top-Brands section on home page.
    *
    * @package fastsole
    *
    */
   global $fastsole;
   
   if  ( !empty( $fastsole['top_brands_section_title'] ) ):  
   
   $top_brands_section_title =  $fastsole['top_brands_section_title'];
   
    ?> 
<div class="onfocus-slider top-brands-slider wow fadeInDown" data-wow-delay="0.25s">
   <div class="container">
      <div class="row on-focus-slider">
         <div class="col-md-12 onfocus-header">
            <div class="on-focus-header">
               <div class="col-md-2 margin-padding-0">
                  <div class="brand hidden-xs hidden-sm">
                     <img src="<?php echo IMGPATH.'shoe_icon.png'?>" class="img-responsive" alt="">
                     <h3><?php echo $top_brands_section_title; ?></h3>
                  </div>
                  <div class="visible-xs visible-sm">
                     <!-- <img src="<?php echo IMGPATH.'shoe_icon.png'?>" class="img-responsive" alt=""> -->
                     <div class="mobile-section-title">
                        <h3><?php echo $top_brands_section_title; ?></h3>
                     </div>
                  </div>
               </div>
               <div class="col-md-10 on-focus-header-border hidden-xs hidden-sm">
               </div>
            </div>
         </div>
         <div class="container hidden-xs hidden-sm">
            <div class="row">
               <div class="col-md-12">
                  <div class="border-red">
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-12">
            <div class="col-md-12 margin-padding-0">
               <div id="on-focus" class="owl-carousel top_brand">
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
   </div>
</div>
<?php endif; ?>