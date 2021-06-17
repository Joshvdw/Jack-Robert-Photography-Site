<?php

// adding theme support for custom theme
add_theme_support('post-thumbnails');
add_theme_support('woocommerce');

// this is our custom function which loads stylesheet from the root directory
function custom_theme_assets() {
    wp_enqueue_style('custom-style', get_stylesheet_uri());
    // linking script.js file
    wp_enqueue_script('js-file', get_template_directory_uri() . '/js/script.js');
}

add_action('wp_enqueue_scripts', 'custom_theme_assets');

// register custom navigation menu in the backend
register_nav_menus( [ 'primary' => __( 'Primary Menu' )]);

// function to create a custom post type for FAQ
function create_posttype() {

    // creating the argument array
    $args = array (
        'labels' => array(
            // name of post type, which is displayed in backend of WP
            'name' => __('FAQ'),
            // defining that FAQ is a singularly plural
            'singular_name' => __('FAQ')
        ),
        // telling WP that the custom post type is available for the public
        'public' => true,
        // sets a custom menu icon
        'menu_icon' => 'dashicons-editor-help',
        // what kind of data the custom post will support
        'supports' => array('title')
    );

    // pushes post into the backend
    // first argument describes what the post type is
    // second is the $arg's variable, which pushes in an array of arguments
    register_post_type('faq', $args);
}

// adding the create post type function that you created above and initializing it
add_action('init', 'create_posttype');

function change_faq_title_placeholder($title) {
    $current_screen = get_current_screen();
        if ($current_screen->post_type == 'faq') {
            $title = 'Write question here';
        }
        return $title;
}

add_filter('enter_title_here', 'change_faq_title_placeholder');

// adding action for the custom meta boxes function
add_action( 'add_meta_boxes', 'answer_add_metabox');

function answer_add_metabox() {
    add_meta_box(
        'faq_answer', // metabox ID for database
        'Answer',   // title as seen by client/admin
        'answer_meta_box_callback',// callback function
        'faq', // which post type to attach our metabox to
        'normal' // position of the metabox
    );
}

function answer_meta_box_callback( $post )  {  
  $answer = get_post_meta( $post->ID, '_answer', true );
    echo "<textarea type='text' name='answer' rows='7' cols='140' placeholder='Write answer here'>" . esc_attr($answer) . "</textarea>";     
}

// Save the meta data from our custom metabox
add_action( 'save_post', 'save_answer_meta_box_data' );

// this second function is saving the data written in the newly created metabox
function save_answer_meta_box_data( $post_id ) {
    // autosave functionality
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Make sure that the right post data is set.
    if ( ! isset( $_POST['answer'] ) ) {
        return;
    }
    // Sanitize user input.
    $my_data = sanitize_text_field( $_POST['answer'] );

    // Update the meta field in the database.
    update_post_meta( $post_id, '_answer', $my_data );
}

// creating the custom taxonomy 
add_action('init', 'create_faq_type_taxomony', 0);

function create_faq_type_taxomony() {
    $labels = array(
        'name' => _x('FAQ Type', 'general name'),
        'singular_name' => _x('FAQ Type', 'singular name'),
        'search_items' => __('Search FAQs'),
        'all_items' => __('All FAQ Types'),
        'parent_item' => __('Parent FAQ Types'),
        'parent_item_colon' => __('Parent FAQ Types:'),
        'edit_item' => __('Edit FAQ Type'),
        'update_item' => __('Update FAQ Type'),
        'add_new_item' => __('Add New FAQ Type'),
        'new_item_name' => __('New FAQ Type Name'),
        'menu_name' => __('FAQ Type')
    );
    // register the taxonomy in wordpress and plug in the data from our labels array
    register_taxonomy('FAQ Type', array('faq'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true
        )
    );
}

// disable product links
remove_action( 
  'woocommerce_before_shop_loop_item',
  'woocommerce_template_loop_product_link_open',
  10
);
remove_action(
  'woocommerce_after_shop_loop_item',
  'woocommerce_template_loop_product_link_close',
  5
);

// removing ordering function
add_action( 'before_woocommerce_init', function() {
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
});

// remove woocommerce footer
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

function toughlove_theme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'toughlove_theme_add_woocommerce_support' );

//---register a custom section in the WP customizer (for client, in dashboard)
function mytheme_customize_register($wp_customize) {

    $wp_customize->add_section("my_custom_section", array(
        "title" => __("Custom Settings", "customizer_custom_section"),
        "priority" => 20,
    ));
    $wp_customize->add_setting("my_custom_message", array(
        "default" => "Do you feel trapped, guilty, betrayed, helpless or frightened?",
        "transport" => "refresh"
    ));
    $wp_customize->add_setting("color_picker", array(
        "default" => "#666666",
        "transport" => "refresh"
    ));
    $wp_customize->add_setting("my_custom_number", array(
        "default" => "2017",
        "transport" => "refresh",
    ));
    $wp_customize->add_setting("my_custom_select", array(
        "default" => "Default - off",
        "transport" => "refresh",
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, "my_custom_message", array(
        "label" => __("Enter homepage message here", "customizer_control_label"),
        "section" => "my_custom_section",
        "setting" => "my_custom_message",
        "type" => "textarea"
        )
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "color_picker", array(
        'label' => 'Menu Text Color',
        'section' => 'my_custom_section',
        'settings' => 'color_picker'
    )
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,"my_custom_number", array(
       "label" => __("Enter Footer Year", "customizer_control_label"),
       "section" => "my_custom_section",
       "settings" => "my_custom_number",
       "type" => "number",
        )
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,"my_custom_select", array(
        "label" => __("Dark Mode Theme", "customizer_select_label"),
        "section" => "my_custom_section",
        "settings" => "my_custom_select",
        "type" => "select",
        "choices" => array(
            'default' => 'Default - off',
            'enabled' => 'Enabled'
        ))
     ));
}

// run function when the the customizer section runs
add_action("customize_register", "mytheme_customize_register");

// generate special css, change all hyperlink colors
function generate_special_css(){
    $color_picker = get_theme_mod('color_picker');
    $image = get_theme_mod('custom_image');

    if (get_theme_mod("my_custom_select") === "enabled") {

        // dark theme
        ?>  
            <style type="text/css" id="custom-style-from-customiser">
                body, .contact-footer, .helpline-wrapper, #customer_details {
                    background-color: #121212!important;
                } 
            </style>
        <?php
}
        // change menu colors
        ?>
            <style type="text/css" id="custom-style-from-customiser">
                a {
                    color:<?php echo $color_picker; ?>;
                }
                .special-color {
                    color:<?php echo $color_picker; ?>;
                }
            </style> 
        <?php
}
    // change css across all pages
    add_action('wp_head', 'generate_special_css');