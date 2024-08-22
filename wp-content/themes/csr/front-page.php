<?php 
get_header();
?>
<section>
<?php echo do_shortcode('[smartslider3 slider="3"]'); ?> 
</section>
<!-- Middle Content -- >
<?php
if(have_posts()) {
    while(have_posts()) {
        the_post();
        the_content();
    }
} 
?>

<?php 
    get_footer();
?>