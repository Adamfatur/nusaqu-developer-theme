<?php
/**
 * Custom template tags
 * @package NusaQu
 */

if (!function_exists('nusaqu_fallback_menu')) :
  function nusaqu_fallback_menu() {
    echo '<ul>';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Beranda</a></li>';
    wp_list_categories(array(
      'title_li' => '',
      'depth'    => 1,
    ));
    echo '</ul>';
  }
endif;

if (!function_exists('nusaqu_posted_on')) :
  function nusaqu_posted_on() {
    $time_string = '<time class="entry-date" datetime="%1$s">%2$s</time>';
    $time_string = sprintf(
      $time_string,
      esc_attr(get_the_date(DATE_W3C)),
      esc_html(get_the_date())
    );
    echo '<span class="posted-on">' . $time_string . '</span>';
  }
endif;

if (!function_exists('nusaqu_posted_by')) :
  function nusaqu_posted_by() {
    echo '<span class="byline"><span class="author vcard">' . esc_html(get_the_author()) . '</span></span>';
  }
endif;
