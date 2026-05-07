<?php
/**
 * NusaQu Developer Theme functions and definitions
 *
 * @package NusaQu
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

define('NUSAQU_THEME_VERSION', '1.0.0');
define('NUSAQU_THEME_DIR', get_template_directory());
define('NUSAQU_THEME_URI', get_template_directory_uri());

// Theme setup
function nusaqu_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'
    ));
    add_theme_support('automatic-feed-links');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');

    register_nav_menus(array(
        'primary'   => __('Primary Menu', 'nusaqu'),
        'footer'    => __('Footer Menu', 'nusaqu'),
    ));

    add_image_size('nusaqu-featured', 1200, 630, true);
    add_image_size('nusaqu-card', 600, 400, true);
    add_image_size('nusaqu-thumbnail', 300, 200, true);
}
add_action('after_setup_theme', 'nusaqu_theme_setup');

// Enqueue styles and scripts
function nusaqu_enqueue_assets() {
    // Main stylesheet
    wp_enqueue_style('nusaqu-variables', NUSAQU_THEME_URI . '/assets/css/variables.css', array(), NUSAQU_THEME_VERSION);
    wp_enqueue_style('nusaqu-base', NUSAQU_THEME_URI . '/assets/css/base.css', array('nusaqu-variables'), NUSAQU_THEME_VERSION);
    wp_enqueue_style('nusaqu-components', NUSAQU_THEME_URI . '/assets/css/components.css', array('nusaqu-base'), NUSAQU_THEME_VERSION);
    wp_enqueue_style('nusaqu-layout', NUSAQU_THEME_URI . '/assets/css/layout.css', array('nusaqu-components'), NUSAQU_THEME_VERSION);
    wp_enqueue_style('nusaqu-animations', NUSAQU_THEME_URI . '/assets/css/animations.css', array('nusaqu-layout'), NUSAQU_THEME_VERSION);
    wp_enqueue_style('nusaqu-responsive', NUSAQU_THEME_URI . '/assets/css/responsive.css', array('nusaqu-animations'), NUSAQU_THEME_VERSION);
    wp_enqueue_style('nusaqu-style', get_stylesheet_uri(), array('nusaqu-responsive'), NUSAQU_THEME_VERSION);

    // Google Fonts
    wp_enqueue_style('nusaqu-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500&display=swap', array(), null);

    // Scripts
    wp_enqueue_script('nusaqu-navigation', NUSAQU_THEME_URI . '/assets/js/navigation.js', array(), NUSAQU_THEME_VERSION, true);
    wp_enqueue_script('nusaqu-animations', NUSAQU_THEME_URI . '/assets/js/animations.js', array(), NUSAQU_THEME_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'nusaqu_enqueue_assets');

// Register widget areas
function nusaqu_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'nusaqu'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here.', 'nusaqu'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'name'          => __('Footer 1', 'nusaqu'),
        'id'            => 'footer-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    register_sidebar(array(
        'name'          => __('Footer 2', 'nusaqu'),
        'id'            => 'footer-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    register_sidebar(array(
        'name'          => __('Footer 3', 'nusaqu'),
        'id'            => 'footer-3',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'nusaqu_widgets_init');

// Custom excerpt length
function nusaqu_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'nusaqu_excerpt_length');

// Custom excerpt more
function nusaqu_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'nusaqu_excerpt_more');

// Add reading time to posts
function nusaqu_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);
    return $reading_time . ' min read';
}

// Include template tags
require_once NUSAQU_THEME_DIR . '/inc/template-tags.php';
require_once NUSAQU_THEME_DIR . '/inc/customizer.php';
