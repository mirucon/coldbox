<?php
/**
* Social Links Option
*
* @since 1.0.3
*/


/**
* Define supported social accounts
*
* @since 1.0.3
*/
function cd_social_sites() {
  $social_sites = array(
    'twitter'       => 'cd_twitter_profile',
    'facebook'      => 'cd_facebook_profile',
    'google-plus'   => 'cd_googleplus_profile',
    'linkedin'      => 'cd_linkedin_profile',
    'youtube'       => 'cd_youtube_profile',
    'tumblr'        => 'cd_tumblr_profile',
    'instagram'     => 'cd_instagram_profile',
    '500px'         => 'cd_500px_profile',
    'codepen'       => 'cd_codepen_profile',
    'github'        => 'cd_github_profile',
    'steam'         => 'cd_steam_profile',
    'foursquare'    => 'cd_foursquare_profile',
    'slack'         => 'cd_slack_profile',
    'skype'         => 'cd_skype_profile',
    'paypal'        => 'cd_paypal_profile',
    'rss'           => 'cd_rss_profile',
    'feedly'        => 'cd_feedly_profile',
    'email-form'    => 'cd_email_form_profile',
    'bell'          => 'cd_push_profile',
  );
  return apply_filters( 'cd_social_sites', $social_sites );
}


/**
* Register customzer setting for social links
*
* @since 1.0.3
*
*/
function cd_czr_social_links( $wp_customize ) {

  $wp_customize->add_section( 'social_links', array(
    'title' => __( 'Coldbox: Social Links', 'coldbox' ),
    'description' => __( 'Add your social account profiles here. Please enter the full URL.', 'coldbox' ),
    'priority' => 5,
  ));

  $social_sites = cd_social_sites();

  foreach ( $social_sites as $social_site => $value ) {

    $label = ucfirst( $social_site );
    if ( $social_site == 'google-plus' ) {
      $label = 'Google+';
    } elseif ( $social_site == 'rss' ) {
      $label = 'RSS';
    } elseif ( $social_site == 'codepen' ) {
      $label = 'CodePen';
    } elseif ( $social_site == 'paypal' ) {
      $label = 'PayPal';
    } elseif ( $social_site == 'email-form' ) {
      $label = 'Contact Form';
    } elseif ( $social_site == 'bell' ) {
      $label = 'Push Notification';
    }

    $wp_customize->add_setting( $social_site, array(
      'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control( $social_site, array(
      'type'    => 'url',
      'label'   => $label,
      'section' => 'social_links',
    ));

  }
}
add_action( 'customize_register', 'cd_czr_social_links' );


/**
 * Load Icomoon web font if feedly social link is used
 *
 * @since 1.0.3
 */
function load_icomoon() {
  if ( strlen( get_theme_mod( 'feedly', '' ) ) ) {
    wp_enqueue_style( 'icomoon', get_template_directory_uri() . '/fonts/icomoon/icomoon.min.css' );
  }
}
add_action( 'wp_enqueue_scripts', 'load_icomoon' );


/**
* Output the social links that got from customizer
*
* @since 1.0.3
* @param string $key social account name
* @param string $value social account profile URL user entered
*/

function cd_social_links() {

  $social_sites = cd_social_sites();

  // Get the social account names and URLs
  foreach ( $social_sites as $key => $value ) {
    if ( strlen( get_theme_mod( $key ) ) > 0 ) {
      $active_links[$key] = get_theme_mod( $key );
    }
  }

  if ( !empty( $active_links ) ) { // If there is any registered URL

    echo '<ul class="social-links">';

    // $key has got the social account name, $value has got the URL
    foreach ( $active_links as $key => $value ) {
      if ( $key == 'feedly' ) {
        $class = 'icon-feedly';
      } else {
        $class = 'fa fa-'.$key;
      } ?>
      <li class="<?php echo esc_attr( $key ).'-container' ?>">
        <a class="<?php echo esc_attr( $key ); ?>" href="<?php echo esc_url( $value ); ?>" target="_blank">
          <i class="<?php echo esc_attr( $class ); ?>" title="<?php echo esc_attr( $key ); ?>"></i>
        </a>
      </li>
      <?php
    }

    echo "</ul>";

  }

}
