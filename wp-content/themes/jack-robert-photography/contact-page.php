<?php

/** Template Name: contact-page */

get_header();
?>

<!-- CONTACT FORM -->
<div class="contact-container">
    <h1>Contact</h1>
    <?php echo do_shortcode ('[contact-form-7 id="28" title="Contact"]') ?>
</div>

<!-- CONTACT QUOTE -->
<div class="quote-container">
    <div class="quote-subcontainer">
        <p class="quote contact-quote">“Feel free to contact me anytime, I would love to hear from you”</p>
        <p class="quote-by contact-quote-by">Jack Robert</p>
    </div>  
</div>

<?php
get_footer();
?>