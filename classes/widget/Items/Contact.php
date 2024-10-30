<?php
/**
 * Contact  widget class
 *
 */
require_once 'Default.php';

class MP_Profit_Plugin_Widget_Contact extends MP_Profit_Plugin_Widget_Default {

    public function __construct() {
        $this->setClassName('mp_profit_widget_contact');
        $this->setName('Contact Info');
        $this->setDescription('Contact');
        $this->setIdSuffix('mp_profit_contact');
        parent::__construct();
    }

    public function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $address = apply_filters('widget_texts', empty($instance['address']) ? '' : $instance['address'], $instance);
        $phone = apply_filters('widget_text', empty($instance['phone']) ? '' : $instance['phone'], $instance);
        $email = apply_filters('widget_text', empty($instance['email']) ? '' : $instance['email'], $instance);
        $skype = apply_filters('widget_text', empty($instance['skype']) ? '' : $instance['skype'], $instance);

        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . esc_html( $title ) . $after_title;
        }
        ?>

        <ul>
			<?php if ( !empty( $address ) ) : ?>
            <li class="contact-address">
                <i class="fa fa-home"></i><div class="contact-content"><?php echo wp_kses($address, array('br' => array())); ?></div>
            </li>
            <?php endif ?>
			
			<?php if ( !empty( $phone ) ) : ?>
			<li class="contact-phone">
                <i class="fa fa-phone"></i><div class="contact-content"><?php echo esc_html( $phone ); ?></div>
            </li>
			<?php endif ?>
			
			<?php if ( !empty( $email ) ) : ?>
            <li class="contact-email">
                <i class="fa fa-envelope-o"></i><div class="contact-content"><a href="<?php echo esc_url( 'mailto:' . $email ); ?>"><?php echo esc_html( $email ); ?></a></div>
            </li>
			<?php endif ?>
			
			<?php if ( !empty( $skype ) ) : ?>
            <li class="contact-skype">
                <i class="fa fa-skype"></i><div class="contact-content"><a href="<?php echo esc_html( 'skype:' . $skype ); ?>"><?php echo esc_html( $skype ); ?></a></div>
            </li>
			<?php endif ?>
        </ul>
        <?php
        echo $after_widget;
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['address'] = $new_instance['address'];
        $instance['phone'] = strip_tags($new_instance['phone']);
        $instance['email'] = strip_tags($new_instance['email']);
        $instance['skype'] = strip_tags($new_instance['skype']);
        return $instance;
    }

    public function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $address = isset($instance['address']) ? esc_attr($instance['address']) : __('1254/21 West-Holland Street <br/> Manchester <br/> United Kingdom', 'mp-profit');
        $phone = isset($instance['phone']) ? esc_attr($instance['phone']) : __('345-677-554', 'mp-profit');
        $email = isset($instance['email']) ? esc_attr($instance['email']) : __('info@yoursite.com', 'mp-profit');
        $skype = isset($instance['skype']) ? esc_attr($instance['skype']) : __('profitconnection', 'mp-profit');
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'mp-profit'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'mp-profit'); ?></label>
            <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>"><?php echo $address; ?></textarea></p>

        <p><label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:', 'mp-profit'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('E-mail:', 'mp-profit'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('skype'); ?>"><?php _e('Skype:', 'mp-profit'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('skype'); ?>" name="<?php echo $this->get_field_name('skype'); ?>" type="text" value="<?php echo $skype; ?>" /></p>

        <?php
    }

}

add_action('widgets_init', function() {
		return register_widget( "MP_Profit_Plugin_Widget_Contact" );
});
