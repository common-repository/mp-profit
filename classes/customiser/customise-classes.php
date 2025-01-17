<?php
/**
 * Profit Customize Textarea class.
 *
 * @see WP_Customize_Control
 */
if (class_exists('WP_Customize_Control')) {

    class MP_Profit_Plugin_Customize_Textarea_Control extends WP_Customize_Control {

        public $type = 'textarea';

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea($this->value()); ?></textarea>
            </label>
            <?php
        }

    }
}