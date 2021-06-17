<?php

/** Template Name: pricing-page */

get_header();
?>

<!-- PRICING -->
<div class="pricing-wrapper">
    <div class="pricing-header">
        <h1>Photography Pricing</h1>
        <p>Hourly rate depends on the event, please contact me directly for more information</p>
    </div>
    <div class="pricing-boxes">
        <div class="price-box digital-only">
            <div class="print-type-header">
                <h2>Digital Only</h2>
            </div>
            <div class="paper-type-container">
                <div class="paper-type-box a5">
                    <p class="paper-size">A5</p>
                    <p class="print-price">$<?php echo get_theme_mod("price_digital_a5");?></p>
                </div>
                <div class="paper-type-box a4">
                    <p class="paper-size">A4</p>
                    <p class="print-price">$<?php echo get_theme_mod("price_digital_a4");?></p>
                </div>
                <div class="paper-type-box a3">
                    <p class="paper-size">A3</p>
                    <p class="print-price">$<?php echo get_theme_mod("price_digital_a3");?></p>
                </div>
            </div>
            <div class="print-type-description">
                <p>Files can be downloaded once payment is received</p>
            </div>
        </div>
        <div class="price-box normal-print">
            <div class="print-type-header">
                <h2>Normal Print</h2>
            </div>
            <div class="paper-type-container">
                <div class="paper-type-box a5">
                    <p class="paper-size">A5</p>
                    <p class="print-price">$<?php echo get_theme_mod("price_normal_a5");?></p>
                </div>
                <div class="paper-type-box a4">
                    <p class="paper-size">A4</p>
                    <p class="print-price">$<?php echo get_theme_mod("price_normal_a4");?></p>
                </div>
                <div class="paper-type-box a3">
                    <p class="paper-size">A3</p>
                    <p class="print-price">$<?php echo get_theme_mod("price_normal_a3");?></p>
                </div>
            </div>
            <div class="print-type-description">
                <p>Standard quality images printed on 265gsm paper</p>
            </div>
        </div>
        <div class="price-box professional-print">
            <div class="print-type-header">
                <h2>Professional Print</h2>
            </div>
            <div class="paper-type-container">
                <div class="paper-type-box a5">
                    <p class="paper-size">A5</p>
                    <p class="print-price">$<?php echo get_theme_mod("price_pro_a5");?></p>
                </div>
                <div class="paper-type-box a4">
                    <p class="paper-size">A4</p>
                    <p class="print-price">$<?php echo get_theme_mod("price_pro_a4");?></p>
                </div>
                <div class="paper-type-box a3">
                    <p class="paper-size">A3</p>
                    <p class="print-price">$<?php echo get_theme_mod("price_pro_a3");?></p>
                </div>
            </div>
            <div class="print-type-description">
                <p>Images are printed at the highest quality on Lustre Paper</p>
            </div>
        </div>
    </div>
</div>

<!-- PRICING PAGE QUOTE -->
<div class="quote-container">
    <div class="quote-subcontainer">
        <p class="quote pricing-quote">“The best thing about a picture is that it never changes, even when the people in it do”</p>
        <p class="quote-by pricing-quote-by">Andy Warhol</p>
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
