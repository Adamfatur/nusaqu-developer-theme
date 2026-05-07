<?php
/**
 * Theme header
 * @package NusaQu
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="<?php echo NUSAQU_THEME_URI; ?>/assets/img/favicon.png" type="image/png">
  <link rel="preload" href="<?php echo NUSAQU_THEME_URI; ?>/assets/fonts/inter-var.woff2" as="font" type="font/woff2" crossorigin>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if (is_single()) : ?>
<div class="reading-progress"></div>
<?php endif; ?>

<header class="site-header">
  <div class="nq-container header-inner">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
      <img src="<?php echo NUSAQU_THEME_URI; ?>/assets/img/logo-white.png" alt="<?php bloginfo('name'); ?>">
    </a>

    <nav class="main-nav">
      <?php wp_nav_menu(array(
        'theme_location' => 'primary',
        'container'      => false,
        'depth'          => 1,
        'fallback_cb'    => 'nusaqu_fallback_menu',
      )); ?>
    </nav>

    <div class="header-right">
      <form class="header-search" action="<?php echo esc_url(home_url('/')); ?>" method="get">
        <input type="search" name="s" placeholder="Cari artikel..." value="<?php echo get_search_query(); ?>" aria-label="Search">
        <button type="submit" aria-label="Search"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg></button>
      </form>
      <button class="menu-toggle" aria-label="Menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</header>

<main class="site-main">
