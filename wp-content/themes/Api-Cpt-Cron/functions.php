<?php
add_theme_support( 'post-thumbnails', array( 'post', 'api' ) );
function create_api_posttype() {


	register_post_type( 'api',
		array(
			'labels' => array(
				'name' => __( 'Api' ),
				'singular_name' => __( 'Api' )
			),
			'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'api'),
			'show_in_rest' => true,
      'show_in_menu' => true

		)
	);
}
add_action( 'init', 'create_api_posttype' );

function add_scripts(){
	wp_enqueue_script('main-api-js', get_theme_file_uri('/includes/ajax.js'), array('jquery'), '1.0', true);
	}
add_action( 'init', 'add_scripts' );





//Bloki/Sekcje gutenberg

add_action('acf/init', 'my_acf_blocks_init');
function my_acf_blocks_init() {

	// Check function exists.
	if( function_exists('acf_register_block_type') ) {

		// Register a One block.
		acf_register_block_type(array(
			'name'              => 'section_1',
			'title'             => __('section_1'),
			'description'       => __('A custom section_1 block.'),
			'render_template'   => 'template-parts/blocks/section_1.php',
			'category'          => 'formatting',
		));
	}
}

register_nav_menus(
  array(
    'menu-1' => esc_html__( 'Header Menu Location', 'ideo' ),  
  )
);

/**
 *  Local JSON.
 */

add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
function my_acf_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    
    // return
    return $path;
}
add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    // append path
    $paths[] = get_stylesheet_directory() . '/acf-json';
    
    // return
    return $paths;
}

require_once get_theme_file_path('auto-add-posts.php');

