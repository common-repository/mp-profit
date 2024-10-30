<?php
/**
 * Plan  widget class
 *
 */
require_once 'Default.php';



class MP_Profit_Plugin_Widget_Plan extends MP_Profit_Plugin_Widget_Default {

   public function __construct() {
        $this->setClassName('mp_profit_widget_plan');
        $this->setName(__('Pricing', 'mp-profit'));
        $this->setDescription(__('Pricing', 'mp-profit'));
        $this->setIdSuffix('mp_profit_plan');
        parent::__construct();
    }
    private function nl2p($string) {
    $paragraphs = '';
    foreach (explode("\n", $string) as $line) {
        if (trim($line)) {
            $paragraphs .= '<p>' . $line . '</p>';
        }
    }
    return $paragraphs;
}
    public function widget($args, $instance) {
        extract($args);
        $column_xs = (!empty($instance['column_xs']) ) ? $instance['column_xs'] : '12';
        $column_sm = (!empty($instance['column_sm']) ) ? $instance['column_sm'] : '6';
        $column_md = (!empty($instance['column_md']) ) ? $instance['column_md'] : '3';
        $column_lg = (!empty($instance['column_lg']) ) ? $instance['column_lg'] : '3';
        $sub_title = (!empty($instance['sub_title']) ) ? $instance['sub_title'] : '';

        if ($column_xs === 'none' || $column_sm === 'none' || $column_md === 'none' || $column_lg === 'none') {
            echo $before_widget;
        } else {
            echo '<div class="widget mp_profit_widget_plan  col-xs-' . $column_xs . ' col-sm-' . $column_sm . ' col-md-' . $column_md . ' col-lg-' . $column_lg . '">';
        }
        ?>
        <div class="plan-box <?php if (!empty($instance['sub_title']) || count($instance) === 0): ?>recommend <?php endif; ?>">
            <div class="plan-header">
                <?php if (!empty($instance['name'])): ?>
                    <div class="plan-name"><?php echo esc_html( $instance['name'] ); ?></div>
                <?php endif; ?>
                <?php if (!empty($instance['sub_title'])) : ?>
                    <div class="plan-tagline"><?php echo esc_html( $sub_title ); ?></div>
                    <?php
                endif;
                if (count($instance) === 0) : echo '<h4 class="plan-name">' . __('Premium', 'mp-profit') . '</h4>';
                    echo '<div class="plan-tagline">' . __('best value', 'mp-profit') . '</div>';
                endif;
                ?>
            </div>
            <?php if (!empty($instance['currency']) || !empty($instance['pricing']) || !empty($instance['period'])): ?>
                <div class="plan-pricing">
                    <?php
                    if (!empty($instance['currency'])): echo '<span class="plan-currency">' . $instance['currency'] . '</span>';
                    endif;
                    ?>
                    <?php
                    if (!empty($instance['pricing'])): echo '<span class="plan-amount">' . $instance['pricing'] . '</span>';
                    endif;
                    ?>
                    <?php
                    if (!empty($instance['period'])): echo '<span class="plan-period">' . $instance['period'] . '</span>';
                    endif;
                    ?>
                </div>   
            <?php endif; ?>
            <?php if (count($instance) === 0) : ?>
                <div class="plan-pricing">
                    <?php
                    echo '<span class="plan-currency">$</span>';
                    echo '<span class="plan-amount">35</span>';
                    echo '<span class="plan-period">' . __('/mo', 'mp-profit') . '</span>';
                    ?>
                </div>   
            <?php endif; ?>
            <?php
            if (!empty($instance['text'])):
                echo '<div class="plan-options">';
                echo $this->nl2p($instance['text']);
                echo '</div>';
            endif;
            if (count($instance) === 0) :
                echo '<div class="plan-options">';
                echo $this->nl2p(__('100GB Storage
All Themes
Access to Tutorials
Auto Backup
Extended Security
24/7 Techsupport
Unlimited Access', 'mp-profit'));
                echo '</div>';
                echo ' <div class="plan-button">';
                ?>
                <a href="#" class="button" > <?php
                    _e('sign up', 'mp-profit');
                    ?></a>
                <?php
                echo '</div>';
            endif;
            ?>
            <?php if (!empty($instance['link'])): ?>
                <div class="plan-button">
                    <a href="<?php echo $instance['link']; ?>" class="button" > <?php
                        if (!empty($instance['button'])): echo $instance['button'];
                        else: _e('sign up', 'mp-profit');
                        endif;
                        ?></a>
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
        $instance['text'] = stripslashes(wp_filter_post_kses($new_instance['text']));
        $instance['name'] = strip_tags($new_instance['name']);
        $instance['link'] = strip_tags($new_instance['link']);
        $instance['button'] = strip_tags($new_instance['button']);
        $instance['pricing'] = strip_tags($new_instance['pricing']);
        $instance['currency'] = strip_tags($new_instance['currency']);
        $instance['sub_title'] = strip_tags($new_instance['sub_title']);
        $instance['period'] = strip_tags($new_instance['period']);
        $instance['column_xs'] = strip_tags($new_instance['column_xs']);
        $instance['column_sm'] = strip_tags($new_instance['column_sm']);
        $instance['column_md'] = strip_tags($new_instance['column_md']);
        $instance['column_lg'] = strip_tags($new_instance['column_lg']);
        return $instance;
    }

    public function form($instance) {
        $column_xs = (!empty($instance['column_xs']) ) ? $instance['column_xs'] : '12';
        $column_sm = (!empty($instance['column_sm']) ) ? $instance['column_sm'] : '6';
        $column_md = (!empty($instance['column_md']) ) ? $instance['column_md'] : '3';
        $column_lg = (!empty($instance['column_lg']) ) ? $instance['column_lg'] : '3';
        $sub_title = (!empty($instance['sub_title']) ) ? 'checked="checked"' : "";
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Title', 'mp-profit'); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('name'); ?>"
                   id="<?php echo $this->get_field_id('name'); ?>" value="<?php
                   if (!empty($instance['name'])): echo $instance['name'];
                   endif;
                   if (count($instance) === 0) : _e('Premium', 'mp-profit');
                   endif;
                   ?>"
                   class="widefat"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('sub_title'); ?>"><?php _e('Sub title', 'mp-profit'); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('sub_title'); ?>"
                   id="<?php echo $this->get_field_id('sub_title'); ?>" value="<?php
                   if (!empty($instance['sub_title'])): echo $instance['sub_title'];
                   endif;
                   if (count($instance) === 0) : _e('Best Value', 'mp-profit');
                   endif;
                   ?>"
                   class="widefat"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('pricing'); ?>"><?php _e('Pricing', 'mp-profit'); ?></label><br/>
            <input type="pricing" name="<?php echo $this->get_field_name('pricing'); ?>"
                   id="<?php echo $this->get_field_id('pricing'); ?>" value="<?php
                   if (!empty($instance['pricing'])): echo $instance['pricing'];
                   endif;
                   if (count($instance) === 0) : echo '35';
                   endif;
                   ?>"
                   class="widefat"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('currency'); ?>"><?php _e('Currency', 'mp-profit'); ?></label><br/>
            <input type="currency" name="<?php echo $this->get_field_name('currency'); ?>"
                   id="<?php echo $this->get_field_id('currency'); ?>" value="<?php
                   if (!empty($instance['currency'])): echo $instance['currency'];
                   endif;
                   if (count($instance) === 0) : echo '$';
                   endif;
                   ?>"
                   class="widefat"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('period'); ?>"><?php _e('Period', 'mp-profit'); ?></label><br/>
            <input type="period" name="<?php echo $this->get_field_name('period'); ?>"
                   id="<?php echo $this->get_field_id('period'); ?>" value="<?php
                   if (!empty($instance['period'])): echo $instance['period'];
                   endif;
                   if (count($instance) === 0) : echo '/mo';
                   endif;
                   ?>"
                   class="widefat"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text', 'mp-profit'); ?></label><br/>
            <textarea class="widefat" rows="8" cols="20" name="<?php echo $this->get_field_name('text'); ?>"
                      id="<?php echo $this->get_field_id('text'); ?>"><?php
                          if (!empty($instance['text'])): echo htmlspecialchars_decode($instance['text']);
                          endif;
                          if (count($instance) === 0) : _e('100GB Storage
All Themes
Access to Tutorials
Auto Backup
Extended Security
24/7 Techsupport', 'mp-profit');
                          endif;
                          ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('button'); ?>"><?php _e('Buttom text', 'mp-profit'); ?></label><br />
            <input type="text" name="<?php echo $this->get_field_name('button'); ?>" id="<?php echo $this->get_field_id('button'); ?>" value="<?php
            if (!empty($instance['button'])): echo $instance['button'];
            endif;
            if (count($instance) === 0) :
                _e('sign up', 'mp-profit');
            endif;
            ?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Buttom link', 'mp-profit'); ?></label><br />
            <input type="text" name="<?php echo $this->get_field_name('link'); ?>" id="<?php echo $this->get_field_id('link'); ?>" value="<?php
            if (!empty($instance['link'])): echo $instance['link'];
            endif;
            if (count($instance) === 0) :
                echo '#';
            endif;
            ?>" class="widefat" />
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
		return register_widget( "MP_Profit_Plugin_Widget_Plan" );
});
