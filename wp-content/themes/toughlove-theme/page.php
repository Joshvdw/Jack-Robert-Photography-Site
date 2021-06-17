<?php
get_header();

echo apply_filters('the_content',$wp_query->post->post_content);

get_footer();
?>