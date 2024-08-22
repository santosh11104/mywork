<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
     wp_head();
    ?>
    
</head>

<body>
<?php
if(is_page(7272)){
?>
 	<?php 
  
             if ( is_front_page() ) { 
                echo '<header id="header" class="fixed-top">';
              } else { 
		echo '<header id="header" class="fixed-top header-inner-pages">'; 
              }             
 	?>
     <div class="container d-flex align-items-center">  
    <?php 
                if(function_exists('the_custom_logo')) {
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $chainyard_logo = wp_get_attachment_image_src($custom_logo_id , 'full'); 
                }
                ?>    
      <a href="<?php echo get_option("siteurl"); ?>" class="logo me-auto"><img src="<?php echo $chainyard_logo[0] ?>" alt="" class="img-fluid"></a>

      <nav id="navbar" class="navbar">
      <?php 
                        wp_nav_menu(
                            array(
                                'menu' => 'primary',
                                'container' => '',
                                'theme_location' => 'primary',
                                'menu-class' => 'nav navbar-nav navbar-right',
                                'items_wrap' => '<ul>%3$s</ul>',
                        //      'walker' => new Chanyard_Walker_Nav_Primary()
                                'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                                'walker' => new WP_Bootstrap_Navwalker(),
                            )
                        );
                    ?>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>

  <?php }else { ?>
	<?php 
             if ( is_front_page() ) { 
                echo '<header id="header" class="fixed-top1">';
              } else { 
		echo '<header id="header" class="fixed-top header-inner-pages1">'; 
              }             
 	?>
     <div class="container d-flex align-items-center">  
    <?php 
                if(function_exists('the_custom_logo')) {
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $chainyard_logo = wp_get_attachment_image_src($custom_logo_id , 'full'); 
                }
                ?>    
      <a href="<?php echo get_option("siteurl"); ?>" class="logo me-auto"><img src="<?php echo $chainyard_logo[0] ?>" alt="" class="img-fluid"></a>

      <nav id="navbar" class="navbar">
      <?php 
                        wp_nav_menu(
                            array(
                                'menu' => 'primary',
                                'container' => '',
                                'theme_location' => 'primary',
                                'menu-class' => 'nav navbar-nav navbar-right',
                                'items_wrap' => '<ul>%3$s</ul>',
                        //      'walker' => new Chanyard_Walker_Nav_Primary()
                                'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                                'walker' => new WP_Bootstrap_Navwalker(),
                            )
                        );
                    ?>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>

 <?php  } ?>