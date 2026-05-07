<?php
/**
 * Single post template
 * @package NusaQu
 */

get_header();
?>

<?php while (have_posts()) : the_post(); ?>

<div class="single-header">
  <div class="nq-container">
    <?php
    $categories = get_the_category();
    if ($categories) : ?>
      <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="post-category"><?php echo esc_html($categories[0]->name); ?></a>
    <?php endif; ?>

    <h1 class="fade-in"><?php the_title(); ?></h1>

    <div class="post-meta fade-in">
      <?php echo get_avatar(get_the_author_meta('ID'), 40, '', '', array('class' => 'author-avatar')); ?>
      <span><strong><?php the_author(); ?></strong></span>
      <span><?php echo get_the_date(); ?></span>
      <span><?php echo nusaqu_reading_time(); ?></span>
    </div>
  </div>
</div>

<div class="site-main">
  <div class="nq-container">
    <?php if (has_post_thumbnail()) : ?>
    <div class="post-featured-image fade-in" style="max-width:760px;margin:0 auto 2rem;">
      <?php the_post_thumbnail('nusaqu-featured', array('style' => 'border-radius:var(--nq-radius-lg);width:100%;')); ?>
    </div>
    <?php endif; ?>

    <div class="post-content fade-in">
      <?php the_content(); ?>
    </div>

    <?php
    $tags = get_the_tags();
    if ($tags) : ?>
    <div class="post-tags" style="max-width:760px;margin:2rem auto 0;">
      <?php foreach ($tags as $tag) : ?>
        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>">#<?php echo esc_html($tag->name); ?></a>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Related Posts -->
    <?php
    $related = new WP_Query(array(
      'category__in'   => wp_get_post_categories(get_the_ID()),
      'posts_per_page' => 3,
      'post__not_in'   => array(get_the_ID()),
    ));
    if ($related->have_posts()) : ?>
    <div class="related-posts">
      <h3>Artikel Terkait</h3>
      <div class="related-posts-grid stagger-children">
        <?php while ($related->have_posts()) : $related->the_post(); ?>
        <article class="post-card fade-in">
          <a href="<?php the_permalink(); ?>" class="card-thumbnail">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('nusaqu-card'); ?>
            <?php else : ?>
              <img src="<?php echo NUSAQU_THEME_URI; ?>/assets/img/placeholder.svg" alt="">
            <?php endif; ?>
          </a>
          <div class="card-content">
            <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="card-meta">
              <span><?php echo get_the_date(); ?></span>
              <span><?php echo nusaqu_reading_time(); ?></span>
            </div>
          </div>
        </article>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
    <?php endif; ?>

    <?php if (comments_open() || get_comments_number()) : ?>
    <div class="comments-area">
      <?php comments_template(); ?>
    </div>
    <?php endif; ?>
  </div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>
