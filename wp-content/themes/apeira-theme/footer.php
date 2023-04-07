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

                <div class="col-6 col-sm-6 col-lg-2">
                    <div class="footer-widget">
                        <?php if (is_active_sidebar('widget-sidebar-footer2')) :  dynamic_sidebar('widget-sidebar-footer2');
                        endif; ?>
                    </div>
                </div>

                <div class="col-6 col-sm-6 col-lg-2">
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
    <div class="copyright">
        <div class="container">
			
            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-4">
            <div class="copyright-txt"><?php echo get_theme_mod('copyright'); ?></div>
				</div>
			</div>
			
        </div>
    </div>
</footer>


<?php
$date =  get_theme_mod(sanitize_underscores('Countdown Sale'));
$sale_icon =  get_theme_mod(sanitize_underscores('Countdown Sale Icon'));
$time=strtotime($date);
$day=date("d",$time);
$month=date("m",$time);
// $year=date("Y",$time);

if (!empty($date)) { ?>
    <div class="countdown-fixed">
        <img src="<?php echo get_attachment($sale_icon)['src']; ?>" />
        <div id="headline">Countdown to sale time</div>
        <div id="countdown">
            <ul>
                <li><span id="days"></span>days</li>
                <span class="separator">:</span>
                <li><span id="hours"></span>Hours</li>
                <span class="separator">:</span>
                <li><span id="minutes"></span>Minutes</li>
            </ul>
        </div>
    </div>
<?php }
?>
<script>
    (function() {
        const second = 1000,
            minute = second * 60,
            hour = minute * 60,
            day = hour * 24;

        //I'm adding this section so I don't have to keep updating this pen every year :-)
        //remove this if you don't need it
        let today = new Date(),
            dd = String(today.getDate()).padStart(2, "0"),
            mm = String(today.getMonth() + 1).padStart(2, "0"),
            yyyy = today.getFullYear(),
            nextYear = yyyy + 1,
            dayMonth = "<?php echo $month; ?>/<?php echo $day; ?>/",
            birthday = dayMonth + yyyy;

        today = mm + "/" + dd + "/" + yyyy;
        if (today > birthday) {
            birthday = dayMonth + nextYear;
        }
        //end

        const countDown = new Date(birthday).getTime(),
            x = setInterval(function() {

                const now = new Date().getTime(),
                    distance = countDown - now;

                document.getElementById("days").innerText = Math.floor(distance / (day)),
                    document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
                    document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute));
                    // document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

                //do something later when date is reached
                if (distance < 0) {
                    document.getElementById("headline").innerText = "It's Sale Time!";
                    document.getElementById("countdown").style.display = "none";
                    // document.getElementById("content").style.display = "block";
                    clearInterval(x);
                }
                //seconds
            }, 0)
    }());
</script>

<?php wp_footer(); ?>
</body>

</html>