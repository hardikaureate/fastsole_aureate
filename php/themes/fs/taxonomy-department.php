<?php
   /**

    * The main index template file.

    *

    * @package solefashion

    */
   global $fastsole;

   get_header();

   $search = new WP_Advanced_Search('my-form');

   ?>
<script>
   jQuery(document).ready(function() {
    /*var url = window.location.href;
    if(url =='http://fastsole.nexenitlabs.com/sneaker/'){
      window.location.replace('http://fastsole.nexenitlabs.com/sneaker/#results');
      location.reload();
    }*/
    // jQuery("#wp-advanced-search").submit();
   });
</script>
<?php
   $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

   $archive_title = esc_html( $term->name );

   $archive_slug  = $term->slug;

   ?>
<?php if ( !empty( $fastsole[$archive_slug.'-archive-slider'] ) ) :
   $slides = $fastsole[$archive_slug.'-archive-slider'];?>
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div class="release-slider">
            <div class="nivoSlider" id="release-slider">
               <?php foreach ($slides as $slide) { ?>
               <a href="<?php echo esc_url( $slide['url'] );?>"><img src="<?php echo $slide['image'];?>" class="img-responsive" alt="<?php echo $slide['title'];?>"></a>
               <?php } ?>
            </div>
         </div>
      </div>
   </div>
</div>
<?php endif; ?>
<!-- filter button section -->
<div class="clearfix filter-button-container visible-xs visible-sm" role="group" aria-label="Justified button group">
   <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
      <a href="javascript:void(0)" class="btn btn-lg btn-flat" role="button" data-toggle="modal" data-target="#sort-modal"><i class="fa fa-sort-amount-asc" aria-hidden="true"></i>&nbsp;Sort</a>
      <a href="#" class="btn btn-lg btn-flat" id="filter-trigger" role="button"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;Filters</a>
   </div>
</div>
<!-- end of filter button section -->
<div class="container container-xs-fluid has-filter-container">
   <?php
      get_template_part('template-parts/breadcrumb');
      ?>
   <div class="row bg-white margin-padding-0 wow fadeInDown" data-wow-delay="0.75s">
      <div class="col-md-3 col-sm-12">

         <?php //get_template_part('template-parts/release-filter');?>
         <div class="release-filters archive-page-brand" id="releas-filters">
            <!-- select category addon -->
            <div class="select-category-addon visible-xs visible-sm">
               <div class="alert alert-primary alert-select-category alert-flat">
                  <span id="back-button"><i class="fa fa-long-arrow-left"></i></span>
                  <span id="close-button"><i class="fa fa-close"></i></span>
                  <span id="selected-item">Filters</span>
                  <span id="clear-button" class="disabled pull-right">Clear</span>
               </div>
            </div>
            <div class="filter-products-wrapper">
               <div class="first-layer visible-xs visible-sm">
                  <div class="list-group filterable-options">
                     <a href="#" class="list-group-item" data-item="wpas-tax_status">Stock<i class="fa fa-angle-right pull-right"></i></a>
                     <a href="#" class="list-group-item" data-item="wpas-tax_colour">Color<i class="fa fa-angle-right pull-right"></i></a>
                     <a href="#" class="list-group-item" data-item="wpas-meta__sf_price">Price range<i class="fa fa-angle-right pull-right"></i></a>
                  </div>
               </div>
               <div class="second-layer">
                  <input type="hidden" id="select_texonomy" value="<?php echo trim($archive_slug); ?>" name="select_texonomy" />
                  <?php $search->the_form(); ?>
               </div>
            </div>
            <!-- <div class="hidden-xs hidden-sm">
               <input type="hidden" id="select_texonomy" value="<?php echo trim($archive_slug); ?>" name="select_texonomy" />
               <?php // $search->the_form(); ?>
               </div> -->
         </div>
      </div>
      <div class="col-md-9 col-sm-12 ">
         <?php if( have_posts() ): ?>
         <div class="release-header">
            <h1><?php echo  $fastsole[$archive_slug.'-archive-title'];?><?php _e( ' Releases', 'fastsole' );?></h1>
            <div class="sorting_section hidden-xs hidden-sm">
               <select id="select-sort-by">
                  <option value="">Sort By</option>
                  <option value="price_low_to_high">Price low to high</option>
                  <option value="price_high_to_low">Price high to low</option>
                  <option value="release_date_desc">Order By Release Date(DESC)</option>
               </select>
            </div>
         </div>
         <div class="modal fade" id="sort-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-body clearfix">
                     <div class="release-header">
                        <h1> <?php _e( 'Sort Releases', 'fastsole' ); ?></h1>
                        <div class="sorting_section">
                           <select id="select-sort-by">
                              <option value="">Sort By</option>
                              <option value="price_low_to_high">Price low to high</option>
                              <option value="price_high_to_low">Price high to low</option>
                              <option value="release_date_desc">Order By Release Date(DESC)</option>
                           </select>
                        </div>
                        <button  style="display: none" >Apply filter</button>
                        <input type="hidden" style="display: none" name="action" value="myfilter">
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="border-red hidden-xs hidden-sm"></div>
         <div class="border-gray visible-xs visible-sm"></div>
         <div class="release-body archive">
            <div id="wpas-results" class="customclass">
            </div>
            <?php // result will be added  here by template-ajax-results.php ?>
            <?php while( have_posts() ): the_post(); ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 margin-padding-0 department">
               <?php //get_template_part('template-parts/release-filter');?>
            </div>
            <?php endwhile; ?>
         </div>
         <?php endif; ?>
      </div>
   </div>
</div>
<?php
   //var_dump($fastsole[$archive_slug.'-news-tag']);


   if ( !empty( $fastsole[$archive_slug.'-news-tag'] ) ) :
      $tag = $fastsole[$archive_slug.'-news-tag'];?>
<!-- news section starts -->
<?php
   $args = array(

     'post_type'  => 'post',
     'posts_per_page' =>4,
     'tag_id'  =>  $tag,

   );

   $news = new WP_Query( $args );
   ?>
<?php if( $news-> have_posts() ):?>
<div class="news-section wow fadeInDown" data-wow-delay="0.25s">
   <div class="container">
      <div class="row">
         <div class="col-xs-12 news-header hidden-xs hidden-sm">
            <div class="col-xs-6 news-header-left">
               <h3><i class="fa fa-lightbulb-o" aria-hidden="true"></i> Recent <?php echo  $fastsole[$archive_slug.'-archive-title'];?> News </h3>
            </div>
            <div class="col-xs-6 news-header-right">
               <h4><a href="<?php echo get_tag_link($tag) ;?>"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp; <?php esc_html_e( 'View All', 'fastsole' ); ?></a></h4>
            </div>
         </div>
         <div class="mobile-section-title mobile-news-section-title visible-xs visible-sm">
            <h3>Recent <?php echo  $fastsole[$archive_slug.'-archive-title'];?> News</h3>
            <a href="<?php echo get_tag_link($tag) ;?>"><i class="fa fa-eye" aria-hidden="true"></i> View All</a>
         </div>
      </div>
      <div class="row news">
         <div class="col-md-12 margin-padding-0">
            <?php while( $news-> have_posts() ): $news->the_post(); ?>
            <div class="col-sm-6 single-news margin-padding-0 border-right border-bottom">
               <?php if( has_post_thumbnail() ) : ?>
               <div class="col-md-6 margin-padding-0">
                  <div class="news-img">
                     <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full', array('class' => 'img-responsive'));?></a>
                  </div>
                  <!-- <div class="news-date">
                     <p><?php echo get_the_date( 'd M' ); ?></p>
                     </div> -->
               </div>
               <?php endif; ?>
               <div class="col-md-6 margin-padding-0 news-title ">
                  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
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
                     <?php archive_excerpt(20);?>
                  </div>
               </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
         </div>
      </div>
   </div>
</div>
<?php endif; ?>
<!-- news section ends -->
<?php endif; ?>
<div class="container ">
   <div class="row bg-white margin-padding-0 wow fadeInDown" data-wow-delay="0.75s">
      <div class="col-md-12 ">
         <?php if ( !empty( $fastsole[$archive_slug.'-archive-text'] ) ) :?>
         <div class="archive-text-wrapper">
            <div class="archive-text armore">
               <?php echo $fastsole[$archive_slug.'-archive-text'];?>
            </div>
         </div>
         <?php endif; ?>
      </div>
   </div>
</div>
<!-- apply filters area -->
<div class="filter-button-wrapper visible-xs visible-sm" role="group" aria-label="Justified button group">
   <input id="reset-button" type="button" class="btn button-reset disabled" value="Reset" onClick="window.location.reload()" >
   <button id="apply-filters" type="button" class="btn button-apply disabled">Apply</button>
</div>
<script>
   jQuery(document).ready(function(){
    var category = jQuery('input#select_texonomy').val();
    jQuery('#wpas-tax_department .wpas-tax_department-checkboxes input[type="checkbox"]').prop( "checked", false );
    jQuery('#wpas-tax_department .wpas-tax_department-checkboxes input[value="'+category+'"]').trigger( "click" );

    if( window.innerWidth >= 768 ){

    }else {
      $('#apply-filters').trigger('click');
    }


   });
</script>
<script>
   (function($){
    $(document).ready(function(){
		var inStockCheckbox = $('#wpas-tax_status-checkbox-');
		console.log( 'inStockCheckbox', inStockCheckbox);
		if ( ! inStockCheckbox.is(':checked') ) {
			setTimeout(() => {
				inStockCheckbox.trigger('click');
			}, 1000);
		}

   // filter popup handler
   $('#filter-trigger').click(function( e ){
    e.preventDefault();
    $('#releas-filters').addClass('opened');
    $('body').addClass('filters-modal-opened');
   });

     // filter popup close
     $('#close-button, #apply-filters').click(function( e ){
      e.preventDefault();
      $('#releas-filters').removeClass('opened');
      $('body').removeClass('filters-modal-opened');
      $('#clear-button').addClass('disabled');
      $('.filter-products-wrapper').removeClass('second-layer-active');
     });

     // sorting modal handler
     $('.sorting_section').on('change', 'select', function(){
      $('#apply-filters').trigger('click');
      $('#sort-modal').modal('hide');
     });

     // form reset handler
     $('#clear-button').click(function(){
      $('#wp-advanced-search')[0].reset();
     });

     // filter layers handler
     $('#back-button').hide();

     // check and disabled buttons if any input field not selected
     if( $('#releas-filters').find('input:checked').length == 0 ){
      $('.filter-button-wrapper .btn').addClass('disabled');
     }

     $('.filterable-options a').click(function( e ){
      e.preventDefault();
      var selectedItem = $(this).attr('data-item'),
      SelectedItemsText = $(this).text();
      // handle classes as per user's click
      $('.data-filter-item').removeClass('show');
      $('#'+selectedItem).addClass('show');
      // active second layer
      $('.filter-products-wrapper').addClass('second-layer-active');

      // toggle close and back button
      $('#close-button').hide();
      $('#back-button').show();
      $('.filter-button-wrapper .btn').removeClass('disabled');

      // change textnode as per click
      // console.log(selectedItem);
      $('#selected-item').text(SelectedItemsText);

      // handle clear button
      $('#clear-button').removeClass('disabled');


      $('#back-button').click(function(){

        if( $('#releas-filters').find('input:checked').length == 0 ){
          $('.filter-button-wrapper .btn').addClass('disabled');
        };

        $('.data-filter-item').removeClass('show');
        $('.filter-products-wrapper').removeClass('second-layer-active');
        // toggle close and back button
        $('#close-button').show();
        $('#back-button').hide();
        $('#selected-item').text('Filters');
        $('#clear-button').addClass('disabled');
      });

    });


     // dom manipulation as for responsive veiw
     if( window.innerWidth < 991 ){
      $('.wpas-checkbox-container').each(function(){
        $(this).addClass('list-group-item');
        $(this).addClass('checkbox-inline');
        $(this).append('<i class="fa fa-square-o fa-2x"></i>');
        $(this).append('<i class="fa fa-check-square-o fa-2x"></i>');
        $(this).replaceWith('<label class="list-group-item checkbox-inline">' + $(this).html() +'</label>');

      });
      $('.wpas-radio-container').each(function(){
        $(this).addClass('list-group-item');
        $(this).addClass('checkbox-inline');
        $(this).append('<i class="fa fa-circle-o fa-2x"></i>');
        $(this).append('<i class="fa fa-dot-circle-o fa-2x"></i>');
        var newLabel = $(this).find('label').text();
        $(this).find('label').remove();
        $(this).append('<span>' + newLabel + '</span>');

        $(this).replaceWith('<label class="list-group-item">' + $(this).html() +'</label>');

      });
     }

     // $('.filterable-options a').click(function( e ){
     //   // $('input').off('change');
     // });

     // Soring options
     $('#select-sort-by').change(function(){
      $('input[name="fastsole_sorting"]').val( $(this).val() );
      setTimeout(function(){
        $('#wp-advanced-search').submit();
      }, 50);
     });
   });

    $(document).keyup(function(e) {
   if (e.keyCode === 13) $('#apply-filters').trigger('click');     // enter
   if (e.keyCode === 27) $('#close-button').trigger('click');   // esc
   });
   })(jQuery);
</script>
<?php get_footer(); ?>
