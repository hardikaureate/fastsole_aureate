<?php

function gallery_images(){
    // Start with an underscore to hide fields from custom fields list
    $prefix = '_sf_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'gallery',
		'title'         => __( 'Gallery Images', 'cmb2' ),
		'object_types'  => array( 'sneaker','post' ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_demo->add_field( array(
		'name'       => __( 'Upload Images', 'cmb2' ),
		'desc'       => __( 'Upload Gallery Images Here', 'cmb2' ),
		'id'         => $prefix . 'images',
		'type'       => 'file_list',
		'preview_size' => array( 100, 100 ),
		'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );

}
add_action( 'cmb2_init', 'gallery_images'  );


function general_information(){
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_sf_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'release_date',
		'title'         => __( 'General Sneaker Information', 'cmb2' ),
		'object_types'  => array( 'sneaker' ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_demo->add_field( array(
		'name'       => __( 'Sneaker Launch Status', 'cmb2' ),
		'desc'       => __( 'By Default Launch Status will automatically be chosen as per launch date. select status here if you want a different custom status', 'cmb2' ),
		'id'         => $prefix . 'instock',
		'type'       => 'select',
		'show_option_none' => true,
    	//'default'          => 'coming_soon',
    	'options'          => array(
	        'coming_soon' => __( 'Coming Soon', 'cmb' ),
	        'instock'   => __( 'In Stock', 'cmb' ),
	        'delayed'   => __( 'Delayed', 'cmb' ),
	        'sold_out'     => __( 'Sold Out', 'cmb' ),
	        'restock'     => __( 'Re Stock', 'cmb' ),
	        'raffle'   => __( 'Raffle', 'cmb' ),
    	),
		'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );




	$cmb_demo->add_field( array(
		'name'       => __( 'Sneaker Release Date', 'cmb2' ),
		'desc'       => __( ' Default Value is TBC. You Can Select Date Here.', 'cmb2' ),
		'id'         => $prefix . 'date',
		'type'       => 'text_date_timestamp',
		//'type'       => 'text_date',

		'show_on_cb' => 'yourprefix_hide_if_no_cats',
	) );

	$cmb_demo->add_field( array(
		'name'       => __( 'Sneaker Release Time', 'cmb2' ),
		'desc'       => __( ' Default Value is TBC. You Can Select Time Here.', 'cmb2' ),
		'id'         => $prefix . 'time',
		'type'       => 'text_time',
		'time_format' => 'g:i A',
		'show_on_cb' => 'yourprefix_hide_if_no_cats',
	) );

	$cmb_demo->add_field( array(
		'name'       => __( 'Sneaker Price', 'cmb2' ),
		'desc'       => __( ' Default Value is TBC. You Can Select Price Here.', 'cmb2' ),
		'id'         => $prefix . 'price',
		'type'       => 'text_small',
		'before_field' => '£',
		'show_on_cb' => 'yourprefix_hide_if_no_cats',
	) );

	$cmb_demo->add_field( array(
		'name'       => __( 'Sneaker Style Code', 'cmb2' ),
		'id'         => $prefix . 'style_code',
		'type'       => 'text_medium',
		'show_on_cb' => 'yourprefix_hide_if_no_cats',
	) );



}
add_action( 'cmb2_init', 'general_information'  );



function affilate_default_link(){
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_sf_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'default_page_link',
		'title'         => __( 'Affiliate Default Settings', 'cmb2' ),
		'object_types'  => array( 'affilate' ), // Post type

	) );

	$cmb_demo->add_field( array(
		'name'       => __( 'Affiliate Type', 'cmb2' ),
		'desc'       => __( 'Select Affiliate Type', 'cmb2' ),
		'id'         => $prefix . 'aff_type',
		'type'       => 'select',
		'show_option_none' => false,
    	'options'          => array(
	        'a' => __( 'A (AffLink + Product URL)', 'cmb' ),
	        'b'   => __( 'B (Product URL + AffLink)', 'cmb' ),
	        'c'   => __( 'C (AffLink+ [ [Product URL] ] )', 'cmb' ),
	        'd'   => __( 'D (No Encryption, No Bitly)', 'cmb' ),
    	),
		'show_on_cb' => 'yourprefix_hide_if_no_cats',
	) );

	$cmb_demo->add_field( array(
		'name'       => __( 'Affiliate Link', 'cmb2' ),
		'desc'       => __( 'Past Constant affiliate Link.', 'cmb2' ),
		'id'         => $prefix . 'const_aff_link',
		'type'       => 'text_url',
		'show_on_cb' => 'yourprefix_hide_if_no_cats',
	) );


	$cmb_demo->add_field( array(
		'name'       => __( 'Default Product Page Link(With Bit.ly)', 'cmb2' ),
		'desc'       => __( 'Give Default product page bit.ly Link.', 'cmb2' ),
		'id'         => $prefix . 'default_link',
		'type'       => 'text_url',
		'show_on_cb' => 'yourprefix_hide_if_no_cats',
	) );

}

add_action( 'cmb2_init', 'affilate_default_link' );

/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function solefashion_affilate_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_sf_';

	/**
	 * Repeatable Field Groups
	 */
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'affilate',
		'title'        => __( 'Affilate Box', 'cmb2' ),
		'priority'     => 'low',
		'object_types' => array( 'sneaker', ),
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => $prefix . 'affilate_group',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => __( 'Affilate {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Affilate', 'cmb2' ),
			'remove_button' => __( 'Remove Affilate', 'cmb2' ),
			'sortable'      => true, // beta
			 'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */


	// get all affilate
	$args = array('post_type' => 'affilate','posts_per_page' => -1);
	$affilate_array = get_posts($args);
	foreach($affilate_array as $affilate){
			$data[$affilate->ID] = $affilate->post_title;

    		}

	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => __( 'Affilate Name', 'cmb2' ),
		'id'         => 'affilate_title',
		'type'       => 'select',
		//'show_option_none' => true,
    	//'default'          => 'coming_soon',
    	'options'          => $data,
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name'        => __( 'Launch Status', 'cmb2' ),
		'id'          => 'launch_status',
		'type'       => 'select',
		//'show_option_none' => true,
    	'default'          => 'coming_soon',
    	'options'          => array(
    		'coming_soon' => __( 'Coming Soon', 'cmb' ),
		    'tbc'     => __( 'TBC', 'cmb' ),
		    'instock'   => __( 'In Stock', 'cmb' ),
		    'delayed'   => __( 'Delayed', 'cmb' ),
		    'sold_out'  => __( 'Sold Out', 'cmb' ),
		    'restock'   => __( 'Re Stock', 'cmb' ),
		    'raffle'   => __( 'Raffle', 'cmb' ),
        ),

	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name' => __( 'Launch Date', 'cmb2' ),
		'desc'       => __( ' Default Value is TBC. You Can Select Date Here.', 'cmb2' ),
		'id'   => 'launch_date',
		'type' => 'text_date_timestamp',

	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name' => __( 'Launch Time', 'cmb2' ),
		'desc'       => __( ' Default Value is TBC. You Can Select Time Here.', 'cmb2' ),
		'id'   => 'launch_time',
		'type' => 'text_time',
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name' => __( 'Affilate Link', 'cmb2' ),
		'desc'       => __( 'Your Link Will Automatically Be Converted as bit.ly Link In Front-End.', 'cmb2' ),
		'id'   => 'affilate_link',
		'type' => 'text_url',

	) );

}

//add_action( 'cmb2_admin_init', 'solefashion_affilate_metabox' );


function deals_offers(){
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_sf_';

	/**
	 * Repeatable Field Groups
	 */
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'deal',
		'title'        => __( 'Deal Offers', 'cmb2' ),
		'priority'     => 'low',
		'object_types' => array( 'deal', ),
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => $prefix . 'deal_group',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => __( 'Offer {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another offer', 'cmb2' ),
			'remove_button' => __( 'Remove offer', 'cmb2' ),
			'sortable'      => true, // beta
			'closed'     => true, // true to have the groups closed by default
		),
	) );


	$cmb_group->add_group_field( $group_field_id, array(
		'name'        => __( 'Offer Title', 'cmb2' ),
		'id'          => 'offer_title',
		'type'       => 'text',

	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name'        => __( 'Offer Description', 'cmb2' ),
		'id'          => 'offer_description',
		'type'       => 'text',

	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name' => __( 'Offer Link', 'cmb2' ),
		'id'   => 'offer_link',
		'type' => 'text_url',

	) );

	$cmb_group->add_group_field( $group_field_id, array(
	    'name'    => 'Offer Image',
	    'id'      => 'offer_image',
	    'type'    => 'file',
	    'text'    => array(
	        'add_upload_file_text' => 'Add Image' // Change upload button text. Default: "Add or Upload File"
	    ),
	) );

}
add_action( 'cmb2_init', 'deals_offers'  );


 add_action( 'cmb2_init', 'fastsole_status_term_metabox' );
 /**
  * Hook in and add a metabox to add fields to taxonomy terms
  */
 function fastsole_status_term_metabox() {
 	$prefix = 'status_term_';

 	/**
 	 * Metabox to add fields to categories and tags
 	 */
 	$cmb_term = new_cmb2_box( array(
 		'id'               => 'is_visible_front_page',
 		'title'            => esc_html__( 'Category Metabox', 'cmb2' ), // Doesn't output for term boxes
 		'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
 		'taxonomies'       => array( 'status' ), // Tells CMB2 which taxonomies should have these fields
 		// 'new_term_section' => true, // Will display in the "Add New Category" section
 	) );

 	/*$cmb_term->add_field( array(
 		'name'     => esc_html__( 'Extra Info', 'cmb2' ),
 		'desc'     => esc_html__( '', 'cmb2' ),
 		'id'       => $prefix . 'extra_info',
 		'type'     => 'title',
 		'on_front' => false,
 	) );*/

 	$cmb_term->add_field( array(
 		'name' => 'Visible this taxonomy in front page',
		'desc' => 'Check if you want to show this taxonomy in front page',
		'id'   => 'is_visible_enabled_front_page',
		'type' => 'checkbox',
 	) );

 }

function custom_brand(){
    // Start with an underscore to hide fields from custom fields list
    $prefix = '_sf_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'custom_brands',
		'title'         => __( 'Custom Brand (Use For Custom Brand Page Only)', 'cmb2' ),
		'object_types'  => array( 'page' ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		
		// 'context'    => 'side',
		 'priority'   => 'default',
		// 'show_names' => true, // Show field names on the left
		 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );


	$terms = get_terms("department");
	 $count = count($terms); 
			 if ( $count > 0 ) { 

			 	foreach ( $terms as $term ) { 
					$data[$term->slug] = $term->name;
			       } 
			   } 

	$cmb_demo->add_field( array(
		'name'       => __( 'Select Brand', 'cmb2' ),
		'desc'       => __( 'Select Brand Here', 'cmb2' ),
		'id'         => $prefix . 'custom_brand',
		'type'     	 => 'select',
		'options'    => $data,
		
	) );

	$terms = get_terms("colour");
	 $count = count($terms); 
			 if ( $count > 0 ) { 

			 	foreach ( $terms as $term ) { 
					$color[$term->slug] = $term->name;
			       } 
			   } 

	$cmb_demo->add_field( array(
		'name'       => __( 'Select Color', 'cmb2' ),
		'desc'       => __( 'Select Color Here', 'cmb2' ),
		'id'         => $prefix . 'custom_brand_color',
		'type'     => 'multicheck_inline',
		'options'    => $color,
	) );

}
add_action( 'cmb2_init', 'custom_brand'  );




















