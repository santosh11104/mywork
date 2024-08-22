<?php 
get_header();
?>
<section class="dropdown-links container mx-auto blogs-category-links">
<?php
	if (function_exists('dynamic_sidebar')) {
		dynamic_sidebar('category-filter');
	}
?>
<br>
</section>
<?php
if(is_category()){
    $cat = get_query_var('cat');
    $category = get_category ($cat);
    echo '<section class="resource-insights container mx-auto"><h1>'.$category->cat_name.'</h1>';
    echo do_shortcode('[ajax_load_more category="'.$category->slug.'" cache="true" theme_repeater="css-grid.php" button_label="Show More" button_loading_label="Loading data..." transition_container_classes="css-grid" posts_per_page="3" scroll="false"  cache_id="cache-'.$category->slug.'"]</section>');
 }
?>
<script type="text/javascript">
  jQuery(function($) {
      $(".screen-reader-text").hide();
      window.location.href = window.location.href + '#category-focus';
  });
</script> 
<?php
get_footer();
?>