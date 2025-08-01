<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Accordions
 */
class Skinetic_Accordions extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'iaccordions';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'XP Accordions', 'skinetic' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-accordion';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_skinetic' ];
	}

	protected function register_controls() {

		//Content Service box
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Accordions', 'skinetic' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'acc_title',
			[
				'label' => __( 'Title & Content', 'skinetic' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Accordion Title', 'skinetic' ),
				'placeholder' => __( 'Accordion Title', 'skinetic' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'acc_content',
			[
				'label' => __( 'Content', 'skinetic' ),
				'default' => __( 'Accordion Content', 'skinetic' ),
				'placeholder' => __( 'Accordion Content', 'skinetic' ),
				'type' => Controls_Manager::WYSIWYG,
				'show_label' => false,
			]
		);

		$this->add_control(
			'xp_accs',
			[
				'label' => __( 'Accordion Items', 'skinetic' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'acc_title' => __( 'Accordion #1', 'skinetic' ),
						'acc_content' => __( 'The basic philosophy of our studio is to create individual, aesthetically stunning solutions for our customers by lightning-fast development of projects employing unique styles.', 'skinetic' ),
					],
					[
						'acc_title' => __( 'Accordion #2', 'skinetic' ),
						'acc_content' => __( 'The basic philosophy of our studio is to create individual, aesthetically stunning solutions for our customers by lightning-fast development of projects employing unique styles.', 'skinetic' ),
					],
				],
				'title_field' => '{{{ acc_title }}}',
			]
		);
		$this->add_control(
			'default_active',
			[
				'label'   => esc_html__( 'Default Active', 'skinetic' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'item_active',
			[
				'label' => esc_html__( 'Item Active', 'skinetic' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'default_active' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		//Style
		/* title */
		$this->start_controls_section(
			'style_title',
			[
				'label' => __( 'Title', 'skinetic' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'bg_title',
			[
				'label' => __( 'Background', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acc-item:not(.current) .acc-toggle' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'bg_title_active',
			[
				'label' => __( 'Background Active', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acc-item.current .acc-toggle' => 'background: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_border',
			[
				'label' => __( 'Border Color', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acc-item:not(.current) .acc-toggle' => 'border-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acc-item:not(.current) .acc-toggle' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_color_active',
			[
				'label' => __( 'Color Active', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acc-item.current .acc-toggle' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .acc-toggle',
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => __( 'Padding', 'skinetic' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .acc-item .acc-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		/* content */
		$this->start_controls_section(
			'style_content',
			[
				'label' => __( 'Content', 'skinetic' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'bg_content',
			[
				'label' => __( 'Background', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acc-item .acc-content' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acc-content' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .acc-content',
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'skinetic' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .acc-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$migrated = isset( $settings['__fa4_migrated']['icon_close'] );

		if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// @todo: remove when deprecated
			// added as bc in 2.6
			// add old default
			$settings['icon'] = 'fas fa-plus';
			$settings['select_icon_active'] = 'far fa-window-minimize';
		}

		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
		$has_icon = ( ! $is_new || ! empty( $settings['icon_close']['value'] ) );
		?>

		<div class="xp-accordions">
			<?php if ( $settings['xp_accs'] ) : foreach ( $settings['xp_accs'] as $key => $accs ) { ?>
			<div class="acc-item">
				<div class="acc-toggle flex-middle" data-default="<?php echo esc_attr( $settings['item_active'] == $key + 1 ? 'yes' : '' ); ?>">
				     <?php echo esc_html( $accs['acc_title'] ); ?>
				    <i class="xp-webicon-arrowsoutline"></i>
				</div>
				<div class="acc-content">
					<?php echo wp_kses_post( $accs['acc_content'] ); ?>
				</div>
			</div>
			<?php } endif; ?>
	    </div>

	    <?php
	}

}
// After the Skinetic_Accordions class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Skinetic_Accordions() );