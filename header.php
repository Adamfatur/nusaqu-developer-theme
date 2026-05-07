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

<!-- Navbar -->
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
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        <input type="search" name="s" placeholder="Cari artikel..." value="<?php echo get_search_query(); ?>" aria-label="Search">
      </form>
      <a href="https://nusaqu.pastibisa.app/register" class="header-cta" target="_blank" rel="noopener">Coba Gratis</a>
      <button class="menu-toggle" aria-label="Menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</header>

<!-- Popup Modal -->
<div class="nq-modal-overlay" id="nqModal">
  <div class="nq-modal">
    <button class="modal-close" id="modalClose" aria-label="Close">&times;</button>
    <div class="modal-icon">✨</div>
    <h2>Buat Artikel SEO Otomatis</h2>
    <p>Masukkan 1 keyword, dapatkan artikel lengkap yang lolos AI detector dan siap publish ke WordPress. Gratis 50 kredit!</p>
    <div class="modal-features">
      <span>🚀 2 Menit per Artikel</span>
      <span>🎯 99% Human Score</span>
      <span>📈 SEO Optimized</span>
    </div>
    <a href="https://nusaqu.pastibisa.app/register" class="modal-btn" target="_blank" rel="noopener">Mulai Gratis Sekarang →</a>
    <span class="modal-note">Tanpa kartu kredit · Batal kapan saja</span>
  </div>
</div>

<main class="site-main">
