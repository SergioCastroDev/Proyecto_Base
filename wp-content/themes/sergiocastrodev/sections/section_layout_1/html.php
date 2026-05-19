<?php
$post_id = get_the_ID();
$prefix  = 'section_layout_1_';

$titulo = get_post_meta($post_id, $prefix . 'titulo', true);
$cards  = get_post_meta($post_id, $prefix . 'cards',  true);

// ── Fallbacks ────────────────────────────────────────────────────────────────
if (empty($titulo)) {
    $titulo = 'Nuestra Cosecha Principal';
}

if (empty($cards) || !is_array($cards)) {
    $cards = [
        [
            'bg'       => 'linear-gradient(160deg, #8D4B00 0%, #271500 100%)',
            'img'      => '',
            'label'    => 'El alma de la colmena',
            'title'    => 'Miel Artesanal',
            'desc'     => 'Métodos de cosecha de bajo impacto que preservan el ecosistema y la calidad natural.',
            'link_url' => '#',
        ],
        [
            'bg'       => 'linear-gradient(160deg, #C8920A 0%, #7A4800 100%)',
            'img'      => '',
            'label'    => 'Polinización silvestre',
            'title'    => 'Polen de Abeja',
            'desc'     => 'Pequeñas perlas doradas cargadas de proteínas, vitaminas y minerales esenciales.',
            'link_url' => '#',
        ],
        [
            'bg'       => 'linear-gradient(160deg, #6B6040 0%, #3D2B1A 100%)',
            'img'      => '',
            'label'    => 'Vitalidad Real',
            'title'    => 'Jalea Real',
            'desc'     => 'El alimento exclusivo de la reina, reservado durante siglos por sus propiedades únicas.',
            'link_url' => '#',
        ],
        [
            'bg'       => 'linear-gradient(160deg, #4A3020 0%, #1A0800 100%)',
            'img'      => '',
            'label'    => 'Usos tradicionales',
            'title'    => 'Cera de Abeja',
            'desc'     => 'Elaborada con la pureza que ofrece la naturaleza, sin aditivos ni procesos artificiales.',
            'link_url' => '#',
        ],
    ];
}

$total = count($cards);
?>
<section class="section_layout_1" id="cosecha">
    <div class="section_width_layout_1">

        <h2 class="layout_1_titulo"><?php echo esc_html($titulo); ?></h2>

        <div class="layout_1_grid">
            <?php foreach ($cards as $i => $card) :
                $bg         = !empty($card['bg']) ? $card['bg'] : 'linear-gradient(160deg, #8D4B00 0%, #271500 100%)';
                $img        = !empty($card['img']) ? $card['img'] : '';
                $label      = isset($card['label']) ? $card['label'] : '';
                $title      = isset($card['title']) ? $card['title'] : '';
                $desc       = isset($card['desc'])  ? $card['desc']  : '';
                $link_url   = !empty($card['link_url']) ? $card['link_url'] : '#';

                $is_solo    = ($i === $total - 1) && ($total % 2 !== 0);
                $card_class = 'layout_1_card false_link' . ($is_solo ? ' is-solo' : '');
            ?>
            <div class="<?php echo esc_attr($card_class); ?>"
                 data-link="h3"
                 data-parent="0"
                 style="background-image: <?php echo $bg; ?>">

                <figure class="layout_1_card_figure">
                    <?php if ($img) : ?>
                    <img src="<?php echo esc_url($img); ?>"
                         alt="<?php echo esc_attr($title); ?>"
                         loading="lazy"
                         decoding="async">
                    <?php endif; ?>
                </figure>

                <div class="layout_1_card_info">

                    <?php if ($label) : ?>
                    <span class="layout_1_card_label"><?php echo esc_html($label); ?></span>
                    <?php endif; ?>

                    <?php if ($title) : ?>
                    <h3 class="layout_1_card_title">
                        <a href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($title); ?></a>
                    </h3>
                    <?php endif; ?>

                    <?php if ($desc) : ?>
                    <p class="layout_1_card_desc"><?php echo esc_html($desc); ?></p>
                    <?php endif; ?>

                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
