<?php
require_once trailingslashit(ABSPATH) . 'wp-load.php';

// global $wpdb;

/**
 * Plugin Name: NWG API
 * Plugin URI: https://fastsole.co.uk/
 * Description: API for WP
 * Version: 2.9
 * Author: Abhijeet Mandal
 * Author URI: https://nextwebguru.com/
 */

global $fastsole;
// global $wpdb;



function wl_posts()
{
    print_r($wpdb);
    die();
    $args = [
        'numberposts' => 5,
        'post_type' => 'sneaker',
    ];

    $posts = get_posts($args);

    $data = [];
    $i = 0;

    foreach ($posts as $post) {
        $data[$i]['id'] = $post->ID;
        $data[$i]['title'] = $post->post_title;
        $data[$i]['content'] = $post->post_content;
        $data[$i]['slug'] = $post->post_name;
        $data[$i]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post->ID, 'thumbnail');
        $data[$i]['featured_image']['medium'] = get_the_post_thumbnail_url($post->ID, 'medium');
        $data[$i]['featured_image']['large'] = get_the_post_thumbnail_url($post->ID, 'large');
        $i++;
    }

    return $data;
}

function wl_post($slug)
{
    global $wpdb;
    $args = [
        'name' => $slug['slug'],
        'post_type' => 'sneaker',
    ];

    function wpsrc($id)
    {
        $image_full = wp_get_attachment_image_src($id, 'full', false);
        $image_large = wp_get_attachment_image_src($id, 'large', false);
        $image_medium = wp_get_attachment_image_src($id, 'medium', false);
        $image_medium_large = wp_get_attachment_image_src($id, 'medium_large', false);
        $image_thumbnail = wp_get_attachment_image_src($id, 'thumbnail', false);

        $final_src = $image_full[0] . ' ' . $image_full[1] . 'w' . ', ' . $image_large[0] . ' ' . $image_large[1] . 'w' . ', ' . $image_medium[0] . ' ' . $image_medium[1] . 'w' . ', ' . $image_medium_large[0] . ' ' . $image_medium_large[1] . 'w' . ', ' . $image_thumbnail[0] . ' ' . $image_thumbnail[1] . 'w';

        return $final_src;
    }

    $post = get_posts($args);
    // $postId = $post[0]->ID;
    // $image_id =
    $data['id'] = $post[0]->ID;
    $data['title'] = $post[0]->post_title;
    $data['content'] = $post[0]->post_content;
    $data['slug'] = $post[0]->post_name;
    $data['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post[0]->ID, 'thumbnail');
    $data['featured_image']['medium'] = get_the_post_thumbnail_url($post[0]->ID, 'medium');
    $data['featured_image']['large'] = get_the_post_thumbnail_url($post[0]->ID, 'large');
    $data['featured_image']['large'] = get_the_post_thumbnail_url($post[0]->ID, 'medium_large');
    $data['featured_image']['large'] = get_the_post_thumbnail_url($post[0]->ID, 'full');
    $image_id = get_post_thumbnail_id($post[0]->ID);
    $data['featured_image']['srcset'] = wpsrc($image_id);

    /** post meta */

    $meta = get_post_meta($post[0]->ID);
    $buyLink = $meta['_sf_affilate_group'][0];
    $buyLinkData = unserialize($buyLink);
    $data['buyLink'] = $buyLinkData;
    $productImages = $meta['_sf_images'][0];
    $data['productImages'] = unserialize($productImages);
    $list_image = unserialize($productImages);

    $list_image_srcset = [];
    $list_image_url = [];

    foreach ($list_image as $key => $value) {

        //$list_image_srcset[] =  array( $key => wp_get_attachment_image_srcset($key, 'medium', true));
        $list_image_srcset[] = array(array("srcset" => wpsrc($key), "src" => $value));

        // array_push($list_image_srcset,$srcset);
        $list_image_url[] = array($key => $value);
    }

    $data['productImagesMain'] = $list_image_srcset;
    // $data['productImagesMain']['url'] = $list_image_url;
    $i = 0;
    foreach ($buyLinkData as $value) {
        $affiliateid = $value['affilate_title'];
        $index = "_afflink_$affiliateid";
        $affiliateLink = $meta[$index][0];
        $data['buyLink'][$i]['affilate_link'] = $affiliateLink;
        $i++;
    }

    $data['releaseTimeDate'] = [
        'date' => gmdate('D, d M Y T', $meta['_sf_date'][0]),
        'time' => $meta['_sf_time'][0],
        'stock' => $meta['_sf_instock'][0],
        'price' => $meta['_sf_price'][0],
        'styleCode' => $meta['_sf_style_code'][0],
    ];

    // buy from heere data

    $getId = $post[0]->ID;

    // echo $getId;
    // die();
    // $getId = 155069;

    $entries = get_post_meta($getId, '_sf_affilate_group', true);

    // echo json_encode($entries);

    $dataTemp = [];
    $i = 0;
    foreach ($entries as $key => $entry) {

        $affilate_post_id = $entry['affilate_title'];

        $launch_date = $entry['launch_date'];
        if ($launch_date == null) {
            $launch_date = "TBC";
        } else {
            $launch_date = date('D d M Y', $launch_date);
        }
        $launch_time = $entry['launch_time'];
        $launch_status = $entry['launch_status'];

        if (!empty($entry['affilate_link'])) {

            $meta_key = "_afflink_{$affilate_post_id}";
            $aff_link = get_post_meta($getId, $meta_key, true);
        } else {

            $aff_link = get_post_meta($affilate_post_id, '_sf_default_link', true);
        }

        // echo $thumnail = get_the_post_thumbnail($affilate_post_id, 'post-thumb', array('class' => "img-responsive",));
        $thumbnail = get_the_post_thumbnail_url($affilate_post_id, 'medium');
        //$thumbnailsrc = wp_get_attachment_image_srcset($affilate_post_id, 'medium', true);
        $thumbnailsrc = wpsrc($affilate_post_id);

        if ($launch_status == "coming_soon") :
            $stockStatus = "Coming Soon";

        elseif ($launch_status == "tbc") :
            $stockStatus = "TBC";

        elseif ($launch_status == "instock") :
            $stockStatus = "In Stock";

        elseif ($launch_status == "restock") :
            $stockStatus = "Re Stock";

        elseif ($launch_status == "delayed") :
            $stockStatus = "Reseller";

        elseif ($launch_status == "sold_out") :
            $stockStatus = "Sold Out";

        elseif ($launch_status == "raffle") :
            $stockStatus = "Raffle";

        endif;

        // buy link and visit website
        if ($launch_status == "instock" || $launch_status == "restock" || $launch_status == "delayed") :
            $buttonName = "Buy Now";

        elseif ($launch_status == "sold_out") :
            $buttonName = "Visit Website";

        else :
            $buttonName = "Visit Website";

        endif;

        $dataTemp[$i]['shopLogo'] = $thumbnail;
        $dataTemp[$i]['shooLogoSrc'] = $thumbnailsrc;
        $dataTemp[$i]['statusButton'] = $buttonName;
        $dataTemp[$i]['affiliateUrl'] = $aff_link;
        $dataTemp[$i]['stockStatus'] = $stockStatus;
        $dataTemp[$i]['releseDate'] = $launch_date;
        $dataTemp[$i]['releseTime'] = $launch_time;

        $i++;
    }
    $data['buyFromHere'] = $dataTemp;

    $result = $wpdb->get_results("SELECT t.*, tt.* FROM wpfs_terms AS t INNER JOIN wpfs_term_taxonomy AS tt ON t.term_id = tt.term_id INNER JOIN wpfs_term_relationships AS tr ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tt.taxonomy IN ('colour') AND tr.object_id IN ($getId) ORDER BY t.name ASC");

    foreach ($result as $val) {
        $colorName = $val->name;
    }
    // All Release Info
    $data['releseInfo'] = [
        'releaseDate' => $data['releaseTimeDate']['date'],
        'price' => $data['releaseTimeDate']['price'],
        'brand' => '',
        'model' => '',
        'styleCode' => $data['releaseTimeDate']['styleCode'],
        'color' => $colorName,
    ];

    $result_department = $wpdb->get_results("SELECT t.*, tt.* FROM wpfs_terms AS t INNER JOIN wpfs_term_taxonomy AS tt ON t.term_id = tt.term_id INNER JOIN wpfs_term_relationships AS tr ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tt.taxonomy IN ('department') AND tr.object_id IN ($getId) ORDER BY t.term_id DESC;");

    $parent_arr = [];

    $mainArr = [];

    foreach ($result_department as $val) {
        $parent = $val->parent;
        $name = $val->name;
        $slug = $val->slug;
        $termId = $val->term_id;

        if ($parent == 0) {
            $parent_arr[$parent] = [
                'name' => $name,
                'child' => $termId,
                'slug' => $slug,
            ];
        } else {
            $mainArr[$parent] = [
                'name' => $name,
                'child' => $termId,
                'slug' => $slug,

            ];
        }
    }

    $status = true;
    $i = 0;
    while ($status == true) {
        $status = false;
        $child = $parent_arr[$i]['child'];
        $tempArr = [
            'name' => $mainArr[$child]['name'],
            'child' => $mainArr[$child]['child'],
            'slug' => $mainArr[$child]['slug'],
        ];

        array_push($parent_arr, $tempArr);

        unset($mainArr[$child]);

        if (!empty($mainArr)) {
            $status = true;
        } else {
            $status = false;
            break;
        }

        $i++;
    }
    $data['categoryData'] = $parent_arr;

    if (sizeof($parent_arr) >= 1) {
        $brand = $parent_arr[0]['name'];
        $model = $parent_arr[1]['name'];

        $data['releseInfo']['brand'] = ucfirst($brand);
        $data['releseInfo']['model'] = ucfirst($model);
    }

    /** end of post meta */

    return $data;
}

function wl_news()
{
    $args = [
        'numberposts' => 20,
        'post_name' => 'sneaker-news',
    ];

    $posts = get_posts($args);

    $data = [];
    $i = 0;
    foreach ($posts as $post) {
        $cetegoryData = get_the_category($post->ID);

        $data[$i]['id'] = $post->ID;
        $data[$i]['title'] = $post->post_title;
        $data[$i]['content'] = (string) $post->post_content;
        $data[$i]['slug'] = $post->post_name;
        $data[$i]['category']['name'] = $cetegoryData[0]->name;
        $data[$i]['category']['slug'] = $cetegoryData[0]->slug;
        $data[$i]['postDate'] = gmdate('d M', strtotime($post->post_date));
        $data[$i]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post->ID, 'thumbnail');
        $data[$i]['featured_image']['medium'] = get_the_post_thumbnail_url($post->ID, 'medium');
        $data[$i]['featured_image']['large'] = get_the_post_thumbnail_url($post->ID, 'large');
        $i++;
    }
    echo json_encode($data);
}

function wl_news_pages($slug)
{
    $pageNumber = $slug['slug'];
    $totalPosts = (int)$pageNumber * 11;
    $args = [
        'numberposts' => $totalPosts,
        'post_name' => 'sneaker-news',
    ];

    $posts = get_posts($args);

    $data = [];
    $i = 0;
    foreach ($posts as $post) {
        $cetegoryData = get_the_category($post->ID);

        $data[$i]['id'] = $post->ID;
        $data[$i]['title'] = $post->post_title;
        $data[$i]['content'] = (string) $post->post_content;
        $data[$i]['slug'] = $post->post_name;
        $data[$i]['category']['name'] = $cetegoryData[0]->name;
        $data[$i]['category']['slug'] = $cetegoryData[0]->slug;
        $data[$i]['postDate'] = gmdate('d M', strtotime($post->post_date));
        $data[$i]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post->ID, 'thumbnail');
        $data[$i]['featured_image']['medium'] = get_the_post_thumbnail_url($post->ID, 'medium');
        $data[$i]['featured_image']['large'] = get_the_post_thumbnail_url($post->ID, 'large');
        $i++;
    }

    $sizeofData = sizeof($data);
    $maxUnset = ((int)$sizeofData / (((int)$pageNumber - 1) == 1 ? 2 : ((int)$pageNumber - 1)));

    for ($i = 0; $i < $maxUnset; $i++) {
        unset($data[$i]);
    }
    $newArr = array_values($data);

    echo json_encode($newArr);
}

function onFocus()
{
    $args = array(
        'post_type' => 'sneaker',
        'post_status' => 'publish',
        'posts_per_page' => 12,
        'tax_query' => array(
            array(
                'taxonomy' => 'status',
                'field' => 'slug',
                'terms' => array('on-focus'),
                'operator' => 'IN',
            ),

        ),
        'no_found_rows' => true,
        'update_post_term_cache' => false,
        'update_post_meta_cache' => false,
    );

    function wpsrc($id)
    {
        $image_full = wp_get_attachment_image_src($id, 'full', false);
        $image_large = wp_get_attachment_image_src($id, 'large', false);
        $image_medium = wp_get_attachment_image_src($id, 'medium', false);
        $image_medium_large = wp_get_attachment_image_src($id, 'medium_large', false);
        $image_thumbnail = wp_get_attachment_image_src($id, 'thumbnail', false);

        $final_src = $image_full[0] . ' ' . $image_full[1] . 'w' . ', ' . $image_large[0] . ' ' . $image_large[1] . 'w' . ', ' . $image_medium[0] . ' ' . $image_medium[1] . 'w' . ', ' . $image_medium_large[0] . ' ' . $image_medium_large[1] . 'w' . ', ' . $image_thumbnail[0] . ' ' . $image_thumbnail[1] . 'w';

        return $final_src;
    }

    $query = new WP_Query($args);
    $query = $query->posts;
    $data = [];

    foreach ($query as $id => $value) {
        $postId = $value->ID;
        $new_slug = str_replace(home_url(), '', get_post_permalink($postId));

        // this section is only for finding price and stock availability
        $release_date = get_post_meta($postId, '_sf_date', true);
        $release_time = get_post_meta($postId, '_sf_time', true);

        $price = get_post_meta($postId, '_sf_price', true);

        $esc_price = esc_html($price);

        $sneaker_status = get_post_meta($postId, '_sf_instock', true);

        $data[$id]['release_date'] = ($release_date != null) ? date('D d M Y', $release_date) : "TBC";
        $data[$id]['release_date_int'] = ($release_date != null) ? $release_date : 0;
        $data[$id]['release_time'] = $release_time;
        $data[$id]['price'] = $price;
        $data[$id]['esc_price'] = $esc_price;
        $data[$id]['sneaker_status'] = $sneaker_status;

        $data[$id]['postId'] = $value->ID;
        $data[$id]['slug'] = $new_slug;
        $data[$id]['post_author'] = $value->post_author;
        $data[$id]['post_date'] = date("d m Y H:i", strtotime($value->post_date));
        $data[$id]['post_modified_gmt'] = date("d M Y H:i A", strtotime($value->post_date_gmt));
        $data[$id]['post_content'] = $value->post_content;
        $data[$id]['post_title'] = $value->post_title;
        $data[$id]['post_excerpt'] = $value->post_excerpt;
        $data[$id]['post_name'] = $value->post_name;
        $data[$id]['post_type'] = $value->post_type;
        $data[$id]['post_status'] = $value->post_status;
        $data[$id]['ping_status'] = $value->ping_status;

        $data[$id]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($postId, 'thumbnail');
        $data[$id]['featured_image']['medium'] = get_the_post_thumbnail_url($postId, 'medium');
        $data[$id]['featured_image']['large'] = get_the_post_thumbnail_url($postId, 'large');
        $image_id = get_post_thumbnail_id($postId);
        $data[$id]['featured_image']['srcset'] = wpsrc($image_id);
        $data[$id]['mycustomkey'] = rand();
    }
    /* echo "<pre>data======";
    print_r($data);
    echo "</prE>";
    exit;*/
    // $data['mydynamickey'] = rand();
    //array_multisort(array_column($data, "release_date_int"), SORT_DESC, $data);

    echo json_encode($data);
}

function comingSoon()
{
    $args = array(
        'post_type' => 'sneaker',
        'posts_per_page' => 8,
        'tax_query' => array(
            array(
                'taxonomy' => 'status',
                'field' => 'id',
                'terms' => 45,
            ),
        ),
        'no_found_rows' => true,
        'update_post_term_cache' => false,
        'update_post_meta_cache' => false,
    );

    $query = new WP_Query($args);

    $query = $query->posts;

    $data = [];
    foreach ($query as $key => $value) {
        $id = $value->ID;
        $new_slug = str_replace(home_url(), '', get_post_permalink($id));

        // this section is only for finding price and stock availability
        $release_date = get_post_meta($id, '_sf_date', true);
        $release_time = get_post_meta($id, '_sf_time', true);

        $price = get_post_meta($id, '_sf_price', true);

        $esc_price = esc_html($price);

        $sneaker_status = get_post_meta($id, '_sf_instock', true);

        $data[$key]['release_date'] = ($release_date != null) ? date('D d M Y', $release_date) : "TBC";
        $data[$key]['release_date_int'] = ($release_date != null) ? $release_date : 0;
        $data[$key]['release_time'] = $release_time;
        $data[$key]['price'] = $price;
        $data[$key]['esc_price'] = $esc_price;
        $data[$key]['sneaker_status'] = $sneaker_status;

        $data[$key]['ID'] = $value->ID;
        $data[$key]['slug'] = $new_slug;
        $data[$key]['post_author'] = $value->post_author;
        $data[$key]['post_date_gmt'] = date("d M Y H:i A", strtotime($value->post_date_gmt));
        $data[$key]['post_content'] = $value->post_content;
        $data[$key]['post_title'] = $value->post_title;
        $data[$key]['post_excerpt'] = $value->post_excerpt;
        $data[$key]['post_status'] = $value->post_status;
        $data[$key]['ping_status'] = $value->ping_status;
        $data[$key]['post_name'] = $value->post_name;
        $data[$key]['post_type'] = $value->post_type;
        $data[$key]['post_parent'] = $value->post_parent;
        $data[$key]['ID'] = $value->ID;
        $data[$key]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($id, 'thumbnail');
        $data[$key]['featured_image']['medium'] = get_the_post_thumbnail_url($id, 'medium');
        $data[$key]['featured_image']['large'] = get_the_post_thumbnail_url($id, 'large');
    }
    // array_multisort(array_column($data, "release_date_int"), SORT_DESC, $data);

    echo json_encode($data);
}

function topBrands()
{
    // global $fastsole;
    // $top_brands = $fastsole['top-brands'];
    // echo json_encode($top_brands);
    function wpsrc($id)
    {
        $image_full = wp_get_attachment_image_src($id, 'full', false);
        $image_large = wp_get_attachment_image_src($id, 'large', false);
        $image_medium = wp_get_attachment_image_src($id, 'medium', false);
        $image_medium_large = wp_get_attachment_image_src($id, 'medium_large', false);
        $image_thumbnail = wp_get_attachment_image_src($id, 'thumbnail', false);

        $final_src = $image_full[0] . ' ' . $image_full[1] . 'w' . ', ' . $image_large[0] . ' ' . $image_large[1] . 'w' . ', ' . $image_medium[0] . ' ' . $image_medium[1] . 'w' . ', ' . $image_medium_large[0] . ' ' . $image_medium_large[1] . 'w' . ', ' . $image_thumbnail[0] . ' ' . $image_thumbnail[1] . 'w';

        return $final_src;
    }

    global $fastsole;
    $top_brands = $fastsole['top-brands'];
    $result = array_slice($top_brands, 0, 25);

    $data = [];
    foreach ($result as $id => $value) {

        $data[$id]['title'] = $value['title'];
        $data[$id]['description'] = $value['description'];
        $data[$id]['url'] = $value['url'];
        $data[$id]['sort'] = $value['sort'];
        $data[$id]['attachment_id'] = $value['attachment_id'];
        $data[$id]['thumb'] = $value['thumb'];
        $data[$id]['image'] = $value['image'];
        $data[$id]['height'] = $value['height'];
        $data[$id]['width'] = $value['width'];
        $data[$id]['srcset'] = wpsrc($value['attachment_id']);
    }

    echo json_encode($data);
}

function recentNews()
{
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 8,

    );

    $news = new WP_Query($args);
    $news = $news->posts;
    $data = [];
    foreach ($news as $key => $value) {
        $id = $value->ID;
        $data[$key]['ID'] = $value->ID;
        $data[$key]['post_author'] = $value->post_author;
        $data[$key]['post_date_gmt'] = date("d M Y H:i A", strtotime($value->post_date_gmt));
        $data[$key]['post_content'] = $value->post_content;
        $data[$key]['post_title'] = $value->post_title;
        $data[$key]['post_excerpt'] = $value->post_excerpt;
        $data[$key]['post_status'] = $value->post_status;
        $data[$key]['comment_status'] = $value->comment_status;
        $data[$key]['ping_status'] = $value->ping_status;
        $data[$key]['post_name'] = $value->post_name;
        $data[$key]['post_parent'] = $value->post_parent;
        $data[$key]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($id, 'thumbnail');
        $data[$key]['featured_image']['medium'] = get_the_post_thumbnail_url($id, 'medium');
        $data[$key]['featured_image']['large'] = get_the_post_thumbnail_url($id, 'large');
    }
    echo json_encode($data);
}
function sneakerReleaseDate($slug)
{
    $slug = explode("-", $slug['slug']);
    $terms = $slug[0];
    $totalPosts = $slug[1];

    $data = [];
    $avlPost = get_term($terms)->count;
    if ($avlPost <= $totalPosts) {
        $totalPosts = $avlPost;
    }

    $data['totalPost'] = $avlPost;
    //echo json_encode($term);
    //die();

    $args = array(
        'post_type' => 'sneaker',
        'showposts' => $totalPosts,
        'tax_query' => array(
            array(
                'taxonomy' => 'status',
                'field' => 'id',
                'terms' => $terms,
            ),
        ),
    );
    $query = new WP_Query($args);
    print_r($query);
    $query = $query->posts;

    $i = 0;
    foreach ($query as $value) {
        $id = $value->ID;
        $release_date = get_post_meta($id, '_sf_date', true);
        $release_time = get_post_meta($id, '_sf_time', true);

        $price = get_post_meta($id, '_sf_price', true);

        $esc_price = esc_html($price);

        $sneaker_status = get_post_meta($id, '_sf_instock', true);
        $data['post'][$i]['ID'] = $value->ID;
        $data['post'][$i]['release_date'] = ($release_date != null) ? date('D d M Y', $release_date) : "TBC";
        $data['post'][$i]['release_date_int'] = ($release_date != null) ? $release_date : 1;
        $data['post'][$i]['release_time'] = $release_time;
        $data['post'][$i]['price'] = $price;
        $data['post'][$i]['esc_price'] = $esc_price;

        $data['post'][$i]['sneaker_status'] = $sneaker_status;
        $data['post'][$i]['post_author'] = $value->post_author;
        $data['post'][$i]['post_title'] = $value->post_title;
        $data['post'][$i]['post_name'] = $value->post_name;
        $data['post'][$i]['post_parent'] = $value->post_parent;
        $data['post'][$i]['post_type'] = $value->post_type;

        $data['post'][$i]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($id, 'thumbnail');
        $data['post'][$i]['featured_image']['medium'] = get_the_post_thumbnail_url($id, 'medium');
        $data['post'][$i]['featured_image']['large'] = get_the_post_thumbnail_url($id, 'large');

        $i++;
    }

    echo json_encode($data);
}

function sneakerReleaseDateTest($slug)
{

    global $wpdb;
    // $slug['slug'] = "46-12-0-500-instock---black-20211008-20211018";
    $slug = explode("-", $slug['slug']);

    $terms = trim($slug[0]);

    $totalPosts = trim($slug[1]);
    $priceMin = trim($slug[2]);
    $priceMax = trim($slug[3]);
    $status = trim($slug[4]);
    $date = trim($slug[5]);
    $orderBy = trim($slug[6]);
    $color = strtolower($slug[7]);
    $startDate = trim($slug[8]);
    $endDate = trim($slug[9]);

    if (!empty($startDate) && !empty($endDate)) {
        $startDate = date("Y-m-d H:i:s", strtotime($startDate) + (3600 * 24));
        $endDate = date("Y-m-d H:i:s", strtotime($endDate) + (3600 * 24));
        $dateFilter = true;
    } else {
        $dateFilter = false;
    }

    if (!empty($date)) {
        $tempDate = str_split($date);
        $date = $tempDate[0] . $tempDate[1] . $tempDate[2] . $tempDate[3] . '-' . $tempDate[4] . $tempDate[5] . '-' . $tempDate[6] . $tempDate[7];
    }
    // $terms = $terms == 0 ? 'in-stock' : $terms;
    if ($terms == 0) {
        $avlPost = 2000;
    } else {
        $avlPost = get_term($terms)->count;
    }
    $firstPage = 0;



    if ($totalPosts == 32 && $color == '' && $dateFilter == false && $status == 'instock' && $priceMin == '' && $priceMax == '') {
        $args = array(
            'post_type' => 'sneaker',
            'showposts' => $totalPosts,
            'tax_query' => array(
                array(
                    'taxonomy' => 'department',
                    'field' => 'term_id',
                    'terms' => $terms,
                ),
                array(
                    'taxonomy' => 'status',
                    'field' => 'slug',
                    'terms' => 'in-stock',
                    'operator' => 'IN',
                ),
            ),
        );
    } else {
        $terms != 0 ?
            $args = array(
                'post_type' => 'sneaker',
                'showposts' => 1000,

                'tax_query' => array(
                    array(
                        'taxonomy' => 'department',
                        'field' => 'term_id',
                        'terms' => $terms,
                    ),
                ),
            ) : $args = array(
                'post_type' => 'sneaker',
                'post_status' => 'publish',
                'showposts' => 1000,
                'tax_query' => array(
                    /* array(
                    'taxonomy' => 'status',
                    'field' => 'slug',
                    'terms' => 'in-stock',
                    'operator' => 'IN',
                ), */),
            );
    }

    if ($status == 'comingsoon') {
        $args['tax_query'][] = array(
            'taxonomy' => 'status',
            'field' => 'slug',
            'terms' => 'coming-soon',
            'operator' => 'IN',
        );
    } elseif ($status == 'soldout') {
        $args['tax_query'][] = array(
            'taxonomy' => 'status',
            'field' => 'slug',
            'terms' => 'sold-out',
            'operator' => 'IN',
        );
    } elseif ($status == 'instock') {
        $args['tax_query'][] = array(
            'taxonomy' => 'status',
            'field' => 'slug',
            'terms' => 'in-stock',
            'operator' => 'IN',
        );
    } else {
        $args['tax_query'][] = array(
            'taxonomy' => 'status',
            'field' => 'slug',
            'terms' => 'in-stock',
            'operator' => 'IN',
        );
    }

    $timestamp1 = strtotime($startDate);
    $timestamp2 = strtotime($endDate);

    if ($dateFilter === true) {
        $args['meta_query'][] = array(
            'relation' => 'AND',
            array(
                'key' => '_sf_date',
                'value' => $timestamp1,
                'compare' => '>=',
            ),
            array(
                'key' => '_sf_date',
                'value' => $timestamp2,
                'compare' => '<=',

            ),
        );
    }

    if (!is_null($priceMin) && !is_null($priceMax) && !($priceMin == 0 && ($priceMax == 500 || $priceMax == 2000))) {
        $args['meta_query'][] = array(
            'relation' => 'AND',
            array(
                'key' => '_sf_price',
                'value' => $priceMin,
                'compare' => '>=',
                'type' => 'numeric',
            ),
            array(
                'key' => '_sf_price',
                'value' => $priceMax,
                'compare' => '<=',
                'type' => 'numeric',

            ),
        );
    }

    if ($color != null) {
        $args['tax_query'][] = array(
            'taxonomy' => 'colour',
            'field' => 'slug',
            'terms' => $color,
        );
    }

    if ($orderBy == 'releseDateAsc') {
        $args['order'] = 'ASC';
        $args['orderby'] = 'meta_value';
        $args['ignore_custom_sort'] = true;
        $args['meta_type'] = 'UNSIGNED';
        $args['meta_key'] = '_sf_date';
    } elseif ($orderBy == 'releseDateDesc') {
        $args['order'] = 'DESC';
        $args['orderby'] = 'meta_value';
        $args['ignore_custom_sort'] = true;
        $args['meta_type'] = 'UNSIGNED';
        $args['meta_key'] = '_sf_date';
    } elseif ($orderBy == 'priceLowToHigh') {
        $args['order'] = 'ASC';
        $args['orderby'] = 'meta_value';
        $args['ignore_custom_sort'] = true;
        $args['meta_type'] = 'UNSIGNED';
        $args['meta_key'] = '_sf_price';
    } elseif ($orderBy == 'priceHighToLow') {
        $args['order'] = 'DESC';
        $args['orderby'] = 'meta_value';
        $args['meta_key'] = '_sf_price';
        $args['ignore_custom_sort'] = true;
        $args['meta_type'] = 'UNSIGNED';
    } elseif ($orderBy == 'releaseThisWeek') {
        //$args['release_date_int'] >= strtotime("this week");
        $weekdates = getStartAndEndDate(date("W"), date("Y"));
        if (count($weekdates) > 0) {
            $startdate = strtotime($weekdates['start_date']);
            $enddate = strtotime($weekdates['end_date']);

            $args['meta_query'] = array(
                'relation' => 'AND',
                array(
                    'key' => '_sf_date',
                    'value' => $startdate,
                    'compare' => '>=',
                ),
                array(
                    'key' => '_sf_date',
                    'value' => $enddate,
                    'compare' => '<=',

                ),
            );
            $args['order'] = 'DESC';
            $args['orderby'] = 'meta_value';
            $args['ignore_custom_sort'] = true;
            $args['meta_type'] = 'UNSIGNED';
            $args['meta_key'] = '_sf_date';
        }
    } elseif ($terms != 0) {
        $args['order'] = 'DESC';
        $args['orderby'] = 'meta_value';
        $args['ignore_custom_sort'] = true;
        $args['meta_type'] = 'UNSIGNED';
        $args['meta_key'] = '_sf_date';
    }

    $query = new WP_Query($args);
    /*echo '<pre>';print_r($query);
    echo '</pre>';
    die(); */
    $query = $query->posts;

    /* echo "<br>Min ". $priceMin;
echo "<br>Max ". $priceMax;
echo "<br>Status ". $status;
echo "<br>Date ". $date;
echo "<br>orderby ". $orderBy;
echo "<br>color ". $color;
echo "<br>type ". $type;
echo "<br>dateFilter ". $dateFilter; */
    if ($priceMin == 0 && ($priceMax == 2000 || $priceMax == 500) && $status == 'instock'  && $date == '' && $orderBy == '' && $color == '' &&  $dateFilter == false) {
        //echo 'sssssssssssssss'.$landingflag;
        $argss = array(
            'post_type' => 'sneaker',
            'tax_query' => array(
                array(
                    'taxonomy' => 'status',
                    'field' => 'slug',
                    'terms' => 'in-stock',
                ),
                array(
                    'taxonomy' => 'department',
                    'field' => 'term_id',
                    'terms' => $terms,
                ),
            ),
        );
        $query2 = new WP_Query($argss);
        $final_merge_arr = array_merge($query2->posts, $query);
        $temp = array_unique(array_column($final_merge_arr, 'ID'));
        $query = array_intersect_key($final_merge_arr, $temp);
        //print_r(count($query)); 

    } elseif ($priceMin == 0 && $priceMax == 2000 && $status == 'comingsoon'  && $date == '' && $orderBy == '' && $color == '' &&  $dateFilter == false) {
        //echo 'Comingsssssssssssssss'.$landingflag;

        $argss = array(
            'post_type' => 'sneaker',
            'tax_query' => array(
                array(
                    'taxonomy' => 'status',
                    'field' => 'slug',
                    'terms' => 'coming-soon',

                ),
            ),
        );
        $query2 = new WP_Query($argss);
        $final_merge_arr = array_merge($query2->posts, $query);
        // $input = array_map("unserialize", array_unique(array_map("serialize", $final_merge_arr)));
        $temp = array_unique(array_column($final_merge_arr, 'ID'));
        $query = array_intersect_key($final_merge_arr, $temp);
    }

    //print_r($query);
    //die();



    $dataArr = [];
    $i = 0;
    foreach ($query as $value) {
        $id = $value->ID;
        $new_slug = str_replace(home_url(), '', get_post_permalink($id));

        $postMeta = get_post_meta($id);

        $release_date = $postMeta['_sf_date'][0];
        $release_time = $postMeta['_sf_time'][0];

        $price = $postMeta['_sf_price'][0];

        $esc_price = esc_html($price);

        $sneaker_status = $postMeta['_sf_instock'][0];

        $checkStatus = str_replace("_", '', $sneaker_status);
        $checkDate = date("Y-m-d", $release_date);

        $tempArr = [];

        $date = date("Y-m-d", $release_date);
        $tempArr['ID'] = $value->ID;
        $tempArr['slug'] = $new_slug;
        $tempArr['release_date'] = ($release_date != null) ? date('D d M Y', $release_date) : "TBC";
        $tempArr['release_date_int'] = ($release_date != null) ? $release_date : 0;
        $tempArr['date'] = ($release_date != null) ? date("Y-m-d", $release_date) : 0;
        $tempArr['release_time'] = $release_time;
        $tempArr['price'] = $price;
        $tempArr['esc_price'] = $esc_price;

        $tempArr['sneaker_status'] = $sneaker_status;
        $tempArr['post_author'] = $value->post_author;
        $tempArr['post_title'] = $value->post_title;
        $tempArr['post_name'] = $value->post_name;
        $tempArr['post_parent'] = $value->post_parent;
        $tempArr['post_type'] = $value->post_type;
        $tempArr['img'] = get_the_post_thumbnail_url($id, 'medium');
        $tempArr['featured_image']['thumbnail'] = get_the_post_thumbnail_url($id, 'thumbnail');
        $tempArr['featured_image']['medium'] = get_the_post_thumbnail_url($id, 'medium');
        $tempArr['featured_image']['large'] = get_the_post_thumbnail_url($id, 'large');
        //array_push($dataArr, $tempArr);
        if ($i == $totalPosts) {
            break;
        }
        array_push($dataArr, $tempArr);
        $i++;
    }
    //print_r($dataArr);

    /* $i = 0;
    $finalArr = [];
    foreach ($dataArr as $value) {
    if ($i == $totalPosts) {
    break;
    }
    array_push($finalArr, $value);

    $i++;
    } */
    $data['totalPost'] = sizeof($query);

    /*  $data['totalPost'] = sizeof($dataArr);
    sizeof($dataArr);
    if($firstPage > 0){
    $data['totalPost'] = $firstPage;
    } */
    $data['post'] = $dataArr;
    echo json_encode($data);

    function releaseThisWeek($arr)
    {
        global $firstdayOfWeek;
        return ($arr['release_date_int'] >= $firstdayOfWeek);
    }
}



function colour()
{
    $terms = get_terms('colour', 'orderby=name&hide_empty=1');
    $data = [];
    $i = 0;
    foreach ($terms as $value) {
        $data[$i]['term_id'] = $value->term_id;
        $data[$i]['name'] = $value->name;
        $data[$i]['slug'] = $value->slug;
        $data[$i]['term_taxonomy_id'] = $value->term_taxonomy_id;
        $i++;
    }
    echo json_encode($data);
}

function stocks()
{
    $terms = get_terms('status', 'orderby=name&hide_empty=1');
    $data = [];
    $i = 0;
    foreach ($terms as $value) {
        $data[$i]['term_id'] = $value->term_id;
        $data[$i]['name'] = $value->name;
        $data[$i]['slug'] = $value->slug;
        $data[$i]['term_taxonomy_id'] = $value->term_taxonomy_id;
        $i++;
    }

    echo json_encode($data);
}

function brands()
{
    $terms = get_terms('department', 'orderby=none&hide_empty=1');
    $data = [];
    $i = 0;
    foreach ($terms as $value) {

        $barnd = $value->slug;

        // if ($barnd == 'nike' || $barnd == 'adidas' || $barnd == 'yeezy' || $barnd == 'nikelab' || $barnd == 'asics' || $barnd == 'puma' || $barnd == 'reebok' || $barnd == 'saucony' || $barnd == 'new-balance' || $barnd == 'converse' || $barnd == 'air-vapormax' || $barnd == 'ultra-boost') {
        $parent = $value->parent;
        if ($parent == 0) {
            $data[$i]['term_id'] = $value->term_id;
            $data[$i]['name'] = $value->name;
            $data[$i]['slug'] = $value->slug;
            $data[$i]['term_taxonomy_id'] = $value->term_taxonomy_id;
            $i++;
        }

        // }
    }

    echo json_encode($data);
}

function onfocusItems($slug)
{
    global $wpdb;
    $slug = explode("-", $slug['slug']);
    $terms = $slug[0];
    $totalPosts = $slug[1];
    $priceMin = $slug[2];
    $priceMax = $slug[3];
    $status = $slug[4];
    $date = $slug[5];
    $type = $slug[6];
    $orderBy = $slug[7];
    $color = strtolower($slug[8]);
    $startDate = $slug[9];
    $endDate = $slug[10];

    if (!empty($date)) {
        $tempDate = str_split($date);
        $date = $tempDate[0] . $tempDate[1] . $tempDate[2] . $tempDate[3] . '-' . $tempDate[4] . $tempDate[5] . '-' . $tempDate[6] . $tempDate[7];
    }

    if (!empty($startDate) && !empty($endDate)) {
        $startDate = date("Y-m-d H:i:s", strtotime($startDate) + (3600 * 24));
        $endDate = date("Y-m-d H:i:s", strtotime($endDate) + (3600 * 24));
        $dateFilter = true;
    } else {
        $dateFilter = false;
    }

    if ($type == 'onfocus') {
        $status = 'on-focus';
        $filedName = 'id';
        $typeName = "status";
    } elseif ($type == 'comingsoon') {
        $filedName = 'id';
        $typeName = "status";
    } else {
        $filedName = 'term_id';
        $typeName = "department";
    }

    $avlPost = get_term($terms)->count;
    if ($totalPosts == 32 && $color == '' && $dateFilter == false && $status == 'instock' && $priceMin == '' && $priceMax == '') {
        //echo '000000000000';
        $args = array(
            'post_type' => 'sneaker',
            'post_status' => 'publish',
            'showposts' => $totalPosts,
            'tax_query' => array(),
        );
    } else {
       
        $args = array(
            'post_type' => 'sneaker',
            'post_status' => 'publish',
            'showposts' => 1000,
            'tax_query' => array(),
        );
    }
    
    if ($status == 'comingsoon') {
        $args['tax_query'][] = array(
            'taxonomy' => 'status',
            'field' => 'slug',
            'terms' => 'coming-soon',
            'operator' => 'IN',
        );
    } elseif ($status == 'soldout') {
        $args['tax_query'][] = array(
            'taxonomy' => 'status',
            'field' => 'slug',
            'terms' => 'sold-out',
            'operator' => 'IN',
        );
    } elseif ($status == 'instock') {
        
        $args['tax_query'][] = array(
            'taxonomy' => 'status',
            'field' => 'slug',
            'terms' => 'in-stock',
            'operator' => 'IN',
        );
    } elseif ($status == 'on-focus') {
        
        $args['tax_query'][] = array(
            'taxonomy' => 'status',
            'field' => 'slug',
            'terms' => array('on-focus'),
            'operator' => 'IN',
        );
    } else {
        $args['tax_query'][] = array(
            'taxonomy' => 'status',
            'field' => 'slug',
            'terms' => 'in-stock',
            'operator' => 'IN',
        );
    }

    $timestamp1 = strtotime($startDate);
    $timestamp2 = strtotime($endDate);

    if ($dateFilter == true) {
        $args['meta_query'][] = array(
            'relation' => 'AND',
            array(
                'key' => '_sf_date',
                'value' => $timestamp1,
                'compare' => '>=',
            ),
            array(
                'key' => '_sf_date',
                'value' => $timestamp2,
                'compare' => '<=',
            ),
        );
    }

    if (!is_null($priceMin) && !is_null($priceMax) && !($priceMin == 0 && ($priceMax == 500 || $priceMax == 2000))) {
        $args['meta_query'][] = array(
            'relation' => 'AND',
            array(
                'key' => '_sf_price',
                'value' => $priceMin,
                'compare' => '>=',
                'type' => 'numeric',
            ),
            array(
                'key' => '_sf_price',
                'value' => $priceMax,
                'compare' => '<=',
                'type' => 'numeric',

            ),
        );
    }

    if ($color != null) {
        $args['tax_query'][] = array(
            'taxonomy' => 'colour',
            'field' => 'slug',
            'terms' => $color,
        );
    }

    if ($orderBy == 'releseDateAsc') {
        $args['order'] = 'ASC';
        $args['orderby'] = 'meta_value';
        $args['ignore_custom_sort'] = true;
        $args['meta_type'] = 'UNSIGNED';
        $args['meta_key'] = '_sf_date';
    } elseif ($orderBy == 'releseDateDesc') {
        $args['order'] = 'DESC';
        $args['orderby'] = 'meta_value';
        $args['ignore_custom_sort'] = true;
        $args['meta_type'] = 'UNSIGNED';
        $args['meta_key'] = '_sf_date';
    } elseif ($orderBy == 'priceLowToHigh') {
        $args['order'] = 'ASC';
        $args['orderby'] = 'meta_value';
        $args['ignore_custom_sort'] = true;
        $args['meta_type'] = 'UNSIGNED';
        $args['meta_key'] = '_sf_price';
    } elseif ($orderBy == 'priceHighToLow') {
        $args['order'] = 'DESC';
        $args['orderby'] = 'meta_value';
        $args['meta_key'] = '_sf_price';
        $args['ignore_custom_sort'] = true;
        $args['meta_type'] = 'UNSIGNED';
    } elseif ($orderBy == 'releaseThisWeek') {
        //$args['release_date_int'] >= strtotime("this week");
        $weekdates = getStartAndEndDate(date("W"), date("Y"));
        if (count($weekdates) > 0) {
            $startdate = strtotime($weekdates['start_date']);
            $enddate = strtotime($weekdates['end_date']);

            $args['meta_query'] = array(
                'relation' => 'AND',
                array(
                    'key' => '_sf_date',
                    'value' => $startdate,
                    'compare' => '>=',
                ),
                array(
                    'key' => '_sf_date',
                    'value' => $enddate,
                    'compare' => '<=',

                ),
            );
            $args['order'] = 'DESC';
            $args['orderby'] = 'meta_value';
            $args['ignore_custom_sort'] = true;
            $args['meta_type'] = 'UNSIGNED';
            $args['meta_key'] = '_sf_date';
        }
    } elseif ($terms != 0) {
        $args['order'] = 'DESC';
        $args['orderby'] = 'meta_value';
        $args['ignore_custom_sort'] = true;
        $args['meta_type'] = 'UNSIGNED';
        $args['meta_key'] = '_sf_date';
    }

    //echo '<pre>';
    //print_r($args);
    $query = new WP_Query($args);
    $query = $query->posts;

    // die();

    /*  echo "<br>". $priceMin;
echo "<br>". $priceMax;
echo "<br>". $status;
echo "<br>". $date;
echo "<br>". $orderBy;
echo "<br>". $color;
echo "<br>". $type;
echo "<br>". $startDate;
echo "<br>". $endDate;  */
    if ($priceMin == 0 && $priceMax == 500 && $status == 'comingsoon' && $date == '' && $orderBy == '' && $color == '' && $type == 'comingsoon' && $dateFilter == false) {
        $argss = array(
            'post_type' => 'sneaker',
            'tax_query' => array(
                array(
                    'taxonomy' => 'status',
                    'field' => 'slug',
                    'terms' => 'coming-soon',
                    'operator' => 'IN',
                ),
            ),
        );
        $query2 = new WP_Query($argss);
        $final_merge_arr = array_merge($query2->posts, $query);
        // $input = array_map("unserialize", array_unique(array_map("serialize", $final_merge_arr)));
        $temp = array_unique(array_column($final_merge_arr, 'ID'));
        $query = array_intersect_key($final_merge_arr, $temp);
    } else if ($priceMin == 0 && $priceMax == 500 && $status == 'instock' && $date == '' && $orderBy == '' && $color == '' && $type == 'onfocus' && $dateFilter == false) {
        $argss = array(
            'post_type' => 'sneaker',
            'tax_query' => array(
                array(
                    'taxonomy' => 'status',
                    'field' => 'slug',
                    'terms' => 'in-stock',
                ),
            ),
        );
        $query2 = new WP_Query($argss);
        $final_merge_arr = array_merge($query2->posts, $query);
        // $input = array_map("unserialize", array_unique(array_map("serialize", $final_merge_arr)));
        $temp = array_unique(array_column($final_merge_arr, 'ID'));
        $query = array_intersect_key($final_merge_arr, $temp);
    }

    $dataArr = [];
    $i = 0;
    foreach ($query as $value) {
        $id = $value->ID;
        $new_slug = str_replace(home_url(), '', get_post_permalink($id));

        $postMeta = get_post_meta($id);

        $release_date = $postMeta['_sf_date'][0];
        $release_time = $postMeta['_sf_time'][0];

        $price = $postMeta['_sf_price'][0];

        $esc_price = esc_html($price);

        $sneaker_status = $postMeta['_sf_instock'][0];

        $checkStatus = str_replace("_", '', $sneaker_status);
        $checkDate = date("Y-m-d", $release_date);

        /* $result = $wpdb->get_results("SELECT t.*, tt.* FROM wpfs_terms AS t INNER JOIN wpfs_term_taxonomy AS tt ON t.term_id = tt.term_id INNER JOIN wpfs_term_relationships AS tr ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tt.taxonomy IN ('colour') AND tr.object_id IN ($id) ORDER BY t.name ASC");

        $colorArr = [''];

        foreach ($result as $val) {
        $colorName = strtolower($val->name);

        array_push($colorArr, $colorName);
        } */

        $tempArr = [];

        $date = date("Y-m-d", $release_date);

        $tempArr['ID'] = $value->ID;
        $tempArr['slug'] = $new_slug;
        $tempArr['release_date'] = ($release_date != null) ? date('D d M Y', $release_date) : "TBC";
        $tempArr['release_date_int'] = ($release_date != null) ? $release_date : 0;
        $tempArr['date'] = ($release_date != null) ? date("Y-m-d", $release_date) : 0;
        $tempArr['release_time'] = $release_time;
        $tempArr['price'] = $price;
        $tempArr['esc_price'] = $esc_price;

        $tempArr['sneaker_status'] = $sneaker_status;
        $tempArr['post_author'] = $value->post_author;
        $tempArr['post_title'] = $value->post_title;
        $tempArr['post_name'] = $value->post_name;
        $tempArr['post_parent'] = $value->post_parent;
        $tempArr['post_type'] = $value->post_type;
        $tempArr['img'] = get_the_post_thumbnail_url($id, 'medium');
        $tempArr['featured_image']['thumbnail'] = get_the_post_thumbnail_url($id, 'thumbnail');
        $tempArr['featured_image']['medium'] = get_the_post_thumbnail_url($id, 'medium');
        $tempArr['featured_image']['large'] = get_the_post_thumbnail_url($id, 'large');
        $tempArr['color'] = $colorArr;

        if ($i == $totalPosts) {
            break;
        }
        array_push($dataArr, $tempArr);
        $i++;
    }

    /* $i == 0;
    $finalArr = [];
    foreach ($dataArr as $value) {

    array_push($finalArr, $value);
    if ($i == $totalPosts) {
    break;
    }
    $i++;
    } */

    $data['totalPost'] = sizeof($query);
    $data['post'] = $dataArr;

    echo json_encode($data);

    function releaseThisWeek($arr)
    {
        global $firstdayOfWeek;
        return ($arr['release_date_int'] >= $firstdayOfWeek);
    }
}

function comingSoonItems()
{
    $totalPosts = get_term(45)->count;

    $args = array(
        'post_type' => 'sneaker',
        'showposts' => 1000,
        'tax_query' => array(
            array(
                'taxonomy' => 'status',
                'field' => 'id',
                'terms' => 45,
            ),
        ),
    );

    $query = new WP_Query($args);
    //echo '<pre>';
    //print_r($query);
    $query = $query->posts;

    $data = [];
    foreach ($query as $key => $value) {
        $id = $value->ID;
        $new_slug = str_replace(home_url(), '', get_post_permalink($id));

        // this section is only for finding price and stock availability
        $release_date = get_post_meta($id, '_sf_date', true);
        $release_time = get_post_meta($id, '_sf_time', true);

        $price = get_post_meta($id, '_sf_price', true);

        $esc_price = esc_html($price);

        $sneaker_status = get_post_meta($id, '_sf_instock', true);

        $data[$key]['release_date'] = ($release_date != null) ? date('D d M Y', $release_date) : "TBC";
        $data[$key]['release_date_int'] = ($release_date != null) ? $release_date : 0;
        $data[$key]['release_time'] = $release_time;
        $data[$key]['price'] = $price;
        $data[$key]['esc_price'] = $esc_price;
        $data[$key]['sneaker_status'] = $sneaker_status;
        $data[$key]['img'] = get_the_post_thumbnail_url($id, 'medium');

        $data[$key]['ID'] = $value->ID;
        $data[$key]['slug'] = $new_slug;
        $data[$key]['post_author'] = $value->post_author;
        $data[$key]['post_date_gmt'] = date("d M Y H:i A", strtotime($value->post_date_gmt));
        // $data[$key]['post_content'] = $value->post_content;
        $data[$key]['post_title'] = 'abccd' . $value->post_title;
        // $data[$key]['post_excerpt'] = $value->post_excerpt;
        // $data[$key]['post_status'] = $value->post_status;
        // $data[$key]['ping_status'] = $value->ping_status;
        $data[$key]['post_name'] = $value->post_name;
        $data[$key]['post_type'] = $value->post_type;
        // $data[$key]['post_parent'] = $value->post_parent;
        $data[$key]['ID'] = $value->ID;
        $data[$key]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($id, 'thumbnail');
        $data[$key]['featured_image']['medium'] = get_the_post_thumbnail_url($id, 'medium');
        $data[$key]['featured_image']['large'] = get_the_post_thumbnail_url($id, 'large');
    }

    echo json_encode($data);
}

function buyFromHere($slug)
{
    $getId = $slug['slug'];
    // $getId = 155069;

    $entries = get_post_meta($getId, '_sf_affilate_group', true);

    // echo json_encode($entries);

    $data = [];
    $i = 0;
    foreach ($entries as $key => $entry) {

        $affilate_post_id = $entry['affilate_title'];

        $launch_date = $entry['launch_date'];
        if ($launch_date == null) {
            $launch_date = "TBC";
        } else {
            $launch_date = date('D d M Y', $launch_date);
        }
        $launch_time = $entry['launch_time'];
        $launch_status = $entry['launch_status'];

        if (!empty($entry['affilate_link'])) {

            $meta_key = "_afflink_{$affilate_post_id}";
            $aff_link = get_post_meta($getId, $meta_key, true);
        } else {

            $aff_link = get_post_meta($affilate_post_id, '_sf_default_link', true);
        }

        // echo $thumnail = get_the_post_thumbnail($affilate_post_id, 'post-thumb', array('class' => "img-responsive",));
        $thumbnail = get_the_post_thumbnail_url($affilate_post_id, 'medium');

        if ($launch_status == "coming_soon") :
            $stockStatus = "Coming Soon";

        elseif ($launch_status == "tbc") :
            $stockStatus = "TBC";

        elseif ($launch_status == "instock") :
            $stockStatus = "In Stock";

        elseif ($launch_status == "restock") :
            $stockStatus = "Re Stock";

        elseif ($launch_status == "delayed") :
            $stockStatus = "Reseller:";

        elseif ($launch_status == "sold_out") :
            $stockStatus = "Sold Out";

        elseif ($launch_status == "raffle") :
            $stockStatus = "Raffle";

        endif;

        // buy link and visit website
        if ($launch_status == "instock" || $launch_status == "restock" || $launch_status == "delayed") :
            $buttonName = "Buy Now";

        elseif ($launch_status == "sold_out") :
            $buttonName = "Visit Website";

        else :
            $buttonName = "Visit Website";

        endif;

        $data[$i]['shopLogo'] = $thumbnail;
        $data[$i]['statusButton'] = $buttonName;
        $data[$i]['affiliateUrl'] = $aff_link;
        $data[$i]['stockStatus'] = $stockStatus;

        $i++;
    }
    echo json_encode($data);
}

function brandsReleatedPost($slug)
{
    $slug = explode("-", $slug['slug']);
    $terms = $slug[0];
    $totalPosts = $slug[1];

    $data = [];
    $avlPost = get_term($terms)->count;
    if ($avlPost <= $totalPosts) {
        $totalPosts = $avlPost;
    }

    $data['totalPost'] = $avlPost;
    // echo json_encode($term);
    // die();

    $args = array(
        'post_type' => 'sneaker',
        'showposts' => $totalPosts,

        'tax_query' => array(

            array(
                'taxonomy' => 'department',
                'field' => 'term_id',
                'terms' => $terms,

            ),

        ),

    );
    $query = new WP_Query($args);
    $query = $query->posts;

    $i = 0;
    foreach ($query as $value) {
        $id = $value->ID;
        $new_slug = str_replace(home_url(), '', get_post_permalink($id));
        $release_date = get_post_meta($id, '_sf_date', true);
        $release_time = get_post_meta($id, '_sf_time', true);

        $price = get_post_meta($id, '_sf_price', true);

        $esc_price = esc_html($price);

        $sneaker_status = get_post_meta($id, '_sf_instock', true);
        $data['post'][$i]['ID'] = $value->ID;
        $data['post'][$i]['slug'] = $new_slug;
        $data['post'][$i]['release_date'] = ($release_date != null) ? date('D d M Y', $release_date) : "TBC";
        $data['post'][$i]['release_date_int'] = ($release_date != null) ? $release_date : 0;
        $data['post'][$i]['release_time'] = $release_time;
        $data['post'][$i]['price'] = $price;
        $data['post'][$i]['esc_price'] = $esc_price;

        $data['post'][$i]['sneaker_status'] = $sneaker_status;
        $data['post'][$i]['post_author'] = $value->post_author;
        $data['post'][$i]['post_title'] = $value->post_title;
        $data['post'][$i]['post_name'] = $value->post_name;
        $data['post'][$i]['post_parent'] = $value->post_parent;
        $data['post'][$i]['post_type'] = $value->post_type;

        $data['post'][$i]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($id, 'thumbnail');
        $data['post'][$i]['featured_image']['medium'] = get_the_post_thumbnail_url($id, 'medium');
        $data['post'][$i]['featured_image']['large'] = get_the_post_thumbnail_url($id, 'large');

        $i++;
    }

    echo json_encode($data);
}

function brandItems($slug)
{
    global $wpdb;
    $slug = $slug['slug'];
    // $slug = 'air-jordan';
    // $totalPosts = get_term($getId)->count;

    $args = array(
        'post_type' => 'sneaker',
        'posts_per_page' => 100,
        'tax_query' => array(

            array(
                'taxonomy' => 'department',
                'field' => 'slug',
                'terms' => $slug,
            ),

        ),

    );

    $query = new WP_Query($args);
    $data = [];
    $children = [];

    // echo "<pre>";
    // print_r($query);
    // die();

    $itemName = $query->queried_object->name;
    $term_taxonomy_id = $query->queried_object->term_id;
    $taxonomy = $query->queried_object->taxonomy;
    $description_data = $query->queried_object->description;
    $description = '<p>' . preg_replace('/(\r\n\r\n|\r\r|\n\n)+/', '</p><p>', $description_data) . '</p>';
    //echo 'ttttttttttt';print_r('<p>' .preg_replace('/(\r\n\r\n|\r\r|\n\n)+/', '</p><p>', $description) . '</p>');

    //for brand image query using taxonomy

    $result = $wpdb->get_results("SELECT meta_value FROM `wpfs_termmeta` WHERE `term_id` = '$term_taxonomy_id' and meta_key = 'brand_image'");

    if (count($result) == 0) {
        $siteUrl = get_site_url();
        $data['brandImage'] = "https://fastsole.co.uk/wp-content/uploads/2022/01/adidas-150x100-1.png";
    } else {
        $image_link = wp_get_attachment_image_src($result[0]->meta_value);
        $data['brandImage'] = $image_link[0];
    }

    //end of the banner image

    //for cover image query using taxonomy

    $result = $wpdb->get_results("SELECT meta_value FROM `wpfs_termmeta` WHERE `term_id` = '$term_taxonomy_id' and meta_key = 'cover_image'");

    if (count($result) == 0) {
        $siteUrl = get_site_url();
        $data['coverImage'] = "https://fastsole.co.uk/wp-content/uploads/2022/01/33.png";
    } else {
        $image_link = wp_get_attachment_image_src($result[0]->meta_value, 'full');
        $data['coverImage'] = $image_link[0];
    }

    //end of the cover image image

    // childern of terms
    $termchildren = get_term_children($term_taxonomy_id, $taxonomy);

    // echo json_encode($termchildren);
    // die();

    // echo '<ul>';
    $i = 0;
    foreach ($termchildren as $child) {
        $term = get_term_by('id', $child, $taxonomy);
        $result = $wpdb->get_results("SELECT meta_value FROM `wpfs_termmeta` WHERE `term_id` = '$child' and meta_key = 'brand_image'");
        $children['children'][$i]['id'] = $child;
        $children['children'][$i]['url'] = get_term_link($child, $taxonomy_name);
        $children['children'][$i]['termName'] = $term->name;
        $children['children'][$i]['termSlug'] = $term->slug;
        //return brand image of sub-brand
        if (count($result) == 0) {
            $siteUrl = get_site_url();
            $children['children'][$i]['brandImage'] = "https://fastsole.co.uk/wp-content/uploads/2022/01/adidas-150x100-1.png";
        } else {
            $image_link = wp_get_attachment_image_src($result[0]->meta_value);
            $children['children'][$i]['brandImage'] = $image_link[0];
        }
        // end of the sub brand image

        $i++;
    }

    $children['post']['itemName'] = $itemName;
    $children['post']['term_taxonomy_id'] = $term_taxonomy_id;
    $children['post']['taxonomy'] = $taxonomy;
    $children['post']['description'] = $description;

    $data['releatedItems'] = $children;
    $query = $query->posts;

    $i = 0;
    foreach ($query as $value) {
        $ID = $value->ID;
        $new_slug = str_replace(home_url(), '', get_post_permalink($post_id));

        $release_date = get_post_meta($ID, '_sf_date', true);
        $release_time = get_post_meta($ID, '_sf_time', true);

        $price = get_post_meta($ID, '_sf_price', true);

        $esc_price = esc_html($price);

        $sneaker_status = get_post_meta($ID, '_sf_instock', true);

        $post_author = $value->post_author;
        $post_date = $value->post_date;
        $post_title = $value->post_title;
        $post_name = $value->post_name;
        $img = get_the_post_thumbnail_url($ID, 'medium');

        $data['post'][$i]['id'] = $ID;
        $data['post'][$i]['slug'] = $new_slug;
        $data['post'][$i]['post_author'] = $post_author;
        $data['post'][$i]['release_date'] = ($release_date != null) ? date('D d M Y', $release_date) : "TBC";
        $data['post'][$i]['release_date_int'] = ($release_date != null) ? $release_date : 0;

        $data['post'][$i]['release_time'] = $release_time;
        $data['post'][$i]['post_date'] = $post_date;
        $data['post'][$i]['post_title'] = $post_title;
        $data['post'][$i]['post_name'] = $post_name;
        $data['post'][$i]['img'] = $img;
        $data['post'][$i]['price'] = $price;
        $data['post'][$i]['esc_price'] = $esc_price;
        $data['post'][$i]['sneaker_status'] = $sneaker_status;
        $data['post'][$i]['esc_price'] = $esc_price;

        $i++;
    }

    $tempChildId = $data['post'][0]['id'];

    $result_department = $wpdb->get_results("SELECT t.*, tt.* FROM wpfs_terms AS t INNER JOIN wpfs_term_taxonomy AS tt ON t.term_id = tt.term_id INNER JOIN wpfs_term_relationships AS tr ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tt.taxonomy IN ('department') AND tr.object_id IN ($tempChildId) ORDER BY t.term_id DESC;");

    $parent_arr = [];

    $mainArr = [];

    foreach ($result_department as $val) {
        $parent = $val->parent;
        $name = $val->name;
        $slug = $val->slug;
        $termId = $val->term_id;

        if ($parent == 0) {
            $parent_arr[$parent] = [
                'name' => $name,
                'child' => $termId,
                'slug' => $slug,
            ];
        } else {
            $mainArr[$parent] = [
                'name' => $name,
                'child' => $termId,
                'slug' => $slug,

            ];
        }
    }

    $status = true;
    $i = 0;
    while ($status == true) {
        $status = false;
        $child = $parent_arr[$i]['child'];
        $tempArr = [
            'name' => $mainArr[$child]['name'],
            'child' => $mainArr[$child]['child'],
            'slug' => $mainArr[$child]['slug'],
        ];
        array_push($parent_arr, $tempArr);
        unset($mainArr[$child]);

        if (!empty($mainArr)) {
            $status = true;
        } else {
            $status = false;
            break;
        }

        $i++;
    }

    $data['categories'] = $parent_arr;

    echo json_encode($data);
}

function mainBrands()
{
    global $wpdb;

    $parentCategory = [];

    $terms = get_terms('department', 'orderby=name&hide_empty=1');
    foreach ($terms as $val) {
        $parentId = $val->parent;
        if ($parentId == 0) {
            array_push($parentCategory, $val->term_id);
        }
    }
    $mainBrand = [];
    $subBrand = [];
    $i = 0;
    foreach ($terms as $val) {
        $termId = $val->term_id;
        $name = $val->name;
        $slug = $val->slug;
        $itemCount = $val->count;
        $taxonomy = $val->taxonomy;
        $parentId = $val->parent;
        if (in_array($termId, $parentCategory)) {
            $tempArr = [
                'termId' => $termId,
                'name' => $name,
                'slug' => $slug,
                'itemCount' => $itemCount,
                'taxonomy' => $taxonomy,
                'logo' => '',

            ];
            array_push($mainBrand, $tempArr);
        }
        if (!in_array($termId, $parentCategory)) {
            if (array_key_exists($parentId, $subBrand)) {
                $tempArr = [
                    'termId' => $termId,
                    'name' => $name,
                    'slug' => $slug,
                    'itemCount' => $itemCount,
                    'taxonomy' => $taxonomy,
                    'logo' => '',

                ];
                // $totalLength = sizeof($subBrand[$parentId]);
                // $i = ($i > 0) ? $totalLength - 1 : 0;
                $subBrand[$parentId][$i] = $tempArr;
                // $i++;
            } else {
                // $i = 0;
                $tempArr = [
                    'termId' => $termId,
                    'name' => $name,
                    'slug' => $slug,
                    'itemCount' => $itemCount,
                    'taxonomy' => $taxonomy,
                    'logo' => '',

                ];
                $subBrand[$parentId][$i] = $tempArr;
                // $i++;
            }
            $i++;
        }
    }

    $brandImgStr = "";
    foreach ($terms as $val) {
        $termId = $val->term_id;
        $name = $val->name;
        $slug = $val->slug;
        $itemCount = $val->count;
        $taxonomy = $val->taxonomy;
        $parentId = $val->parent;
        if (!array_key_exists($parentId, $mainBrand) && array_key_exists($termId, $subBrand)) {
            $tempArr = [
                'termId' => $termId,
                'name' => $name,
                'slug' => $slug,
                'itemCount' => $itemCount,
                'taxonomy' => $taxonomy,
                'logo' => '',
            ];
            array_push($mainBrand, $tempArr);
        }
        $brandImgStr .= $termId . ',';
    }

    $brandImgStr = rtrim($brandImgStr, ",");

    //$result = $wpdb->get_results("SELECT meta_value,term_id FROM `wpfs_termmeta` WHERE `term_id` = '$brandImgStr' and meta_key = 'brand_image'");
    $result = $wpdb->get_results("SELECT meta_value,term_id FROM `wpfs_termmeta` WHERE `term_id` IN($brandImgStr) and meta_key = 'brand_image'");

    $tempArr = [];
    /* echo '<pre>result===';
    print_r($result);
    echo '</pre>'; */
    foreach ($result as $val) {
        $termId = $val->term_id;
        $meta_value = $val->meta_value;
        $tempArr[$termId] = $meta_value;
    }

    $parentBrand = [];

    foreach ($mainBrand as $value) {
        $termId = $value['termId'];

        if (array_key_exists($termId, $tempArr)) {
            $image_link = wp_get_attachment_image_src($tempArr[$termId]);
            $brandImg = $image_link[0];
        } else {
            $siteUrl = get_site_url();
            $brandImg = "$siteUrl/wp-content/uploads/2022/05/placeholder_image.png";
        }

        /*  if (array_key_exists($termId, $subBrand)) {
           
            $tempArr = [
                'termId' => $termId,
                'name' => $value['name'],
                'slug' => $value['slug'],
                'itemCount' => $value['itemCount'],
                'taxonomy' => $value['taxonomy'],
                'logo' => $brandImg,
                'subBrand' => $subBrand[$termId],
            ];
            array_push($parentBrand, $tempArr1);
        } else {
            $tempArr = [
                'termId' => $termId,
                'name' => $value['name'],
                'slug' => $value['slug'],
                'itemCount' => $value['itemCount'],
                'taxonomy' => $value['taxonomy'],
                'logo' => $brandImg,
                'subBrand' => "",
            ];

            array_push($parentBrand, $tempArr);
        }*/
        if (array_key_exists($termId, $subBrand)) {
            $tempArr1 = [
                'termId' => $termId,
                'name' => $value['name'],
                'slug' => $value['slug'],
                'itemCount' => $value['itemCount'],
                'taxonomy' => $value['taxonomy'],
                'logo' => $brandImg,
                'subBrand' => $subBrand[$termId],
            ];
        } else {
            $tempArr1 = [
                'termId' => $termId,
                'name' => $value['name'],
                'slug' => $value['slug'],
                'itemCount' => $value['itemCount'],
                'taxonomy' => $value['taxonomy'],
                'logo' => $brandImg,
                'subBrand' => '',
            ];
        }
        array_push($parentBrand, $tempArr1);
    }
    echo json_encode($parentBrand);
}
function searchModules($slug)
{
    global $wpdb;
    // $slug['slug'] = "puma-12-0-500-instock----20201231-20210115";
    $slug = explode("-", $slug['slug']);
    $terms = $slug[0];
    $totalPosts = $slug[1];
    $priceMin = $slug[2];
    $priceMax = $slug[3];
    $status = $slug[4];
    $date = $slug[5];
    $orderBy = $slug[6];
    $color = strtolower($slug[7]);
    $startDate = trim($slug[8]);
    $endDate = trim($slug[9]);

    if (!empty($date)) {
        $tempDate = str_split($date);
        $date = $tempDate[0] . $tempDate[1] . $tempDate[2] . $tempDate[3] . '-' . $tempDate[4] . $tempDate[5] . '-' . $tempDate[6] . $tempDate[7];
    }

    if (!empty($startDate) && !empty($endDate)) {
        $startDate = date("Y-m-d H:i:s", strtotime($startDate) + (3600 * 24));
        $endDate = date("Y-m-d H:i:s", strtotime($endDate) + (3600 * 24));
        $dateFilter = true;
    } else {
        $dateFilter = false;
    }

    //print_r(html_entity_decode($terms));die();
    if ($totalPosts == 32 && $dateFilter == false && $status == 'instock' && $priceMin == '' && $priceMax == '') {
        $args = array(
            'post_type' => 'sneaker',
            //'s' => $terms,
            's' => str_replace('%20', ' ', $terms),
            'showposts' => $totalPosts,
            'tax_query' => array(
                'taxonomy' => 'department',
            ),
        );
    } else {
        $args = array(
            'post_type' => 'sneaker',
            //'s' => $terms,
            's' => str_replace('%20', ' ', $terms),
            'showposts' => 2000,
            'tax_query' => array(
                'taxonomy' => 'department',
            ),
        );
    }
    //print_r($args);

    if ($status == 'comingsoon') {
        $args['tax_query'][] = array(
            'taxonomy' => 'status',
            'field' => 'slug',
            'terms' => 'coming-soon',
            'operator' => 'IN',
        );
    } elseif ($status == 'soldout') {
        $args['tax_query'][] = array(
            'taxonomy' => 'status',
            'field' => 'slug',
            'terms' => 'sold-out',
            'operator' => 'IN',
        );
    } elseif ($status == 'instock') {
        $args['tax_query'][] = array(
            'taxonomy' => 'status',
            'field' => 'slug',
            'terms' => 'in-stock',
            'operator' => 'IN',
        );
    } else {
        $args['tax_query'][] = array(
            'taxonomy' => 'status',
            'field' => 'slug',
            'terms' => 'in-stock',
            'operator' => 'IN',
        );
    }

    $timestamp1 = strtotime($startDate);
    $timestamp2 = strtotime($endDate);

    if ($dateFilter === true) {
        $args['meta_query'][] = array(
            'relation' => 'AND',
            array(
                'key' => '_sf_date',
                'value' => $timestamp1,
                'compare' => '>=',
            ),
            array(
                'key' => '_sf_date',
                'value' => $timestamp2,
                'compare' => '<=',

            ),
        );
    }

    if (!is_null($priceMin) && !is_null($priceMax) && !($priceMin == 0 && ($priceMax == 500 || $priceMax == 2000))) {
        $args['meta_query'][] = array(
            'relation' => 'AND',
            array(
                'key' => '_sf_price',
                'value' => $priceMin,
                'compare' => '>=',
                'type' => 'numeric',
            ),
            array(
                'key' => '_sf_price',
                'value' => $priceMax,
                'compare' => '<=',
                'type' => 'numeric',

            ),
        );
    }


    if ($orderBy == 'releseDateAsc') {
        $args['order'] = 'ASC';
        $args['orderby'] = 'meta_value';
        $args['ignore_custom_sort'] = true;
        $args['meta_type'] = 'UNSIGNED';
        $args['meta_key'] = '_sf_date';
    } elseif ($orderBy == 'releseDateDesc') {
        $args['order'] = 'DESC';
        $args['orderby'] = 'meta_value';
        $args['ignore_custom_sort'] = true;
        $args['meta_type'] = 'UNSIGNED';
        $args['meta_key'] = '_sf_date';
    } elseif ($orderBy == 'priceLowToHigh') {
        $args['order'] = 'ASC';
        $args['orderby'] = 'meta_value';
        $args['ignore_custom_sort'] = true;
        $args['meta_type'] = 'UNSIGNED';
        $args['meta_key'] = '_sf_price';
    } elseif ($orderBy == 'priceHighToLow') {
        $args['order'] = 'DESC';
        $args['orderby'] = 'meta_value';
        $args['meta_key'] = '_sf_price';
        $args['ignore_custom_sort'] = true;
        $args['meta_type'] = 'UNSIGNED';
    } elseif ($orderBy == 'releaseThisWeek') {
        //$args['release_date_int'] >= strtotime("this week");
        $weekdates = getStartAndEndDate(date("W"), date("Y"));
        if (count($weekdates) > 0) {
            $startdate = strtotime($weekdates['start_date']);
            $enddate = strtotime($weekdates['end_date']);

            $args['meta_query'] = array(
                'relation' => 'AND',
                array(
                    'key' => '_sf_date',
                    'value' => $startdate,
                    'compare' => '>=',
                ),
                array(
                    'key' => '_sf_date',
                    'value' => $enddate,
                    'compare' => '<=',

                ),
            );
            $args['order'] = 'DESC';
            $args['orderby'] = 'meta_value';
            $args['ignore_custom_sort'] = true;
            $args['meta_type'] = 'UNSIGNED';
            $args['meta_key'] = '_sf_date';
        }
    } elseif ($terms != 0) {
        $args['order'] = 'DESC';
        $args['orderby'] = 'meta_value';
        $args['ignore_custom_sort'] = true;
        $args['meta_type'] = 'UNSIGNED';
        $args['meta_key'] = '_sf_date';
    }

    $query = new WP_Query($args);

    $query = $query->posts;

    $dataArr = [];
    $i = 0;
    foreach ($query as $value) {
        $id = $value->ID;
        $new_slug = str_replace(home_url(), '', get_post_permalink($id));

        $postMeta = get_post_meta($id);

        $release_date = $postMeta['_sf_date'][0];
        $release_time = $postMeta['_sf_time'][0];

        $price = $postMeta['_sf_price'][0];

        $esc_price = esc_html($price);

        $sneaker_status = $postMeta['_sf_instock'][0];

        $checkStatus = str_replace("_", '', $sneaker_status);
        $checkDate = date("Y-m-d", $release_date);

        /* $result = $wpdb->get_results("SELECT t.*, tt.* FROM wpfs_terms AS t INNER JOIN wpfs_term_taxonomy AS tt ON t.term_id = tt.term_id INNER JOIN wpfs_term_relationships AS tr ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tt.taxonomy IN ('colour') AND tr.object_id IN ($id) ORDER BY t.name ASC");

        $colorArr = [''];

        foreach ($result as $val) {
            $colorName = strtolower($val->name);

            array_push($colorArr, $colorName);
        } */

        $tempArr = [];
        $date = date("Y-m-d", $release_date);
        $tempArr['ID'] = $value->ID;
        $tempArr['slug'] = $new_slug;
        $tempArr['release_date'] = ($release_date != null) ? date('D d M Y', $release_date) : "TBC";
        $tempArr['release_date_int'] = ($release_date != null) ? $release_date : 0;
        $tempArr['date'] = ($release_date != null) ? date("Y-m-d", $release_date) : 0;
        $tempArr['release_time'] = $release_time;
        $tempArr['price'] = $price;
        $tempArr['esc_price'] = $esc_price;

        $tempArr['sneaker_status'] = $sneaker_status;
        $tempArr['post_author'] = $value->post_author;
        $tempArr['post_title'] = $value->post_title;
        $tempArr['post_name'] = $value->post_name;
        $tempArr['post_parent'] = $value->post_parent;
        $tempArr['post_type'] = $value->post_type;
        $tempArr['img'] = get_the_post_thumbnail_url($id, 'medium');
        $tempArr['featured_image']['thumbnail'] = get_the_post_thumbnail_url($id, 'thumbnail');
        $tempArr['featured_image']['medium'] = get_the_post_thumbnail_url($id, 'medium');
        $tempArr['featured_image']['large'] = get_the_post_thumbnail_url($id, 'large');
        //array_push($dataArr, $tempArr);
        if ($i == $totalPosts) {
            break;
        }
        array_push($dataArr, $tempArr);
        $i++;
    }

    /*  if ($orderBy == 'releseDateAsc') {
        $key = array_column($dataArr, 'release_date_int');
        array_multisort($key, SORT_ASC, SORT_NUMERIC, $dataArr);
    } elseif ($orderBy == 'releseDateDesc') {
        $key = array_column($dataArr, 'release_date_int');

        array_multisort($key, SORT_DESC, SORT_NUMERIC, $dataArr);
    } elseif ($orderBy == 'priceLowToHigh') {
        $key = array_column($dataArr, 'price');
        array_multisort($key, SORT_ASC, SORT_NUMERIC, $dataArr);
    } elseif ($orderBy == 'priceHighToLow') {
        $key = array_column($dataArr, 'price');
        array_multisort($key, SORT_DESC, SORT_NUMERIC, $dataArr);
    } elseif ($orderBy == 'releaseThisWeek') {
        $firstdayOfWeek = date(strtotime("this week"));

        $dataArr = array_filter($dataArr, "releaseThisWeek");
    } else {
        $key = array_column($dataArr, 'release_date_int');

        array_multisort($key, SORT_DESC, SORT_NUMERIC, $dataArr);
    } */

    /* $i == 0;
    $finalArr = [];
    foreach ($dataArr as $value) {

        array_push($finalArr, $value);
        if ($i == $totalPosts) {
            break;
        }
        $i++;
    } */
    $data['totalPost'] = sizeof($query);
    /* $data['totalPost'] = sizeof($finalArr);
    $data['post'] = $finalArr; */

    $data['post'] = $dataArr;
    echo json_encode($data);

    function releaseThisWeek($arr)
    {
        global $firstdayOfWeek;
        return ($arr['release_date_int'] >= $firstdayOfWeek);
    }
}

function getStartAndEndDate($week, $year)
{
    $dateTime = new DateTime();
    $dateTime->setISODate($year, $week);
    $result['start_date'] = $dateTime->format('Y-m-d H:i:s');
    $dateTime->modify('+6 days');
    $result['end_date'] = $dateTime->format('Y-m-d H:i:s');
    return $result;
}

function menuItems()
{
    $parentCategory = [];

    $terms = get_terms('department', 'orderby=name&hide_empty=1');

    foreach ($terms as $val) {
        $parentId = $val->parent;
        if ($parentId == 0) {
            array_push($parentCategory, $val->term_id);
        }
    }
    $mainBrand = [];
    $subBrand = [];
    $i = 0;
    foreach ($terms as $val) {
        $termId = $val->term_id;
        $name = $val->name;
        $slug = $val->slug;
        $itemCount = $val->count;
        $taxonomy = $val->taxonomy;
        $parentId = $val->parent;
        if (in_array($termId, $parentCategory)) {
            $tempArr = [
                'termId' => $termId,
                'name' => $name,
                'slug' => $slug,
                'itemCount' => $itemCount,
                'taxonomy' => $taxonomy,
                'logo' => '',

            ];
            array_push($mainBrand, $tempArr);
        }
        if (!in_array($termId, $parentCategory)) {
            if (array_key_exists($parentId, $subBrand)) {
                $tempArr = [
                    'termId' => $termId,
                    'name' => $name,
                    'slug' => $slug,
                    'itemCount' => $itemCount,
                    'taxonomy' => $taxonomy,
                    'logo' => '',

                ];
                // $totalLength = sizeof($subBrand[$parentId]);
                // $i = ($i > 0) ? $totalLength - 1 : 0;
                $subBrand[$parentId][$i] = $tempArr;
                // $i++;
            } else {
                // $i = 0;
                $tempArr = [
                    'termId' => $termId,
                    'name' => $name,
                    'slug' => $slug,
                    'itemCount' => $itemCount,
                    'taxonomy' => $taxonomy,
                    'logo' => '',

                ];
                $subBrand[$parentId][$i] = $tempArr;
                // $i++;
            }
            $i++;
        }
    }
    foreach ($terms as $val) {
        $termId = $val->term_id;
        $name = $val->name;
        $slug = $val->slug;
        $itemCount = $val->count;
        $taxonomy = $val->taxonomy;
        $parentId = $val->parent;
        if (!array_key_exists($parentId, $mainBrand) && array_key_exists($termId, $subBrand)) {
            $tempArr = [
                'termId' => $termId,
                'name' => $name,
                'slug' => $slug,
                'itemCount' => $itemCount,
                'taxonomy' => $taxonomy,
                'logo' => '',
            ];
            array_push($mainBrand, $tempArr);
        }
    }
    $brands = array();

    foreach ($mainBrand as $key => $val) {
        $termId = $val['termId'];
        $name = $val['name'];
        $slug = $val['slug'];
        $itemCount = $val['itemCount'];
        $taxonomy = $val['taxonomy'];
        $logo = "";

        if (array_key_exists($termId, $subBrand)) {
            $childArr = $subBrand[$termId];
        }
        $brands[$key] = array(
            "termId" => $termId,
            "name" => $name,
            "slug" => $slug,
            "itemCount" => $itemCount,
            "taxonomy" => $taxonomy,
            "logo" => $logo,
            "subMenu" => $childArr,
        );
    }

    echo json_encode($brands);
}

function popularNews($slug)
{
    $dataLimit = $slug['slug'];

    $args = array(
        'post_type' => 'post',
        'showposts' => -1,

    );

    $news = new WP_Query($args);

    $news = $news->posts;
    $data = [];
    $i = 0;
    foreach ($news as $key => $value) {
        $id = $value->ID;
        $data[$key]['ID'] = $value->ID;
        $data[$key]['post_author'] = $value->post_author;
        $data[$key]['post_date_gmt'] = date("d M Y H:i A", strtotime($value->post_date_gmt));
        // $data[$key]['post_content'] = $value->post_content;
        $data[$key]['post_title'] = $value->post_title;
        $data[$key]['post_excerpt'] = $value->post_excerpt;
        $data[$key]['post_status'] = $value->post_status;
        $data[$key]['comment_status'] = $value->comment_status;
        $data[$key]['ping_status'] = $value->ping_status;
        $data[$key]['post_name'] = $value->post_name;
        $data[$key]['post_parent'] = $value->post_parent;
        $data[$key]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($id, 'thumbnail');
        $data[$key]['featured_image']['medium'] = get_the_post_thumbnail_url($id, 'medium');
        $data[$key]['featured_image']['large'] = get_the_post_thumbnail_url($id, 'large');

        $i++;
        if ($i == $dataLimit) {
            break;
        }
    }

    $finalArray = [
        'totalPost' => sizeof($news),
        'posts' => $data,
    ];

    echo json_encode($finalArray);
}

function subBrands($slug)
{

    $brandId = $slug['slug'];
    $data = [];
    $children = [];

    $termchildren = get_term_children($brandId, 'department');

    if ($termchildren->errors == "") {
        $i = 0;
        foreach ($termchildren as $child) {
            $term = get_term_by('id', $child, 'department');
            $children[$i]['id'] = $child;
            $children[$i]['url'] = get_term_link($child, $taxonomy_name);
            $children[$i]['termName'] = $term->name;
            $children[$i]['termSlug'] = $term->slug;

            $i++;
        }

        $data = $children;
    } else {
        $data = "error";
    }

    echo json_encode($data);
}

function schemaProducts($slug)
{
    global $wpdb;
    $urlparts = parse_url(home_url());
    $domain = "https://" . $urlparts['host'];
    // this part is used for finding the breadcrumb and slug part
    $data = explode("/", rtrim($slug['slug'], '/'));

    $name = $data[sizeof($data) - 1];

    function wpsrc($id)
    {
        $image_full = wp_get_attachment_image_src($id, 'full', false);
        $image_large = wp_get_attachment_image_src($id, 'large', false);
        $image_medium = wp_get_attachment_image_src($id, 'medium', false);
        $image_medium_large = wp_get_attachment_image_src($id, 'medium_large', false);
        $image_thumbnail = wp_get_attachment_image_src($id, 'thumbnail', false);

        $final_src = $image_full[0] . ' ' . $image_full[1] . 'w' . ', ' . $image_large[0] . ' ' . $image_large[1] . 'w' . ', ' . $image_medium[0] . ' ' . $image_medium[1] . 'w' . ', ' . $image_medium_large[0] . ' ' . $image_medium_large[1] . 'w' . ', ' . $image_thumbnail[0] . ' ' . $image_thumbnail[1] . 'w';

        return $final_src;
    }

    $args = [
        'name' => $name,
        'post_type' => 'sneaker',
    ];

    $post = get_posts($args)[0];

    $postDate = $post->post_date_gmt;
    $postName = ucwords(str_replace("-", " ", $post->post_name));
    $id = $post->ID;
    $tempArr = [];
    // necessity information of every post

    $postMeta = get_post_meta($id);
    //print_r($postMeta);
    $postTitle = get_the_title($id);

    $release_date = $postMeta['_sf_date'][0];




    $release_time = $postMeta['_sf_time'][0];

    $price = $postMeta['_sf_price'][0];

    $esc_price = esc_html($price);

    $sneaker_status = $postMeta['_sf_instock'][0];

    $checkStatus = str_replace("_", '', $sneaker_status);
    $checkDate = date("Y-m-d", $release_date);

    // style code and seo data
    $styleCode = $postMeta['_sf_style_code'][0];
    $productImages = $postMeta['_sf_images'][0];
    $productImage = unserialize($productImages);
    $yoastTitle = YoastSEO()->meta->for_post($id)->title;
    $yoastdescription = YoastSEO()->meta->for_post($id)->description;
    //$rankTitle = $rankTitle != "" ? $rankTitle : $postTitle;
    $desc = $postMeta['_yoast_wpseo_metadesc'][0];
    $imgThumbnail = get_the_post_thumbnail_url($id, 'thumbnail');
    $image_id = get_post_thumbnail_id($id);
    $siteName = get_bloginfo('name');
    $list_image = $productImage;
    $list_image_srcset = [];
    $list_image_url = [];
    if ($list_image != null) {

        foreach ($list_image as $key => $value) {

            //$list_image_srcset[] =  array( $key => wp_get_attachment_image_srcset($key, 'medium', true));
            if ($key != null) {
                $list_image_srcset[] = array(array("srcset" => wpsrc($key), "src" => $value));
            } else {
                $list_image_srcset[] = array(array("srcset" => "", "src" => ""));
            }

            // array_push($list_image_srcset,$srcset);
            $list_image_url[] = array($key => $value);
        }
    }

    $entries = get_post_meta($id, '_sf_affilate_group', true);

    // echo json_encode($entries);

    $dataTemp = [];
    $i = 0;
    foreach ($entries as $key => $entry) {

        $affilate_post_id = $entry['affilate_title'];
        if (get_post_status($affilate_post_id) != 'publish') {
            continue;
        }

        $launch_date = $entry['launch_date'];
        if ($launch_date == null) {
            $launch_date = "TBC";
        } else {
            $launch_date = date('D d M Y', $launch_date);
        }
        $launch_time = $entry['launch_time'];
        $launch_status = $entry['launch_status'];

        if (!empty($entry['affilate_link'])) {

            $meta_key = "_afflink_{$affilate_post_id}";
            $aff_link = get_post_meta($id, $meta_key, true);
        } else {

            $aff_link = get_post_meta($affilate_post_id, '_sf_default_link', true);
        }

        // echo $thumnail = get_the_post_thumbnail($affilate_post_id, 'post-thumb', array('class' => "img-responsive",));
        $thumbnail = get_the_post_thumbnail_url($affilate_post_id, 'medium');
        //$thumbnailsrc = wp_get_attachment_image_srcset($affilate_post_id, 'medium', true);
        $thumbnailsrc = wpsrc($affilate_post_id);

        if ($launch_status == "coming_soon") :
            $stockStatus = "Coming Soon";

        elseif ($launch_status == "tbc") :
            $stockStatus = "TBC";

        elseif ($launch_status == "instock") :
            $stockStatus = "In Stock";

        elseif ($launch_status == "restock") :
            $stockStatus = "Re Stock";

        elseif ($launch_status == "delayed") :
            $stockStatus = "Reseller";

        elseif ($launch_status == "sold_out") :
            $stockStatus = "Sold Out";

        elseif ($launch_status == "raffle") :
            $stockStatus = "Raffle";

        endif;

        // buy link and visit website
        if ($launch_status == "instock" || $launch_status == "restock" || $launch_status == "delayed") :
            $buttonName = "Buy Now";

        elseif ($launch_status == "sold_out") :
            $buttonName = "Visit Website";

        else :
            $buttonName = "Visit Website";

        endif;

        $dataTemp[$i]['shopLogo'] = $thumbnail;
        $dataTemp[$i]['shooLogoSrc'] = $thumbnailsrc;
        $dataTemp[$i]['statusButton'] = $buttonName;
        $dataTemp[$i]['affiliateUrl'] = html_entity_decode($aff_link);
        $dataTemp[$i]['stockStatus'] = $stockStatus;
        $dataTemp[$i]['releseDate'] = $launch_date;
        $dataTemp[$i]['releseTime'] = $launch_time;

        $i++;
    }

    $result_department = $wpdb->get_results("SELECT t.*, tt.* FROM wpfs_terms AS t INNER JOIN wpfs_term_taxonomy AS tt ON t.term_id = tt.term_id INNER JOIN wpfs_term_relationships AS tr ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tt.taxonomy IN ('department') AND tr.object_id IN ($id) ORDER BY t.term_id DESC;");

    $parent_arr = [];

    $mainArr = [];

    foreach ($result_department as $val) {
        $parent = $val->parent;
        $name = $val->name;
        $slug = $val->slug;
        $termId = $val->term_id;

        if ($parent == 0) {
            $parent_arr[$parent] = [
                'name' => $name,
                'child' => $termId,
                'slug' => $slug,
            ];
        } else {
            $mainArr[$parent] = [
                'name' => $name,
                'child' => $termId,
                'slug' => $slug,

            ];
        }
    }

    $status = true;
    $i = 0;
    while ($status == true) {
        $status = false;
        if (array_key_exists($i, $parent_arr)) {
            $child = $parent_arr[$i]['child'];
            if (array_key_exists($child, $mainArr)) {
                if (!empty($mainArr[$child]['name'])) {
                    $tempArray = [
                        'name' => $mainArr[$child]['name'] != '' ? $mainArr[$child]['name'] : "",
                        'child' => $mainArr[$child]['child'] != '' ? $mainArr[$child]['child'] : "",
                        'slug' => $mainArr[$child]['slug'] != '' ? $mainArr[$child]['slug'] : "",
                    ];
                    array_push($parent_arr, $tempArray);
                }
                unset($mainArr[$child]);
            }
        }

        if ($i > 4) {
            $status = false;
            break;
        }

        if (!empty($mainArr)) {
            $status = true;
        } else {
            $status = false;
            break;
        }

        $i++;
    }

    $resultcolor = $wpdb->get_results("SELECT t.*, tt.* FROM wpfs_terms AS t INNER JOIN wpfs_term_taxonomy AS tt ON t.term_id = tt.term_id INNER JOIN wpfs_term_relationships AS tr ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tt.taxonomy IN ('colour') AND tr.object_id IN ($id) ORDER BY t.name ASC");

    foreach ($resultcolor as $val) {
        $colorName = $val->name;
    }

    //echo $tempArr;
    /// main api part ////
    date_default_timezone_set('Europe/London');
    $tempArr['main']['featured_image']['large'] = get_the_post_thumbnail_url($id, 'large');
    $tempArr['main']['featured_image']['srcset'] = wpsrc($image_id);
    $tempArr['main']['productImagesMain'] = $list_image_srcset;
    //$tempArr['main']['content'] = '<p>' . implode('</p><p>', array_filter(explode("\n", $post->post_content))) . '</p>';
    $tempArr['main']['content'] = '<p>' . preg_replace('/(\r\n\r\n|\r\r|\n\n)+/', '</p><p>', $post->post_content) . '</p>';
    $tempArr['main']['title'] = $post->post_title;

    $d_f = 'D, d M Y';
    $modified_date = get_the_modified_date($d_f, $post);
    if (!empty($modified_date)) {
        $final_date = $modified_date;
    } else {
        $_sf_date = $postMeta['_sf_date'][0];
        $final_date =  date('D, d M Y', $_sf_date);
    }


    $tempArr['main']['releaseTimeDate'] = [

        //'date' => gmdate('D, d M Y T', $postMeta['_sf_date'][0]) == "Thu, 01 Jan 1970 GMT" ? "TBC" : gmdate('D, d M Y T', $postMeta['_sf_date'][0]),
        'date' => $final_date . ' GMT' == "Thu, 01 Jan 1970 GMT" ? "TBC" : $final_date . ' GMT',
        //'date' => gmdate('D, d M Y T', $postMeta['_sf_date'][0]),
        'time' => $postMeta['_sf_time'][0],
        'stock' => $postMeta['_sf_instock'][0],
        'price' => $postMeta['_sf_price'][0],
        'styleCode' => $postMeta['_sf_style_code'][0],
    ];
    $tempArr['main']['buyFromHere'] = $dataTemp;
    $tempArr['main']['categoryData'] = $parent_arr;
    if (sizeof($parent_arr) >= 1) {
        $brand = $parent_arr[0]['name'];
        $model = $parent_arr[1]['name'];

        $tempArr['main']['releseInfo']['brand'] = ucfirst($brand);
        $tempArr['main']['releseInfo']['model'] = ucfirst($model);
    }
    $tempArr['main']['releseInfo'] = [
        'releaseDate' => date('D, d M Y', $postMeta['_sf_date'][0]) . ' GMT' == "Thu, 01 Jan 1970 GMT" ? "TBC" : date('D, d M Y', $postMeta['_sf_date'][0]) . ' GMT',
        //'releaseDate' => gmdate('D, d M Y T', $postMeta['_sf_date'][0]),
        'price' => $postMeta['_sf_price'][0],
        'brand' => ucfirst($brand),
        'model' => ucfirst($model),
        'styleCode' => $postMeta['_sf_style_code'][0],
        'color' => $colorName,

    ];

    $seo_title = $yoastTitle != '' ? $yoastTitle : $postTitle . '  | Where To Buy | Fastsole';

    /// main api part end ////

    $tempArr['schema'] = [
        '@context' => 'https://schema.org/',
        "@type" => "Product",
        "name" => $seo_title,
        "sku" => $styleCode,
        "mpn" => $styleCode,
        "productID" => "FS-$id",
        "description" => $desc,
        "image" => [implode(",", (array)$productImage)],
        "brand" => ["@type" => "Brand", "name" => $postName],
        "offers" => [
            "@type" => "AggregateOffer",
            "url" => get_permalink($id),
            "availability" => "https://schema.org/LimitedAvailability",
            "price" => $price,
            "lowPrice" => $price,
            "priceCurrency" => "GBP",
        ],
        "releaseDate" => gmdate(DATE_ISO8601, strtotime($postDate)),

    ];

    $tempArr['schema'] = json_encode($tempArr['schema']);

    // this section is used for breadcrumb
    $i = 0;

    $breadCrumb = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
    ];

    $itemList = [];
    $str = "";
    $url = "";
    foreach ($data as $value) {

        $tempDataArr = [];
        if ($i == 0) {
            $url .= $domain;
            $name = "Home";
        } else {
            $url .= "/" . $value;
            $name = $value;
        }

        $tempDataArr = [
            "@type" => "ListItem",
            "position" => $i,
            "name" => ucwords(str_replace("-", " ", $name)),
            "item" => "$url",

        ];

        array_push($itemList, $tempDataArr);

        $i++;
    }
    $breadCrumb['itemListElement'] = $itemList;
    $tempArr["breadCrumb"] = json_encode($breadCrumb);

    $tempArr["meta"]["title"] = $yoastTitle != '' ? $yoastTitle : $postTitle . '  | Where To Buy | Fastsole';
    $tempArr["meta"]["fbAppId"] = "";
    $tempArr["meta"]["sitename"] = $siteName;
    $tempArr["meta"]["twitter"] = '@' . $siteName;
    $tempArr["meta"]["description"] = $yoastdescription != '' ? $yoastdescription : "Find out all the latest information on the $postTitle | $styleCode including release dates, prices and where to cop";
    $tempArr["meta"]["thumbnail"] = $imgThumbnail;
    $tempArr["meta"]["ogtitle"] = $yoastTitle != '' ? $yoastTitle : $postTitle . '  | Where To Buy | Fastsole';
    $tempArr["meta"]["ogurl"] = get_permalink($id);
    $tempArr["meta"]["favicon"] = "https://fastsole.co.uk/wp-content/uploads/2016/09/FastSole-Fev-01.png";

    echo json_encode($tempArr);
}

function schemaHome()
{

    $urlparts = parse_url(home_url());
    $domain = "https://" . $urlparts['host'];
    $siteName = get_bloginfo('name');

    $tempArr['schema'] = [
        "@context" => "https://schema.org",
        "@type" => "Organization",
        "url" => $domain,
        "sameAs" => [
            "https://www.facebook.com/fastsole/",
            "https://www.instagram.com/fastsole/",
            "https://twitter.com/FastSoleUK",
        ],
        "address" => [
            "@type" => "PostalAddress",
            "addressCountry" => "GB",
            "addressLocality" => "22 Trinity Trees",
            "addressRegion" => "Eastbourne",
            "postalCode" => "BN21 3LE",
            "streetAddress" => "16 Windermere Court",
        ],
        "founder" => [
            "@type" => "Person",
            "email" => "info@fastsole.co.uk",
            "name" => "Shah Aktaruzzaman",
            "givenName" => "Shah",
            "familyName" => "Aktaruzzaman",
            "jobTitle" => "CEO",
        ],
        "contactPoint" => [
            [
                "@type" => "ContactPoint",
                "email" => "info@fastsole.co.uk",
                "telephone" => "447896880951",
                "contactType" => "General inquiries",
            ],
            [
                "@type" => "ContactPoint",
                "email" => "info@fastsole.co.uk",
                "contactType" => "Sales and advertising",
            ],
        ],
        "@id" => "$domain/#organization",
        "name" => "Fast sole",
        "logo" => "https://fastsole.co.uk/wp-content/themes/fs/img/logo.png",
    ];

    $tempArr['schema'] = json_encode($tempArr['schema']);

    $tempArr["meta"]["title"] = "Sneaker Release Dates 2022 | Sneaker News UK 2022 | $siteName ";
    $tempArr["meta"]["titleTwitter"] = "Sneaker Release Dates 2022 | Sneaker News UK 2022 | $siteName ";
    $tempArr["meta"]["fbAppId"] = "";
    $tempArr["meta"]["sitename"] = $siteName;
    $tempArr["meta"]["twitter"] = '@' . $siteName;
    $tempArr["meta"]["description"] = "Find the latest sneaker news, release dates, prices and where to buy. $siteName keeps you up to date with the latest footwear rumours and releases.";
    // $tempArr["meta"]["thumbnail"] = $imgThumbnail;
    $tempArr["meta"]["ogtitle"] = "Sneaker Release Dates 2022 | Sneaker News UK 2022 | $siteName ";
    $tempArr["meta"]["ogurl"] = "$domain";
    $tempArr["meta"]["favicon"] = "https://fastsole.co.uk/wp-content/uploads/2016/09/FastSole-Fev-01.png";

    //    echo $tempArr['schema'] = json_encode($tempArr['schema']);

    echo json_encode($tempArr);
}

function schemaBrands()
{

    $urlparts = parse_url(home_url());
    $domain = "https://" . $urlparts['host'];
    $siteName = get_bloginfo('name');

    $tempArr['schema'] = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => [
            [
                "@type" => "ListItem",
                "position" => 0,
                "name" => "Home",
                "item" => "$domain",
            ],
            [
                "@type" => "ListItem",
                "position" => 1,
                "name" => "Brands",
                "item" => "$domain/sneaker-release-dates/brands/",
            ],
        ],
    ];

    //  $tempArr['schema'] = json_encode($tempArr['schema']);
    $tempArr['schema'] = json_encode($tempArr['schema']);
    $tempArr["meta"]["title"] = " $siteName ";
    $tempArr["meta"]["titleTwitter"] = "Latest Trainer Releases | $siteName ";
    $tempArr["meta"]["fbAppId"] = "";
    $tempArr["meta"]["sitename"] = $siteName;
    $tempArr["meta"]["twitter"] = '@' . $siteName;
    $tempArr["meta"]["description"] = "Find the latest sneaker news, release dates, prices and where to buy. $siteName keeps you up to date with the latest footwear rumours and releases.";
    // $tempArr["meta"]["thumbnail"] = $imgThumbnail;
    $tempArr["meta"]["ogtitle"] = "Latest Trainer Releases |  $siteName";
    $tempArr["meta"]["ogurl"] = "$domain";
    $tempArr["meta"]["favicon"] = "https://fastsole.co.uk/wp-content/uploads/2016/09/FastSole-Fev-01.png";

    //    echo $tempArr['schema'] = json_encode($tempArr['schema']);

    echo json_encode($tempArr);
}

function schemaBrandsall($slug)
{

    $slug = $slug['slug'];
    //$slug = "nike";
    // $totalPosts = get_term($getId)->count;

    $args = array(
        'post_type' => 'sneaker',
        'posts_per_page' => 23,
        'tax_query' => array(

            array(
                'taxonomy' => 'department',
                'field' => 'slug',
                'terms' => $slug,
            ),

        ),

    );

    $query = new WP_Query($args);
    $data = [];
    $children = [];
    $schematemp = [];
    $schemaForData = [];
    $schemaName = [];

    $itemName = $query->queried_object->name;
    $term_taxonomy_id = $query->queried_object->term_id;
    $taxonomy = $query->queried_object->taxonomy;
    $description = $query->queried_object->description;

    $termchildren = get_term_children($term_taxonomy_id, $taxonomy);
    $i = 0;
    foreach ($termchildren as $child) {
        $term = get_term_by('id', $child, $taxonomy);
        $children['children'][$i]['id'] = $child;
        $brandurl = get_term_link($child, $taxonomy_name);
        $brandName = $term->name;
        $children['children'][$i]['termSlug'] = $term->slug;

        $schematemp = [
            "@type" => "ListItem",
            "position" => $i,
            "url" => $brandurl,
        ];

        array_push($schemaName, $brandName);

        array_push($schemaForData, $schematemp);

        $i++;
    }

    $urlparts = parse_url(home_url());
    $domain = "https://" . $urlparts['host'];
    $siteName = get_bloginfo('name');

    $tempArr['schema'] = [
        "@context" => "https://schema.org",
        "@type" => "ItemList",
        "itemListElement" => [
            $schemaForData,
        ],

    ];

    $tempArr['breadCrumb'] = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => [
            [
                "@type" => "ListItem",
                "position" => 0,
                "name" => "Home",
                "item" => "$domain",
            ],
            [
                "@type" => "ListItem",
                "position" => 1,
                "name" => "Brands",
                "item" => "$domain/sneaker-release-dates/brands/",
            ],
            [
                "@type" => "ListItem",
                "position" => 2,
                "name" => "$slug",
                "item" => "$domain/sneaker-release-dates/brands/$slug",
            ],
        ],
    ];

    $new_slug = ucwords(str_replace('-', ' ', $slug));
    $tempArr['schema'] = json_encode($tempArr['schema']);
    $tempArr['breadCrumb'] = json_encode($tempArr['breadCrumb']);
    $tempArr["meta"]["title"] = "Latest $new_slug Releases & Next Drops in 2022 – Fastsole";
    $tempArr["meta"]["titleTwitter"] = "Latest $new_slug Releases & Next Drops in 2022 – Fastsole";
    $tempArr["meta"]["fbAppId"] = "";
    $tempArr["meta"]["sitename"] = $siteName;
    $tempArr["meta"]["twitter"] = '@' . $siteName;
    $tempArr["meta"]["description"] = "Shop all of the latest mens $slug trainer releases from Europes biggest retailers. Including iconic silhouettes such as the $schemaName[0], $schemaName[1]";
    // $tempArr["meta"]["thumbnail"] = $imgThumbnail;
    $tempArr["meta"]["ogtitle"] = "Latest $new_slug Releases & Next Drops in 2022 – Fastsole";
    $tempArr["meta"]["ogurl"] = "$domain/$slug";
    $tempArr["meta"]["favicon"] = "https://fastsole.co.uk/wp-content/uploads/2016/09/FastSole-Fev-01.png";

    // $tempArr["meta"]["context"] = $children;

    echo json_encode($tempArr);
}

function schemaSneakerRelease()
{

    $urlparts = parse_url(home_url());
    $domain = "https://" . $urlparts['host'];
    $siteName = get_bloginfo('name');

    $args = array(
        'post_type' => 'sneaker',
        'showposts' => 35,

    );

    $query = new WP_Query($args);

    $query = $query->posts;
    $schematemp = [];
    $schemaForData = [];
    $i = 0;
    foreach ($query as $value) {
        $id = $value->ID;
        $new_slug = str_replace(home_url(), '', get_post_permalink($id));
        $schematemp = [
            "@type" => "ListItem",
            "position" => $i,
            "url" => $new_slug,
        ];

        array_push($schemaForData, $schematemp);

        $i++;
    }

    $tempArr['schema'] = [
        "@context" => "https://schema.org",
        "@type" => "ItemList",
        "itemListElement" => [
            $schemaForData,
        ],

    ];

    $tempArr['schema'] = json_encode($tempArr['schema']);

    $tempArr['breadCrumb'] = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => [
            [
                "@type" => "ListItem",
                "position" => 0,
                "name" => "Home",
                "item" => "$domain",
            ],
            [
                "@type" => "ListItem",
                "position" => 1,
                "name" => "Sneakers Release dates",
                "item" => "$domain/sneaker-release-dates/",
            ],
        ],
    ];

    $tempArr['breadCrumb'] = json_encode($tempArr['breadCrumb']);
    $tempArr["meta"]["title"] = " $siteName ";
    $tempArr["meta"]["titleTwitter"] = "Men&#x27;s Trainers - Upcoming Releases [2022]  |  $siteName";
    $tempArr["meta"]["fbAppId"] = "";
    $tempArr["meta"]["sitename"] = $siteName;
    $tempArr["meta"]["twitter"] = '@' . $siteName;
    $tempArr["meta"]["description"] = "$siteName finds the best new and upcoming sneaker releases online and shows you where to buy them at the best possible prices";
    // $tempArr["meta"]["thumbnail"] = $imgThumbnail;
    $tempArr["meta"]["ogtitle"] = "Men&#x27;s Trainers - Upcoming Releases [2022]  |  $siteName";
    $tempArr["meta"]["ogurl"] = "$domain/sneaker-release-dates/";
    $tempArr["meta"]["favicon"] = "https://fastsole.co.uk/wp-content/uploads/2016/09/FastSole-Fev-01.png";

    //     // $tempArr["meta"]["context"] = $children;

    echo json_encode($tempArr);
}

function schemaOnfocus()
{

    $urlparts = parse_url(home_url());
    $domain = "https://" . $urlparts['host'];
    $siteName = get_bloginfo('name');

    $args = array(
        'post_type' => 'sneaker',
        'showposts' => 35,

        'tax_query' => array(

            array(
                'taxonomy' => 'status',
                'field' => 'id',
                'terms' => '105',

            ),

        ),

    );

    $query = new WP_Query($args);
    $query = $query->posts;

    $schematemp = [];
    $schemaForData = [];
    $i = 0;
    foreach ($query as $value) {
        $id = $value->ID;
        $new_slug = str_replace(home_url(), '', get_post_permalink($id));
        $schematemp = [
            "@type" => "ListItem",
            "position" => $i,
            "url" => $new_slug,
        ];

        array_push($schemaForData, $schematemp);

        $i++;
    }

    $tempArr['schema'] = [
        "@context" => "https://schema.org",
        "@type" => "ItemList",
        "itemListElement" => [
            $schemaForData,
        ],

    ];

    $tempArr['schema'] = json_encode($tempArr['schema']);

    $tempArr['breadCrumb'] = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => [
            [
                "@type" => "ListItem",
                "position" => 0,
                "name" => "Home",
                "item" => "$domain",
            ],
            [
                "@type" => "ListItem",
                "position" => 1,
                "name" => "Sneakers Release dates",
                "item" => "$domain/sneaker-release-dates/status/on-focus/",
            ],
        ],
    ];

    $tempArr['breadCrumb'] = json_encode($tempArr['breadCrumb']);
    $tempArr["meta"]["title"] = "On Focus -  $siteName ";
    $tempArr["meta"]["titleTwitter"] = "Men&#x27;s Trainers - Upcoming Releases [2022]  |  $siteName";
    $tempArr["meta"]["fbAppId"] = "";
    $tempArr["meta"]["sitename"] = $siteName;
    $tempArr["meta"]["twitter"] = '@' . $siteName;
    $tempArr["meta"]["description"] = "$siteName  finds the best new and upcoming sneaker releases online and shows you where to buy them at the best possible prices.";
    // $tempArr["meta"]["thumbnail"] = $imgThumbnail;
    $tempArr["meta"]["ogtitle"] = "Men&#x27;s Trainers - Upcoming Releases [2022]  |  $siteName";
    $tempArr["meta"]["ogurl"] = "$domain/sneaker-release-dates/status/on-focus/";
    $tempArr["meta"]["favicon"] = "https://fastsole.co.uk/wp-content/uploads/2016/09/FastSole-Fev-01.png";

    //     // $tempArr["meta"]["context"] = $children;

    echo json_encode($tempArr);
}

function schemaCommingSoon()
{

    $urlparts = parse_url(home_url());
    $domain = "https://" . $urlparts['host'];
    $siteName = get_bloginfo('name');

    $args = array(
        'post_type' => 'sneaker',
        'showposts' => 35,

        'tax_query' => array(

            array(
                'taxonomy' => 'status',
                'field' => 'id',
                'terms' => '45',

            ),

        ),

    );

    $query = new WP_Query($args);
    $query = $query->posts;

    $schematemp = [];
    $schemaForData = [];
    $i = 0;
    foreach ($query as $value) {
        $id = $value->ID;
        $new_slug = str_replace(home_url(), '', get_post_permalink($id));
        $schematemp = [
            "@type" => "ListItem",
            "position" => $i,
            "url" => $new_slug,
        ];

        array_push($schemaForData, $schematemp);

        $i++;
    }

    $tempArr['schema'] = [
        "@context" => "https://schema.org",
        "@type" => "ItemList",
        "itemListElement" => [
            $schemaForData,
        ],

    ];

    $tempArr['schema'] = json_encode($tempArr['schema']);

    $tempArr['breadCrumb'] = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => [
            [
                "@type" => "ListItem",
                "position" => 0,
                "name" => "Home",
                "item" => "$domain",
            ],
            [
                "@type" => "ListItem",
                "position" => 1,
                "name" => "Sneakers Release dates",
                "item" => "$domain/sneaker-release-dates/status/coming-soon/",
            ],
        ],
    ];

    $tempArr['breadCrumb'] = json_encode($tempArr['breadCrumb']);
    $tempArr["meta"]["title"] = "Coming Soon | $siteName ";
    $tempArr["meta"]["titleTwitter"] = "Men&#x27;s Trainers - Upcoming Releases [2022]  |  $siteName";
    $tempArr["meta"]["fbAppId"] = "";
    $tempArr["meta"]["sitename"] = $siteName;
    $tempArr["meta"]["twitter"] = '@' . $siteName;
    $tempArr["meta"]["description"] = "$siteName  finds the best new and upcoming sneaker releases online and shows you where to buy them at the best possible prices.";
    // $tempArr["meta"]["thumbnail"] = $imgThumbnail;
    $tempArr["meta"]["ogtitle"] = "Men&#x27;s Trainers - Upcoming Releases [2022]  |  $siteName";
    $tempArr["meta"]["ogurl"] = "$domain/sneaker-release-dates/status/coming-soon/";
    $tempArr["meta"]["favicon"] = "https://fastsole.co.uk/wp-content/uploads/2016/09/FastSole-Fev-01.png";

    //     // $tempArr["meta"]["context"] = $children;

    echo json_encode($tempArr);
}

function schemaSearch($slug)
{
    $urlparts = parse_url(home_url());
    $domain = "https://" . $urlparts['host'];
    $siteName = get_bloginfo('name');

    $args = array(
        'post_type' => 'sneaker',
        's' => $slug,
        'showposts' => 35,
        'tax_query' => array(
            'taxonomy' => 'department',

        ),

    );

    $query = new WP_Query($args);

    $query = $query->posts;
    $schematemp = [];
    $schemaForData = [];
    $i = 0;
    foreach ($query as $value) {
        $id = $value->ID;
        $new_slug = str_replace(home_url(), '', get_post_permalink($id));
        $schematemp = [
            "@type" => "ListItem",
            "position" => $i,
            "url" => $new_slug,
        ];

        array_push($schemaForData, $schematemp);

        $i++;
    }

    $tempArr['schema'] = [
        "@context" => "https://schema.org",
        "@type" => "ItemList",
        "itemListElement" => [
            $schemaForData,
        ],

    ];

    $tempArr['schema'] = json_encode($tempArr['schema']);

    $tempArr['breadCrumb'] = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => [
            [
                "@type" => "ListItem",
                "position" => 0,
                "name" => "Home",
                "item" => "$domain",
            ],
            [
                "@type" => "ListItem",
                "position" => 1,
                "name" => "Sneakers Release dates",
                "item" => "$domain/sneaker-release-dates/",
            ],
        ],
    ];

    $tempArr['breadCrumb'] = json_encode($tempArr['breadCrumb']);
    $tempArr["meta"]["title"] = " $siteName ";
    $tempArr["meta"]["titleTwitter"] = "Men&#x27;s Trainers - Upcoming Releases [2022]  |  $siteName";
    $tempArr["meta"]["fbAppId"] = "";
    $tempArr["meta"]["sitename"] = $siteName;
    $tempArr["meta"]["twitter"] = '@' . $siteName;
    $tempArr["meta"]["description"] = "$siteName finds the best new and upcoming sneaker releases online and shows you where to buy them at the best possible prices";
    // $tempArr["meta"]["thumbnail"] = $imgThumbnail;
    $tempArr["meta"]["ogtitle"] = "Men&#x27;s Trainers - Upcoming Releases [2022]  |  $siteName";
    $tempArr["meta"]["ogurl"] = "$domain/sneaker-release-dates/";
    $tempArr["meta"]["favicon"] = "https://fastsole.co.uk/wp-content/uploads/2016/09/FastSole-Fev-01.png";

    //     // $tempArr["meta"]["context"] = $children;

    echo json_encode($tempArr);
}

function schemaNewsAll()
{

    $urlparts = parse_url(home_url());
    $domain = "https://" . $urlparts['host'];
    $siteName = get_bloginfo('name');

    $tempArr['breadCrumb'] = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => [
            [
                "@type" => "ListItem",
                "position" => 0,
                "name" => "Home",
                "item" => "$domain",
            ],
            [
                "@type" => "ListItem",
                "position" => 1,
                "name" => "Sneakers Release dates",
                "item" => "$domain/news/",
            ],
        ],
    ];

    $tempArr['breadCrumb'] = json_encode($tempArr['breadCrumb']);
    $tempArr["meta"]["title"] = "$siteName";
    $tempArr["meta"]["titleTwitter"] = "Sneaker News 2022 |  $siteName";
    $tempArr["meta"]["fbAppId"] = "";
    $tempArr["meta"]["sitename"] = $siteName;
    $tempArr["meta"]["twitter"] = '@' . $siteName;
    // $tempArr["meta"]["description"] = "$siteName finds the best new and upcoming sneaker releases online and shows you where to buy them at the best possible prices";
    // // $tempArr["meta"]["thumbnail"] = $imgThumbnail;
    $tempArr["meta"]["ogtitle"] = "Sneaker News 2022  |  $siteName";
    $tempArr["meta"]["ogurl"] = "$domain/news/";
    $tempArr["meta"]["favicon"] = "https://fastsole.co.uk/wp-content/uploads/2016/09/FastSole-Fev-01.png";

    //     // $tempArr["meta"]["context"] = $children;

    echo json_encode($tempArr);
}

function author($slug)
{

    //echo $data = json_encode(get_user_meta(6));
    $id = $slug['slug'];

    $data["name"] = get_the_author_meta('display_name', $id);
    $data["description"] = get_the_author_meta('description', $id);
    $profile_image = get_avatar_url($id);
    if ($profile_image != '') {

        $data["profil"] = $profile_image;
    } else {

        $data["profil"] = "https://w7.pngwing.com/pngs/419/473/png-transparent-computer-icons-user-profile-login-user-heroes-sphere-black-thumbnail.png";
    }

    echo json_encode($data);
    // echo $data = json_encode($slug);

}

add_action('rest_api_init', function () {

    register_rest_route('wl/v1', 'posts', [
        'methods' => 'GET',
        'callback' => 'wl_posts',
    ]);

    register_rest_route('wl/v1', 'posts/(?P<slug>[a-zA-Z0-9-]+)', array(
        'methods' => 'GET',
        'callback' => 'wl_post',
    ));

    // news && sneaker news
    register_rest_route('wl/v1', 'sneaker-news', [
        'methods' => 'GET',
        'callback' => 'wl_news',
    ]);
    register_rest_route('wl/v1', 'sneaker-news/page/(?P<slug>[a-zA-Z0-9-]+)', array(
        'methods' => 'GET',
        'callback' => 'wl_news_pages',
    ));

    register_rest_route('wl/v1', 'on-focus', [
        'methods' => 'GET',
        'callback' => 'onFocus',
    ]);
    register_rest_route('wl/v1', 'coming-soon', [
        'methods' => 'GET',
        'callback' => 'comingSoon',
    ]);

    register_rest_route('wl/v1', 'top-brands', [
        'methods' => 'GET',
        'callback' => 'topBrands',
    ]);
    register_rest_route('wl/v1', 'recent-news', [
        'methods' => 'GET',
        'callback' => 'recentNews',
    ]);
    // release-date-all-post
    register_rest_route('wl/v1', 'sneaker-release-dates/(?P<slug>[a-zA-Z0-9-]+)', [
        'methods' => 'GET',
        'callback' => 'sneakerReleaseDate',
    ]);

    register_rest_route('wl/v1', 'footwear-color', [
        'methods' => 'GET',
        'callback' => 'colour',
    ]);

    register_rest_route('wl/v1', 'footwear-stock', [
        'methods' => 'GET',
        'callback' => 'stocks',
    ]);

    register_rest_route('wl/v1', 'footwear-brands', [
        'methods' => 'GET',
        'callback' => 'brands',
    ]);

    register_rest_route('wl/v1', 'On-focus-items/(?P<slug>[a-zA-Z0-9-]+)', [
        'methods' => 'GET',
        'callback' => 'onfocusItems',
    ]);

    register_rest_route('wl/v1', 'coming-soon-items', [
        'methods' => 'GET',
        'callback' => 'comingSoonItems',
    ]);

    register_rest_route('wl/v1', 'buy-from-here/(?P<slug>[a-zA-Z0-9-]+)', [
        'methods' => 'GET',
        'callback' => 'buyFromHere',
    ]);

    register_rest_route('wl/v1', 'brands-item-list/(?P<slug>[a-zA-Z0-9-]+)', [
        'methods' => 'GET',
        'callback' => 'brandsReleatedPost',
    ]);

    register_rest_route('wl/v1', 'main-brands', [
        'methods' => 'GET',
        'callback' => 'mainBrands',
    ]);
    register_rest_route('wl/v1', 'menu-items', [
        'methods' => 'GET',
        'callback' => 'menuItems',
    ]);

    register_rest_route('wl/v1', 'search-items/(?P<slug>[a-zA-Z0-9%-]+)', [
        'methods' => 'GET',
        'callback' => 'searchModules',
    ]);

    register_rest_route('wl/v1', 'brands/(?P<slug>[a-zA-Z0-9-]+)', [
        'methods' => 'GET',
        'callback' => 'brandItems',
    ]);

    register_rest_route('wl/v1', 'sneaker-release-dates-test/(?P<slug>[a-zA-Z0-9-]+)', [
        'methods' => 'GET',
        'callback' => 'sneakerReleaseDateTest',
    ]);

    register_rest_route('wl/v1', 'popular-news/(?P<slug>[a-zA-Z0-9-]+)', [
        'methods' => 'GET',
        'callback' => 'popularNews',
    ]);
    register_rest_route('wl/v1', 'sub-brands/(?P<slug>[a-zA-Z0-9-]+)', [
        'methods' => 'GET',
        'callback' => 'subBrands',
    ]);

    register_rest_route('wl/v1', 'schema-brands/(?P<slug>[A-Za-z0-9-/-]+)', [
        'methods' => 'GET',
        'callback' => 'schemaProducts',
    ]);

    register_rest_route('wl/v1', 'schema-Home', [
        'methods' => 'GET',
        'callback' => 'schemaHome',
    ]);

    register_rest_route('wl/v1', 'schema-brands', [
        'methods' => 'GET',
        'callback' => 'schemaBrands',
    ]);

    register_rest_route('wl/v1', 'schema-brands-all/(?P<slug>[a-zA-Z0-9-]+)', [
        'methods' => 'GET',
        'callback' => 'schemaBrandsall',
    ]);

    register_rest_route('wl/v1', 'schema-brands-release', [
        'methods' => 'GET',
        'callback' => 'schemaSneakerRelease',
    ]);

    register_rest_route('wl/v1', 'schema-onfocus', [
        'methods' => 'GET',
        'callback' => 'schemaOnfocus',
    ]);

    register_rest_route('wl/v1', 'schema-comming-soon', [
        'methods' => 'GET',
        'callback' => 'schemaCommingSoon',
    ]);

    register_rest_route('wl/v1', 'schema-search/(?P<slug>[a-zA-Z0-9+-]+)', [
        'methods' => 'GET',
        'callback' => 'schemaSearch',
    ]);

    register_rest_route('wl/v1', 'schema-news-all', [
        'methods' => 'GET',
        'callback' => 'schemaNewsAll',
    ]);

    register_rest_route('wl/v1', 'author/(?P<slug>[a-zA-Z0-9-]+)', [
        'methods' => 'GET',
        'callback' => 'author',
    ]);
});
