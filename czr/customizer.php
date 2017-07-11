<?php
/**
* Register customizations
*
* @since 1.0.0
* @package coldbox
*/

function cd_czr_style() {
	wp_enqueue_style( 'czr_style', get_template_directory_uri().'/czr/czr-style.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'cd_czr_style' );

/* ------------------------------------------------------------------------- *
*  Theme Customizer
* ------------------------------------------------------------------------- */
if ( !function_exists( 'cd_customize_register' ) ) {
	function cd_customize_register( $wp_customize ) {

		// Sanitize Functions
		function cd_sanitize_checkbox( $checked ){ return ( ( isset( $checked ) && true == $checked ) ? true : false ); }
		function cd_sanitize_radio( $input, $setting ) { $input = sanitize_key( $input ); $choices = $setting->manager->get_control($setting->id)->choices; return ( array_key_exists( $input, $choices ) ? $input : $setting->default ); }
		function cd_sanitize_text( $text ) { return sanitize_text_field( $text ); }
		function cd_sanitize_nohtml( $nohtml ) { return wp_filter_nohtml_kses( $nohtml ); }
		function cd_sanitize_html( $html ) { return wp_filter_post_kses( $html ); }
		// To output HTML
		if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'cd_Custom_Content' ) ) {
			class cd_Custom_Content extends WP_Customize_Control {
				public $content = '';
				public function render_content() {
					if ( isset( $this->content ) ) {
						echo $this->content;
					}
				}
			}
		}

		/* ------------------------------------------------------------------------- *
		*  Global Settings
		* ------------------------------------------------------------------------- */
		$wp_customize->add_section( 'global', array(
			'title'  => __( 'Coldbox: Global Settings', 'coldbox' ),
			'priority' => 1,
		));
		// Sidebar Position
		$wp_customize->add_setting( 'sidebar_position', array(
			'default'  => 'right',
			'sanitize_callback' => 'cd_sanitize_radio',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sidebar_position', array(
			'label'    =>  __( 'Sidebar Position', 'coldbox' ),
			'section'  => 'global',
			'priority' => 1,
			'type'     => 'radio',
			'choices'  => array(
				'right'    => __( 'Right Sidebar (default)','coldbox' ),
				'left'     => __( 'Left Sidebar','coldbox' ),
				'bottom'   => __( 'Bottom Sidebar', 'coldbox' ),
				'hide'     => __( 'Hide Sidebar', 'coldbox' ),
			),
		)));
		// Container Width
		$wp_customize->add_setting( 'container_width', array(
			'default'  => '1140',
			'sanitize_callback' => 'absint',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'container_width', array(
			'label'    =>  __( 'Site Max-Width', 'coldbox' ),
			'section'  => 'global',
			'type'     => 'number',
			'input_attrs' => array(
				'step'     => '1',
				'min'      => '800',
				'max'      => '1980',
			),
		)));
		// Global Font Select
		$wp_customize->add_setting( 'global_font', array(
			'default'  => 'sourcesanspro',
			'sanitize_callback' => 'cd_sanitize_radio',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'global_font', array(
			'label'    =>  __( 'Global Font Selecter', 'coldbox' ),
			'section'  => 'global',
			'type'     => 'select',
			'choices'  => array(
				'sourcesanspro'=> 'Source Sans Pro',
				'opensans'  => 'Open Sans',
				'lato'      => 'Lato',
				'roboto'    => 'Roboto',
				'robotocondensed' => 'Roboto Condensed',
				'ubuntu'    => 'Ubuntu',
				'raleway'   => 'Raleway',
				'josefinsans'=> 'Josefin Sans',
				'ptsans'    => 'PT Sans',
				'lora'      => 'Lora',
				'robotoslab'=> 'Roboto Slab',
				'arial'     => 'Arial',
				'helvetica' => 'Helvetica',
				'verdana'   => 'Verdana',
				'tahoma'    => 'Tahoma',
			),
		)));
		$wp_customize->add_setting( 'custom_font', array(
			'default'  => '[font], Arial, sans-serif',
			'sanitize_callback' => 'cd_sanitize_text',
		));
		$wp_customize->add_control( new WP_Customize_control( $wp_customize, 'custom_font', array(
			'label'    => __( 'Custom Font-Family Value', 'coldbox' ),
			'description' => sprintf ( /* Translators: %s: [font](shortcode) */ __('"%s" will be replaced with the font you\'ve chosen above', 'coldbox' ), '[font]' ),
			'section'  => 'global',
			'type'     => 'text',
		)));
		$wp_customize->add_setting( 'global_font_size_pc', array(
			'default'  => 16,
			'sanitize_callback' => 'absint',
		));
		$wp_customize->add_control( new WP_Customize_control( $wp_customize, 'global_font_size_pc', array(
			'label'    => __( 'Global Font Size for PC', 'coldbox' ),
			'section'  => 'global',
			'type'     => 'number',
			'input_attrs' => array(
				'step'     => '1',
				'min'      => '10',
				'max'      => '32',
			),
		)));
		$wp_customize->add_setting( 'global_font_size_mobile', array(
			'default'  => 16,
			'sanitize_callback' => 'absint',
		));
		$wp_customize->add_control( new WP_Customize_control( $wp_customize, 'global_font_size_mobile', array(
			'label'    => __( 'Global Font Size for Mobile', 'coldbox' ),
			'section'  => 'global',
			'type'     => 'number',
			'input_attrs' => array(
				'step'     => '1',
				'min'      => '10',
				'max'      => '32',
			),
		)));
		$wp_customize->add_setting( 'minified_css', array(
			'default'  => true,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( new WP_Customize_control( $wp_customize, 'minified_css', array(
			'label'    => __( 'Use minified CSS file', 'coldbox' ),
			'description' => __( 'The theme will load minified CSS file. Minifying css stylesheets improves loading speed of your website. It should be used unless you need to modify the theme\'s stylesheet.', 'coldbox' ),
			'section'  => 'global',
			'type'     => 'checkbox',
		)));
		$wp_customize->add_setting( 'minified_js', array(
			'default'  => true,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( new WP_Customize_control( $wp_customize, 'minified_js', array(
			'label'    => __( 'Use minified JS file', 'coldbox' ),
			'description' => __( 'The theme will load minified JS file. Minifying JavaScript file improves loading speed of your website. It should be used unless you need to modify the theme\'s stylesheet.', 'coldbox' ),
			'section'  => 'global',
			'type'     => 'checkbox',
		)));
		// Use highlight.js
		$wp_customize->add_setting( 'does_use_hljs', array(
			'default'  => false,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'does_use_hljs', array(
			'label'  => __( 'Use highlight.js', 'coldbox'),
			'description'=> __( 'The package contains 23 common languages.' , 'coldbox'),
			'section'  => 'global',
			'type'     => 'checkbox',
		)));
		$wp_customize->add_setting( 'use_hljs_web_pack', array(
			'default'  => false,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'use_hljs_web_pack', array(
			'label'  => __( 'Use highlight.js with Web Package', 'coldbox' ),
			'description'=> __( 'The package contains the languages which often be used for web development. To use other languages, you may go to <a href="https://highlightjs.org/">Highlight.js official site</a>.', 'coldbox' ),
				'section'  => 'global',
				'type'     => 'checkbox',
		)));


		/* ------------------------------------------------------------------------- *
		*  Header Settings
		* -------------------------------------------------------------------------- */
		$wp_customize->add_section( 'header', array(
			'title'    => __( 'Coldbox: Header Settings','coldbox' ),
			'priority' => 1,
		));
		// Site Description
		$wp_customize->add_setting( 'site_desc', array(
			'default'  => true,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'site_desc', array(
			'label'    =>  __( 'Display Site Description', 'coldbox' ),
			'section'  => 'header',
			'type'     => 'checkbox',
		)));
		// Header Direction
		$wp_customize->add_setting( 'header_direction', array(
			'default'  => 'column',
			'sanitize_callback' => 'cd_sanitize_radio',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_direction', array(
			'label'    =>  __( 'Header and Menu Direction', 'coldbox' ),
			'section'  => 'header',
			'type'     => 'radio',
			'choices'  => array(
				'column'  => __( 'Vertical (flex-direction: column)', 'coldbox' ),
				'row'     => __( 'Horizontal (flex-direction: row)', 'coldbox' ),
				)
		)));


		/* ------------------------------------------------------------------------- *
		*  Index settings
		* ------------------------------------------------------------------------- */
		$wp_customize->add_section( 'index', array(
			'title'    => __( 'Coldbox: Archive Pages Settings','coldbox' ),
			'priority' => 2,
		));
		// Front page style
		$wp_customize->add_setting( 'index_style', array(
			'default'  => 'grid',
			'sanitize_callback' => 'cd_sanitize_radio',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'index_style', array(
			'label'    => __( 'Front Page Style','coldbox' ),
			'section'  => 'index',
			'priority' => 1,
			'type'     => 'radio',
			'choices'  => array(
				'grid'     => __( 'Grid Style (default)','coldbox' ),
				'standard' => __( 'Standard Style','coldbox' ),
			),
		)));
		// Archive page style
		$wp_customize->add_setting( 'archive_style', array(
			'default'  => 'grid',
			'sanitize_callback' => 'cd_sanitize_radio',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archive_style', array(
			'label'    => __( 'Archive Page Style','coldbox' ),
			'section'  => 'index',
			'priority' => 2,
			'type'     => 'radio',
			'choices'  => array(
				'grid'     => __( 'Grid Style (default)','coldbox' ),
				'standard' => __( 'Standard Style','coldbox' ),
			),
		)));
		// Excerpt Length Setting
		$wp_customize->add_setting( 'excerpt_length', array(
			'default'  => '60',
			'sanitize_callback' => 'absint',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'excerpt_length', array(
			'label'    =>  __( 'Excerpt Length', 'coldbox' ),
			'section'  => 'index',
			'type'     => 'number',
			'input_attrs' => array(
				'min'      => '0',
			),
		)));
		$wp_customize->add_setting( 'excerpt_ending', array(
			'default'  => '...',
			'sanitize_callback' => 'cd_sanitize_text',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'excerpt_ending', array(
			'label'    =>  __( 'Excerpt Ending', 'coldbox' ),
			'section'  => 'index',
			'type'     => 'text',
		)));
		// Meta Settings
		$wp_customize->add_setting( 'index_meta_date', array(
			'default'  => true,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'index_meta_date', array(
			'label'    =>  __( 'Display Post Date on Grid', 'coldbox' ),
			'section'  => 'index',
			'type'     => 'checkbox',
		)));
		$wp_customize->add_setting( 'index_meta_cat', array(
			'default'  => true,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'index_meta_cat', array(
			'label'    =>  __( 'Display Categories on Grid', 'coldbox' ),
			'section'  => 'index',
			'type'     => 'checkbox',
		)));
		$wp_customize->add_setting( 'index_meta_comment', array(
			'default'  => true,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'index_meta_comment', array(
			'label'    =>  __( 'Display Comments Count on Grid', 'coldbox' ),
			'section'  => 'index',
			'type'     => 'checkbox',
		)));


		/* ------------------------------------------------------------------------- *
		*  Single Settings
		* ------------------------------------------------------------------------- */
		$wp_customize->add_section( 'single', array(
			'title'    => __( 'Coldbox: Single Settings', 'coldbox' ),
			'priority' => 3,
		));

		/*   Add decorations to header Tags
		/* -------------------------------------------------- */
		$wp_customize->add_setting( 'single_content', array( 'sanitize_callback'=>'cd_sanitize_text' ) );
		$wp_customize->add_control( new cd_Custom_Content( $wp_customize, 'single_content', array(
			'content' => '<h3 class="czr-heading first">' . __( 'Settings for Content', 'coldbox' ) . '</h3>', 'section' => 'single',
		) ) );
		$wp_customize->add_setting( 'decorate_htags', array(
			'default'  => false,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'decorate_htags', array(
			'label'    => __( 'Add Decoration to H2-H5 Tags.', 'coldbox' ),
			'section'  => 'single',
			'type'     => 'checkbox',
		)));

		/*   Single Meta Settings
		/* -------------------------------------------------- */
		$wp_customize->add_setting( 'single_meta', array( 'sanitize_callback'=>'cd_sanitize_text' ) );
		$wp_customize->add_control( new cd_Custom_Content( $wp_customize, 'single_meta', array(
			'content' => '<h3 class="czr-heading">' . __( 'Settings for Metas', 'coldbox' ) . '</h3>', 'section' => 'single',
		) ) );
		// Date
		$wp_customize->add_setting( 'single_meta_date', array(
			'default'  => true,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_meta_date', array(
			'label'    => __( 'Display Post Dates', 'coldbox' ),
			'section'  => 'single',
			'type'     => 'checkbox',
		)));
		// Category
		$wp_customize->add_setting( 'single_meta_cat', array(
			'default'  => false,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_meta_cat', array(
			'label'    => __( 'Display Post Categories','coldbox' ),
			'section'  => 'single',
			'type'     => 'checkbox',
			'description'=> __( 'Note: Categories are already shown on the breadcrum.', 'coldbox' ),
		)));
		// Author
		$wp_customize->add_setting( 'single_meta_author', array(
			'default'  => true,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_meta_author', array(
			'label'    => __( 'Display Post Author','coldbox' ),
			'section'  => 'single',
			'type'     => 'checkbox',
		)));
		// Comment Count
		$wp_customize->add_setting( 'single_meta_com', array(
			'default'  => true,
			'sanitize_callback' => 'cd_sanitize_checkbox'
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_meta_com', array(
			'label'    => __( 'Display Comments Count', 'coldbox' ),
			'section'  => 'single',
			'type'     => 'checkbox',
		)));
		// Bottom Tag
		$wp_customize->add_setting( 'single_meta_btm_tag', array(
			'default'  => true,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_meta_btm_tag', array(
			'label'    => __( 'Display Post Tags on Bottom', 'coldbox' ),
			'section'  => 'single',
			'type'     => 'checkbox',
		)));
		// Bottom Category
		$wp_customize->add_setting( 'single_meta_btm_cat', array(
			'default'  => true,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_meta_btm_cat', array(
			'label'    => __( 'Display Post Categories on Bottom', 'coldbox' ),
			'section'  => 'single',
			'type'     => 'checkbox',
		)));
		// Author Box
		$wp_customize->add_setting( 'single_author_box', array(
			'default'  => true,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( 'single_author_box', array(
			'label'    => __( 'Display Author Box','coldbox' ),
			'section'  => 'single',
			'type'     => 'checkbox',
		));
		// Comment
		$wp_customize->add_setting( 'single_comment', array(
			'default'  => true,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_comment', array(
			'label'    => __( 'Display Comments','coldbox' ),
			'section'  => 'single',
			'type'     => 'checkbox',
		)));
		// Post Nav
		$wp_customize->add_setting( 'single_post_nav', array(
			'default'  => true,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_post_nav', array(
			'label'    => __( 'Display Post Navigation','coldbox' ),
			'section'  => 'single',
			'type'     => 'checkbox',
		)));

		/*   Related Posts Settings
		/* -------------------------------------------------- */
		$wp_customize->add_setting( 'single_related', array( 'sanitize_callback'=>'cd_sanitize_text' ) );
		$wp_customize->add_control( new cd_Custom_Content( $wp_customize, 'single_related', array(
			'content' => '<h3 class="czr-heading">' . __( 'Settings for Related Posts', 'coldbox' ) . '</h3>', 'section' => 'single',
		) ) );
		// Related Post
		$wp_customize->add_setting( 'single_related_posts', array(
			'default'  => true,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_related_posts', array(
			'label'    => __( 'Display Related Posts','coldbox' ),
			'section'  => 'single',
			'type'     => 'checkbox',
		)));
		// Max Article
		$wp_customize->add_setting( 'single_related_max', array(
			'default'  => 6,
			'sanitize_callback' => 'absint',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_related_max', array(
			'label'    => __( 'Related Post - Max Articles', 'coldbox' ),
			'section'  => 'single',
			'type'     => 'number',
			'input_attrs' => array(
				'min'      => '1',
			),
		)));
		// Max Article
		$wp_customize->add_setting( 'single_related_col', array(
			'default'  => 3,
			'sanitize_callback' => 'absint',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_related_col', array(
			'label'    => __( 'Related Post - Columns', 'coldbox' ),
			'section'  => 'single',
			'type'     => 'number',
			'input_attrs' => array(
				'min'      => '1',
			),
		)));
		/* ------------------------------------------------------------------------- *
		*  Static Pages Settings
		* ------------------------------------------------------------------------- */
		$wp_customize->add_section( 'pages', array(
			'title'    => __( 'Coldbox: Static Pages Settings', 'coldbox' ),
			'priority' => 3,
		));

		/*   Pages Meta Settings
		/* -------------------------------------------------- */
		// Data
		$wp_customize->add_setting( 'pages_meta_data', array(
			'default'  => false,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pages_meta_data', array(
			'label'    => __( 'Display Data', 'coldbox' ),
			'section'  => 'pages',
			'type'     => 'checkbox',
		)));
		// Author
		$wp_customize->add_setting( 'pages_meta_author', array(
			'default'  => false,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pages_meta_author', array(
			'label'    => __( 'Display the Author name', 'coldbox' ),
			'section'  => 'pages',
			'type'     => 'checkbox',
		)));
		// Comments count
		$wp_customize->add_setting( 'pages_meta_comments_count', array(
			'default'  => false,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pages_meta_comments_count', array(
			'label'    => __( 'Display the comments count', 'coldbox' ),
			'description' => __( 'It will be shown when comments are opened and shown.', 'coldbox' ),
			'section'  => 'pages',
			'type'     => 'checkbox',
		)));



		/* ------------------------------------------------------------------------- *
		*  Footer Settings
		* ------------------------------------------------------------------------- */
		$wp_customize->add_section( 'footer', array(
			'title'    => __( 'Coldbox: Footer Settings', 'coldbox' ),
			'priority' => 4,
		));
		$wp_customize->add_setting( 'theme_credit', array(
			'default'  => true,
			'sanitize_callback' => 'cd_sanitize_checkbox',
			'priority' => 5,
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_credit', array(
			'label'    => __( 'Display Theme Credit', 'coldbox' ),
			'section'  => 'footer',
			'type'     => 'checkbox',
		)));
		$wp_customize->add_setting( 'credit_text', array(
			'default'  => '©[year] <a href="[url]">[name]</a>',
			'sanitize_callback' => 'wp_kses_post',
			'priority' => 1,
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'credit_text', array(
			'label'    => __( 'Edit the Credit Content', 'coldbox' ),
			'description' => sprintf( /* Translators: %s: HTML Tags */ __( 'It will be displayed in footer area. You can use the following HTML tags: %s.<br/> Also some shortcodes you can use: <br/> [year] -> Shows this year, <br/> [url] -> This site\'s URL, <br/> [name] -> This site\'s name.', 'coldbox' ), '&lt;a&gt;, &lt;p&gt;, &lt;br&gt;, &lt;b&gt;, &lt;strong&gt; &lt;small&gt;' ),
			'section'  => 'footer',
			'type'     => 'textarea',
		)));
		$wp_customize->add_setting( 'theme_credit_text', array(
			'default'  => '<a href="' . esc_url_raw( __( "https://coldbox.miruc.co/", "coldbox" ) ) . '">Coldbox WordPress theme</a> by <a href="' . esc_url_raw( __( "https://miruc.co/", "coldbox" ) ) . '">Mirucon</a>',
			'sanitize_callback' => 'wp_kses_post',
			'priority' => 10,
		));
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_credit_text', array(
			'label'    => __( 'Edit the Theme Credit Content', 'coldbox' ),
			'description' => sprintf( /* Translators: %s: HTML Tags */ __( 'It will be displayed when above checked. You can use the following HTML tags: %s', 'coldbox' ), '&lt;a&gt;, &lt;p&gt;, &lt;br&gt;, &lt;b&gt;, &lt;strong&gt; &lt;small&gt;' ),
			'section'  => 'footer',
			'type'     => 'textarea',
		)));


		/* ------------------------------------------------------------------------- *
		*  Colors
		* ------------------------------------------------------------------------- */
		// Link Color
		$wp_customize->add_setting( 'link_color', array(
			'default'    => '#00619f',
			'sanitize_callback' => 'sanitize_hex_color',
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
			'label'      => __( 'Primary Color', 'coldbox' ),
			'section'    => 'colors',
			'settings'   => 'link_color',
		)));
		// Hover Link Color
		$wp_customize->add_setting( 'link_hover_color', array(
			'default'   => '#2e4453',
			'sanitize_callback' => 'sanitize_hex_color',
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
			'label'     => __( 'Secondary Color', 'coldbox' ),
			'section'   => 'colors',
			'settings'  => 'link_hover_color'
		)));
		// Header Background Color
		$wp_customize->add_setting( 'header_color', array(
			'default'  => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
			'label'     => __( 'Header Background', 'coldbox' ),
			'section'   => 'colors',
			'settings'  => 'header_color',
		)));
		// Footer Background Color
		$wp_customize->add_setting( 'footer_color', array(
			'default'  => '#44463b',
			'sanitize_callback' => 'sanitize_hex_color',
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_color', array(
			'label'     => __( 'Footer Background', 'coldbox' ),
			'section'   => 'colors',
			'settings'  => 'footer_color',
		)));

		/* ------------------------------------------------------------------------- *
		*  Social Links
		* -------------------------------------------------------------------------- */
		$wp_customize->add_setting( 'links_on_author_box', array(
			'default'  => true,
			'sanitize_callback' => 'cd_sanitize_checkbox',
		));

		$wp_customize->add_control( 'links_on_author_box', array(
			'label'   => __( 'Show the social links on the author box', 'coldbox' ),
			'section' => 'social_links',
			'type'    => 'checkbox',
			'priority' => '1',
		));



	} // End Customizer


	// Minified CSS
	function cd_use_minified_css() { return ( get_theme_mod( 'minified_css', true ) ); }
	function cd_use_minified_js() { return ( get_theme_mod( 'minified_js', true ) ); }
	// Sidebar Position
	function cd_sidebar_stg() { return ( get_theme_mod( 'sidebar_position', 'right' ) ); }
	// Page Style Settings
	function cd_index_style() { return ( get_theme_mod( 'index_style', 'grid' ) ); }
	function cd_archive_style() { return ( get_theme_mod( 'archive_style', 'grid' ) ); }
	function cd_is_site_desc() { return ( get_theme_mod( 'site_desc', true ) ); }
	function cd_header_direction() { return ( get_theme_mod( 'header_direction', 'column' ) ); }
	// Index Metas
	function cd_index_meta_date() { return ( get_theme_mod( 'index_meta_date', true ) ); }
	function cd_index_meta_cat() { return ( get_theme_mod( 'index_meta_cat', true ) ); }
	function cd_index_meta_comment() { return ( get_theme_mod( 'index_meta_comment', true ) ); }
	// Excerpt Settings
	function cd_czr_excerpt_length() { return ( get_theme_mod( 'excerpt_length', 60 ) ); }
	function cd_czr_excerpt_ending() { return ( get_theme_mod( 'excerpt_ending', '&#46;&#46;&#46;' ) ); }
	// Single Meta Settings
	function cd_is_meta_date() { return ( get_theme_mod( 'single_meta_date', true ) ); }
	function cd_is_meta_modified() { return ( get_theme_mod( 'single_meta_date', true ) ); }
	function cd_is_meta_cat() { return ( get_theme_mod( 'single_meta_cat', false ) ); }
	function cd_is_meta_author() { return ( get_theme_mod( 'single_meta_author', true ) ); }
	function cd_is_meta_com() { return ( get_theme_mod( 'single_meta_com', true ) ); }
	function cd_is_meta_btm_tag() { return ( get_theme_mod( 'single_meta_btm_tag', true ) ); }
	function cd_is_meta_btm_cat() { return ( get_theme_mod( 'single_meta_btm_cat', true ) ); }
	function cd_is_author_box() { return ( get_theme_mod( 'single_author_box', true ) ); }
	function cd_is_post_nav() { return ( get_theme_mod( 'single_post_nav', true ) ); }
	function cd_is_post_related() { return ( get_theme_mod( 'single_related_posts', true ) ); }
	function cd_is_post_single_comment() { return ( get_theme_mod( 'single_comment', true ) ); }
	// Related Posts Settings
	function cd_single_related_max() { return ( get_theme_mod( 'single_related_max', 6 ) ); }
	function cd_single_related_col() { return ( get_theme_mod( 'single_related_col', 2 ) ); }
	// Pages Metas
	function cd_pages_meta_data() { return  ( get_theme_mod( 'pages_meta_data', false ) ); }
	function cd_pages_meta_author() { return  ( get_theme_mod( 'pages_meta_author', false ) ); }
	function cd_pages_meta_comments_count() { return  ( get_theme_mod( 'pages_meta_comments_count', false ) ); }
	// Theme credit
	function cd_is_theme_credit() { return ( get_theme_mod( 'theme_credit', true ) ); }
	function cd_theme_credit_text() { return get_theme_mod( 'theme_credit_text', '<a href="https://coldbox.miruc.co/">Coldbox WordPress theme</a> by <a href="https://miruc.co/">Mirucon</a>' ) ; }
	// Hightlight.js
	function cd_use_normal_hljs() { return ( get_theme_mod( 'does_use_hljs', false ) ); }
	function cd_use_web_hljs() { return ( get_theme_mod( 'use_hljs_web_pack', false ) ); }
	function cd_credit() {
		$text = get_theme_mod( 'credit_text', '&copy;[year] <a href="[url]">[name]</a>' );
		$text = str_replace( '[year]', esc_html( date( "Y" ) ), $text );
		$text = str_replace( '[url]', esc_url( home_url() ), $text );
		$text = str_replace( '[name]', esc_html( get_bloginfo( 'name' ) ), $text );
		return $text;
	}

}
add_action( 'customize_register', 'cd_customize_register' );

// Load Social Links Setting
get_template_part( 'czr/social-links' );

// Load Font Setting
get_template_part( 'czr/customizer-font' );

//  Load the inline styles got from the theme customizer
get_template_part( 'czr/customizer-style' );
?>
