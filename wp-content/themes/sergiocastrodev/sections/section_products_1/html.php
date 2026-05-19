<?php
$post_id  = get_the_ID();
$prefix   = 'section_products_1_';

$titulo    = get_post_meta($post_id, $prefix . 'titulo',    true) ?: 'Nuestros Productos';
$subtitulo = get_post_meta($post_id, $prefix . 'subtitulo', true) ?: 'Miel artesanal cruda, cosechada con respeto por la naturaleza. Cada frasco refleja la esencia floral de nuestro entorno.';
$cta_text  = trim(get_post_meta($post_id, $prefix . 'cta_text',  true));
$cta_url   = trim(get_post_meta($post_id, $prefix . 'cta_url',   true));
$products  = get_post_meta($post_id, $prefix . 'products',  true);

if (empty($products) || !is_array($products)) {
    $products = [
        [
            'img'   => '',
            'badge' => 'Wildflower',
            'title' => 'Miel de Flores Silvestres',
            'desc'  => 'Néctar recolectado de prados primaverales. Notas florales ligeras.',
            'price' => '€24.00',
            'url'   => '#',
        ],
        [
            'img'   => '',
            'badge' => 'Mountain Forest',
            'title' => 'Miel de Bosque Profundo',
            'desc'  => 'Mielato de roble y castaño. Sabor intenso, maltoso y ligeramente amargo.',
            'price' => '€28.00',
            'url'   => '#',
        ],
        [
            'img'   => '',
            'badge' => 'Raw Comb',
            'title' => 'Panal de Miel Cruda',
            'desc'  => 'La experiencia más pura. Panal entero directamente de la colmena a tu mesa.',
            'price' => '€35.00',
            'url'   => '#',
        ],
    ];
}
?>
<section class="section_products_1" id="productos">

    <div class="section_width_products_1">

        <div class="products_1_header">
            <h2 class="products_1_titulo"><?php echo esc_html($titulo); ?></h2>
            <p class="products_1_subtitulo"><?php echo esc_html($subtitulo); ?></p>
        </div>

        <div class="products_1_list">
            <?php foreach ($products as $product) :
                $img   = $product['img']   ?? '';
                $badge = $product['badge'] ?? '';
                $title = $product['title'] ?? '';
                $desc  = $product['desc']  ?? '';
                $price = $product['price'] ?? '';
                $url   = !empty($product['url']) ? $product['url'] : '#';
            ?>
            <article class="products_1_card false_link" data-link="h3" data-parent="0">

                <div class="products_1_card_image_wrap">
                    <figure class="products_1_card_figure">
                        <?php if ($img) : ?>
                        <img src="<?php echo esc_url($img); ?>"
                             alt="<?php echo esc_attr($title); ?>"
                             width="400"
                             height="300"
                             loading="lazy"
                             decoding="async">
                        <?php endif; ?>
                    </figure>
                    <?php if ($badge) : ?>
                    <span class="products_1_card_badge"><?php echo esc_html($badge); ?></span>
                    <?php endif; ?>
                </div>

                <div class="products_1_card_content">
                    <h3 class="products_1_card_title">
                        <a href="<?php echo esc_url($url); ?>"><?php echo esc_html($title); ?></a>
                    </h3>
                    <?php if ($desc) : ?>
                    <p class="products_1_card_desc"><?php echo esc_html($desc); ?></p>
                    <?php endif; ?>
                    <div class="products_1_card_footer">
                        <span class="products_1_card_price"><?php echo esc_html($price); ?></span>
                        <a class="products_1_card_link" href="<?php echo esc_url($url); ?>">
                            Detalles
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>

            </article>
            <?php endforeach; ?>
        </div><!-- /.products_1_list -->

        <?php if ($cta_text || $cta_url) : ?>
        <div class="products_1_cta">
            <a class="products_1_cta_btn" href="<?php echo esc_url($cta_url ?: '#'); ?>">
                <?php echo esc_html($cta_text ?: $cta_url); ?>
            </a>
        </div>
        <?php endif; ?>

    </div>

</section>
