<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Team 3
 */
class Skinetic_Team3 extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'imember3';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'XP Team 3', 'skinetic' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-person';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_skinetic' ];
	}

	protected function register_controls() {

		/**TAB_CONTENT**/
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Member Team', 'skinetic' ),
			]
		);

		$this->add_control(
	       'member_image',
	        [
	            'label' => esc_html__( 'Photo', 'skinetic' ),
	            'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => get_template_directory_uri().'/images/c-member-2.jpg',
				]
		    ]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'member_image_size',
				'exclude' => ['1536x1536', '2048x2048'],
				'include' => [],
				'default' => 'full',
			]
		);

	    $this->add_control(
		    'member_name',
	      	[
	          	'label' => esc_html__( 'Name', 'skinetic' ),
	          	'type'  => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Peter Perish', 'skinetic' ),
	    	]
	    );

	    $this->add_control(
		    'member_extra',
	      	[
	          	'label' => esc_html__( 'Extra/Job', 'skinetic' ),
	          	'type'  => Controls_Manager::TEXTAREA,
	          	'default' => esc_html__( 'co-founder of company', 'skinetic' ),
	    	]
	    );

		$repeater = new Repeater();
		$repeater->add_control(
	      	'title',
		    [
		        'label'   => esc_html__( 'Name', 'skinetic' ),
		        'type'    => Controls_Manager::TEXT,
		        'default' => esc_html__( 'Social', 'skinetic' ),
		    ]
	    );

        $repeater->add_control(
            'social_icon',
            [
                'label' => esc_html__( 'Icon', 'skinetic' ),
                'type'  => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fab fa-twitter',
					'library' => 'fa-brand',
				],
            ]
        );

        $repeater->add_control(
            'social_link',
            [
                'label' => esc_html__( 'Link', 'skinetic' ),
                'type'  => Controls_Manager::URL,
                'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://', 'skinetic' ),
				'default' => [
					'url' => 'https://', 
				],
            ]
		);

		$this->add_control(
		    'social_share',
		    [
		        'label'       => esc_html__( 'Socials', 'skinetic' ),
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => true,
		        'default'     => [
		            [
		             	'title'       => esc_html__( 'Twitter', 'skinetic' ),
		                'social_link' => esc_html__( 'https://www.twitter.com/', 'skinetic' ),
		                'social_icon' => [
							'value' => 'fab fa-twitter',
							'library' => 'fa-brand',
						],
		 
		            ],
		            [
		             	'title'       => esc_html__( 'Facebook', 'skinetic' ),
		                'social_link' => esc_html__( 'https://www.facebook.com/', 'skinetic' ),
		                'social_icon' => [
							'value' => 'fab fa-facebook-f',
							'library' => 'fa-brand',
						],
		 
		            ],
		            [
		             	'title'       => esc_html__( 'Pinterest', 'skinetic' ),
		                'social_link' => esc_html__( 'https://www.pinterest.com/', 'skinetic' ),
		                'social_icon' => [
							'value' => 'fab fa-pinterest-p',
							'library' => 'fa-brand',
						],

		            ]
		        ],
		        'fields'      => $repeater->get_controls(),
		        'title_field' => '{{{title}}}',
		    ]
		);
		$this->add_control(
			'link',
			[
				'label' => __( 'Link To Details', 'skinetic' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://', 'skinetic' ),
			]
		);

		$this->end_controls_section();

		/**TAB_STYLE**/
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'General', 'skinetic' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'heading_normal',
			[
				'label' => __( 'Normal', 'skinetic' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'padding_box',
			[
				'label' => __( 'Padding Box', 'skinetic' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .xp-team' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'radius_box',
			[
				'label' => __( 'Border Radius', 'skinetic' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .xp-team' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'bg_box',
			[
				'label' => __( 'Background', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-team' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_box_shadow',
				'selector' => '{{WRAPPER}} .xp-team',
			]
		);

		
		$this->add_control(
			'box_animation',
			[
				'label' => __( 'Hover Animation', 'skinetic' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
				'default' => 'float',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'photo_style',
			[
				'label' => esc_html__( 'Photo', 'skinetic' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'photo_space',
			[
				'label' => esc_html__( 'Spacing', 'skinetic' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xp-team .team-thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'radius_photo',
			[
				'label' => __( 'Border Radius', 'skinetic' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .xp-team img, {{WRAPPER}} .xp-team a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_hover',
			[
				'label' => __( 'Hover', 'skinetic' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'bg_overlay',
			[
				'label' => __( 'Background Overlay', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-thumb a:before' => 'background: {{VALUE}};',
				],
				'condition' => [
					'link[url]!'  => ''
				]
			]
		);
		$this->add_control(
			'color_icon_overlay',
			[
				'label' => __( 'Color Icon', 'skinetic' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-thumb a:after' => 'color: {{VALUE}};',
				],
				'condition' => [
					'link[url]!'  => ''
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'info_style',
			[
				'label' => esc_html__( 'Info Box', 'skinetic' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'skinetic' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'skinetic' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'skinetic' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'skinetic' ),
						'icon' => 'eicon-text-align-right',
					]
				],
				'selectors' => [
					'{{WRAPPER}} .xp-team' => 'text-align: {{VALUE}};',
				],
			]
		);
		/* title */
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'skinetic' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_space',
			[
				'label' => esc_html__( 'Spacing', 'skinetic' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xp-team h6' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'skinetic' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .xp-team h6, {{WRAPPER}} .xp-team h6 a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_hcolor',
			[
				'label'     => esc_html__( 'Color Hover', 'skinetic' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .xp-team h6 a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'link[url]!'  => ''
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'skinetic' ),
				'selector' => '{{WRAPPER}} .xp-team h6',
			]
		);

		/* extra */
		$this->add_control(
			'heading_job',
			[
				'label' => __( 'Extra/Job', 'skinetic' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'job_space',
			[
				'label' => esc_html__( 'Spacing', 'skinetic' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-social' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'job_color',
			[
				'label'     => esc_html__( 'Color', 'skinetic' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-info span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
					'name'     => 'job_typography',
					'label'    => esc_html__( 'Typography', 'skinetic' ),
					'selector' => '{{WRAPPER}} .team-info span',
				]
		);

		$this->end_controls_section();

		/* socials */
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Socials', 'skinetic' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_social_space',
			[
				'label' => esc_html__( 'Spacing', 'skinetic' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 30,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-social a' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'radius_socials',
			[
				'label' => __( 'Border Radius', 'skinetic' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .team-social a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_social_color',
			[
				'label'     => esc_html__( 'Color', 'skinetic' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-social a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .team-social a svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_social_bg',
			[
				'label'     => esc_html__( 'Background', 'skinetic' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-social a' => 'background: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'label'     => esc_html__( 'Color Hover', 'skinetic' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-social a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .team-social a:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'social_hover_bg',
			[
				'label'     => esc_html__( 'Background Hover', 'skinetic' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-social a:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$photo = Group_Control_Image_Size::get_attachment_image_html( $settings, 'member_image_size', 'member_image' );
		$tname = $settings['member_name'];
		$overlay = '';

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'm_link', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'm_link', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'm_link', 'rel', 'nofollow' );
			}
			$photo = '<a ' .$this->get_render_attribute_string( 'm_link' ). '>' .$photo. '</a>';
			$tname = '<a ' .$this->get_render_attribute_string( 'm_link' ). '>' .$tname. '</a>';
		}

		$this->add_render_attribute( 'team-box', 'class', 'xp-team team-3 circle-social' );
		if ( $settings['box_animation'] ) {
			$this->add_render_attribute( 'team-box', 'class', 'elementor-animation-' . $settings['box_animation'] );
		}
		?>

		<div <?php echo wp_kses_post($this->get_render_attribute_string('team-box')); ?>>
			<div class="team-thumb">
								<?php if ( $settings['member_image']['url'] ) { echo wp_kses_post( $photo ); } ?>
			</div>
			<div class="team-info">
				<?php if ( $settings['member_name'] ) { echo '<h6 class="tname">' .$tname. '</h6>'; } ?>
				<?php if ( $settings['member_extra'] ) { echo '<span>' .$settings['member_extra']. '</span>'; } ?>
				<?php if ( ! empty( $settings['social_share'] ) ) : ?>
				<div class="team-social">
					<?php foreach ( $settings['social_share'] as $key => $social ) : ?>
						<?php 
							$link_key = 'link_' . $key;
							$this->add_render_attribute( $link_key, 'class', [
								strtolower($social['title']),
								'elementor-repeater-item-' . $social['_id'],
							] );
						?>
						<?php if ( ! empty( $social['social_link'] ) ) : ?>
							<a <?php echo wp_kses_post($this->get_render_attribute_string($link_key)); ?> <?php if($social['social_link']['is_external'])
							{ echo 'target="_blank"'; }else{ echo 'rel="nofollow"';}?> 
									href="<?php echo esc_url( $social['social_link']['url'] );?>"">
									<?php Icons_Manager::render_icon( $social['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</a>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	        
	    <?php
	}

}
// After the Skinetic_Team3 class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Skinetic_Team3() );