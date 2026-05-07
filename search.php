<?php
/**
 * Search results template
 * @package NusaQu
 */

get_header();
?>

<div class="archive-header">
  <div class="nq-container">
    <h1><?php printf(esc_html__('Hasil pencarian: "%s"', 'nusaqu'), get_search_query()); ?></h1>
  </div>
</div>

<div class="site-main">
  <div class="nq-container">
    <?php if (have_posts()) : ?>
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
            <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p class="card-excerpt"><?php echo get_the_excerpt(); ?></p>
            <div class="card-meta">
              <span><?php echo get_the_date(); ?></span>
            </div>
          </div>
        </article>
      <?php endwhile; ?>
    </div>

    <?php the_posts_pagination(); ?>

    <?php else : ?>
      <div class="no-results" style="text-align:center;padding:4rem 0;">
        <h2>Tidak ditemukan</h2>
        <p>Coba kata kunci lain.</p>
        <?php get_search_form(); ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php get_footer(); ?>
