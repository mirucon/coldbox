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
    'twitter'              => 'cd_twitter_profile',
    'facebook-official'    => 'cd_facebook_profile',
    'google-plus-official' => 'cd_googleplus_profile',
    'linkedin-square'      => 'cd_linkedin_profile',
    'youtube'              => 'cd_youtube_profile',
    'tumblr'               => 'cd_tumblr_profile',
    'instagram'            => 'cd_instagram_profile',
    'codepen'              => 'cd_codepen_profile',
    'github'               => 'cd_github_profile',
    'wordpress'            => 'cd_wordpress_profile',
    'steam'                => 'cd_steam_profile',
    'foursquare'           => 'cd_foursquare_profile',
    'slack'                => 'cd_slack_profile',
    'skype'                => 'cd_skype_profile',
    'paypal'               => 'cd_paypal_profile',
    '500px'                => 'cd_500px_profile',
    'rss'                  => 'cd_rss_profile',
    'feedly'               => 'cd_feedly_profile',
    'envelope'             => 'cd_email_form_profile',
    'bell'                 => 'cd_push_profile',
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

  $feed_url = esc_url_raw( get_bloginfo( 'rss2_url' ) );
  $feedly_url = esc_url_raw( 'https://cloud.feedly.com/#subscription/feed/' . get_bloginfo( 'rss2_url' ) );

  $wp_customize->add_setting( 'feed_url_info', array( 'sanitize_callback'=>'cd_sanitize_text' ) );
  $wp_customize->add_control( new cd_Custom_Content( $wp_customize, 'feed_url_info', array(
    'content' => sprintf( /* Translators: %s: The feed URL */ __( '<p>Your Feed URL is: </p>%s', 'coldbox' ), $feed_url ) . '<br>' . sprintf( /* Translators: %s: The feedly URL */ __( '<p>Your Feedly URL is: </p>%s', 'coldbox' ), $feedly_url ),
    'section' => 'social_links',
    'priority' => 1000
  ) ) );



  $wp_customize->add_section( 'social_links', array(
    'title' => __( 'Coldbox: Social Links', 'coldbox' ),
    'description' => __( 'Add your social account profiles here. Please enter the full URL.', 'coldbox' ),
    'priority' => 5,
  ));

  $social_sites = cd_social_sites();

  foreach ( $social_sites as $social_site => $value ) {

    $label = ucfirst( $social_site );
    if ( $social_site == 'google-plus-official' ) {
      $label = 'Google+';
    } elseif ( $social_site == 'rss' ) {
      $label = __( 'RSS Feed', 'coldbox' );
    } elseif ( $social_site == 'codepen' ) {
      $label = 'CodePen';
    } elseif ( $social_site == 'paypal' ) {
      $label = 'PayPal';
    } elseif ( $social_site == 'envelope' ) {
      $label = __( 'Contact Form', 'coldbox' );
    } elseif ( $social_site == 'bell' ) {
      $label = __( 'Push Notification', 'coldbox' );
    } elseif ( $social_site == 'wordpress' ) {
      $label = 'WordPress';
    } elseif ( $social_site == 'github' ) {
      $label = 'GitHub';
    } elseif ( $social_site == 'facebook-official' ) {
      $label = 'Facebook';
    }

    $priority = 5;

    $wp_customize->add_setting( $social_site, array(
      'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control( $social_site, array(
      'type'    => 'url',
      'label'   => $label,
      'section' => 'social_links',
      'priority' => $priority,
    ));

    $priority++;

  }

  $wp_customize->add_setting( 'links_on_author_box', array(
    'sanitize_callback' => 'cd_sanitize_checkbox',
  ));

  $wp_customize->add_control( 'links_on_author_box', array(
    'type'    => 'checkbox',
    'label'   => __( 'Show the social links on the author box', 'coldbox' ),
    'section' => 'social_links',
    'priority' => '1',
  ));

}
add_action( 'customize_register', 'cd_czr_social_links' );

function cd_is_links_on_author_box() { return get_theme_mod( 'links_on_author_box', true ); }

/**
* Load Icomoon web font if feedly social link is set
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
* Output the social links got from the theme customizer
*
* @since 1.0.3
* @param string $key social account name
* @param string $value social account profile URL user entered
* @param string $class class name for selecting a FontAwesome web icon
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
        $class = 'fa fa-' . $key;
      }
      $label = $key;
      if ( $key == 'google-plus-official' ) {
        $label = 'Google+';
      } elseif ( $key == 'rss' ) {
        $label = __( 'RSS Feed', 'coldbox' );
      } elseif ( $key == 'codepen' ) {
        $label = 'CodePen';
      } elseif ( $key == 'paypal' ) {
        $label = 'PayPal';
      } elseif ( $key == 'envelope' ) {
        $label = __( 'Contact Form', 'coldbox' );
      } elseif ( $key == 'bell' ) {
        $label = __( 'Push Notification', 'coldbox' );
      } elseif ( $key == 'wordpress' ) {
        $label = 'WordPress';
      } elseif ( $key == 'github' ) {
        $label = 'GitHub';
      } elseif ( $key == 'facebook-official' ) {
        $label = 'Facebook';
      } elseif ( $key == 'linkedin-square' ) {
        $label = 'Linkedin';
      } else {
        $label = ucfirst( $key );
      } ?>
      <li class="<?php echo esc_attr( $key ) . '-container' ?>">
        <a class="<?php echo esc_attr( $key ); ?>" href="<?php echo esc_url( $value, array( 'http', 'https', 'mailto' ) ); ?>" title="<?php echo esc_attr( $label ); ?>" target="_blank">
          <i class="<?php echo esc_attr( $class ); ?>"></i>
        </a>
      </li>
      <?php
    }

    echo "</ul>";

  }

}
