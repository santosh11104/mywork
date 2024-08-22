<?php 
get_header();
?> 
<section class="blocks-padding blogs">
      <div class="container blogs-inner">
        <div class="row">
          <div class="col-12">
            <a href="/blogs" class="back-link"><i class="bi bi-arrow-left"></i> back</a>
            <p class="date"><?php the_date();?> </p>
            <h1 class="main-heading"><?php the_title(); ?></h1>
          </div>
        </div>
        <div class="row blog-content">
          <div class="col-lg-11 col-md-12 col-sm-12">
<?php the_post_thumbnail( 'large' )?>
 <?php the_content();?>


</div>
            <div class="col-lg-1 col-md-12 col-sm-12 icons-block">
          <div class="social-icons">
            <?php //echo DISPLAY_ULTIMATE_PLUS(); ?>
 </div>
        </div>
        </div>
    </section>
	
	   
<?php

get_footer();
?>


 

