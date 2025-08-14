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
				'label' => __( 'Spacing', 'skinetic' ),
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
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tab-titles a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_title',
			[
				'label' => __( 'Margin', 'skinetic' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tab-titles .title-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .title-item',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_box_shadow',
				'selector' => '{{WRAPPER}} .tab-titles a',
			]
		);

		$this->end_controls_section();

		/** ---------- Border Section ---------- **/

		$this->start_controls_section(
			'border_section',
			[
				'label' => __( 'Border', 'skinetic' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_border_style' );

		$this->start_controls_tab(
			'tab_border_normal',
			[
				'label' => __( 'Normal', 'skinetic' ),
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'selector' => '{{WRAPPER}} .tab-titles a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_border_hover',
			[
				'label' => __( 'Hover / Active', 'skinetic' ),
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border_hover',
				'selector' => '{{WRAPPER}} .tab-titles a:hover, {{WRAPPER}} .tab-titles a.tab-active',
			]
		);

		$this->add_control(
			'border_hover_transition',
			[
				'label' => __( 'Transition Duration', 'skinetic' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					's' => [
						'min' => 0,
						'max' => 3,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 's',
					'size' => 0.3,
				],
				'selectors' => [
					'{{WRAPPER}} .tab-titles a' => 'transition: all {{SIZE}}{{UNIT}} ease;',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/** ---------- Colors Section ---------- **/

		$this->start_controls_section(
			'colors_section',
			[
				'label' => __( 'Colors', 'skinetic' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_title_style' );

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'Normal', 'skinetic' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-item a' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .title-item a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_hover',
			[
				'label' => __( 'Hover / Active', 'skinetic' ),
			]
		);

		$this->add_control(
			'title_active_color',
			[
				'label' => __( 'Text Color', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-item a:hover, {{WRAPPER}} .title-item a.tab-active' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_background_hover',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .title-item a:hover, {{WRAPPER}} .title-item a.tab-active',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_box_shadow_hover',
				'selector' => '{{WRAPPER}} .tab-titles a:hover, {{WRAPPER}} .tab-titles a.tab-active',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/** ---------- Icon Section ---------- **/

		$this->start_controls_section(
			'icon_section',
			[
				'label' => __( 'Icon', 'skinetic' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'skinetic' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 'px' => [ 'min' => 10, 'max' => 100 ] ],
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
				'selectors' => [
					'{{WRAPPER}} .title-item .icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' => __( 'Normal', 'skinetic' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-item a .icon, {{WRAPPER}} .title-item a .icon svg' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label' => __( 'Icon Background', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-item .icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => __( 'Icon Padding', 'skinetic' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title-item .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label' => __( 'Icon Border Radius', 'skinetic' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .title-item .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_hover',
			[
				'label' => __( 'Hover / Active', 'skinetic' ),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Icon Hover Color', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-item a:hover .icon, {{WRAPPER}} .title-item a:hover .icon svg, {{WRAPPER}} .title-item a.tab-active .icon, {{WRAPPER}} .title-item a.tab-active .icon svg' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_hover_bg_color',
			[
				'label' => __( 'Icon Background Hover', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-item a:hover .icon, {{WRAPPER}} .title-item a.tab-active .icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/** ---------- Advanced Section ---------- **/

		$this->start_controls_section(
			'advanced_section',
			[
				'label' => __( 'Advanced', 'skinetic' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'title_width',
			[
				'label' => __( 'Width', 'skinetic' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 1000 ],
					'%' => [ 'min' => 0, 'max' => 100 ],
					'vw' => [ 'min' => 0, 'max' => 100 ],
				],
				'selectors' => [
					'{{WRAPPER}} .title-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_height',
			[
				'label' => __( 'Height', 'skinetic' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 500 ],
					'vh' => [ 'min' => 0, 'max' => 100 ],
				],
				'selectors' => [
					'{{WRAPPER}} .title-item a' => 'height: {{SIZE}}{{UNIT}}; display: flex; align-items: center;',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'skinetic' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_control(
			'css_filters_heading',
			[
				'label' => __( 'CSS Filters', 'skinetic' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .title-item a',
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'label' => __( 'Hover CSS Filters', 'skinetic' ),
				'selector' => '{{WRAPPER}} .title-item a:hover, {{WRAPPER}} .title-item a.tab-active',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$hover_animation = ! empty( $settings['hover_animation'] ) ? 'elementor-animation-' . $settings['hover_animation'] : '';
		?>
		<div class="tab-titles">
			<?php foreach ( $settings['title_boxes'] as $box ) : ?>
				<div class="title-item font-second <?php echo esc_attr( $hover_animation ); ?>">
					<a href="<?php echo esc_url( $box['title_link'] ); ?>">
						<?php if ( ! empty( $box['icon']['value'] ) ) : ?>
							<span class="icon">
								<?php Icons_Manager::render_icon( $box['icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
						<?php endif; ?>
						<?php echo esc_html( $box['titles'] ); ?>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register( new CreamPoint_Tab_Titles() );