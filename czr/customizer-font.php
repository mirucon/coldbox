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

  ?>
  <style id="font_set" type="text/css">
  <?php if ( $font == 'opensans' ) : ?>
  body { font-family: "Open Sans", Arial, sans-serif }
  <?php
  elseif ( $font == 'lato' ) : ?>
  body { font-family: Lato, Arial, sans-serif }
  <?php
  elseif ( $font == 'roboto' ) : ?>
  body { font-family: Roboto, Arial, sans-serif }
  <?php
  elseif ( $font == 'robotocondensed' ) : ?>
  body { font-family: "Roboto Condensed", Arial, sans-serif }
  <?php
  elseif ( $font == 'ubuntu' ) : ?>
  body { font-family: Ubuntu, Arial, sans-serif }
  <?php
  elseif ( $font == 'raleway' ) : ?>
  body { font-family: Raleway, Arial, sans-serif }
  <?php
  elseif ( $font == 'sourcesanspro' ) : ?>
  body { font-family: "Source Sans Pro", Arial, sans-serif }
  <?php
  elseif ( $font == 'josefinsans' ) : ?>
  body { font-family: "Josefin Sans", Arial, sans-serif }
  <?php
  elseif ( $font == 'ptsans' ) : ?>
  body { font-family: "PT Sans", Arial, sans-serif }
  <?php
  elseif ( $font == 'lora' ) : ?>
  body { font-family: lora, Georgia, serif; }
  <?php
  elseif ( $font == 'robotoslab' ) : ?>
  body { font-family: "Roboto Slab", Georgia, serif; }
  <?php
  elseif ( $font == 'arial' ) : ?>
  body { font-family: Arial, sans-serif }
  <?php
  elseif ( $font == 'helvetica' ) : ?>
  body { font-family: Helvetica, sans-serif; }
  <?php
  elseif ( $font == 'verdana' ) : ?>
  body { font-family: Verdana, sans-serif; }
  <?php
  elseif ( $font == 'tahoma' ) : ?>
  body { font-family: Tahoma, sans-serif; }
  <?php endif; ?>
  </style>
  <?php


 }
}
add_action ( 'wp_head', 'cd_customizer_font_set' );
