<?php
/*
Template Name: Home
*/
get_header();
?>
<main style="overflow-x: clip; overflow-y: initial;">
    <?php
        include get_template_directory() . '/sections/section_main/html.php';
        include get_template_directory() . '/sections/section_about_me/html.php';
        include get_template_directory() . '/sections/section_tools/html.php';
        include get_template_directory() . '/sections/section_projects/html.php';
        include get_template_directory() . '/sections/section_clients/html.php';
        include get_template_directory() . '/sections/section_form/html.php';
        include get_template_directory() . '/sections/section_backtop/html.php';
    ?>
</main>
<?php
get_footer();
