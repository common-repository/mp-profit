<?php
/* 
 * Class MP_Profit_Plugin_Stock_Ticker
 * 
 * Stock tiker section
 */

class MP_Profit_Plugin_Stock_Ticker {

    public function __construct() {
        add_action('mp_profit_section_stock_ticker', array($this, 'get_html'));
    }

    /*
     * Get default sidebar 
     */

    public function get_default_sidebar() {
        ?>
        <div id="stock_ticker-5" class="widget widget_stock_ticker">
            <ul id="stock_ticker_30d3" class="stock_ticker static">
                <li class="plus">
                    <a href="http://finance.yahoo.com/q?s=FB" class="sqitem"  title="<?php _e('Facebook Inc', 'mp-profit'); ?>">
                        <strong><?php _e('Facebook Inc', 'mp-profit'); ?></strong> 
                        <em>74.88</em> 
                        <span>+0.63 +0.85%</span>
                    </a>
                </li>
                <li class="plus">
                    <a href="http://finance.yahoo.com/q?s=AAPL" class="sqitem"  title="<?php _e('Apple Inc', 'mp-profit'); ?>">
                        <strong><?php _e('Apple Inc', 'mp-profit'); ?></strong> 
                        <em>114.18</em> 
                        <span>+1.36 +1.21%</span>
                    </a>
                </li>
                <li class="minus">
                    <a href="http://finance.yahoo.com/q?s=MSFT" class="sqitem"  title="<?php _e('Microsoft Corporation', 'mp-profit'); ?>">
                        <strong><?php _e('Microsoft Corporation', 'mp-profit'); ?></strong> 
                        <em>74.88</em> 
                        <span>-8.56 -5.73%</span>
                    </a>
                </li>
            </ul>
        </div>
        <?php
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
        do_action('mp_profit_before_sidebar_stock_ticker');

        if (is_active_sidebar('sidebar-stock-ticker')) :
            dynamic_sidebar('sidebar-stock-ticker');
        else:
            $this->get_default_sidebar();
        endif;

        /*
         * mp_profit_after_sidebar_records hook
         *
         * @hooked mp_profit_after_sidebar_records - 10 
         */
        do_action('mp_profit_after_sidebar_stock_ticker');
    }

    /*
     * stock tiker section
     */

    public function get_html() {
        $mp_profit_stock_ticker_bg = esc_url(get_theme_mod('mp_profit_stock_ticker_bg'));
         if (get_theme_mod('mp_profit_stock_ticker_bg', false) === false): 
             $mp_profit_stock_ticker_bg= MP_PROFIT_PLUGIN_PATH.'/images/stockticker.jpg';
        endif;
        ?>
        <section id="stock-ticker" class="stock-ticker-section transparent-section"  <?php
        if (!empty($mp_profit_stock_ticker_bg)): echo "style='background-image: url(\"" . $mp_profit_stock_ticker_bg . "\")'";
        endif;
        ?>>
            <div class="section-bg">
                <div class="container">
                    <div class="section-content">
                        <?php $this->get_sidebar(); ?>
                        <div class="clear-fixed"></div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

}
