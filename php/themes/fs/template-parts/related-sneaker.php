<?php
/**
 * The template for displaying releases section.
 *
 * This is the template that displays releases section on home page.
 *
 * @package fastsole
 *
 */
global $fastsole;

if ( isset( $fastsole['related_product_title'] , $fastsole['related_product_categories'] ,$fastsole['related_product_numbers'] ) ) {

 
     $fifth_status_title = $fastsole['related_product_title'];
     $fifth_status_id = $fastsole['related_product_categories'];
    
     $fifth_number_of_products = $fastsole['related_product_numbers'];
  
}
            wp_reset_postdata();
            $currentID = get_the_ID();

                   $args = array(
                      'post_type'  => 'sneaker',
                      
                      'tax_query' => array(

                        array(
                          'taxonomy'         => 'status',
                          'field'            => 'id',
                          'terms'            => $fifth_status_id,
                        )

                      ),
                      
                      'posts_per_page' => $fifth_number_of_products,
                      'post__not_in' => array($currentID)


                   );

                  $qr = new WP_Query( $args );
                ?>

                


<?php if( $qr-> have_posts() ): ?>
<div class=" related-product-slider">
    <div class="related-product-slider-title">
      <h3>
        <?php
         if( isset( $fifth_status_title ) ){
          echo esc_html( $fifth_status_title );
         } 
          ?>
      </h3>
      <div class="border-red margin-bottom-15"></div>
    </div>
    
    <div class="related-product-slide">
      <div class="related-product owl-carousel">

        <?php  while( $qr-> have_posts() ): $qr-> the_post();?>
          <?php get_template_part( 'template-parts/content', 'sneaker' ); ?>
      <?php endwhile; wp_reset_postdata();?>                             
                                    
    </div>
  </div>
</div>
<?php endif; ?>