<?php
$header_logo     = cmb2_get_option('globals_options', 'header_logo');
$header_logo_url = cmb2_get_option('globals_options', 'header_logo_url');
?>
<header>
    <div class="header_width">
        <figure>
            <a href="<?php echo esc_url($header_logo_url ?: home_url('/')); ?>">
                <?php if ($header_logo): ?>
                    <img src="<?php echo esc_url($header_logo); ?>" alt="logo">
                <?php endif; ?>
            </a>
        </figure>
        <div class="toggle_menu">
            <span class="top"></span>
            <span class="middle"></span>
            <span class="bottom"></span>
        </div>
        <section class="container_menu">
            <nav>
                <?php wp_nav_menu([
                    'theme_location' => 'header_menu',
                    'container'      => false,
                    'items_wrap'     => '<ul>%3$s</ul>',
                    'fallback_cb'    => false,
                ]); ?>
            </nav>
        </section>
    </div>
</header>
