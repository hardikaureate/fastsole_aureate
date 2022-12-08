<?php

/**

 * fastsole functions and definitions.

 *

 * @package fastsole

 */



/**********************************************************************/
//Defining Constant
/**********************************************************************/



define('CSSPATH', get_stylesheet_directory_uri() . '/css/');

define('JSPATH', get_stylesheet_directory_uri() . '/js/');

define('IMGPATH', get_stylesheet_directory_uri() . '/img/');

/*********************************************************************/
//GD Usage
/*********************************************************************/

function wpb_image_editor_default_to_gd($editors)
{
    $gd_editor = 'WP_Image_Editor_GD';
    $editors = array_diff($editors, array($gd_editor));
    array_unshift($editors, $gd_editor);
    return $editors;
}
add_filter('wp_image_editors', 'wpb_image_editor_default_to_gd');

/**********************************************************************/
//Enqueue Script
/**********************************************************************/

function fastsole_scripts()
{




    //sunil start date picker
    wp_enqueue_script('jqueryy', 'http://cdn.jsdelivr.net/jquery/1/jquery.min.js');

    // wp_enqueue_script('nivo-slider' , 'http://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js', '' , '' , true);
    //sunil end date picker



    wp_enqueue_script('initslider', JSPATH . 'initslider-1.js');

    wp_enqueue_script('plugins', JSPATH . 'plugins.js', array('jquery'), '', true);



    wp_enqueue_script('main', JSPATH . 'main.js?v=2', '', '', true);



    wp_enqueue_style('plugins', CSSPATH . 'plugins.min.css');

    wp_enqueue_style('main', CSSPATH . 'main.css?v=2');

    wp_enqueue_style('responsive', CSSPATH . 'responsive.css?v=2');

    wp_enqueue_style('main-styleheet', get_stylesheet_uri());
}



add_action('wp_enqueue_scripts', 'fastsole_scripts');


if (!function_exists('solefashion_setup')) :

    /**

     * Sets up theme defaults and registers support for various WordPress features.

     *

     */

    function fastsole_setup()
    {

        /*

     * Make theme available for translation.

     */

        load_theme_textdomain('fastsole', get_template_directory() . '/languages');



        // Add default posts and comments RSS feed links to head.

        add_theme_support('automatic-feed-links');



        /*

     * Let WordPress manage the document title.

     */

        add_theme_support('title-tag');



        /*

     * Enable support for Post Thumbnails on posts and pages.

     *

     */

        add_theme_support('post-thumbnails', array('post', 'page', 'sneaker', 'affilate', 'deal'));



        add_image_size('post-thumb', 350, 220, true);

        add_image_size('news-thumb', 440, 327, true);

        add_image_size('news-small-thumb', 370, 240, true);


        // This theme uses wp_nav_menu() two two location.

        register_nav_menus(array(

            'primary' => esc_html__('Primary Menu', 'fastsole'),

            'brand-menu' => esc_html__('Brand Menu', 'fastsole'),

        ));



        /*

     * Switch default core markup for search form, comment form, and comments

     * to output valid HTML5.

     */

        add_theme_support('html5', array(

            'search-form',

            'comment-form',

            'comment-list',

            'gallery',

            'caption',

        ));
    }

endif; // fastsole_setup



add_action('after_setup_theme', 'fastsole_setup');



/**********************************************************************/
//Register widget area.
/**********************************************************************/

function fastsole_widgets_init()
{



    register_sidebar(array(

        'name'          => esc_html__('Home Sneakers Slider Widget', 'fastsole'),

        'id'            => 'home-sneakers-slider',

        'description'   => esc_html__('Home Sneakers Slider Widget Area, Drag Custom FS Sneakers Widget Here', 'fastsole'),

        'before_widget' => '',

        'before_title'  => '',

        'after_title'   => '',

    ));



    register_sidebar(array(

        'name'          => esc_html__('Footer Widget', 'fastsole'),

        'id'            => 'footer-widget',

        'description'   => esc_html__('Footer Widget Area', 'fastsole'),

        'before_widget' => '<div class="col-md-3 col-sm-3 col-xs-6">',

        'after_widget'  => '</div>',

        'before_title'  => '<h2>',

        'after_title'   => '</h2>',

    ));
}



add_action('widgets_init', 'fastsole_widgets_init');


/******************************************************/
// limit_to_three_tags
/*****************************************************/

add_filter('term_links-post_tag', 'limit_to_three_tags');

function limit_to_three_tags($terms)
{

    return array_slice($terms, 0, 3, true);
}


/******************************************************/
// Custom Read More.
/*****************************************************/

function excerpt($num)
{

    global $post;

    $limit = $num + 1;

    $excerpt = explode(' ', get_the_excerpt(), $limit);

    array_pop($excerpt);

    $excerpt = implode(" ", $excerpt) . "<div class='read-more'><p> <a href='" . get_permalink($post->ID) . " '>Read more</a></p></div>";

    echo $excerpt;
}



function archive_excerpt($num)
{

    global $post;

    $limit = $num + 1;

    $excerpt = explode(' ', get_the_excerpt(), $limit);

    array_pop($excerpt);

    $excerpt = (!empty($excerpt) ? implode(" ", $excerpt) . "...<a class='read-more-btn' href='" . get_permalink() . "'>Read More</a>" : '');

    // $excerpt = implode(" ",$excerpt);

    echo $excerpt;
}


/******************************************************/
//pagination Function
/******************************************************/

function fastsole_pagination($query = null)
{



    global $wp_query;

    $query = $query ? $query : $wp_query;

    $big = 999999999;



    $paginate = paginate_links(
        array(

            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),

            'type' => 'array',

            'total' => $query->max_num_pages,

            'format' => '?paged=%#%',

            'current' => max(1, get_query_var('paged')),

            'prev_text' => __('&laquo;'),

            'next_text' => __('&raquo;'),

        )

    );



    if ($query->max_num_pages > 1) :

?>



        <ul class="pagination news-pagination">

            <?php

            foreach ($paginate as $page) {

                echo '<li>' . $page . '</li>';
            }

            ?>

        </ul>



    <?php

    endif;
}



function fs_sneaker_pagination($query = null)
{



    global $wp_query;

    $query = $query ? $query : $wp_query;

    $big = 999999999;



    $paginate = paginate_links(
        array(

            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),

            'type' => 'array',

            'total' => $query->max_num_pages,

            'format' => '?paged=%#%',

            'current' => max(1, get_query_var('paged')),

            'prev_text' => __('&laquo;'),

            'next_text' => __('&raquo;'),

        )

    );



    if ($query->max_num_pages > 1) :

    ?>



        <ul class="pagination">

            <?php

            foreach ($paginate as $page) {

                echo '<li>' . $page . '</li>';
            }

            ?>

        </ul>



    <?php

    endif;
}



function pagination_bar($custom_query)
{

    $total_pages = $custom_query->max_num_pages;
    $big = 999999999; // need an unlikely integer

    if ($total_pages > 1) {
        $current_page = max(1, get_query_var('paged'));

        $pages = paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'type' => 'array',
            'format' => '?paged=%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text' => __('&laquo;'),
            'next_text' => __('&raquo;'),
        ));

        return $pages;

    ?>



<?php }
}



/******************************************************/
// alter post per page in sneaker archive
/******************************************************/


function set_posts_per_page_for_sneaker_archive($query)
{

    if (!is_admin() && $query->is_main_query() && is_post_type_archive('sneaker')) {

        $query->set('posts_per_page', '8');
    }

    if (!is_admin() && $query->is_tax('department')) {

        $query->set('posts_per_page', '16');
    }

    if (!is_admin() && $query->is_tax('status')  && !is_singular()) {

        $query->set('posts_per_page', '8');
    }

    if (!is_admin() && $query->is_tax('status', 'in-stock')  && !is_singular()) {

        $query->set('posts_per_page', '15');
    }
}

add_action('pre_get_posts', 'set_posts_per_page_for_sneaker_archive');



/***************************************************************/
// filter search result restricted to sneaker post type
/***************************************************************/

function searchfilter($query)
{



    if ($query->is_search && !is_admin()) {

        $query->set('post_type', array('sneaker'));
    }

    return $query;
}

add_filter('pre_get_posts', 'searchfilter');



/***************************************************************/
// filter next and previous post link with title
/***************************************************************/

function fs_next_post_link($link)
{

    global $post;
    global $post_id;

    $post = get_post($post_id);
    $next_post = get_next_post();
    $title = $next_post->post_title;
    $link = str_replace('rel=', 'title="' . $title . '" rel=', $link);

    return $link;
}
add_filter('next_post_link', 'fs_next_post_link');


function fs_previous_post_link($link)
{

    global $post;
    global $post_id;

    $post = get_post($post_id);
    $previous_post = get_previous_post();
    $title = $previous_post->post_title;
    $link = str_replace('rel=', 'title="' . $title . '" rel=', $link);

    return $link;
}
add_filter('previous_post_link', 'fs_previous_post_link');


/******************************************************************************/
// diseble title rewrite by youst
/*********************************************************************************/

//add_filter( 'wpseo_title', '__return_false' );


/******************************************************/
// FS Required Functions
/******************************************************/

require_once(dirname(__FILE__) . '/inc/fs-required-functions.php');


/******************************************************/
// CMB2 Meta Box
/******************************************************/

require_once(dirname(__FILE__) . '/inc/cmb2/init.php');

require_once(dirname(__FILE__) . '/inc/cmb2/functions.php');


/******************************************************/
// Redux Framework
/******************************************************/

if (!class_exists('ReduxFramework')) {

    require_once(dirname(__FILE__) . '/inc/ReduxCore/framework.php');

    require_once(dirname(__FILE__) . '/inc/sample/config.php');
}


/******************************************************/
// carbon date
/******************************************************/


/*============================Carbon start===================================*/
/*============================Carbon start===================================*/
/*============================Carbon start===================================*/
require_once(dirname(__FILE__) . '/inc/Carbon/Carbon.php');

use Carbon\Carbon;
/*============================Carbon end===================================*/
/*============================Carbon end===================================*/
/*============================Carbon end===================================*/






/******************************************************************************/
//WP Advance Search

/*********************************************************************************/

require_once('wp-advanced-search/wpas.php');

function my_search_form()
{
    $args = array();
    $args['form'] = array(
        'auto_submit' => true,
        'action' => get_home_url() . '/sneaker'
    );


    $args['form']['ajax'] = array(
        'enabled' => true,
        'show_default_results' => false,
        'results_template' => 'template-ajax-results.php', // This file must exist in your theme root
        'button_text' => 'Load More'
    );


    $args['wp_query'] = array(
        'post_type' => 'sneaker',
        'post_status' => 'publish',
        'posts_per_page' => 16
    );


    $args['fields'][] = array(
        'type' => 'taxonomy',
        'taxonomy' => 'status',
        'format' => 'checkbox',
        'label' => '<i class="fa fa-angle-down" aria-hidden="true" onclick="myFunction();" ></i> Stock',
        //'default_all' => true,
        'operator' => 'IN',
        'values' => array(
            'in-stock' => 'In stock',
            'coming-soon' => 'Coming Soon',
            'sold-out' => 'Sold Out',
        ),
    );

    $args['fields'][] = array(
        'type' => 'taxonomy',
        'taxonomy' => 'department',
        'format' => 'checkbox',
        'label' => '<i class="fa fa-angle-down" aria-hidden="true" onclick="myFunction1();" ></i> Brand',
        //'default_all' => true,
        'operator' => 'IN',
        'values' => array(

            'nike'      => 'nike',
            'dunk'      => 'Nike Dunk',
            'blazer'      => 'Nike Blazer',
            'waffle-one'   => 'Waffle One',
            'nike-jordan'  => 'Air Jordan',
            'air-jordan-1' => 'Air Jordan 1',
            'air-jordan-3' => 'Air Jordan 3',
            'nike-air-jordan-4' => 'Air Jordan 4',
            'air-jordan-5' => 'Air Jordan 5',
            'air-jordan-6' => 'Air Jordan 6',
            'air-jordan-11' => 'Air Jordan 11',
            'air-jordan-12' => 'Air Jordan 12',
            'nikelab'   => 'NikeLAB',
            'air-max'       => 'Air Max',
            'air-vapormax'  => 'Air VaporMax',
            'ultra-boost'   => 'Ultra Boost',
            'air-max-270'   => 'Air Max 270',
            'air-max-720'   => 'Air Max 720',
            'air-max-1'     => 'Air Max 1',
            'air-max-90'    => 'Air Max 90',
            'air-max-95'    => 'Air Max 95',
            'air-max-97'    => 'Air Max 97',
            'air-max-98'    => 'Air Max 98',
            'react-element'      => 'React Element',
            'react-element-55'   => 'React Element 55',
            'react-element-87'   => 'React Element 87',
            'air-force-1'   => 'Air Force 1',
            'air-max-plus'  => 'Air Max Plus',
            'air-vapormax-plus' => 'Air Vapormax Plus',
            'air-zoom' => 'Air Zoom',
            'air-foamposite' => 'Air Foamposite',
            'adidas'    => 'adidas',
            'eqt'       => 'EQT',
            'yeezy'     => 'Yeezy',
            'nmd'       => 'NMD',
            'continental-80' => 'Continental 80',
            'yeezy-boost-500' => 'Yeezy Boost 500',
            'yeezy-boost-700' => 'Yeezy Boost 700',
            'yeezy-boost-350' => 'Yeezy Boost 350',
            'yeezy-slides' => 'Yeezy Slides',
            'nite-jogger'   => 'Nite Jogger',
            'stan-smith'    => 'Stan Smith',
            'yung-1'        => 'Yung 1',
            'yung-96'       => 'Yung 96',
            'converse'      => 'Converse',
            'one-star'      => 'One Star',
            'all-star'      => 'All Star',
            'saucony'       => 'Saucony',
            'vans'          => 'Vans',
            'asics'         => 'Asics',
            'puma'          => 'Puma',
            'reebok'        => 'Reebok',
            'new-balance'   => 'New Balance',

        ),
    );

    $args['fields'][] = array(
        'type' => 'taxonomy',
        'taxonomy' => 'colour',
        'format' => 'checkbox',
        'label' => '<i class="fa fa-angle-down" aria-hidden="true" onclick="myFunction2();" ></i> Colour',
        //'default_all' => true,
        'operator' => 'IN',
        'values' => array(
            'black' => 'Black',
            'white' => 'White',
            'blue' => 'Blue',
            'multicolour' => 'Multicolour',
            'navy' => 'Navy',
            'grey' => 'Grey',
            'green' => 'Green',
            'red' => 'Red',
            'pink' => 'Pink',
        ),

    );

    $args['fields'][] = array(
        'type' => 'meta_key',

        'meta_key' => '_sf_price',
        'format' => 'radio',
        'label' => '<i class="fa fa-angle-down" aria-hidden="true" onclick="myFunction3();" ></i> Price',
        'data_type' => 'NUMERIC',
        'values' => array(
            ':49' => 'Below £50',
            '50:99' => '£50-£99 ',
            '100:149' => '£100-£149 ',
            '150:200' => '£150-£200 ',
            '200:' => 'Above £200 ',
        ),
        'compare' => 'BETWEEN',
    );

    $args['fields'][] = array(
        'type' => 'reset',
        'class' => 'button',
        'value' => 'Reset'
    );

    register_wpas_form('my-form', $args);
}

add_action('init', 'my_search_form');







/*============================loadmorejs start===================================*/
/*============================loadmorejs start===================================*/
/*============================loadmorejs start===================================*/


function misha_my_load_more_scripts()
{
    global $wp_query;

    $query_vars = $wp_query->query_vars;
    $query_vars['tax_query'] = array(
        array(
            'taxonomy' => 'status',
            'field' => 'slug',
            'terms' => 'in-stock',
            'operator' => 'IN'
        )
    );

    wp_enqueue_script('jquery');

    wp_register_script('my_loadmore', get_stylesheet_directory_uri() . '/js/myloadmore.js', array('jquery'), '1.0.0', true);
    wp_localize_script(
        'my_loadmore',
        'misha_loadmore_params',
        array(
            'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
            'posts' => json_encode($query_vars),
            'current_page' => $wp_query->query_vars['paged'] ? $wp_query->query_vars['paged'] : 1,
            'max_page' => $wp_query->max_num_pages
        )
    );

    wp_enqueue_script('my_loadmore');
}

add_action('wp_enqueue_scripts', 'misha_my_load_more_scripts');



function misha_loadmore_ajax_handler()
{

    $args = json_decode(stripslashes($_POST['query']), true);
    $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
    $args['post_status'] = 'publish';


    query_posts($args);

    if (have_posts()) :


        while (have_posts()) : the_post();
            echo " <div class=\"col-lg-3 col-md-4 col-sm-6 col-xs-6 margin-padding-0 testdata wow fadeInDown\" data-wow-delay=\"0.3s\">
                ";
            get_template_part('template-parts/content', 'sneaker');
            echo "</div>";
        endwhile;


    endif;
    die;
}

add_action('wp_ajax_loadmore', 'misha_loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadmore', 'misha_loadmore_ajax_handler');

/*============================loadmorejs end===================================*/
/*============================loadmorejs end===================================*/
/*============================loadmorejs end===================================*/




/*====================================== plugin active and deactive start====================================*/
/*====================================== plugin active and deactive start====================================*/
/*====================================== plugin active and deactive start====================================*/


/*
add_action( 'pre_get_posts', 'custom_get_posts' );

function custom_get_posts( $query )
{
    global $wp;
    $current_url = home_url(add_query_arg(array(),$wp->request));

     activate_plugins('/post-types-order/post-types-order.php');


    if(strpos($_SERVER['REQUEST_URI'], '/wp-admin/') != false){
        activate_plugins('/post-types-order/post-types-order.php');
    }



    if (is_post_type_archive('sneaker')) {

        deactivate_plugins('/post-types-order/post-types-order.php');

     }

    if(strpos($current_url, '/wp-admin/') != false){
        activate_plugins('/post-types-order/post-types-order.php');
    }
}
*/

/*====================================== plugin active and deactive end====================================*/
/*====================================== plugin active and deactive end====================================*/
/*====================================== plugin active and deactive end====================================*/







/*======================================customise plugin start====================================*/
/*======================================customise plugin start====================================*/
/*======================================customise plugin start====================================*/

add_filter('pto/posts_orderby/ignore', 'theme_pto_posts_orderby', 10, 2);
function theme_pto_posts_orderby($orderBy, $query)

{

    if (is_post_type_archive('sneaker')) {
        return $k = 'man';
    } else {
        return $k = 'pen';
    }
}

/*======================================customise plugin end====================================*/
/*======================================customise plugin end====================================*/
/*======================================customise plugin end====================================*/






/*=========================filter args start============================================*/
/*=========================filter args start============================================*/
/*=========================filter args start============================================*/

function misha_filter_function()
{

    $args = array(
        'post_type' => 'sneaker',
        'post_status' => 'publish',
        'posts_per_page' => 20



    );

    //sunil start date picker
    if (isset($_POST['daterange']) && $_POST['daterange']) {
        // echo "<pre>";
        //var_dump($_POST['daterange']);
        //var_dump($_POST['daterange']);




        $datepickervalues = preg_split("/[-]/", $_POST['daterange']);
        // $args['datepicker1']=trim($datepickervalues[0]);
        //$args['datepicker2']=trim($datepickervalues[1]);

        $datepicker1 = trim($datepickervalues[0]);
        $datepicker2 = trim($datepickervalues[1]);

        $daterangestart = Carbon::parse($datepicker1)->timestamp;
        $daterangeend = Carbon::parse($datepicker2)->timestamp;



        /* $args['datestart']=$daterangestart;
             $args['dateend']=$daterangeend;*/


        /* $currentday= Carbon::now();
             $currentday1=$currentday->timestamp;
             $oneweekago=$currentday->subWeek();
             $oneweekago1=$oneweekago->timestamp;*/

        $args['orderby'] = array('meta_value_num' => 'DESC');
        $args['meta_key'] = '_sf_date';
        $args['meta_query'] = array(
            array(
                'key' => '_sf_date',
                'value' => array($daterangestart, $daterangeend),
                'type' => 'numeric',
                'compare' => 'between'
            )
        );

        // exit();

    }


    //sunil end date picker




    if (isset($_POST['categoryfilter']) && $_POST['categoryfilter'] ||  isset($_POST['category_department_filter'])  && $_POST['category_department_filter'] ||  isset($_POST['category_color_filter'])  && $_POST['category_color_filter']) {
        $args['tax_query'] = array('relation' => 'AND');
    }

    if (isset($_POST['categoryfilter']) && $_POST['categoryfilter']) {
        $args['tax_query'][] = array(
            'taxonomy' => 'status',
            'field' => 'id',
            'terms' => $_POST['categoryfilter']
        );
    }

    if (isset($_POST['category_department_filter'])  && $_POST['category_department_filter']) {
        $args['tax_query'][] = array(
            'taxonomy' => 'department',
            'field' => 'id',
            'terms' => $_POST['category_department_filter']
        );
    }

    if (isset($_POST['category_color_filter'])  && $_POST['category_color_filter']) {
        $args['tax_query'][] = array(
            'taxonomy' => 'colour',
            'field' => 'id',
            'terms' => $_POST['category_color_filter']
        );
    }

    if (isset($_POST['sf_price_range']) && $_POST['sf_price_range']) {
        $args['orderby'] = array('meta_value_num' => 'DESC');
        $args['meta_key'] = '_sf_price';

        if ($_POST['sf_price_range'] == 'sf_price_range1' && isset($_POST['sf_price_range'])) {
            $args['meta_query'] = array(
                array(
                    'key' => '_sf_price',
                    'value' => 50,
                    'type' => 'numeric',
                    'compare' => '<'
                )
            );
        }

        if ($_POST['sf_price_range'] == 'sf_price_range2' && isset($_POST['sf_price_range'])) {
            $args['meta_query'] = array(
                array(
                    'key' => '_sf_price',
                    'value' => array(50, 99),
                    'type' => 'numeric',
                    'compare' => 'between'
                )
            );
        }

        if ($_POST['sf_price_range'] == 'sf_price_range3'  && isset($_POST['sf_price_range'])) {
            $args['meta_query'] = array(
                array(
                    'key' => '_sf_price',
                    'value' => array(100, 149),
                    'type' => 'numeric',
                    'compare' => 'between'
                )
            );
        }

        if ($_POST['sf_price_range'] == 'sf_price_range4'  && isset($_POST['sf_price_range'])) {
            $args['meta_query'] = array(
                array(
                    'key' => '_sf_price',
                    'value' => array(150, 200),
                    'type' => 'numeric',
                    'compare' => 'between'
                )
            );
        }

        if ($_POST['sf_price_range'] == 'sf_price_range5' && isset($_POST['sf_price_range'])) {
            $args['meta_query'] = array(
                array(
                    'key' => '_sf_price',
                    'value' => 200,
                    'type' => 'numeric',
                    'compare' => '>'
                )
            );
        }
    }

    $currentday = Carbon::now();
    $currentday1 = $currentday->timestamp;
    $oneweekago = $currentday->subWeek();
    $oneweekago1 = $oneweekago->timestamp;

    if (isset($_POST['sf_price1']) && $_POST['sf_price1']) {
        if ($_POST['sf_price1'] == 'date_desc' && isset($_POST['sf_price1'])) {
            $args['orderby'] = array('meta_value_num' => 'DESC');
            $args['meta_key'] = '_sf_date';
        } elseif ($_POST['sf_price1'] == 'release_week' && isset($_POST['sf_price1'])) {
            $args['orderby'] = array('meta_value_num' => 'DESC');
            $args['meta_key'] = '_sf_date';
            $args['meta_query'] = array(
                array(
                    'key' => '_sf_date',
                    'value' => array($oneweekago1, $currentday1),
                    'type' => 'numeric',
                    'compare' => 'between'
                )
            );
        } else {
            $args['orderby'] = array('meta_value_num' => $_POST['sf_price1']);
            $args['meta_key'] = '_sf_price';
        }
    }



    /*     add_action( 'pre_get_posts', 'filter_query' );

       //$popular_query = new WP_Query($args);
        query_posts( $args );
        remove_action( 'pre_get_posts', 'filter_query' );

        function filter_query( $query ) {
            //$query->query_vars['orderby'] = 'meta_value_num';
            //$query->query_vars['order'] = 'DESC';
            $meta_query[] = array(
                array(
                    'key'=>'_sf_price',
                    'value'=>100,
                    'type' => 'numeric',
                    'compare'=>'<',
                ),
            );
            $query->set('meta_query',$meta_query);
            //$query->set( 'orderby', array( '_sf_price' => 'DESC' ) );
            //echo "<pre>";
           // var_dump($query);
            return $query;


        }*/

    remove_all_filters('posts_orderby');
    query_posts($args);

    global $wp_query;

    if (have_posts()) :

        ob_start();

        while (have_posts()) : the_post();


            echo "<div class=\"col-lg-3 col-md-4 col-sm-6 col-xs-6 margin-padding-0 testdata wow fadeInDown\" data-wow-delay=\"0.3s\">
                ";
            get_template_part('template-parts/content', 'sneaker');
            echo "</div>";
        endwhile;

        echo "<div class=\"morepost\">";
        if ($wp_query->max_num_pages > 1) :
            echo '<div id=\'btnn\' onclick=\'UpdateStatus()\'>More posts</div>';
        endif;
        echo "<div id=\"wait\">";
        echo '<img src="' . get_template_directory_uri() . '/wp-advanced-search/img/loading.gif" alt="loading-gif" />';
        echo "</div>";
        echo "</div>";

        $posts_html = ob_get_contents();
        ob_end_clean();
    else :
        $posts_html = '<p>Nothing found for your criteria.</p>';
    endif;



    echo json_encode(array(
        'posts' => json_encode($wp_query->query_vars),
        'max_page' => $wp_query->max_num_pages,
        'found_posts' => $wp_query->found_posts,
        'content' => $posts_html
    ));

    die();
}


add_action('wp_ajax_myfilter', 'misha_filter_function');
add_action('wp_ajax_nopriv_myfilter', 'misha_filter_function');
/*=========================filter args end============================================*/
/*=========================filter args end============================================*/
/*=========================filter args end============================================*/



/******************************************************************************/
//add logo to post ratings schema

/*********************************************************************************/

add_filter('wp_postratings_site_logo', 'wp_postratings_site_logo');
function wp_postratings_site_logo($url)
{
    return 'https://fastsole-vhxacoez8fq.netdna-ssl.com/wp-content/themes/fs/img/logo.png';
}


/**
 * Remove hentry from post_class
 */
function fs_remove_hentry_class($classes)
{
    $classes = array_diff($classes, array('hentry'));
    return $classes;
}
add_filter('post_class', 'fs_remove_hentry_class');


/**
 * Remove type attribute for Javascript and style
 */
add_action('wp_loaded', 'output_buffer_start');
function output_buffer_start()
{
    ob_start("output_callback");
}

add_action('shutdown', 'output_buffer_end');
function output_buffer_end()
{

    if (ob_get_length() > 0) {

        ob_end_flush();
    }
}

function output_callback($buffer)
{
    return preg_replace("%[ ]type=[\'\"]text\/(javascript|css)[\'\"]%", '', $buffer);
}


/**
 * Remove post id from post class
 */


// filter default post link
/*function filter_post_link($permalink, $post) {
    if ($post->post_type != 'post')
        return $permalink;
    return 'sneaker-news'.$permalink;
}
add_filter('pre_post_link', 'filter_post_link', 10, 2);

// rewrite rules for default posts
add_action( 'generate_rewrite_rules', 'add_blog_rewrites' );
function add_blog_rewrites( $wp_rewrite ) {
    $wp_rewrite->rules = array(
        'sneaker-news/([^/]+)/?$' => 'index.php?name=$matches[1]',
        'sneaker-news/([^/]+)/page/([0-9]+)/?$' => 'index.php?post_type=page&page_number=$matches[2]',
        'sneaker-news/[^/]+/attachment/([^/]+)/?$' => 'index.php?attachment=$matches[1]',
        'sneaker-news/[^/]+/attachment/([^/]+)/trackback/?$' => 'index.php?attachment=$matches[1]&tb=1',
        'sneaker-news/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?attachment=$matches[1]&feed=$matches[2]',
        'sneaker-news/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?attachment=$matches[1]&feed=$matches[2]',
        'sneaker-news/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$' => 'index.php?attachment=$matches[1]&cpage=$matches[2]',
        'sneaker-news/([^/]+)/trackback/?$' => 'index.php?name=$matches[1]&tb=1',
        'sneaker-news/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?name=$matches[1]&feed=$matches[2]',
        'sneaker-news/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?name=$matches[1]&feed=$matches[2]',
        'sneaker-news/([^/]+)/page/?([0-9]{1,})/?$' => 'index.php?name=$matches[1]&paged=$matches[2]',
        'sneaker-news/([^/]+)/comment-page-([0-9]{1,})/?$' => 'index.php?name=$matches[1]&cpage=$matches[2]',
        'sneaker-news/([^/]+)(/[0-9]+)?/?$' => 'index.php?name=$matches[1]&page=$matches[2]',
        'sneaker-news/[^/]+/([^/]+)/?$' => 'index.php?attachment=$matches[1]',
        'sneaker-news/[^/]+/([^/]+)/trackback/?$' => 'index.php?attachment=$matches[1]&tb=1',
        'sneaker-news/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?attachment=$matches[1]&feed=$matches[2]',
        'sneaker-news/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?attachment=$matches[1]&feed=$matches[2]',
        'sneaker-news/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$' => 'index.php?attachment=$matches[1]&cpage=$matches[2]',
        // 'sneaker-news/([^/]+)/page/?$' => 'index.php?name=$matches[1]&paged=$matches[2]'
    ) + $wp_rewrite->rules;
}*/


// disable auto redirection
remove_action('template_redirect', 'redirect_canonical');

function fs_redirect()
{

    function endsWith($currentString, $target)
    {
        $length = strlen($target);
        if ($length == 0) {
            return true;
        }
        return (substr($currentString, -$length) === $target);
    }

    // url manipulation
    $url = $_SERVER['REQUEST_URI'];
    $url = preg_replace('/\?(.+)/', '', $url);
    $url = rtrim($url, "/");
    $url = explode('/', $url);
    $lastPart = array_pop($url);


    $requested_url = $_SERVER['REQUEST_URI'];
    $redirect_url = home_url() . '/sneaker-release-dates/';
    $redirect_brands = [];


    // get department term list and push to redirects array
    $brand_terms = get_terms('department', array(
        'hide_empty' => false,
    ));

    foreach ($brand_terms as $brand_term) {
        array_push($redirect_brands, strtolower(str_replace(' ', '-', $brand_term->slug)));
    }

    // redirect url manipulation


    if (strpos($requested_url, 'nmd') !== false) {
        $redirect_url .=  'brands/' . 'nmd/' . $lastPart;
    } elseif (strpos($requested_url, 'eqt') !== false) {
        $redirect_url .=  'brands/' . 'eqt/' . $lastPart;
    } elseif (strpos($requested_url, 'ultra-boost') !== false) {
        $redirect_url .=  'brands/' . 'ultra-boost/' . $lastPart;
    } elseif (strpos($requested_url, 'yeezy') !== false) {
        $redirect_url .=  'brands/' . 'yeezy/' . $lastPart;
    } elseif (strpos($requested_url, 'air-max') !== false) {
        $redirect_url .=  'brands/' . 'air-max/' . $lastPart;
    } elseif (strpos($requested_url, 'air-vapormax') !== false) {
        $redirect_url .=  'brands/' . 'air-vapormax/' . $lastPart;
    } elseif (strpos($requested_url, 'nikelab') !== false) {
        $redirect_url .=  'brands/' . 'nikelab/' . $lastPart;
    } elseif (strpos($requested_url, 'nike-jordan') !== false) {
        $redirect_url .=  'brands/' . 'nike-jordan/' . $lastPart;
    } elseif (strpos($requested_url, 'air-jordan') !== false) {
        $redirect_url .=  'brands/' . 'nike-jordan/' . $lastPart;
    } elseif (strpos($requested_url, 'nike') !== false) {
        $redirect_url .=  'brands/' . 'nike/' . $lastPart;
    } elseif (strpos($requested_url, 'adidas') !== false) {
        $redirect_url .=  'brands/' . 'adidas/' . $lastPart;
    } else {
        for ($i = 0; $i < count($redirect_brands); $i++) {
            if (strpos($requested_url, $redirect_brands[$i]) !== false) {
                $redirect_url .=  'brands/' . $redirect_brands[$i] . '/' . $lastPart;
            }
        }
    }

    // redirect if user hits /sneaker/ in url
    // || strpos($requested_url, '/sneaker-release-dates/!== false '
    if (strpos($requested_url, '/sneaker/') !== false) {
        // var_dump($redirect_url);
        // exit();
        wp_redirect($redirect_url, 301);
        exit();
    }

    if (strpos($requested_url, '/sneaker-release-dates/') !== false && strpos($requested_url, '/brands/') == false) {

        if (strpos($requested_url, '/status/') == false) {
            if (endsWith($requested_url, "dates") || !endsWith($requested_url, "dates/")) {
                wp_redirect($redirect_url, 301);
                exit();
            }
        }
    }
}

add_action('template_redirect', 'fs_redirect');


// single blog page redirect
// add_action('init', 'blog_front');

/*add_filter('rewrite_rules_array', 'sneaker_news_redirect_rules');
function sneaker_news_redirect_rules( $rules ) {
    $cpt_slug = 'editor';
    $rewrite_slug = 'sneaker-news';
    $blog_editor_rules = [
        // Fix page archives
        "{$rewrite_slug}/page/?([0-9]{1,})/?$" => "index.php?pagename={$rewrite_slug}&paged=$matches[1]", // My custom rule. Added first so it takes precedence
        "{$rewrite_slug}/([^/]+)(?:/([0-9]+))?/?$" => "index.php?$cpt_slug=$matches[1]&page=$matches[2]" // Original rule that we need to kill
    ];
    foreach ( $rules as $rule => $rewrite ) {
        // Killing the original rule here after matching it.
        if ( false !== strpos( $rule, "{$rewrite_slug}/([^/]+)(?:/([0-9]+))?/?$" )  ) {
            unset( $rules[ $rule ] );
        }
    }
    $rules = array_merge( $blog_editor_rules, $rules );
    return $rules;
}*/


add_action('template_redirect', 'sincker_single_page_redirect');

function sincker_single_page_redirect()
{
    if (is_main_query() && is_single() && (empty(get_post_type()) || (get_post_type() === 'post'))) {
        if (strpos(trim(add_query_arg(array()), '/'), 'sneaker-news') !== 0) {
            global $post;
            $url2 = str_replace($post->post_name, 'sneaker-news/' . $post->post_name, get_permalink($post));
            wp_safe_redirect($url2, 301);
            exit();
        }
    }
}

/*add_filter('the_permalink', 'post_permalink_sneaker_news');

function post_permalink_sneaker_news( $link ) {
  global $post;
  if ( $post->post_type === 'post' ) {
    $link = str_replace( $post->post_name, 'sneaker-news/' . $post->post_name, get_permalink( $post ) );
  }
  return $link;
}*/

add_filter('show_admin_bar', '__return_false');
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
add_filter('show_admin_bar', '__return_false');

//Set Cronjob
/*function auto_remove_cache_cron_function() {
	//$string_url = "https://dev.fastsole.co.uk/misc/autocache.php";
    $string_url = site_url()."/misc/autocache.php";
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_ENCODING => "",
	CURLOPT_URL => $string_url
	));
	// curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($curl);
	curl_close($curl);
}
add_action( 'auto_remove_cache_cron', 'auto_remove_cache_cron_function' );*/

/*Cloudflare Cache Cron - Every 5 Minutes*/
add_filter('cron_schedules', 'isa_add_every_five_minutes');
function isa_add_every_five_minutes($schedules)
{
    $schedules['every_five_minutes'] = array(
        'interval'  => 300,
        'display'   => __('Every 5 Minutes', 'textdomain')
    );
    return $schedules;
}

// Schedule an action if it's not already scheduled
if (!wp_next_scheduled('isa_add_every_five_minutes')) {
    wp_schedule_event(time(), 'every_five_minutes', 'isa_add_every_five_minutes');
}

// Hook into that action that'll fire every three minutes
add_action('isa_add_every_five_minutes', 'every_five_minutes_event_func');
function every_five_minutes_event_func()
{
    //$string_url = "https://dev.fastsole.co.uk/misc/autocache.php";
    $string_url = site_url() . "/misc/autocache.php";
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_ENCODING => "",
        CURLOPT_URL => $string_url
    ));
    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
}

function better_wpautop($pee)
{
    return wpautop($pee, false);
}
remove_filter('the_content', 'wpautop');
add_filter('the_content', 'better_wpautop', 99);
add_filter('the_content', 'shortcode_unautop', 100);

add_filter('auto_update_theme', '__return_false');
//add_filter( 'auto_update_plugin', '__return_false' );

function cvf_remove_wp_core_updates()
{
    global $wp_version;
    return (object) array('last_checked' => time(), 'version_checked' => $wp_version);
}
// Core Notifications
add_filter('pre_site_transient_update_core', 'cvf_remove_wp_core_updates');
// Plugin Notifications
//add_filter('pre_site_transient_update_plugins','cvf_remove_wp_core_updates');
// Theme Notifications
add_filter('pre_site_transient_update_themes', 'cvf_remove_wp_core_updates');

/*Sneakers News Image REST API*/
add_action('rest_api_init', 'register_rest_images');
function register_rest_images()
{
    register_rest_field(
        array('post'),
        'fimg_url',
        array(
            'get_callback'    => 'get_rest_featured_image',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}
function get_rest_featured_image($object, $field_name, $request)
{
    if ($object['featured_media']) {
        $img = wp_get_attachment_image_src($object['featured_media'], 'app-thumb');
        return $img[0];
    }
    return false;
}
// Remove - Canonical for - [blog lsiitng - Page]
function remove_canonical()
{

    // Disable for 'search' page
    if (is_home()) {
        add_filter('wpseo_canonical', '__return_false',  10, 1);
    }
}
add_action('wp', 'remove_canonical');
add_filter('algolia_post_images_sizes', function ($sizes) {
    $sizes[] = 'medium';

    return $sizes;
});

add_filter('algolia_post_shared_attributes', 'my_post_attributes', 10, 2);
add_filter('algolia_searchable_post_shared_attributes', 'my_post_attributes', 10, 2);
function my_post_attributes(array $attributes, WP_Post $post)
{
    if ('sneaker' !== $post->post_type) {
        return $attributes;
    }
    $attributes['_sf_price'] = get_post_meta($post->ID, '_sf_price', true);
    return $attributes;
}
//code for cahce clear
$WP_REST_Request = new WP_REST_Request();
$WP_REST_Request->set_header('mycusotmexpireheader', 'abctest123');
// if you don't add 3 as as 4th argument, this will not work as expected
/*add_action( 'edit_post', 'my_save_post_function', 10, 3 );

function my_save_post_function( $post_ID, $post, $update ) {
    $json_data = json_encode($post);
    // Initiate the cURL
   // $data['post_content'] = get_the_content($post_ID);
   // $data['sneaker_status'] = get_post_meta($post_ID, '_sf_instock', true);
    $json_data = json_encode($post);
    $url = curl_init('https://aws.fastsole.co.uk/wp-json/wl/v1/on-focus');
    curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($url, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($url, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($json_data))
    );
    // The results of our request, to use later if we want.
    $result = curl_exec($url);
    
}*/
/*function yournamespace_delete_transient( $post_id, $post, $update ) {
  
	delete_cache_by_endpoint('/wl/v1/on-focus');

}

//{your_post_type} with a custom post type
add_action('save_post_sneaker', 'yournamespace_delete_transient', 10, 3);*/
/*function wprc_determine_object_type( $object_type, $cache_key, $data, $uri) {
	if ( $object_type !== 'unknown' || strpos( $uri, 'api/v2' ) === false ) {
		return $object_type;
	}
	elseif ( $object_type == 'unknown' && $uri === 'MATCH_EXACT_uri/posts' ) {
		return 'post';
	}
	elseif ( $object_type == 'unknown' && $uri === 'MATCH_EXACT_uri/pages' ) {
		return 'page';
	}

	return 'unknown';
}
add_filter( 'wp_rest_cache/determine_object_type', 'wprc_determine_object_type', 10, 4 );*/
/*function wprc_unregister_wp_comments_endpoint( $allowed_endpoints ) {
    if ( isset( $allowed_endpoints[ 'wl/v1' ] )) {
        unset( $allowed_endpoints[ 'wl/v1' ]);
    }
    return $allowed_endpoints;
}
add_filter( 'wp_rest_cache/allowed_endpoints', 'wprc_unregister_wp_comments_endpoint', 100, 1);*/
/*add_action( 'save_post', function( $post_id ) {
    if ( class_exists( 'WP_REST_Cache' ) ) {
      WP_REST_Cache::empty_cache();
    }
  } );*/
/*function wprc_determine_object_type( $object_type, $cache_key, $data, $uri ) {
    if ('post' === $object_type) {
        $object_type = 'sneaker';
    }
    return $object_type;
}
add_filter( 'wp_rest_cache/determine_object_type', 'wprc_determine_object_type', 10, 4 );*/
/*require_once ABSPATH . 'wp-admin/includes/plugin.php';
if ( is_plugin_active( 'wp-rest-cache/wp-rest-cache.php' ) ) {
    include_once WP_PLUGIN_DIR . '/wp-rest-cache/wp-rest-cache.php';

    $wp_rest_cache_api = new \WP_Rest_Cache_Plugin\Includes\API\Endpoint_Api();
    $wp_rest_cache_api->get_api_cache();

   

    function refreshCache($postId)
    {
        

        $post_type = get_post_type($postId);

        $caching = \WP_Rest_Cache_Plugin\Includes\Caching\Caching::get_instance();
        if ($post_type === 'sneaker') {
            $caching->delete_cache_by_endpoint("/wp-json/wl/v1/on-focus");
        }
       
        
    }
    add_action('save_post_sneaker', 'refreshCache', 1);
}*/
/*function my_customize_rest_cors() {
        remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );
        add_filter( 'rest_pre_serve_request', function( $value ) {
          //  header( 'Access-Control-Allow-Origin: *' );
           // header( 'Access-Control-Allow-Methods: POST, GET' );
            header( 'cache-control: no-cache' );
           // header( 'Access-Control-Expose-Headers: Link', false );
            header( 'cusotmheader: abctest' );
            return $value;
        } );
    }
    
    add_action( 'rest_api_init', 'my_customize_rest_cors', 15 );*/
/*  add_filter( 'wp_headers', function( $headers ) {
        $headers['cache-control'] = 'no-cache';
        $headers['abctest'] = 'WordPress VIP, an Automattic Production.';
        return $headers;
    }, 999 );*/
//pply_filters( 'rest_send_nocache_headers', false );*/


add_action('wp', 'wpcom_vip_cache_maxage');

function wpcom_vip_cache_maxage($wp)
{

    // Set the max age for feeds to 5 minutes.
    if (!is_user_logged_in()) {
        header('Cache-Control: max-age=' . (1));
        header('ETag: ' . rand());
    }
}
/*add_filter( 'rest_cache_skip', function( $skip, $uri ) {
    if ( ! $skip && stripos( $uri, 'wl/v1/on-focus' ) !== false ) {
        $skip = true;
    }

    return $skip;
}, 10, 2 );*/
/*$send_no_cache_headers = apply_filters('rest_send_nocache_headers', is_user_logged_in());
if (!$send_no_cache_headers && !is_admin() && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $nonce = wp_create_nonce('wp_rest');
    $_SERVER['HTTP_X_WP_NONCE'] = $nonce;
}
function add_rand_orderby_rest_post_collection_params( $query_params ) {

    $query_params['orderby']['enum'][] = 'rand';

    return $query_params;

}

add_filter( 'rest_post_collection_params', 'add_rand_orderby_rest_post_collection_params' );
function disable_api_cache_professional_key_header() {
    return false;
}
add_action( 'api_cache_pro_major_header', 'disable_api_cache_pro_key_header' );*/
// if you don't add 3 as as 4th argument, this will not work as expected
//add_action('save_post_sneaker', 'my_save_post_function', 10, 3);
//add_action('save_post_sneaker', 'my_save_post_function', 20, 3);
add_action('updated_post_meta', 'my_save_post_function', 10, 4);

function my_save_post_function($meta_id, $post_id, $meta_key = '', $meta_value = '')
{
    $site_url = site_url();
    $post = get_post($post_id);
    $title = $post->post_name;
    if (get_post_type($post_id) == "sneaker" && count($_POST) > 0) : 
        $catgeories = get_the_terms($post_id, 'department');
        /*if (count($catgeories) > 0) {
            $categoryslug = $catgeories[0]->slug; 
            /* aplyign this logic is nto working for some catgeory for e.g in thsi post https://aws.fastsole.co.uk/wp-admin/post.php?post=177858&action=edit , 
                2 ctagoery assined 1) Nike 2) Nike Dunk then it should return nike-dunk but it is giving nike

        }*/
        $permalink = get_the_permalink($post_id);
        $permlink_arr = explode("/",$permalink);
        if(count($permlink_arr)>0){
            $categoryslug = $permlink_arr[5] ;
        }       
        $file_slug = '{
        "files":[
            "'.$site_url.'/wp-json/wl/v1/on-focus",  
            "'.$site_url.'/sneaker-release-dates/brands/' . $categoryslug . '/' . $title . '/",             
            "'.$site_url.'/wp-json/wl/v1/coming-soon/",
            "'.$site_url.'/wp-json/wl/v1/sneaker-release-dates-test/*",
            "'.$site_url.'/wp-json/wl/v1/On-focus-items/45-*",
            "'.$site_url.'/wp-json/wl/v1/On-focus-items/105-*" ,
            "'.$site_url.'/wp-json/wl/v1/schema-brands/'.$title.'/",
            "'.$site_url.'/wp-json/wl/v1/posts/' . $title . '/",
            "'.$site_url.'/wp-json/wl/v1/schema-brands//sneaker-release-dates/brands/'.$categoryslug.'/'.$title.'/"                   
            ]
        }';
       /* echo "<pre>";
       print_r($file_slug);
       echo "</pre>";
       exit; */     
    endif;
    if (get_post_type($post_id) == "post" && count($_POST) > 0) :   
        $catgeories = get_the_terms($post_id,'category');  
        if(in_category('offer-discount',$post_id)){
            $addurls1 = ',"'.$site_url .'/wp-json/wp/v2/categories?slug=offer-discount",';  
            $addurls2 = '"'. $site_url.'/wp-json/wp/v2/posts?_embed=true&categories=598&page=1"';
        }
        $file_slug = '{
        "files":[
            "'.$site_url.'/wp-json/wp/v2/posts/'.$post_id.'"  ,
            "'.$site_url. '/sneaker-news/'.$title.'/",    
            "'.$site_url.'/wp-json/wl/v1/sneaker-news/page/'.$title.'/"   ,
            "'.$site_url.'/wp-json/wl/v1/schema-brands/'.$title.'/"   ,
            "'.$site_url.'/wp-json/wl/v1/on-focus/*"   ,
            "'.$site_url.'/sneaker-news/category/offer-discount/",
            "'.$site_url.'/wp-json/wl/v1/schema-brands//sneaker-release-dates/brands/'.$categoryslug.'/'.$title.'/",
            "'.$site_url.'/sneaker-news/category/page/*" 
            '.$addurls1.'
            '.$addurls2.' 
            ]
        }'; 
        //echo "<prE>";
       // print_r($file_slug); 
      //  echo "filessssss=====".$file_slug;
       // echo "</prE>";
       
    endif;  
    if(count($_POST) > 0):
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.cloudflare.com/client/v4/zones/877eb0772f14d15e4aa402004e92738c/purge_cache',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $file_slug,
            CURLOPT_HTTPHEADER => array(
                'X-Auth-Email: fastsoleuk@gmail.com',
                'X-Auth-Key: 26f5b0688b57b00a619f3bb09030c02f5348b',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        //custom_logs($response,$file_slug);       
        curl_close($curl);   
       // echo $response;
    //exit;
    endif; 
    
}
function custom_logs($message,$file_slug) { 
    if(is_array($message)) { 
        $message = json_encode($message); 
    } 
    $file = fopen("../cacheremove_logs.log","a"); 
    echo fwrite($file, "\n" . date('Y-m-d h:i:s') . " :: " . $message);     
    echo fwrite($file, "\n" . $file_slug); 
    echo fwrite($file, "\n" . "-------------------"); 
    fclose($file); 
}
/*add_filter( 'json_url_prefix', 'my_theme_api_slug'); 
function my_theme_api_slug( $slug ) { 
    return 'mistified';
}*/
//flush_rewrite_rules();

add_action('PTO/order_update_complete', 'fs_reorder_clear_cache');
function fs_reorder_clear_cache(){
    $site_url = site_url();
    $file_slug = '{
        "files":[
            "'.$site_url.'/wp-json/wl/v1/schema-brands/*",
            "'.$site_url.'/wp-json/wl/v1/on-focus/*",
            "'.$site_url.'/wp-json/wl/v1/on-focus",
            "'.$site_url.'/wp-json/wl/v1/On-focus-items/*",
            "'.$site_url.'/wp-json/wl/v1/On-focus-items/45-*",
            "'.$site_url.'/wp-json/wl/v1/On-focus-items/105-*"
            "'.$site_url.'/wp-json/wl/v1/schema-brands//sneaker-release-dates/brands/*",
            "'.$site_url.'/sneaker-news/category/page/*",
            "'.$site_url.'/sneaker-release-dates/brands/*",
            "'.$site_url.'/wp-json/wl/v1/coming-soon/",
            "'.$site_url.'/wp-json/wl/v1/sneaker-release-dates-test/*",
            "'.$site_url.'/sneaker-release-dates/status/*",
            ]
        }';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.cloudflare.com/client/v4/zones/877eb0772f14d15e4aa402004e92738c/purge_cache',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $file_slug,
            CURLOPT_HTTPHEADER => array(
                'X-Auth-Email: fastsoleuk@gmail.com',
                'X-Auth-Key: 26f5b0688b57b00a619f3bb09030c02f5348b',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        custom_logs($response,$file_slug);       
        curl_close($curl);
}