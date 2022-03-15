<?php
/**
 * Template Name: auto add post
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
    class AllMyLittleProducts{
    // 1. describe and create/initiate our object
        public $api_url = 'https://picsum.photos/v2/list';
        public $json_data;
        public $json_decode;
        public $my_variable_products = [];
        public $api_variable_products = [];
        public $diffed_varable_products = [];
        public $t_api = [];
        public $t_my = [];
        public $t_diffed = [];
        
    // 2. methods (function, action...)
        public function __construct(){
            $this->json_data = file_get_contents($this->api_url);
            $this->json_decode = json_decode($this->json_data);
            $this->add_api_posts();
            $this->add_my_posts();
            $this->add_diffed_posts();
        }
        public function add_api_posts(){
            $api_products = $this->json_decode;

            foreach($api_products as $api_product){
               
                array_push($this->api_variable_products, array(
                    'id' => $api_product->id,
                    'author' => $api_product->author,
                    'url' => $api_product->download_url
                ));
            }   
        }
        ////////////////////////////////
        public function add_my_posts(){
            $args = array(
                'post_type'		=> 'api',
                'numberposts'	=> -1
            );
            $my_posts = get_posts( $args );
            foreach($my_posts as $my_post){
                array_push($this->my_variable_products, array(
                    'id' => $my_post->id,
                    'author' => $my_post->author,
                    'url' => $my_post->url
                ));
            }
        }
        ////////////////////////////////
        public function add_diffed_posts(){
            $my_posts = $this->my_variable_products;
            $api_posts = $this->api_variable_products;

            for($i = 0; $i <= (count($api_posts) -1); $i++){
                $api_post = $api_posts[$i];
                $my_post = $my_posts[$i];
                array_push($this->t_api, $api_post['id']);
                array_push($this->t_my, $my_post['id']);
            }
            
            $array1 = $this->t_my;
            $array2 = $this->t_api;
            $diffed = array_diff($array2, $array1);
            $api_products = $this->api_variable_products;
            for($i = 0; $i <= (count($api_products) - 1); $i++){
                $api_product = $api_products[$i];
                if($api_product['id'] == $diffed[$i]){
                    $post_id =  wp_insert_post(array(
                        'post_title'=>'obrazek-'.$api_product['id'],
                        'post_type'=>'api',
                        'post_status' => 'publish'
                    ));
                    update_field('url', $api_product['url'], $post_id);
                    update_field('id', $api_product['id'], $post_id);
                    update_field('author', $api_product['author'], $post_id);

                    
                    $image_url        = $api_product['url']; // Define the image URL here
                    $image_name       = $api_product['url'].".jpg";
                    $upload_dir       = wp_upload_dir(); // Set upload folder
                    $image_data       = file_get_contents($image_url); // Get image data
                    $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
                    $filename         = basename( $unique_file_name ); // Create image file name
        
                    if( wp_mkdir_p( $upload_dir['path'] ) ) {
                        $file = $upload_dir['path'] . '/' . $filename;
                    } else {
                        $file = $upload_dir['basedir'] . '/' . $filename;
                    }
        
                    file_put_contents( $file, $image_data );
        
                    $wp_filetype = wp_check_filetype( $filename, null );
        
                    $attachment = array(
                        'post_mime_type' => $wp_filetype['type'],
                        'post_title'     => sanitize_file_name( $filename ),
                        'post_content'   => '',
                        'post_status'    => 'inherit'
                    );
        
                    $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
        
                // Include image.php
                    require_once(ABSPATH . 'wp-admin/includes/image.php');
        
                // Define attachment metadata
                    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
        
                // Assign metadata to attachment
                    wp_update_attachment_metadata( $attach_id, $attach_data );
        
                // And finally assign featured image to post
                    set_post_thumbnail( $post_id, $attach_id );
                }
            }
        }
    }
    // 3. events
    // You must use it in plugin 'WP Crontrol':  
    
    
