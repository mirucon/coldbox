<?php
/**
 * The template for adding the social links widget
 *
 * @since 1.1.1
 * @package Coldbox
 */

/**
 * Register and load the widget
 *
 * @since 1.1.1
 */
function cd_load_widget_social_links() {
	register_widget( 'cd_social_links' );
}
add_action( 'widgets_init', 'cd_load_widget_social_links' );

/**
 * For the social links widget's class
 */
class CD_Social_Links extends WP_Widget {

	/**
	 * Register the widget
	 *
	 * @access public
	 */
	public function __construct() {
		parent::__construct(
			'cd_widget_social_links', // Base ID.
			__( '[Coldbox] Social Links', 'coldbox' ), // Name.
			array(
				'description' => __( 'Show the social links you have entered on the customizer.', 'coldbox' ),
			)
		);
	}

	/**
	 * Widget's Front-end
	 *
	 * @since 1.1.1
	 * @param array $args The titles user entered.
	 * @param array $instance Widget settings.
	 */
	public function widget( $args, $instance ) {
		$title = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) : '';
		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			echo $args['before_title'] . esc_html__( 'Follow me', 'coldbox' ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		cd_social_links();

		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Widget's Back-end
	 *
	 * @since 1.1.1
	 * @param string $instance Return the widget title.
	 */
	public function form( $instance ) {
		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = __( 'Follow me', 'coldbox' );
		}

		// Widget admin form.
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'coldbox' ); ?>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</label>
		</p>
		<?php
	}

	/**
	 * Updating widget replacing old instances with new.
	 *
	 * @since 1.1.1
	 * @param string $new_instance A new instance.
	 * @param string $old_instance A old instance.
	 * @return array
	 **/
	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		return $instance;
	}

}
