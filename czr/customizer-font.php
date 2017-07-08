<?php
if ( !function_exists ( 'cd_customizer_font' ) ) {

 function cd_customizer_font() {
  $font = get_theme_mod( 'global_font', 'opensans' );

  if ( $font == 'opensans' ) {
   wp_enqueue_style ( 'OpenSans', '//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i' );
  } elseif ( $font == 'lato' ) {
   wp_deregister_style( 'GoogleFonts' );
   wp_enqueue_style ( 'Lato', '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,600,600i,700,700i' );
  } elseif ( $font == 'roboto' ) {
   wp_enqueue_style ( 'Roboto', '//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,600,600i,700,700i' );
  } elseif ( $font == 'robotocondensed' ) {
   wp_enqueue_style ( 'RobotoCondensed', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,600,600i,700,700i' );
  } elseif ( $font == 'ubuntu' ) {
   wp_enqueue_style ( 'Ubuntu', '//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,600,600i,700,700i' );
  } elseif ( $font == 'raleway' ) {
   wp_enqueue_style ( 'Raleway', '//fonts.googleapis.com/css?family=Raleway:300,300i,400,400i,600,600i,700,700i' );
  } elseif ( $font == 'sourcesanspro' ) {
   wp_enqueue_style ( 'SourceSansPro', '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i' );
  } elseif ( $font == 'josefinsans' ) {
   wp_enqueue_style ( 'JosefinSans', '//fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,600,600i,700,700i' );
  } elseif ( $font == 'ptsans' ) {
   wp_enqueue_style ( 'PTSans', '//fonts.googleapis.com/css?family=PT+Sans:300,300i,400,400i,600,600i,700,700i' );
  } elseif ( $font == 'lora' ) {
   wp_enqueue_style ( 'Lora', '//fonts.googleapis.com/css?family=Lora:300,300i,400,400i,600,600i,700,700i' );
  } elseif ( $font == 'robotoslab' ) {
   wp_enqueue_style ( 'RobotoSlab', '//fonts.googleapis.com/css?family=Roboto+Slab:300,300i,400,400i,600,600i,700,700i' );
  }

 }

}
add_action ( 'wp_enqueue_scripts', 'cd_customizer_font' );


if ( !function_exists ( 'cd_customizer_font_set' ) ) {

 function cd_customizer_font_set() {

  $font = get_theme_mod( 'global_font', 'opensans' );

  if ( $font == 'opensans' ) { $font = 'Open Sans'; }
  elseif ( $font == 'sourcesanspro' ) { $font = 'Source Sans Pro'; }
  elseif ( $font == 'josefinsans' ) { $font = 'Josefin Sans'; }
  elseif ( $font == 'ptsans' ) { $font = 'PT Sans'; }
  elseif ( $font == 'robotoslab' ) { $font = 'Roboto Slab'; }

  $custom_ff = get_theme_mod( 'custom_font', '[font], Arial, sans-serif' );
  $custom_ff = str_replace( '[font]', ucfirst( $font ), $custom_ff );
  $font_family = "body { font-family: {$custom_ff}; }";

  wp_add_inline_style( 'main-style', $font_family );

 }

}
add_action ( 'wp_enqueue_scripts', 'cd_customizer_font_set' );
