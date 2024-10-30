<?php

/*
 * Class MP_Profit_Plugin_Customizer
 *
 * add actions for default widgets if footer
 */

class MP_Profit_Plugin_Customizer {

	private $prefix;

	public function __construct() {
		$this->prefix = 'mp_profit';
		//Handles the theme's theme customizer functionality.
		add_action( 'customize_register', array( $this, 'customize_register' ) );
	}

	/**
	 * Get prefix.
	 *
	 * @access public
	 * @return sting
	 */
	private function getPrefix() {
		return $this->prefix . '_';
	}

	/**
	 * Sets up the theme customizer sections, controls, and settings.
	 *
	 * @access public
	 *
	 * @param  object $wp_customize
	 *
	 * @return void
	 */
	public function customize_register( $wp_customize ) {
		include_once MP_PROFIT_PLUGIN_CLASS_PATH . '/customiser/customise-classes.php';
		/*
		 * Add the 'slider section'.
		 */
		$wp_customize->add_section(
			$this->getPrefix() . 'slider_section', array(
				'title'       => __( 'Slider Section', 'mp-profit' ),
				'priority'    => 79,
				'capability'  => 'edit_theme_options',
				'description' => __( '<i>Go to "Dashboard > Slider" and add posts to fill this section</i><hr/>', 'mp-profit' )
			)
		);
		/*
		 * Add the 'Hide slider section?' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'slider_show', array(
			'default'           => 0,
			'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );
		/*
		 *  Add the upload control for the 'slider title section?' setting.
		 */
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, $this->getPrefix() . 'slider_show', array(
				'label'    => esc_html__( 'Hide this section', 'mp-profit' ),
				'section'  => $this->getPrefix() . 'slider_section',
				'settings' => $this->getPrefix() . 'slider_show',
				'type'     => 'checkbox',
				'priority' => 1,
			) )
		);
		/*
		 * Add the 'Hide slider section?' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'slider_show_mobile', array(
			'default'           => 0,
			'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );
		/*
		 *  Add the upload control for the 'slider title section?' setting.
		 */
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, $this->getPrefix() . 'slider_show_mobile', array(
				'label'    => esc_html__( 'Hide this section on mobile', 'mp-profit' ),
				'section'  => $this->getPrefix() . 'slider_section',
				'settings' => $this->getPrefix() . 'slider_show_mobile',
				'type'     => 'checkbox',
				'priority' => 1,
			) )
		);
		/*
		 * Add the 'slider animation' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'slider_animation', array(
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'default'           => 'fade'
		) );
		/*
		 * Add the upload control for the 'slider animation' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'slider_animation', array(
			'label'    => __( 'Select slider animation type', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'slider_section',
			'settings' => $this->getPrefix() . 'slider_animation',
			'type'     => 'radio',
			'priority' => 10,
			'choices'  => array(
				'fade'  => 'fade',
				'slide' => 'slide'
			),
		) );
		/*
		 * Add the 'slideshow' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'slider_slideshow', array(
			'default'           => 0,
			'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );
		/*
		 *  Add the upload control for the 'slideshow' setting.
		 */
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, $this->getPrefix() . 'slider_slideshow', array(
				'label'    => esc_html__( 'Animate slider automatically', 'mp-profit' ),
				'section'  => $this->getPrefix() . 'slider_section',
				'settings' => $this->getPrefix() . 'slider_slideshow',
				'type'     => 'checkbox',
				'priority' => 11,
			) )
		);
		/*
		 * Add the 'slideshow' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'slider_speed', array(
			'default'           => '7000',
			'sanitize_callback' => array( $this, 'sanitize_text' )
		) );
		/*
		 * Add the upload control for the 'speed theme' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'slider_speed', array(
			'label'    => __( 'Set the speed of the slideshow cycling, in milliseconds', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'slider_section',
			'settings' => $this->getPrefix() . 'slider_speed',
			'priority' => 12
		) );
		/*
		* Add the 'slider  position' setting.
		*/
		$wp_customize->add_setting( $this->getPrefix() . 'slider_position', array(
			'default'           => 10,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_position' )
		) );
		/*
		 * Add the upload control for the  'slider  position' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'slider_position', array(
			'label'    => __( 'Section position', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'slider_section',
			'settings' => $this->getPrefix() . 'slider_position',
			'priority' => 30
		) );
		/*
		 * Add the 'stock tiker section'.
		 */
		$wp_customize->add_section(
			$this->getPrefix() . 'stock_ticker_section', array(
				'title'       => __( 'First Section', 'mp-profit' ),
				'priority'    => 80,
				'capability'  => 'edit_theme_options',
				'description' => __( '<i>Fill in this section by adding widgets to "Customize > Widgets > First Section"</i><hr/>', 'mp-profit' )
			)
		);

		/*
		 * Add the 'Hide stock tiker section?' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'stock_ticker_show', array(
			'default'           => 0,
			'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );
		/*
		 *  Add the upload control for the 'Hide stock tiker section?' setting.
		 */
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, $this->getPrefix() . 'stock_ticker_show', array(
				'label'    => esc_html__( 'Hide this section', 'mp-profit' ),
				'section'  => $this->getPrefix() . 'stock_ticker_section',
				'settings' => $this->getPrefix() . 'stock_ticker_show',
				'type'     => 'checkbox',
				'priority' => 1,
			) )
		);
		/* Add the 'stock tiker' upload setting. */
		$wp_customize->add_setting(
			$this->getPrefix() . 'stock_ticker_bg', array(
				'sanitize_callback' => 'esc_url_raw',
				'default'           => MP_PROFIT_PLUGIN_PATH . '/images/stockticker.jpg',
				'capability'        => 'edit_theme_options',
			)
		);

		/* Add the upload control for the 'stock tiker' setting. */
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize, $this->getPrefix() . 'stock_ticker_bg', array(
					'label'    => esc_html__( 'Background', 'mp-profit' ),
					'section'  => $this->getPrefix() . 'stock_ticker_section',
					'settings' => $this->getPrefix() . 'stock_ticker_bg',
					'priority' => 6
				)
			)
		);
		/*
		* Add the 'stock ticker  position' setting.
		*/
		$wp_customize->add_setting( $this->getPrefix() . 'stock_ticker_position', array(
			'default'           => 20,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_position' )
		) );
		/*
		 * Add the upload control for the  'stock ticker  position' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'stock_ticker_position', array(
			'label'    => __( 'Section position', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'stock_ticker_section',
			'settings' => $this->getPrefix() . 'stock_ticker_position',
			'priority' => 30
		) );
		/*
		 * Add the 'first to call action section'.
		 */
		$wp_customize->add_section(
			$this->getPrefix() . 'first_action_section', array(
				'title'      => __( 'First Call to Action Section', 'mp-profit' ),
				'priority'   => 82,
				'capability' => 'edit_theme_options'
			)
		);

		/*
		 * Add the 'Hide first_action section?' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'first_action_show', array(
			'default'           => 0,
			'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );
		/*
		 *  Add the upload control for the 'Hide first_action section?' setting.
		 */
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, $this->getPrefix() . 'first_action_show', array(
				'label'    => esc_html__( 'Hide this section', 'mp-profit' ),
				'section'  => $this->getPrefix() . 'first_action_section',
				'settings' => $this->getPrefix() . 'first_action_show',
				'type'     => 'checkbox',
				'priority' => 1,
			) )
		);
		/*
		 * Add the 'first to call action' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'first_action_title', array(
			'default'           => __( 'We can manage your finance', 'mp-profit' ),
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'transport'         => 'postMessage'
		) );
		/*
		 * Add the upload control for the 'first to call action' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'first_action_title', array(
			'label'    => __( 'Title', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'first_action_section',
			'settings' => $this->getPrefix() . 'first_action_title',
			'priority' => 2
		) );

		/*
		 * Add the 'first to call action' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'first_action_description', array(
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'default'           => __( 'Our team consists of professionals who provide clients and partners with confidence and only best consulting and financial services. Join our company and use a great chance to conquer the trading market and be the one of those who are eager to lead and innovate in the financial industry', 'mp-profit' ),
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage'
		) );
		/*
		 * Add the upload control for the 'first to call action' setting.
		 */
		$wp_customize->add_control( new MP_Profit_Plugin_Customize_Textarea_Control( $wp_customize, $this->getPrefix() . 'first_action_description', array(
			'label'    => __( 'Description', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'first_action_section',
			'settings' => $this->getPrefix() . 'first_action_description',
			'priority' => 3
		) ) );
		/*
		 * Add the 'first to call actionfirst_action brand button label' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'first_action_brandbutton_label', array(
			'default'           => __( 'Join us', 'mp-profit' ),
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'transport'         => 'postMessage'
		) );
		/*
		 * Add the upload control for the 'first to call action brand button label' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'first_action_brandbutton_label', array(
			'label'    => __( 'Button label', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'first_action_section',
			'settings' => $this->getPrefix() . 'first_action_brandbutton_label',
			'priority' => 4
		) );
		/*
		 * Add the 'first to call action brand button url' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'first_action_brandbutton_url', array(
			'default'           => '#',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'transport'         => 'postMessage'
		) );
		/*
		 * Add the upload control for the 'first to call action brand button url' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'first_action_brandbutton_url', array(
			'label'    => __( 'Button url', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'first_action_section',
			'settings' => $this->getPrefix() . 'first_action_brandbutton_url',
			'priority' => 5
		) );
		/* Add the 'first to call background' upload setting. */
		$wp_customize->add_setting(
			$this->getPrefix() . 'first_action_bg', array(
				'sanitize_callback' => 'esc_url_raw',
				'default'           => MP_PROFIT_PLUGIN_PATH . '/images/first-action-bg.jpg',
				'capability'        => 'edit_theme_options',
			)
		);

		/* Add the upload control for the  'first to call background'  setting. */
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize, $this->getPrefix() . 'first_action_bg', array(
					'label'    => esc_html__( 'Background', 'mp-profit' ),
					'section'  => $this->getPrefix() . 'first_action_section',
					'settings' => $this->getPrefix() . 'first_action_bg',
					'priority' => 6
				)
			)
		);
		/*
		* Add the 'first action  position' setting.
		*/
		$wp_customize->add_setting( $this->getPrefix() . 'first_action_position', array(
			'default'           => 50,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_position' )
		) );
		/*
		 * Add the upload control for the  'first action  position' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'first_action_position', array(
			'label'    => __( 'Section position', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'first_action_section',
			'settings' => $this->getPrefix() . 'first_action_position',
			'priority' => 30
		) );
		/*
		 * Add the 'calculator section'.
		 */
		$wp_customize->add_section(
			$this->getPrefix() . 'calculator_section', array(
				'title'      => __( 'Calculator Section', 'mp-profit' ),
				'priority'   => 82,
				'capability' => 'edit_theme_options'
			)
		);

		/*
		 * Add the 'Hide calculator section?' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'calculator_show', array(
			'default'           => 0,
			'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );
		/*
		 *  Add the upload control for the 'calculator title section?' setting.
		 */
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, $this->getPrefix() . 'calculator_show', array(
				'label'    => esc_html__( 'Hide this section', 'mp-profit' ),
				'section'  => $this->getPrefix() . 'calculator_section',
				'settings' => $this->getPrefix() . 'calculator_show',
				'type'     => 'checkbox',
				'priority' => 1,
			) )
		);
		/*
		 * Add the 'calculator' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'calculator_title', array(
			'default'           => __( 'Lease calculator', 'mp-profit' ),
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'transport'         => 'postMessage'
		) );
		/*
		 * Add the upload control for the 'calculator' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'calculator_title', array(
			'label'    => __( 'Title', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'calculator_section',
			'settings' => $this->getPrefix() . 'calculator_title',
			'priority' => 2
		) );

		/*
		 * Add the 'calculator' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'calculator_subtitle', array(
			'default'           => __( 'Use this calculator to estimate the lease payments for particular periods by submitting real prices.', 'mp-profit' ),
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'transport'         => 'postMessage'
		) );
		/*
		 * Add the upload control for the 'calculator' setting.
		 */
		$wp_customize->add_control( new MP_Profit_Plugin_Customize_Textarea_Control( $wp_customize, $this->getPrefix() . 'calculator_subtitle', array(
			'label'    => __( 'Sub Title', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'calculator_section',
			'settings' => $this->getPrefix() . 'calculator_subtitle',
			'priority' => 3
		) ) );
		/* Add the 'calculator bg' upload setting. */
		$wp_customize->add_setting(
			$this->getPrefix() . 'calculator_bg', array(
				'default'           => false,
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		/* Add the upload control for the 'calculator bg' setting. */
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize, $this->getPrefix() . 'calculator_bg', array(
					'label'    => esc_html__( 'Background', 'mp-profit' ),
					'section'  => $this->getPrefix() . 'calculator_section',
					'settings' => $this->getPrefix() . 'calculator_bg',
					'priority' => 4
				)
			)
		);
		/*
		* Add the 'calculator  position' setting.
		*/
		$wp_customize->add_setting( $this->getPrefix() . 'calculator_position', array(
			'default'           => 60,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_position' )
		) );
		/*
		 * Add the upload control for the  'calculator  position' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'calculator_position', array(
			'label'    => __( 'Section position', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'calculator_section',
			'settings' => $this->getPrefix() . 'calculator_position',
			'priority' => 30
		) );
		/*
	    * Add the 'features section'.
	    */
		$wp_customize->add_section(
			$this->getPrefix() . 'features_section', array(
				'title'       => __( 'Features Section', 'mp-profit' ),
				'priority'    => 80,
				'capability'  => 'edit_theme_options',
				'description' => __( '<i>Fill in this section by adding "Theme - Feature" widgets to "Customize > Widgets > Features section"</i><hr/>', 'mp-profit' )
			)
		);
		/*
		 * Add the 'Hide faetures section?' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'features_show', array(
			'default'           => 0,
			'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );
		/*
		 *  Add the upload control for the 'features title section?' setting.
		 */
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, $this->getPrefix() . 'features_show', array(
				'label'    => esc_html__( 'Hide this section', 'mp-profit' ),
				'section'  => $this->getPrefix() . 'features_section',
				'settings' => $this->getPrefix() . 'features_show',
				'type'     => 'checkbox',
				'priority' => 1,
			) )
		);
		/*
		 * Add the 'features' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'features_title', array(
			'default'           => __( 'Reasons to choose us', 'mp-profit' ),
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'transport'         => 'postMessage'
		) );
		/*
		 * Add the upload control for the 'features' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'features_title', array(
			'label'    => __( 'Title', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'features_section',
			'settings' => $this->getPrefix() . 'features_title',
			'priority' => 2
		) );

		/*
		 * Add the 'features' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'features_subtitle', array(
			'default'           => __( 'The best services for your business needs', 'mp-profit' ),
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'transport'         => 'postMessage'
		) );
		/*
		 * Add the upload control for the 'features' setting.
		 */
		$wp_customize->add_control( new MP_Profit_Plugin_Customize_Textarea_Control( $wp_customize, $this->getPrefix() . 'features_subtitle', array(
			'label'    => __( 'Sub Title', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'features_section',
			'settings' => $this->getPrefix() . 'features_subtitle',
			'priority' => 3
		) ) );
		/*
		* Add the 'features  position' setting.
		*/
		$wp_customize->add_setting( $this->getPrefix() . 'features_position', array(
			'default'           => 30,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_position' )
		) );
		/*
		 * Add the upload control for the  'features  position' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'features_position', array(
			'label'    => __( 'Section position', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'features_section',
			'settings' => $this->getPrefix() . 'features_position',
			'priority' => 30
		) );
		/*
		 * Add the 'records section'.
		 */
		$wp_customize->add_section(
			$this->getPrefix() . 'records_section', array(
				'title'       => __( 'Records Section', 'mp-profit' ),
				'priority'    => 81,
				'capability'  => 'edit_theme_options',
				'description' => __( '<i>Fill in this section by adding "Theme - Record" widgets to "Customize > Widgets > Records section"</i><hr/>', 'mp-profit' )
			)
		);

		/*
		 * Add the 'Hide records section?' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'records_show', array(
			'default'           => 0,
			'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );
		/*
		 *  Add the upload control for the 'records title section?' setting.
		 */
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, $this->getPrefix() . 'records_show', array(
				'label'    => esc_html__( 'Hide this section', 'mp-profit' ),
				'section'  => $this->getPrefix() . 'records_section',
				'settings' => $this->getPrefix() . 'records_show',
				'type'     => 'checkbox',
				'priority' => 1,
			) )
		);
		/*
		* Add the 'records  position' setting.
		*/
		$wp_customize->add_setting( $this->getPrefix() . 'records_position', array(
			'default'           => 30,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_position' )
		) );
		/*
		 * Add the upload control for the  'records  position' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'records_position', array(
			'label'    => __( 'Section position', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'records_section',
			'settings' => $this->getPrefix() . 'records_position',
			'priority' => 40
		) );
		/*
		 * Add the 'service section'.
		 */
		$wp_customize->add_section(
			$this->getPrefix() . 'services_section', array(
				'title'       => __( 'Services Section', 'mp-profit' ),
				'priority'    => 84,
				'capability'  => 'edit_theme_options',
				'description' => __( '<i>Go to "Dashboard > Services" and add posts to fill this section</i><hr/>', 'mp-profit' )
			)
		);

		/*
		 * Add the 'Hide service section?' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'services_show', array(
			'default'           => 0,
			'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );
		/*
		 *  Add the upload control for the 'service title section?' setting.
		 */
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, $this->getPrefix() . 'services_show', array(
				'label'    => esc_html__( 'Hide this section', 'mp-profit' ),
				'section'  => $this->getPrefix() . 'services_section',
				'settings' => $this->getPrefix() . 'services_show',
				'type'     => 'checkbox',
				'priority' => 1,
			) )
		);
		/*
		 * Add the 'service' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'services_title', array(
			'default'           => __( 'Smart financial solutions', 'mp-profit' ),
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'transport'         => 'postMessage'
		) );
		/*
		 * Add the upload control for the 'service' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'services_title', array(
			'label'    => __( 'Title', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'services_section',
			'settings' => $this->getPrefix() . 'services_title',
			'priority' => 2
		) );

		/*
		 * Add the 'service' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'services_subtitle', array(
			'default'           => __( 'Financial strength and security are our number one priority', 'mp-profit' ),
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'transport'         => 'postMessage'
		) );
		/*
		 * Add the upload control for the 'service' setting.
		 */
		$wp_customize->add_control( new MP_Profit_Plugin_Customize_Textarea_Control( $wp_customize, $this->getPrefix() . 'services_subtitle', array(
			'label'    => __( 'Sub Title', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'services_section',
			'settings' => $this->getPrefix() . 'services_subtitle',
			'priority' => 3
		) ) );
		/*
		 * Add the 'install brand button label' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'services_button_label', array(
			'default'           => __( 'Read More', 'mp-profit' ),
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'transport'         => 'postMessage'
		) );
		/*
		 * Add the upload control for the 'install brand button label' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'services_button_label', array(
			'label'    => __( 'Button label', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'services_section',
			'settings' => $this->getPrefix() . 'services_button_label',
			'priority' => 4
		) );
		/*
		 * Add the 'service button url' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'services_button_url', array(
			'default'           => '#',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'transport'         => 'postMessage'
		) );
		/*
		 * Add the upload control for the 'service button url' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'services_button_url', array(
			'label'    => __( 'Button url', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'services_section',
			'settings' => $this->getPrefix() . 'services_button_url',
			'priority' => 5
		) );
		/*
		* Add the 'services  position' setting.
		*/
		$wp_customize->add_setting( $this->getPrefix() . 'services_position', array(
			'default'           => 80,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_position' )
		) );
		/*
		 * Add the upload control for the  'services  position' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'services_position', array(
			'label'    => __( 'Section position', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'services_section',
			'settings' => $this->getPrefix() . 'services_position',
			'priority' => 40
		) );
		/*
		 * Add the 'team section'.
		 */
		$wp_customize->add_section(
			$this->getPrefix() . 'team_section', array(
				'title'       => __( 'Team Section', 'mp-profit' ),
				'priority'    => 85,
				'capability'  => 'edit_theme_options',
				'description' => __( '<i>Fill in this section by adding "Theme - Team" widgets to "Customize > Widgets > Team section"</i><hr/>', 'mp-profit' )
			)
		);

		/*
		 * Add the 'Hide faetures section?' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'team_show', array(
			'default'           => 0,
			'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );
		/*
		 *  Add the upload control for the 'team title section?' setting.
		 */
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, $this->getPrefix() . 'team_show', array(
				'label'    => esc_html__( 'Hide this section', 'mp-profit' ),
				'section'  => $this->getPrefix() . 'team_section',
				'settings' => $this->getPrefix() . 'team_show',
				'type'     => 'checkbox',
				'priority' => 1,
			) )
		);
		/*
		 * Add the 'team' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'team_title', array(
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'default'           => __( 'Executive team', 'mp-profit' ),
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage'
		) );
		/*
		 * Add the upload control for the 'team' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'team_title', array(
			'label'    => __( 'Title', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'team_section',
			'settings' => $this->getPrefix() . 'team_title',
			'priority' => 2
		) );

		/*
		 * Add the 'team' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'team_subtitle', array(
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'default'           => __( 'We can achieve your goals together', 'mp-profit' ),
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage'
		) );
		/*
		 * Add the upload control for the 'team' setting.
		 */
		$wp_customize->add_control( new MP_Profit_Plugin_Customize_Textarea_Control( $wp_customize, $this->getPrefix() . 'team_subtitle', array(
			'label'    => __( 'Sub Title', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'team_section',
			'settings' => $this->getPrefix() . 'team_subtitle',
			'priority' => 3
		) ) );
		/*
		* Add the 'team  position' setting.
		*/
		$wp_customize->add_setting( $this->getPrefix() . 'team_position', array(
			'default'           => 90,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_position' )
		) );
		/*
		 * Add the upload control for the  'team  position' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'team_position', array(
			'label'    => __( 'Section position', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'team_section',
			'settings' => $this->getPrefix() . 'team_position',
			'priority' => 40
		) );
		/*
		 * Add the 'pricing section'.
		 */
		$wp_customize->add_section(
			$this->getPrefix() . 'pricing_section', array(
				'title'       => __( 'Pricing Section', 'mp-profit' ),
				'priority'    => 87,
				'capability'  => 'edit_theme_options',
				'description' => __( '<i>Fill in this section by adding "Theme - Pricing" widgets to "Customize > Widgets > Pricing section"</i><hr/>', 'mp-profit' )
			)
		);

		/*
		 * Add the 'Hide pricing section?' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'pricing_show', array(
			'default'           => 0,
			'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );
		/*
		 *  Add the upload control for the 'pricing title section?' setting.
		 */
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, $this->getPrefix() . 'pricing_show', array(
				'label'    => esc_html__( 'Hide this section', 'mp-profit' ),
				'section'  => $this->getPrefix() . 'pricing_section',
				'settings' => $this->getPrefix() . 'pricing_show',
				'type'     => 'checkbox',
				'priority' => 1,
			) )
		);
		/*
		 * Add the 'pricing' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'pricing_title', array(
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'default'           => __( 'Pricing', 'mp-profit' ),
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage'
		) );
		/*
		 * Add the upload control for the 'pricing' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'pricing_title', array(
			'label'    => __( 'Title', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'pricing_section',
			'settings' => $this->getPrefix() . 'pricing_title',
			'priority' => 2
		) );

		/*
		 * Add the 'pricing' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'pricing_subtitle', array(
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'default'           => __( 'pricing section for your services', 'mp-profit' ),
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage'
		) );
		/*
		 * Add the upload control for the 'pricing' setting.
		 */
		$wp_customize->add_control( new MP_Profit_Plugin_Customize_Textarea_Control( $wp_customize, $this->getPrefix() . 'pricing_subtitle', array(
			'label'    => __( 'Sub Title', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'pricing_section',
			'settings' => $this->getPrefix() . 'pricing_subtitle',
			'priority' => 3
		) ) );
		/*
		* Add the 'pricing  position' setting.
		*/
		$wp_customize->add_setting( $this->getPrefix() . 'pricing_position', array(
			'default'           => 110,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_position' )
		) );
		/*
		 * Add the upload control for the  'pricing  position' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'pricing_position', array(
			'label'    => __( 'Section position', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'pricing_section',
			'settings' => $this->getPrefix() . 'pricing_position',
			'priority' => 40
		) );
		/*
		 * Add the 'testimonials section'.
		 */
		$wp_customize->add_section(
			$this->getPrefix() . 'testimonials_section', array(
				'title'       => __( 'Testimonials Section', 'mp-profit' ),
				'priority'    => 91,
				'capability'  => 'edit_theme_options',
				'description' => __( '<i>Fill in this section by adding "Theme - Testimonial" widgets to "Customize > Widgets > Testimonials section"</i><hr/>', 'mp-profit' )
			)
		);

		/*
		 * Add the 'Hide faetures section?' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'testimonials_show', array(
			'default'           => 0,
			'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );
		/*
		 *  Add the upload control for the 'testimonials title section?' setting.
		 */
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, $this->getPrefix() . 'testimonials_show', array(
				'label'    => esc_html__( 'Hide this section', 'mp-profit' ),
				'section'  => $this->getPrefix() . 'testimonials_section',
				'settings' => $this->getPrefix() . 'testimonials_show',
				'type'     => 'checkbox',
				'priority' => 1,
			) )
		);
		/*
		 * Add the 'testimonials' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'testimonials_title', array(
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'default'           => __( 'Testimonials', 'mp-profit' ),
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage'
		) );
		/*
		 * Add the upload control for the 'testimonials' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'testimonials_title', array(
			'label'    => __( 'Title', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'testimonials_section',
			'settings' => $this->getPrefix() . 'testimonials_title',
			'priority' => 2
		) );

		/*
		 * Add the 'testimonials' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'testimonials_subtitle', array(
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'default'           => __( 'What our happy customers say', 'mp-profit' ),
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage'
		) );
		/*
		 * Add the upload control for the 'testimonials' setting.
		 */
		$wp_customize->add_control( new MP_Profit_Plugin_Customize_Textarea_Control( $wp_customize, $this->getPrefix() . 'testimonials_subtitle', array(
			'label'    => __( 'Sub Title', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'testimonials_section',
			'settings' => $this->getPrefix() . 'testimonials_subtitle',
			'priority' => 3
		) ) );
		/*
		* Add the 'testimonials  position' setting.
		*/
		$wp_customize->add_setting( $this->getPrefix() . 'testimonials_position', array(
			'default'           => 140,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_position' )
		) );
		/*
		 * Add the upload control for the  'testimonials  position' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'testimonials_position', array(
			'label'    => __( 'Section position', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'testimonials_section',
			'settings' => $this->getPrefix() . 'testimonials_position',
			'priority' => 40
		) );
		/*
		 * Add the 'contact section' setting.
		 */
		$wp_customize->add_section( $this->getPrefix() . 'contactus_section', array(
			'title'    => __( 'Contacts Section', 'mp-profit' ),
			'priority' => 93
		) );
		/*
		 *  Add the  'contact us show/hide' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'contactus_show', array(
				'sanitize_callback' => array( $this, 'sanitize_text' )
			)
		);
		/*
		 *  Add the upload control for the 'contact us show/hide' setting.
		 */
		$wp_customize->add_control(
			$this->getPrefix() . 'contactus_show', array(
				'type'     => 'checkbox',
				'label'    => __( 'Hide this section', 'mp-profit' ),
				'section'  => $this->getPrefix() . 'contactus_section',
				'priority' => 1,
			)
		);
		/*
		 * Add the 'contactus title' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'contactus_title', array(
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'default'           => __( 'Message form', 'mp-profit' ),
			'transport'         => 'postMessage',
		) );
		/*
		 *  Add the upload control for the 'contactus title' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'contactus_title', array(
			'label'    => __( 'Title', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'contactus_section',
			'settings' => $this->getPrefix() . 'contactus_title',
			'priority' => 2,
		) );
		/*
		 * Add the 'contactus description' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'contactus_subtitle', array(
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'default'           => __( 'Get in touch', 'mp-profit' ),
			'transport'         => 'postMessage',
		) );
		/*
		 *  Add the upload control for the 'contactus description' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'contactus_subtitle', array(
			'label'    => __( 'Description', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'contactus_section',
			'settings' => $this->getPrefix() . 'contactus_subtitle',
			'priority' => 3,
		) );

		/*
		 *  Add the 'contactus email' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'contactus_email', array(
				'sanitize_callback' => array( $this, 'sanitize_text' )
			)
		);
		/*
		 *  Add the upload control for the 'contactus email' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'contactus_email', array(
			'label'    => __( 'Email address', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'contactus_section',
			'settings' => $this->getPrefix() . 'contactus_email',
			'priority' => 4,
		) );

		/*
		 * Add the 'contactus button label' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'contactus_button_label', array(
			'sanitize_callback' => array( $this, 'sanitize_text' ),
			'default'           => __( 'Send Message', 'mp-profit' ),
			'transport'         => 'postMessage',
		) );
		/*
		 *  Add the upload control for the 'contactus button label' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'contactus_button_label', array(
			'label'    => __( 'Button label', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'contactus_section',
			'settings' => $this->getPrefix() . 'contactus_button_label',
			'priority' => 5,
		) );
		/*
		 * Add the  'recaptcha' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'contactus_recaptcha_show', array(
			'sanitize_callback' => array( $this, 'sanitize_text' )
		) );
		/*
		 *  Add the upload control for the 'recaptcha' setting.
		 */
		$wp_customize->add_control(
			$this->getPrefix() . 'contactus_recaptcha_show', array(
				'type'     => 'checkbox',
				'label'    => __( 'Hide reCaptcha?', 'mp-profit' ),
				'section'  => $this->getPrefix() . 'contactus_section',
				'priority' => 6,
			)
		);
		/*
		 * Add the 'site key' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'contactus_sitekey', array(
			'sanitize_callback' => array( $this, 'sanitize_text' )
		) );
		/*
		 *  Add the upload control for the 'site key' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'contactus_sitekey', array(
			'label'       => __( 'Site key', 'mp-profit' ),
			'description' => '<a href="https://www.google.com/recaptcha/admin#list" target="_blank">' . __( 'Create an account here', 'mp-profit' ) . '</a> to get the Site key and the Secret key for the reCaptcha.',
			'section'     => $this->getPrefix() . 'contactus_section',
			'settings'    => $this->getPrefix() . 'contactus_sitekey',
			'priority'    => 7,
		) );
		/*
		 * Add the 'secret key' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'contactus_secretkey', array(
			'sanitize_callback' => array( $this, 'sanitize_text' )
		) );
		/*
		 *  Add the upload control for the secret key' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'contactus_secretkey', array(
			'label'    => __( 'Secret key', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'contactus_section',
			'settings' => $this->getPrefix() . 'contactus_secretkey',
			'priority' => 8,
		) );
		/*
		* Add the 'contact us  position' setting.
		*/
		$wp_customize->add_setting( $this->getPrefix() . 'contactus_position', array(
			'default'           => 150,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_position' )
		) );
		/*
		 * Add the upload control for the  'contact us  position' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'contactus_position', array(
			'label'    => __( 'Section position', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'contactus_section',
			'settings' => $this->getPrefix() . 'contactus_position',
			'priority' => 40
		) );
		/*
		 * Add the 'location section'.
		 */
		$wp_customize->add_section(
			$this->getPrefix() . 'location_section', array(
				'title'       => __( 'Location Section', 'mp-profit' ),
				'priority'    => 94,
				'capability'  => 'edit_theme_options',
				'description' => __( '<i>Fill in this section by adding "Theme - GoogleMap" widget to "Customize > Widgets > Location section"</i><hr/>', 'mp-profit' )
			)
		);
		/*
		 * Add the 'Hide location section?' setting.
		 */
		$wp_customize->add_setting( $this->getPrefix() . 'location_show', array(
			'default'           => 0,
			'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );
		/*
		 *  Add the upload control for the 'location title section?' setting.
		 */
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, $this->getPrefix() . 'location_show', array(
				'label'    => esc_html__( 'Hide this section', 'mp-profit' ),
				'section'  => $this->getPrefix() . 'location_section',
				'settings' => $this->getPrefix() . 'location_show',
				'type'     => 'checkbox',
				'priority' => 1,
			) )
		);
		/*
		* Add the 'location  position' setting.
		*/
		$wp_customize->add_setting( $this->getPrefix() . 'location_position', array(
			'default'           => 160,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array( $this, 'sanitize_position' )
		) );
		/*
		 * Add the upload control for the  'location  position' setting.
		 */
		$wp_customize->add_control( $this->getPrefix() . 'location_position', array(
			'label'    => __( 'Section position', 'mp-profit' ),
			'section'  => $this->getPrefix() . 'location_section',
			'settings' => $this->getPrefix() . 'location_position',
			'priority' => 40
		) );
	}

	/**
	 * Sanitize text
	 *
	 * @access public
	 * @return sanitized output
	 */
	function sanitize_text( $txt ) {
		return wp_kses_post( force_balance_tags( $txt ) );
	}

	/**
	 * Sanitize checkbox
	 *
	 * @access public
	 * @return sanitized output
	 */
	function sanitize_checkbox( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}
	/**
	 * Sanitize position
	 *
	 * @access public
	 * @return sanitized output
	 */
	function sanitize_position( $str ) {
		if ( $this->is_positive_integer( $str ) ) {
			return intval( $str );
		}
	}
	/**
	 * Sanitize is positive integer
	 *
	 * @since Profit
	 * @access public
	 * @return sanitized output
	 */
	function is_positive_integer( $str ) {
		return ( is_numeric( $str ) && $str > 0 && $str == round( $str ) );
	}


}

new MP_Profit_Plugin_Customizer();

