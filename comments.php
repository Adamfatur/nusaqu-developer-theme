<?php
/**
 * Comments template
 * @package NusaQu
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-section">
  <?php if (have_comments()) : ?>
    <h2 class="comments-title">
      <?php
      $comment_count = get_comments_number();
      printf(
        esc_html(_n('%d Komentar', '%d Komentar', $comment_count, 'nusaqu')),
        $comment_count
      );
      ?>
    </h2>

    <ol class="comment-list">
      <?php
      wp_list_comments(array(
        'style'      => 'ol',
        'short_ping' => true,
        'avatar_size' => 40,
      ));
      ?>
    </ol>

    <?php the_comments_navigation(); ?>
  <?php endif; ?>

  <?php
  comment_form(array(
    'title_reply'        => __('Tinggalkan Komentar', 'nusaqu'),
    'label_submit'       => __('Kirim Komentar', 'nusaqu'),
    'comment_notes_before' => '',
  ));
  ?>
</div>
