<?php
/******************************************************/
			//Register Custom Post Types
/******************************************************/

add_action( 'init', 'fastsole_posttype' );
function fastsole_posttype() {


   register_post_type( 'sneaker',
    array(
      'labels' => array(
        'name' => __( 'Sneaker release dates','fastsole' ),
        'singular_name' => __( 'Sneaker','fastsole' ),
        'add_new_item'  => __('Add New Sneaker', 'fastsole'),
		'edit_item'     => __('Edit Sneaker', 'fastsole'),
		'new_item'      => __('New Sneaker', 'fastsole'),
		'view_item'     => __('View Sneaker', 'fastsole'),
		'search_items'  => __('Search Sneaker', 'fastsole'),
		'not_found'     => __('No Sneaker found.', 'fastsole'),
      	),
      'public' => true,
      'has_archive' => 'sneaker-release-dates',
      'menu_icon'   => 'dashicons-portfolio',
      'rewrite'		=> array(
      		'slug' => 'sneaker-release-dates/brands/%department%',
      		'with_front' => false,
      	),
      'supports' 	=> array( 'title','thumbnail','editor','comments' ),
      'taxonomies' 	=> array( 'department','colour','status'),
    )
  );

   register_post_type( 'affilate',
    array(
      'labels' => array(
        'name' => __( 'Affilates','fastsole' ),
        'singular_name' => __( 'Affilate','fastsole' ),
        'add_new_item'  => __('Add New Affilate', 'fastsole'),
		'edit_item'     => __('Edit Affilate', 'fastsole'),
		'new_item'      => __('New Affilate', 'fastsole'),
		'view_item'     => __('View Affilate', 'fastsole'),
		'search_items'  => __('Search Affilate', 'fastsole'),
		'not_found'     => __('No Affilate found.', 'fastsole'),
      	),
      'public' => true,
      //'has_archive' => true,
      'menu_icon'   => 'dashicons-universal-access-alt',
      'rewrite'		=> array('slug' => 'affilate'),
      'supports' 	=> array( 'title','thumbnail' ),
    )
  );

   register_post_type( 'deal',
    array(
      'labels' => array(
        'name' => __( 'Deals','fastsole' ),
        'singular_name' => __( 'Deal','fastsole' ),
        'add_new_item'  => __('Add New Deal', 'fastsole'),
		'edit_item'     => __('Edit Deal', 'fastsole'),
		'new_item'      => __('New Deal', 'fastsole'),
		'view_item'     => __('View Deal', 'fastsole'),
		'search_items'  => __('Search Deal', 'fastsole'),
		'not_found'     => __('No Deal found.', 'fastsole'),
      	),
      'public' => true,
      //'has_archive' => true,
      'menu_icon'   => 'dashicons-calendar',
      'rewrite'		=> array(
      		'slug' => 'deal',
      		'with_front' => false,
      	),
      'supports' 	=> array( 'title','thumbnail','editor',),
    )
  );

}


/******************************************************/
	// Register custom taxonomy.
/******************************************************/


function fastsole_register_taxonomy()
{
	register_taxonomy(
		'department',
		array(
			'sneaker',
		),
		array(
			'labels'            => array(
				'name'              => _x('Departments', 'department', 'fastsole'),
				'singular_name'     => _x('Department', 'department', 'fastsole'),
				'menu_name'         => __('Departments', 'fastsole'),
				'all_items'         => __('All Departments', 'fastsole'),
				'edit_item'         => __('Edit Department', 'fastsole'),
				'view_item'         => __('View Department', 'fastsole'),
				'update_item'       => __('Update Department', 'fastsole'),
				'add_new_item'      => __('Add New Department', 'fastsole'),
				'new_item_name'     => __('New Department Name', 'fastsole'),
				'parent_item'       => __('Parent Department', 'fastsole'),
				'parent_item_colon' => __('Parent Department:', 'fastsole'),
				'search_items'      => __('Search Department', 'fastsole'),
			),
			'show_admin_column' => true,
			'hierarchical'      => true,
			'rewrite'           => array(
				'slug' => '/sneaker-release-dates/brands',
				'with_front' => false,
			),
		)
	);

	register_taxonomy(
		'colour',
		array(
			'sneaker',
		),
		array(
			'labels'            => array(
				'name'              => _x('Colours', 'colour', 'fastsole'),
				'singular_name'     => _x('Colour', 'colour', 'fastsole'),
				'menu_name'         => __('Colours', 'fastsole'),
				'all_items'         => __('All Colours', 'fastsole'),
				'edit_item'         => __('Edit Colour', 'fastsole'),
				'view_item'         => __('View Colour', 'fastsole'),
				'update_item'       => __('Update Colours', 'fastsole'),
				'add_new_item'      => __('Add New Colours', 'fastsole'),
				'new_item_name'     => __('New Colours Name', 'fastsole'),
				'parent_item'       => __('Parent Colours', 'fastsole'),
				'parent_item_colon' => __('Parent Colours:', 'fastsole'),
				'search_items'      => __('Search Colours', 'fastsole'),
			),
			'show_admin_column' => true,
			'hierarchical'      => true,
			'rewrite'           => array(
				'slug' => 'sneaker-release-dates/colour',
				'with_front' => false,
			),
		)
	);

	register_taxonomy(
		'status',
		array(
			'sneaker',
		),
		array(
			'labels'            => array(
				'name'              => _x('Status', 'status', 'fastsole'),
				'singular_name'     => _x('Status', 'status', 'fastsole'),
				'menu_name'         => __('Status', 'fastsole'),
				'all_items'         => __('All Status', 'fastsole'),
				'edit_item'         => __('Edit Status', 'fastsole'),
				'view_item'         => __('View Status', 'fastsole'),
				'update_item'       => __('Update Status', 'fastsole'),
				'add_new_item'      => __('Add New Status', 'fastsole'),
				'new_item_name'     => __('New Status Name', 'fastsole'),
				'parent_item'       => __('Parent Status', 'fastsole'),
				'parent_item_colon' => __('Parent Status:', 'fastsole'),
				'search_items'      => __('Search Status', 'fastsole'),
			),
			'show_admin_column' => true,
			'hierarchical'      => true,
			'rewrite'           => array(
				'slug' => 'sneaker-release-dates/status',
				'with_front' => false,
			),
		)
	);
}

add_action('init', 'fastsole_register_taxonomy', 0);


function wpa_show_permalinks( $post_link, $post ){
    if ( is_object( $post ) && $post->post_type == 'sneaker' ){

    	$args = array('orderby' => 'term_id', 'order' => 'DESC');
        $terms = wp_get_object_terms( $post->ID, 'department', $args );
        if( $terms ){
            return str_replace( '%department%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;
}
add_filter( 'post_type_link', 'wpa_show_permalinks', 1, 2 );




/******************************************************************************/
	// bit.ly
/*********************************************************************************/

function bitly_url_shorten($long_url, $access_token='a3d8d7df9faa176d3c20a8cadaaf524fa5e698d8')
{
  $url = 'https://api-ssl.bitly.com/v3/shorten?access_token='.$access_token.'&longUrl='.urlencode($long_url).'&domain='.'bit.ly';
  try {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 4);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    $output = json_decode(curl_exec($ch));
  } catch (Exception $e) {
  }
  if(isset($output)){return $output->data->url;}
}


function get_affilate_url( $affilate_post_id ){

	$url = "http://track.webgains.com/click.html?wgcampaignid=203259&wgprogramid=";
	$url .= wgprogramid_byaffid($affilate_post_id);
	$url .= "&wgtarget=";
	return $url;

	}



/******************************************************************************/
	//limit bitly api call and adding affilate link
/*********************************************************************************/


function add_affilate_id($post_id){

	// If this is just a revision, don't do anything.
	if ( wp_is_post_revision( $post_id ) )
		return;
	// get post meta by post id.
	$entries = (array) get_post_meta( $post_id, '_sf_affilate_group', true );

	// escape string offset error on add new sneaker

	// get the empty array keys using array_keys
	$keys = array_keys($entries,"");

	// foreach empty key, and unset that entry
	foreach ($keys as $k){
		unset($entries[$k]);
	}


	if ( !empty($entries) ){

		foreach ($entries as $key => $entry ) {

			$affilate_post_id = $entry['affilate_title'];
			$affilate_type = get_post_meta( $affilate_post_id, '_sf_aff_type', true );
			$constant_url = get_post_meta( $affilate_post_id, '_sf_const_aff_link', true );

			if ( $affilate_type == "a" ) {

				$long_url = $constant_url.$entry['affilate_link'];
			}
			elseif( $affilate_type == "b" ) {

				$long_url = $entry['affilate_link'].$constant_url;
			}
			elseif ( $affilate_type == "c" ) {

				$long_url = $constant_url.'[['.$entry['affilate_link'].']]';
			}
			elseif ( $affilate_type == "d" ) {

				$long_url = $entry['affilate_link'];
			}

			// if($affilate_type == "d"){

			// 	$bitly_link = $long_url;

			// }else{

			// 	$bitly_link = bitly_url_shorten($long_url);


			// }

			//setting metakey
			$meta = "_afflink_{$affilate_post_id}";

			//update old meta and if does not exist create new
			update_post_meta($post_id, $meta, $long_url);

		}

	}

}

add_action( 'save_post_sneaker', 'add_affilate_id' );



//change sneaker archive title


add_filter( 'pre_get_document_title', function ( $title ) {
    if( is_post_type_archive( 'sneaker' ) ){
        $title = "Sneaker release dates"." &#8211; ". get_bloginfo( "name" );
    }
    return $title;
});
