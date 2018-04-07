<?php
/**
 * Register customizations
 *
 * @since 1.0.0
 * @package Coldbox
 */

/**
 * Enqueue customizer CSS
 *
 * @since 1.0.0
 */
function cd_czr_style() {
	wp_enqueue_style( 'cd-czr-style', get_theme_file_uri( 'assets/css/czr-style.css' ), array(), '1.5.1' );
	// phpcs:disable
	// wp_enqueue_script( 'cd-czr-scripts', get_theme_file_uri( 'assets/js/czr-scripts.js' ), array(), '1.5.1' );
	// phpcs:enable
}
add_action( 'customize_controls_enqueue_scripts', 'cd_czr_style' );

/*
 * -------------------------------------------------------------------------
 *  Theme Customizer
 * -------------------------------------------------------------------------
 */
if ( ! function_exists( 'cd_customize_register' ) ) {
	/**
	 * Register customizer settings.
	 *
	 * @since 1.0.0
	 * @param WP_Customize_Manager $wp_customize the customizations registered.
	 */
	function cd_customize_register( $wp_customize ) {

		/**
		 * Define the sanitization function for checkboxes.
		 *
		 * @since 1.0.0
		 * @param bool $checked The strings that will be checked.
		 * @return bool
		 */
		function cd_sanitize_checkbox( $checked ) {
			return ( ( isset( $checked ) && true === $checked ) ? true : false );
		}
		/**
		 * Define the sanitization function for radio button / select boxes.
		 *
		 * @since 1.0.0
		 * @param string $input The strings that will be checked.
		 * @param string $setting The possible choices.
		 * @return string
		 */
		function cd_sanitize_radio( $input, $setting ) {
			$input   = sanitize_key( $input );
			$choices = $setting->manager->get_control( $setting->id )->choices;
			return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
		}
		/**
		 * Define the sanitization function for text.
		 *
		 * @since 1.0.0
		 * @param string $text The strings that will be checked.
		 * @return string
		 */
		function cd_sanitize_text( $text ) {
			return sanitize_text_field( $text );
		}

		// Load the file to use custom content.
		require_once get_theme_file_path( 'parts/czr/class-cd-custom-content.php' );

		/*
		 * -------------------------------------------------------------------------
		 *  Global Settings
		 * -------------------------------------------------------------------------
		 */
		$wp_customize->add_section(
			'global', array(
				'title'    => __( 'Coldbox: Global Settings', 'coldbox' ),
				'priority' => 1,
			)
		);
		// Sidebar Position.
		$wp_customize->add_setting(
			'sidebar_position', array(
				'default'           => 'right',
				'sanitize_callback' => 'cd_sanitize_radio',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'sidebar_position', array(
					'label'    => __( 'Sidebar Position', 'coldbox' ),
					'section'  => 'global',
					'priority' => 1,
					'type'     => 'radio',
					'choices'  => array(
						'right'  => __( 'Right Sidebar (default)', 'coldbox' ),
						'left'   => __( 'Left Sidebar', 'coldbox' ),
						'bottom' => __( 'Bottom Sidebar', 'coldbox' ),
						'hide'   => __( 'Hide Sidebar', 'coldbox' ),
					),
				)
			)
		);
		// Container Width.
		$wp_customize->add_setting(
			'container_width', array(
				'default'           => '1140',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'container_width', array(
					'label'       => __( 'Site Max-Width', 'coldbox' ),
					'section'     => 'global',
					'type'        => 'number',
					'input_attrs' => array(
						'step' => '1',
						'min'  => '800',
						'max'  => '1980',
					),
				)
			)
		);
		// Global Font Select.
		$wp_customize->add_setting(
			'global_font', array(
				'default'           => 'sourcesanspro',
				'sanitize_callback' => 'cd_sanitize_radio',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'global_font', array(
					'label'   => __( 'Global Font Selecter', 'coldbox' ),
					'section' => 'global',
					'type'    => 'select',
					'choices' => array(
						'sourcesanspro'   => 'Source Sans Pro',
						'opensans'        => 'Open Sans',
						'lato'            => 'Lato',
						'roboto'          => 'Roboto',
						'robotocondensed' => 'Roboto Condensed',
						'ubuntu'          => 'Ubuntu',
						'raleway'         => 'Raleway',
						'josefinsans'     => 'Josefin Sans',
						'ptsans'          => 'PT Sans',
						'lora'            => 'Lora',
						'robotoslab'      => 'Roboto Slab',
						'arial'           => 'Arial ' . esc_html__( '(Local)', 'coldbox' ), /* translators: Local font e.g. Arial or Helvetica */
						'helvetica'       => 'Helvetica ' . esc_html__( '(Local)', 'coldbox' ), /* translators: Local font e.g. Arial or Helvetica */
						'verdana'         => 'Verdana ' . esc_html__( '(Local)', 'coldbox' ), /* translators: Local font e.g. Arial or Helvetica */
						'tahoma'          => 'Tahoma ' . esc_html__( '(Local)', 'coldbox' ), /* translators: Local font e.g. Arial or Helvetica */
					),
				)
			)
		);
		$wp_customize->add_setting(
			'custom_font', array(
				'default'           => '[font], -apple-system, BlinkMacSystemFont, \'Helvetica Neue\', Arial, sans-serif',
				'sanitize_callback' => 'cd_sanitize_text',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_control(
				$wp_customize, 'custom_font', array(
					'label'       => __( 'Custom Font-Family Value', 'coldbox' ),
					'description' => sprintf( /* Translators: %s: [font] (shortcode) */ __( '"%s" will be replaced with the font you\'ve chosen above', 'coldbox' ), '[font]' ),
					'section'     => 'global',
					'type'        => 'textarea',
				)
			)
		);
		$wp_customize->add_setting(
			'global_font_size_pc', array(
				'default'           => 17,
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_control(
				$wp_customize, 'global_font_size_pc', array(
					'label'       => __( 'Global Font Size for PC', 'coldbox' ),
					'section'     => 'global',
					'type'        => 'number',
					'input_attrs' => array(
						'step' => '1',
						'min'  => '10',
						'max'  => '32',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'global_font_size_mobile', array(
				'default'           => 16,
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_control(
				$wp_customize, 'global_font_size_mobile', array(
					'label'       => __( 'Global Font Size for Mobile', 'coldbox' ),
					'section'     => 'global',
					'type'        => 'number',
					'input_attrs' => array(
						'step' => '1',
						'min'  => '10',
						'max'  => '32',
					),
				)
			)
		);
		// Show Coldbox button on the admin bar.
		$wp_customize->add_setting(
			'theme_button', array(
				'default'           => 'true',
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'theme_button', array(
					'label'   => __( 'Show "Coldbox" button on the admin bar', 'coldbox' ),
					'section' => 'global',
					'type'    => 'checkbox',
				)
			)
		);
		$wp_customize->add_setting(
			'minified_css', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_control(
				$wp_customize, 'minified_css', array(
					'label'       => __( 'Use minified CSS file', 'coldbox' ),
					'description' => __( 'The theme will load minified CSS files when this is on. Use of minified css files improves loading speed of your website. Highly recommended to use this option unless you directly modify the theme\'s stylesheet (which is not recommended).', 'coldbox' ),
					'section'     => 'global',
					'type'        => 'checkbox',
				)
			)
		);
		$wp_customize->add_setting(
			'minified_js', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_control(
				$wp_customize, 'minified_js', array(
					'label'       => __( 'Use minified JS files', 'coldbox' ),
					'description' => __( 'The theme will load minified JS files when this is on. Use of minified JS files improves loading speed of your website. Highly recommended to use this option unless you directly modify the theme\'s stylesheet (which is not recommended).', 'coldbox' ),
					'section'     => 'global',
					'type'        => 'checkbox',
				)
			)
		);
		// Use highlight.js.
		$wp_customize->add_setting(
			'does_use_hljs', array(
				'default'           => false,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'does_use_hljs', array(
					'label'       => __( 'Use highlight.js', 'coldbox' ),
					'description' => __( 'The package contains 23 common languages.', 'coldbox' ),
					'section'     => 'global',
					'type'        => 'checkbox',
				)
			)
		);
		$wp_customize->add_setting(
			'use_hljs_web_pack', array(
				'default'           => false,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'use_hljs_web_pack', array(
					'label'       => __( 'Use highlight.js Web Package', 'coldbox' ),
					'description' => __( 'This selection of highlight.js contains the languages often used for web development.', 'coldbox' ),
					'section'     => 'global',
					'type'        => 'checkbox',
				)
			)
		);
		// Use concatenated JS files.
		$wp_customize->add_setting(
			'concat_js', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'concat_js', array(
					'label'       => __( 'Use concatenated JS files', 'coldbox' ),
					'description' => __( 'Use of concatenated JS files makes loading faster for the sites do not support HTTP/2. Recommended to set this ON if your website is not using https connection, or you are not sure whether this site supports HTTP/2.', 'coldbox' ),
					'section'     => 'global',
					'type'        => 'checkbox',
				)
			)
		);

		/*
		 * -------------------------------------------------------------------------
		 *  Header Settings
		 * -------------------------------------------------------------------------
		 */
		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		$wp_customize->get_control( 'custom_logo' )->section       = 'header';
		$wp_customize->get_control( 'custom_logo' )->description   = sprintf(
			/* translators: 1: Start of <a> tag, 2: The end of <a> tag. */
			__( 'Use the %1$s "Display Site Title" %2$s option to hide site title.', 'coldbox' ),
			'<a href="javascript:wp.customize.control( \'site_title\' ).focus();document.getElementById(\'customize-control-site_title\').classList.add(\'focused\');">',
			'</a>'
		);

		$wp_customize->add_section(
			'header', array(
				'title'    => __( 'Coldbox: Header Settings', 'coldbox' ),
				'priority' => 1,
			)
		);

		// Logo Width.
		$wp_customize->add_setting(
			'logo_width', array(
				'default'           => '230',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'logo_width', array(
					'label'   => __( 'Custom Logo Width', 'coldbox' ),
					'section' => 'header',
					'type'    => 'number',
				)
			)
		);

		// Site Description.
		$wp_customize->add_setting(
			'site_title', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'site_title', array(
					'label'       => __( 'Display Site Title', 'coldbox' ),
					'description' => sprintf(
						'%1$s' . __( 'Your logo will be still shown when this is unchecked.', 'coldbox' ) . '%2$s',
						'<span onClick="document.getElementById(\'customize-control-site_title\').classList.remove(\'focused\');">',
						'</span>'
					),
					'section'     => 'header',
					'type'        => 'checkbox',
				)
			)
		);
		// Site Description.
		$wp_customize->add_setting(
			'site_desc', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'site_desc', array(
					'label'   => __( 'Display Site Description', 'coldbox' ),
					'section' => 'header',
					'type'    => 'checkbox',
				)
			)
		);
		// Header Direction.
		$wp_customize->add_setting(
			'header_direction', array(
				'default'           => 'column',
				'sanitize_callback' => 'cd_sanitize_radio',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'header_direction', array(
					'label'   => __( 'Header and Menu Direction', 'coldbox' ),
					'section' => 'header',
					'type'    => 'radio',
					'choices' => array(
						'column' => __( 'Vertical (column)', 'coldbox' ),
						'row'    => __( 'Horizontal (row)', 'coldbox' ),
					),
				)
			)
		);
		// Sticky Header.
		$wp_customize->add_setting(
			'header_sticky', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'header_sticky', array(
					'label'       => __( 'Make Header Sticky', 'coldbox' ),
					'description' => __( 'Only nav menu will be sticky if you\'ve selected "Vertical" direction, or whole header will be sticky with narrower padding if "Horizontal" direction is selected.', 'coldbox' ),
					'section'     => 'header',
					'type'        => 'checkbox',
				)
			)
		);
		// Custom Header Padding.
		$wp_customize->add_setting(
			'header_padding', array(
				'default'           => '30',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'header_padding', array(
					'label'   => __( 'Custom Header Padding', 'coldbox' ),
					'section' => 'header',
					'type'    => 'number',
				)
			)
		);
		// Use narrower padding when scrolling.
		$wp_customize->add_setting(
			'use_narrower_padding', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'use_narrower_padding', array(
					'label'       => __( 'Use Narrower Padding when Scrolling', 'coldbox' ),
					'description' => __( 'This works only when Horizontal menu direction selected. If this is off, the header won\'t narrower when scrolling the window. Recommended to set this off when you set the value of Custom Header Padding above narrower than 15px.', 'coldbox' ),
					'section'     => 'header',
					'type'        => 'checkbox',
				)
			)
		);

		/*
		 * -------------------------------------------------------------------------
		 *  Index settings
		 * -------------------------------------------------------------------------
		 */
		$wp_customize->add_section(
			'index', array(
				'title'    => __( 'Coldbox: Archive Pages Settings', 'coldbox' ),
				'priority' => 2,
			)
		);
		// Front page style.
		$wp_customize->add_setting(
			'index_style', array(
				'default'           => 'grid',
				'sanitize_callback' => 'cd_sanitize_radio',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'index_style', array(
					'label'    => __( 'Front Page Style', 'coldbox' ),
					'section'  => 'index',
					'priority' => 1,
					'type'     => 'radio',
					'choices'  => array(
						'grid'     => __( 'Grid Style (default)', 'coldbox' ),
						'standard' => __( 'Standard Style', 'coldbox' ),
					),
				)
			)
		);
		// Archive page style.
		$wp_customize->add_setting(
			'archive_style', array(
				'default'           => 'grid',
				'sanitize_callback' => 'cd_sanitize_radio',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'archive_style', array(
					'label'    => __( 'Archive Page Style', 'coldbox' ),
					'section'  => 'index',
					'priority' => 2,
					'type'     => 'radio',
					'choices'  => array(
						'grid'     => __( 'Grid Style (default)', 'coldbox' ),
						'standard' => __( 'Standard Style', 'coldbox' ),
					),
				)
			)
		);
		// Grid Columns.
		$wp_customize->add_setting(
			'grid_columns', array(
				'default'           => 2,
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'grid_columns', array(
					'label'    => __( 'Grid Columns for Desktop & Tablet', 'coldbox' ),
					'section'  => 'index',
					'priority' => 2,
					'type'     => 'number',
				)
			)
		);
		// Grid Columns for mobile.
		$wp_customize->add_setting(
			'grid_columns_mobile', array(
				'default'           => 1,
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'grid_columns_mobile', array(
					'label'    => __( 'Grid Columns for Mobile', 'coldbox' ),
					'section'  => 'index',
					'priority' => 2,
					'type'     => 'number',
				)
			)
		);
		// Excerpt Length Setting.
		$wp_customize->add_setting(
			'excerpt_length', array(
				'default'           => '60',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'excerpt_length', array(
					'label'       => __( 'Excerpt Length', 'coldbox' ),
					'section'     => 'index',
					'type'        => 'number',
					'input_attrs' => array(
						'min' => '0',
					),
				)
			)
		);
		$wp_customize->add_setting(
			'excerpt_ending', array(
				'default'           => '...',
				'sanitize_callback' => 'cd_sanitize_text',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'excerpt_ending', array(
					'label'   => __( 'Excerpt Ending', 'coldbox' ),
					'section' => 'index',
					'type'    => 'text',
				)
			)
		);
		// Placefoler Setting.
		$wp_customize->add_setting(
			'index_placefolder_image', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'index_placefolder_image', array(
					'label'   => __( 'Use Placefolder Images when no Featured Image', 'coldbox' ),
					'section' => 'index',
					'type'    => 'checkbox',
				)
			)
		);
		// Meta Settings.
		$wp_customize->add_setting(
			'index_meta_date', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'index_meta_date', array(
					'label'   => __( 'Display Post Date on Grid', 'coldbox' ),
					'section' => 'index',
					'type'    => 'checkbox',
				)
			)
		);
		$wp_customize->add_setting(
			'index_meta_cat', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'index_meta_cat', array(
					'label'   => __( 'Display Categories on Grid', 'coldbox' ),
					'section' => 'index',
					'type'    => 'checkbox',
				)
			)
		);
		$wp_customize->add_setting(
			'index_meta_comment', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'index_meta_comment', array(
					'label'   => __( 'Display Comments Count on Grid', 'coldbox' ),
					'section' => 'index',
					'type'    => 'checkbox',
				)
			)
		);

		/*
		 *------------------------------------------------------------------------- *
		 *  Single Settings
		 * -------------------------------------------------------------------------
		 */
		$wp_customize->add_section(
			'single', array(
				'title'    => __( 'Coldbox: Single Posts Settings', 'coldbox' ),
				'priority' => 3,
			)
		);

		/*
		 *  Add decorations to header Tags
		 * --------------------------------------------------
		 */
		$wp_customize->add_setting(
			'single_content', array(
				'sanitize_callback' => 'cd_sanitize_text',
			)
		);
		$wp_customize->add_control(
			new CD_Custom_Content(
				$wp_customize, 'single_content', array(
					'content' => '<h3 class="czr-heading first">' . __( 'Settings for Content', 'coldbox' ) . '</h3>',
					'section' => 'single',
				)
			)
		);
		$wp_customize->add_setting(
			'decorate_htags', array(
				'default'           => false,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'decorate_htags', array(
					'label'   => __( 'Add Decoration to H2-H5 Tags.', 'coldbox' ),
					'section' => 'single',
					'type'    => 'checkbox',
				)
			)
		);

		/*
		 * Single Meta Settings
		 * --------------------------------------------------
		*/
		$wp_customize->add_setting(
			'single_meta', array(
				'sanitize_callback' => 'cd_sanitize_text',
			)
		);
		$wp_customize->add_control(
			new CD_Custom_Content(
				$wp_customize, 'single_meta', array(
					'content' => '<h3 class="czr-heading">' . __( 'Settings for Metas', 'coldbox' ) . '</h3>',
					'section' => 'single',
				)
			)
		);
		// Date.
		$wp_customize->add_setting(
			'single_meta_date', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'single_meta_date', array(
					'label'   => __( 'Display Post Dates', 'coldbox' ),
					'section' => 'single',
					'type'    => 'checkbox',
				)
			)
		);
		// Last modified date.
		$wp_customize->add_setting(
			'single_meta_modified_date', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'single_meta_modified_date', array(
					'label'   => __( 'Display the last Modified Dates', 'coldbox' ),
					'section' => 'single',
					'type'    => 'checkbox',
				)
			)
		);
		// Category.
		$wp_customize->add_setting(
			'single_meta_cat', array(
				'default'           => false,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'single_meta_cat', array(
					'label'       => __( 'Display Post Categories', 'coldbox' ),
					'section'     => 'single',
					'type'        => 'checkbox',
					'description' => __( 'Note: Categories are already shown on the breadcrum.', 'coldbox' ),
				)
			)
		);
		// Author.
		$wp_customize->add_setting(
			'single_meta_author', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'single_meta_author', array(
					'label'   => __( 'Display Post Author', 'coldbox' ),
					'section' => 'single',
					'type'    => 'checkbox',
				)
			)
		);
		// Comment Count.
		$wp_customize->add_setting(
			'single_meta_com', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'single_meta_com', array(
					'label'   => __( 'Display Comments Count', 'coldbox' ),
					'section' => 'single',
					'type'    => 'checkbox',
				)
			)
		);
		// Bottom Tag.
		$wp_customize->add_setting(
			'single_meta_btm_tag', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'single_meta_btm_tag', array(
					'label'   => __( 'Display Post Tags on Bottom', 'coldbox' ),
					'section' => 'single',
					'type'    => 'checkbox',
				)
			)
		);
		// Bottom Category.
		$wp_customize->add_setting(
			'single_meta_btm_cat', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'single_meta_btm_cat', array(
					'label'   => __( 'Display Post Categories on Bottom', 'coldbox' ),
					'section' => 'single',
					'type'    => 'checkbox',
				)
			)
		);
		// Author Box.
		$wp_customize->add_setting(
			'single_author_box', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			'single_author_box', array(
				'label'   => __( 'Display Author Box', 'coldbox' ),
				'section' => 'single',
				'type'    => 'checkbox',
			)
		);
		// Comment.
		$wp_customize->add_setting(
			'single_comment', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'single_comment', array(
					'label'   => __( 'Display Comments', 'coldbox' ),
					'section' => 'single',
					'type'    => 'checkbox',
				)
			)
		);
		// Post Nav.
		$wp_customize->add_setting(
			'single_post_nav', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'single_post_nav', array(
					'label'   => __( 'Display Post Navigation', 'coldbox' ),
					'section' => 'single',
					'type'    => 'checkbox',
				)
			)
		);

		/*
		 * Related Posts Settings
		 * --------------------------------------------------
		 */
		$wp_customize->add_setting(
			'single_related', array(
				'sanitize_callback' => 'cd_sanitize_text',
			)
		);
		$wp_customize->add_control(
			new CD_Custom_Content(
				$wp_customize, 'single_related', array(
					'content' => '<h3 class="czr-heading">' . __( 'Settings for Related Posts', 'coldbox' ) . '</h3>',
					'section' => 'single',
				)
			)
		);
		// Related Post.
		$wp_customize->add_setting(
			'single_related_posts', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'single_related_posts', array(
					'label'   => __( 'Display Related Posts', 'coldbox' ),
					'section' => 'single',
					'type'    => 'checkbox',
				)
			)
		);
		// Max Article.
		$wp_customize->add_setting(
			'single_related_max', array(
				'default'           => 6,
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'single_related_max', array(
					'label'       => __( 'Related Post - Max Articles', 'coldbox' ),
					'section'     => 'single',
					'type'        => 'number',
					'input_attrs' => array(
						'min' => '1',
					),
				)
			)
		);
		// Max Article.
		$wp_customize->add_setting(
			'single_related_col', array(
				'default'           => 3,
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'single_related_col', array(
					'label'       => __( 'Related Post - Columns', 'coldbox' ),
					'section'     => 'single',
					'type'        => 'number',
					'input_attrs' => array(
						'min' => '1',
					),
				)
			)
		);

		/*
		 * ------------------------------------------------------------------------- *
		 *  Static Pages Settings
		 * -------------------------------------------------------------------------
		 */
		$wp_customize->add_section(
			'pages', array(
				'title'    => __( 'Coldbox: Static Pages Settings', 'coldbox' ),
				'priority' => 3,
			)
		);

		/*
		 * Pages Meta Settings
		 * --------------------------------------------------
		 */

		// Data.
		$wp_customize->add_setting(
			'pages_meta_date', array(
				'default'           => false,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'pages_meta_date', array(
					'label'   => __( 'Display Post Dates', 'coldbox' ),
					'section' => 'pages',
					'type'    => 'checkbox',
				)
			)
		);
		// Author.
		$wp_customize->add_setting(
			'pages_meta_author', array(
				'default'           => false,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'pages_meta_author', array(
					'label'   => __( 'Display Author Names', 'coldbox' ),
					'section' => 'pages',
					'type'    => 'checkbox',
				)
			)
		);
		// Comments count.
		$wp_customize->add_setting(
			'pages_meta_comments_count', array(
				'default'           => false,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'pages_meta_comments_count', array(
					'label'       => __( 'Display Comments Counts', 'coldbox' ),
					'description' => __( 'It will be shown only when comments are opened and shown, and this option is checked.', 'coldbox' ),
					'section'     => 'pages',
					'type'        => 'checkbox',
				)
			)
		);

		/*
		 * ------------------------------------------------------------------------- *
		 *  Footer Settings
		 * -------------------------------------------------------------------------
		 */
		$wp_customize->add_section(
			'footer', array(
				'title'    => __( 'Coldbox: Footer Settings', 'coldbox' ),
				'priority' => 4,
			)
		);
		$wp_customize->add_setting(
			'theme_credit', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
				'priority'          => 5,
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'theme_credit', array(
					'label'   => __( 'Display Theme Credit', 'coldbox' ),
					'section' => 'footer',
					'type'    => 'checkbox',
				)
			)
		);
		$wp_customize->add_setting(
			'credit_text', array(
				'default'           => '©[year] <a href="[url]">[name]</a>',
				'sanitize_callback' => 'wp_kses_post',
				'priority'          => 1,
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'credit_text', array(
					'label'       => __( 'Edit the Credit', 'coldbox' ),
					'description' => sprintf( /* Translators: %s: HTML Tags. */ __( 'This will be displayed in your footer area. You can use the following HTML tags: %s.<br/> Also there are some shortcodes you can use: <br/> [year] -> Displays this year, <br/> [url] -> Displays site URL, <br/> [name] -> Displays site name.', 'coldbox' ), '&lt;a&gt;, &lt;p&gt;, &lt;br&gt;, &lt;b&gt;, &lt;strong&gt; &lt;small&gt;' ),
					'section'     => 'footer',
					'type'        => 'textarea',
				)
			)
		);
		$wp_customize->add_setting(
			'theme_credit_text', array(
				'default'           => __( 'Coldbox WordPress theme by', 'coldbox' ) . ' <a href="' . esc_url( __( 'https://miruc.co/', 'coldbox' ) ) . '">' . __( 'Mirucon', 'coldbox' ) . '</a>',
				'sanitize_callback' => 'wp_kses_post',
				'priority'          => 10,
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'theme_credit_text', array(
					'label'       => __( 'Edit the Theme Credit', 'coldbox' ),
					'description' => sprintf( /* Translators: %s: HTML Tags. */ __( 'It will be displayed only when the "Display Theme Credit" option is checked. You can use the following HTML tags: %s.', 'coldbox' ), '&lt;a&gt;, &lt;p&gt;, &lt;br&gt;, &lt;b&gt;, &lt;strong&gt; &lt;small&gt;' ),
					'section'     => 'footer',
					'type'        => 'textarea',
				)
			)
		);

		/*
		 * ------------------------------------------------------------------------- *
		 *  Colors
		 * -------------------------------------------------------------------------
		 */

		// Link Color.
		$wp_customize->add_setting(
			'link_color', array(
				'default'           => '#00619f',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, 'link_color', array(
					'label'    => __( 'Primary Color', 'coldbox' ),
					'section'  => 'colors',
					'settings' => 'link_color',
					'priority' => 10,
				)
			)
		);
		// Hover Link Color.
		$wp_customize->add_setting(
			'link_hover_color', array(
				'default'           => '#2e4453',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, 'link_hover_color', array(
					'label'    => __( 'Secondary Color', 'coldbox' ),
					'section'  => 'colors',
					'settings' => 'link_hover_color',
					'priority' => 20,
				)
			)
		);
		// Title Box Color.
		$wp_customize->add_setting(
			'title_box_color', array(
				'default'           => '#f8f8f8',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, 'title_box_color', array(
					'label'    => __( 'Title Box Background Color', 'coldbox' ),
					'section'  => 'colors',
					'settings' => 'title_box_color',
					'priority' => 122,
				)
			)
		);
		// Content Wrapper Color.
		$wp_customize->add_setting(
			'content_wrapper_color', array(
				'default'           => '#fafafa',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, 'content_wrapper_color', array(
					'label'    => __( 'Content Wrapper Background Color', 'coldbox' ),
					'section'  => 'colors',
					'settings' => 'content_wrapper_color',
					'priority' => 124,
				)
			)
		);
		// Sidebar Wrapper Color.
		$wp_customize->add_setting(
			'sidebar_wrapper_color', array(
				'default'           => '#fafafa',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, 'sidebar_wrapper_color', array(
					'label'    => __( 'Sidebar Wrapper Background Color', 'coldbox' ),
					'section'  => 'colors',
					'settings' => 'sidebar_wrapper_color',
					'priority' => 126,
				)
			)
		);
		// Header Background Color.
		$wp_customize->add_setting(
			'header_color', array(
				'default'           => '#ffffff',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, 'header_color', array(
					'label'    => __( 'Header Background Color', 'coldbox' ),
					'section'  => 'colors',
					'settings' => 'header_color',
					'priority' => 30,
				)
			)
		);
		// Header Menu Background Color for Mobile devices.
		$wp_customize->add_setting(
			'header_menu_background', array(
				'default'           => '#51575d',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, 'header_menu_background', array(
					'label'    => __( 'Header Menu Background Color for Mobile', 'coldbox' ),
					'section'  => 'colors',
					'priority' => 51,
				)
			)
		);
		// Footer Background Color.
		$wp_customize->add_setting(
			'footer_color', array(
				'default'           => '#44463b',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, 'footer_color', array(
					'label'    => __( 'Footer Background Color', 'coldbox' ),
					'section'  => 'colors',
					'settings' => 'footer_color',
					'priority' => 100,
				)
			)
		);
		// Footer Menu Background Color.
		$wp_customize->add_setting(
			'footer_menu_color', array(
				'default'           => '#dddddd',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, 'footer_menu_color', array(
					'label'    => __( 'Footer Menu Background Color', 'coldbox' ),
					'section'  => 'colors',
					'settings' => 'footer_color',
					'priority' => 100,
				)
			)
		);
		$wp_customize->get_setting( 'header_textcolor' )->default   = '#444444';
		$wp_customize->get_control( 'header_textcolor' )->priority  = 50;
		$wp_customize->get_control( 'background_color' )->priority  = 22;
		$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

		/*
		 * ------------------------------------------------------------------------- *
		 *  Social Links
		 * --------------------------------------------------------------------------
		 */
		$wp_customize->add_setting(
			'links_on_author_box', array(
				'default'           => true,
				'sanitize_callback' => 'cd_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'links_on_author_box', array(
				'label'    => __( 'Show the social links on the author box', 'coldbox' ),
				'section'  => 'social_links',
				'type'     => 'checkbox',
				'priority' => '1',
			)
		);

	} // End Customizer.

	/**
	 * Returns theme_button.
	 *
	 * @since 1.5.0
	 * @return bool
	 */
	function cd_show_theme_button() {
		$theme_button = get_theme_mod( 'theme_button', true );
		return $theme_button;
	}
	/**
	 * Get whether using minified CSS or not
	 *
	 * @since 1.0.0
	 */
	function cd_use_minified_css() {
		$minified_css = get_theme_mod( 'minified_css', true );
		$css_min      = $minified_css ? '.min' : '';
		$css_min      = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : $css_min;
		return apply_filters( 'cd_use_minified_css', $css_min );
	}
	/**
	 * Get whether using minified JS or not
	 *
	 * @since 1.0.0
	 */
	function cd_use_minified_js() {
		$minified_js = get_theme_mod( 'minified_js', true );
		$js_min      = $minified_js ? '.min' : '';
		$js_min      = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : $js_min;
		return apply_filters( 'cd_use_minified_js', $js_min );
	}
	/**
	 * Get whether using minified JS or not
	 *
	 * @since 1.5.0
	 */
	function cd_use_concat_js() {
		$concat_js = get_theme_mod( 'concat_js', true );
		return apply_filters( 'cd_use_concat_js', $concat_js );
	}
	/**
	 * Get the sidebar position
	 *
	 * @since 1.0.0
	 */
	function cd_sidebar_stg() {
		return ( get_theme_mod( 'sidebar_position', 'right' ) );
	}
	/**
	 * Get page style for index pages
	 *
	 * @since 1.0.0
	 */
	function cd_index_style() {
		return ( get_theme_mod( 'index_style', 'grid' ) );
	}
	/**
	 * Get page style for archive pages
	 *
	 * @since 1.0.0
	 */
	function cd_archive_style() {
		return ( get_theme_mod( 'archive_style', 'grid' ) );
	}
	/**
	 * Get whether displaying the site title or not
	 *
	 * @since 1.0.2
	 */
	function cd_is_site_title() {
		return ( get_theme_mod( 'site_title', true ) );
	}
	/**
	 * Get whether dispyaing the site tagline or not
	 *
	 * @since 1.0.0
	 */
	function cd_is_site_desc() {
		return ( get_theme_mod( 'site_desc', true ) );
	}
	/**
	 * Get the header direction
	 *
	 * @since 1.0.0
	 */
	function cd_header_direction() {
		return ( get_theme_mod( 'header_direction', 'column' ) );
	}
	/**
	 * Get the header's sticky setting
	 *
	 * @since 1.0.0
	 */
	function cd_header_sticky() {
		return ( get_theme_mod( 'header_sticky', true ) );
	}
	/**
	 * Get whether using placeholder image or not.
	 *
	 * @since 1.1.2
	 */
	function cd_index_placefolder_image() {
		return ( get_theme_mod( 'index_placefolder_image', true ) );
	}
	/**
	 * Get whether displaying the date on index pages.
	 *
	 * @since 1.0.0
	 */
	function cd_index_meta_date() {
		return ( get_theme_mod( 'index_meta_date', true ) );
	}
	/**
	 * Get whether displaying the categories on index pages.
	 *
	 * @since 1.0.0
	 */
	function cd_index_meta_cat() {
		return ( get_theme_mod( 'index_meta_cat', true ) );
	}
	/**
	 * Get whether displaying the comments count on index pages.
	 *
	 * @since 1.0.0
	 */
	function cd_index_meta_comment() {
		return ( get_theme_mod( 'index_meta_comment', true ) );
	}
	/**
	 * Get the length of the excerpt.
	 *
	 * @since 1.0.0
	 */
	function cd_czr_excerpt_length() {
		return ( get_theme_mod( 'excerpt_length', 60 ) );
	}
	/**
	 * Get the ending strings of the excerpt.
	 *
	 * @since 1.0.0
	 */
	function cd_czr_excerpt_ending() {
		return ( get_theme_mod( 'excerpt_ending', '&#46;&#46;&#46;' ) );
	}
	/**
	 * Get whether displaying the date on single pages.
	 *
	 * @since 1.0.0
	 */
	function cd_is_meta_date() {
		return ( get_theme_mod( 'single_meta_date', true ) );
	}
	/**
	 * Get whether displaying the modified date on single pages.
	 *
	 * @since 1.0.0
	 */
	function cd_is_meta_modified() {
		return ( get_theme_mod( 'single_meta_modified_date', true ) );
	}
	/**
	 * Get whether displaying the categories on single pages.
	 *
	 * @since 1.0.0
	 */
	function cd_is_meta_cat() {
		return ( get_theme_mod( 'single_meta_cat', false ) );
	}
	/**
	 * Get whether displaying the author on single pages.
	 *
	 * @since 1.0.0
	 */
	function cd_is_meta_author() {
		return ( get_theme_mod( 'single_meta_author', true ) );
	}
	/**
	 * Get whether displaying the comments count on single pages.
	 *
	 * @since 1.0.0
	 */
	function cd_is_meta_com() {
		return ( get_theme_mod( 'single_meta_com', true ) );
	}
	/**
	 * Get whether displaying the tags on bottom of single pages.
	 *
	 * @since 1.0.0
	 */
	function cd_is_meta_btm_tag() {
		return ( get_theme_mod( 'single_meta_btm_tag', true ) );
	}
	/**
	 * Get whether displaying the categories on bottom of single pages.
	 *
	 * @since 1.0.0
	 */
	function cd_is_meta_btm_cat() {
		return ( get_theme_mod( 'single_meta_btm_cat', true ) );
	}
	/**
	 * Get whether displaying the author box on single pages.
	 *
	 * @since 1.0.0
	 */
	function cd_is_author_box() {
		return ( get_theme_mod( 'single_author_box', true ) );
	}
	/**
	 * Get whether displaying the post navigation on single pages.
	 *
	 * @since 1.0.0
	 */
	function cd_is_post_nav() {
		return ( get_theme_mod( 'single_post_nav', true ) );
	}
	/**
	 * Get whether displaying the related posts on single pages.
	 *
	 * @since 1.0.0
	 */
	function cd_is_post_related() {
		return ( get_theme_mod( 'single_related_posts', true ) );
	}
	/**
	 * Get whether displaying the comments on single pages.
	 *
	 * @since 1.0.0
	 */
	function cd_is_post_single_comment() {
		return ( get_theme_mod( 'single_comment', true ) );
	}
	/**
	 * Get the max articles shown on related posts.
	 *
	 * @since 1.0.0
	 */
	function cd_single_related_max() {
		return ( get_theme_mod( 'single_related_max', 6 ) );
	}
	/**
	 * Get the column number of related posts.
	 *
	 * @since 1.0.0
	 */
	function cd_single_related_col() {
		return ( get_theme_mod( 'single_related_col', 2 ) );
	}
	/**
	 * Get whether displaying the data on static pages.
	 *
	 * @since 1.1.1
	 */
	function cd_pages_meta_date() {
		return ( get_theme_mod( 'pages_meta_date', false ) );
	}
	/**
	 * Get whether displaying the author on static pages.
	 *
	 * @since 1.1.1
	 */
	function cd_pages_meta_author() {
		return ( get_theme_mod( 'pages_meta_author', false ) );
	}
	/**
	 * Get whether displaying the comments count on static pages.
	 *
	 * @since 1.1.1
	 */
	function cd_pages_meta_comments_count() {
		return ( get_theme_mod( 'pages_meta_comments_count', false ) );
	}
	/**
	 * Get whether displaying theme credit or not.
	 *
	 * @since 1.0.0
	 */
	function cd_is_theme_credit() {
		return ( get_theme_mod( 'theme_credit', true ) );
	}
	/**
	 * Get the contents of the theme credit text.
	 *
	 * @since 1.0.0
	 */
	function cd_theme_credit_text() {
		return get_theme_mod( 'theme_credit_text', __( 'Coldbox WordPress theme by', 'coldbox' ) . ' <a href="' . esc_url( __( 'https://miruc.co/', 'coldbox' ) ) . '">' . __( 'Mirucon', 'coldbox' ) . '</a>' );
	}
	/**
	 * Get the contents of the credit text.
	 *
	 * @since 1.0.0
	 */
	function cd_credit() {
		$text = get_theme_mod( 'credit_text', '&copy;[year] <a href="[url]">[name]</a>' );
		$text = str_replace( '[year]', esc_html( date( 'Y' ) ), $text );
		$text = str_replace( '[url]', esc_url( home_url() ), $text );
		$text = str_replace( '[name]', esc_html( get_bloginfo( 'name' ) ), $text );
		return $text;
	}
	/**
	 * Get whether using of the hljs or not.
	 *
	 * @since 1.0.0
	 */
	function cd_use_normal_hljs() {
		return ( get_theme_mod( 'does_use_hljs', false ) );
	}
	/**
	 * Get whether using of the hljs with web package or not.
	 *
	 * @since 1.0.0
	 */
	function cd_use_web_hljs() {
		return ( get_theme_mod( 'use_hljs_web_pack', false ) );
	}
} // End if.

add_action( 'customize_register', 'cd_customize_register' );

// Load Social Links Setting.
require_once get_theme_file_path( 'parts/czr/social-links.php' );

// Load Font Setting.
require_once get_theme_file_path( 'parts/czr/customizer-font.php' );

// Load the inline styles got from the theme customizer.
require_once get_theme_file_path( 'parts/czr/customizer-style.php' );
