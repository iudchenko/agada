<?php

function register_custom_widget_area() {
  register_sidebar(
    array(
      'id' => 'footer-1',
      'name' => esc_html__( 'Footer 1', 'agada' ),
      'description' => esc_html__( 'Footer 1 widget area', 'agada' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>'
    )
  );

  register_sidebar(
    array(
      'id' => 'footer-2',
      'name' => esc_html__( 'Footer 2', 'agada' ),
      'description' => esc_html__( 'Footer 2 widget area', 'agada' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>'
    )
  );

  register_sidebar(
    array(
      'id' => 'footer-3',
      'name' => esc_html__( 'Footer 3', 'agada' ),
      'description' => esc_html__( 'Footer 3 widget area', 'agada' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>'
    )
  );

  register_sidebar(
    array(
      'id' => 'footer-4',
      'name' => esc_html__( 'Footer 4', 'agada' ),
      'description' => esc_html__( 'Footer 4 widget area', 'agada' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>'
    )
  );

  register_sidebar(
    array(
      'id' => 'footer-5',
      'name' => esc_html__( 'Footer 5', 'agada' ),
      'description' => esc_html__( 'Footer 5 widget area', 'agada' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>'
    )
  );




}
add_action( 'widgets_init', 'register_custom_widget_area' );