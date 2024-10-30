<?php

class MP_Profit_Plugin_Slider {
    
    public function __construct() {
        add_action('add_meta_boxes', array($this, 'add_meta_box'));
        add_action('save_post', array($this, 'save'), 10, 3);
    }
    /**
     * Adds the meta box container.
     */
    public function add_meta_box($post_type) {
        $post_types = array('slider');     //limit meta box to certain post types
        if (in_array($post_type, $post_types)) {
            add_meta_box(
                    'slider_meta_box_text'
                    , __('Slide text', 'mp-profit')
                    , array($this, 'render_meta_box_text_slide')
                    , $post_type
                    , 'advanced'
                    , 'high'
            );
            add_meta_box(
                    'slider_meta_box_buttons'
                    , __('Slide buttons', 'mp-profit')
                    , array($this, 'render_meta_box_buttons_slide')
                    , $post_type
                    , 'advanced'
                    , 'high'
            );
            add_meta_box(
                    'slider_meta_box_layout'
                    , __('Slide options', 'mp-profit')
                    , array($this, 'render_meta_box_options_slide')
                    , $post_type
                    , 'advanced'
                    , 'high'
            );
        }
    }

    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save( $post_id, $post, $update ) {
		
		if ( 'slider' != $post->post_type ) {
			return;
		}

        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */

        // Check if our nonce is set.
        if (!isset($_POST['profit_inner_custom_box_nonce']))
            return $post_id;

        $nonce = $_POST['profit_inner_custom_box_nonce'];

        // Verify that the nonce is valid.
        if (!wp_verify_nonce($nonce, 'profit_inner_custom_box'))
            return $post_id;

        // If this is an autosave, our form has not been submitted,
        //     so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;

        // Check the user's permissions.
        if ('page' == $_POST['post_type']) {

            if (!current_user_can('edit_page', $post_id))
                return $post_id;
        } else {

            if (!current_user_can('edit_post', $post_id))
                return $post_id;
        }

        /* OK, its safe for us to save the data now. */


        $mydata = sanitize_text_field($_POST['slide_text']);

        // Update the meta field.
        update_post_meta($post_id, '_slide_text', $mydata);
        // Sanitize the user input.
        $mydata = sanitize_text_field($_POST['slide_first_button_title']);
        // Update the meta field.
        update_post_meta($post_id, '_slide_first_button_title', $mydata);
        // Sanitize the user input.
        $mydata = sanitize_text_field($_POST['slide_first_button_url']);
        // Update the meta field.
        update_post_meta($post_id, '_slide_first_button_url', $mydata);
        // Sanitize the user input.
        $mydata = sanitize_text_field($_POST['slide_second_button_title']);
        // Update the meta field.
        update_post_meta($post_id, '_slide_second_button_title', $mydata);
        // Sanitize the user input.
        $mydata = sanitize_text_field($_POST['slide_second_button_url']);
        // Update the meta field.
        update_post_meta($post_id, '_slide_second_button_url', $mydata);
        // Sanitize user input.
        $mydata = ( isset($_POST['slide_layout']) ? sanitize_html_class($_POST['slide_layout']) : '' );
        update_post_meta($post_id, '_slide_layout', $mydata);
        $mydata = ( isset($_POST['slide_repeat']) ? sanitize_html_class($_POST['slide_repeat']) : '' );
        update_post_meta($post_id, '_slide_repeat', $mydata);
        $mydata = ( isset($_POST['slide_position']) ? sanitize_html_class($_POST['slide_position']) : '' );
        update_post_meta($post_id, '_slide_position', $mydata);
        $mydata = ( isset($_POST['slide_size']) ? sanitize_html_class($_POST['slide_size']) : '' );
        update_post_meta($post_id, '_slide_size', $mydata);
        $mydata = ( isset($_POST['slide_bg']) ? sanitize_html_class($_POST['slide_bg']) : 'slide-wrapper-light' );
        update_post_meta($post_id, '_slide_bg', $mydata);
    }

    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_text_slide($post) {

        // Add an nonce field so we can check for it later.
        wp_nonce_field('profit_inner_custom_box', 'profit_inner_custom_box_nonce');

        // Use get_post_meta to retrieve an existing value from the database.
        $slideText = get_post_meta($post->ID, '_slide_text', true);

        // Display the form, using the current value.
        echo '<table class="form-table"><tbody><tr><td style="padding-left:0; padding-right:0;"><textarea type="text" id="slide_text" name="slide_text" class="large-text" rows="6">' . esc_html($slideText) . '</textarea></td></tr></tbody></table>';
    }

    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_buttons_slide($post) {

        // Add an nonce field so we can check for it later.
        wp_nonce_field('profit_inner_custom_box', 'profit_inner_custom_box_nonce');

        // Use get_post_meta to retrieve an existing value from the database.
        $firstButtonTitle = get_post_meta($post->ID, '_slide_first_button_title', true);
        $firstButtonUrl = get_post_meta($post->ID, '_slide_first_button_url', true);

        // Display the form, using the current value.
        echo '<table class="form-table"><tbody><tr><th scope="row"><label for="slide_first_button_title">';
        _e('First button title', 'mp-profit');
        echo '</label></th> ';
        echo '<td><input type="text"  class="large-text" id="slide_first_button_title" name="slide_first_button_title"';
        echo ' value="' . esc_html($firstButtonTitle) . '"  /></td>';

        // Display the form, using the current value.
        echo '<tr><th scope="row"><label for="slide_first_button_url">';
        _e('First button url', 'mp-profit');
        echo '</label></th> ';
        echo '<td><input type="text"  class="large-text" id="slide_first_button_url" name="slide_first_button_url"';
        echo ' value="' . esc_url($firstButtonUrl) . '"  /></td></tr>';

        // Use get_post_meta to retrieve an existing value from the database.
        $secondButtonTitle = get_post_meta($post->ID, '_slide_second_button_title', true);
        $secondButtonUrl = get_post_meta($post->ID, '_slide_second_button_url', true);

        // Display the form, using the current value.
        echo '<tr><th scope="row"><label for="slide_second_button_title">';
        _e('Second button title', 'mp-profit');
        echo '</label></th> ';
        echo '<td><input type="text" class="large-text" id="slide_second_button_title" name="slide_second_button_title"';
        echo ' value="' . esc_html($secondButtonTitle) . '"  /></td>';

        // Display the form, using the current value.
        echo '<tr><th scope="row"><label for="slide_second_button_url">';
        _e('Second button url', 'mp-profit');
        echo '</label></th> ';
        echo '<td><input type="text" class="large-text" id="slide_second_button_url" name="slide_second_button_url"';
        echo ' value="' . esc_url($secondButtonUrl) . '"  /></td></tr></tbody></table>';
    }

    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_options_slide($post) {

        // Add an nonce field so we can check for it later.
        wp_nonce_field('profit_inner_custom_box', 'profit_inner_custom_box_nonce');

        // Use get_post_meta to retrieve an existing value from the database.
        // Use get_post_meta to retrieve an existing value from the database.

        $layout = (get_post_meta($post->ID, '_slide_layout', true)) ? get_post_meta($post->ID, '_slide_layout', true) : "slide-wrapper-left";
        $repeat = (get_post_meta($post->ID, '_slide_repeat', true)) ? get_post_meta($post->ID, '_slide_repeat', true) : "repeat";
        $position = (get_post_meta($post->ID, '_slide_position', true)) ? get_post_meta($post->ID, '_slide_position', true) : "center";
        $size = (get_post_meta($post->ID, '_slide_size', true)) ? get_post_meta($post->ID, '_slide_size', true) : "auto";
        $slide_bg = (get_post_meta($post->ID, '_slide_bg', true)) ? get_post_meta($post->ID, '_slide_bg', true) : "slide-wrapper-light";
        // Display the form, using the current value.
        echo '<table class="form-table"><tbody><tr><th scope="row"><label for="slide_layout">';
        _e('Slider content position', 'mp-profit');
        echo '</label></th> ';
        ?>
        <td> 
            <fieldset>
                <label>
                    <input type="radio" name="slide_layout" value="slide-wrapper-left" <?php checked($layout, 'slide-wrapper-left'); ?> ><?php _e('Left', 'mp-profit'); ?>
                </label><br>
                <label>
                    <input type="radio" name="slide_layout" value="slide-wrapper-center" <?php checked($layout, 'slide-wrapper-center'); ?> ><?php _e('Center', 'mp-profit'); ?>
                </label><br>
                <label>
                    <input type="radio" name="slide_layout" value="slide-wrapper-right" <?php checked($layout, 'slide-wrapper-right'); ?> ><?php _e('Right', 'mp-profit'); ?>
                </label>
            </fieldset>
        </td>
        </tr>
        <tr>
            <th scope="row"><label for="slide_bg"><?php _e('Slider overlay', 'mp-profit'); ?></label></th>
            <td> 
                <fieldset>
                    <label>
                        <input type="checkbox" id="slide_bg" name="slide_bg" value="slide-wrapper-white" <?php checked($slide_bg, 'slide-wrapper-white'); ?> ><?php _e('Use white overlay', 'mp-profit'); ?>
                    </label>
                </fieldset>
            </td>
        </tr>
        <tr><th scope="row"><label for="slide_repeat">
                    <?php _e('Background repeat', 'mp-profit'); ?>
                </label></th> 
            <td> 
                <fieldset>
                    <label>
                        <input type="radio" name="slide_repeat" value="no-repeat" <?php checked($repeat, 'no-repeat'); ?> ><?php _e('No repeat', 'mp-profit'); ?>
                    </label><br>
                    <label>
                        <input type="radio" name="slide_repeat" value="repeat" <?php checked($repeat, 'repeat'); ?> ><?php _e('Tile', 'mp-profit'); ?>
                    </label><br>
                    <label>
                        <input type="radio" name="slide_repeat" value="repeat-x" <?php checked($repeat, 'repeat-x'); ?> ><?php _e('Tile Horizontally', 'mp-profit'); ?>
                    </label><br>
                    <label>
                        <input type="radio" name="slide_repeat" value="repeat-y" <?php checked($repeat, 'repeat-y'); ?> ><?php _e('Tile Vertically', 'mp-profit'); ?>
                    </label>
                </fieldset>
            </td>
        </tr>
        <tr><th scope="row"><label for="slide_position">
                    <?php _e('Background Position', 'mp-profit'); ?>
                </label></th> 
            <td> 
                <fieldset>
                    <label>
                        <input type="radio" name="slide_position" value="left" <?php checked($position, 'left'); ?> ><?php _e('Left', 'mp-profit'); ?>
                    </label><br>
                    <label>
                        <input type="radio" name="slide_position" value="center" <?php checked($position, 'center'); ?> ><?php _e('Center', 'mp-profit'); ?>
                    </label><br>
                    <label>
                        <input type="radio" name="slide_position" value="right" <?php checked($position, 'right'); ?> ><?php _e('Right', 'mp-profit'); ?>
                    </label>
                </fieldset>
            </td>
        </tr>
        <tr><th scope="row"><label for="slide_size">
                    <?php _e('Bacground Size', 'mp-profit'); ?>
                </label></th> 
            <td> 
                <fieldset>
                    <label>
                        <input type="radio" name="slide_size" value="auto" <?php checked($size, 'auto'); ?> ><?php _e('Auto', 'mp-profit'); ?>
                    </label><br>
                    <label>
                        <input type="radio" name="slide_size" value="contain" <?php checked($size, 'contain'); ?> ><?php _e('Contain', 'mp-profit'); ?>
                    </label><br>
                    <label>
                        <input type="radio" name="slide_size" value="cover" <?php checked($size, 'cover'); ?> ><?php _e('Cover', 'mp-profit'); ?>
                    </label>
                </fieldset>
            </td>
            <?php
            echo '</tr></tbody></table>';
	}

}
new MP_Profit_Plugin_Slider();
