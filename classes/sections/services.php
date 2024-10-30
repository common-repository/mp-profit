<?php

/*
 * Class MP_Profit_Plugin_Services
 * add services section
 */

class MP_Profit_Plugin_Services {

	private $servicesDefault;

	public function __construct() {
		$this->servicesDefault = array(
			array(
				'image' => MP_PROFIT_PLUGIN_PATH . '/images/service1.jpg',
				'title' => __( 'Business Market Leader', 'mp-profit' ),
				'entry' => __( 'We provide maximum quality tools and human resources to take your brand, product, or entire business to the next level.', 'mp-profit' )
			),
			array(
				'image' => MP_PROFIT_PLUGIN_PATH . '/images/service2.jpg',
				'title' => __( 'Safety of Clients Deposits', 'mp-profit' ),
				'entry' => __( 'The years of stability is our best evidence of clients deposits safety.', 'mp-profit' )
			),
			array(
				'image' => MP_PROFIT_PLUGIN_PATH . '/images/service3.jpg',
				'title' => __( 'Transparent Financial Data', 'mp-profit' ),
				'entry' => __( 'Clear and honest financial statements are presented through hundreds of detailed reports each month.', 'mp-profit' )
			),
			array(
				'image' => MP_PROFIT_PLUGIN_PATH . '/images/service4.jpg',
				'title' => __( 'Retail and Institutional Trading', 'mp-profit' ),
				'entry' => __( 'We successfully serve both individual and traders groups of institutions with equal concern.', 'mp-profit' )
			),
			array(
				'image' => MP_PROFIT_PLUGIN_PATH . '/images/service5.jpg',
				'title' => __( 'Access Multi-Asset Liquidity', 'mp-profit' ),
				'entry' => __( 'Optimize your trading to your trading requirements and business needs within our multi-asset portfolio.', 'mp-profit' )
			),
			array(
				'image' => MP_PROFIT_PLUGIN_PATH . '/images/service6.jpg',
				'title' => __( 'Strong Regulatory Protection', 'mp-profit' ),
				'entry' => __( 'Feel the benefits of a strong and well-resourced consumer protection regulatory system.', 'mp-profit' )
			)
		);

		add_action( 'mp_profit_section_services', array( $this, 'get_html' ) );
	}

	/*
	 * Get default sidebar
	 */

	public function get_default_services() {
		?>
		<div class="service-list">
			<div class="row">
				<?php foreach ( $this->servicesDefault as $service ): ?>
					<div class="service-box col-xs-6 col-sm-4 col-md-4 col-lg-4">
						<a href="#" class="service-content">
							<img src="<?php echo $service['image']; ?>" class="attachment-thumb-service wp-post-image"
							     alt="<?php _e( 'finance project name', 'mp-profit' ); ?>">
							<div class="service-hover">
								<div class="hover-content">
									<div>
										<h5 class="service-title"><?php echo $service['title']; ?></h5>
										<hr class="service-line">
										<div class="service-entry">
											<?php echo $service['entry']; ?>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
					<?php
				endforeach;
				?>
			</div>
		</div>
		<?php
	}

	/*
	 * Get services
	 */

	public function get_service( $i ) {
		$i ++;
		if ( $i == 4 ):
			echo '<div class = "clearfix visible-lg-block visible-md-block visible-sm-block"></div >';
		endif;
		?>
		<div class="service-box  col-xs-6 col-sm-4 col-md-4 col-lg-4">
			<a href="<?php the_permalink(); ?>" class="service-content">
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'mp-profit-thumb-related' );
				} else {
					?>
					<div class="service-empty-thumbnail">
						<span class="date-post"><?php the_time( 'F j, Y' ); ?></span>
					</div>
					<?php
				}
				?>
				<div class="service-hover">
					<div class="hover-content">
						<div>
							<h5 class="service-title"><?php the_title(); ?></h5>
							<hr class="service-line">
							<div class="service-entry">
								<?php the_excerpt(); ?>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<?php
	}

	/*
	 * Get services
	 */

	public function get_services_list() {
		$args   = array(
			'post_type'      => 'services',
			'posts_per_page' => 6
		);
		$prizes = new WP_Query( $args );
		if ( $prizes->have_posts() ) {
			?>
			<div class="service-list">
				<div class="row">
					<?php
					$i = 0;
					while ( $prizes->have_posts() ) {
						$prizes->the_post();
						$this->get_service( $i );
					}
					?>
				</div>
			</div>
			<?php
		} else {
			$this->get_default_services();
		}
	}

	/*
	 * Get title
	 */

	public function get_title() {
		$mp_profit_services_title = esc_html( get_theme_mod( 'mp_profit_services_title' ) );
		if ( get_theme_mod( 'mp_profit_services_title', false ) === false ) :
			?>
			<h2 class="section-title"><?php _e( 'Smart financial solutions', 'mp-profit' ); ?></h2>
			<?php
		else:
			if ( ! empty( $mp_profit_services_title ) ):
				?>
				<h2 class="section-title"><?php echo $mp_profit_services_title; ?></h2>
				<?php
			endif;
		endif;
	}

	/*
	 * Get subtitle
	 */

	public function get_subtitle() {
		$mp_profit_services_subtitle = esc_html( get_theme_mod( 'mp_profit_services_subtitle' ) );
		if ( get_theme_mod( 'mp_profit_services_subtitle', false ) === false ) :
			?>
			<div
				class="section-subtitle"><?php _e( 'Financial strength and security are our number one priority', 'mp-profit' ); ?></div>
			<?php
		else:
			if ( ! empty( $mp_profit_services_subtitle ) ):
				?>
				<div class="section-subtitle"><?php echo $mp_profit_services_subtitle; ?></div>
				<?php
			endif;
		endif;
	}

	/*
	 * Get buttons
	 */

	public function get_buttons() {
		$mp_profit_services_button_label = esc_html( get_theme_mod( 'mp_profit_services_button_label', __( 'All Solutions', 'mp-profit' ) ) );
		$mp_profit_services_button_url   = esc_url( get_theme_mod( 'mp_profit_services_button_url', '#service' ) );
		?>
		<div class="section-buttons">
			<?php
			if ( ! empty( $mp_profit_services_button_label ) && ! empty( $mp_profit_services_button_url ) ):
				?>
				<a href="<?php echo $mp_profit_services_button_url; ?>"
				   title="<?php echo $mp_profit_services_button_label; ?>" class="button ">
					<?php echo $mp_profit_services_button_label; ?></a>
			<?php endif; ?>
		</div>
		<?php
	}

	public function get_html() {
		?>
		<section id="services" class="services-section white-section default-section">
			<div class="container">
				<div class="section-content">
					<?php
					$this->get_title();
					$this->get_subtitle();
					$this->get_services_list();
					$this->get_buttons();
					?>
				</div>
			</div>
		</section>
		<?php
	}

}
