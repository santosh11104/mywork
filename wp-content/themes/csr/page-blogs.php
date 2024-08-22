<?php
get_header();
?>

<main>
    <section class="blogs blocks-padding" style="padding-bottom:0rem;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-8 col-sm-12 text-center heading">
                    <p>Blogs</p>
                    <h1>Explore our stories and insights</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="dropdown-links container mx-auto">
        <?php
        if (function_exists('dynamic_sidebar')) {
             dynamic_sidebar('category-filter');
            }
        ?>
    </section>  
<section class="blog-con">          
    <div class="container">
        <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <?php
                        //new query
                        $original_query = $wp_query;
                        $wp_query = null;
                        $args = array('posts_per_page' => 1, 'category_name' => 'digital-transformation');
                        $wp_query = new WP_Query($args);
                        if (have_posts()) :
                            while (have_posts()) : the_post();
                                $post_counter++; ?>
                                <figure class="big-block">
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'front-thumb-eight-big'); ?>" alt="" class="img-fluid">
                                        <p class="category-label">lifestyle</p>
                                            <figcaption>
                                                <a href="<?php the_permalink(); ?>">  <h3 class="first-heading"><?php the_title(); ?></h3></a>
                                            <p><?php the_excerpt(); ?></p>
                                            </figcaption>                                    
                                </figure>
                                <?php
                                    endwhile;
                                endif;
                                $wp_query = null;
                                $wp_query = $original_query;
                                wp_reset_postdata();
                                ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="d-flex flex-column">
                            <?php
                            //new query
                            $original_query = $wp_query;
                            $wp_query = null;
                            $args = array('posts_per_page' => 1, 'category_name' => 'workforce-solutions');
                            $wp_query = new WP_Query($args);
                            if (have_posts()) :
                                while (have_posts()) : the_post();
                                    $post_counter++; ?>
                                    <figure class="small-block">
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'front-thumb-eight-big-second'); ?>" alt="" class="img-fluid">
                                            <p></p>
                                            <p class="category-label">business</p>
                                            <figcaption>
                                                <h4><?php the_title(); ?></h4>
                                            </figcaption>
                                    </figure></a>
                            <?php
                                endwhile;
                            endif;
                            $wp_query = null;
                            $wp_query = $original_query;
                            wp_reset_postdata(); ?>
                        </div>
                        <div class="d-flex flex-column">
                            <?php
                            //new query
                            $original_query = $wp_query;
                            $wp_query = null;
                            $args = array('posts_per_page' => 1, 'category_name' => 'supply-chain-platform');
                            $wp_query = new WP_Query($args);
                            if (have_posts()) :
                                while (have_posts()) : the_post();
                                    $post_counter++; ?>
                                    <figure class="small-block">
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'front-thumb-eight-big-second'); ?>" alt="" class="img-fluid">
                                            <p></p>
                                            <p class="category-label">personal</p>
                                            <figcaption>
                                                <h4><?php the_title(); ?></h4>
                                            </figcaption>
                                    </figure></a>
                            <?php
                                endwhile;
                            endif;
                            $wp_query = null;
                            $wp_query = $original_query;
                            wp_reset_postdata(); ?>
                        </div>
                    </div>



            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="discover-blogs">
                <div class="row justify-content-between">
                    <h1>Blogs</h1> 
                </div>
                <?php
                if (have_posts()) {
                    while (have_posts()) {

                        the_post();

                        // get_template_part('template-parts/content', 'page');
                        the_content();
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>
    

</main>

<script type="text/javascript">
    jQuery(function($) {
        $(".screen-reader-text").hide();
    });
</script>
<?php
get_footer();
?>