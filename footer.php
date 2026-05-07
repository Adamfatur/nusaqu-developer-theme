<?php
/**
 * Theme footer
 * @package NusaQu
 */
?>
</main>

<!-- NusaQu CTA Banner -->
<section class="nq-cta">
  <div class="nq-container">
    <div class="cta-inner">
      <div class="cta-content">
        <h2>Generate Artikel SEO dengan AI</h2>
        <p>NusaQu mengubah keyword menjadi artikel berkualitas yang siap publish ke WordPress. Tanpa prompt, tanpa editing manual.</p>
        <div class="cta-features">
          <span>✓ 50 Kredit Gratis</span>
          <span>✓ Lolos AI Detector</span>
          <span>✓ SEO Optimized</span>
          <span>✓ Multi-AI Engine</span>
        </div>
      </div>
      <div class="cta-actions">
        <a href="https://nusaqu.pastibisa.app/register" class="nq-btn-primary" target="_blank" rel="noopener">Coba Gratis Sekarang →</a>
        <a href="https://nusaqu.pastibisa.app" class="nq-btn-outline" target="_blank" rel="noopener">Pelajari Lebih Lanjut</a>
      </div>
    </div>
  </div>
</section>

<footer class="site-footer">
  <div class="nq-container">
    <div class="footer-top">
      <div class="footer-brand">
        <img src="<?php echo NUSAQU_THEME_URI; ?>/assets/img/logo-white.png" alt="NusaQu" class="footer-logo">
        <p>Platform AI #1 untuk generate artikel SEO berkualitas langsung ke WordPress. Dari keyword ke artikel terpublish dalam hitungan menit.</p>
        <div class="footer-social">
          <a href="https://twitter.com/nusaqu" target="_blank" rel="noopener" aria-label="Twitter">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
          <a href="https://instagram.com/nusaqu" target="_blank" rel="noopener" aria-label="Instagram">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="5"/><circle cx="17.5" cy="6.5" r="1.5" fill="currentColor" stroke="none"/></svg>
          </a>
          <a href="https://youtube.com/@nusaqu" target="_blank" rel="noopener" aria-label="YouTube">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
          </a>
        </div>
      </div>

      <div class="footer-links">
        <div class="footer-col">
          <h4>Produk</h4>
          <ul>
            <li><a href="https://nusaqu.pastibisa.app/#features" target="_blank">Fitur</a></li>
            <li><a href="https://nusaqu.pastibisa.app/#pricing" target="_blank">Harga</a></li>
            <li><a href="https://nusaqu.pastibisa.app/plugin" target="_blank">Plugin WordPress</a></li>
            <li><a href="https://nusaqu.pastibisa.app/#how-it-works" target="_blank">Cara Kerja</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Kategori</h4>
          <ul>
            <?php
            $cats = get_categories(array('number' => 5, 'orderby' => 'count', 'order' => 'DESC'));
            foreach ($cats as $cat) :
            ?>
            <li><a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo esc_html($cat->name); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Legal</h4>
          <ul>
            <li><a href="https://nusaqu.pastibisa.app/privacy" target="_blank">Kebijakan Privasi</a></li>
            <li><a href="https://nusaqu.pastibisa.app/terms" target="_blank">Syarat & Ketentuan</a></li>
            <li><a href="https://nusaqu.pastibisa.app/contact" target="_blank">Hubungi Kami</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
      <p>Powered by <a href="https://nusaqu.pastibisa.app" target="_blank" rel="noopener">NusaQu AI</a> — Made with ❤️ in Indonesia 🇮🇩</p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
