 
<?php 
if ( is_front_page() ) { 
   echo ' <footer id="footer" class="home-footer"> ';
 } else { 
echo ' <footer id="footer" class="inner-footer"> '; 
 }             
?>

<div class="footer-top">
<div class="container">
<div class="row">
<div class="col-lg-10 col-md-12 col-sm-12 footer-contact">
<div class="logo mb-3">
 <img src="<?php echo get_option("siteurl"); ?>/wp-content/themes/itpeople/assets/images/logo-white.png" alt="">
</div>
<?php
 if (function_exists('dynamic_sidebar')){
   dynamic_sidebar('footer-1');
 }
?>
</div>
<div class="col-lg-2 col-sm-12  footer-contact">
<a href="https://twitter.com/ITPeopleNC" target="_blank" class="social-link twitter"><i class="bx bxl-twitter"></i></a>
<a href="https://www.linkedin.com/company/it-people-corporation/" target="_blank" class="social-link linkedin"><i class="bx bxl-linkedin"></i></a>
</div>

</div>
<div class="row">
<div class="col-lg-3 col-md-6 col-sm-4 footer-links" style="display:none;">
<h5>About</h5>
<ul>
<?php
 if (function_exists('dynamic_sidebar')){
   dynamic_sidebar('footer-2');
 }
?>
</ul>
</div>

<div class="col-lg-3 col-md-4 col-sm-4 footer-links" style="display:none;">
<h5>Company</h5>
<ul>
 <li><a href="<?php echo get_option("siteurl"); ?>/blogs">Blogs</a></li>
 <li><a href="<?php echo get_option("siteurl"); ?>/privacy">Privacy</a></li>
</ul>
</div>
<?php
if(!is_page(7272)):
?>
 

<div class="col-lg-3 col-md-6 col-sm-12 contact-info">
<h5>IT People USA</h5>
<ul>
 <li><i class="bx bx-map"></i>IT People Corporation, Inc.<br/>
   One Copley Parkway, Suite 216,
   Morrisville, NC 27560, USA.
<a href="https://goo.gl/maps/SVES6URzb2ZgZ6Yf6" target="_blank"><img src="<?php echo get_option("siteurl"); ?>/wp-content/themes/itpeople/assets/images/direction-arrow.png" alt="IT People USA Office" title="Get Directions"/></a></li>
  
<li><i class="bx bx-phone-call"></i> 919.806.3535</li>
<li><i class="bx bx-printer"></i> 919.806.2299</li>
</ul>
</div>
<div class="col-lg-3 col-md-6 col-sm-12 contact-info">
<h5>IT People India</h5>
<ul>
 <li><i class="bx bx-map"></i>IT People Corporation India Pvt Ltd.<br/>
 4th Floor, Jyothi Celesta Building, #66, Block B, Kavuri Hills, Madhapur, Hyd-500081, India.
 <a href="https://goo.gl/maps/jcDqZeARaJW37Eng6" target="_blank"><img src="<?php echo get_option("siteurl"); ?>/wp-content/themes/itpeople/assets/images/direction-arrow.png" alt="IT People India Office" title="Get Directions"/></a></li>
<li><i class="bx bx-phone-call"></i>+91-40-40172200</li>
<li><i class="bx bx-printer"></i>+91-40-40172205</li>
</ul>
</div>
<div class="col-lg-3 col-md-6 col-sm-12 contact-info">
<h5>IT People Philippines</h5>
<ul>
 <li><i class="bx bx-map"></i>IT People Philippines Corporation.<br/>
 4F Regus Office, Angliongto Damosa Gateway, Brgy Angliongto Alfonso Sr, Buhangin District, Davao City 8000.
 
 <a href="https://goo.gl/maps/GtMhDyMjJAGU5DEm6" target="_blank"><img src="<?php echo get_option("siteurl"); ?>/wp-content/themes/itpeople/assets/images/direction-arrow.png" alt="IT People Philippines Office" title="Get Directions"/></a></li>              </li>
<li><i class="bx bx-phone-call"></i> +63 (082) 238-7551</li>
<!--<li><i class="bx bx-printer"></i> 919.806.2299</li> -->

</ul>
</div>
<?php endif; ?>
<div class="col-lg-3 col-md-6 col-sm-12 contact-info">
  <h5>Chainyard Philippines</h5>
  <ul>
   <li><i class="bx bx-map"></i>Chainyard OPC<br/>
    #34 Door 2, Phase 2. Cordillera St., Central Park Bangkal Talomo (Pob.), Talomo District, Davao City. Davao Del Sur
   <a href="https://maps.app.goo.gl/bCpoYbXZNaAaerg78" target="_blank"><img src="<?php echo get_option("siteurl"); ?>/wp-content/themes/itpeople/assets/images/direction-arrow.png" alt="IT People Philippines Office" title="Get Directions"/></a></li>              </li>
  <li><i class="bx bx-phone-call"></i>+63 (082) 315-0591</li>
  <!--<li><i class="bx bx-printer"></i> 919.806.2299</li> -->
  
  </ul>
  </div>

</div>
</div>
</div>

<div class="container footer-bottom clearfix">
<div class="copyright">
Copyright &copy; 2024. All Rights Reserved.
</div>
<div class="credits">
<ul>
<li><a href="<?php echo get_option("siteurl"); ?>/privacy/">Privacy Policy</a></li>
<li><a href="<?php echo get_option("siteurl"); ?>/terms-of-use/">Terms of Service</a></li>
</ul>
</div>
</div>

</footer>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php 
wp_footer();
?>
</body>

<!--script src="<?php echo get_option("siteurl"); ?>/wp-content/themes/itpeople/assets/js/bootstrap.bundle.min.js"></script-->
<!--script src="<?php echo get_option("siteurl"); ?>/wp-content/themes/itpeople/assets/js/jquery.min.js"></script-->
<!--customjs-->
<script src="<?php echo get_option("siteurl"); ?>/wp-content/themes/itpeople/assets/js/custom.js"></script>

<script>
document.addEventListener( 'wpcf7mailsent', function( event ) {
document.querySelectorAll("form.wpcf7-form > :not(.wpcf7-response-output)").forEach(el => {
el.style.display = 'none';
});
}, false );
</script> 
<script id="rendered-js" src="<?php echo get_option("siteurl"); ?>/wp-content/themes/itpeople/assets/js/timeline.js"></script>
<script>
$(".wpcf7-form-control").on("keypress", function(e) {
if (e.which === 32 && !this.value.length)
e.preventDefault();
});
</script>
</html>