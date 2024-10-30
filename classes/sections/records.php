<?php
/*
 * Class MP_Profit_Plugin_Records
 * 
 * add records section
 */

class MP_Profit_Plugin_Records {

    public function __construct() {
        add_action('mp_profit_section_records', array($this, 'get_html'));
    }

    /*
     * Get default sidebar 
     */

    public function get_default_sidebar() {
        $args = array(
            'before_name' => '',
            'after_name' => '',
            'before_widget' => '<div id="%1$s" class="widget %1$s col-xs-12 col-sm-12 col-md-12 col-lg-12">',
            'after_widget' => '</div>',
        );
        wp_cache_delete('widget-mp-profit-record', 'widget');
        $instance = array(
            'text' => __('Trading Tools', 'mp-profit'),
            'count' => '99'
        );

        the_widget('MP_Profit_Plugin_Widget_Record', $instance, $args);
        $instance = array(
            'text' => __('Current Spreads', 'mp-profit'),
            'count' => '236'
        );
        the_widget('MP_Profit_Plugin_Widget_Record', $instance, $args);
        ?>
        <div class = "clearfix visible-xs-block"></div >
        <?php
        $instance = array(
            'text' => __('Safe Customer Deposits', 'mp-profit'),
            'count' => '76'
        );
        the_widget('MP_Profit_Plugin_Widget_Record', $instance, $args);

        $instance = array(
            'text' => __('happy customers', 'mp-profit'),
            'count' => '8456'
        );
        the_widget('MP_Profit_Plugin_Widget_Record', $instance, $args);
    }

    /*
     * Get sidebar 
     */

    public function get_sidebar() {
        /*
         * mp_profit_before_sidebar_records hook
         *
         * @hooked mp_profit_before_sidebar_records - 10 
         */
        do_action('mp_profit_before_sidebar_records');
        ?>

        <div class="row">
            <?php
            if (is_active_sidebar('sidebar-records')) :
                dynamic_sidebar('sidebar-records');
            else:
                $this->get_default_sidebar();
            endif;
            ?>
        </div>
        <?php
        /*
         * mp_profit_after_sidebar_records hook
         *
         * @hooked mp_profit_after_sidebar_records - 10 
         */
        do_action('mp_profit_after_sidebar_records');
    }

    public function get_html() {
        ?>
        <section id="records" class="records-section brand-section">
            <div class="container">
                <div class="section-content">
                    <?php
                    $this->get_sidebar();
                    ?>
                </div>
            </div>
        </section>
        <?php
    }

}
