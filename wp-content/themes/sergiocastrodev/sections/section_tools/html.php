<?php
$post_id = get_the_ID();
$prefix  = 'section_tools_';
$caption = get_post_meta($post_id, $prefix . 'caption', true);
$titulo  = get_post_meta($post_id, $prefix . 'titulo', true);
$items   = get_post_meta($post_id, $prefix . 'items', true);
?>
<section class="section_sergio_tools" id="advantage">
    <section class="section_width_sergio_tools">
        <section class="sergio_info">
            <?php if ($caption): ?>
                <p class="sergio_caption"><?php echo esc_html($caption); ?></p>
            <?php endif; ?>
            <?php if ($titulo): ?>
                <h2><?php echo wp_kses_post($titulo); ?></h2>
            <?php endif; ?>
        </section>
        <div class="sergio_tools_slider splide">
            <div class="splide__track">
                <section class="splide__list">
                    <?php if (is_array($items) && !empty($items)): ?>
                        <?php foreach ($items as $item): ?>
                            <?php
                            $nombre     = isset($item['nombre'])     ? $item['nombre']     : '';
                            $icono_svg  = isset($item['icono_svg'])  ? $item['icono_svg']  : '';
                            $icono_img  = isset($item['icono_img'])  ? $item['icono_img']  : '';
                            $url        = isset($item['url'])        ? $item['url']        : '';
                            ?>
                            <article class="splide__slide">
                                <?php if ($url): ?>
                                    <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr($nombre); ?>">
                                <?php endif; ?>
                                <div>
                                    <?php if ($icono_svg): ?>
                                        <?php echo $icono_svg; ?>
                                    <?php elseif ($icono_img): ?>
                                        <figure>
                                            <img src="<?php echo esc_url($icono_img); ?>" alt="<?php echo esc_attr($nombre); ?>">
                                        </figure>
                                    <?php endif; ?>
                                </div>
                                <?php if ($url): ?>
                                    </a>
                                <?php endif; ?>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </section>
            </div>
        </div>
    </section>
</section>
