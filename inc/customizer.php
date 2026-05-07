<?php
/**
 * Theme Customizer
 * @package NusaQu
 */

function nusaqu_customize_register($wp_customize) {
    // NusaQu Section
    $wp_customize->add_section('nusaqu_options', array(
        'title'    => __('NusaQu Options', 'nusaqu'),
        'priority' => 30,
    ));

    // Footer text
    $wp_customize->add_setting('nusaqu_footer_text', array(
        'default'           => 'Powered by NusaQu AI',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('nusaqu_footer_text', array(
        'label'   => __('Footer Text', 'nusaqu'),
        'section' => 'nusaqu_options',
        'type'    => 'text',
    ));
}
add_action('customize_register', 'nusaqu_customize_register');
