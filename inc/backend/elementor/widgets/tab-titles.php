<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class CreamPoint_Tab_Titles extends Widget_Base {

	public function get_name() {
		return 'itabtitle';
	}

	public function get_title() {
		return __( 'XP Tab Titles', 'skinetic' );
	}

	public function get_icon() {
		return 'eicon-site-title';
	}

	public function get_categories() {
		return [ 'category_skinetic' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Titles', 'skinetic' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'titles',
			[
				'label' => __( 'Title', 'skinetic' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Content Marketing',
			]
		);
		$repeater->add_control(
			'title_link',
			[
				'label' => __( 'Link to ID Content', 'skinetic' ),
				'type' => Controls_Manager::TEXT,
				'default' => '#tab-1',
			]
		);
		$repeater->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'skinetic' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'title_boxes',
			[
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'show_label'  => false,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{titles}}}',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'skinetic' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [ 'title' => __( 'Left' ), 'icon' => 'eicon-text-align-left' ],
					'center'     => [ 'title' => __( 'Center' ), 'icon' => 'eicon-text-align-center' ],
					'flex-end'   => [ 'title' => __( 'Right' ), 'icon' => 'eicon-text-align-right' ],
				],
				'selectors' => [
					'{{WRAPPER}} .tab-titles' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tab_style',
			[
				'label' => __( 'Tab Style', 'skinetic' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'skinetic' ),
					'underline' => __( 'Underline', 'skinetic' ),
					'overline' => __( 'Overline', 'skinetic' ),
					'pills' => __( 'Pills', 'skinetic' ),
					'cards' => __( 'Cards', 'skinetic' ),
					'minimal' => __( 'Minimal', 'skinetic' ),
				],
			]
		);

		$this->add_responsive_control(
			'tabs_direction',
			[
				'label' => __( 'Direction', 'skinetic' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'row' => [ 'title' => __( 'Horizontal' ), 'icon' => 'eicon-arrow-right' ],
					'column' => [ 'title' => __( 'Vertical' ), 'icon' => 'eicon-arrow-down' ],
				],
				'default' => 'row',
				'selectors' => [
					'{{WRAPPER}} .tab-titles' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_position',
			[
				'label' => __( 'Icon Position', 'skinetic' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => __( 'Left', 'skinetic' ),
					'right' => __( 'Right', 'skinetic' ),
					'top' => __( 'Top', 'skinetic' ),
					'bottom' => __( 'Bottom', 'skinetic' ),
				],
			]
		);

		$this->end_controls_section();

		/** ---------- Style Section ---------- **/

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'General Style', 'skinetic' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'title_space',
			[
				'label' => __( 'Spacing Between Tabs', 'skinetic' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 'px' => [ 'min' => 0, 'max' => 150 ] ],
				'selectors' => [
					'{{WRAPPER}} .tab-titles .title-item' => 'margin: calc({{SIZE}}{{UNIT}}/2);',
					'{{WRAPPER}} .tab-titles' => 'margin: calc(-{{SIZE}}{{UNIT}}/2);',
				],
			]
		);

		$this->add_responsive_control(
			'padding_title',
			[
				'label' => __( 'Padding', 'skinetic' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => 12,
					'right' => 24,
					'bottom' => 12,
					'left' => 24,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .tab-titles a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'full_width_tabs',
			[
				'label' => __( 'Full Width Tabs', 'skinetic' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'skinetic' ),
				'label_off' => __( 'No', 'skinetic' ),
				'return_value' => 'yes',
				'selectors' => [
					'{{WRAPPER}} .tab-titles' => 'width: 100%;',
					'{{WRAPPER}} .tab-titles.full-width .title-item' => 'flex: 1;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .title-item',
			]
		);

		$this->end_controls_section();

		/** ---------- Normal State Styling ---------- **/
		$this->start_controls_section(
			'normal_style_section',
			[
				'label' => __( 'Normal State', 'skinetic' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .title-item a' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_background',
				'label' => __( 'Background', 'skinetic' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .title-item a',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'label' => __( 'Border', 'skinetic' ),
				'selector' => '{{WRAPPER}} .title-item a',
			]
		);

		$this->add_control(
			'radius_title',
			[
				'label' => __( 'Border Radius', 'skinetic' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tab-titles a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_box_shadow',
				'label' => __( 'Box Shadow', 'skinetic' ),
				'selector' => '{{WRAPPER}} .title-item a',
			]
		);

		$this->end_controls_section();

		/** ---------- Hover/Active State Styling ---------- **/
		$this->start_controls_section(
			'hover_style_section',
			[
				'label' => __( 'Hover & Active State', 'skinetic' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_active_color',
			[
				'label' => __( 'Text Color', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .title-item a:hover, {{WRAPPER}} .title-item a.tab-active' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_active_background',
				'label' => __( 'Background', 'skinetic' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .title-item a:hover, {{WRAPPER}} .title-item a.tab-active',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_active_border',
				'label' => __( 'Border', 'skinetic' ),
				'selector' => '{{WRAPPER}} .title-item a:hover, {{WRAPPER}} .title-item a.tab-active',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_active_box_shadow',
				'label' => __( 'Box Shadow', 'skinetic' ),
				'selector' => '{{WRAPPER}} .title-item a:hover, {{WRAPPER}} .title-item a.tab-active',
			]
		);

		$this->add_control(
			'transform_hover',
			[
				'label' => __( 'Transform on Hover', 'skinetic' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => __( 'None', 'skinetic' ),
					'translateY(-2px)' => __( 'Move Up', 'skinetic' ),
					'translateY(2px)' => __( 'Move Down', 'skinetic' ),
					'scale(1.05)' => __( 'Scale Up', 'skinetic' ),
					'scale(0.95)' => __( 'Scale Down', 'skinetic' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title-item a:hover' => 'transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/** ---------- Icon Styling ---------- **/
		$this->start_controls_section(
			'icon_style_section',
			[
				'label' => __( 'Icon Style', 'skinetic' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#666666',
				'selectors' => [
					'{{WRAPPER}} .title-item a .icon, {{WRAPPER}} .title-item a .icon svg' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Icon Hover Color', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .title-item a:hover .icon, {{WRAPPER}} .title-item a:hover .icon svg, {{WRAPPER}} .title-item a.tab-active .icon, {{WRAPPER}} .title-item a.tab-active .icon svg' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'skinetic' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 'px' => [ 'min' => 10, 'max' => 100 ] ],
				'default' => [ 'size' => 16 ],
				'selectors' => [
					'{{WRAPPER}} .title-item .icon i'     => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .title-item .icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => __( 'Icon Spacing', 'skinetic' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
				'default' => [ 'size' => 8 ],
				'selectors' => [
					'{{WRAPPER}} .icon-left .icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .icon-right .icon' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .icon-top .icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .icon-bottom .icon' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/** ---------- Animation & Effects ---------- **/
		$this->start_controls_section(
			'animation_style_section',
			[
				'label' => __( 'Animation & Effects', 'skinetic' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'transition_duration',
			[
				'label' => __( 'Transition Duration (ms)', 'skinetic' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 'px' => [ 'min' => 0, 'max' => 1000 ] ],
				'default' => [ 'size' => 300 ],
				'selectors' => [
					'{{WRAPPER}} .title-item a' => 'transition: all {{SIZE}}ms ease-in-out;',
				],
			]
		);

		$this->add_control(
			'active_indicator',
			[
				'label' => __( 'Active Indicator', 'skinetic' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'skinetic' ),
				'label_off' => __( 'No', 'skinetic' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'indicator_color',
			[
				'label' => __( 'Indicator Color', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#007cba',
				'condition' => [
					'active_indicator' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .title-item a.tab-active::after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'indicator_height',
			[
				'label' => __( 'Indicator Height', 'skinetic' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 'px' => [ 'min' => 1, 'max' => 10 ] ],
				'default' => [ 'size' => 3 ],
				'condition' => [
					'active_indicator' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .title-item a.tab-active::after' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/** ---------- Responsive Settings ---------- **/
		$this->start_controls_section(
			'responsive_section',
			[
				'label' => __( 'Responsive', 'skinetic' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'mobile_stack',
			[
				'label' => __( 'Stack on Mobile', 'skinetic' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'skinetic' ),
				'label_off' => __( 'No', 'skinetic' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'selectors' => [
					'(mobile){{WRAPPER}} .tab-titles.mobile-stack' => 'flex-direction: column;',
					'(mobile){{WRAPPER}} .tab-titles.mobile-stack .title-item' => 'width: 100%; margin: 2px 0;',
				],
			]
		);

		$this->add_responsive_control(
			'mobile_font_size',
			[
				'label' => __( 'Mobile Font Size', 'skinetic' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 'px' => [ 'min' => 10, 'max' => 30 ] ],
				'devices' => [ 'mobile' ],
				'selectors' => [
					'(mobile){{WRAPPER}} .title-item' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$tab_style = $settings['tab_style'];
		$icon_position = $settings['icon_position'];
		$full_width = $settings['full_width_tabs'] === 'yes' ? 'full-width' : '';
		$mobile_stack = $settings['mobile_stack'] === 'yes' ? 'mobile-stack' : '';
		$active_indicator = $settings['active_indicator'] === 'yes' ? 'has-indicator' : '';
		
		$wrapper_classes = "tab-titles tab-style-{$tab_style} icon-{$icon_position} {$full_width} {$mobile_stack} {$active_indicator}";
		?>
		<div class="<?php echo esc_attr( $wrapper_classes ); ?>">
			<?php foreach ( $settings['title_boxes'] as $index => $box ) : ?>
				<div class="title-item font-second">
					<a href="<?php echo esc_url( $box['title_link'] ); ?>" <?php echo $index === 0 ? 'class="tab-active"' : ''; ?>>
						<?php if ( ! empty( $box['icon']['value'] ) ) : ?>
							<span class="icon">
								<?php Icons_Manager::render_icon( $box['icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
						<?php endif; ?>
						<span class="tab-text"><?php echo esc_html( $box['titles'] ); ?></span>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
		
		<style>
		/* Base Styles */
		<?php echo esc_attr( '{{WRAPPER}}' ); ?> .tab-titles {
			display: flex;
			flex-wrap: wrap;
			align-items: center;
			position: relative;
		}
		
		<?php echo esc_attr( '{{WRAPPER}}' ); ?> .title-item {
			position: relative;
		}
		
		<?php echo esc_attr( '{{WRAPPER}}' ); ?> .title-item a {
			display: flex;
			align-items: center;
			text-decoration: none;
			position: relative;
			transition: all 0.3s ease;
		}
		
		/* Icon Positioning */
		<?php echo esc_attr( '{{WRAPPER}}' ); ?> .icon-top a {
			flex-direction: column;
		}
		
		<?php echo esc_attr( '{{WRAPPER}}' ); ?> .icon-bottom a {
			flex-direction: column-reverse;
		}
		
		<?php echo esc_attr( '{{WRAPPER}}' ); ?> .icon-right a {
			flex-direction: row-reverse;
		}
		
		/* Tab Styles */
		<?php echo esc_attr( '{{WRAPPER}}' ); ?> .tab-style-underline .title-item a.tab-active::after,
		<?php echo esc_attr( '{{WRAPPER}}' ); ?> .tab-style-underline .title-item a:hover::after {
			content: '';
			position: absolute;
			bottom: 0;
			left: 0;
			right: 0;
			height: 3px;
			background-color: currentColor;
			transition: all 0.3s ease;
		}
		
		<?php echo esc_attr( '{{WRAPPER}}' ); ?> .tab-style-overline .title-item a.tab-active::after,
		<?php echo esc_attr( '{{WRAPPER}}' ); ?> .tab-style-overline .title-item a:hover::after {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			height: 3px;
			background-color: currentColor;
			transition: all 0.3s ease;
		}
		
		<?php echo esc_attr( '{{WRAPPER}}' ); ?> .tab-style-pills .title-item a {
			border-radius: 25px;
		}
		
		<?php echo esc_attr( '{{WRAPPER}}' ); ?> .tab-style-cards .title-item a {
			border: 1px solid #e0e0e0;
			border-radius: 8px;
			background: #f9f9f9;
		}
		
		<?php echo esc_attr( '{{WRAPPER}}' ); ?> .tab-style-minimal .title-item a {
			background: transparent;
			border: none;
			padding: 8px 16px;
		}
		
		/* Active Indicator */
		<?php echo esc_attr( '{{WRAPPER}}' ); ?> .has-indicator .title-item a.tab-active::after {
			content: '';
			position: absolute;
			bottom: -2px;
			left: 50%;
			transform: translateX(-50%);
			width: 80%;
			height: 3px;
			background-color: #007cba;
			border-radius: 2px;
		}
		
		/* Responsive */
		@media (max-width: 767px) {
			<?php echo esc_attr( '{{WRAPPER}}' ); ?> .mobile-stack {
				flex-direction: column;
				align-items: stretch;
			}
			
			<?php echo esc_attr( '{{WRAPPER}}' ); ?> .mobile-stack .title-item {
				width: 100%;
				margin: 2px 0;
			}
		}
		</style>
		<?php
	}
}

Plugin::instance()->widgets_manager->register( new CreamPoint_Tab_Titles() );