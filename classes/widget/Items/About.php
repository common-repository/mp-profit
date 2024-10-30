<?php
/**
 * About widget class
 *
 */
require_once 'Default.php';

class MP_Profit_Plugin_Widget_About extends MP_Profit_Plugin_Widget_Default {

	public function __construct() {
		$this->setClassName( 'mp_profit_widget_about' );
		$this->setName( __( 'About Us', 'mp-profit' ) );
		$this->setDescription( __( 'About us', 'mp-profit' ) );
		$this->setIdSuffix( 'mp_profit_about' );
		parent::__construct();
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$text  = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		$logo  = true;

		if ( count( $instance ) && isset($instance['logo']) ) {
			$logo = $instance['logo'] === null ? true : $instance['logo'];
		}
		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . esc_html( $title ) . $after_title;
		}
		?>
		<?php if ( $logo ): ?>
			<div class="site-logo ">
				<div class="header-logo ">
					<?php
						if ( function_exists( 'the_custom_logo' ) ) {
							the_custom_logo();
						}
					?>
				</div>
				<div class="site-description">
					<h1 class="site-title <?php if ( ! get_bloginfo( 'description' ) ) : ?>empty-tagline<?php endif; ?>"><?php bloginfo( 'name' ); ?></h1>
				</div>
			</div>
		<?php endif; ?>
		<div class="site-about"><?php echo wp_kses_data( $text ); ?></div>
		<?php
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
		} // wp_filter_post_kses() expects slashed
		$instance['logo'] = isset( $new_instance['logo'] );

		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title    = strip_tags( $instance['title'] );
		$text     = esc_textarea( $instance['text'] );
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'mp-profit' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>"/></p>

		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>"
		          name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>

		<p><input id="<?php echo $this->get_field_id( 'logo' ); ?>"
		          name="<?php echo $this->get_field_name( 'logo' ); ?>"
		          type="checkbox" <?php checked( isset( $instance['logo'] ) ? $instance['logo'] : true ); ?> />&nbsp;<label
				for="<?php echo $this->get_field_id( 'logo' ); ?>"><?php _e( 'Show logo', 'mp-profit' ); ?></label></p>

		<?php
	}

}

add_action('widgets_init', function() {
		return register_widget( "MP_Profit_Plugin_Widget_About" );
});
