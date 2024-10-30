<?php
/**
 * Team  widget class
 *
 */
require_once 'Default.php';

class MP_Profit_Plugin_Widget_Break extends MP_Profit_Plugin_Widget_Default {

    public function __construct() {
        $this->setClassName('mp_profit_widget_break');
        $this->setName(__('Break', 'mp-profit'));
        $this->setDescription(__('Use this widget to make next widget from new line.', 'mp-profit'));
        $this->setIdSuffix('mp_profit_break');
        parent::__construct();
    }

    public function widget($args, $instance) {
        extract($args);
        $text = '';
        if (isset($instance['visiblelgblock']) || isset($instance['visiblemdblock']) || isset($instance['visiblesmblock']) || isset($instance['visiblexsblock'])) {
            $lg = isset($instance['visiblelgblock']) ? ' visible-lg-block' : '';
            $md = isset($instance['visiblemdblock']) ? ' visible-md-block' : '';
            $sm = isset($instance['visiblesmblock']) ? ' visible-sm-block' : '';
            $xs = isset($instance['visiblexsblock']) ? ' visible-xs-block' : '';
            $text = '<div class="clearfix' . $lg . $md . $sm . $xs . '"></div>';
        }

        echo $text;
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['visiblelgblock'] = $new_instance['visiblelgblock'];
        $instance['visiblemdblock'] = $new_instance['visiblemdblock'];
        $instance['visiblesmblock'] = $new_instance['visiblesmblock'];
        $instance['visiblexsblock'] = $new_instance['visiblexsblock'];
        return $instance;
    }

    public function form($instance) {

        $visiblelgblock = isset($instance['visiblelgblock']) ? (bool) $instance['visiblelgblock'] : false;
        $visiblemdblock = isset($instance['visiblemdblock']) ? (bool) $instance['visiblemdblock'] : false;
        $visiblesmblock = isset($instance['visiblesmblock']) ? (bool) $instance['visiblesmblock'] : false;
        $visiblexsblock = isset($instance['visiblexsblock']) ? (bool) $instance['visiblexsblock'] : false;
        ?>
        <div style="margin-top:10px;"><p><?php _e('Use this widget to make next widget from new line.', 'mp-profit'); ?></p></div>
        <p><input class="checkbox" type="checkbox" <?php checked($visiblelgblock); ?> id="<?php echo $this->get_field_id('visiblelgblock'); ?>" name="<?php echo $this->get_field_name('visiblelgblock'); ?>" />
            <label for="<?php echo $this->get_field_id('visiblelgblock'); ?>"><?php _e('Apply on wide-screen', 'mp-profit'); ?></label></p>
        <p><input class="checkbox" type="checkbox" <?php checked($visiblemdblock); ?> id="<?php echo $this->get_field_id('visiblemdblock'); ?>" name="<?php echo $this->get_field_name('visiblemdblock'); ?>" />
            <label for="<?php echo $this->get_field_id('visiblemdblock'); ?>"><?php _e('Apply on desktop', 'mp-profit'); ?></label></p>
        <p><input class="checkbox" type="checkbox" <?php checked($visiblesmblock); ?> id="<?php echo $this->get_field_id('visiblesmblock'); ?>" name="<?php echo $this->get_field_name('visiblesmblock'); ?>" />
            <label for="<?php echo $this->get_field_id('visiblesmblock'); ?>"><?php _e('Apply on tablet', 'mp-profit'); ?></label></p>
        <p><input class="checkbox" type="checkbox" <?php checked($visiblexsblock); ?> id="<?php echo $this->get_field_id('visiblexsblock'); ?>" name="<?php echo $this->get_field_name('visiblexsblock'); ?>" />
            <label for="<?php echo $this->get_field_id('visiblexsblock'); ?>"><?php _e('Apply on mobile', 'mp-profit'); ?></label></p>
        <?php
    }

}

add_action('widgets_init', function() {
		return register_widget( "MP_Profit_Plugin_Widget_Break" );
});
