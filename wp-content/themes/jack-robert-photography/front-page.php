<?php
get_header();
?>
<!-- IMAGE CAROUSEL -->
<div class="homepage-carousel">
    <?php echo do_shortcode('[metaslider id="18"]'); ?>
</div>

<!-- SERVICE BOXES -->
<div class="services-container">
    <div class="service-box event-box">
        <p>Events</p>
    </div>
    
    <div class="service-box sport-box">
        <p>Sports</p>
    </div>

    <div class="service-box portrait-box">
        <p>Portraits</p>   
    </div>
</div>

<!-- HOMEPAGE QUOTE -->
<div class="quote-container">
    <div class="quote-subcontainer">
        <p class="quote homepage-quote">“Photography is the art of making memories tangible”</p>
        <p class="quote-by homepage-quote-by"">Destin Sparks</p>
    </div>
</div>

<!-- PROJECT STORIES -->
<div class="project-stories-container">
    <div class="header-banner">
        <h1>Project Stories</h1>
    </div>

     <?php
        query_posts( array(
            'post_type' => 'project-story'
        ));

        if ( have_posts() ) :
            while ( have_posts() ) : the_post(); 
        ?>
        
        <div class="project-story-wrapper">
            <div class="post-card" style="background-color:<?php echo get_post_meta( $post->ID, 'custom_meta_select_field', true ) ?>;">
                <h3><a href="<?php the_permalink() ?>"> <?php the_title() ?> </a></h3>
                <br><br>
                <?php the_content() ?>
                <br><br>
                <?php echo '<p>' . get_post_meta( $post->ID, '_date', true  ) . '</p>'; ?>
            </div>  
            <div class="story-img">
                <?php echo the_post_thumbnail(); ?>
            </div>          
        </div>

        <?php endwhile;

        else :
            echo '<p>There are no posts!</p>';
        endif; ?>
</div>

<?php
get_footer();
?>

