<?php

/*
 * Class MP_Profit_Plugin_Footer
 *
 * add actions for default widgets if footer
 */

class MP_Profit_Plugin_Footer {

    private $args;
    private $instance;

    public function __construct() {
        $this->args = array(
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>'
        );
        $this->instance = array();

        add_action('mp_profit_footer_default_widget_about', array($this, 'default_widget_about'));
        add_action('mp_profit_footer_default_widget_contact', array($this, 'default_widget_contact'));

    }

    /*
     * get dafault MP_Profit_Plugin_Widget_About
     */

    public function default_widget_about() {
		wp_cache_delete('widget_mp_profit_about', 'widget');
		$instance = array(
			'title' => __( 'About us', 'mp-profit' ),
			'text' => __( '<p>This WordPress Theme is your easy solution for building strong competitive financial website for your business. Don&rsquo;t waste your priceless time, install the theme and go ahead.</p>', 'mp-profit'),
		);
		the_widget('MP_Profit_Plugin_Widget_About', $instance, $this->args);
    }

    /*
     * get dafault MP_Profit_Plugin_Widget_RecentPosts
     */

    public function default_widget_contact() {
		wp_cache_delete('widget_mp_profit_contact', 'widget');
		$instance = array(
			'title' => __('Contact info', 'mp-profit'),
			'address' => __('1254/21 West-Holland Street <br/> Manchester <br/> United Kingdom', 'mp-profit'),
			'phone' => __('345-677-554', 'mp-profit'),
			'email' => __('info@yoursite.com', 'mp-profit'),
			'skype' => __('profitconnection', 'mp-profit'),
		);
		the_widget('MP_Profit_Plugin_Widget_Contact', $instance, $this->args);
    }


}

new MP_Profit_Plugin_Footer();
