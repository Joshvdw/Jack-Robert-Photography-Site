<?php

/** Template Name: faqs-page */

?>
<?php
get_header();
?>
<div class="faq-container">
    <div class="faq-subcontainer">
        <div class="faq-wrapper">
            <h1>Frequently Asked Questions</h1><br>
            <?php

            //  tell wordpress we only want to show the post types with the name 'faq'
            query_posts( array(
                // query to get the post types called faq, post_type is a WP variable containing all the post types
                'post_type' => 'faq'
            ));

            // the wordpress loop
            if ( have_posts() ) :
                while ( have_posts() ) : the_post(); 
                
            ?>
            <?php $post_id = get_the_ID();?>

            <a href="javascript:void(0);" class="question" onclick="openAnswers(<?php echo $post_id ?>)">
                <p style="font-size:1.3em;" id="question"><i class="fa fa-plus" id="plus"></i> <?php the_title() ?></p>
            </a>

            <div id="<?php echo 'id_'.$post_id; ?>"  class="answer" style="display: none;">
                <?php echo '<p>' . get_post_meta( $post->ID, '_answer', true  ) . '</p>'; ?>
            </div>
            <?php endwhile;

            else :
                echo '<p>There are no posts!</p>';
            endif; ?>
        </div>
        <div class="faq-right-img"></div>
    </div>
</div>

<?php
get_footer();
?>
