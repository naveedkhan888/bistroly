<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Widget Name: Animated Image Reveal
 */
class Bistroly_Animated_Image extends Widget_Base {

    public function get_name() {
        return 'animated-image-reveal';
    }

    public function get_title() {
        return __( 'XP Animated Image', 'bistroly' );
    }

    public function get_icon() {
        return 'eicon-image';
    }

    public function get_categories() {
        return [ 'category_bistroly' ];
    }

    public function get_script_depends() {
        return [ 'bistroly-animated-image' ];
    }

    protected function register_controls() {
        
        // Image Section
        $this->start_controls_section(
            'image_section',
            [
                'label' => __( 'Image', 'bistroly' ),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __( 'Choose Image', 'bistroly' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'default' => 'large',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'bistroly' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'bistroly' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'bistroly' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'bistroly' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xp-animated-image-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'link_to',
            [
                'label' => __( 'Link', 'bistroly' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __( 'None', 'bistroly' ),
                    'custom' => __( 'Custom URL', 'bistroly' ),
                ],
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __( 'Link', 'bistroly' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', 'bistroly' ),
                'condition' => [
                    'link_to' => 'custom',
                ],
                'show_label' => false,
            ]
        );

        $this->end_controls_section();

        // Animation Section
        $this->start_controls_section(
            'animation_section',
            [
                'label' => __( 'Reveal Animation', 'bistroly' ),
            ]
        );

        $this->add_control(
            'reveal_direction',
            [
                'label' => __( 'Reveal Direction', 'bistroly' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => __( 'From Left', 'bistroly' ),
                    'right' => __( 'From Right', 'bistroly' ),
                    'top' => __( 'From Top', 'bistroly' ),
                    'bottom' => __( 'From Bottom', 'bistroly' ),
                    'center' => __( 'From Center', 'bistroly' ),
                    'zoom' => __( 'Zoom In', 'bistroly' ),
                ],
            ]
        );

        $this->add_control(
            'animation_duration',
            [
                'label' => __( 'Animation Duration (ms)', 'bistroly' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 300,
                        'max' => 3000,
                        'step' => 100,
                    ],
                ],
                'default' => [
                    'size' => 1200,
                ],
            ]
        );

        $this->add_control(
            'animation_delay',
            [
                'label' => __( 'Animation Delay (ms)', 'bistroly' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                        'step' => 100,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],
            ]
        );

        $this->add_control(
            'animation_easing',
            [
                'label' => __( 'Animation Easing', 'bistroly' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ease-out',
                'options' => [
                    'linear' => __( 'Linear', 'bistroly' ),
                    'ease' => __( 'Ease', 'bistroly' ),
                    'ease-in' => __( 'Ease In', 'bistroly' ),
                    'ease-out' => __( 'Ease Out', 'bistroly' ),
                    'ease-in-out' => __( 'Ease In Out', 'bistroly' ),
                    'cubic-bezier(0.68, -0.55, 0.265, 1.55)' => __( 'Back', 'bistroly' ),
                ],
            ]
        );

        $this->add_control(
            'trigger_offset',
            [
                'label' => __( 'Trigger Offset (%)', 'bistroly' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'size' => 80,
                ],
                'description' => __( 'When to trigger the animation (% of element visible)', 'bistroly' ),
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label' => __( 'Overlay Color', 'bistroly' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'description' => __( 'Color of the reveal overlay', 'bistroly' ),
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Image Style', 'bistroly' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => __( 'Width', 'bistroly' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xp-animated-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => __( 'Height', 'bistroly' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xp-animated-image img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'object_fit',
            [
                'label' => __( 'Object Fit', 'bistroly' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'fill' => __( 'Fill', 'bistroly' ),
                    'contain' => __( 'Contain', 'bistroly' ),
                    'cover' => __( 'Cover', 'bistroly' ),
                    'none' => __( 'None', 'bistroly' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .xp-animated-image img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'bistroly' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .xp-animated-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .xp-animated-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .xp-animated-image .reveal-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .xp-animated-image',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .xp-animated-image',
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'css_filters',
                'selector' => '{{WRAPPER}} .xp-animated-image img',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['image']['url'] ) ) {
            return;
        }

        $has_link = false;
        $link_tag = 'div';

        if ( $settings['link_to'] === 'custom' ) {
            if ( ! empty( $settings['link']['url'] ) ) {
                $has_link = true;
                $link_tag = 'a';
                $this->add_link_attributes( 'link', $settings['link'] );
            }
        }

        $this->add_render_attribute( 'wrapper', 'class', 'xp-animated-image-wrapper' );
        
        $this->add_render_attribute( 'image-container', 'class', 'xp-animated-image' );
        $this->add_render_attribute( 'image-container', 'data-reveal-direction', $settings['reveal_direction'] );
        $this->add_render_attribute( 'image-container', 'data-duration', $settings['animation_duration']['size'] );
        $this->add_render_attribute( 'image-container', 'data-delay', $settings['animation_delay']['size'] );
        $this->add_render_attribute( 'image-container', 'data-easing', $settings['animation_easing'] );
        $this->add_render_attribute( 'image-container', 'data-trigger-offset', $settings['trigger_offset']['size'] );
        $this->add_render_attribute( 'image-container', 'data-overlay-color', $settings['overlay_color'] );

        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            <?php if ( $has_link ) : ?>
                <a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
            <?php endif; ?>
            
            <div <?php echo $this->get_render_attribute_string( 'image-container' ); ?>>
                <div class="reveal-overlay"></div>
                <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image', 'image' ); ?>
            </div>
            
            <?php if ( $has_link ) : ?>
                </a>
            <?php endif; ?>
        </div>
        <?php
    }
}

Plugin::instance()->widgets_manager->register( new Bistroly_Animated_Image() );
