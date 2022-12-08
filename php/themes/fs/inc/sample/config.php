<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "fastsole";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'FastSole Options', 'redux-framework-demo' ),
        'page_title'           => __( 'FastSole Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
         'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.


    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '<p>Welcome To FastSole Options Panel</p>', 'redux-framework-demo' ), $v );
    } else {
        $args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo' );
    }

    // Add content after the form.


    Redux::setArgs( $opt_name, $args );



    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title'            => __( 'General Settings', 'redux-framework-demo' ),
        'id'               => 'basic',
        'desc'             => __( 'These are really basic fields!', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-home'
    ) );


    Redux::setSection( $opt_name, array(
        'title'            => __( 'Header Options', 'redux-framework-demo' ),

        'id'               => 'header-options',
        'desc'       => __( 'Use Fields Below To Change Header Settings', 'redux-framework-demo' ),
        'subsection'       => true,
        'customizer_width' => '700px',
        'fields'           => array(
            array(
                'id'       => 'logo',
                'type'     => 'media',
                'title'    => __( 'Logo Uploader', 'redux-framework-demo' ),
                'subtitle' => __( 'Upload Logo', 'redux-framework-demo' ),
                'desc'     => __( 'Upload Your Resized Logo Here. Logo Size Should Be 303 * 45 px', 'redux-framework-demo' ),
                'compiler' => true,
                'default'  => array(
                    'url'  => get_template_directory_uri().'/img/logo.png'
                    ),

            ),

               array(
                'id'       => 'favicon',
                'type'     => 'media',
                'title'    => __( 'Favicon Uploader', 'redux-framework-demo' ),
                'subtitle' => __( 'Upload Favicon', 'redux-framework-demo' ),
                'desc'     => __( 'Upload Your Resized Favicon Here. Favicon Size Should Be 16 * 16 px', 'redux-framework-demo' ),
                'compiler' => true,


            ),


        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'            => __( 'Social Media', 'redux-framework-demo' ),

        'id'               => 'social-media',
        'desc'       => __( 'Use Fields Below To Change Social Media button Settings ', 'redux-framework-demo' ),
        'subsection'       => true,
        'customizer_width' => '700px',
        'fields'           => array(
             array(
                'id'       => 'facebook-link',
                'type'     => 'text',
                'title'    => __( 'Facebook Link', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Facebook Link', 'redux-framework-demo' ),
                'desc'     => __( 'Give Your Facebook Link Here.Unless You Put A Link, Icon Will Not Appear', 'redux-framework-demo' ),

            ),
              array(
                'id'       => 'twitter-link',
                'type'     => 'text',
                'title'    => __( 'Twitter Link', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Twitter Link', 'redux-framework-demo' ),
                'desc'     => __( 'Give Your Twitter Link Here.Unless You Put A Link, Icon Will Not Appear', 'redux-framework-demo' ),

            ),

               array(
                'id'       => 'google-plus-link',
                'type'     => 'text',
                'title'    => __( 'Google-Plus Link', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Google-Plus Link', 'redux-framework-demo' ),
                'desc'     => __( 'Give Your Google-Plus Link Here.Unless You Put A Link, Icon Will Not Appear', 'redux-framework-demo' ),


            ),

            array(
                'id'       => 'instagram-link',
                'type'     => 'text',
                'title'    => __( 'Instagram Link', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Instagram Link', 'redux-framework-demo' ),
                'desc'     => __( 'Give Your Instagram Link Here.Unless You Put A Link, Icon Will Not Appear', 'redux-framework-demo' ),

            ),

              array(
                'id'       => 'pintarest-link',
                'type'     => 'text',
                'title'    => __( 'Pinterest Link', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Pinterest Link', 'redux-framework-demo' ),
                'desc'     => __( 'Give Your Pinterest Link Here.Unless You Put A Link, Icon Will Not Appear', 'redux-framework-demo' ),


            ),



        )
    ) );



    Redux::setSection( $opt_name, array(
        'title'      => __( 'Footer Options', 'redux-framework-demo' ),
        'id'         => 'footer-options',
        'desc'       => __( 'Use Fields Below To Change Settings In Footer ', 'redux-framework-demo' ) ,
        'subsection' => true,
        'fields'     => array(

            array(
                'id'       => 'footer-logo',
                'type'     => 'media',
                'title'    => __( 'Footer Logo Uploader', 'redux-framework-demo' ),
                'subtitle' => __( 'Upload Footer Logo', 'redux-framework-demo' ),
                'desc'     => __( 'Upload Your Resized Footer Logo Here. Logo Size Should Be 224 * 33 px', 'redux-framework-demo' ),
                'compiler' => true,
                'default'  => array(
                    'url'  => get_template_directory_uri().'/img/footer-logo.png'
                    ),

            ),

                array(
                'id'       => 'footer-text',
                'type'     => 'editor',
                'title'    => __( 'Footer Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Footer Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Footer Text', 'redux-framework-demo' ),

             ),

              array(
                'id'       => 'footer-page-link',
                'type'     => 'select',
                'multi'    => false,
                'data'     => 'pages',
                'title'    => __( 'Footer Page link', 'redux-framework-demo' ),
                'subtitle' => __( 'Selected Page as Footer Page link', 'redux-framework-demo' ),

            ),
        )
    ) );



     Redux::setSection( $opt_name, array(
        'title'            => __( 'Styling Options', 'redux-framework-demo' ),
        'id'               => 'styling',
        'desc'             => __( 'These are really basic fields!', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-edit'
    ) );


     Redux::setSection( $opt_name, array(
        'title'            => __( 'Style Options', 'redux-framework-demo' ),

        'id'               => 'style-options',
        'desc'       => __( 'Use Fields Below To Change Theme Style', 'redux-framework-demo' ),
        'subsection'       => true,
        'customizer_width' => '700px',
        'fields'           => array(

            array(
                'id'       => 'custom-css',
                'type'     => 'ace_editor',
                'title'    => __( 'Custom CSS', 'redux-framework-demo' ),
                'subtitle' => __( 'Write Custom CSS', 'redux-framework-demo' ),
                'desc'     => __( 'You Can Put Your Custom CSS Here', 'redux-framework-demo' ),
                'mode'     => 'css',

            ),


        )
    ) );


       Redux::setSection( $opt_name, array(
        'title'            => __( 'Home Page', 'redux-framework-demo' ),
        'id'               => 'home-page',
        'desc'             => __( 'These are really basic fields!', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-edit'
    ) );

     Redux::setSection( $opt_name, array(
        'title'      => __( 'Home Slider', 'redux-framework-demo' ),
        'id'         => 'home-page-slider',
        'subsection' => true,
        'fields'     => array(

                 array(
                'id'       => 'home-slider',
                'type'     => 'slides',
                'title'    => __( 'Home Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Home Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 780 px * hight 400 px. Note: Use Url Field To Give A Link To Your Slide Image.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'slider-banner-1-title',
                'type'     => 'text',
                'title'    => __( 'Slider Banner 1 Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Slider Banner 1 Title', 'redux-framework-demo' ),
                'desc'     => __( 'Give Your Slider Banner 1 Title Here.', 'redux-framework-demo' ),


            ),
                 array(
                'id'       => 'slider-banner-1-link',
                'type'     => 'text',
                'title'    => __( 'Slider Banner 1 Link', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Slider Banner 1 Link', 'redux-framework-demo' ),
                'desc'     => __( 'Give Your Slider Banner 1 Link Here.', 'redux-framework-demo' ),


            ),
                array(
                'id'       => 'slider-banner-1',
                'type'     => 'media',
                'title'    => __( 'Slider Banner 1 Image', 'redux-framework-demo' ),
                'subtitle' => __( 'Slider Banner 1 Image', 'redux-framework-demo' ),
                'desc'     => __( 'Banner Image Size Should Be width 180 px * hight 200 px.', 'redux-framework-demo' ),

             ),
               array(
                'id'       => 'slider-banner-2-title',
                'type'     => 'text',
                'title'    => __( 'Slider Banner 2 Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Slider Banner 2 Title', 'redux-framework-demo' ),
                'desc'     => __( 'Give Your Slider Banner 2 Title Here.', 'redux-framework-demo' ),


            ),
                 array(
                'id'       => 'slider-banner-2-link',
                'type'     => 'text',
                'title'    => __( 'Slider Banner 2 Link', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Slider Banner 2 Link', 'redux-framework-demo' ),
                'desc'     => __( 'Give Your Slider Banner 2 Link Here.', 'redux-framework-demo' ),


            ),
                array(
                'id'       => 'slider-banner-2',
                'type'     => 'media',
                'title'    => __( 'Slider Banner 2 Image', 'redux-framework-demo' ),
                'subtitle' => __( 'Slider Banner 2 Image', 'redux-framework-demo' ),
                'desc'     => __( 'Banner Image Size Should Be width 180 px * hight 200 px.', 'redux-framework-demo' ),

             ),



        )
    ) );

      Redux::setSection( $opt_name, array(
        'title'      => __( 'On-Focus Section', 'redux-framework-demo' ),
        'id'         => 'on-focus-section',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'onfocus_product_categories_title',
                'type'     => 'text',
                'title'    => __( 'On-Focus title', 'redux-framework-demo' ),
                'subtitle' => __( 'Change On-Focus title', 'redux-framework-demo' ),
                'desc'     => __( 'Give On-Focus block title Here.', 'redux-framework-demo' ),

            ),

            array(
                    'id'     =>'onfocus_product_categories',
                    'type' => 'select',
                    'data' => 'categories',
                    'args' => array('taxonomy' => array('status') ),
                    'placeholder' => 'Select Status',
                    'title' => __('On-Focus Status', 'redux-framework-demo'),
                    'subtitle' => __('Products from the selected status will be displayed at On-Focus section on home page', 'redux-framework-demo'),

                    'desc'     => __( 'Status.', 'redux-framework-demo' ),

                    ),


            array(
                'id'       => 'onfocus_product_numbers',
                'type'     => 'select',
                'title'    => __( 'On-Focus Number of products', 'redux-framework-demo' ),
                'desc'     => __( 'Number of products.', 'redux-framework-demo' ),
                'placeholder'     => __( 'Select number', 'redux-framework-demo' ),
                'default' => '20',
                'options'  => array(
                            '20' => '20 products per block',
                            '30' => '30 products per block',
                            '40' => '40 products per block',
                            '50' => '50 products per block',
                        ),

            ),


        )
    ) );


       Redux::setSection( $opt_name, array(
        'title'      => __( 'Coming soon Section', 'redux-framework-demo' ),
        'id'         => 'coming-soon-section',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'coming_soon_product_categories_title',
                'type'     => 'text',
                'title'    => __( 'Coming soon title', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Coming soon title', 'redux-framework-demo' ),
                'desc'     => __( 'Give Coming soon block title Here.', 'redux-framework-demo' ),

            ),

            array(
                    'id'     =>'coming_soon_product_categories',
                    'type' => 'select',
                    'data' => 'categories',
                    'args' => array('taxonomy' => array('status') ),
                    'placeholder' => 'Select Status',
                    'title' => __('Coming soon Status', 'redux-framework-demo'),
                    'subtitle' => __('Products from the selected status will be displayed at Coming soon section on home page', 'redux-framework-demo'),

                    'desc'     => __( 'Status.', 'redux-framework-demo' ),

                    ),


            array(
                'id'       => 'coming_soon_product_numbers',
                'type'     => 'select',
                'title'    => __( 'Coming soon Number of products', 'redux-framework-demo' ),
                'desc'     => __( 'Number of products.', 'redux-framework-demo' ),
                'placeholder'     => __( 'Select number', 'redux-framework-demo' ),
                'default' => '20',
                'options'  => array(
                            '20' => '20 products per block',
                            '30' => '30 products per block',
                            '40' => '40 products per block',
                            '50' => '50 products per block',
                        ),

            ),


        )
    ) );


      Redux::setSection( $opt_name, array(
        'title'      => __( 'Top-Brands Section', 'redux-framework-demo' ),
        'id'         => 'top-brands-section',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'top_brands_section_title',
                'type'     => 'text',
                'title'    => __( 'Top-Brands section title', 'redux-framework-demo' ),
                'subtitle' => __( 'ChangeTop-Brands section title', 'redux-framework-demo' ),
                'desc'     => __( 'Give Top-Brands section title Here.', 'redux-framework-demo' ),

            ),

             array(
                'id'       => 'top-brands',
                'type'     => 'slides',
                'title'    => __( 'Top Brands', 'redux-framework-demo' ),
                'subtitle' => __( 'Select Top Brands', 'redux-framework-demo' ),
                'desc'     => __( 'Image Size Should Be width 700 px * hight 450 px. Note: Use Url Field To Give A Link To Your Slide Image.', 'redux-framework-demo' ),

             )






        )
    ) );

            Redux::setSection( $opt_name, array(
            'title'      => __( 'Mid Banner Section', 'redux-framework-demo' ),
            'id'         => 'mid-banner-section',
            'subsection' => true,
            'fields'     => array(


                array(
                'id'       => 'mid-banner-1-title',
                'type'     => 'text',
                'title'    => __( 'Mid Banner 1 Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Mid Banner 1 Title', 'redux-framework-demo' ),
                'desc'     => __( 'Give Your Mid Banner 1 Title Here.', 'redux-framework-demo' ),


            ),
                 array(
                'id'       => 'mid-banner-1-link',
                'type'     => 'text',
                'title'    => __( 'Mid Banner 1 Link', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Mid Banner 1 Link', 'redux-framework-demo' ),
                'desc'     => __( 'Give Your Mid Banner 1 Link Here.', 'redux-framework-demo' ),


            ),
                array(
                'id'       => 'mid-banner-1',
                'type'     => 'media',
                'title'    => __( 'Mid Banner 1 Image', 'redux-framework-demo' ),
                'subtitle' => __( 'Mid Banner 1 Image', 'redux-framework-demo' ),
                'desc'     => __( 'Banner Image Size Should Be width 570 px * hight 80 px.', 'redux-framework-demo' ),

             ),
               array(
                'id'       => 'mid-banner-2-title',
                'type'     => 'text',
                'title'    => __( 'Mid Banner 2 Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Mid Banner 2 Title', 'redux-framework-demo' ),
                'desc'     => __( 'Give Your Mid Banner 2 Title Here.', 'redux-framework-demo' ),


            ),
                 array(
                'id'       => 'mid-banner-2-link',
                'type'     => 'text',
                'title'    => __( 'Mid Banner 2 Link', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Mid Banner 2 Link', 'redux-framework-demo' ),
                'desc'     => __( 'Give Your Mid Banner 2 Link Here.', 'redux-framework-demo' ),


            ),
                array(
                'id'       => 'mid-banner-2',
                'type'     => 'media',
                'title'    => __( 'Mid Banner 2 Image', 'redux-framework-demo' ),
                'subtitle' => __( 'Mid Banner 2 Image', 'redux-framework-demo' ),
                'desc'     => __( 'Banner Image Size Should Be width 570 px * hight 80 px.', 'redux-framework-demo' ),

             ),




        )
    ) );

     Redux::setSection( $opt_name, array(
        'title'            => __( 'Releases Section', 'redux-framework-demo' ),

        'id'               => 'home-options',
        'desc'       => __( 'Use Fields Below To set Releases Section', 'redux-framework-demo' ),
        'subsection'       => true,
        'customizer_width' => '700px',
        'fields'           => array(

              array(
                'id'       => 'first_block_product_categories_title',
                'type'     => 'text',
                'title'    => __( 'First block title', 'redux-framework-demo' ),
                'subtitle' => __( 'Change First block title', 'redux-framework-demo' ),
                'desc'     => __( 'Give First block title Here.', 'redux-framework-demo' ),

            ),

            array(
                    'id'     =>'first_block_product_categories',
                    'type' => 'select',
                    'data' => 'categories',
                    'args' => array('taxonomy' => array('status') ),
                    'placeholder' => 'Select Status',
                    'title' => __('First block Status', 'redux-framework-demo'),
                    'subtitle' => __('Products from the selected status will be displayed at first block of releases section on home page', 'redux-framework-demo'),

                    'desc'     => __( 'Status.', 'redux-framework-demo' ),

                    ),


            array(
                'id'       => 'first_block_product_numbers',
                'type'     => 'select',
                'title'    => __( 'First block Number of products', 'redux-framework-demo' ),
                'desc'     => __( 'Number of products.', 'redux-framework-demo' ),
                'placeholder'     => __( 'Select number', 'redux-framework-demo' ),
                'default' => '20',
                'options'  => array(
                            '20' => '20 products per block',
                            '30' => '30 products per block',
                            '40' => '40 products per block',
                            '50' => '50 products per block',
                        ),

            ),

              array(
                'id'       => 'second_block_product_categories_title',
                'type'     => 'text',
                'title'    => __( 'Second block title', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Second block title', 'redux-framework-demo' ),
                'desc'     => __( 'Give Second block title Here.', 'redux-framework-demo' ),

            ),

            array(
                    'id'     =>'second_block_product_categories',
                    'type' => 'select',
                    'data' => 'categories',
                    'args' => array('taxonomy' => array('status') ),
                    'placeholder' => 'Select Status',
                    'title' => __('Second block Status', 'redux-framework-demo'),
                    'subtitle' => __('Products from the selected status will be displayed at second block of releases section on home page', 'redux-framework-demo'),
                    'desc'     => __( 'Status.', 'redux-framework-demo' ),
                    ),
             array(
                'id'       => 'second_block_product_numbers',
                'type'     => 'select',
                'title'    => __( 'Second block Number of products', 'redux-framework-demo' ),
                'desc'     => __( 'Number of products.', 'redux-framework-demo' ),
                'placeholder'     => __( 'Select number', 'redux-framework-demo' ),
                'default' => '20',
                'options'  => array(
                            '20' => '20 products per block',
                            '30' => '30 products per block',
                            '40' => '40 products per block',
                            '50' => '50 products per block',
                        ),

            ),


               array(
                'id'       => 'third_block_product_categories_title',
                'type'     => 'text',
                'title'    => __( 'Third block title', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Third block title', 'redux-framework-demo' ),
                'desc'     => __( 'Give Third block title Here.', 'redux-framework-demo' ),

            ),

            array(
                    'id'     =>'third_block_product_categories',
                    'type' => 'select',
                    'data' => 'categories',
                    'args' => array('taxonomy' => array('status') ),
                    'placeholder' => 'Select Status',
                    'title' => __('Third block Status', 'redux-framework-demo'),
                    'subtitle' => __('Products from the selected status will be displayed at third block of releases section on home page', 'redux-framework-demo'),
                    'desc'     => __( 'Status.', 'redux-framework-demo' ),
                    ),

             array(
                'id'       => 'third_block_product_numbers',
                'type'     => 'select',
                'title'    => __( 'Third block Number of products', 'redux-framework-demo' ),
                'desc'     => __( 'Number of products.', 'redux-framework-demo' ),
                'placeholder'     => __( 'Select number', 'redux-framework-demo' ),
                'default' => '20',
                'options'  => array(
                            '20' => '20 products per block',
                            '30' => '30 products per block',
                            '40' => '40 products per block',
                            '50' => '50 products per block',
                        ),

            ),


               array(
                'id'       => 'fourth_block_product_categories_title',
                'type'     => 'text',
                'title'    => __( 'Fourth block title', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Fourth block title', 'redux-framework-demo' ),
                'desc'     => __( 'Give Fourth block title Here.', 'redux-framework-demo' ),

            ),

            array(
                    'id'     =>'fourth_block_product_categories',
                    'type' => 'select',
                    'data' => 'categories',
                    'args' => array('taxonomy' => array('status') ),
                    'placeholder' => 'Select Status',
                    'title' => __('Fourth block Status', 'redux-framework-demo'),
                    'subtitle' => __('Products from the selected status will be displayed at fourth block of releases section on home page', 'redux-framework-demo'),
                    'desc'     => __( 'Status.', 'redux-framework-demo' ),
                    ),

             array(
                'id'       => 'fourth_block_product_numbers',
                'type'     => 'select',
                'title'    => __( 'Fourth block Number of products', 'redux-framework-demo' ),
                'desc'     => __( 'Number of products.', 'redux-framework-demo' ),
                'placeholder'     => __( 'Select number', 'redux-framework-demo' ),
                'default' => '20',
                'options'  => array(
                            '20' => '20 products per block',
                            '30' => '30 products per block',
                            '40' => '40 products per block',
                            '50' => '50 products per block',
                        ),

            ),


            array(
                'id'       => 'fifth_block_product_categories_title',
                'type'     => 'text',
                'title'    => __( 'Fifth block title', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Fifth block title', 'redux-framework-demo' ),
                'desc'     => __( 'Give Fifth block title Here.', 'redux-framework-demo' ),

            ),

            array(
                    'id'     =>'fifth_block_product_categories',
                    'type' => 'select',
                    'data' => 'categories',
                    'args' => array('taxonomy' => array('status') ),
                    'placeholder' => 'Select Status',
                    'title' => __('Fifth block Status', 'redux-framework-demo'),
                    'subtitle' => __('Products from the selected status will be displayed at fifth block of releases section on home page', 'redux-framework-demo'),
                    'desc'     => __( 'Status.', 'redux-framework-demo' ),
                    ),

             array(
                'id'       => 'fifth_block_product_numbers',
                'type'     => 'select',
                'title'    => __( 'Fifth block Number of products', 'redux-framework-demo' ),
                'desc'     => __( 'Number of products.', 'redux-framework-demo' ),
                'placeholder'     => __( 'Select number', 'redux-framework-demo' ),
                'default' => '20',
                'options'  => array(
                            '20' => '20 products per block',
                            '30' => '30 products per block',
                            '40' => '40 products per block',
                            '50' => '50 products per block',
                        ),

            ),


        )
    ) );



     Redux::setSection( $opt_name, array(
        'title'            => __( 'Brands Section', 'redux-framework-demo' ),

        'id'               => 'brand-options',
        'desc'       => __( 'Use Fields Below To Set Brands Section On Home Page', 'redux-framework-demo' ),
        'subsection'       => true,
        'customizer_width' => '700px',
        'fields'           => array(

             array(
                'id'       => 'brand-banner-title',
                'type'     => 'text',
                'title'    => __( 'Brand Banner Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Brand Banner  Title', 'redux-framework-demo' ),
                'desc'     => __( 'Give Brand Banner Title Here.', 'redux-framework-demo' ),


            ),
                 array(
                'id'       => 'brand-banner-link',
                'type'     => 'text',
                'title'    => __( 'Brand Banner Link', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Brand Banner Link', 'redux-framework-demo' ),
                'desc'     => __( 'Give Brand Banner Link Here.', 'redux-framework-demo' ),


            ),
                array(
                'id'       => 'brand-banner',
                'type'     => 'media',
                'title'    => __( 'Brand Banner Image', 'redux-framework-demo' ),
                'subtitle' => __( 'Brand Banner Image', 'redux-framework-demo' ),
                'desc'     => __( 'Brand Banner Image Size Should Be width 365 px * hight 640 px.', 'redux-framework-demo' ),

             ),

              array(
                'id'       => 'brand_first_block_product_categories_title',
                'type'     => 'text',
                'title'    => __( 'First block title', 'redux-framework-demo' ),
                'subtitle' => __( 'Change First block title', 'redux-framework-demo' ),
                'desc'     => __( 'Give First block title Here.', 'redux-framework-demo' ),

            ),

            array(
                    'id'     =>'brand_first_block_product_categories',
                    'type' => 'select',
                    'data' => 'categories',
                    'args' => array('taxonomy' => array('department') ),
                    'placeholder' => 'Select Brand',
                    'title' => __('First block Brand', 'redux-framework-demo'),
                    'subtitle' => __('Products from the selected brand will be displayed at first block of brands section on home page', 'redux-framework-demo'),

                    'desc'     => __( 'Brand.', 'redux-framework-demo' ),

                    ),


            array(
                'id'       => 'brand_first_block_product_numbers',
                'type'     => 'select',
                'title'    => __( 'First block Number of products', 'redux-framework-demo' ),
                'desc'     => __( 'Number of products.', 'redux-framework-demo' ),
                'placeholder'     => __( 'Select number', 'redux-framework-demo' ),
                'default' => '20',
                'options'  => array(
                            '20' => '20 products per block',
                            '30' => '30 products per block',
                            '40' => '40 products per block',
                            '50' => '50 products per block',
                        ),

            ),

              array(
                'id'       => 'brand_second_block_product_categories_title',
                'type'     => 'text',
                'title'    => __( 'Second block title', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Second block title', 'redux-framework-demo' ),
                'desc'     => __( 'Give Second block title Here.', 'redux-framework-demo' ),

            ),

            array(
                    'id'     =>'brand_second_block_product_categories',
                    'type' => 'select',
                    'data' => 'categories',
                    'args' => array('taxonomy' => array('department') ),
                    'placeholder' => 'Select Brand',
                    'title' => __('Second block Brand', 'redux-framework-demo'),
                    'subtitle' => __('Products from the selected brand will be displayed at second block of brands section on home page', 'redux-framework-demo'),
                    'desc'     => __( 'Brand.', 'redux-framework-demo' ),
                    ),
             array(
                'id'       => 'brand_second_block_product_numbers',
                'type'     => 'select',
                'title'    => __( 'Second block Number of products', 'redux-framework-demo' ),
                'desc'     => __( 'Number of products.', 'redux-framework-demo' ),
                'placeholder'     => __( 'Select number', 'redux-framework-demo' ),
                'default' => '20',
                'options'  => array(
                            '20' => '20 products per block',
                            '30' => '30 products per block',
                            '40' => '40 products per block',
                            '50' => '50 products per block',
                        ),

            ),


               array(
                'id'       => 'brand_third_block_product_categories_title',
                'type'     => 'text',
                'title'    => __( 'Third block title', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Third block title', 'redux-framework-demo' ),
                'desc'     => __( 'Give Third block title Here.', 'redux-framework-demo' ),

            ),

            array(
                    'id'     =>'brand_third_block_product_categories',
                    'type' => 'select',
                    'data' => 'categories',
                    'args' => array('taxonomy' => array('department') ),
                    'placeholder' => 'Select Brand',
                    'title' => __('Third block Brand', 'redux-framework-demo'),
                    'subtitle' => __('Products from the selected brand will be displayed at third block of brand section on home page', 'redux-framework-demo'),
                    'desc'     => __( 'Brand.', 'redux-framework-demo' ),
                    ),

             array(
                'id'       => 'brand_third_block_product_numbers',
                'type'     => 'select',
                'title'    => __( 'Third block Number of products', 'redux-framework-demo' ),
                'desc'     => __( 'Number of products.', 'redux-framework-demo' ),
                'placeholder'     => __( 'Select number', 'redux-framework-demo' ),
                'default' => '20',
                'options'  => array(
                            '20' => '20 products per block',
                            '30' => '30 products per block',
                            '40' => '40 products per block',
                            '50' => '50 products per block',
                        ),

            ),


               array(
                'id'       => 'brand_fourth_block_product_categories_title',
                'type'     => 'text',
                'title'    => __( 'Fourth block title', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Fourth block title', 'redux-framework-demo' ),
                'desc'     => __( 'Give Fourth block title Here.', 'redux-framework-demo' ),

            ),

            array(
                    'id'     =>'brand_fourth_block_product_categories',
                    'type' => 'select',
                    'data' => 'categories',
                    'args' => array('taxonomy' => array('department') ),
                    'placeholder' => 'Select Brand',
                    'title' => __('Fourth block Brand', 'redux-framework-demo'),
                    'subtitle' => __('Products from the selected brand will be displayed at fourth block of brand section on home page', 'redux-framework-demo'),
                    'desc'     => __( 'Brand.', 'redux-framework-demo' ),
                    ),

             array(
                'id'       => 'brand_fourth_block_product_numbers',
                'type'     => 'select',
                'title'    => __( 'Fourth block Number of products', 'redux-framework-demo' ),
                'desc'     => __( 'Number of products.', 'redux-framework-demo' ),
                'placeholder'     => __( 'Select number', 'redux-framework-demo' ),
                'default' => '20',
                'options'  => array(
                            '20' => '20 products per block',
                            '30' => '30 products per block',
                            '40' => '40 products per block',
                            '50' => '50 products per block',
                        ),

            ),


            array(
                'id'       => 'brand_fifth_block_product_categories_title',
                'type'     => 'text',
                'title'    => __( 'Fifth block title', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Fifth block title', 'redux-framework-demo' ),
                'desc'     => __( 'Give Fifth block title Here.', 'redux-framework-demo' ),

            ),

            array(
                    'id'     =>'brand_fifth_block_product_categories',
                    'type' => 'select',
                    'data' => 'categories',
                    'args' => array('taxonomy' => array('department') ),
                    'placeholder' => 'Select Brand',
                    'title' => __('Fifth block Brand', 'redux-framework-demo'),
                    'subtitle' => __('Products from the selected brand will be displayed at fifth block of brand section on home page', 'redux-framework-demo'),
                    'desc'     => __( 'Brand.', 'redux-framework-demo' ),
                    ),

             array(
                'id'       => 'brand_fifth_block_product_numbers',
                'type'     => 'select',
                'title'    => __( 'Fifth block Number of products', 'redux-framework-demo' ),
                'desc'     => __( 'Number of products.', 'redux-framework-demo' ),
                'placeholder'     => __( 'Select number', 'redux-framework-demo' ),
                'default' => '20',
                'options'  => array(
                            '20' => '20 products per block',
                            '30' => '30 products per block',
                            '40' => '40 products per block',
                            '50' => '50 products per block',
                        ),

            ),


        )
    ) );

      Redux::setSection( $opt_name, array(
        'title'            => __( 'Home Description', 'redux-framework-demo' ),

        'id'               => 'fs-home-description',
        'desc'       => __( 'Use Fields Below To Set Description For Home Page', 'redux-framework-demo' ),
        'subsection'       => true,
        'customizer_width' => '700px',
        'fields'           => array(


                 array(
                            'id'       => 'fs-home-text',
                            'type'     => 'editor',
                            'title'    => __( 'Home Text', 'redux-framework-demo' ),
                            'subtitle' => __( 'Home Text', 'redux-framework-demo' ),
                            'desc'     => __( 'Add Description For Home Text', 'redux-framework-demo' ),
                            'args'   => array(
                            'teeny'            => false,
                            'textarea_rows'    => 10,
                            'wpautop'          => false,
                            ),

                         ),



        )
    ) );


        Redux::setSection( $opt_name, array(
        'title'            => __( 'Sneaker Page Settings', 'redux-framework-demo' ),
        'id'               => 'sneaker-archive-media',
        'desc'             => __( 'Sneaker Page Settings', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-edit'
    ) );

     Redux::setSection( $opt_name, array(
        'title'      => __( 'Sneaker Archive', 'redux-framework-demo' ),
        'id'         => 'sneaker-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'sneaker-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Sneaker Archive Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Sneaker Archive Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                     array(
                'id'       => 'sneaker-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Sneaker archive Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Sneaker archive Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Sneaker archive Text', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

            ),
                          array(
                'id'       => 'sneaker-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Sneaker archive Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Sneaker archive Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add comma separated Sneaker archive Meta Keywords', 'redux-framework-demo' ),


            ),

        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Sneaker Page', 'redux-framework-demo' ),
        'id'         => 'sneaker-page-media-settings',
        'subsection' => true,
        'fields'     => array(

                  array(
                'id'       => 'related_product_title',
                'type'     => 'text',
                'title'    => __( 'Related Product Heading', 'redux-framework-demo' ),
                'subtitle' => __( 'Change Related Product Heading', 'redux-framework-demo' ),
                'desc'     => __( 'Give Related Product block Heading Here.', 'redux-framework-demo' ),

            ),

            array(
                    'id'     =>'related_product_categories',
                    'type' => 'select',
                    'data' => 'categories',
                    'args' => array('taxonomy' => array('status') ),
                    'placeholder' => 'Select Status',
                    'title' => __('Related Product block Status', 'redux-framework-demo'),
                    'subtitle' => __('Products from the selected status will be displayed at Related Product block on single page', 'redux-framework-demo'),
                    'desc'     => __( 'Status.', 'redux-framework-demo' ),
                    ),

             array(
                'id'       => 'related_product_numbers',
                'type'     => 'select',
                'title'    => __( 'Related Product block Number of products', 'redux-framework-demo' ),
                'desc'     => __( 'Number of products.', 'redux-framework-demo' ),
                'placeholder'     => __( 'Select number', 'redux-framework-demo' ),
                'default' => '10',
                'options'  => array(
                            '5' => '5 products per block',
                            '10' => '10 products per block',
                            '15' => '15 products per block',
                            '20' => '20 products per block',
                        ),

            ),

        )
    ) );



        Redux::setSection( $opt_name, array(
        'title'            => __( 'Brand Page Settings', 'redux-framework-demo' ),
        'id'               => 'archive-media',
        'desc'             => __( 'Brand Page Settings', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-edit'
    ) );

     Redux::setSection( $opt_name, array(
        'title'      => __( 'Nike', 'redux-framework-demo' ),
        'id'         => 'nike-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'nike-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Nike Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Nike Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'nike-archive-title',
                'type'     => 'text',
                'title'    => __( 'Nike Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Nike Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'nike-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Nike Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Nike Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                   array(
                'id'       => 'nike-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Nike Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Nike Page', 'redux-framework-demo' ),

             ),

              array(
                    'id'     =>'nike-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Nike Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at nake page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );

     Redux::setSection( $opt_name, array(
        'title'      => __( 'Nike Dunk', 'redux-framework-demo' ),
        'id'         => 'dunk-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'dunk-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Nike Dunk Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Nike Dunk Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'dunk-archive-title',
                'type'     => 'text',
                'title'    => __( 'Nike Dunk Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Dunk Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Nike Dunk Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'dunk-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Nike Dunk Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Dunk Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Nike Dunk Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

                  array(
                'id'       => 'dunk-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Nike Dunk Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Dunk Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Nike Dunk Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'dunk-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Nike Dunk Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Nike Dunk page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );

              Redux::setSection( $opt_name, array(
        'title'      => __( 'Nike Blazer', 'redux-framework-demo' ),
        'id'         => 'blazer-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'blazer-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Nike Blazer Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Nike Blazer Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'blazer-archive-title',
                'type'     => 'text',
                'title'    => __( 'Nike Blazer Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Blazer Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Nike Blazer Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'blazer-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Nike Blazer Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Blazer Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Nike Blazer Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

                  array(
                'id'       => 'blazer-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Nike Blazer Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Blazer Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Nike Blazer Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'blazer-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Nike Blazer Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Nike Blazer page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );

                  Redux::setSection( $opt_name, array(
        'title'      => __( 'Nike Waffle One', 'redux-framework-demo' ),
        'id'         => 'waffle-one-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'waffle-one-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Nike Waffle One Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Nike Waffle One Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'waffle-one-archive-title',
                'type'     => 'text',
                'title'    => __( 'Nike Waffle One Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Waffle One Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Nike Waffle One Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'waffle-one-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Nike Waffle One Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Waffle One Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Nike Waffle One Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

                  array(
                'id'       => 'waffle-one-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Nike Waffle One Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Waffle One Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Nike Waffle One Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'waffle-one-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Nike Waffle One Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Nike Waffle One page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


     Redux::setSection( $opt_name, array(
        'title'      => __( 'Nike Jordan', 'redux-framework-demo' ),
        'id'         => 'nike-jordan-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'nike-jordan-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Nike Jordan Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Nike Jordan Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'nike-jordan-archive-title',
                'type'     => 'text',
                'title'    => __( 'Nike Jordan Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Jordan Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Nike Jordan Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'nike-jordan-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Nike Jordan Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Jordan Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Nike Jordan Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

                  array(
                'id'       => 'nike-jordan-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Nike Jordan Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Jordan Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Nike Jordan Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'nike-jordan-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Nike Jordan Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Nike Jordan page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


     Redux::setSection( $opt_name, array(
        'title'      => __( 'Air Jordan 1', 'redux-framework-demo' ),
        'id'         => 'air-jordan-1-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'air-jordan-1-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Air Jordan 1 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Air Jordan 1 Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'air-jordan-1-archive-title',
                'type'     => 'text',
                'title'    => __( 'Air Jordan 1 Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 1 Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Air Jordan 1 Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'air-jordan-1-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Air Jordan 1 Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 1 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Air Jordan 1 Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

                  array(
                'id'       => 'air-jordan-1-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Air Jordan 1 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 1 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Air Jordan 1 Page', 'redux-framework-demo' ),

             ),

              array(
                    'id'     =>'air-jordan-1-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Air Jordan 1 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Air Jordan 1 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


        Redux::setSection( $opt_name, array(
        'title'      => __( 'Air Jordan 3', 'redux-framework-demo' ),
        'id'         => 'air-jordan-3-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'air-jordan-3-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Air Jordan 3 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Air Jordan 3 Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'air-jordan-3-archive-title',
                'type'     => 'text',
                'title'    => __( 'Air Jordan 3 Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 3 Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Air Jordan 3 Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'air-jordan-3-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Air Jordan 3 Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 3 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Air Jordan 3 Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

                  array(
                'id'       => 'air-jordan-3-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Air Jordan 3 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 3 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Air Jordan 3 Page', 'redux-framework-demo' ),

             ),

                  array(
                    'id'     =>'air-jordan-3-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Air Jordan 3 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Air Jordan 3 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


           Redux::setSection( $opt_name, array(
        'title'      => __( 'Air Jordan 4', 'redux-framework-demo' ),
        'id'         => 'nike-air-jordan-4-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'nike-air-jordan-4-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Air Jordan 4 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Air Jordan 4 Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'nike-air-jordan-4-archive-title',
                'type'     => 'text',
                'title'    => __( 'Air Jordan 4 Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 4 Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Air Jordan 1 Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'nike-air-jordan-4-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Air Jordan 4 Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 4 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Air Jordan 4 Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

                  array(
                'id'       => 'nike-air-jordan-4-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Air Jordan 4 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 4 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Air Jordan 4 Page', 'redux-framework-demo' ),

             ),

                  array(
                    'id'     =>'nike-air-jordan-4-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Air Jordan 4 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Air Jordan 4 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );

              Redux::setSection( $opt_name, array(
        'title'      => __( 'Air Jordan 5', 'redux-framework-demo' ),
        'id'         => 'air-jordan-5-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'air-jordan-5-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Air Jordan 5 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Air Jordan 5 Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'air-jordan-5-archive-title',
                'type'     => 'text',
                'title'    => __( 'Air Jordan 5 Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 5 Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Air Jordan 5 Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'air-jordan-5-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Air Jordan 5 Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 5 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Air Jordan 5 Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

                  array(
                'id'       => 'air-jordan-5-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Air Jordan 5 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 5 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Air Jordan 5 Page', 'redux-framework-demo' ),

             ),

                  array(
                    'id'     =>'air-jordan-5-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Air Jordan 5 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Air Jordan 5 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


      Redux::setSection( $opt_name, array(
        'title'      => __( 'Air Jordan 6', 'redux-framework-demo' ),
        'id'         => 'air-jordan-6-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'air-jordan-6-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Air Jordan 6 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Air Jordan 6 Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'air-jordan-6-archive-title',
                'type'     => 'text',
                'title'    => __( 'Air Jordan 6 Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 6 Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Air Jordan 6 Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'air-jordan-6-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Air Jordan 6 Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 6 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Air Jordan 6 Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

                  array(
                'id'       => 'air-jordan-6-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Air Jordan 6 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 6 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Air Jordan 6 Page', 'redux-framework-demo' ),

             ),

                  array(
                    'id'     =>'air-jordan-6-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Air Jordan 6 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Air Jordan 6 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


                Redux::setSection( $opt_name, array(
        'title'      => __( 'Air Jordan 11', 'redux-framework-demo' ),
        'id'         => 'air-jordan-11-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'air-jordan-11-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Air Jordan 11 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Air Jordan 11 Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'air-jordan-11-archive-title',
                'type'     => 'text',
                'title'    => __( 'Air Jordan 11 Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 11 Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Air Jordan 11 Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'air-jordan-11-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Air Jordan 11 Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 11 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Air Jordan 11 Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

                  array(
                'id'       => 'air-jordan-11-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Air Jordan 11 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 11 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Air Jordan 11 Page', 'redux-framework-demo' ),

             ),

                  array(
                    'id'     =>'air-jordan-11-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Air Jordan 11 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Air Jordan 11 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


                        Redux::setSection( $opt_name, array(
        'title'      => __( 'Air Jordan 12', 'redux-framework-demo' ),
        'id'         => 'air-jordan-12-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'air-jordan-12-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Air Jordan 12 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Air Jordan 12 Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'air-jordan-12-archive-title',
                'type'     => 'text',
                'title'    => __( 'Air Jordan 12 Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 12 Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Air Jordan 12 Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'air-jordan-12-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Air Jordan 12 Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 12 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Air Jordan 12 Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

                  array(
                'id'       => 'air-jordan-12-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Air Jordan 12 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Jordan 12 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Air Jordan 12 Page', 'redux-framework-demo' ),

             ),

                  array(
                    'id'     =>'air-jordan-12-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Air Jordan 12 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Air Jordan 12 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


     Redux::setSection( $opt_name, array(
        'title'      => __( 'Air Max', 'redux-framework-demo' ),
        'id'         => 'air-max-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'air-max-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Air Max Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Air Max Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'air-max-archive-title',
                'type'     => 'text',
                'title'    => __( 'Air Max Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Air Max Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'air-max-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Air Max Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Air Max Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                  array(
                'id'       => 'air-max-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Air Max Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Air Max Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'air-max-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Air Max Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Air Max page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),


        )
    ) );


        Redux::setSection( $opt_name, array(
        'title'      => __( 'Air Max 1', 'redux-framework-demo' ),
        'id'         => 'air-max-1-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'air-max-1-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Air Max 1 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Air Max 1  Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'air-max-1-archive-title',
                'type'     => 'text',
                'title'    => __( 'Air Max 1  Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 1  Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Air Max 1  Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'air-max-1-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Air Max 1  Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 1 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Air Max 1  Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                  array(
                'id'       => 'air-max-1-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Air Max 1 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 1 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Air Max 1 Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'air-max-1-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Air Max 1 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Air Max 1 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );



           Redux::setSection( $opt_name, array(
        'title'      => __( 'Air Max 90', 'redux-framework-demo' ),
        'id'         => 'air-max-90-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'air-max-90-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Air Max 90 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Air Max 90  Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'air-max-90-archive-title',
                'type'     => 'text',
                'title'    => __( 'Air Max 90  Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 90  Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Air Max 90  Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'air-max-90-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Air Max 90  Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 90 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Air Max 90  Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                  array(
                'id'       => 'air-max-90-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Air Max 90 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 90 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Air Max 90 Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'air-max-90-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Air Max 90 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Air Max 90 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


     Redux::setSection( $opt_name, array(
        'title'      => __( 'Air Max 95', 'redux-framework-demo' ),
        'id'         => 'air-max-95-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'air-max-95-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Air Max 95 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Air Max 95  Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'air-max-95-archive-title',
                'type'     => 'text',
                'title'    => __( 'Air Max 95  Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 95  Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Air Max 95  Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'air-max-95-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Air Max 95  Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 95 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Air Max 95  Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                  array(
                'id'       => 'air-max-95-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Air Max 95 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 95 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Air Max 95 Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'air-max-95-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Air Max 95 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Air Max 95 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),


        )
    ) );



    Redux::setSection( $opt_name, array(
        'title'      => __( 'Air Max 97', 'redux-framework-demo' ),
        'id'         => 'air-max-97-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'air-max-97-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Air Max 97 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Air Max 97  Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'air-max-97-archive-title',
                'type'     => 'text',
                'title'    => __( 'Air Max 97  Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 97  Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Air Max 97  Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'air-max-97-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Air Max 97  Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 97 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Air Max 97  Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                  array(
                'id'       => 'air-max-97-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Air Max 97 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 97 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Air Max 97 Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'air-max-97-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Air Max 97 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Air Max 97 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


            Redux::setSection( $opt_name, array(
        'title'      => __( 'Air Max 98', 'redux-framework-demo' ),
        'id'         => 'air-max-98-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'air-max-98-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Air Max 98 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Air Max 98  Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'air-max-98-archive-title',
                'type'     => 'text',
                'title'    => __( 'Air Max 98  Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 98  Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Air Max 98  Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'air-max-98-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Air Max 98 Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 98 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Air Max 98  Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                  array(
                'id'       => 'air-max-98-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Air Max 98 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 98 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Air Max 98 Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'air-max-98-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Air Max 98 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Air Max 98 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


      Redux::setSection( $opt_name, array(
        'title'      => __( 'Air Max 270', 'redux-framework-demo' ),
        'id'         => 'air-max-270-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'air-max-270-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Air Max 270 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Air Max 270  Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'air-max-270-archive-title',
                'type'     => 'text',
                'title'    => __( 'Air Max 270  Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 270  Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Air Max 270  Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'air-max-270-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Air Max 270  Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 270 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Air Max 270  Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                  array(
                'id'       => 'air-max-270-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Air Max 270 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 270 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Air Max 270 Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'air-max-270-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Air Max 270 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Air Max 270 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Air Max 720', 'redux-framework-demo' ),
        'id'         => 'air-max-720-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'air-max-720-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Air Max 720 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Air Max 720  Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'air-max-720-archive-title',
                'type'     => 'text',
                'title'    => __( 'Air Max 720  Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 720  Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Air Max 720  Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'air-max-720-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Air Max 720  Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 720 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Air Max 720  Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                  array(
                'id'       => 'air-max-720-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Air Max 720 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max 720 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Air Max 720 Page', 'redux-framework-demo' ),

             ),

              array(
                    'id'     =>'air-max-720-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Air Max 720 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Air Max 720 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


     Redux::setSection( $opt_name, array(
        'title'      => __( 'Air Max Plus', 'redux-framework-demo' ),
        'id'         => 'air-max-plus-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'air-max-plus-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Air Max Plus Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Air Max Plus Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'air-max-plus-archive-title',
                'type'     => 'text',
                'title'    => __( 'Air Max Plus Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max Plus Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Air Max Plus Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'air-max-plus-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Air Max Plus Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max Plus Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Air Max Plus Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                  array(
                'id'       => 'air-max-plus-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Air Max Plus Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Max Plus Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Air Max Plus Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'air-max-plus-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Air Max Plus Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Air Max Plus page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );



      Redux::setSection( $opt_name, array(
        'title'      => __( 'Air VaporMax', 'redux-framework-demo' ),
        'id'         => 'air-vapormax-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'air-vapormax-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Air VaporMax Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Air VaporMax Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'air-vapormax-archive-title',
                'type'     => 'text',
                'title'    => __( 'Air VaporMax Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Air VaporMax Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Air VaporMax Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'air-vapormax-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Air VaporMax Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Air VaporMax Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Air VaporMax Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                 array(
                'id'       => 'air-vapormax-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Air VaporMax Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Air VaporMax Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Air VaporMax Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'air-vapormax-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Air VaporMax Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Air VaporMax page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


       Redux::setSection( $opt_name, array(
        'title'      => __( 'Air Vapormax Plus', 'redux-framework-demo' ),
        'id'         => 'air-vapormax-plus-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'air-vapormax-plus-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Air Vapormax Plus Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Air Vapormax Plus Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'air-vapormax-plus-archive-title',
                'type'     => 'text',
                'title'    => __( 'Air Vapormax Plus Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Vapormax Plus Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Air Vapormax Plus Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'air-vapormax-plus-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Air Vapormax Plus Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Vapormax Plus Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Air Vapormax Plus Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                 array(
                'id'       => 'air-vapormax-plus-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Air Vapormax Plus Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Air Vapormax Plus Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Air Vapormax Plus Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'air-vapormax-plus-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Air Vapormax Plus Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Air Vapormax Plus page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


      Redux::setSection( $opt_name, array(
        'title'      => __( 'Nike Air Force 1', 'redux-framework-demo' ),
        'id'         => 'air-force-1-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'air-force-1-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Nike Air Force 1 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Nike Air Force 1 Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'air-force-1-archive-title',
                'type'     => 'text',
                'title'    => __( 'Nike Air Force 1 Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Air Force 1 Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Nike Air Force 1 Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'air-force-1-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Nike Air Force 1 Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Air Force 1 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Nike Air Force 1 Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                 array(
                'id'       => 'air-force-1-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Nike Air Force 1 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Air Force 1 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Nike Air Force 1 Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'air-force-1-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Nike Air Force 1 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Nike Air Force 1 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );

                      Redux::setSection( $opt_name, array(
        'title'      => __( 'Nike React Element', 'redux-framework-demo' ),
        'id'         => 'react-element-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'react-element-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Nike React Element Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Nike React Element Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'react-element-archive-title',
                'type'     => 'text',
                'title'    => __( 'Nike React Element Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike React Element Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Nike React Element Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'react-element-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Nike React Element Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike React Element Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Nike React Element Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                 array(
                'id'       => 'react-element-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Nike React Element Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike React Element Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Nike React Element Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'react-element-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Nike React Element Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Nike React Element page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );

                      Redux::setSection( $opt_name, array(
        'title'      => __( 'Nike React Element 55', 'redux-framework-demo' ),
        'id'         => 'react-element-55-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'react-element-55-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Nike React Element 55 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Nike React Element 55 Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'react-element-55-archive-title',
                'type'     => 'text',
                'title'    => __( 'Nike React Element 55 Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike React Element 55 Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Nike React Element 55 Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'react-element-55-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Nike React Element 55 Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike React Element 55 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Nike React Element 55 Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                 array(
                'id'       => 'react-element-55-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Nike React Element 55 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike React Element 55 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Nike React Element 55 Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'react-element-55-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Nike React Element 55 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Nike React Element 55 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );

                          Redux::setSection( $opt_name, array(
        'title'      => __( 'Nike React Element 87', 'redux-framework-demo' ),
        'id'         => 'react-element-87-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'react-element-87-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Nike React Element 87 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Nike React Element 87 Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'react-element-87-archive-title',
                'type'     => 'text',
                'title'    => __( 'Nike React Element 87 Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike React Element 87 Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Nike React Element 87 Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'react-element-87-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Nike React Element 87 Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike React Element 87 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Nike React Element 87 Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                 array(
                'id'       => 'react-element-87-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Nike React Element 87 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike React Element 87 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Nike React Element 87 Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'react-element-87-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Nike React Element 87 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Nike React Element 87 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );

                Redux::setSection( $opt_name, array(
        'title'      => __( 'Nike Air Zoom', 'redux-framework-demo' ),
        'id'         => 'air-zoom-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'air-zoom-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Nike Air Zoom Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Nike Air Zoom Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'air-zoom-archive-title',
                'type'     => 'text',
                'title'    => __( 'Nike Air Zoom Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Air Zoom Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Nike Air Zoom Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'air-zoom-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Nike Air Zoom Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Air Zoom Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Nike Air Zoom Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                 array(
                'id'       => 'air-zoom-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Nike Air Zoom Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Air Zoom Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Nike Air Zoom Page', 'redux-framework-demo' ),

             ),

                 array(
                    'id'     =>'air-zoom-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Nike Air Zoom Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Nike Air Zoom page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );

                Redux::setSection( $opt_name, array(
        'title'      => __( 'Nike Air Foamposite', 'redux-framework-demo' ),
        'id'         => 'air-foamposite-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'air-foamposite-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Nike Air Foamposite Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Nike Air Foamposite Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                 array(
                'id'       => 'air-foamposite-archive-title',
                'type'     => 'text',
                'title'    => __( 'Nike Air Foamposite Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Air Foamposite Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Nike Air Foamposite Page', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'air-foamposite-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Nike Air Foamposite Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Air Foamposite Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Nike Air Foamposite Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                 array(
                'id'       => 'air-foamposite-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Nike Air Foamposite Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Nike Air Foamposite Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Nike Air Foamposite Page', 'redux-framework-demo' ),

             ),

                 array(
                    'id'     =>'air-foamposite-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Nike Air Foamposite Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Nike Air Foamposite page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


        Redux::setSection( $opt_name, array(
        'title'      => __( 'Adidas', 'redux-framework-demo' ),
        'id'         => 'adidas-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'adidas-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Adidas Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Adidas Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),


             ),

                  array(
                'id'       => 'adidas-archive-title',
                'type'     => 'text',
                'title'    => __( 'Adidas Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Adidas Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Adidas Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'adidas-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Adidas Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Adidas Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Adidas Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

                 array(
                'id'       => 'adidas-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Adidas Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Adidas Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Adidas Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'adidas-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Adidas Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Adidas page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );

         Redux::setSection( $opt_name, array(
        'title'      => __( 'EQT', 'redux-framework-demo' ),
        'id'         => 'eqt-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'eqt-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'EQT Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create EQT Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),

                 array(
                'id'       => 'eqt-archive-title',
                'type'     => 'text',
                'title'    => __( 'EQT Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'EQT Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For EQT Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'eqt-archive-text',
                'type'     => 'editor',
                'title'    => __( 'EQT Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'EQT Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For EQT Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                 array(
                'id'       => 'eqt-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'EQT Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'EQT Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For EQT Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'eqt-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For EQT Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at EQT page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


         Redux::setSection( $opt_name, array(
        'title'      => __( 'Yeezy', 'redux-framework-demo' ),
        'id'         => 'yeezy-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'yeezy-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Yeezy Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Yeezy Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'yeezy-archive-title',
                'type'     => 'text',
                'title'    => __( 'Yeezy Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Yeezy Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Yeezy Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'yeezy-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Yeezy Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Yeezy Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Yeezy Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

                 array(
                'id'       => 'yeezy-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Yeezy Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Yeezy Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Yeezy Page', 'redux-framework-demo' ),

             ),


              array(
                    'id'     =>'yeezy-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Yeezy Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed atYeezy page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


         Redux::setSection( $opt_name, array(
        'title'      => __( 'Yeezy Boost 350', 'redux-framework-demo' ),
        'id'         => 'yeezy-boost-350-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'yeezy-boost-350-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Yeezy Boost 350 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Yeezy Boost 350 Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'yeezy-boost-350-archive-title',
                'type'     => 'text',
                'title'    => __( 'Yeezy Boost 350 Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Yeezy Boost 350 Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Yeezy Boost 350 Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'yeezy-boost-350-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Yeezy Boost 350 Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Yeezy Boost 350 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Yeezy Boost 350 Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

                 array(
                'id'       => 'yeezy-boost-350-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Yeezy Boost 350 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Yeezy Boost 350 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Yeezy Boost 350 Page', 'redux-framework-demo' ),

             ),
                 array(
                    'id'     =>'yeezy-boost-350-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Yeezy Boost 350 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Yeezy Boost 350 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


           Redux::setSection( $opt_name, array(
        'title'      => __( 'Yeezy Boost 500', 'redux-framework-demo' ),
        'id'         => 'yeezy-boost-500-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'yeezy-boost-500-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Yeezy Boost 500 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Yeezy Boost 500 Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'yeezy-boost-500-archive-title',
                'type'     => 'text',
                'title'    => __( 'Yeezy Boost 500 Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Yeezy Boost 500 Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Yeezy Boost 500 Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'yeezy-boost-500-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Yeezy Boost 500 Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Yeezy Boost 500 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Yeezy Boost 500 Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

                 array(
                'id'       => 'yeezy-boost-500-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Yeezy Boost 500 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Yeezy Boost 500 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Yeezy Boost 500 Page', 'redux-framework-demo' ),

             ),
                 array(
                    'id'     =>'yeezy-boost-500-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Yeezy Boost 500 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Yeezy Boost 500 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


            Redux::setSection( $opt_name, array(
        'title'      => __( 'Yeezy Boost 700', 'redux-framework-demo' ),
        'id'         => 'yeezy-boost-700-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'yeezy-boost-700-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Yeezy Boost 700 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Yeezy Boost 700 Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'yeezy-boost-700-archive-title',
                'type'     => 'text',
                'title'    => __( 'Yeezy Boost 700 Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Yeezy Boost 700 Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Yeezy Boost 700 Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'yeezy-boost-700-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Yeezy Boost 700 Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Yeezy Boost 700 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Yeezy Boost 700 Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

                 array(
                'id'       => 'yeezy-boost-700-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Yeezy Boost 700 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Yeezy Boost 700 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Yeezy Boost 700 Page', 'redux-framework-demo' ),

             ),
                 array(
                    'id'     =>'yeezy-boost-700-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Yeezy Boost 700 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Yeezy Boost 500 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );

                    Redux::setSection( $opt_name, array(
        'title'      => __( 'Yeezy Slides', 'redux-framework-demo' ),
        'id'         => 'yeezy-slides-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'yeezy-slides-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Yeezy Slides Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Yeezy Slides Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'yeezy-slides-archive-title',
                'type'     => 'text',
                'title'    => __( 'Yeezy Slides Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Yeezy Slides Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Yeezy Slides Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'yeezy-slides-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Yeezy Slides Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Yeezy Slides Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Yeezy Slides Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

                 array(
                'id'       => 'yeezy-slides-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Yeezy Slides Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Yeezy Slides Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Yeezy Slides Page', 'redux-framework-demo' ),

             ),
                 array(
                    'id'     =>'yeezy-slides-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Yeezy Slides Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Yeezy Slides page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


            Redux::setSection( $opt_name, array(
        'title'      => __( 'Continental 80', 'redux-framework-demo' ),
        'id'         => 'continental-80-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'continental-80-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Continental 80 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Continental 80 Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'continental-80-archive-title',
                'type'     => 'text',
                'title'    => __( 'Continental 80 Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Continental 80 Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Continental 80 Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'continental-80-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Continental 80 Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Continental 80 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Continental 80 Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

                 array(
                'id'       => 'continental-80-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Continental 80 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Continental 80 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Yeezy Boost 700 Page', 'redux-framework-demo' ),

             ),
                 array(
                    'id'     =>'continental-80-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Continental 80 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Continental 80 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );



         Redux::setSection( $opt_name, array(
        'title'      => __( 'NMD', 'redux-framework-demo' ),
        'id'         => 'nmd-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'nmd-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'NMD Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create NMD Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'nmd-archive-title',
                'type'     => 'text',
                'title'    => __( 'NMD Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'NMD Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For NMD Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'nmd-archive-text',
                'type'     => 'editor',
                'title'    => __( 'NMD Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'NMD Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For NMD Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                      array(
                'id'       => 'nmd-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'NMD Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'NMD Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For NMD Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'nmd-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For NMD Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at NMD page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );

         Redux::setSection( $opt_name, array(
        'title'      => __( 'Ultra Boost', 'redux-framework-demo' ),
        'id'         => 'ultra-boost-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'ultra-boost-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Ultra Boost Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Ultra Boost Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'ultra-boost-archive-title',
                'type'     => 'text',
                'title'    => __( 'Ultra Boost Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Ultra Boost Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Ultra Boost Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'ultra-boost-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Ultra Boost Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Ultra Boost Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Ultra Boost Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                      array(
                'id'       => 'ultra-boost-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Ultra Boost Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Ultra Boost Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Ultra Boost Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'ultra-boost-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Ultra Boost Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Ultra Boost page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );

         Redux::setSection( $opt_name, array(
        'title'      => __( 'Nite Jogger', 'redux-framework-demo' ),
        'id'         => 'nite-jogger-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'nite-jogger-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Nite Jogger Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Nite Jogger Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'nite-jogger-archive-title',
                'type'     => 'text',
                'title'    => __( 'Nite Jogger Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Nite Jogger Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Nite Jogger Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'nite-jogger-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Nite Jogger Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Nite Jogger Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Nite Jogger Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                      array(
                'id'       => 'nite-jogger-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Nite Jogger Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Nite Jogger Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Nite Jogger Page', 'redux-framework-demo' ),

             ),

            array(
                    'id'     =>'nite-jogger-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Nite Jogger Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Nite Jogger page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );

             Redux::setSection( $opt_name, array(
        'title'      => __( 'Stan Smith', 'redux-framework-demo' ),
        'id'         => 'stan-smith-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'stan-smith-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Stan Smith Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Stan Smith Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'stan-smith-archive-title',
                'type'     => 'text',
                'title'    => __( 'Stan Smith Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Stan Smith Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Stan Smith Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'stan-smith-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Stan Smith Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Stan Smith Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Stan Smith Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                      array(
                'id'       => 'stan-smith-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Stan Smith Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Stan Smith Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Stan Smith Page', 'redux-framework-demo' ),

             ),

            array(
                    'id'     =>'stan-smith-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Stan Smith Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Stan Smith page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );

                        Redux::setSection( $opt_name, array(
        'title'      => __( 'Yung 1', 'redux-framework-demo' ),
        'id'         => 'yung-1-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'yung-1-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Yung 1 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Yung 1 Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'yung-1-archive-title',
                'type'     => 'text',
                'title'    => __( 'Yung 1 Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Yung 1 Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Yung 1 Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'yung-1-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Yung 1 Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Yung 1 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Yung 1 Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                      array(
                'id'       => 'yung-1-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Yung 1 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Yung 1 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Yung 1 Page', 'redux-framework-demo' ),

             ),

            array(
                    'id'     =>'yung-1-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Yung 1 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Yung 1 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );

               Redux::setSection( $opt_name, array(
        'title'      => __( 'Yung 96', 'redux-framework-demo' ),
        'id'         => 'yung-96-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'yung-96-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Yung 96 Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Yung 96 Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'yung-96-archive-title',
                'type'     => 'text',
                'title'    => __( 'Yung 96 Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Yung 96 Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Yung 96 Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'yung-96-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Yung 96 Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Yung 96 Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Yung 96 Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                      array(
                'id'       => 'yung-96-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'Yung 96 Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'Yung 96 Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For Yung 96 Page', 'redux-framework-demo' ),

             ),

            array(
                    'id'     =>'yung-96-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Yung 96 Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Yung 96 page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );

         Redux::setSection( $opt_name, array(
        'title'      => __( 'PUMA', 'redux-framework-demo' ),
        'id'         => 'puma-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'puma-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'PUMA Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create PUMA Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'puma-archive-title',
                'type'     => 'text',
                'title'    => __( 'PUMA Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'PUMA Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For PUMA Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'puma-archive-text',
                'type'     => 'editor',
                'title'    => __( 'PUMA Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'PUMA Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For PUMA Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),
                     array(
                'id'       => 'puma-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'PUMA Page Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'PUMA Page Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add Comma separated Meta Keywords For PUMA Page', 'redux-framework-demo' ),

             ),

             array(
                    'id'     =>'puma-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For PUMA Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at PUMA page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),


        )
    ) );
          Redux::setSection( $opt_name, array(
        'title'      => __( 'Asics', 'redux-framework-demo' ),
        'id'         => 'asics-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'asics-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Asics Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Asics Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'asics-archive-title',
                'type'     => 'text',
                'title'    => __( 'Asics Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Asics Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Asics Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'asics-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Asics Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Asics Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Asics Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

              array(
                    'id'     =>'asics-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Asics Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Asics page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),


        )
    ) );

                  Redux::setSection( $opt_name, array(
        'title'      => __( 'Gel lyte iii', 'redux-framework-demo' ),
        'id'         => 'gel-lyte-iii-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'gel-lyte-iii-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Gel lyte iii Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Gel lyte iii Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'gel-lyte-iii-archive-title',
                'type'     => 'text',
                'title'    => __( 'Gel lyte iii Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Gel lyte iii Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Gel lyte iii Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'gel-lyte-iii-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Gel lyte iii Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Gel lyte iii Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Gel lyte iii Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

                array(
                    'id'     =>'gel-lyte-iii-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Gel lyte iii Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Gel lyte iii page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),


        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Converse', 'redux-framework-demo' ),
        'id'         => 'converse-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'converse-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Converse Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Converse Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'converse-archive-title',
                'type'     => 'text',
                'title'    => __( 'Converse Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Converse Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Converse Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'converse-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Converse Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Converse Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Converse Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

             array(
                    'id'     =>'converse-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Converse Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Converse page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );

     Redux::setSection( $opt_name, array(
        'title'      => __( 'Converse One Star', 'redux-framework-demo' ),
        'id'         => 'one-star-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'one-star-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Converse One Star Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Converse One Star Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'one-star-archive-title',
                'type'     => 'text',
                'title'    => __( 'Converse One Star Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Converse One Star Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Converse One Star Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'one-star-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Converse One Star Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Converse One Star Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Converse One Star Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

             array(
                    'id'     =>'one-star-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Converse One Star Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Converse One Star page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );

          Redux::setSection( $opt_name, array(
        'title'      => __( 'Converse All Star', 'redux-framework-demo' ),
        'id'         => 'all-star-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'all-star-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Converse All Star Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Converse All Star Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'all-star-archive-title',
                'type'     => 'text',
                'title'    => __( 'Converse All Star Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Converse All Star Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Converse All Star Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'all-star-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Converse All Star Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Converse All Star Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Converse All Star Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

                array(
                    'id'     =>'all-star-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Converse All Star Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Converse All Star page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'      => __( 'Saucony', 'redux-framework-demo' ),
        'id'         => 'saucony-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'saucony-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Saucony Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Saucony Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'saucony-archive-title',
                'type'     => 'text',
                'title'    => __( 'Saucony Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Saucony Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Saucony Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'saucony-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Saucony Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Saucony Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Saucony Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

             array(
                    'id'     =>'saucony-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Saucony Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Saucony page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


         Redux::setSection( $opt_name, array(
        'title'      => __( 'New Balance', 'redux-framework-demo' ),
        'id'         => 'new-balance-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'new-balance-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'New Balance Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create New Balance Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'new-balance-archive-title',
                'type'     => 'text',
                'title'    => __( 'New Balance Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'New Balance Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For New Balance Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'new-balance-archive-text',
                'type'     => 'editor',
                'title'    => __( 'New Balance Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'New Balance Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For New Balance Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

             array(
                    'id'     =>'new-balance-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For New Balance Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at New Balance page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


            Redux::setSection( $opt_name, array(
        'title'      => __( 'Reebok', 'redux-framework-demo' ),
        'id'         => 'reebok-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'reebok-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Reebok Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Reebok Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'reebok-archive-title',
                'type'     => 'text',
                'title'    => __( 'Reebok Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Reebok Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Reebok Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'reebok-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Reebok Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Reebok Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Reebok Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

             array(
                    'id'     =>'reebok-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Reebok Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Reebok page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );


       Redux::setSection( $opt_name, array(
        'title'      => __( 'Vans', 'redux-framework-demo' ),
        'id'         => 'vans-archive-media-settings',
        'subsection' => true,
        'fields'     => array(

                array(
                'id'       => 'vans-archive-slider',
                'type'     => 'slides',
                'title'    => __( 'Vans Page Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'Create Vans Page Slide', 'redux-framework-demo' ),
                'desc'     => __( ' Slider Image Size Should Be width 828 px * hight 184 px.', 'redux-framework-demo' ),

             ),
                array(
                'id'       => 'vans-archive-title',
                'type'     => 'text',
                'title'    => __( 'Vans Page Title', 'redux-framework-demo' ),
                'subtitle' => __( 'Vans Page Title', 'redux-framework-demo' ),
                'desc'     => __( 'Add Title For Vans Page', 'redux-framework-demo' ),

             ),

                array(
                'id'       => 'vans-archive-text',
                'type'     => 'editor',
                'title'    => __( 'Vans Page Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Vans Page Text', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For Vans Page', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

             ),

             array(
                    'id'     =>'vans-news-tag',
                    'type' => 'select',
                    'data' => 'tags',
                    'placeholder' => 'Select Tag',
                    'title' => __('News tag For Vans Page', 'redux-framework-demo'),
                    'subtitle' => __('News from the selected tag will be displayed at Vans page', 'redux-framework-demo'),
                    'desc'     => __( 'News Tag.', 'redux-framework-demo' ),
                    ),

        )
    ) );



          Redux::setSection( $opt_name, array(
        'title'            => __( 'News Archive Page Settings', 'redux-framework-demo' ),
        'id'               => 'fs-news-archive',
        'desc'             => __( 'News Archive Page Settings', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-edit'
    ) );

     Redux::setSection( $opt_name, array(
        'title'      => __( 'News Archive Page', 'redux-framework-demo' ),
        'id'         => 'news-archive-settings',
        'subsection' => true,
        'fields'     => array(


                     array(
                'id'       => 'news-archive-text',
                'type'     => 'editor',
                'title'    => __( 'News Archive Text', 'redux-framework-demo' ),
                'subtitle' => __( 'Description For News Archive', 'redux-framework-demo' ),
                'desc'     => __( 'Add Description For News Archive', 'redux-framework-demo' ),
                'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 10,
                'wpautop'          => false,
                ),

            ),

                               array(
                'id'       => 'newa-archive-meta-keywords',
                'type'     => 'text',
                'title'    => __( 'News Archive Meta Keywords', 'redux-framework-demo' ),
                'subtitle' => __( 'News Archive Meta Keywords', 'redux-framework-demo' ),
                'desc'     => __( 'Add comma separated News Archive Meta Keywords', 'redux-framework-demo' ),


            ),


        )
    ) );

    /*
     * <--- END SECTIONS
     */




    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'redux-framework-demo' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }

