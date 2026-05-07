<?php
/**
 * Page template
 * @package NusaQu
 */

get_header();
?>

<div class="single-header">
  <div class="nq-container">
    <h1 class="fade-in"><?php the_title(); ?></h1>
  </div>
</div>

<div class="site-main">
  <div class="nq-container">
    <?php while (have_posts()) : the_post(); ?>
    <div class="post-content fade-in">
      <?php the_content(); ?>
    </div>
    <?php endwhile; ?>
  </div>
</div>

<?php get_footer(); ?>
