<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head
        content must come *after* these tags -->
        <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />
        <?php
        printf('<title>%s</title>', wp_title(' | ', false, 'right'));
        ?>

        <?php wp_head(); ?>
    </head>
    <body>
        <section class="canvas" id="page-canvas">
            <div class="container">
                <?php
                the_content();
                include 'analytics.php';
                wp_footer();
                ?>
            </div>
        </section>
        <footer>
            <div class="footer-info">
                <small> <?php
                $settings = get_option('mac_settings');
                $footer_text = @$settings['mac_footer_text'];
                printf("&copy; %s JoCo Cruise %s", date("Y"), $footer_text);
                    ?></small>
            </div>
        </footer>

    </body>
</html>
