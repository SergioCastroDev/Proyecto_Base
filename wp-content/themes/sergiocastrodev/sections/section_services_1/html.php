<?php
$post_id         = get_the_ID();
$prefix          = 'section_services_1_';

$headline_accent = get_post_meta($post_id, $prefix . 'headline_accent', true);
$headline        = get_post_meta($post_id, $prefix . 'headline',        true);
$quote           = get_post_meta($post_id, $prefix . 'quote',           true);
$cards           = get_post_meta($post_id, $prefix . 'cards',           true);

// Fallbacks estáticos para previsualización sin datos en el admin
if (empty($headline_accent)) $headline_accent = '120 hectáreas';
if (empty($headline))        $headline        = 'de colmenas prístinas dedicadas a la apicultura sostenible.';
if (empty($quote))           $quote           = '"No solo cosechamos miel, cuidamos la tierra que lo provee. Mieles Entre Montes es un testimonio de lo armónico entre la naturaleza y el oficio."';

$default_cards = [
    [
        'icon_svg'  => '<svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M20 4C20 4 10 10 10 20C10 25.5 14.5 30 20 30C25.5 30 30 25.5 30 20C30 10 20 4 20 4Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M20 30V36" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M20 18C20 18 15 21 15 25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
        'title'     => 'Sostenible',
        'desc'      => 'Métodos de cosecha de bajo impacto que preservan el ecosistema.',
        'link_url'  => '',
        'link_text' => '',
    ],
    [
        'icon_svg'  => '<svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><circle cx="20" cy="20" r="7" stroke="currentColor" stroke-width="1.8"/><path d="M20 4V8M20 32V36M4 20H8M32 20H36" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M8.7 8.7L11.5 11.5M28.5 28.5L31.3 31.3M8.7 31.3L11.5 28.5M28.5 11.5L31.3 8.7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
        'title'     => 'Nativo',
        'desc'      => 'Enriquece la biodiversidad floral de la región mediterránea.',
        'link_url'  => '',
        'link_text' => '',
    ],
    [
        'icon_svg'  => '<svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M20 8C20 8 12 16 12 23C12 27.4 15.6 31 20 31C24.4 31 28 27.4 28 23C28 16 20 8 20 8Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M16 24C17.5 26 22.5 26 24 24" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
        'title'     => 'Puro',
        'desc'      => 'Sin aditivos, sin ceras artificiales. 100% puro y natural.',
        'link_url'  => '',
        'link_text' => '',
    ],
    [
        'icon_svg'  => '<svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><circle cx="20" cy="20" r="14" stroke="currentColor" stroke-width="1.8"/><path d="M6 20H34M20 6C20 6 14 12 14 20C14 28 20 34 20 34C20 34 26 28 26 20C26 12 20 6 20 6Z" stroke="currentColor" stroke-width="1.5"/></svg>',
        'title'     => 'Global',
        'desc'      => 'Exporta a 24 países, llevando el sabor de los montes al mundo.',
        'link_url'  => '',
        'link_text' => '',
    ],
];

if (empty($cards) || !is_array($cards)) {
    $cards = $default_cards;
}
?>
<section class="section_services_1" id="servicios">
    <div class="section_width_services_1">

        <!-- Top: headline + quote -->
        <div class="services_1_top">
            <h2 class="services_1_headline">
                <span class="services_1_headline_accent"><?php echo wp_kses_post($headline_accent); ?></span>
                <?php echo wp_kses_post($headline); ?>
            </h2>
            <p class="services_1_quote"><?php echo wp_kses_post($quote); ?></p>
        </div>

        <!-- Cards -->
        <div class="services_1_slider splide">
            <div class="splide__track">
                <ul class="splide__list">

                    <?php foreach ($cards as $card) :
                        $icon      = isset($card['icon_svg'])  ? $card['icon_svg']  : '';
                        $title     = isset($card['title'])     ? $card['title']     : '';
                        $desc      = isset($card['desc'])      ? $card['desc']      : '';
                        $link_url  = isset($card['link_url'])  ? $card['link_url']  : '';
                        $link_text = isset($card['link_text']) ? $card['link_text'] : '';

                        if (empty($title) && empty($desc)) continue;
                    ?>
                    <li class="splide__slide">
                        <div class="services_1_card">

                            <?php if ($icon) : ?>
                            <div class="services_1_card_icon">
                                <?php echo $icon; // SVG sanitizado como false en CMB2 — trusted admin input ?>
                            </div>
                            <?php endif; ?>

                            <h3 class="services_1_card_title"><?php echo esc_html($title); ?></h3>

                            <div class="services_1_card_divider"></div>

                            <p class="services_1_card_desc"><?php echo wp_kses_post($desc); ?></p>

                            <?php if ($link_url) : ?>
                            <a class="services_1_card_link"
                               href="<?php echo esc_url($link_url); ?>"
                               target="_blank" rel="noopener noreferrer">
                                <?php echo esc_html($link_text ?: 'Ver más'); ?>
                            </a>
                            <?php endif; ?>

                        </div>
                    </li>
                    <?php endforeach; ?>

                </ul>
            </div>
        </div>

    </div>
</section>
