# Workflow: Creación de Nuevos Bloques desde Diseño

## Contexto

El tema `sergiocastrodev` usa un sistema modular de bloques (secciones) en `/sections/`. Cada bloque es autónomo: `html.php`, `metabox.php`, SCSS y JS. Los bloques se cargan mediante loaders automáticos y se incluyen manualmente en los templates de página.

Este documento es el protocolo de trabajo para crear cualquier bloque nuevo a partir de un diseño (captura, Figma, URL o descripción).

---

## Convención de nombrado de bloques

Cada bloque nuevo recibe un ID con el formato `[categoría]_[número]`, donde el número es secuencial dentro de esa categoría.

Ejemplos: `hero_1`, `hero_2`, `layout_1`, `slider_3`, `contact_1`

**Categorías disponibles** (según el Catálogo de Bloques):

| Categoría | Uso |
|---|---|
| `hero` | Hero / banner principal |
| `layout` | Secciones de contenido, 2 columnas, about, grids |
| `slider` | Carruseles, sliders de herramientas o clientes |
| `form` | Formularios de contacto |
| `footer` | Pie de página |
| `nav` | Navegación / header |
| `cta` | Call to action, banners secundarios |
| `otro` | Bloques que no encajan en las anteriores |

**Cómo se aplica:**
- El ID del bloque (`hero_2`) se registra en el Catálogo: `C:\laragon\www\Listado de bloques\index.html`
- La carpeta del bloque en WordPress sigue el patrón: `sections/section_[categoría]_[número]` (ej: `sections/section_hero_2`)
- El prefijo CMB2 usa el mismo ID: `section_hero_2_titulo`, `section_hero_2_descripcion`
- La clase CSS raíz: `.section_sergio_hero_2`

**Catálogo de bloques:** `C:\laragon\www\Listado de bloques\index.html`
El catálogo genera automáticamente el ID (`hero_2`, `layout_3`, etc.) al seleccionar la categoría en el modal. El número se calcula contando los bloques existentes de esa categoría.

---

## Archivos clave de referencia

| Archivo | Rol |
|---|---|
| `sections/section_base/` | Plantilla vacía para copiar como punto de partida |
| `assets/scss/templates/sections-home.scss` | Importar el SCSS del nuevo bloque aquí |
| `scripts_sections.php` | Incluir el JS del nuevo bloque aquí |
| `page-home.php` | Template principal donde se incluyen los bloques |
| `assets/scss/_variables.scss` | Variables globales de color y tipografía |
| `assets/scss/_mixins.scss` | Mixins de flexbox y media queries |
| `inc/metabox-loader.php` | Carga automática de `metabox.php` de cada bloque |

---

## Estructura de archivos del nuevo bloque

```
sections/section_[nombre]/
├── html.php              ← Template PHP del bloque
├── metabox.php           ← Campos CMB2 editables en el admin
├── js/
│   └── script.js         ← JS / animaciones GSAP (si aplica)
└── scss/
    ├── _template.scss    ← Estilos del bloque
    ├── _variables.scss   ← Variables locales (vacío por defecto)
    └── _mixins.scss      ← Mixins locales (vacío por defecto)
```

---

## Flujo de trabajo al recibir un diseño nuevo

### FASE 1 — Entrevista obligatoria (AskUserQuestion)

Antes de escribir una línea de código, realizar la siguiente entrevista:

1. ¿Cuál es el nombre del bloque? → define prefijo CMB2 y clases CSS
2. ¿En qué página/template va? ¿Qué bloques existen ya y en qué posición quiere este nuevo?
3. ¿El bloque necesita imágenes? → determinar si necesita versiones Desktop/Tablet/Mobile
4. ¿El bloque tiene elementos repetibles? → definir si usar grupos CMB2 repetibles
5. ¿Necesita animaciones? → si sí, buscar best practices GSAP actualizadas
6. ¿Usa slider/carrusel? → usar Splide (ya integrado)
7. ¿Tiene formulario? → pedir shortcode CF7
8. ¿Tiene SVG inline? → usar `sanitization_cb => false, escape_cb => false`
9. ¿El bloque tiene anchor/id de navegación? → para el scroll del menú

### FASE 2 — Análisis del diseño

**Paso obligatorio antes de cualquier otro:** revisar la carpeta `new_block/` del tema (`wp-content/themes/sergiocastrodev/new_block/`). El usuario deja ahí la captura del diseño antes de pedir el bloque. Leer la imagen con el tool Read antes de escribir una sola línea de código.

Si la carpeta está vacía, preguntar explícitamente:
> "¿Has dejado la captura del diseño en la carpeta `new_block/`? Si no, pásame la URL del diseño (Figma, web) o una descripción detallada."

No construir ningún archivo hasta tener el diseño. El bloque debe reproducir fielmente la captura — colores, layout, tipografía, espaciados y comportamiento responsive.

Según el formato recibido:
- **Carpeta `new_block/`**: leer la imagen con Read tool antes de empezar
- **Captura**: Analizar layout, componentes, tipografías, colores, responsive
- **URL Figma**: Inspeccionar frames, componentes, variables de diseño
- **URL web**: Analizar DOM y estilos para replicar
- **Texto**: Crear interpretación visual basada en la descripción

Identificar:
- Estructura HTML (columnas, elementos, jerarquía)
- Campos editables necesarios (qué partes serán editables vía CMB2)
- Comportamiento responsive (cómo cambia el layout en cada breakpoint)
- Efectos hover, transiciones, animaciones

---

### FASE 3A — Front estático (primera entrega)

**Objetivo:** Construir el bloque con HTML/CSS/JS hardcodeado para validar visualmente el diseño antes de conectar el backend.

**Archivos a crear en esta fase:**
- `html.php` → contenido estático (textos, imágenes e URLs directamente en el código)
- `scss/_template.scss` → estilos completos y responsive
- `scss/_variables.scss` → variables propias del bloque (colores, tamaños específicos). Se importa en `_template.scss` con `@use "variables" as *;`. Nunca declarar variables directamente en `_template.scss`
- `scss/_mixins.scss` → vacío (hereda mixins globales)
- `js/script.js` → solo si se acordaron animaciones en la entrevista
- `img/` → carpeta para las imágenes de prueba de la fase estática (dentro de la carpeta del bloque)

**Integraciones en esta fase:**
- Importar SCSS en `assets/scss/templates/sections-home.scss`
- Incluir HTML en la página en la posición acordada (`page-home.php` u otro template)
- Incluir JS en `scripts_sections.php` (si aplica)

**No se crea `metabox.php` todavía.**

El usuario revisa el bloque en el navegador y da feedback. Se hacen las iteraciones necesarias hasta obtener la aprobación.

---

### FASE 3B — Back CMB2 (tras aprobación del front)

Solo cuando el usuario da el aprobado al bloque estático:

#### `metabox.php`

Patrón base:
```php
<?php
function section_[nombre]_register_metabox() {
    $cmb = new_cmb2_box([
        'id'           => 'section_[nombre]_metabox',
        'title'        => 'Section [Nombre]',
        'object_types' => ['page'],
        'show_on'      => ['key' => 'page-template', 'value' => 'page-[template].php'],
        'closed'       => true,
        'priority'     => 'low',
    ]);

    $prefix = 'section_[nombre]_';
    // Campos definidos en la entrevista...
}
add_action('cmb2_admin_init', 'section_[nombre]_register_metabox');
```

Tipos de campos disponibles:
- `text` / `textarea` / `textarea_small` — Textos
- `text_url` — URLs (usar `esc_url()` al mostrar)
- `file` — Imágenes (retorna URL)
- `group` con `repeatable: true` — Listas de elementos
- `group` con `repeatable: false` — Grupo de imágenes responsive
- `textarea` con `sanitization_cb: false, escape_cb: false` — SVG inline

Patrón para imágenes responsive:
```php
$group = $cmb->add_field([
    'id'         => $prefix . 'imagenes_group',
    'type'       => 'group',
    'repeatable' => false,
]);
$cmb->add_group_field($group, ['name' => 'Desktop', 'id' => 'img_desktop', 'type' => 'file']);
$cmb->add_group_field($group, ['name' => 'Tablet',  'id' => 'img_tablet',  'type' => 'file']);
$cmb->add_group_field($group, ['name' => 'Mobile',  'id' => 'img_mobile',  'type' => 'file']);
```

#### `html.php` — Migración de estático a dinámico

Reemplazar el contenido hardcodeado por llamadas a `get_post_meta()`:

```php
<?php
$post_id = get_the_ID();
$prefix  = 'section_[nombre]_';
$titulo  = get_post_meta($post_id, $prefix . 'titulo', true);

// Imágenes responsive
$imgs_data   = get_post_meta($post_id, $prefix . 'imagenes_group', true);
$img_desktop = $imgs_data[0]['img_desktop'] ?? '';
$img_tablet  = $imgs_data[0]['img_tablet']  ?? '';
$img_mobile  = $imgs_data[0]['img_mobile']  ?? $img_desktop;
?>

<section class="section_sergio_[nombre]" id="[nombre]">
    <div class="section_width_sergio_[nombre]">
        <?php if ($titulo): ?>
            <h2><?php echo wp_kses_post($titulo); ?></h2>
        <?php endif; ?>

        <?php if ($img_mobile): ?>
        <picture>
            <?php if ($img_desktop): ?>
                <source media="(min-width: 1024px)" srcset="<?php echo esc_url($img_desktop); ?>">
            <?php endif; ?>
            <?php if ($img_tablet): ?>
                <source media="(min-width: 768px)" srcset="<?php echo esc_url($img_tablet); ?>">
            <?php endif; ?>
            <img src="<?php echo esc_url($img_mobile); ?>"
                 alt="<?php echo esc_attr($titulo); ?>"
                 width="375" height="500"
                 loading="lazy"
                 decoding="async">
        </picture>
        <?php endif; ?>
    </div>
</section>
```

**Reglas WPO obligatorias en html.php:**
- `width` y `height` explícitos en `<img>` → evita CLS
- `loading="lazy"` en todas las imágenes excepto la LCP (primer bloque visible)
- `decoding="async"` en imágenes no críticas
- `<picture>` con `<source>` para breakpoints responsive
- Escapado siempre: `esc_url()`, `esc_html()`, `wp_kses_post()`

---

### FASE 4 — Integración completa

#### Importar SCSS (siempre, desde Fase 3A)
En `assets/scss/templates/sections-home.scss`:
```scss
@use "../../../sections/section_[nombre]/scss/template" as *;
```

#### Registrar HTML en la página (preguntar posición en la entrevista)
En `page-home.php` (u otro template) en la posición acordada:
```php
include get_template_directory() . '/sections/section_[nombre]/html.php';
```

#### Incluir JS (solo si hay script.js)
En `scripts_sections.php`:
```php
include get_template_directory() . '/sections/section_[nombre]/js/script.js';
```

#### Registrar en el Catálogo de Bloques (siempre, al finalizar el bloque)

Archivo: `C:\laragon\www\Listado de bloques\index.html`

Añadir una nueva tarjeta estática al final del `#grid`, justo antes del cierre `</div></section>`:

```html
<div class="card" data-cat="[categoría]" data-static="true">
  <img class="card-img" src="Capturas/[nombre_archivo].png" alt="" onerror="this.style.display='none'" />
  <div class="card-tint"></div><div class="card-gradient"></div>
  <div class="card-tag">[Categoría]</div>
  <div class="card-info">
    <div class="card-num">Bloque · [NN]</div>
    <div class="card-name">[Nombre del bloque]</div>
    <div class="card-meta">[Tipo] · [Características principales]</div>
  </div>
  <div class="card-arrow"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M7 17L17 7M17 7H7M17 7v10"/></svg></div>
</div>
```

- Los contadores (`stat-n` / `cnt`) se actualizan automáticamente por JS al cargar la página, no hace falta tocarlos.
- La imagen de captura se copia desde la carpeta `img/` del bloque (`sections/section_[nombre]/img/desktop.png`) a `C:\laragon\www\Listado de bloques\Capturas\` con un nombre descriptivo.
- Si aún no hay captura, el atributo `onerror="this.style.display='none'"` oculta el `<img>` sin romper la tarjeta.
- Un bloque puede pertenecer a **múltiples categorías** separando los valores con espacio en `data-cat`: `data-cat="services slider"`. El filtro del catálogo usa `.split(' ').includes(cat)` y funciona correctamente con múltiples valores.

---

## Patrones SCSS del bloque

### Estructura base
```scss
@use "../../../assets/scss/variables" as *;
@use "../../../assets/scss/mixins" as *;
@use "variables" as *; // variables propias del bloque

.section_[nombre] {
    padding: 80px 20px 40px; // siempre este padding — nunca cambiarlo

    .section_width_[nombre] {
        max-width: 1140px;
        margin: 0 auto;

        // Mobile-first: estilos base sin media query = mobile
        // @include tablet { ... }   → 768px+
        // @include desktop { ... }  → 1024px+
    }
}
```

**Convención de estructura obligatoria:**
- **Section padre** (`.section_[nombre]`): solo gestiona el padding del bloque. Padding fijo siempre: `80px 20px 40px` (top / lados / bottom). Esto garantiza el mismo espaciado entre todos los bloques de la página.
- **Section width** (`.section_width_[nombre]`): controla el ancho máximo del contenido (`max-width` + `margin: 0 auto`). Todo el layout interno va aquí.
- Nunca poner el `max-width` directamente en el section padre, ni cambiar el padding estándar.
- Excepción: bloques full-bleed (heroes con `min-height: 100svh` y fondo a pantalla completa) tienen su propio sistema de layout y no siguen este patrón de padding.

**Otras reglas obligatorias:**
- Mobile-first siempre
- Usar mixins del tema para media queries (nunca `@media` directo)
- Nomenclatura: `.section_[nombre]` → `.section_width_[nombre]` → elementos internos
- `aspect-ratio` en contenedores de imagen → evita CLS
- Transiciones: `transition: .3s` por defecto

### Responsive en layouts de dos columnas (hero / split)

Cuando el bloque tiene dos columnas en desktop (título + imagen/video), tener en cuenta:

- Las fuentes definidas para mobile (columna única, ancho completo) suelen ser demasiado grandes para la columna de texto en desktop. Sobreescribir con `@include desktop` usando valores proporcionales al ancho real de esa columna.
- `white-space: nowrap` solo es seguro si los tamaños de fuente están garantizados para caber en la columna disponible.
- Si el titular debe quedar visualmente por encima de un elemento de media grande, sacarlo del flujo flex con `position: absolute` en desktop para liberarlo de restricciones de columna.

### Elementos posicionados absolutamente

Los elementos con `position: absolute` dentro de un bloque deben estar dentro del **wrapper inner** (que tiene `position: relative`), no como hijos directos de la sección. Así el contexto de posicionamiento es el wrapper, que es más predecible.

---

## Librerías JS disponibles

Todas se cargan inline en `templates/footer/content-scripts.php` mediante `file_get_contents`. **No usar CDN ni `<script src>`** — siempre añadir el archivo a `assets/js/` y registrarlo en ese PHP.

| Librería | Archivo | Uso |
|---|---|---|
| GSAP core | `assets/js/GSAP/gsap.js` | Animaciones, timelines, easing |
| ScrollTrigger | `assets/js/GSAP/scroll-trigger.js` | Animaciones ligadas al scroll |
| SplitText | `assets/js/GSAP/split-text.js` | Dividir texto en chars/words para animar |
| Splide | `assets/js/splide.js` | Sliders/carruseles en mobile |

**Registrar siempre ScrollTrigger antes de usarlo:**
```javascript
gsap.registerPlugin(ScrollTrigger);
```

---

## Patrones JS / Animaciones GSAP

Solo si el usuario confirma animaciones en la entrevista.

### Regla general: GSAP vs CSS transforms

**Nunca mezclar** `transition: transform` en CSS con animaciones GSAP en el mismo elemento. Si GSAP va a animar `transform` de un elemento, quitar `transform` de su `transition` en CSS y dejar solo otras propiedades (`box-shadow`, `opacity`, etc.).

### Patrón base — entrada de sección con ScrollTrigger

```javascript
document.addEventListener('DOMContentLoaded', function () {
    animateSection[Nombre]();
});

function animateSection[Nombre]() {
    var section = document.querySelector('.section_[nombre]');
    if (!section) return;

    gsap.registerPlugin(ScrollTrigger);

    var headline = section.querySelector('.XXX_headline');
    var cards    = section.querySelectorAll('.XXX_card');

    gsap.set([headline], { opacity: 0, y: 30 });
    gsap.set(cards, { opacity: 0, y: 44 });

    ScrollTrigger.create({
        trigger: section,
        start:   'top 72%',
        once:    true,
        onEnter: function () {
            gsap.timeline({ defaults: { ease: 'power3.out' } })
                .to(headline, { opacity: 1, y: 0, duration: 0.8 })
                .to(cards,    { opacity: 1, y: 0, duration: 0.6, stagger: 0.12 }, '-=0.4');
        },
    });
}
```

**Siempre** envolver en `DOMContentLoaded`. El `once: true` en ScrollTrigger evita que la animación se repita al hacer scroll hacia arriba.

---

### Patrón SplitText — reveal de caracteres en 3D

Efecto premium: cada carácter gira desde atrás hacia adelante (`rotateX: -90° → 0°`) con stagger.

```javascript
var split = new SplitText(titleEl, { type: 'chars' });

// Estado inicial (oculto)
gsap.set(split.chars, {
    rotateX:         -90,
    opacity:         0,
    transformOrigin: '50% 50% -20px',
});

// Animación de entrada
gsap.to(split.chars, {
    rotateX:              0,
    opacity:              1,
    transformPerspective: 600,
    transformOrigin:      '50% 50% -20px',
    duration:             0.3,
    stagger:              0.016,
    ease:                 'power2.out',
});

// Al destruir el componente (ej. al pasar a desktop):
split.revert(); // restaura el DOM original
```

**CSS requerido en el elemento padre del título:**
```scss
.XXX_card_title {
    perspective: 600px;
    overflow: visible;
}
```

**Importante con Splide en loop:** pre-dividir todos los títulos (incluyendo clones) en el evento `mounted` con `root.querySelectorAll('.XXX_card_title')`. Guardar instancias en un `Map` para revertirlas al destruir el slider.

---

### Patrón icono con física — back.out

Efecto de pop con rebote físico para iconos SVG al activar una tarjeta:

```javascript
// Estado inicial
gsap.set(icon, { scale: 0, opacity: 0, rotation: -25 });

// Entrada
gsap.to(icon, {
    scale:    1,
    opacity:  1,
    rotation: 0,
    duration: 0.35,
    ease:     'back.out(2.8)',
});
```

---

### Patrón divisor con crecimiento horizontal

Línea separadora que crece de izquierda a derecha:

```javascript
// Estado inicial
gsap.set(divider, { scaleX: 0, transformOrigin: 'left center' });

// Entrada
gsap.to(divider, { scaleX: 1, duration: 0.25, ease: 'power2.out' });
```

```scss
.XXX_card_divider {
    height: 1px;
    background: rgba($color-dark, 0.1);
    width: 100%;
    flex-shrink: 0;
}
```

---

### Patrón Splide + GSAP — slider mobile con animación por tarjeta

Slider en mobile (< 768px), grid flex en tablet+ (Splide destruido). Patrón completo validado en `section_services_1`.

**Configuración Splide recomendada:**
```javascript
new Splide('.XXX_slider', {
    type:       'loop',
    perPage:    1,
    padding:    { left: '6%', right: '6%' }, // muestra tarjetas adyacentes
    gap:        '14px',
    arrows:     true,
    pagination: true,
    speed:      280,   // rápido para sensación de respuesta inmediata
    easing:     'cubic-bezier(0.25, 1, 0.5, 1)',
});
```

**CSS para el efecto scale/blur en slides inactivos:**
```scss
@include only_mobile {
    .splide__slide {
        transition: transform .18s cubic-bezier(.25,1,.5,1),
                    opacity   .18s ease,
                    filter    .18s ease;
        will-change: transform, opacity, filter;

        &:not(.is-active) { transform: scale(0.86); opacity: 0.45; filter: blur(1.5px); }
        &.is-active       { transform: scale(1);    opacity: 1;    filter: none; }
    }
}
```

**CSS en tablet+ para grid flex (Splide destruido):**
```scss
@include tablet {
    .splide__track { overflow: visible !important; }
    .splide__list  { display: flex !important; gap: 32px; transform: none !important; }
    .splide__slide { flex: 1 !important; width: auto !important; margin: 0 !important; }
}
```

**Patrón completo JS:**
```javascript
document.addEventListener('DOMContentLoaded', function () {
    initXXXSlider();
});

function initXXXSlider() {
    var el = document.querySelector('.XXX_slider');
    if (!el) return;

    var splide   = null;
    var splitMap = new Map(); // titleEl → SplitText (si se usa)

    function wireAnimations(sp) {
        sp.on('mounted', function () {
            // Pre-dividir todos los títulos (incluyendo clones de loop)
            el.querySelectorAll('.XXX_card_title').forEach(function (titleEl) {
                if (!splitMap.has(titleEl)) {
                    splitMap.set(titleEl, new SplitText(titleEl, { type: 'chars' }));
                }
            });
            // Ocultar slides no activos, animar el primero
            sp.Components.Elements.slides.forEach(function (slide) {
                if (!slide.classList.contains('is-active')) resetSlide(slide);
            });
            var first = sp.Components.Elements.slides.find(function (s) {
                return s.classList.contains('is-active');
            });
            if (first) { resetSlide(first); gsap.delayedCall(0.15, function () { animateSlideIn(first); }); }
        });

        sp.on('active',   function (obj) { animateSlideIn(obj.slide); });
        sp.on('inactive', function (obj) { resetSlide(obj.slide); });

        // Micro-bounce en arrows
        sp.on('arrows:mounted', function (prev, next) {
            [prev, next].forEach(function (btn) {
                btn.addEventListener('click', function () {
                    gsap.timeline()
                        .to(btn, { scale: 0.76, duration: 0.08 })
                        .to(btn, { scale: 1,    duration: 0.44, ease: 'back.out(4)' });
                });
            });
        });
    }

    function destroySlider() {
        if (splide) { splide.destroy(); splide = null; }
        splitMap.forEach(function (split) { split.revert(); });
        splitMap.clear();
        el.querySelectorAll('.XXX_card_icon, .XXX_card_title, .XXX_card_desc')
          .forEach(function (node) { gsap.set(node, { clearProps: 'all' }); });
    }

    function syncSlider() {
        if (window.innerWidth < 768) {
            if (!splide) {
                splide = new Splide('.XXX_slider', { /* config arriba */ });
                wireAnimations(splide);
                splide.mount();
            }
        } else {
            destroySlider();
        }
    }

    syncSlider();
    window.addEventListener('resize', syncSlider);
}
```

**Arrows glass (estilo validado):**
```scss
.splide__arrow {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.45);
    backdrop-filter: blur(10px) saturate(1.4);
    -webkit-backdrop-filter: blur(10px) saturate(1.4);
    border: 1px solid rgba($color-dark, 0.07);
    box-shadow: 0 1px 8px rgba($color-dark, 0.06);
    opacity: 1;
    transition: background .22s, border-color .22s;

    svg { width: 11px; height: 11px; fill: rgba($color-dark, 0.5); transition: fill .2s; }
    &:hover { background: rgba(255, 255, 255, 0.82); svg { fill: $color-accent; } }
    &--prev { left: 8px; }
    &--next { right: 8px; }
}
```

**Reglas críticas del slider:**
- `.splide__track` solo debe tener `overflow: visible` dentro de `@include tablet` — **nunca fuera de media query**, rompe el slider en mobile
- No añadir reglas a `.splide__arrows` — Splide gestiona su posicionamiento; solo estilizar `.splide__arrow`
- La tarjeta necesita `transform-style: preserve-3d` si se anima con rotaciones 3D

---

### Patrón 3D tilt en hover — desktop

Tarjetas que se inclinan siguiendo el ratón. Solo en desktop (≥ 1024px).

**CSS requerido en la tarjeta:**
```scss
.XXX_card {
    transform-style: preserve-3d;
    transition: box-shadow .35s; // solo box-shadow, nunca transform (GSAP lo gestiona)
}
```

**JS:**
```javascript
if (window.innerWidth >= 1024) {
    document.querySelectorAll('.XXX_card').forEach(function (card) {
        card.addEventListener('mousemove', function (e) {
            var rect = card.getBoundingClientRect();
            var x    = (e.clientX - rect.left)  / rect.width  - 0.5;
            var y    = (e.clientY - rect.top)   / rect.height - 0.5;
            gsap.to(card, {
                rotateY:              x * 22,
                rotateX:              -y * 16,
                transformPerspective: 500,
                duration:             0.35,
                ease:                 'power2.out',
                overwrite:            'auto',
            });
        });
        card.addEventListener('mouseleave', function () {
            gsap.to(card, { rotateY: 0, rotateX: 0, duration: 0.65, ease: 'power3.out', overwrite: 'auto' });
        });
    });
}
```

Los valores `x * 22` / `y * 16` y `transformPerspective: 500` son los validados como equilibrio entre impacto visual y usabilidad. Ajustar según necesidad: más perspectiva (número menor) = efecto más dramático.

---

### Patrón de video en bloques hero

Cuando el bloque incluye un reproductor de vídeo:

- El vídeo se carga automáticamente al abrir la página (sin esperar click del usuario).
- Soporta tres tipos via atributos `data-type-video` / `data-id-video` / `data-controls`: `youtube`, `vimeo` y fichero directo (`video`).
- **YouTube / Vimeo**: al cargar se reemplaza el interior del wrapper con un iframe. El botón de play desaparece porque el propio reproductor tiene sus controles.
- **Fichero directo**: se inserta el `<video>` sin borrar el botón de play. El botón actúa como toggle play/pause con icono dinámico. `muted` + `autoplay` son obligatorios para que el navegador permita el autoplay sin gesto del usuario.
- El botón de play lleva `pointer-events: none` en CSS por defecto; solo se activa vía JS para el tipo `video`.
- Añadir siempre `if (!id) return;` tras leer `data-id-video` para evitar crash cuando existe el wrapper pero no hay vídeo configurado.

---

## Checklist WPO antes de entregar el bloque

- [ ] `<img>` tiene `width` y `height` explícitos
- [ ] `<img>` tiene `loading="lazy"` (o `loading="eager"` si es LCP)
- [ ] `<img>` tiene `decoding="async"`
- [ ] `<picture>` con `<source>` para Desktop/Tablet/Mobile (si tiene imagen responsive)
- [ ] `aspect-ratio` definido en contenedor de imagen en CSS
- [ ] No hay `height: auto` sin `aspect-ratio` en imágenes
- [ ] SCSS importado en `sections-home.scss`
- [ ] Include PHP añadido en la página correcta y posición correcta
- [ ] JS incluido en `scripts_sections.php` (si aplica)
- [ ] Campos CMB2 correctamente escapados en `html.php` (fase 3B)
- [ ] Bloque probado en mobile, tablet y desktop
- [ ] Sin layout shifts al cargar la página
- [ ] Bloque registrado en el Catálogo (`C:\laragon\www\Listado de bloques\index.html`) con captura en `Capturas/`

---

## Variables y utilidades de referencia rápida

### Colores
```scss
$c-black: #1a1a1a;
$c-white: #fff;
$c-c:     #000202;
$c-c2:    #F9FFE5;
$c-blue:  #062F4D;
```

### Tipografías
```scss
$primary:        'poppins';
$primary-medium: 'poppinsmedium';
$primary-bold:   'poppinsbold';
$secondary:      'bebasnue';
$syne-extrabold: 'syneextrabold';
```

**Convención obligatoria:**
- `$secondary` → titulares y headings (`h1`, `h2`, `h3`, spans de título)
- `$primary` y sus variantes → textos de cuerpo, botones, descripciones, labels

**Tamaño de texto de cuerpo — regla global:**
Todo texto que no sea un titular (párrafos, descripciones, quotes, labels, captions) usa siempre:
```scss
font-family: $primary;
font-size: 15px;
```
Sin variaciones responsive de `font-size` para textos de cuerpo. Esto garantiza coherencia visual entre todos los bloques de una misma página. Nunca usar 12px, 13px, 14px ni `clamp()` en textos de cuerpo.

### Media queries
```scss
@include only_mobile   // max-width: 767px
@include tablet        // min-width: 768px
@include only_tablet   // 768px - 1023px
@include desktop       // min-width: 1024px
@include desktop1200   // min-width: 1200px
@include desktop1440   // min-width: 1440px
```

### Mixins flexbox
```scss
@include flexbox
@include flex-direction(column)
@include justify-content(center)
@include align-items(center)
```

---

## Compilación SCSS

Compilación en tiempo real (durante desarrollo):
```bash
sass --watch --style=compressed --no-source-map assets/scss/style.scss:assets/css/style.css
```

Compilación única:
```bash
sass --style=compressed --no-source-map assets/scss/style.scss:assets/css/style.css
```
