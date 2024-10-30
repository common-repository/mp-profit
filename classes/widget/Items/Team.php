<?php
/**
 * Team  widget class
 *
 */
require_once 'Default.php';

class MP_Profit_Plugin_Widget_Team extends MP_Profit_Plugin_Widget_Default {

    public function __construct() {
        $this->setClassName('mp_profit_widget_team');
        $this->setName(__('Team', 'mp-profit'));
        $this->setDescription(__('Team', 'mp-profit'));
        $this->setIdSuffix('mp_profit_team');
        parent::__construct();
    }

    public function img_url($instance) {
        global $wpdb;
        $image_src = $instance['image_uri'];
        if (!empty($image_src)):
            $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
            $id = $wpdb->get_var($query);
            if (is_null($id)):
                return $image_src;
            endif;
            $image_uri = wp_get_attachment_image_src($id, array(870, 480));
            return $image_uri[0];
        endif;
        return '';
    }

    public function widget($args, $instance) {
        extract($args);
        $column_xs = (!empty($instance['column_xs']) ) ? $instance['column_xs'] : '6';
        $column_sm = (!empty($instance['column_sm']) ) ? $instance['column_sm'] : '6';
        $column_md = (!empty($instance['column_md']) ) ? $instance['column_md'] : '3';
        $column_lg = (!empty($instance['column_lg']) ) ? $instance['column_lg'] : '3';
        if ($column_xs === 'none' || $column_sm === 'none' || $column_md === 'none' || $column_lg === 'none') {
            echo $before_widget;
        } else {
            echo '<div class="widget mp_profit_widget_team  col-xs-' . $column_xs . ' col-sm-' . $column_sm . ' col-md-' . $column_md . ' col-lg-' . $column_lg . '">';
        }
        $image_uri = $this->img_url($instance);
        ?>
        <div class="team-box">
            <div class="team-avatar" 
                 <?php if (!empty($image_uri)): ?> style="background-image: url(<?php echo esc_url($image_uri); ?>)" <?php endif; ?>
                 ></div>
			<?php
				if ( !empty($instance['name']) || !empty($instance['position']) || !empty($instance['text']) || !empty($instance['facebook_url']) || !empty($instance['twitter_url']) || !empty($instance['instagram_url']) ) :
			?>
				<div class="team-description">
					<div class="team-el">
						<?php
						if (!empty($instance['name'])):
                            if (!empty($instance['url'])){
                                echo ' <h4 class="team-name"><a href="' . esc_url( $instance['url'] ) . '" title="' . esc_html( $instance['name'] ) . '">' . esc_html( $instance['name'] ) . '</a></h4>';
                            }else {
                                echo ' <h4 class="team-name">' . esc_html( $instance['name'] ) . '</h4>';
                            }
						endif;
						?>
						<?php
						if (!empty($instance['position'])):
							echo '<p class="team-position">';
							echo htmlspecialchars_decode($instance['position']);
							echo '</p>';
						endif;
						?>
						
						<?php if ( !empty($instance['text']) ): ?>
						<hr class="small-hr"/>
						<?php endif; ?>
						
						<?php
						if (!empty($instance['text'])):
							echo '<p class="team-content">';
							echo htmlspecialchars_decode($instance['text']);
							echo '</p>';
						endif;
						?>
						<?php if (!empty($instance['facebook_url'])): ?>
							<a href="<?php echo esc_url($instance['facebook_url']); ?>" class="team-social"  target="_blank"><i class="fa fa-facebook"></i></a>
							<?php
						endif;
						?>
						<?php if (!empty($instance['twitter_url'])): ?>
							<a href="<?php echo esc_url($instance['twitter_url']); ?>"  class="team-social"  target="_blank"><i class="fa fa-twitter"></i></a>
							<?php
						endif;
						?>
						<?php if (!empty($instance['instagram_url'])): ?>
							<a href="<?php echo esc_url($instance['instagram_url']); ?>"  class="team-social"  target="_blank"><i class="fa fa-instagram"></i></a>
							<?php
						endif;
						?>
						<div class="clearfix"></div>
					</div>
				</div>
			<?php endif; ?>
        </div>
        <?php
        if ($column_xs === 'none' || $column_sm === 'none' || $column_md === 'none' || $column_lg === 'none') {
            echo $after_widget;
        } else {
            echo '</div>';
        }
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['position'] = stripslashes(wp_filter_post_kses($new_instance['position']));
        $instance['name'] = strip_tags($new_instance['name']);
        $instance['url'] = esc_url($new_instance['url']);
        $instance['text'] = strip_tags($new_instance['text']);
        $instance['image_uri'] = strip_tags($new_instance['image_uri']);
        $instance['facebook_url'] = strip_tags($new_instance['facebook_url']);
        $instance['twitter_url'] = strip_tags($new_instance['twitter_url']);
        $instance['instagram_url'] = strip_tags($new_instance['instagram_url']);
        $instance['column_xs'] = strip_tags($new_instance['column_xs']);
        $instance['column_sm'] = strip_tags($new_instance['column_sm']);
        $instance['column_md'] = strip_tags($new_instance['column_md']);
        $instance['column_lg'] = strip_tags($new_instance['column_lg']);
        return $instance;
    }

    public function get_upload_image($instance) {
        echo '<img class="custom_media_image" src="';
        if (!empty($instance['image_uri'])) :
            echo $instance['image_uri'];
        endif;
        echo '" style="margin:0;padding:0;max-width:100%;';
        if (!empty($instance['image_uri'])) :
            echo 'display:block;';
        else:
            echo 'display:none;';
        endif;
        echo '" />';
    }

    public function form($instance) {

        $column_xs = (!empty($instance['column_xs']) ) ? $instance['column_xs'] : '6';
        $column_sm = (!empty($instance['column_sm']) ) ? $instance['column_sm'] : '6';
        $column_md = (!empty($instance['column_md']) ) ? $instance['column_md'] : '3';
        $column_lg = (!empty($instance['column_lg']) ) ? $instance['column_lg'] : '3';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Name:', 'mp-profit'); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('name'); ?>"
                   id="<?php echo $this->get_field_id('name'); ?>" value="<?php
            if (!empty($instance['name'])): echo $instance['name'];
            endif;
            ?>"
                   class="widefat"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Link:', 'mp-profit'); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('url'); ?>"
                   id="<?php echo $this->get_field_id('url'); ?>" value="<?php
            if (!empty($instance['url'])): echo esc_url($instance['url']);
            endif;
            ?>"
                   class="widefat"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('position'); ?>"><?php _e('Position:', 'mp-profit'); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('position'); ?>"
                   id="<?php echo $this->get_field_id('position'); ?>" value="<?php
                   if (!empty($instance['position'])): echo $instance['position'];
                   endif;
                   ?>"
                   class="widefat"/>
        </p>   
        <p>
            <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:', 'mp-profit'); ?></label><br/>
            <textarea name="<?php echo $this->get_field_name('text'); ?>"
                      id="<?php echo $this->get_field_id('text'); ?>" class="widefat"><?php
            if (!empty($instance['text'])): echo $instance['text'];
            endif;
            ?></textarea>

        </p>  
        <p>
            <label for="<?php echo $this->get_field_id('facebook_url'); ?>"><?php _e('Facebook link:', 'mp-profit'); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('facebook_url'); ?>"
                   id="<?php echo $this->get_field_id('facebook_url'); ?>" value="<?php
                   if (!empty($instance['facebook_url'])): echo $instance['facebook_url'];
                   endif;
                   ?>"
                   class="widefat"/>
        </p>  
        <p>
            <label for="<?php echo $this->get_field_id('twitter_url'); ?>"><?php _e('Twitter link:', 'mp-profit'); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('twitter_url'); ?>"
                   id="<?php echo $this->get_field_id('twitter_url'); ?>" value="<?php
                   if (!empty($instance['twitter_url'])): echo $instance['twitter_url'];
                   endif;
                   ?>"
                   class="widefat"/>
        </p>  
        <p>
            <label for="<?php echo $this->get_field_id('instagram_url'); ?>"><?php _e('Instagram link:', 'mp-profit'); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('instagram_url'); ?>"
                   id="<?php echo $this->get_field_id('instagram_url'); ?>" value="<?php
                   if (!empty($instance['instagram_url'])): echo $instance['instagram_url'];
                   endif;
                   ?>"
                   class="widefat"/>
        </p> 
        <p>
            <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php _e('Photo:', 'mp-profit'); ?></label><br/>
                   <?php $this->get_upload_image($instance); ?>
            <input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('image_uri'); ?>"
                   id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php
                   if (!empty($instance['image_uri'])): echo $instance['image_uri'];
                   endif;
                   ?>"
                   style="margin-top:5px;">
            <input type="button" class="button button-primary mp_profit_media_button" id="custom_media_button" name="<?php echo $this->get_field_name('image_uri'); ?>" value="<?php _e('Upload Image', 'mp-profit'); ?>"
                   style="margin-top:5px;"/>
        </p>
        <div style="overflow:hidden;  margin: 0 0 1em;">
            <label for="colums"><?php _e('Widget Size (x of 12):', 'mp-profit'); ?></label><br/>
            <p style='width:92px; float:left; margin: 1em 0 0;'>
                <label for="<?php echo $this->get_field_id('column_xs'); ?>"><?php _e('Phone', 'mp-profit'); ?></label><br/>
                <select name="<?php echo $this->get_field_name('column_xs'); ?>"
                        id="<?php echo $this->get_field_id('column_xs'); ?>">
                    <option value="none" <?php
                            if ($column_xs === 'none'): echo ' selected ';
                            endif;
                            ?>>none</option>
                    <option value="1" <?php
                            if ($column_xs === '1'): echo ' selected ';
                            endif;
                            ?>>1</option>
                    <option value="2" <?php
                            if ($column_xs === '2'): echo ' selected ';
                            endif;
                            ?>>2</option>                
                    <option value="3" <?php
                            if ($column_xs === '3'): echo ' selected ';
                            endif;
                            ?>>3</option>
                    <option value="4" <?php
                            if ($column_xs === '4'): echo ' selected ';
                            endif;
                            ?>>4</option>
                    <option value="6" <?php
                            if ($column_xs === '6'): echo ' selected ';
                            endif;
                            ?>>6</option>
                    <option value="12" <?php
                            if ($column_xs === '12'): echo ' selected ';
                            endif;
                            ?>>12</option>
                </select>
            </p>  
            <p style='width:92px; float:left; margin: 1em 0 0;'>
                <label for="<?php echo $this->get_field_id('column_sm'); ?>"><?php _e('Tablet', 'mp-profit'); ?></label><br/>
                <select name="<?php echo $this->get_field_name('column_sm'); ?>"
                        id="<?php echo $this->get_field_id('column_sm'); ?>">
                    <option value="none" <?php
                            if ($column_sm === 'none'): echo ' selected ';
                            endif;
                            ?>>none</option>
                    <option value="1" <?php
                            if ($column_sm === '1'): echo ' selected ';
                            endif;
                            ?>>1</option>
                    <option value="2" <?php
                            if ($column_sm === '2'): echo ' selected ';
                            endif;
                            ?>>2</option>                
                    <option value="3" <?php
                            if ($column_sm === '3'): echo ' selected ';
                            endif;
                            ?>>3</option>
                    <option value="4" <?php
                            if ($column_sm === '4'): echo ' selected ';
                            endif;
                            ?>>4</option>
                    <option value="6" <?php
                            if ($column_sm === '6'): echo ' selected ';
                            endif;
                            ?>>6</option>
                    <option value="12" <?php
                            if ($column_sm === '12'): echo ' selected ';
                            endif;
                            ?>>12</option>
                </select>
            </p>  
        </div>
        <div style="overflow:hidden;  margin: 0 0 1em;">
            <p style='width:92px; float:left; margin: 1em 0 0;'>
                <label for="<?php echo $this->get_field_id('column_md'); ?>"><?php _e('Desktop', 'mp-profit'); ?></label><br/>
                <select name="<?php echo $this->get_field_name('column_md'); ?>"
                        id="<?php echo $this->get_field_id('column_md'); ?>">
                    <option value="none" <?php
                            if ($column_md === 'none'): echo ' selected ';
                            endif;
                            ?>>none</option>
                    <option value="1" <?php
                            if ($column_md === '1'): echo ' selected ';
                            endif;
                            ?>>1</option>
                    <option value="2" <?php
                            if ($column_md === '2'): echo ' selected ';
                            endif;
                            ?>>2</option>                
                    <option value="3" <?php
                            if ($column_md === '3'): echo ' selected ';
                            endif;
                            ?>>3</option>
                    <option value="4" <?php
                            if ($column_md === '4'): echo ' selected ';
                            endif;
                            ?>>4</option>
                    <option value="6" <?php
                            if ($column_md === '6'): echo ' selected ';
                            endif;
                            ?>>6</option>
                    <option value="12" <?php
                            if ($column_md === '12'): echo ' selected ';
                            endif;
                            ?>>12</option>

                </select>
            </p> 
            <p style='width:92px; float:left; margin: 1em 0 0;'>
                <label for="<?php echo $this->get_field_id('column_lg'); ?>"><?php _e('Large Desktop', 'mp-profit'); ?></label><br/>
                <select name="<?php echo $this->get_field_name('column_lg'); ?>"
                        id="<?php echo $this->get_field_id('column_lg'); ?>">
                    <option value="none" <?php
                            if ($column_lg === 'none'): echo ' selected ';
                            endif;
                            ?>>none</option>
                    <option value="1" <?php
                            if ($column_lg === '1'): echo ' selected ';
                            endif;
                            ?>>1</option>
                    <option value="2" <?php
                            if ($column_lg === '2'): echo ' selected ';
                            endif;
                            ?>>2</option>                
                    <option value="3" <?php
                            if ($column_lg === '3'): echo ' selected ';
                            endif;
                            ?>>3</option>
                    <option value="4" <?php
                            if ($column_lg === '4'): echo ' selected ';
                            endif;
                            ?>>4</option>
                    <option value="6" <?php
                            if ($column_lg === '6'): echo ' selected ';
                            endif;
                            ?>>6</option>
                    <option value="12" <?php
                            if ($column_lg === '12'): echo ' selected ';
                            endif;
                            ?>>12</option>
                </select>
            </p> 
        </div>
        <?php
    }

}

add_action('widgets_init', function() {
		return register_widget( "MP_Profit_Plugin_Widget_Team" );
});
