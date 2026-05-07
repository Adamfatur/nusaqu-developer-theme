<?php
/**
 * Single post template
 * @package NusaQu
 */
get_header();
the_post();
?>

<article class="single-article">
  <!-- Article Header -->
  <div class="article-header">
    <div class="nq-container">
      <?php $cats = get_the_category(); if ($cats) : ?>
      <a href="<?php echo get_category_link($cats[0]->term_id); ?>" class="badge"><?php echo esc_html($cats[0]->name); ?></a>
      <?php endif; ?>
      <h1><?php the_title(); ?></h1>
      <div class="article-meta">
        <div class="meta-author">
          <?php echo get_avatar(get_the_author_meta('ID'), 36); ?>
          <div>
            <strong><?php the_author(); ?></strong>
            <span><?php echo get_the_date('d F Y'); ?> · <?php echo nusaqu_reading_time(); ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="nq-container">
    <div class="single-layout">
      <!-- Article Content -->
      <div class="article-content">
        <?php if (has_post_thumbnail()) : ?>
        <figure class="article-featured-img">
          <?php the_post_thumbnail('nusaqu-hero'); ?>
        </figure>
        <?php endif; ?>

        <div class="entry-content">
          <?php the_content(); ?>
        </div>

        <?php $tags = get_the_tags(); if ($tags) : ?>
        <div class="article-tags">
          <?php foreach ($tags as $tag) : ?>
          <a href="<?php echo get_tag_link($tag->term_id); ?>">#<?php echo esc_html($tag->name); ?></a>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Share -->
        <div class="article-share">
          <span>Bagikan:</span>
          <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener">𝕏 Twitter</a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener">Facebook</a>
          <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' ' . get_permalink()); ?>" target="_blank" rel="noopener">WhatsApp</a>
        </div>

        <!-- Author Box -->
        <div class="author-box">
          <div class="author-avatar"><?php echo get_avatar(get_the_author_meta('ID'), 56); ?></div>
          <div class="author-info">
            <span class="author-label">Ditulis oleh</span>
            <strong><?php the_author(); ?></strong>
            <p>Artikel ini digenerate menggunakan NusaQu AI — platform yang mengubah keyword menjadi artikel SEO berkualitas tinggi secara otomatis.</p>
          </div>
        </div>

        <!-- Related Posts -->
        <?php
        $related = new WP_Query(array(
          'category__in'   => wp_get_post_categories(get_the_ID()),
          'posts_per_page' => 3,
          'post__not_in'   => array(get_the_ID()),
        ));
        if ($related->have_posts()) : ?>
        <div class="related-section">
          <h3>Artikel Terkait</h3>
          <div class="related-grid">
            <?php while ($related->have_posts()) : $related->the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="related-item">
              <div class="related-thumb">
                <?php if (has_post_thumbnail()) : the_post_thumbnail('nusaqu-card'); else : ?>
                <img src="<?php echo NUSAQU_THEME_URI; ?>/assets/img/placeholder.svg" alt="">
                <?php endif; ?>
              </div>
              <h4><?php the_title(); ?></h4>
              <span><?php echo get_the_date('d M Y'); ?></span>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
          </div>
        </div>
        <?php endif; ?>

        <?php if (comments_open() || get_comments_number()) : comments_template(); endif; ?>
      </div>

      <!-- Sidebar -->
      <aside class="content-sidebar">
        <!-- NusaQu Main Promo -->
        <div class="sidebar-widget nq-promo-main">
          <div class="promo-icon">🚀</div>
          <h3>Buat Artikel Seperti Ini dalam 2 Menit</h3>
          <p>NusaQu AI mengubah 1 keyword menjadi artikel SEO lengkap — lolos AI detector, siap publish ke WordPress.</p>
          <ul class="promo-features">
            <li>✓ 50 Kredit Gratis</li>
            <li>✓ 9 Tahap AI Pipeline</li>
            <li>✓ 99% Human Score</li>
            <li>✓ Auto-publish WordPress</li>
          </ul>
          <a href="https://nusaqu.pastibisa.app/register" class="nq-btn-primary" target="_blank" rel="noopener">Coba Gratis Sekarang →</a>
          <span class="promo-note">Tanpa kartu kredit · Setup 30 detik</span>
        </div>

        <!-- Artikel Lainnya -->
        <div class="sidebar-widget">
          <h3 class="widget-title">Artikel Lainnya</h3>
          <?php
          $others = new WP_Query(array('posts_per_page' => 5, 'post__not_in' => array(get_the_ID())));
          if ($others->have_posts()) : $i = 1; while ($others->have_posts()) : $others->the_post();
          ?>
          <a href="<?php the_permalink(); ?>" class="popular-item">
            <span class="popular-num"><?php echo $i; ?></span>
            <div class="popular-info">
              <span class="popular-title"><?php the_title(); ?></span>
              <span class="popular-date"><?php echo get_the_date('d M Y'); ?></span>
            </div>
          </a>
          <?php $i++; endwhile; wp_reset_postdata(); endif; ?>
        </div>

        <!-- Kategori -->
        <div class="sidebar-widget">
          <h3 class="widget-title">Kategori</h3>
          <div class="category-list">
            <?php
            $categories = get_categories(array('orderby' => 'count', 'order' => 'DESC', 'number' => 8));
            foreach ($categories as $cat) :
            ?>
            <a href="<?php echo get_category_link($cat->term_id); ?>" class="cat-chip">
              <?php echo esc_html($cat->name); ?>
              <span class="cat-count"><?php echo $cat->count; ?></span>
            </a>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Plugin Promo -->
        <div class="sidebar-widget nq-promo-plugin">
          <div class="promo-icon">🔌</div>
          <h3>Plugin WordPress Gratis</h3>
          <p>Install plugin NusaQu dan generate artikel langsung dari dashboard WordPress kamu.</p>
          <a href="https://nusaqu.pastibisa.app/plugin" class="nq-btn-outline-light" target="_blank" rel="noopener">Download Plugin →</a>
        </div>

        <!-- Pricing Teaser -->
        <?php // Removed pricing widget per request ?>

        <?php dynamic_sidebar('sidebar-1'); ?>
      </aside>
    </div>
  </div>
</article>

<?php get_footer(); ?>
