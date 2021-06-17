<?php

// adding theme support
add_theme_support('post-thumbnails');
add_theme_support('woocommerce');

// loads stylesheet from root directory
function custom_theme_assets() {
    wp_enqueue_style('custom-style', get_stylesheet_uri());
    // linking script.js file
    wp_enqueue_script('js-file', get_template_directory_uri() . '/js/script.js');
}

add_action('wp_enqueue_scripts', 'custom_theme_assets');

// register custom nav
register_nav_menus( [ 'primary' => __( 'Primary Menu' )]);

// custom post type for Project Stories
function create_posttype() {

    $args = array (
        'labels' => array(
            'name' => __('Project Stories'),
            'singular_name' => __('Project Story')
        ),
        'public' => true,
        'menu_icon' => 'dashicons-format-aside',
        'supports' => array('title', 'editor', 'thumbnail')
    );

    register_post_type('project-story', $args);
}

add_action('init', 'create_posttype');

function change_project_story_title_placeholder($title) {
    $current_screen = get_current_screen();
        if ($current_screen->post_type == 'project-story') {
            $title = 'Write title here';
        }
        return $title; 
}

add_filter('enter_title_here', 'change_project_story_title_placeholder');

// adding custom meta boxes
add_action( 'add_meta_boxes', 'date_add_metabox');

function date_add_metabox() {
    add_meta_box(
        'date', // metabox ID for db
        'Date',   // title as seen by client/admin
        'date_meta_box_callback',
        'project-story', // which post type to attach our metabox to
        'normal' // position of the metabox
    );
}

function date_meta_box_callback( $post )  {  
  $date = get_post_meta( $post->ID, '_date', true );
    echo "<input type='text' name='date' class='project-date' value='" . date("d/m/Y") ."" . esc_attr($date) . "'>";     
}

add_action( 'save_post', 'save_date_meta_box_data' );

function save_date_meta_box_data( $post_id ) {

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! isset( $_POST['date'] ) ) {
        return;
    }

    $my_data = sanitize_text_field( $_POST['date'] );

    update_post_meta( $post_id, '_date', $my_data );
}

// metabox with multiple fields

function create_metabox_mutiple_fields(){
    add_meta_box(
        'id-of-metabox',
        'Background Colour',
        'add_multiple_fields_content',
        'project-story'
    );
}

function add_multiple_fields_content() {
    global $post;

    $dropdown_field = get_post_meta($post->ID, 'custom_meta_select_field', true);

    ?>
    <div class="my-row" style="margin-bottom: 10px;">
        <div class="fields">
        <select name="custom_meta_select_field">
            <option value="">Select Color</option>
            <option value="#312D42" <?php if($dropdown_field == "#312D42") echo '#312D42';?>>Purple</option>
            <option value="#2C4C5C" <?php if($dropdown_field == "#2C4C5C") echo '#2C4C5C';?>>Blue</option>
            <option value="#42342D" <?php if($dropdown_field == "#42342D") echo '#42342D';?>>Brown</option>
        </select>
        </div>
    </div>
    <?php
}

add_action( 'add_meta_boxes', 'create_metabox_mutiple_fields');

function save_multiple_fields_metabox($post_id, $post) {
     
     $post_type = get_post_type_object( $post->post_type );

     if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
        return $post_id;
    }
       if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
        return $post_id;
    }
        if( $post->post_type != 'project-story' ) {
        return $post_id;
    }

    if(isset($_POST["custom_meta_select_field"])) :
        update_post_meta($post->ID,'custom_meta_select_field', $_POST["custom_meta_select_field"]);
    endif;

}

add_action('save_post', 'save_multiple_fields_metabox', 200, 2); 

// creating a custom taxonomy 
add_action('init', 'create_project_story_type_taxomony', 0);

function create_project_story_type_taxomony() {
    $labels = array(
        'name' => _x('Event Type', 'general name'),
        'singular_name' => _x('Event Type', 'singular name'),
        'search_items' => __('Search Event Types'),
        'all_items' => __('All Event Types'),
        'parent_item' => __('Parent Event Types'),
        'parent_item_colon' => __('Parent Event Types:'),
        'edit_item' => __('Edit Event Type'),
        'update_item' => __('Update Event Type'),
        'add_new_item' => __('Add New Event Type'),
        'new_item_name' => __('New Event Type Name'),
        'menu_name' => __('Event Type')
    );

    register_taxonomy('Event Type', array('event'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true
        )
    );
}

// THEME CUSTOMIZER
function mytheme_customize_register($wp_customize) {

    $wp_customize->add_section("my_custom_section", array(
    "title" => __("Theme Customizer", "customizer_custom_section"),
    "priority" => 20,
    ));

    // SETTINGS
    $wp_customize->add_setting("color_picker_text", array(
        "default" => "#2D3B42",
        "transport" => "refresh"
    ));
    $wp_customize->add_setting("color_picker_background", array(
        "default" => "#F2F0E6",
        "transport" => "refresh"
    ));
    $wp_customize->add_setting("custom_image", array(
        "default" => "",
        "transport" => "refresh"
    ));
    $wp_customize->add_setting("price_digital_a5", array(
        "default" => "1,00",
        "transport" => "refresh",
    ));
    $wp_customize->add_setting("price_digital_a4", array(
        "default" => "1,20",
        "transport" => "refresh",
    ));
    $wp_customize->add_setting("price_digital_a3", array(
        "default" => "1,50",
        "transport" => "refresh",
    ));
    $wp_customize->add_setting("price_normal_a5", array(
        "default" => "5,00",
        "transport" => "refresh",
    ));
    $wp_customize->add_setting("price_normal_a4", array(
        "default" => "7,50",
        "transport" => "refresh",
    ));
    $wp_customize->add_setting("price_normal_a3", array(
        "default" => "10,00",
        "transport" => "refresh",
    ));
    $wp_customize->add_setting("price_pro_a5", array(
        "default" => "10,00",
        "transport" => "refresh",
    ));
    $wp_customize->add_setting("price_pro_a4", array(
        "default" => "15,00",
        "transport" => "refresh",
    ));
    $wp_customize->add_setting("price_pro_a3", array(
        "default" => "20,00",
        "transport" => "refresh",
    ));
    // CONTROLS
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "color_picker_text", array(
        'label' => 'Font Color',
        'section' => 'my_custom_section',
        'settings' => 'color_picker_text'
        )
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "color_picker_background", array(
        'label' => 'Background Color',
        'section' => 'my_custom_section',
        'settings' => 'color_picker_background'
        )
    ));   
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, "custom_image", array(
        'label' => 'Edit About Image',
        'settings' => 'custom_image',
        'section'   => 'my_custom_section'
        )
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,"price_digital_a5", array(
       "label" => __("Change Price: Digital A5", "customizer_control_label"),
       "section" => "my_custom_section",
       "settings" => "price_digital_a5",
       "type" => "number",
        )
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,"price_digital_a4", array(
       "label" => __("Change Price: Digital A4", "customizer_control_label"),
       "section" => "my_custom_section",
       "settings" => "price_digital_a4",
       "type" => "number",
        )
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,"price_digital_a3", array(
       "label" => __("Change Price: Digital A3", "customizer_control_label"),
       "section" => "my_custom_section",
       "settings" => "price_digital_a3",
       "type" => "number",
        )
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,"price_normal_a5", array(
       "label" => __("Change Price: Normal A5", "customizer_control_label"),
       "section" => "my_custom_section",
       "settings" => "price_normal_a5",
       "type" => "number",
        )
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,"price_normal_a4", array(
       "label" => __("Change Price: Normal A4", "customizer_control_label"),
       "section" => "my_custom_section",
       "settings" => "price_normal_a4",
       "type" => "number",
        )
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,"price_normal_a3", array(
       "label" => __("Change Price: Normal A3", "customizer_control_label"),
       "section" => "my_custom_section",
       "settings" => "price_normal_a3",
       "type" => "number",
        )
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,"price_pro_a5", array(
       "label" => __("Change Price: Professional A5", "customizer_control_label"),
       "section" => "my_custom_section",
       "settings" => "price_pro_a5",
       "type" => "number",
        )
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,"price_pro_a4", array(
       "label" => __("Change Price: Professional A4", "customizer_control_label"),
       "section" => "my_custom_section",
       "settings" => "price_pro_a4",
       "type" => "number",
        )
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,"price_pro_a3", array(
       "label" => __("Change Price: Professional A3", "customizer_control_label"),
       "section" => "my_custom_section",
       "settings" => "price_pro_a3",
       "type" => "number",
        )
    ));
}

add_action("customize_register", "mytheme_customize_register");


function generate_special_css(){
    $color_picker_text = get_theme_mod('color_picker_text');
    $color_picker_background = get_theme_mod('color_picker_background');
    $image = get_theme_mod('custom_image');

        ?>  
        <!-- change img -->
            <style type="text/css" id="custom-style-from-customiser">
                .about-img {
                    background-image: url(" <?php echo get_theme_mod('custom_image'); ?> ")!important;
                } 
            </style>
        <?php
        
        ?>
        <!-- change colors -->
            <style type="text/css" id="custom-style-from-customiser">
                body {
                    color:<?php echo $color_picker_text; ?>;
                    background-color:<?php echo $color_picker_background; ?>;
                }
                a {
                    color:<?php echo $color_picker_text; ?>;
                }
            </style> 
        <?php
}
    // change css across all pages
    add_action('wp_head', 'generate_special_css');