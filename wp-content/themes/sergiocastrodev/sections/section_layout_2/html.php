<?php
$post_id = get_the_ID();
$prefix  = 'section_layout_2_';

$caption = get_post_meta($post_id, $prefix . 'caption', true) ?: 'Tradición & Técnica';
$titulo  = get_post_meta($post_id, $prefix . 'titulo',  true) ?: 'Nuestro Proceso Artesanal';
$steps   = get_post_meta($post_id, $prefix . 'steps',   true);

if (empty($steps) || !is_array($steps)) {
    $steps = [
        [
            'img'   => '',
            'title' => 'Cuidado de las Colmenas',
            'desc'  => 'Mantenemos un entorno natural y libre de pesticidas para que nuestras abejas prosperen en armonía. La salud del ecosistema es la base de la pureza de nuestros productos.',
        ],
        [
            'img'   => '',
            'title' => 'Recolección Consciente',
            'desc'  => 'Cosechamos a mano, respetando los tiempos de la naturaleza y dejando siempre suficiente alimento para la colmena. Nuestra prioridad es el bienestar de las abejas por encima del rendimiento industrial.',
        ],
        [
            'img'   => '',
            'title' => 'Extracción en Frío',
            'desc'  => 'Utilizamos técnicas de extracción mecánica en frío para preservar el aroma y el sabor original de la miel. Un proceso que garantiza que cada gota mantenga sus propiedades nutricionales intactas.',
        ],
    ];
}
?>
<section class="section_layout_2" id="proceso">

    <div class="layout_2_progress" aria-hidden="true">
        <svg class="layout_2_progress_svg" viewBox="0 0 2 100" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <line class="layout_2_progress_track" x1="1" y1="0" x2="1" y2="100" />
            <line class="layout_2_progress_fill"  x1="1" y1="0" x2="1" y2="100" />
        </svg>
        <span class="layout_2_progress_marker"></span>
    </div>

    <div class="section_width_layout_2">

        <div class="layout_2_header">
            <?php if ($caption) : ?>
            <span class="layout_2_caption"><?php echo esc_html($caption); ?></span>
            <?php endif; ?>
            <h2 class="layout_2_titulo"><?php echo esc_html($titulo); ?></h2>
        </div>

        <div class="layout_2_steps">
            <?php foreach ($steps as $i => $step) :
                $n     = str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT);
                $img   = isset($step['img'])   ? $step['img']   : '';
                $title = isset($step['title']) ? $step['title'] : '';
                $desc  = isset($step['desc'])  ? $step['desc']  : '';
            ?>
            <article class="layout_2_step">

                <div class="layout_2_step_visual">
                    <figure class="layout_2_step_figure">
                        <?php if ($img) : ?>
                        <img src="<?php echo esc_url($img); ?>"
                             alt="<?php echo esc_attr($title); ?>"
                             width="320"
                             height="320"
                             loading="lazy"
                             decoding="async">
                        <?php endif; ?>
                    </figure>
                    <span class="layout_2_step_number" aria-hidden="true"><?php echo $n; ?></span>
                </div>

                <div class="layout_2_step_content">
                    <?php if ($title) : ?>
                    <h3 class="layout_2_step_title"><?php echo esc_html($title); ?></h3>
                    <?php endif; ?>
                    <?php if ($desc) : ?>
                    <p class="layout_2_step_desc"><?php echo esc_html($desc); ?></p>
                    <?php endif; ?>
                </div>

            </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>
