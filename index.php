<?php
/**
 * Main template file
 * @package NusaQu
 */

get_header();
?>

<div class="site-main">
  <div class="nq-container">
    <?php if (have_posts()) : ?>

      <?php
      $post_count = 0;
      $first_post = true;
      ?>

      <?php if (is_home() && !is_paged()) : ?>
      <!-- Featured / Hero Post -->
      <?php if (have_posts()) : the_post(); ?>
      <article class="featured-card fade-in" <?php post_class(); ?>>
        <div class="card-thumbnail">
          <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('nusaqu-featured'); ?>
          <?php else : ?>
            <img src="<?php echo NUSAQU_THEME_URI; ?>/assets/img/placeholder.svg" alt="">
          <?php endif; ?>
        </div>
        <div class="card-overlay"></div>
        <div class="card-content">
          <div class="card-meta">
            <?php
            $categories = get_the_category();
            if ($categories) : ?>
              <span class="card-category"><?php echo esc_html($categories[0]->name); ?></span>
            <?php endif; ?>
            <span><?php echo get_the_date(); ?></span>
            <span><?php echo nusaqu_reading_time(); ?></span>
          </div>
          <h2 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <p class="card-excerpt"><?php echo get_the_excerpt(); ?></p>
        </div>
      </article>
      <?php endif; ?>
      <?php endif; ?>

      <!-- Posts Grid -->
      <div class="section-header fade-in">
        <h2><?php echo is_home() ? 'Artikel Terbaru' : 'Artikel'; ?></h2>
      </div>

      <div class="posts-grid stagger-children">
        <?php while (have_posts()) : the_post(); ?>
          <article class="post-card fade-in" <?php post_class(); ?>>
            <a href="<?php the_permalink(); ?>" class="card-thumbnail">
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('nusaqu-card'); ?>
              <?php else : ?>
                <img src="<?php echo NUSAQU_THEME_URI; ?>/assets/img/placeholder.svg" alt="">
              <?php endif; ?>
            </a>
            <div class="card-content">
              <div class="card-meta">
                <?php
                $categories = get_the_category();
                if ($categories) : ?>
                  <span class="card-category"><?php echo esc_html($categories[0]->name); ?></span>
                <?php endif; ?>
                <span><?php echo get_the_date(); ?></span>
              </div>
              <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <p class="card-excerpt"><?php echo get_the_excerpt(); ?></p>
              <div class="card-footer">
                <div class="card-author">
                  <?php echo get_avatar(get_the_author_meta('ID'), 28); ?>
                  <span><?php the_author(); ?></span>
                </div>
                <span class="reading-time"><?php echo nusaqu_reading_time(); ?></span>
              </div>
            </div>
          </article>
        <?php endwhile; ?>
      </div>

      <?php the_posts_pagination(array(
        'mid_size'  => 2,
        'prev_text' => '&larr;',
        'next_text' => '&rarr;',
      )); ?>

    <?php else : ?>
      <div class="no-results">
        <h2><?php esc_html_e('Belum ada artikel', 'nusaqu'); ?></h2>
        <p><?php esc_html_e('Konten akan segera hadir. Stay tuned!', 'nusaqu'); ?></p>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php get_footer(); ?>
