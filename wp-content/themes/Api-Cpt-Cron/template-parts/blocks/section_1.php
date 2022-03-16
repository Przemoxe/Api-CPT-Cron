<section>
<?php

  /* Block Three Template */
  $api_posts = get_field('choose_posts') ?: 'Your about subtitle  text';
  
  foreach($api_posts as $post){
    
    foreach($post as $id){
        echo '<pre>';
        $get_post_title = get_the_title($id);
        $get_post_url = get_field('url', $id);
        $get_post_author = get_field('author', $id);
        $get_thumbnail = get_the_post_thumbnail_url($id);
        var_dump($get_post_title);
        var_dump($get_post_url);
        var_dump($get_thumbnail);
        var_dump($get_post_author);
        echo '</pre>';
        echo '<br><br><br>';
    }
  }
?>       
</section>

 

