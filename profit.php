<?php

/*
 * Plugin Name: Profit Theme Engine
 * Description: Adds Slider and Front Page Sections to Profit theme.
 * Version: 1.3.2
 * Author: MotoPress
 * Author URI: https://motopress.com/
 * License: GPLv2 or later
 * Text Domain: mp-profit
 * Domain Path: /languages
 */

// Path to classes folder in Plugin
defined('MP_PROFIT_PLUGIN_CLASS_PATH') || define('MP_PROFIT_PLUGIN_CLASS_PATH', plugin_dir_path(__FILE__) . 'classes/');
defined('MP_PROFIT_PLUGIN_PATH') || define('MP_PROFIT_PLUGIN_PATH', plugin_dir_url(__FILE__));

class MP_Profit_Plugin {

    public function __construct() {
        load_plugin_textdomain('mp-profit', false, dirname(plugin_basename(__FILE__)) . '/languages/');
        $this->admin_init();
        add_action('wp_enqueue_scripts', array($this, 'register_scripts'));
        $this->include_files();
        $this->init_plugin();
        $this->init_sections();
        $this->stock_ticker_defaults();
    }

    /*
     * Set stock ticker defaults
    */

    public function stock_ticker_defaults() {        
        if (get_option('stock_ticker_defaults', false) === false):
            $array["template"] = "<strong>%company%</strong> <em>%price%</em> <span>%change% %changep%</span>";
            $array["minus"] = "#8b8e92";
            $array["plus"] = get_option('mp_profit_color_primary', '#3498db');
            update_option('stock_ticker_defaults', $array);           
        endif;
    }

    /*
     * Admin init
     */

    public function admin_init() {
        add_action('admin_enqueue_scripts', array($this, 'register_admin_scripts'));
    }

    /*
     * Register admin scripts
     */

    public function register_admin_scripts() {
        wp_enqueue_media();
        $dependency = array(
            'jquery'
        );
        if (wp_register_script('mp_profit_plugin_widget', MP_PROFIT_PLUGIN_PATH . 'js/widget.js', $dependency, '1.1.4', true)) {
            wp_enqueue_script('mp_profit_plugin_widget');
        }
    }

    public function init_plugin() {

        new MP_Profit_Plugin_Widget_Registrator();
    }

    public function include_files() {
        /*
         * Include Slider
         */
        include_once MP_PROFIT_PLUGIN_CLASS_PATH . '/posttype/slider.php';
        include_once MP_PROFIT_PLUGIN_CLASS_PATH . '/metabox/slider.php';

        /*
         * Include Services
         */
        include_once MP_PROFIT_PLUGIN_CLASS_PATH . '/posttype/services.php';

        /*
         * Include Sections
         */
        include_once MP_PROFIT_PLUGIN_CLASS_PATH . '/sections/contact.php';
        include_once MP_PROFIT_PLUGIN_CLASS_PATH . '/sections/features.php';
        include_once MP_PROFIT_PLUGIN_CLASS_PATH . '/sections/records.php';
        include_once MP_PROFIT_PLUGIN_CLASS_PATH . '/sections/services.php';
        include_once MP_PROFIT_PLUGIN_CLASS_PATH . '/sections/team.php';
        include_once MP_PROFIT_PLUGIN_CLASS_PATH . '/sections/pricing.php';
        include_once MP_PROFIT_PLUGIN_CLASS_PATH . '/sections/testimonials.php';
        include_once MP_PROFIT_PLUGIN_CLASS_PATH . '/sections/map.php';
        include_once MP_PROFIT_PLUGIN_CLASS_PATH . '/sections/slider.php';
        include_once MP_PROFIT_PLUGIN_CLASS_PATH . '/sections/first-call-to-action.php';
        include_once MP_PROFIT_PLUGIN_CLASS_PATH . '/sections/calculator.php';
        include_once MP_PROFIT_PLUGIN_CLASS_PATH . '/sections/stock-ticker.php';

        /*
         * Include Widgets Registrator
         */
        include_once MP_PROFIT_PLUGIN_CLASS_PATH . '/widget/Registrator.php';

        //Inclide footer defaults widget
        include_once MP_PROFIT_PLUGIN_CLASS_PATH . '/footer/footer.php';

        //Inclide customizer for sections         
        include_once MP_PROFIT_PLUGIN_CLASS_PATH . '/customiser/customiser.php';
    }

    /*
     * Init sections  
     */

    public function init_sections() {
        new MP_Profit_Plugin_Contact();
        new MP_Profit_Plugin_Features();
        new MP_Profit_Plugin_Records();
        new MP_Profit_Plugin_Services();
        new MP_Profit_Plugin_Team();
        new MP_Profit_Plugin_Pricing();
        new MP_Profit_Plugin_Testimonials();
        new MP_Profit_Plugin_Google_Map();
        new MP_Profit_Plugin_Slider_Section();
        new MP_Profit_Plugin_Calculator();
        new MP_Profit_Plugin_First_Action();
        new MP_Profit_Plugin_Stock_Ticker();
    }

    /*
     * Register  scripts
     */

    public function register_scripts() {
        if (is_page_template('template-front-page.php')) {
            $dependency = array(
                'jquery'
            );
            if (wp_register_script('mp_profit_front', MP_PROFIT_PLUGIN_PATH . 'js/mp_profit_front.js', $dependency, '1.1.4', true)) {
                wp_enqueue_script('mp_profit_front');

                if ( isset($_POST['scrollPosition']) ) {
                    $mp_profit_position = array(
                        'position' => intval($_POST['scrollPosition'])
                    );
					wp_localize_script('mp_profit_front', 'mp_profit', $mp_profit_position);
				}
            }
        }
    }

}

new MP_Profit_Plugin();
