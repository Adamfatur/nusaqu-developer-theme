<?php
/**
 * Homepage - News Portal Layout
 * @package NusaQu
 */
get_header();
?>

<div class="nq-container">
  <div class="home-layout">
    <!-- Main Content -->
    <div class="content-main">

      <?php if (have_posts() && !is_paged()) : the_post(); ?>
      <!-- Hero Featured Article -->
      <article class="hero-card fade-in">
        <a href="<?php the_permalink(); ?>" class="hero-thumb">
          <?php if (has_post_thumbnail()) : the_post_thumbnail('nusaqu-hero'); else : ?>
          <img src="<?php echo NUSAQU_THEME_URI; ?>/assets/img/placeholder.svg" alt="">
          <?php endif; ?>
          <div class="hero-overlay"></div>
        </a>
        <div class="hero-content">
          <?php $cats = get_the_category(); if ($cats) : ?>
          <a href="<?php echo get_category_link($cats[0]->term_id); ?>" class="badge"><?php echo esc_html($cats[0]->name); ?></a>
          <?php endif; ?>
          <h2 class="hero-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <p class="hero-excerpt"><?php echo get_the_excerpt(); ?></p>
          <div class="hero-meta">
            <span class="meta-author"><?php echo get_avatar(get_the_author_meta('ID'), 24); ?> <?php the_author(); ?></span>
            <span class="meta-date"><?php echo get_the_date(); ?></span>
            <span class="meta-read"><?php echo nusaqu_reading_time(); ?></span>
          </div>
        </div>
      </article>
      <?php endif; ?>

      <!-- Article Grid -->
      <div class="section-head">
        <h2>Artikel Terbaru</h2>
        <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="view-all">Lihat Semua →</a>
      </div>

      <div class="article-grid stagger-children">
        <?php while (have_posts()) : the_post(); ?>
        <article class="article-card fade-in">
          <a href="<?php the_permalink(); ?>" class="card-thumb">
            <?php if (has_post_thumbnail()) : the_post_thumbnail('nusaqu-card'); else : ?>
            <img src="<?php echo NUSAQU_THEME_URI; ?>/assets/img/placeholder.svg" alt="">
            <?php endif; ?>
          </a>
          <div class="card-body">
            <?php $cats = get_the_category(); if ($cats) : ?>
            <a href="<?php echo get_category_link($cats[0]->term_id); ?>" class="badge-sm"><?php echo esc_html($cats[0]->name); ?></a>
            <?php endif; ?>
            <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p class="card-excerpt"><?php echo get_the_excerpt(); ?></p>
            <div class="card-meta">
              <span><?php echo get_the_date('d M Y'); ?></span>
              <span><?php echo nusaqu_reading_time(); ?></span>
            </div>
          </div>
        </article>
        <?php endwhile; ?>
      </div>

      <?php the_posts_pagination(array('mid_size' => 2, 'prev_text' => '←', 'next_text' => '→')); ?>

    </div>

    <!-- Sidebar -->
    <aside class="content-sidebar">
      <!-- Search -->
      <div class="sidebar-widget">
        <h3 class="widget-title">Cari Artikel</h3>
        <form class="sidebar-search" action="<?php echo esc_url(home_url('/')); ?>" method="get">
          <input type="search" name="s" placeholder="Ketik keyword..." value="<?php echo get_search_query(); ?>">
          <button type="submit">Cari</button>
        </form>
      </div>

      <!-- Popular Posts -->
      <div class="sidebar-widget">
        <h3 class="widget-title">Populer</h3>
        <?php
        $popular = new WP_Query(array('posts_per_page' => 5, 'orderby' => 'comment_count', 'order' => 'DESC'));
        if ($popular->have_posts()) : $i = 1; while ($popular->have_posts()) : $popular->the_post();
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

      <!-- Categories -->
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

      <!-- NusaQu Promo -->
      <div class="sidebar-widget nq-promo">
        <div class="promo-badge">🤖 AI Powered</div>
        <h3>Artikel ini digenerate oleh NusaQu</h3>
        <p>Platform AI yang mengubah keyword menjadi artikel SEO berkualitas dalam hitungan menit.</p>
        <a href="https://nusaqu.pastibisa.app/register" class="nq-btn-primary" target="_blank" rel="noopener">Coba Gratis →</a>
      </div>

      <?php dynamic_sidebar('sidebar-1'); ?>
    </aside>
  </div>
</div>

<?php get_footer(); ?>
