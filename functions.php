<?php
    add_theme_support('post-thumbnails');
    // Add support for custom logo
    add_theme_support('custom-logo');
 
    // Add CORS support
    function add_cors_http_header() {
        header("Access-Control-Allow-Origin: *");
    }
    add_action('init', 'add_cors_http_header');
 
    // Enque or Stylesheets - Wordpress not the React Frontend:
    function enqueue_parent_and_custom_styles() {
        // parent theme styles:
        wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
 
        // custom styles:
        wp_enqueue_style('child-style', get_template_directory_uri() . '/custom.css', array('parent-style'));
    }
    add_action('wp_enqueue_scripts', 'enqueue_parent_and_custom_styles');
 
 
 
    // declare the function
    function custom_excerpt_length($length) {
        return 10; // change the number of character for excerpt length
    }
 
    // call the function within the corrrect WP hooks
    add_filter('excerpt_length', 'custom_excerpt_length' , 999 );
 
    // Customizer settings:
    function custom_theme_customize_register( $wp_customize ) {
        
        // Register and customizer settings:
        $wp_customize->add_setting('background_color', array(
            'default' => '#fbfbfb', // default color
            'transport' => 'postMessage',
        ));
 
        // Add a control for the background color
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'background_color', array(
            'label' => __('Background Colour', 'custom-theme'),
            'section' => 'colors',
        )));

        // Font Family
        // Add the Font section
        $wp_customize->add_section('fonts', array(
            'title' => __('Fonts', 'custom-theme'),
            'priority' => 30,
        ));
 
        // Add the Font setting
        $wp_customize->add_setting('font_family', array(
            'default' => 'Helvetica',
            'transport' => 'postMessage',
        ));
 
        // Add the Control of Fonts
        $wp_customize->add_control('font_family_control', array(
            'label' => 'Body Text Font',
            'section' => 'fonts',
            'settings' => 'font_family',
            'type' => 'select',
            'choices' => array(
                'Arial' => 'Arial',
                'Roboto' => 'Roboto',
                'Poppins' => 'Poppins',
                'DotGothic16' => 'DotGothic16',
                'Helvetica' => 'Helvetica',
                'GFS Didot' => 'GFS Didot',
            ),
        ));


        // FOR THE HEADER FONT
        $wp_customize->add_setting('header_font', array(
            'default' => 'GFS Didot',
            'transport' => 'postMessage'
        ));

        // FOR THE HEADER FONT
        $wp_customize->add_control('header_font_control', array(
            'label' => 'Header Font',
            'section' => 'fonts',
            'settings' => 'header_font',
            'type' => 'select',
            'choices' => array(
                'Arial' => 'Arial',
                'Roboto' => 'Roboto',
                'Poppins' => 'Poppins',
                'DotGothic16' => 'DotGothic16',
                'Helvetica' => 'Helvetica',
                'GFS Didot' => 'GFS Didot',
            ),
        ));

        // Navbar Bg Color
        $wp_customize->add_setting('navbar_color', array(
            'default' => '#fbfbfb',
            'transport' => 'postMessage',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'navbar_color', array(
            'label' => __('Navbar Color', 'custom-theme'),
            'section' => 'colors',
        )));

        // Footer Bg Color
        $wp_customize->add_setting('footer_color', array(
            'default' => '#1f1f1f',
            'transport' => 'postMessage',
        ));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_color', array(
            'label' => __('Footer Color', 'custom-theme'),
            'section' => 'colors',
        )));


        // primary button bg color
       $wp_customize->add_setting('primary_button_color', array(
            'default' => '#D4BC73',
            'transport' => 'postMessage',
       ));

       $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_button_color', array(
            'label' => __('Primary Button Color', 'custom-theme'),
            'section' => 'colors',
       )));

    //    primary button text color
       $wp_customize->add_setting('primary_button_text_color', array(
        'default' => '#fbfbfb',
        'transport' => 'postMessage',
   ));

       $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_button_text_color', array(
        'label' => __('Primary Button Text Color', 'custom-theme'),
        'section' => 'colors',
   )));

//    secondary button colour
    $wp_customize->add_setting('secondary_button_color', array(
        'default' => '#FBFBFB',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_button_color', array(
        'label' => __('Secondary Button Color', 'custom-theme'),
        'section' => 'colors',
    )));

    $wp_customize->add_setting('secondary_button_text_color', array(
        'default' => '#D4BC73',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_button_text_color', array(
        'label' => __('Secondary Button Text Color', 'custom-theme'),
        'section' => 'colors',
    )));

   
    }
 
    add_action('customize_register', 'custom_theme_customize_register');
 
    // Custom Rest API endpoint to retreive customiser settings
    // these appear in the url code in the browser 
    function get_customizer_settings() {
        $settings = array(
            'backgroundColor' => get_theme_mod('background_color', '#fbfbfb'),
            // Additional settings...
            'fontFamily' => get_theme_mod('font_family', 'Helvetica'),
            'headerFont' => get_theme_mod('header_font', 'GFS Didot'),
            'mobileColor' => get_theme_mod('mobile_menu_color', '#fbfbfb'),
            'navbarColor' => get_theme_mod('navbar_color', '#fbfbfb'),
            'footerColor' => get_theme_mod('footer_color', '#1f1f1f'),
            'primaryButtonColor' => get_theme_mod('primary_button_color', '#D4BC73'),
            'primaryButtonTextColor' => get_theme_mod('primary_button_text_color', '#fbfbfb'),
            'secondaryButtonColor' => get_theme_mod('secondary_button_color', '#fbfbfb'),
            'secondaryButtonTextColor' => get_theme_mod('secondary_button_text_color', '#D4BC73'),
        );
 
        return rest_ensure_response($settings);
    }
 
    add_action('rest_api_init', function () {
        register_rest_route('custom-theme/v1', '/customizer-settings', array(
            'methods' => 'GET',
            'callback' => 'get_customizer_settings'
        ));
    });

    // GET NAV LOGO THAT IS SET IN THE ADMIN DASHBOARD
    function get_nav_logo() {
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');

        return $logo;
    };

    add_action('rest_api_init', function () {
        register_rest_route('custom/v1', 'nav-logo', array(
            'methods' => 'GET',
            'callback' => 'get_nav_logo'
        ));
    });
?>