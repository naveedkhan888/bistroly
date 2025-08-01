<?php

namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if (! defined('ABSPATH')) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Image Box Carousel
 */
class Image_Card_Carousel_Widget extends Widget_Base
{

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name()
    {
        return 'image_card_carousel';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title()
    {
        return __('XP Service Carousel', 'skinetic');
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon()
    {
        return 'eicon-slider-push';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories()
    {
        return ['category_skinetic'];
    }

    protected function register_controls()
    {

        //Content Image box
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Image Box', 'skinetic'),
            ]
        );
        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'skinetic'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
                        'title' => __('Left', 'skinetic'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'skinetic'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'skinetic'),
                        'icon' => 'eicon-text-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .xpic-card' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'image_box',
            [
                'label' => __('Image', 'skinetic'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'title_box',
            [
                'label' => __('Title', 'skinetic'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Service Title',
            ]
        );

        $repeater->add_control(
            'link_box',
            [
                'label' => __('Link', 'skinetic'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'skinetic'),
                'default' => [
                    'url' => '#'
                ],
            ]
        );
        $this->add_control(
            'image_boxes',
            [
                'label'       => '',
                'type'        => Controls_Manager::REPEATER,
                'show_label'  => false,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{title_box}}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image_box_size',
                'exclude' => ['1536x1536', '2048x2048'],
                'include' => [],
                'default' => 'full',
            ]
        );
        $this->add_control(
            'header_size',
            [
                'label' => __('Title HTML Tag', 'skinetic'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h5',
            ]
        );


        $slides_show = range(1, 10);
        $slides_show = array_combine($slides_show, $slides_show);

        $this->add_responsive_control(
            'tshow',
            [
                'label' => __('Slides To Show', 'skinetic'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __('Default', 'skinetic'),
                ] + $slides_show,
                'default' => '',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'loop',
            [
                'label' => __('Loop', 'skinetic'),
                'type' => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => __('Yes', 'skinetic'),
                    'false' => __('No', 'skinetic'),
                ]
            ]
        );
        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay', 'skinetic'),
                'type' => Controls_Manager::SELECT,
                'default' => 'true',
                'options' => [
                    'true' => __('Yes', 'skinetic'),
                    'false' => __('No', 'skinetic'),
                ]
            ]
        );
        $this->add_control(
            'timeout',
            [
                'label' => __('Autoplay Timeout', 'skinetic'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 1000,
                        'max'  => 20000,
                        'step' => 1000,
                    ],
                ],
                'default' => [
                    'size' => 7000,
                ],
                'condition' => [
                    'autoplay' => 'true',
                ]
            ]
        );
        $this->add_control(
            'arrows',
            [
                'label' => __('Arrows', 'skinetic'),
                'type' => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true'   => __('Yes', 'skinetic'),
                    'false'  => __('No', 'skinetic'),
                ],
            ]
        );
        $this->add_control(
            'dots',
            [
                'label' => __('Dots', 'skinetic'),
                'type' => Controls_Manager::SELECT,
                'default' => 'true',
                'options' => [
                    'true'   => __('Yes', 'skinetic'),
                    'false'  => __('No', 'skinetic'),
                ],
            ]
        );
        $this->add_responsive_control(
            'w_gaps',
            [
                'label' => __('Gap Width', 'skinetic'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        /***Style***/

        $this->start_controls_section(
            'style_content_section',
            [
                'label' => __('Content', 'skinetic'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        /* Image Overlay */
        $this->add_control(
            'heading_image_overlay',
            [
                'label' => __('Image Overlay', 'skinetic'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Replace single color control with gradient
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'overlay_background',
                'label' => __('Overlay Color', 'skinetic'),
                'types' => ['gradient'],
                'selector' => '{{WRAPPER}} .xpic-card .overlay',
                'default' => 'gradient',
                'fields_options' => [
                    'background' => [
                        'default' => 'gradient',
                    ],
                    'color' => [
                        'default' => 'rgba(0, 0, 0, 0.2)',
                    ],
                    'color_b' => [
                        'default' => 'rgba(0, 0, 0, 0.6)',
                    ],
                ],
            ]
        );

        // Replace hover color control with gradient
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'overlay_hover_background',
                'label' => __('Overlay Hover Color', 'skinetic'),
                'types' => ['gradient'],
                'selector' => '{{WRAPPER}} .xpic-card:hover .overlay',
                'default' => 'gradient',
                'fields_options' => [
                    'background' => [
                        'default' => 'gradient',
                    ],
                    'color' => [
                        'default' => 'rgba(0, 0, 0, 0.4)',
                    ],
                    'color_b' => [
                        'default' => 'rgba(0, 0, 0, 0.8)',
                    ],
                ],
            ]
        );

        $this->add_control(
            'overlay_position',
            [
                'label' => __('Overlay Position', 'skinetic'),
                'type' => Controls_Manager::HIDDEN,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xpic-card' => 'position: relative;',
                    '{{WRAPPER}} .xpic-card .overlay' => 'position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 1;',
                    '{{WRAPPER}} .xpic-card .xpic-content' => 'position: relative; z-index: 2;',
                ],
            ]
        );

        $this->add_control(
            'overlay_transition',
            [
                'label' => __('Overlay Transition', 'skinetic'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0.1,
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 0.3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .xpic-card .overlay' => 'transition: all {{SIZE}}s ease;',
                ],
            ]
        );



        /* gereral */
        $this->add_control(
            'heading_gereral',
            [
                'label' => __('Gereral', 'skinetic'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'box_bg',
            [
                'label' => __('Background', 'skinetic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xpic-card' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label' => __('Padding Box', 'skinetic'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .xpic-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'radius_box',
            [
                'label' => __('Border Radius', 'skinetic'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .xpic-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_box_shadow',
                'selector' => '{{WRAPPER}} .xpic-card',
            ]
        );

        /* title */
        $this->add_control(
            'heading_title',
            [
                'label' => __('Title', 'skinetic'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'title_space',
            [
                'label' => __('Spacing', 'skinetic'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xpic-title-box a' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Color', 'skinetic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xpic-title-box a' => 'color: {{VALUE}};', // Changed from title-box
                ]
            ]
        );

        $this->add_control(
            'title_hcolor',
            [
                'label' => __('Hover Color', 'skinetic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xpic-title-box a:hover' => 'color: {{VALUE}};', // Changed from title-box
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .xpic-title-box a',
            ]
        );



        /* button */
        $this->add_control(
            'heading_btn',
            [
                'label' => __('Button', 'skinetic'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'label_link!' => '',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'selector' => '{{WRAPPER}} .link-box',
                'condition' => [
                    'label_link!' => '',
                ],
            ]
        );
        $this->start_controls_tabs('tabs_btn_style');
        $this->start_controls_tab(
            'tab_btn_normal',
            [
                'label' => __('Normal', 'skinetic'),
                'condition' => [
                    'label_link!' => '',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color',
            [
                'label' => __('Background Color', 'skinetic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .link-box' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'label_link!' => '',
                ],
            ]
        );
        $this->add_control(
            'btn_color',
            [
                'label' => __('Color', 'skinetic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .link-box' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'label_link!' => '',
                ],
            ]
        );
        $this->add_control(
            'btn_bcolor',
            [
                'label' => __('Border Color', 'skinetic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .link-box' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'label_link!' => '',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_btn_hover',
            [
                'label' => __('Hover', 'skinetic'),
                'condition' => [
                    'label_link!' => '',
                ],
            ]
        );
        $this->add_control(
            'hover_btn_bg_color',
            [
                'label' => __('Background Color', 'skinetic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .link-box:hover' => 'background: {{VALUE}}; border-color: {{VALUE}};',
                ],
                'condition' => [
                    'label_link!' => '',
                ],
            ]
        );
        $this->add_control(
            'hover_btn_color',
            [
                'label' => __('Color', 'skinetic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .link-box:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'label_link!' => '',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Dots.
        $this->start_controls_section(
            'navigation_section',
            [
                'label' => __('Dots', 'skinetic'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'dots' => 'true',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_spacing',
            [
                'label' => __('Spacing', 'skinetic'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dots_bgcolor',
            [
                'label' => __('Color', 'skinetic'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-dots button.owl-dot span' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dots_active_bgcolor',
            [
                'label' => __('Color Active', 'skinetic'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-dots button.owl-dot.active span' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Arrows.
        $this->start_controls_section(
            'style_nav',
            [
                'label' => __('Arrows', 'skinetic'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'arrows' => 'true',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_spacing',
            [
                'label' => __('Spacing', 'skinetic'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .owl-nav .owl-prev' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .owl-nav .owl-next' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_width',
            [
                'label' => __('Width', 'skinetic'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 70,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .owl-nav button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'arrow_color',
            [
                'label' => __('Color', 'skinetic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .owl-nav button' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'arrow_bg_color',
            [
                'label' => __('Background', 'skinetic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .owl-nav button' => 'background: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'arrow_hcolor',
            [
                'label' => __('Color Hover', 'skinetic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .owl-nav button:hover' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'arrow_bg_hcolor',
            [
                'label' => __('Background Hover', 'skinetic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .owl-nav button:hover' => 'background: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'radius_arrow',
            [
                'label' => __('Border Radius', 'skinetic'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .owl-nav button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('heading', 'class', 'xpic-title-box');

        $shows  = !empty($settings['tshow']) ? $settings['tshow'] : 3;
        $tshows = !empty($settings['tshow_tablet']) ? $settings['tshow_tablet'] : $shows;
        $mshows = !empty($settings['tshow_mobile']) ? $settings['tshow_mobile'] : $tshows;
        $gaps   = isset($settings['w_gaps']['size']) && is_numeric($settings['w_gaps']['size']) ? $settings['w_gaps']['size'] : 30;
        $tgaps  = isset($settings['w_gaps_tablet']['size']) && is_numeric($settings['w_gaps_tablet']['size']) ? $settings['w_gaps_tablet']['size'] : $gaps;
        $mgaps  = isset($settings['w_gaps_mobile']['size']) && is_numeric($settings['w_gaps_mobile']['size']) ? $settings['w_gaps_mobile']['size'] : $tgaps;


?>
        <div class="image-card-carousel"

            data-loop="<?php echo esc_attr($settings['loop']); ?>"
            data-auto="<?php echo esc_attr($settings['autoplay']); ?>"
            data-time="<?php echo esc_attr($settings['timeout']['size']); ?>"
            data-arrows="<?php echo esc_attr($settings['arrows']); ?>"
            data-dots="<?php echo esc_attr($settings['dots']); ?>"
            data-show="<?php echo esc_attr($shows); ?>"
            data-tshow="<?php echo esc_attr($tshows); ?>"
            data-mshow="<?php echo esc_attr($mshows); ?>"
            data-gaps="<?php echo esc_attr($gaps); ?>"
            data-tgaps="<?php echo esc_attr($tgaps); ?>"
            data-mgaps="<?php echo esc_attr($mgaps); ?>">
            <div class="owl-carousel owl-theme">
                <?php foreach ($settings['image_boxes'] as $key => $boxes) :
                    $photo_url = Group_Control_Image_Size::get_attachment_image_src($boxes['image_box']['id'], 'image_box_size', $settings);
                    $photo = '<img src="' . esc_url($photo_url) . '" alt="' . esc_attr($boxes['title_box']) . '">';
                    $tbox  = $boxes['title_box'];
                    $tbox_html = sprintf('<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string('heading'), $tbox);

                    if (! empty($boxes['link_box']['url'])) {
                        $this->add_render_attribute('m_link' . $key, 'href', $boxes['link_box']['url']);

                        if ($boxes['link_box']['is_external']) {
                            $this->add_render_attribute('m_link' . $key, 'target', '_blank');
                        }

                        if ($boxes['link_box']['nofollow']) {
                            $this->add_render_attribute('m_link' . $key, 'rel', 'nofollow');
                        }

                        $photo = '<a ' . $this->get_render_attribute_string('m_link' . $key) . '>' . $photo . '</a>';
                        $tbox_html = sprintf('<%1$s %2$s><a ' . $this->get_render_attribute_string('m_link' . $key) . '>%3$s</a></%1$s>', $settings['header_size'], $this->get_render_attribute_string('heading'), $tbox);
                    }
                    $this->add_render_attribute('m_link' . $key, 'class', 'xpic-link font-second');
                ?>
                    <div class="xpic-card">
                        <a href="<?php echo esc_url($boxes['link_box']['url']); ?>" class="link_h_bx"></a>
                        <?php if ($boxes['image_box']['url']) {
                            echo wp_kses_post($photo);
                        ?>
                            <div class="overlay"></div>
                        <?php } ?>
                        <div class="xpic-content">
                            <?php if ($boxes['title_box']) {
                                echo wp_kses_post($tbox_html);
                            } ?>
                        </div>
                        
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
<?php
    }

    public function get_keywords()
    {
        return ['service'];
    }
}

Plugin::instance()->widgets_manager->register(new Image_Card_Carousel_Widget());
