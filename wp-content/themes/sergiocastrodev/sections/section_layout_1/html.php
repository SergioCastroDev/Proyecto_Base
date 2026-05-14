<?php
$titulo = 'Nuestra Cosecha Principal';

$cards = [
    [
        'bg'        => 'linear-gradient(160deg, #8D4B00 0%, #271500 100%)',
        'label'     => 'El alma de la colmena',
        'title'     => 'Miel Artesanal',
        'desc'      => 'Métodos de cosecha de bajo impacto que preservan el ecosistema y la calidad natural.',
        'link_url'  => '',
        'link_text' => '',
    ],
    [
        'bg'        => 'linear-gradient(160deg, #C8920A 0%, #7A4800 100%)',
        'label'     => 'Polinización silvestre',
        'title'     => 'Polen de Abeja',
        'desc'      => '',
        'link_url'  => '',
        'link_text' => '',
    ],
    [
        'bg'        => 'linear-gradient(160deg, #6B6040 0%, #3D2B1A 100%)',
        'label'     => 'Vitalidad Real',
        'title'     => 'Jalea Real',
        'desc'      => '',
        'link_url'  => '',
        'link_text' => '',
    ],
    [
        'bg'        => 'linear-gradient(160deg, #4A3020 0%, #1A0800 100%)',
        'label'     => 'Usos tradicionales',
        'title'     => 'Cera de Abeja',
        'desc'      => 'Elaborada con la pureza que ofrece la naturaleza, sin aditivos ni procesos artificiales.',
        'link_url'  => '',
        'link_text' => '',
    ],
];

$total = count($cards);
?>
<section class="section_layout_1" id="cosecha">
    <div class="section_width_layout_1">

        <h2 class="layout_1_titulo"><?php echo esc_html($titulo); ?></h2>

        <div class="layout_1_grid">
            <?php foreach ($cards as $i => $card) :
                $is_solo   = ($i === $total - 1) && ($total % 2 !== 0);
                $card_class = 'layout_1_card' . ($is_solo ? ' is-solo' : '');
            ?>
            <div class="<?php echo esc_attr($card_class); ?>" style="background-image: <?php echo $card['bg']; ?>">
                <div class="layout_1_card_overlay"></div>
                <div class="layout_1_card_content">

                    <?php if ($card['label']) : ?>
                    <span class="layout_1_card_label"><?php echo esc_html($card['label']); ?></span>
                    <?php endif; ?>

                    <h3 class="layout_1_card_title"><?php echo esc_html($card['title']); ?></h3>

                    <?php if ($card['desc']) : ?>
                    <p class="layout_1_card_desc"><?php echo esc_html($card['desc']); ?></p>
                    <?php endif; ?>

                    <?php if ($card['link_url']) : ?>
                    <a class="layout_1_card_link"
                       href="<?php echo esc_url($card['link_url']); ?>"
                       target="_blank" rel="noopener noreferrer">
                        <?php echo esc_html($card['link_text'] ?: 'Descubrir'); ?>
                    </a>
                    <?php endif; ?>

                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
