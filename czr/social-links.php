<?php
/**
 * The template for registering and displaying the social links
 *
 * @since 1.1.0
 * @package coldbox
 */

/**
 * Define supported social accounts
 *
 * @since 1.1.0
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
 * Register customzer setting for the social links
 *
 * @since 1.1.0
 * @param string $wp_customize Register customizations.
 */
function cd_czr_social_links( $wp_customize ) {

	$feed_url = esc_url_raw( get_bloginfo( 'rss2_url' ) );
	$feedly_url = esc_url_raw( 'https://cloud.feedly.com/#subscription/feed/' . get_bloginfo( 'rss2_url' ) );

	$wp_customize->add_setting( 'feed_url_info', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new CD_Custom_Content( $wp_customize, 'feed_url_info', array(
		'content' => sprintf( /* Translators: %s: The feed URL */ __( '<p>Your Feed URL is: </p>%s', 'coldbox' ), $feed_url ) . '<br>' . sprintf( /* Translators: %s: The feedly URL */ __( '<p>Your Feedly URL is: </p>%s', 'coldbox' ), $feedly_url ),
		'section' => 'social_links',
		'priority' => 1000,
	) ) );

	$wp_customize->add_section( 'social_links', array(
		'title' => __( 'Coldbox: Social Links', 'coldbox' ),
		'description' => __( 'Add your social account profiles here. Please enter the full URL.', 'coldbox' ),
		'priority' => 5,
	));

	$social_sites = cd_social_sites();

	foreach ( $social_sites as $social_site => $value ) {

		$label = ucfirst( $social_site );
		if ( 'google-plus-official' === $social_site ) {
			$label = 'Google+';
		} elseif ( 'rss' === $social_site ) {
			$label = __( 'RSS Feed', 'coldbox' );
		} elseif ( 'codepen' === $social_site ) {
			$label = 'CodePen';
		} elseif ( 'paypal' === $social_site ) {
			$label = 'PayPal';
		} elseif ( 'envelope' === $social_site ) {
			$label = __( 'Contact Form', 'coldbox' );
		} elseif ( 'bell' === $social_site ) {
			$label = __( 'Push Notification', 'coldbox' );
		} elseif ( strcasecmp( 'WordPress', $social_site ) === 0 ) {
			$label = 'WordPress';
		} elseif ( 'github' === $social_site ) {
			$label = 'GitHub';
		} elseif ( 'facebook-official' === $social_site ) {
			$label = 'Facebook';
		} elseif ( 'linkedin-square' === $social_site ) {
			$label = 'Linkedin';
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

	} // End foreach().
}
add_action( 'customize_register', 'cd_czr_social_links' );

/**
 * Check the links_on_author_box of the customizer.
 *
 * @since 1.1.0
 **/
function cd_is_links_on_author_box() {
	return get_theme_mod( 'links_on_author_box', true );
}

/**
 * Load Icomoon web font if feedly social link is set.
 *
 * @since 1.1.0
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
 * @since 1.1.0
 * @param string $class Custom class that you can set as a parameter.
 */
function cd_social_links( $class = null ) {

	// @param string $key social account name.
	// @param string $value social account profile URL user entered.
	// @param string $class class name for selecting a FontAwesome web icon.
	$social_sites = cd_social_sites();

	// Get the social account names and URLs.
	foreach ( $social_sites as $key => $value ) {
		if ( strlen( get_theme_mod( $key ) ) > 0 ) {
			$active_links[ $key ] = get_theme_mod( $key );
		}
	}

	if ( ! empty( $active_links ) ) { // If there is any registered URL.

		$count = count( $active_links );

		echo '<ul class="social-links has-' . absint( $count ) . ' ' . esc_attr( $class ) . ' ">';

		// $key has got the social account name, $value has got the URL
		foreach ( $active_links as $key => $value ) {
			if ( 'feedly' === $key ) {
				$class = 'icon-feedly';
			} else {
				$class = 'fa fa-' . $key;
			}
			$label = $key;
			if ( 'google-plus-official' === $key ) {
				$label = 'Google+';
			} elseif ( 'rss' === $key ) {
				$label = __( 'RSS Feed', 'coldbox' );
			} elseif ( 'codepen' === $key ) {
				$label = 'CodePen';
			} elseif ( 'paypal' === $key ) {
				$label = 'PayPal';
			} elseif ( 'envelope' === $key ) {
				$label = __( 'Contact Form', 'coldbox' );
			} elseif ( 'bell' === $key ) {
				$label = __( 'Push Notification', 'coldbox' );
			} elseif ( strcasecmp( 'WordPress', $key ) === 0 ) {
				$label = 'WordPress';
			} elseif ( 'github' === $key ) {
				$label = 'GitHub';
			} elseif ( 'facebook-official' === $key ) {
				$label = 'Facebook';
			} elseif ( 'linkedin-square' === $key ) {
				$label = 'Linkedin';
			} else {
				$label = ucfirst( $key );
			} ?>
			<li class="<?php echo esc_attr( $key ) . '-container'; ?>">
				<a class="<?php echo esc_attr( $key ); ?>" href="<?php echo esc_url( $value, array( 'http', 'https', 'mailto' ) ); ?>" title="<?php echo esc_attr( $label ); ?>" target="_blank">
					<i class="<?php echo esc_attr( $class ); ?>"></i>
				</a>
			</li>
			<?php
		} // End foreach().

		echo '</ul>';

	} // End if().

}

// Load the widget template.
get_template_part( 'czr/class-cd-social-links' );
