<?php
/*
 * class MP_Profit_Plugin_Pricing
 * add pricing section
 */

class MP_Profit_Plugin_Pricing {

    public function __construct() {
        add_action('mp_profit_section_pricing', array($this, 'get_html'));
    }

    /*
     * Get default sidebar 
     */

    public function get_default_sidebar() {
        $args = array(
            'before_title' => '',
            'after_title' => '',
            'before_widget' => '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">',
            'after_widget' => '</div>',
        );
        $instance = array(
            'text' => __('15 Live trading sessions</p> <p>15 Webinars</p> <p>15 Videos and Tutorials</p> <p>Access to Market Analysis</p> <p>Market Strategist</p> <p>24/7 Technical Support', 'mp-profit'),
            'name' => __('basic', 'mp-profit'),
            'link' => '#pricing',
            'background_color' => '#e7ac44',
            'background_color_hover' => '#f8c468',
            'pricing' => '15',
            'currency' => '$',
            'period' => '/mo'
        );
        wp_cache_delete('widget-mp-profit-pricing', 'widget');
        the_widget('MP_Profit_Plugin_Widget_Plan', $instance, $args);
        $instance = array(
            'text' => __('15 Live trading sessions</p> <p>15 Webinars</p> <p>15 Videos and Tutorials</p> <p>Access to Market Analysis</p> <p>Market Strategist</p> <p>24/7 Technical Support', 'mp-profit'),
            'name' => __('standard', 'mp-profit'),
            'link' => '#pricing',
            'background_color' => '#3ab0e2',
            'background_color_hover' => '#64c9f4',
            'pricing' => '20',
            'currency' => '$',
            'period' => '/mo'
        );
        the_widget('MP_Profit_Plugin_Widget_Plan', $instance, $args);
        ?> <div class="clearfix visible-sm-block"></div> <?php
        $instance = array(
            'text' => __('15 Live trading sessions</p> <p>15 Webinars</p> <p>15 Videos and Tutorials</p> <p>Access to Market Analysis</p> <p>Market Strategist</p> <p>24/7 Technical Support</p> <p>Unlimited Access', 'mp-profit'),
            'name' => __('Premium', 'mp-profit'),
            'sub_title' => __('best value', 'mp-profit'),
            'link' => '#pricing',
            'background_color' => '#27b399',
            'background_color_hover' => '#37c4aa',
            'pricing' => '35',
            'currency' => '$',
            'recommend' => 'on',
            'period' => '/mo'
        );
        the_widget('MP_Profit_Plugin_Widget_Plan', $instance, $args);
        $instance = array(
            'text' => __('15 Live trading sessions</p> <p>15 Webinars</p> <p>15 Videos and Tutorials</p> <p>Access to Market Analysis</p> <p>Market Strategist</p> <p>24/7 Technical Support', 'mp-profit'),
            'name' => __('ultimate', 'mp-profit'),
            'link' => '#pricing',
            'background_color' => '#e96656',
            'background_color_hover' => '#f88a7c',
            'pricing' => '99',
            'currency' => '$',
            'period' => '/mo'
        );
        the_widget('MP_Profit_Plugin_Widget_Plan', $instance, $args);
    }

    /*
     * Get sidebar 
     */

    public function get_sidebar() {
        /*
         * mp_profit_before_sidebar_pricing hook
         *
         * @hooked mp_profit_before_sidebar_pricing - 10 
         */
        do_action('mp_profit_before_sidebar_pricing');
        ?>
        <div class="row">
            <?php
            if (is_active_sidebar('sidebar-pricing')) :
                dynamic_sidebar('sidebar-pricing');
            else:
                $this->get_default_sidebar();
            endif;
            ?>
            <?php
            /*
             * mp_profit_after_sidebar_pricing hook
             *
             * @hooked mp_profit_after_sidebar_pricing - 10 
             */
            do_action('mp_profit_after_sidebar_pricing');
        }

        /*
         * Get title 
         */

        public function get_title() {
            $mp_profit_pricing_title = esc_html(get_theme_mod('mp_profit_pricing_title'));
            if (get_theme_mod('mp_profit_pricing_title', false) === false) :
                ?> 
                <h2 class="section-title"><?php _e('Choose your plan', 'mp-profit'); ?></h2>
                <?php
            else:
                if (!empty($mp_profit_pricing_title)):
                    ?>
                    <h2 class="section-title"><?php echo $mp_profit_pricing_title; ?></h2>
                    <?php
                endif;
            endif;
        }

        /*
         * Get subtitle 
         */

        public function get_subtitle() {
            $mp_profit_pricing_subtitle = esc_html(get_theme_mod('mp_profit_pricing_subtitle'));

            if (get_theme_mod('mp_profit_pricing_subtitle', false) === false) :
                ?> 
                <div class="section-subtitle"><?php _e('Pricing section for your product or service', 'mp-profit'); ?></div>
                <?php
            else:
                if (!empty($mp_profit_pricing_subtitle)):
                    ?>
                    <div class="section-subtitle"><?php echo $mp_profit_pricing_subtitle; ?></div>
                    <?php
                endif;
            endif;
        }

        public function get_html() {
            ?>
            <section id="pricing" class="pricing-section default-section">
                <div class="container">
                    <div class="section-content">
                        <?php
                        $this->get_title();
                        $this->get_subtitle();
                        $this->get_sidebar();
                        ?>
                    </div>
                </div>
        </div>
        </section>
        <?php
    }

}
