<?php
// Loader automático de metaboxes para todas las secciones
$sections_dir = get_template_directory() . '/sections/';
if (is_dir($sections_dir)) {
    $sections = scandir($sections_dir);
    foreach ($sections as $section) {
        if ($section === '.' || $section === '..') continue;
        $metabox_path = $sections_dir . $section . '/metabox.php';
        if (file_exists($metabox_path)) {
            require_once $metabox_path;
        }
    }
}
