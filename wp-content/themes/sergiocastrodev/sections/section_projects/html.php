<?php
$post_id     = get_the_ID();
$prefix      = 'section_projects_';
$caption     = get_post_meta($post_id, $prefix . 'caption', true);
$titulo      = get_post_meta($post_id, $prefix . 'titulo', true);
$descripcion = get_post_meta($post_id, $prefix . 'descripcion', true);
$items       = get_post_meta($post_id, $prefix . 'items', true);

function scd_is_youtube($url) {
    return strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false;
}

function scd_youtube_embed($url) {
    $id = '';
    if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $url, $m)) {
        $id = $m[1];
    } elseif (preg_match('/youtu\.be\/([^?]+)/', $url, $m)) {
        $id = $m[1];
    } elseif (preg_match('/youtube\.com\/embed\/([^?]+)/', $url, $m)) {
        $id = $m[1];
    }
    if (!$id) return esc_url($url);
    return 'https://www.youtube.com/embed/' . esc_attr($id) . '?autoplay=1&loop=1&mute=1&playlist=' . esc_attr($id) . '&controls=0&playsinline=1&modestbranding=1&rel=0&iv_load_policy=3';
}
?>
<section class="section_sergio_projects" id="projects">
    <section class="section_width_sergio_projects">
        <section class="sergio_info">
            <div>
                <?php if ($caption): ?>
                    <p class="sergio_caption"><?php echo esc_html($caption); ?></p>
                <?php endif; ?>
                <?php if ($titulo): ?>
                    <h2><?php echo wp_kses_post($titulo); ?></h2>
                <?php endif; ?>
            </div>
            <?php if ($descripcion): ?>
                <p><?php echo wp_kses_post($descripcion); ?></p>
            <?php endif; ?>
        </section>
        <div class="sergio_grid">
            <?php if (is_array($items) && !empty($items)): ?>
                <?php foreach ($items as $index => $item): ?>
                    <?php
                    $nombre      = isset($item['nombre'])      ? $item['nombre']      : '';
                    $desc        = isset($item['descripcion']) ? $item['descripcion'] : '';
                    $url         = isset($item['url'])         ? $item['url']         : '';
                    $imagen      = isset($item['imagen'])      ? $item['imagen']      : '';
                    $video       = isset($item['video'])       ? $item['video']       : '';
                    $class_num   = $index + 1;
                    ?>
                    <article class="project<?php echo $class_num; ?>">
                        <figure>
                            <?php if ($imagen): ?>
                                <img src="<?php echo esc_url($imagen); ?>" alt="<?php echo esc_attr($nombre); ?>" loading="lazy">
                            <?php endif; ?>
                            <?php if ($video): ?>
                                <?php if (scd_is_youtube($video)): ?>
                                    <iframe
                                        src="<?php echo scd_youtube_embed($video); ?>"
                                        frameborder="0"
                                        allow="autoplay; loop; muted; clipboard-write; encrypted-media; picture-in-picture"
                                        allowfullscreen
                                        playsinline
                                    ></iframe>
                                <?php else: ?>
                                    <video src="<?php echo esc_url($video); ?>" autoplay loop muted playsinline></video>
                                <?php endif; ?>
                            <?php endif; ?>
                        </figure>
                        <div>
                            <?php if ($url): ?>
                                <a href="<?php echo esc_url($url); ?>" target="_blank">
                            <?php endif; ?>
                            <h3><?php echo esc_html($nombre); ?></h3>
                            <p><?php echo esc_html($desc); ?></p>
                            <svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.75 6.56699C0.510854 6.70506 0.428916 7.01085 0.566987 7.25C0.705059 7.48915 1.01085 7.57108 1.25 7.43301L0.75 6.56699ZM10.1432 2.12941C10.2147 1.86268 10.0564 1.58851 9.78966 1.51704L5.443 0.352352C5.17626 0.28088 4.9021 0.439172 4.83062 0.705905C4.75915 0.972638 4.91745 1.24681 5.18418 1.31828L9.04788 2.35355L8.01261 6.21726C7.94113 6.48399 8.09943 6.75816 8.36616 6.82963C8.63289 6.9011 8.90706 6.74281 8.97853 6.47608L10.1432 2.12941ZM1 7L1.25 7.43301L9.91025 2.43301L9.66025 2L9.41025 1.56699L0.75 6.56699L1 7Z" fill="#fff"/></svg>
                            <?php if ($url): ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</section>
