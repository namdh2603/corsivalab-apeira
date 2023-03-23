<!-- Footer -->
<footer class="footer">
    <div class="middle-footer">
        <div class="container">
            <div class="row">
            <div class="col-12 col-sm-6 col-lg-4">
                        <div class="footer-widget">
                            <?php if (is_active_sidebar('widget-sidebar-footer1')) :  dynamic_sidebar('widget-sidebar-footer1');
                            endif; ?>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-2">
                        <div class="footer-widget">
                            <?php if (is_active_sidebar('widget-sidebar-footer2')) :  dynamic_sidebar('widget-sidebar-footer2');
                            endif; ?>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-2">
                        <div class="footer-widget">
                            <?php if (is_active_sidebar('widget-sidebar-footer3')) :  dynamic_sidebar('widget-sidebar-footer3');
                            endif; ?>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="footer-widget">
                            <?php if (is_active_sidebar('widget-sidebar-footer4')) :  dynamic_sidebar('widget-sidebar-footer4');
                            endif; ?>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="copyright text-center">
        <div class="container">
            <div class="copyright-txt"><?php echo get_theme_mod('copyright'); ?></div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>