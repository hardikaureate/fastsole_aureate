<?php
   /**

    * The main index template file.

    *

    * @package fastsole

    */

   //global $fastsole;
   //global $wp_query;
   get_header(); ?>
<script>
   jQuery(document).ready(function() {
       /*var url = window.location.href;
       if(url =='http://fastsole.nexenitlabs.com/sneaker/'){
           window.location.replace('http://fastsole.nexenitlabs.com/sneaker/#results');
           location.reload();
       }*/
       jQuery("#wp-advanced-search").submit();



   });
</script>
<?php
   if ( !empty( $fastsole['sneaker-archive-slider'] ) ) :
       $slides = $fastsole['sneaker-archive-slider'];
       ?>
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
   <?PHP get_template_part('template-parts/breadcrumb');
      //$search = new WP_Advanced_Search('my-form');
      ?>
   <div class="row bg-white margin-padding-0 wow fadeInDown newrelativeforloader" data-wow-delay="0.75s">
      <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
         <div class="col-md-3 col-sm-12">
            <div class="release-filters" id="releas-filters">
               <!-- select category addon -->
               <div class="select-category-addon visible-xs visible-sm">
                  <div class="alert alert-primary alert-select-category alert-flat">
                     <span id="back-button"><i class="fa fa-long-arrow-left"></i></span>
                     <span id="close-button"><i class="fa fa-close"></i></span>
                     <span id="selected-item">Filters</span>
                     <span id="clear-button" class="disabled pull-right">Clear</span>
                  </div>
               </div>
               <!-- filter products section -->
               <div class="filter-products-wrapper visible-xs visible-sm">
                  <div class="first-layer">
                     <div class="list-group filterable-options">
                        <!-- <a href="#" class="list-group-item" data-item="release-calender">Release Calendar <i class="fa fa-angle-right pull-right"></i></a> -->
                        <a href="#" class="list-group-item" data-item="stock">Stock<i class="fa fa-angle-right pull-right"></i></a>
                        <a href="#" class="list-group-item" data-item="band">Brand<i class="fa fa-angle-right pull-right"></i></a>
                        <a href="#" class="list-group-item" data-item="color">Color<i class="fa fa-angle-right pull-right"></i></a>
                        <a href="#" class="list-group-item" data-item="price-range">Price range<i class="fa fa-angle-right pull-right"></i></a>
                     </div>
                  </div>
                  <div class="second-layer">
                     <div id="release-calender" class="data-filter-item">
                        <div class="release-calender-addon">
                           <i class="fa fa-calendar glyphicon glyphicon-calendar"></i>
                           <input type="text" name="daterange" value="" placeholder="Click to pick date" id="daterangecheckid2"/>
                        </div>
                        <!-- <a href="#" id="daterangeclear">clear</a>-->
                        <input type="button" value="Clear" id="daterangeclear2">
                     </div>
                     <div id="stock" class="data-filter-item">
                        <?php
                           if( $terms = get_terms( 'status', 'orderby=name&hide_empty=1' ) ) : // to make it simple I use default categories
                               echo '<ul class="left_sidebar_field list-group">';
                               foreach ( $terms as $term ) :
                                   //echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
                                   // print_r($term);

                                   if($term->slug=='coming-soon'){
                                       echo  '<li><label class="checkbox-inline list-group-item"><input type="checkbox" name="categoryfilter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>'.$term->name."</span></label></li>";

                                   }
                                   if($term->slug=='in-stock'){
                                       echo  '<li><label class="checkbox-inline list-group-item"><input type="checkbox" name="categoryfilter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>'.$term->name."</span></label></li>";

                                   }
                                   if($term->slug=='sold-out'){
                                       echo  '<li><label class="checkbox-inline list-group-item"><input type="checkbox" name="categoryfilter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>'.$term->name."</span></label></li>";

                                   }
                               endforeach;
                               echo '</ul>';
                           endif;
                           ?>
                     </div>
                     <div id="band" class="data-filter-item">
                        <?php
                           if( $terms = get_terms( 'department', 'orderby=name&hide_empty=1' ) ) : // to make it simple I use default categories
                               echo '<ul class="left_sidebar_field list-group department_fields">';
                               foreach ( $terms as $term ) :


                                   //echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option

                                  if($term->slug=='nike') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" />
                           <i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i>
                           <span>Nike</span>
                                            </label>
                                        </li>';
                                   }
                                   if($term->slug=='air-max') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" />
                                                <i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i>
                           <span>Air Max</span>
                                            </label>
                                        </li>';
                                   }
                                    if($term->slug=='nike-jordan') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" />
                                                <i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i>
                           <span>Nike Jordan</span>
                                            </label>
                                        </li>';
                                   }

                                   if($term->slug=='adidas') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" />
                           <i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i>
                                                <span>Adidas</span>
                                            </label>
                                        </li>';
                                   }

                                   if($term->slug=='nmd') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" />
                           <i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i>
                                                <span>NMD</span>
                                            </label>
                                        </li>';
                                   }

                                   if($term->slug=='eqt') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" />
                           <i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i>
                                                <span>EQT</span>
                                            </label>
                                        </li>';
                                   }
                                   if($term->slug=='yeezy') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" />
                           <i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i>
                                                <span>Yeezy</span>
                                            </label>
                                        </li>';
                                   }

                                   if($term->slug=='nikelab') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" />
                           <i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i>
                                                <span>NikeLAB</span>
                                            </label>
                                        </li>';
                                   }
                                   if($term->slug=='asics') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" />
                           <i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i>
                                                <span>ASICS</span>
                                            </label>
                                        </li>';
                                   }
                                   if($term->slug=='puma') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" />
                           <i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i>
                                                <span>Puma</span>
                                            </label>
                                        </li>';
                                   }
                                   if($term->slug=='reebok') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" />
                           <i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i>
                                                <span>Reebok</span>
                                            </label>
                                        </li>';
                                   }
                                    if($term->slug=='saucony') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" />
                           <i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i>
                                                <span>Saucony</span>
                                            </label>
                                        </li>';
                                   }
                                   if($term->slug=='new-balance') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" />
                           <i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i>
                                                <span>New Balance</span>
                                            </label>
                                        </li>';
                                   }
                                    if($term->slug=='converse') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" />
                           <i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i>
                                                <span>Converse</span>
                                            </label>
                                        </li>';
                                   }
                                   if($term->slug=='air-vapormax') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" />
                           <i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i>
                                                <span>VaporMax</span>
                                            </label>
                                        </li>';
                                   }
                                   if($term->slug=='ultra-boost') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" />
                           <i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i>
                                                <span>Ultra Boost</span>
                                            </label>
                                        </li>';
                                   }
                               endforeach;
                               echo '</ul>';
                           endif;
                           ?>
                     </div>
                     <div id="color" class="data-filter-item">
                        <?php
                           if( $terms = get_terms( 'colour', 'orderby=name&hide_empty=1' ) ) : // to make it simple I use default categories
                               echo '<ul class="left_sidebar_field list-group">';
                               foreach ( $terms as $term ) :
                                   //echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
                                   if($term->slug=='black') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_color_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>' . $term->name . "</span>
                                            </label>
                                        </li>";
                                   }
                                   if($term->slug=='white') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_color_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>' . $term->name . "</span>
                                            </label>
                                        </li>";
                                   }
                                   if($term->slug=='blue') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_color_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>' . $term->name . "</span>
                                            </label>
                                        </li>";
                                   }
                                   if($term->slug=='multicolour') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_color_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>' . $term->name . "</span>
                                            </label>
                                        </li>";
                                   }
                                   if($term->slug=='navy') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_color_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>' . $term->name . "</span>
                                            </label>
                                        </li>";
                                   }
                                   if($term->slug=='grey') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_color_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>' . $term->name . "</span>
                                            </label>
                                        </li>";
                                   }
                                   if($term->slug=='green') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_color_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>' . $term->name . "</span>
                                            </label>
                                        </li>";
                                   }
                                   if($term->slug=='red') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_color_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>' . $term->name . "</span>
                                            </label>
                                        </li>";
                                   }
                                   if($term->slug=='pink') {
                                       echo '<li>
                                            <label class="checkbox-inline list-group-item">
                                                <input type="checkbox" name="category_color_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>' . $term->name . "</span>
                                            </label>
                                        </li>";
                                   }
                               endforeach;
                               echo '</ul>';
                           endif;
                           ?>
                     </div>
                     <div id="price-range" class="data-filter-item">
                        <ul class="left_sidebar_field list-group">
                           <li>
                              <label class="list-group-item">
                              <input type="radio" name="sf_price_range" value="sf_price_range1" />
                              <i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i> <span>Below £50 </span>
                              </label>
                           </li>
                           <li>
                              <label class="list-group-item">
                              <input type="radio" name="sf_price_range" value="sf_price_range2" />
                              <i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i> <span>£50-£99 </span>
                              </label>
                           </li>
                           <li>
                              <label class="list-group-item">
                              <input type="radio" name="sf_price_range" value="sf_price_range3" />
                              <i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i> <span>£100-£149 </span>
                              </label>
                           </li>
                           <li>
                              <label class="list-group-item">
                              <input type="radio" name="sf_price_range" value="sf_price_range4" />
                              <i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i> <span>£150-£200</span>
                              </label>
                           </li>
                           <li>
                              <label class="list-group-item">
                              <input type="radio" name="sf_price_range" value="sf_price_range5" />
                              <i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i> <span>Above £200 </span>
                              </label>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <!-- end filter products section -->
               <!--ss---->
               <div class="panel-group hidden-xs hidden-sm" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default release-calender-panel">
                     <div class="panel-heading" role="tab" id="headingOned">
                        <h4 class="panel-title">
                           <a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOned" aria-expanded="false" aria-controls="collapseOned">
                           Release Calendar
                           </a>
                        </h4>
                     </div>
                     <div id="collapseOned" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOned">
                        <div class="panel-body calenderIcon">
                           <!-- <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">-->
                           <!-- <input type="checkbox" name="daterange" value="" id="daterangecheckid"/> <span id="chagetext">Date Range</span>-->
                           <i class="fa fa-calendar glyphicon glyphicon-calendar"></i>
                           <input type="text" name="daterange" value="" id="daterangecheckid"/>
                           <!-- <a href="#" id="daterangeclear">clear</a>-->
                           <input type="button" value="Clear" id="daterangeclear">
                           <!--</div>-->
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                           <a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                           Stock
                           </a>
                        </h4>
                     </div>
                     <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                           <?php
                              if( $terms = get_terms( 'status', 'orderby=name&hide_empty=1' ) ) : // to make it simple I use default categories
                                  echo '<ul class="list-group">';
                                  foreach ( $terms as $term ) :
                                      //echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
                                      // print_r($term);
                                      // <label class="checkbox-inline list-group-item">
                                      //             <input type="checkbox" name="category_color_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>' . $term->name . "</span>
                                      //         </label>

                                      if($term->slug=='coming-soon'){
                                          echo  '<li class="list-group-item"><label class="checkbox-inline "><input type="checkbox" name="categoryfilter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>'.$term->name."</span></label></li>";

                                      }
                                      if($term->slug=='in-stock'){
                                          echo  '<li class="list-group-item"><label class="checkbox-inline "><input type="checkbox" name="categoryfilter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>'.$term->name."</span></label></li>";
                                      }
                                      if($term->slug=='sold-out'){
                                         echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="categoryfilter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>'.$term->name."</span></label></li>";
                                      }
                                  endforeach;
                                  echo '</ul>';
                              endif;
                              ?>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                           <a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                           Brand
                           </a>
                        </h4>
                     </div>
                     <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                           <?php
                              if( $terms = get_terms( 'department', 'orderby=name&hide_empty=1' ) ) : // to make it simple I use default categories
                                  echo '<ul class="list-group">';
                                  foreach ( $terms as $term ) :


                                      //echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option

                                     if($term->slug=='nike') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>Nike</span></label></li>';
                                      }
                                      if($term->slug=='air-max') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>Air Max</span></label></li>';
                                      }
                                       if($term->slug=='nike-jordan') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>Nike Jordan</span></label></li>';
                                      }

                                      if($term->slug=='adidas') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>Adidas</span></label></li>';
                                      }

                                      if($term->slug=='nmd') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>NMD</span></label></li>';
                                      }

                                      if($term->slug=='eqt') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>EQT</span></label></li>';
                                      }
                                      if($term->slug=='yeezy') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>Yeezy</span></label></li>';
                                      }

                                      if($term->slug=='nikelab') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>NikeLAB</span></label></li>';
                                      }
                                      if($term->slug=='asics') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>ASICS</span></label></li>';
                                      }
                                      if($term->slug=='puma') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>Puma</span></label></li>';
                                      }
                                      if($term->slug=='reebok') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>Reebook</span></label></li>';
                                      }
                                       if($term->slug=='saucony') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>Soucony</span></label></li>';
                                      }
                                      if($term->slug=='new-balance') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>New Balance</span></label></li>';
                                      }
                                       if($term->slug=='converse') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>Converse</span></label></li>';
                                      }
                                      if($term->slug=='air-vapormax') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>Air Vapormax</span></label></li>';
                                      }
                                      if($term->slug=='ultra-boost') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_department_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>Ultra Boost</span></label></li>';
                                      }
                                  endforeach;
                                  echo '</ul>';
                              endif;
                              ?>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                           <a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                           Color
                           </a>
                        </h4>
                     </div>
                     <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                           <?php
                              if( $terms = get_terms( 'colour', 'orderby=name&hide_empty=1' ) ) : // to make it simple I use default categories
                                  echo '<ul class="list-group">';
                                  foreach ( $terms as $term ) :
                                      //echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
                                      if($term->slug=='black') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_color_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>'. $term->name .'</span></label></li>';
                                      }
                                      if($term->slug=='white') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_color_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>'. $term->name .'</span></label></li>';
                                      }
                                      if($term->slug=='blue') {
                                         echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_color_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>'. $term->name .'</span></label></li>';
                                      }
                                      if($term->slug=='multicolour') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_color_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>'. $term->name .'</span></label></li>';
                                      }
                                      if($term->slug=='navy') {
                                         echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_color_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>'. $term->name .'</span></label></li>';
                                      }
                                      if($term->slug=='grey') {
                                         echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_color_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>'. $term->name .'</span></label></li>';
                                      }
                                      if($term->slug=='green') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_color_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>'. $term->name .'</span></label></li>';
                                      }
                                      if($term->slug=='red') {
                                         echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_color_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>'. $term->name .'</span></label></li>';
                                      }
                                      if($term->slug=='pink') {
                                          echo  '<li class="list-group-item"><label class="checkbox-inline"><input type="checkbox" name="category_color_filter[]" value="' . $term->term_id . '" /><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>'. $term->name .'</span></label></li>';
                                      }
                                  endforeach;
                                  echo '</ul>';
                              endif;
                              ?>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="headingFour">
                        <h4 class="panel-title">
                           <a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                           Price range
                           </a>
                        </h4>
                     </div>
                     <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                        <div class="panel-body">
                           <ul class="list-group">
                              <li class="list-group-item">
                                 <label class="checkbox-inline radio">
                                 <input type="radio" name="sf_price_range" value="sf_price_range1" />
                                 <i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i> <span>Below £50 </span>
                                 </label>
                              </li>
                              <li class="list-group-item">
                                 <label class="checkbox-inline radio">
                                 <input type="radio" name="sf_price_range" value="sf_price_range2" />
                                 <i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i> <span>£50-£99 </span>
                                 </label>
                              </li>
                              <li class="list-group-item">
                                 <label class="checkbox-inline radio">
                                 <input type="radio" name="sf_price_range" value="sf_price_range3" />
                                 <i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i> <span>£100-£149 </span>
                                 </label>
                              </li>
                              <li class="list-group-item">
                                 <label class="checkbox-inline radio">
                                 <input type="radio" name="sf_price_range" value="sf_price_range4" />
                                 <i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i> <span>£150-£200 </span>
                                 </label>
                              </li>
                              <li class="list-group-item">
                                 <label class="checkbox-inline radio">
                                 <input type="radio" name="sf_price_range" value="sf_price_range5" />
                                 <i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i> <span>Above £200 </span>
                                 </label>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <!--ss---->
               <input type="button" class="reset_button hidden-xs hidden-sm" value="Reset" onClick="window.location.reload()" />
            </div>
         </div>
         <!-- apply filters area -->
         <div class="filter-button-wrapper visible-xs visible-sm" role="group" aria-label="Justified button group">
            <input id="reset-button" type="button" class="btn button-reset" value="Reset"  onClick="window.location.reload()">
            <button id="apply-filters" type="button" class="btn button-apply">Apply</button>
         </div>
         <div class="col-md-9 col-sm-12 asaSa ">
            <div class="modal fade" id="sort-modal" tabindex="-1" role="dialog">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-body clearfix">
                        <div class="release-header">
                           <h1> <?php _e( 'Sneaker Release Dates', 'fastsole' ); ?></h1>
                           <div class="sorting_section">
                              <select name="sf_price1">
                                 <option value="" disabled selected hidden>Sort By</option>
                                 <option value="ASC">Price low to high</option>
                                 <option value="DESC">Price high to low</option>
                                 <option value="date_desc">Order By Release Date(DESC)</option>
                                 <option value="release_week">Release this week</option>
                              </select>
                           </div>
                           <button  style="display: none" >Apply filter</button>
                           <input type="hidden" style="display: none" name="action" value="myfilter">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="release-header">
               <h1> <?php _e( 'Sneaker Release Dates', 'fastsole' ); ?></h1>
               <div class="sorting_section hidden-xs hidden-sm">
                  <select name="sf_price1">
                     <option value="" disabled selected hidden>Sort By</option>
                     <option value="ASC">Price low to high</option>
                     <option value="DESC">Price high to low</option>
                     <option value="date_desc">Order By Release Date(DESC)</option>
                     <option value="release_week">Release this week</option>
                  </select>
               </div>
               <button  style="display: none" >Apply filter</button>
               <input type="hidden" style="display: none" name="action" value="myfilter">
            </div>
            <div class="border-gray visible-xs visible-sm"></div>
            <div class="border-red hidden-xs hidden-sm"></div>
            <div class="release-body">
               <div id="response">
                  <?php
                     $args= array(
                         'post_type' => 'sneaker',
                         'post_status' => 'publish',
						 'posts_per_page' => 28,
						 'tax_query' => array(
							array(
							  'taxonomy' => 'status',
							  'field' => 'slug',
							  'terms' => 'in-stock',
							  'operator' => 'IN'
							)
						  )
                     );

                     query_posts( $args );

                     global $wp_query;

                     if( have_posts() ) :

                         ob_start(); // start buffering because we do not need to print the posts now

                         while( have_posts() ): the_post();

                             echo " <div class=\"col-lg-3 col-md-4 col-sm-6 col-xs-6 margin-padding-0 testdata wow fadeInDown\" data-wow-delay=\"0.3s\">";
                             get_template_part( 'template-parts/content', 'sneaker' ) ;
                             echo " </div>";
                         endwhile;

                         echo "<div class=\"morepost\">";
                         if (  $wp_query->max_num_pages > 1 ) :
                             echo '<div id=\'btnn\' onclick=\'UpdateStatus()\'>Load more</div>';
                         endif;
                         echo "<div id=\"wait\">";
                         echo '<img src="'.get_template_directory_uri().'/wp-advanced-search/img/loading.gif" alt="loading-gif" />';                                       echo "</div>";
                         echo "</div>";


                     endif;
                     ?>
               </div>
               <div id="wait2">
                  <img src="<?php echo get_template_directory_uri(); ?>/wp-advanced-search/img/loading.gif" alt="loading-gif" />
               </div>
            </div>
            <div class="archive-text-wrapper">
               <?php if ( !empty( $fastsole['sneaker-archive-text'] ) ) :?>
               <div class="archive-text armore">
                  <?php echo $fastsole['sneaker-archive-text'];?>
               </div>
               <?php endif; ?>
            </div>
         </div>
         <div id="wait2d">
            <img src="<?php echo get_template_directory_uri(); ?>/wp-advanced-search/img/loading.gif" alt="loading-gif" />
         </div>
      </form>
   </div>
</div>
<script>
   (function($){
    $(document).ready(function(){
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
        });

        // sorting modal handler
        $('.sorting_section').on('change', 'select', function(){
            $('#apply-filters').trigger('click');
            $('#sort-modal').modal('hide');
        });

        // form reset handler
        $('#clear-button').click(function(){
            $('#filter')[0].reset();
        });

        // daterange clear
        $('#daterangeclear2').click(function(){
            $('#daterangecheckid2').val('');
        });

        // filter layers handler
        $('#back-button').hide();

        // check and disabled buttons if any input field not selected
        if( $('#releas-filters').find('input:checked').length == 0 && $('#daterangecheckid2').val() == '' ){
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

                if( $('#releas-filters').find('input:checked').length == 0 && $('#daterangecheckid2').val() == '' ){
                    $('.filter-button-wrapper .btn').addClass('disabled');
                }

                $('.data-filter-item').removeClass('show');
                $('.filter-products-wrapper').removeClass('second-layer-active');
                // toggle close and back button
                $('#close-button').show();
                $('#back-button').hide();
                $('#selected-item').text('Filters');
                $('#clear-button').addClass('disabled');
            });

        });

    });

    $(document).keyup(function(e) {
      if (e.keyCode === 13) $('#apply-filters').trigger('click');     // enter
      if (e.keyCode === 27) $('#close-button').trigger('click');   // esc
    });
   })(jQuery);
</script>
<?php get_footer(); ?>
