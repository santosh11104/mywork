<?php 

/**
 *  
 */

//  require get_template_directory(). '/inc/walker.php';

/**
 * Register Custom Navigation Walker
 */
function csr_register_navwalker(){
	require_once get_template_directory() . '/inc/wp-bootstrap-navwalker-master/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'csr_register_navwalker' );


/**
 * Theme support.
 * add_theme_support function will add option in csr theme.
 * @since csr 1.0
 */
function csr_theme_support() {

    // Adding dynamic title support
    add_theme_support('title-tag');

    // Adding dynamic logo support
    add_theme_support('custom-logo');

    // Adding dynamic thumbnail support
    add_theme_support('post-thumbnails');

}

// add_action will load theme support option when theme done setup. 
add_action('after_setup_theme', 'csr_theme_support');

/**
 * Enqueue style.
 * wp_enqueue_style is defination of the script example js or css.
 * which contain source & array is to define depandency & version.
 * @since csr 1.0
 */
function csr_register_styles() {
    // Getting Version
    $version = wp_get_theme()->get('Version');
    
    //Custom style enqueue with theme version with bootstrap dependancy.
   
    
    //Bootstrap 4.5.3 style enqueue.
    wp_enqueue_style('csr-bootstrap', get_template_directory_uri()."/assets/css/bootstrap/bootstrap.min.css", array(), '5.0.2', 'all');
   
    wp_enqueue_style('csr-boxicons', get_template_directory_uri()."/assets/css/boxicons/css/boxicons.min.css", array(), '2.1.4', 'all');
    wp_enqueue_style('csr-bootstrap-icons', get_template_directory_uri()."/assets/css/bootstrap-icons/bootstrap-icons.css", array(), '1.10.3', 'all');
    wp_enqueue_style('csr-style', get_template_directory_uri()."/style.css", array('csr-bootstrap'), $version, 'all');
  //Jquery 3.5.1 script enqueue. 
    wp_enqueue_script( 'csr-jquery', get_template_directory_uri() . '/assets/js/jquery-3.5.1.min.js', array(), '3.5.1', true );
    wp_enqueue_script( 'csr-owl-carousel-js', get_template_directory_uri() . '/assets/js/owl-carousel.min.js', array(), '2.3.4', true );
    wp_enqueue_script( 'csr-bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '4.5.3', true );    
    wp_enqueue_style('csr-timelinestyle', get_template_directory_uri()."/assets/css/timeline.css", array(), 1.0, 'all');    
    wp_enqueue_style('csr-owl-carousel', get_template_directory_uri()."/assets/css/owl-carousel/owl.carousel.min.css", array(), 1.0, 'all');
    wp_enqueue_style('csr-owl-theme', get_template_directory_uri()."/assets/css/owl-carousel/owl.theme.default.min.css", array(), 1.0, 'all');     

}

// add_action load script when theme initalize.
add_action('wp_enqueue_scripts', 'csr_register_styles');


/**
 * Enqueue scripts.
 * wp_enqueue_script is defination of the script example js or css.
 * Which contain source & array is to define depandency & version.
 * Here true meaning it will load in footer.
 * @since csr 1.0
 */
/* function csr_register_scripts() {
    //Jqueryslim 3.5.1 script enqueue via jquery site.
    wp_enqueue_script('csr-jquery-slim', 'https://code.jquery.com/jquery-3.5.1.slim.min.js', array(), '3.5.1', true);

    //Popper 1.16.1 script enqueue via cdn site.
    wp_enqueue_script('csr-popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', array(), '1.16.1', true );

    //Bootstrap 4.5.3 script enqueue via cdn site.
    wp_enqueue_script('csr-bootstrap-cdn','https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js', array(), '4.5.3', true );

    // //Custom script enqueue.
    wp_enqueue_script( 'csr-script', get_template_directory_uri() . '/assets/js/script.js', array('chinyard-jquery'), '1.0', true );
   
    // //Bootstrap 4.5.3 script enqueue.
    wp_enqueue_script( 'csr-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '4.5.3', true );
    
    //Jquery 3.5.1 script enqueue.
    wp_enqueue_script( 'csr-jquery', get_template_directory_uri() . '/assets/js/jquery-3.5.1.min.js', array(), '3.5.1', true );
}

// add_action load script when theme initalize.
add_action('wp_enqueue_scripts', 'csr_register_scripts'); */


/**
 * Defining new menus on csr theme.
 * register_nav_menus function will register menu options.
 * @since csr 1.0
 */
function csr_menus() {

    //Defining the menus in the theme using key & value.
    $location = array(
        'primary' => "csr Primary or Main menu"
    );

    //Registering the menus
    register_nav_menus($location);
}

// add_action load manu when theme initalize.
add_action('init', 'csr_menus');


/**
 * Adding anchor "a" tag class in csr theme.
 * @since csr 1.0
 */
function csr_add_menuclass($ulclass) {
    return preg_replace('/<a /', '<a class="nav-link"', $ulclass);
}

// add_filter will add class in anchor tag when menu loads.
add_filter('wp_nav_menu','csr_add_menuclass');


/**
 * Defining custom widget for csr theme.
 * register_sidebar function will register custom widget.
 * @since csr 1.0
 */
 function csr_widget_areas() {
    register_sidebar(
        array(
            'before_title' => '',
            'after_title' => '',
            'before_widget' => '',
            'after_widget' => '',
            'name' => 'Our Partners',
            'id' => 'our-partners',
            'description' => 'This will display csr partners.',
        )
    );
     register_sidebar(
         array(
             'before_title' => '<p class="heading">',
             'after_title' => '</p>',
             'before_widget' => '',
             'after_widget' => '',
             'name' => 'Footer One',
             'id' => 'footer-1',
             'description' => 'Footer One will display at first postion.',
         )
     );
     register_sidebar(
        array(
            'before_title' => '<p class="heading">',
            'after_title' => '</p>',
            'before_widget' => '',
            'after_widget' => '',
            'name' => 'Footer Two',
            'id' => 'footer-2',
            'description' => 'Footer Two will display at second position.',
        )
    );
    register_sidebar(
        array(
            'before_title' => '<p class="heading">',
            'after_title' => '</p>',
            'before_widget' => '',
            'after_widget' => '',
            'name' => 'Footer Three',
            'id' => 'footer-3',
            'description' => 'Footer Three will display at third postion.',
        )
    );
    register_sidebar(
        array(
            'before_title' => '<p class="heading">',
            'after_title' => '</p>',
            'before_widget' => '',
            'after_widget' => '',
            'name' => 'Footer Four',
            'id' => 'footer-4',
            'description' => 'Footer Four will display at fourth position.',
        )
    );
    register_sidebar(
        array(
            'before_title' => '<p class="heading">',
            'after_title' => '</p>',
            'before_widget' => '',
            'after_widget' => '',
            'name' => 'Footer Bottom',
            'id' => 'footer-bottom',
            'description' => 'Footer Four will display at bottom position.',
        )
    );
    register_sidebar(
        array(
            'before_title' => '<span class="hidden">',
            'after_title' => '</span>',
            'before_widget' => '',
            'after_widget' => '',
            'name' => 'Category Filter',
            'id' => 'category-filter',
            'description' => 'Filter the post based on category.',
        )
    );
 }

 //add_action will add widget in csr theme when widget initalize.
 add_action('widgets_init', 'csr_widget_areas');

 //Removing auto p tags
 remove_filter( 'the_content', 'wpautop' );
 remove_filter( 'the_excerpt', 'wpautop' );

/**
 * Defining excerpt limit for csr theme.
 * @since csr 1.0
 */
 function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
        if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    }	
    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    return $excerpt;
  }

 /**
 * Defining title limit for csr theme.
 * @since csr 1.0
 */
  function title($limit) {
    $title = explode(' ', get_the_title(), $limit);
        if (count($title)>=$limit) {
        array_pop($title);
        $title = implode(" ",$title).'...';
    } else {
        $title = implode(" ",$title);
    }	
    $title = preg_replace('`[[^]]*]`','',$title);
    return $title;
  }

/**
 * Defining content limit for csr theme.
 * @since csr 1.0
 */
  function content($title) {
    $content = explode(' ', get_the_content(), $limit);
        if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
    } else {
        $content = implode(" ",$content);
    }	
    $content = preg_replace('/[.+]/','', $content);
    $content = apply_filters('the_content', $content); 
    $content = str_replace(']]>', ']]>', $content);
    return $content;
  }

/**
 * Defining menu active class for csr theme.
 * @since csr 1.0
 */
  add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
  function special_nav_class($classes, $item){
     if( in_array('current-menu-item', $classes ) ){
             $classes[] = 'navbar navbar-nav nav-item active nav-link';
     }
     return $classes;
  }



/**
 * This function is use to display tag in resources using ajax load more plugin.
 * @since csr 1.0
 */
function csr_get_post_tag() {
    $post_tags = get_the_tags();
    if ( $post_tags ) {
    foreach( $post_tags as $tag) :
        if ( $tag->name === 'insights' ) :
    ?>
    <div class="title violet"><?php echo ucfirst($tag->name); ?></div>
    <?php
        elseif ( $tag->name === 'events2020' ||  $tag->name === 'events'||  $tag->name === 'events2019' ) :
    ?>
     <div class="title pink"><?php echo ucfirst($tag->name); ?></div>
    <?php
        elseif ( $tag->name === 'Case Study' ||  $tag->name === 'tys') :
    ?>
    <div class="title"><?php echo ucfirst($tag->name); ?></div>        
    <?php 
        else:
        endif; 
    endforeach;} 

}


/**
 * This function is use to display category in individual blog post.
 * @since csr 1.0
 */
function csr_get_post_category() {
    $categories = get_the_category();
    foreach ($categories as $category) {
        echo '<li><a class="post-item" href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a></li>';
    }
}

/**
 * This function is use to display tag in resources using ajax load more plugin.
 * @since csr 1.0
 */
function csr_get_article_post_tag() {
    $post_tags = get_the_tags();
    if ( $post_tags ) {
    foreach( $post_tags as $tag) :
        if ( $tag->name === 'insights' ) :
    ?>
    <li class="single-post-tag"><?php echo ucfirst($tag->name); ?></li>
    <?php
        elseif ( $tag->name === 'events2020' ||  $tag->name === 'events'||  $tag->name === 'events2019' ) :
    ?>
     <li class="single-post-tag"><?php echo ucfirst($tag->name); ?></dli>
    <?php
        elseif ( $tag->name === 'Case Study' ||  $tag->name === 'tys') :
    ?>
    <li class="single-post-tag"><?php echo ucfirst($tag->name); ?></li>        
    <?php 
        else: ?><li class="single-post-tag"><?php echo ucfirst($tag->name); ?></li><?php
        endif; 
    endforeach;} 

}

/**
 * Adding the custom thumbnail size using wordpress add_image_size function.
 * this will add size in media. The thumbnail is used in resource page of the website.
 * @since csr 1.0
 */

add_action( 'after_setup_theme', 'csr_theme_setup' );
function csr_theme_setup() {
    add_image_size( 'resources-thumb-top', 350, 273, true );
    add_image_size( 'resources-thumb', 352, 240, true );
    add_image_size( 'cst-thumb', 355, 200, true );
    add_image_size( 'front-thumb-one-two-four-six', 255, 261, true );
    add_image_size( 'front-thumb-three', 255, 555, true );
    add_image_size( 'front-thumb-five', 540, 264, true );
    add_image_size( 'front-thumb-seven', 350, 273, true );
    add_image_size( 'front-thumb-eight', 730, 273, true );
    add_image_size( 'front-thumb-eight-big', 688, 524, true );
    add_image_size( 'front-thumb-eight-big-second', 390, 209, true );
    add_image_size( 'front-thumb-eight-big-third', 405, 225, true );
}
 

/**
 * This function is use to display category in resources and category filter page.
 * Using ajax load more plugin.
 * @since csr 1.0
 */
function csr_get_post_cat() {
    $post_tags = get_the_category();
    if ( $post_tags ) {
    foreach( $post_tags as $category) :
        if ( $category->name  == 'Insights' ) :
    ?>
    <div class="title violet"><?php echo $category->name; ?></div>
    <?php
        elseif ( $category->cat_name  === 'Events' ) :
    ?>
     <div class="title pink"><?php echo $category->name; ?></div>
     <?php
        elseif ( $category->cat_name === 'Announcements') :
    ?>
    <div class="title green"><?php echo $category->name; ?></div>
    <?php
        elseif ( $category->slug === 'whitepapers') :
    ?>
    <div class="title blue"><?php echo $category->name; ?></div>    
    <?php
        elseif ( $category->slug === 'case-studies') :
    ?>
    <div class="title"><?php echo $category->name; ?></div>    
    <?php 
        else: ?><?php
        endif; 
    endforeach;} 
}

/**
 * Plugin Name: Support for the _shuffle_and_pick WP_Query argument.
 */
add_filter( 'the_posts', function( $posts, \WP_Query $query )
{
    if( $pick = $query->get( '_shuffle_and_pick' ) )
    {
        shuffle( $posts );
        $posts = array_slice( $posts, 0, (int) $pick );
    }
    return $posts;
}, 10, 2 );

?>