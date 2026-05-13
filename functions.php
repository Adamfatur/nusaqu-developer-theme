<?php
/**
 * NusaQu Developer Theme functions
 * @package NusaQu
 */

if (!defined('ABSPATH')) exit;

define('NUSAQU_THEME_VERSION', '1.3.0');
define('NUSAQU_THEME_DIR', get_template_directory());
define('NUSAQU_THEME_URI', get_template_directory_uri());

// Theme setup
function nusaqu_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('automatic-feed-links');
    add_theme_support('responsive-embeds');

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'nusaqu'),
        'footer'  => __('Footer Menu', 'nusaqu'),
    ));

    add_image_size('nusaqu-hero', 1200, 630, true);
    add_image_size('nusaqu-card', 600, 400, true);
    add_image_size('nusaqu-thumb', 150, 150, true);
}
add_action('after_setup_theme', 'nusaqu_theme_setup');

// Enqueue single combined CSS + JS
function nusaqu_enqueue_assets() {
    wp_enqueue_style('nusaqu-main', NUSAQU_THEME_URI . '/assets/css/main.css', array(), NUSAQU_THEME_VERSION);
    wp_enqueue_script('nusaqu-main', NUSAQU_THEME_URI . '/assets/js/main.js', array(), NUSAQU_THEME_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'nusaqu_enqueue_assets');

// Inline font-face
function nusaqu_inline_fonts() {
    echo '<style>@font-face{font-family:"Inter";font-style:normal;font-weight:100 900;font-display:swap;src:url(' . NUSAQU_THEME_URI . '/assets/fonts/inter-var.woff2) format("woff2")}</style>' . "\n";
}
add_action('wp_head', 'nusaqu_inline_fonts', 1);

// Remove bloat but keep block styles for content rendering
function nusaqu_cleanup() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    wp_dequeue_style('classic-theme-styles');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
}
add_action('wp_enqueue_scripts', 'nusaqu_cleanup', 100);

// Remove global styles and SVG filters that can cause layout issues
remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');

// Register sidebars
function nusaqu_widgets_init() {
    register_sidebar(array(
        'name'          => 'Sidebar',
        'id'            => 'sidebar-1',
        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'nusaqu_widgets_init');

// Reading time helper
function nusaqu_reading_time($post_id = null) {
    if (!$post_id) $post_id = get_the_ID();
    $content = get_post_field('post_content', $post_id);
    $words = str_word_count(strip_tags($content));
    return max(1, ceil($words / 200)) . ' min';
}

// Excerpt length
function nusaqu_excerpt_length($length) { return 20; }
add_filter('excerpt_length', 'nusaqu_excerpt_length');

function nusaqu_excerpt_more($more) { return '...'; }
add_filter('excerpt_more', 'nusaqu_excerpt_more');

// Fallback menu
function nusaqu_fallback_menu() {
    $cats = get_categories(array('number' => 5, 'orderby' => 'count', 'order' => 'DESC'));
    echo '<ul>';
    echo '<li class="menu-item"><a href="' . home_url('/') . '">Beranda</a></li>';
    foreach ($cats as $cat) {
        echo '<li class="menu-item"><a href="' . get_category_link($cat->term_id) . '">' . esc_html($cat->name) . '</a></li>';
    }
    echo '</ul>';
}
