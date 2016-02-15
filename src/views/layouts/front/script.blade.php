<!-- Load javascripts at bottom, this will reduce page load time -->
<!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
<!--[if lt IE 9]>
<script src="/assets/plugins/respond.min.js"></script>
<![endif]-->
<script src="/assets/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/layout/frontend/scripts/back-to-top.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
<script src="/assets/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
<script src="/assets/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->

<!-- BEGIN RevolutionSlider -->
<script src="/assets/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>
<script src="/assets/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js" type="text/javascript"></script>
<script src="/assets/layout/frontend/scripts/revo-slider-init.js" type="text/javascript"></script>
<!-- END RevolutionSlider -->

<script src="/assets/layout/frontend/scripts/layout.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        Layout.init();
        Layout.initOWL();
        RevosliderInit.initRevoSlider();
        Layout.initTwitter();
        //Layout.initFixHeaderWithPreHeader(); /* Switch On Header Fixing (only if you have pre-header) */
        //Layout.initNavScrolling();
    });
</script>
<!-- END PAGE LEVEL JAVASCRIPTS -->