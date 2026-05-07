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
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if (is_single()) : ?>
<div class="reading-progress"></div>
<?php endif; ?>

<header class="site-header" role="banner">
  <div class="nq-container header-inner">
    <div class="site-branding">
      <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
        <img src="<?php echo NUSAQU_THEME_URI; ?>/assets/img/logo-white.png" alt="<?php bloginfo('name'); ?>">
      </a>
    </div>

    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle menu', 'nusaqu'); ?>">
      <span></span><span></span><span></span>
    </button>

    <nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e('Primary Menu', 'nusaqu'); ?>">
      <?php
      wp_nav_menu(array(
        'theme_location' => 'primary',
        'menu_id'        => 'primary-menu',
        'container'      => false,
        'fallback_cb'    => 'nusaqu_fallback_menu',
      ));
      ?>
    </nav>
  </div>
</header>

<main id="content" class="site-content">
