<?php
$post_id = get_the_ID();
$prefix  = 'section_clients_';
$caption = get_post_meta($post_id, $prefix . 'caption', true);
$titulo  = get_post_meta($post_id, $prefix . 'titulo', true);
$items   = get_post_meta($post_id, $prefix . 'items', true);
?>
<section class="section_sergio_clients" id="clients">
    <section class="section_width_sergio_clients">
        <section class="sergio_info">
            <?php if ($caption): ?>
                <p class="sergio_caption"><?php echo esc_html($caption); ?></p>
            <?php endif; ?>
            <?php if ($titulo): ?>
                <h2><?php echo wp_kses_post($titulo); ?></h2>
            <?php endif; ?>
        </section>
        <div class="sergio_clients_slider splide">
            <div class="splide__track">
                <section class="splide__list">
                    <?php if (is_array($items) && !empty($items)): ?>
                        <?php foreach ($items as $item): ?>
                            <?php
                            $nombre   = isset($item['nombre'])   ? $item['nombre']   : '';
                            $logo_svg = isset($item['logo_svg']) ? $item['logo_svg'] : '';
                            $logo_img = isset($item['logo_img']) ? $item['logo_img'] : '';
                            $url      = isset($item['url'])      ? $item['url']      : '';
                            ?>
                            <article class="splide__slide">
                                <div>
                                    <?php if ($url): ?>
                                        <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr($nombre); ?>">
                                    <?php endif; ?>
                                    <?php if ($logo_svg): ?>
                                        <?php echo $logo_svg; ?>
                                    <?php elseif ($logo_img): ?>
                                        <figure>
                                            <img src="<?php echo esc_url($logo_img); ?>" alt="<?php echo esc_attr($nombre); ?>">
                                        </figure>
                                    <?php endif; ?>
                                    <?php if ($url): ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </section>
            </div>
        </div>
    </section>
</section>
