<?php
/**
 * 404 template
 * @package NusaQu
 */

get_header();
?>

<div class="site-main">
  <div class="nq-container">
    <div class="error-404">
      <h1 class="fade-in">404</h1>
      <p class="fade-in">Halaman yang kamu cari tidak ditemukan.</p>
      <a href="<?php echo esc_url(home_url('/')); ?>" class="nq-btn nq-btn-primary fade-in">
        &larr; Kembali ke Beranda
      </a>
    </div>
  </div>
</div>

<?php get_footer(); ?>
