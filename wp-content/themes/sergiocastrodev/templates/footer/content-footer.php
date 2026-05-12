<?php
$footer_cta_texto   = cmb2_get_option('globals_options', 'footer_cta_texto');
$footer_cta_url     = cmb2_get_option('globals_options', 'footer_cta_url');
$footer_linkedin    = cmb2_get_option('globals_options', 'footer_linkedin_url');
$footer_youtube     = cmb2_get_option('globals_options', 'footer_youtube_url');
$footer_email       = cmb2_get_option('globals_options', 'footer_email');
$footer_logo_svg    = cmb2_get_option('globals_options', 'footer_logo_svg');
$footer_logo        = cmb2_get_option('globals_options', 'footer_logo');
$footer_site_url    = cmb2_get_option('globals_options', 'footer_site_url');
$footer_copyright   = cmb2_get_option('globals_options', 'footer_copyright');
?>
<section class="sergio_footer">
    <a href="<?php echo esc_url($footer_cta_url); ?>" class="footer_slider_contact">
        <?php echo esc_html($footer_cta_texto); ?>
        <span><?php include get_template_directory() . '/assets/img/icons/icon_arrow.svg'; ?></span>
    </a>
    <div class="footer_social">
        <?php if ($footer_linkedin): ?>
            <a href="<?php echo esc_url($footer_linkedin); ?>" target="_blank"><?php include get_template_directory() . '/assets/img/icons/icon_linkedin.svg'; ?></a>
        <?php endif; ?>
        <?php if ($footer_youtube): ?>
            <a href="<?php echo esc_url($footer_youtube); ?>" target="_blank"><?php include get_template_directory() . '/assets/img/icons/icon_youtube.svg'; ?></a>
        <?php endif; ?>
    </div>
    <div class="footer_contact">
        <?php if ($footer_email): ?>
            <a href="mailto:<?php echo esc_attr($footer_email); ?>"><?php echo esc_html($footer_email); ?></a>
        <?php endif; ?>
        <a href="<?php echo esc_url($footer_site_url ?: home_url('/')); ?>" target="_blank">
            <?php if ($footer_logo_svg): ?>
                <?php echo $footer_logo_svg; ?>
            <?php elseif ($footer_logo): ?>
                <img src="<?php echo esc_url($footer_logo); ?>" alt="logo">
            <?php else: ?>
                <?php include get_template_directory() . '/assets/img/icons/logo_sergio.svg'; ?>
            <?php endif; ?>
        </a>
        <p><?php echo esc_html($footer_copyright); ?> | <?php echo date('Y'); ?></p>
    </div>
</section>
