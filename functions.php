<?php
define( 'THEME_VERSION', '1.0.1' );
function theme_enqueue_styles() {
    wp_enqueue_style(
        'main',
        get_template_directory_uri() . '/style.css', array(), THEME_VERSION
    );
    wp_enqueue_style(
        'custom-style',
        get_template_directory_uri() . '/assets/css/main.css', array( 'main' ), THEME_VERSION
    );
    // CDN hosted jQuery placed in the header, as some plugins require that jQuery is loaded in the header.
    wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.5.1.min.js', [], '3.5.1', false );

    wp_enqueue_script(
        'custom-script',
        get_stylesheet_directory_uri() . '/assets/js/script.js', THEME_VERSION
    );

    // Throw variables from back to front end.
    $theme_vars = array(
        'adminUrl' => admin_url( 'admin-ajax.php' )
    );
    wp_localize_script( 'custom-script', 'themeVars', $theme_vars );
}

add_theme_support( 'post-thumbnails' );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );


// Our custom post type function
function create_posttype() {
    register_post_type(
        'profile',
        // CPT Options
        array(
            'labels'       => array(
                'name' => __( 'Profile User' )
            ),
            'public'       => true,
            'has_archive'  => true,
            'rewrite'      => array( 'slug' => 'profile' ),
            'show_in_rest' => true,
            'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
            'menu_icon'    => 'dashicons-welcome-write-blog',
        )
    );
}

// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page(
        array(
            'page_title' => 'Profile User Settings',
            'menu_title' => 'Profile User Settings',
            'menu_slug'  => 'profile',
            'capability' => 'edit_posts',
            'redirect'   => false
        )
    );
}

add_action( 'acf/init', 'my_acf_init' );
function my_acf_init() {
    // check function exists
    if ( function_exists( 'acf_register_block' ) ) {
        // register a testimonial block
        acf_register_block(
            array(
                'name'            => 'invoice',
                'title'           => __( 'Invoice' ),
                'description'     => __( 'A custom invoice block.' ),
                'render_callback' => 'my_acf_block_render_callback',
                'category'        => 'layout',
                'icon'            => 'admin-comments',
                'keywords'        => array( 'invoice' ),
            )
        );
    }
}

function my_acf_block_render_callback( $block ) {
    // convert name ("acf/testimonial") into path friendly slug ("testimonial")
    $slug = str_replace( 'acf/', '', $block['name'] );
    // include a template part from within the "template-parts/block" folder
    if ( file_exists( get_theme_file_path( "/template-parts/block/content-{$slug}.php" ) ) ) {
        include( get_theme_file_path( "/template-parts/block/content-{$slug}.php" ) );
    }
}

/**
 * Load More handler
 */
function edit_content_ajax_handler() {
    global $post;

    $query_vars = $_POST['queryVars'];

    $payload = array(
        'acf_field'   => $query_vars["acf_filed"],
        'acf_content' => $query_vars["acf_content"]
    );

    update_field( $payload['acf_field'], $payload['acf_content'], 22 );


    echo json_encode( $payload );
    die();

}

add_action( 'wp_ajax_nopriv_edit_content', 'edit_content_ajax_handler' );
add_action( 'wp_ajax_edit_content', 'edit_content_ajax_handler' );
