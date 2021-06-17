<?php

/** Template Name: contact-page */

?>
<?php
get_header();
?>
<div class="contact-wrapper">
    <div class="contact-subwrapper">
            <h1><?php the_title() ?> Form</h1>
        <div class="contact-form">
            <?php the_content()?>
        </div>
        <div class="our-locations-map">
            <div class="map-subcontainer ">
                <img src="<?php bloginfo('stylesheet_directory');?>/images/map-new.png" alt="Map showing our locations across NZ" style=" height:100%; padding-bottom:25px">
            </div>
        </div>
    </div>
</div>
<div class="contact-footer">
    <h1>Contact Details</h1>
    <hr class="contact-line-break">
    <br><br>
    <div class="footer-col">
        <strong><p>Toughlove New Zealand Inc</p></strong>
        <p>0800 868445</p>
        <p>toughlovenz.info@gmail.com</p>
        <br class="line-break">
        <strong><p>Chairperson</p></strong>
        <p>Hamish McMillan</p>
        <p>chairperson@tlnz.org</p>
    </div>
    <div class="footer-col">
        <strong><p>Secretary</p></strong>
        <p>Tracy Roose</p>
        <p>secretary@tlnz.org</p>
        <br class="line-break">
        <strong><p>Treasurer</p></strong>
        <p>Chris Monk</p>
        <p>treasurer@tlnz.org</p>
    </div>
    <div class="footer-col">
        <strong><p>Toughlove Auckland Region</p></strong>
        <p>toughlovenz.auck@gmail.com</p>
        <br class="line-break">
        <br class="line-break">
        <strong><p>Toughlove Waikato Region</p></strong>
        <p>P O Box 12 286, Hamilton</p>
        <p>waikatopsg@gmail.com</p>
    </div>
    <div class="footer-col">
        <strong><p>Toughlove Upper South Island Region</p></strong>
        <p>toughloveusi@gmail.com</p>
        <br class="line-break">
        <br class="line-break">
        <strong><p>Donations</p></strong>
        <p>03-0802-0167603-00</p>
        <p>secretary@tlnz.org</p>
    </div>
</div>

<?php
get_footer();
?>