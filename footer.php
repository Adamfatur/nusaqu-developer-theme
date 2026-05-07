<?php
/**
 * Theme footer
 * @package NusaQu
 */
?>
</main>

<footer class="site-footer" role="contentinfo">
  <div class="nq-container">
    <div class="footer-grid">
      <div class="footer-brand">
        <img src="<?php echo NUSAQU_THEME_URI; ?>/assets/img/logo-white.png" alt="<?php bloginfo('name'); ?>">
        <p><?php bloginfo('description'); ?></p>
      </div>
      <?php if (is_active_sidebar('footer-1')) : ?>
      <div class="footer-col">
        <?php dynamic_sidebar('footer-1'); ?>
      </div>
      <?php endif; ?>
      <?php if (is_active_sidebar('footer-2')) : ?>
      <div class="footer-col">
        <?php dynamic_sidebar('footer-2'); ?>
      </div>
      <?php endif; ?>
      <?php if (is_active_sidebar('footer-3')) : ?>
      <div class="footer-col">
        <?php dynamic_sidebar('footer-3'); ?>
      </div>
      <?php endif; ?>
    </div>
    <div class="footer-bottom">
      <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved. Powered by <a href="https://nusaqu.pastibisa.app" target="_blank" rel="noopener">NusaQu AI</a></p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
