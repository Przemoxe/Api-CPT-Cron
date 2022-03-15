
<?php get_header();?>
<section>
    <?php 
    $args = array(
        'post_type'		=> 'api',
        'numberposts'	=> -1
    );
    $my_posts = get_posts( $args );
    echo '<pre>';
    foreach($my_posts as $post){
        $id = $post->ID;
        $get_field_id = get_field('id', $id);
        $get_field_author = get_field('author', $id);
        $get_field_url = get_field('url', $id);
        var_dump($get_field_id);
        var_dump($get_field_author);
        var_dump($get_field_url);
        echo '<br/>';
    }
    echo '</pre>';
      ?>
</section>

<?php get_footer();?>