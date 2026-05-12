# Plan: Implementación de Metaboxes CMB2 en todos los bloques del tema

## Contexto

El tema WordPress `sergiocastrodev` usa un sistema de secciones/bloques propios ubicados en `wp-content/themes/sergiocastrodev/sections/`. Cada bloque tiene su `html.php`, `metabox.php`, `js/script.js` y `scss/`. Solo `section_main` tiene el sistema de metaboxes implementado con CMB2. El resto tiene contenido estático hardcodeado que no puede editarse desde el panel de WordPress. El objetivo es replicar el patrón de `section_main` en todos los bloques restantes.

---

## Cómo funciona el sistema (patrón actual)

### 1. Registro del metabox (`metabox.php`)

Cada sección define sus campos con CMB2 mediante un hook `cmb2_admin_init`. El metabox solo aparece en páginas que usen el template correcto (`page-home.php`).

```php
add_action('cmb2_admin_init', 'section_[nombre]_register_metabox');
function section_[nombre]_register_metabox() {
    $prefix = 'section_[nombre]_';
    $cmb = new_cmb2_box([
        'id'           => $prefix . 'metabox',
        'title'        => __('Bloque Section [Nombre]', 'cmb2'),
        'object_types' => ['page'],
        'show_on'      => ['key' => 'page-template', 'value' => 'page-home.php'],
        'closed'       => true,
    ]);
    $cmb->add_field(['name' => 'Campo', 'id' => $prefix . 'campo', 'type' => 'text']);
}
```

### 2. Carga automática

`inc/metabox-loader.php` escanea todas las carpetas de `sections/` y hace `require_once` de cualquier `metabox.php` que encuentre. No hay nada que configurar manualmente: basta con crear el archivo `metabox.php` dentro de la carpeta del bloque.

### 3. Lectura de datos en HTML (`html.php`)

```php
$post_id = get_the_ID();
$prefix  = 'section_[nombre]_';
$valor   = get_post_meta($post_id, $prefix . 'campo', true);
```

Para grupos de campos (no repetibles):
```php
$group = get_post_meta($post_id, $prefix . 'imagenes_group', true);
$img   = $group[0]['img_desktop'] ?? '';
```

Para grupos repetibles (listas dinámicas):
```php
$items = get_post_meta($post_id, $prefix . 'items', true);
if (!empty($items)) {
    foreach ($items as $item) {
        $nombre = $item['nombre'] ?? '';
        $icono  = $item['icono']  ?? '';
    }
}
```

### 4. Tipos de campo CMB2 disponibles

| Tipo CMB2            | Uso                           |
|----------------------|-------------------------------|
| `text`               | Texto corto, URLs             |
| `text_url`           | URL con validación            |
| `textarea`           | Texto largo (multilinea)      |
| `textarea_small`     | Descripción corta             |
| `file`               | Imagen con media uploader     |
| `wysiwyg`            | Editor visual completo        |
| `group`              | Agrupar campos relacionados   |
| `group` (repeatable) | Lista de ítems dinámica       |

---

## Bloques sin metabox — campos a implementar

### `section_about_me`

**Archivo:** `sections/section_about_me/html.php`

| Campo ID                                    | Tipo CMB2   | Etiqueta                         |
|---------------------------------------------|-------------|----------------------------------|
| `section_about_me_caption`                  | `text`      | Caption                          |
| `section_about_me_titulo`                   | `text`      | Título                           |
| `section_about_me_descripcion`              | `textarea`  | Descripción                      |
| `section_about_me_cta_texto`                | `text`      | Texto del CTA                    |
| `section_about_me_cta_url`                  | `text_url`  | URL del CTA                      |
| `section_about_me_iframe_url`               | `text_url`  | URL del iframe                   |
| Grupo `section_about_me_imagenes_group` (no repetible):                               |||
| → `img_desktop`                             | `file`      | Imagen Desktop                   |
| → `img_tablet`                              | `file`      | Imagen Tablet                    |
| → `img_mobile`                              | `file`      | Imagen Mobile                    |

---

### `section_tools`

**Archivo:** `sections/section_tools/html.php`

| Campo ID                                    | Tipo CMB2   | Etiqueta                         |
|---------------------------------------------|-------------|----------------------------------|
| `section_tools_caption`                     | `text`      | Caption                          |
| `section_tools_titulo`                      | `text`      | Título                           |
| Grupo `section_tools_items` (repetible):                                              |||
| → `nombre`                                  | `text`      | Nombre de la herramienta         |
| → `icono`                                   | `file`      | Icono (SVG/PNG)                  |

El `html.php` deberá iterar sobre el grupo repetible para renderizar cada slide del Splide.

---

### `section_projects`

**Archivo:** `sections/section_projects/html.php`

| Campo ID                                    | Tipo CMB2        | Etiqueta                    |
|---------------------------------------------|------------------|-----------------------------|
| `section_projects_caption`                  | `text`           | Caption                     |
| `section_projects_titulo`                   | `text`           | Título                      |
| `section_projects_descripcion`              | `textarea_small` | Descripción general         |
| Grupo `section_projects_items` (repetible):                                           |||
| → `nombre`                                  | `text`           | Nombre del proyecto         |
| → `descripcion`                             | `textarea_small` | Descripción                 |
| → `url`                                     | `text_url`       | URL del proyecto            |
| → `imagen`                                  | `file`           | Imagen del proyecto         |
| → `video`                                   | `file`           | Video (opcional)            |

El `html.php` iterará sobre los proyectos y renderizará cada `<article>` dinámicamente (reemplaza los 12 artículos hardcodeados actuales).

---

### `section_clients`

**Archivo:** `sections/section_clients/html.php`

| Campo ID                                    | Tipo CMB2   | Etiqueta                         |
|---------------------------------------------|-------------|----------------------------------|
| `section_clients_caption`                   | `text`      | Caption                          |
| `section_clients_titulo`                    | `text`      | Título                           |
| Grupo `section_clients_items` (repetible):                                            |||
| → `logo`                                    | `file`      | Logo del cliente                 |
| → `nombre`                                  | `text`      | Nombre del cliente (atributo alt)|
| → `url`                                     | `text_url`  | URL del cliente (opcional)       |

---

### `section_form`

**Archivo:** `sections/section_form/html.php`

| Campo ID                                    | Tipo CMB2   | Etiqueta                         |
|---------------------------------------------|-------------|----------------------------------|
| `section_form_caption`                      | `text`      | Caption                          |
| `section_form_titulo`                       | `text`      | Título                           |
| `section_form_shortcode`                    | `text`      | Shortcode de CF7                 |
| Grupo `section_form_imagenes_group` (no repetible):                                   |||
| → `img_desktop`                             | `file`      | Imagen Desktop                   |
| → `img_tablet`                              | `file`      | Imagen Tablet                    |
| → `img_mobile`                              | `file`      | Imagen Mobile                    |

---

### `section_wysiwyg`

**Archivo:** `sections/section_wysiwyg/html.php`

| Campo ID                                    | Tipo CMB2   | Etiqueta                         |
|---------------------------------------------|-------------|----------------------------------|
| `section_wysiwyg_titulo`                    | `text`      | Título de la página              |
| `section_wysiwyg_contenido`                 | `wysiwyg`   | Contenido principal              |

---

### `section_backtop` y `section_base`

No requieren metabox. `section_backtop` es un botón flotante con SVG fijo; `section_base` es un contenedor vacío de andamiaje. Ambos se omiten.

---

## Archivos a crear / modificar

| Archivo                                              | Acción    |
|------------------------------------------------------|-----------|
| `sections/section_about_me/metabox.php`              | CREAR     |
| `sections/section_about_me/html.php`                 | MODIFICAR |
| `sections/section_tools/metabox.php`                 | CREAR     |
| `sections/section_tools/html.php`                    | MODIFICAR |
| `sections/section_projects/metabox.php`              | CREAR     |
| `sections/section_projects/html.php`                 | MODIFICAR |
| `sections/section_clients/metabox.php`               | CREAR     |
| `sections/section_clients/html.php`                  | MODIFICAR |
| `sections/section_form/metabox.php`                  | CREAR     |
| `sections/section_form/html.php`                     | MODIFICAR |
| `sections/section_wysiwyg/metabox.php`               | CREAR     |
| `sections/section_wysiwyg/html.php`                  | MODIFICAR |

**Archivos que NO se tocan:**
- `inc/metabox-loader.php` — carga automáticamente cualquier `metabox.php` nuevo.
- `page-home.php` — no requiere cambios.

---

## Menú del Header — Integración con WordPress

### Problema actual

El `<nav>` dentro de `.container_menu` en `content-header.php` tiene los ítems hardcodeados como HTML estático. No puede editarse desde el panel de WordPress.

### Solución

**1. Registrar la ubicación del menú** en `functions.php`:

```php
add_action('after_setup_theme', 'sergiocastrodev_register_menus');
function sergiocastrodev_register_menus() {
    register_nav_menus([
        'header_menu' => __('Menú Header', 'sergiocastrodev'),
    ]);
}
```

**2. Reemplazar el `<nav>` hardcodeado** en `templates/header/content-header.php`:

```php
<section class="container_menu">
    <nav>
        <?php wp_nav_menu([
            'theme_location' => 'header_menu',
            'container'      => false,
            'items_wrap'     => '<ul>%3$s</ul>',
            'fallback_cb'    => false,
        ]); ?>
    </nav>
</section>
```

Desde **Apariencia → Menús** el usuario podrá crear un menú, asignarlo a "Menú Header" y gestionar sus ítems sin tocar código.

---

## Página de Ajustes "Globales" — Sistema escalable por proyecto

### Problema actual

El logo del header y todos los datos del footer (CTA, redes sociales, email, copyright) están hardcodeados en sus respectivos templates. En proyectos distintos el header y footer serán diferentes, por lo que los campos editables también cambiarán.

### Arquitectura — auto-carga por `globals.php`

El sistema replica el patrón de `metabox-loader.php` pero para opciones globales del tema. Cada template (header y footer) declara sus propios campos mediante un archivo `globals.php` en su carpeta. El loader crea la página de admin y carga los campos que cada template defina.

```
templates/
├── header/
│   ├── content-header.php
│   └── globals.php        ← NUEVO: declara campos del header para la página Globales
└── footer/
    ├── content-footer.php
    └── globals.php        ← NUEVO: declara campos del footer para la página Globales
inc/
└── globals-loader.php     ← NUEVO: crea la options page y carga los globals.php
```

### `inc/globals-loader.php` (nuevo archivo)

```php
<?php
add_action('cmb2_admin_init', 'sergiocastrodev_register_globals_page');
function sergiocastrodev_register_globals_page() {
    $cmb = new_cmb2_box([
        'id'           => 'globals_options',
        'title'        => 'Globales',
        'object_types' => ['options-page'],
        'option_key'   => 'globals_options',
        'parent_slug'  => 'options-general.php',
        'capability'   => 'manage_options',
    ]);

    $base = get_template_directory() . '/templates/';
    foreach (['header', 'footer'] as $part) {
        $globals_file = $base . $part . '/globals.php';
        if (file_exists($globals_file)) {
            require $globals_file; // $cmb queda en scope dentro del include
        }
    }
}
```

Se registra bajo **Ajustes → Globales**. Escanea `templates/header/globals.php` y `templates/footer/globals.php` e incluye los que existan. Como `require` comparte el scope local, `$cmb` está disponible dentro de cada archivo para añadir campos.

### `templates/header/globals.php` (nuevo archivo)

```php
<?php
// $cmb disponible desde globals-loader.php
$cmb->add_field(['name' => 'Header',         'id' => 'globals_header_sep', 'type' => 'title']);
$cmb->add_field(['name' => 'Logo',           'id' => 'header_logo',        'type' => 'file']);
$cmb->add_field(['name' => 'URL del Logo',   'id' => 'header_logo_url',    'type' => 'text_url']);
```

### `templates/footer/globals.php` (nuevo archivo)

```php
<?php
// $cmb disponible desde globals-loader.php
$cmb->add_field(['name' => 'Footer',             'id' => 'globals_footer_sep',  'type' => 'title']);
$cmb->add_field(['name' => 'Texto CTA',          'id' => 'footer_cta_texto',    'type' => 'text']);
$cmb->add_field(['name' => 'URL CTA',            'id' => 'footer_cta_url',      'type' => 'text_url']);
$cmb->add_field(['name' => 'URL LinkedIn',        'id' => 'footer_linkedin_url', 'type' => 'text_url']);
$cmb->add_field(['name' => 'URL YouTube',         'id' => 'footer_youtube_url',  'type' => 'text_url']);
$cmb->add_field(['name' => 'Email de contacto',  'id' => 'footer_email',        'type' => 'text']);
$cmb->add_field(['name' => 'URL sitio (logo)',    'id' => 'footer_site_url',     'type' => 'text_url']);
$cmb->add_field(['name' => 'Texto copyright',    'id' => 'footer_copyright',    'type' => 'text']);
```

### Lectura de valores en los templates

```php
// content-header.php / content-footer.php
$logo     = cmb2_get_option('globals_options', 'header_logo');
$logo_url = cmb2_get_option('globals_options', 'header_logo_url');
```

### Campos del header actual

| Campo ID           | Tipo CMB2   | Valor actual hardcodeado         |
|--------------------|-------------|----------------------------------|
| `header_logo`      | `file`      | Logo PNG via media uploader      |
| `header_logo_url`  | `text_url`  | "https://sergiocastro.dev/"      |

### Campos del footer actual

| Campo ID               | Tipo CMB2   | Valor actual hardcodeado                                  |
|------------------------|-------------|-----------------------------------------------------------|
| `footer_cta_texto`     | `text`      | "¿Listo para crecer juntos?"                              |
| `footer_cta_url`       | `text_url`  | "#contact"                                                |
| `footer_linkedin_url`  | `text_url`  | "https://www.linkedin.com/in/sergiocastrodev"             |
| `footer_youtube_url`   | `text_url`  | "https://youtube.com/@spacefilms-media?si=..."            |
| `footer_email`         | `text`      | "info@sergiocastro.dev"                                   |
| `footer_site_url`      | `text_url`  | "https://sergiocastro.dev/"                               |
| `footer_copyright`     | `text`      | "Sergio Castro Web \| [año] Todos los derechos reservados"|

### Escalabilidad en nuevos proyectos

Cuando se cambie el header o footer por uno diferente:
1. Sustituir `content-header.php` / `content-footer.php` por los nuevos templates.
2. Escribir un `globals.php` nuevo en la misma carpeta declarando los campos del nuevo template.
3. La página "Globales" mostrará automáticamente solo los campos de ese template. No hay que tocar `globals-loader.php` ni `functions.php`.

---

## Archivos a crear / modificar (completo)

| Archivo                                              | Acción    |
|------------------------------------------------------|-----------|
| `functions.php`                                      | MODIFICAR — añadir `register_nav_menus` |
| `inc/globals-loader.php`                             | CREAR     |
| `templates/header/globals.php`                       | CREAR     |
| `templates/header/content-header.php`                | MODIFICAR — menú dinámico + logo dinámico |
| `templates/footer/globals.php`                       | CREAR     |
| `templates/footer/content-footer.php`                | MODIFICAR — todos los campos dinámicos |
| `sections/section_about_me/metabox.php`              | CREAR     |
| `sections/section_about_me/html.php`                 | MODIFICAR |
| `sections/section_tools/metabox.php`                 | CREAR     |
| `sections/section_tools/html.php`                    | MODIFICAR |
| `sections/section_projects/metabox.php`              | CREAR     |
| `sections/section_projects/html.php`                 | MODIFICAR |
| `sections/section_clients/metabox.php`               | CREAR     |
| `sections/section_clients/html.php`                  | MODIFICAR |
| `sections/section_form/metabox.php`                  | CREAR     |
| `sections/section_form/html.php`                     | MODIFICAR |
| `sections/section_wysiwyg/metabox.php`               | CREAR     |
| `sections/section_wysiwyg/html.php`                  | MODIFICAR |

**Archivos que NO se tocan:**
- `inc/metabox-loader.php` — ya funciona correctamente.
- `page-home.php` — no requiere cambios.

---

## Orden de implementación recomendado

1. `functions.php` — registrar `register_nav_menus` + `require globals-loader.php`.
2. `inc/globals-loader.php` + `templates/header/globals.php` + `templates/footer/globals.php` — crear sistema Globales.
3. `templates/header/content-header.php` — menú dinámico + logo dinámico.
4. `templates/footer/content-footer.php` — todos los campos dinámicos.
5. `section_about_me` — ya tiene CTA parcialmente wired; el más parecido a `section_main`.
6. `section_clients` — patrón simple de lista repetible con logos.
7. `section_tools` — similar a clients, con íconos SVG.
8. `section_projects` — el más complejo (12 ítems, video opcional).
9. `section_form` — shortcode + imágenes responsive.
10. `section_wysiwyg` — el más simple: título + editor wysiwyg.

---

## Verificación

1. **Menú**: Ir a Apariencia → Menús, crear un menú con ítems, asignarlo a "Menú Header". Verificar que aparece correctamente en el front.
2. **Globales**: Ir a Ajustes → Globales. Confirmar que aparecen las secciones "Header" y "Footer" con sus campos.
3. Rellenar logo, URL, CTA del footer, redes, email y guardar. Verificar en el front que reemplazaron los valores hardcodeados.
4. **Metaboxes de bloques**: Abrir la página "Home" en el editor. Confirmar que aparece un metabox por sección.
5. Rellenar campos y verificar renderizado en el front.
6. Para secciones con grupos repetibles (tools, projects, clients): agregar y quitar ítems y verificar que el HTML se actualiza.
