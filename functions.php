<?php
define('THEME_VERSION', '1.0.1');
function theme_enqueue_styles() {
    wp_enqueue_style( 'main',
        get_template_directory_uri() . '/style.css', array(), THEME_VERSION
    );
    wp_enqueue_style( 'custom-style',
        get_template_directory_uri() . '/assets/css/main.css', array('main'), THEME_VERSION
    );
    wp_enqueue_script( 'custom-script',
        get_stylesheet_directory_uri() . '/assets/js/script.js', THEME_VERSION
    );
}

add_theme_support( 'post-thumbnails' );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );


// Our custom post type function
function create_posttype() {
    register_post_type( 'profile',
    // CPT Options
        array(
            'labels' => array(
                'name' => __('Profile User')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'profile'),
            'show_in_rest' => true,
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
            'menu_icon' => 'dashicons-welcome-write-blog',
        )
    );
}

// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Profile User Settings',
		'menu_title'	=> 'Profile User Settings',
		'menu_slug' 	=> 'profile',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
    ));
}

add_action('acf/init', 'my_acf_init');
function my_acf_init() {
	// check function exists
	if( function_exists('acf_register_block') ) {
		// register a testimonial block
		acf_register_block(array(
			'name'				=> 'testimonial',
			'title'				=> __('Testimonial'),
			'description'		=> __('A custom testimonial block.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
			'keywords'			=> array( 'testimonial', 'quote' ),
		));
	}
}

function my_acf_block_render_callback( $block ) {
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);
	// include a template part from within the "template-parts/block" folder
	if( file_exists( get_theme_file_path("/template-parts/block/content-{$slug}.php") ) ) {
		include( get_theme_file_path("/template-parts/block/content-{$slug}.php") );
	}
}



// function custom_posts_per_page( $query ) {
//     if ( $query->is_archive('postservies') ) {
//         set_query_var('posts_per_page', -1);
//     }
//     if ( $query->is_archive('postprojects') ) {
//         set_query_var('posts_per_page', -1);
//     }
// }
// add_action( 'pre_get_posts', 'custom_posts_per_page' );

?>
