<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Elementor Style for header
 *
 *
 * @since 1.0.0
 */

/**
 * Widget Name: Contact Form 7 
 */

class Skinetic_Contact_Form_7 extends Widget_Base {   //this name is added to plugin.php of the root folder

	public function get_name() {
		return 'ictf7';
	}

	public function get_title() {
		return 'XP Contact Form';   // title to show on elementor
	}

	public function get_icon() {
		return 'eicon-mail';    //   eicon-posts-ticker-> eicon ow asche icon to show on elelmentor
	}

	public function get_categories() {
		return [ 'category_skinetic' ];    // category of the widget
	}

	/**
	 * A list of scripts that the widgets is depended in
	 * @since 1.3.0
	 **/
	protected function register_controls() {
			
		//start of a control box
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Contact Form 7', 'skinetic' ),   //section name for controler view
			]
		);

		$this->add_control(
			'cf7',
			[
				'label' => esc_html__( 'Select Contact Form', 'skinetic' ),
                'description' => esc_html__('Contact form 7 - plugin must be installed and there must be some contact forms made with the contact form 7','skinetic'),
				'type' => Controls_Manager::SELECT2,
				'multiple' => false,
				'label_block' => true,
				'options' => $this->get_contact_form_7_posts(),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_redirect',
			[
				'label' => esc_html__( 'After Submit Redirect Setting', 'skinetic' ),   //section name for controler view
			]
		);

		$this->add_control(
			'cf7_redirect_page',
			[
				'label' => esc_html__( 'On Success Redirect To', 'skinetic' ),
                'description' => esc_html__('Select a page which you want users to redirect to when the contact fom is submitted and is successful. Leave Blank to Disable','skinetic'),
				'type' => Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => $this->skinetic_get_all_pages(),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style Contact Form', 'skinetic' ),   //section name for controler view
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'css_all_fields',
			[
				'label' => __( 'Global CSS For all fields', 'skinetic' ),
				'description' => __( 'This is the global css for all fields of cf7. It will not effect the other fileds but if you want to define things such as color, background color use this.', 'skinetic' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => 'color:#000;',
				'selectors' => [
					'{{WRAPPER}} ' => '{{VALUE}}',
				],
			]
		);

		$this->add_control(
			'css_all_label',
			[
				'label' => __( 'All Label CSS', 'skinetic' ),
				'description' => __( 'Changes might not sometimes show in the live preview but check in the front end to see the changes.', 'skinetic' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => 'color:#fff;',
				'selectors' => [
					'{{WRAPPER}} label' => '{{VALUE}}',
				],
			]
		);	
		$this->add_control(
			'css_all_input',
			[
				'label' => __( 'All Input CSS', 'skinetic' ),
				'description' => __( 'Changes might not sometimes show in the live preview but check in the front end to see the changes.', 'skinetic' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => 'width:100%;
							      background:red;',
				'selectors' => [
					'{{WRAPPER}} input' => 'height:auto;',
					'{{WRAPPER}} input' => '{{VALUE}}',
					
				],
			]
		);

		$this->add_control(
			'css_text_area',
			[
				'label' => __( 'Textarea CSS', 'skinetic' ),
				'description' => __( 'Changes might not sometimes show in the live preview but check in the front end to see the changes.', 'skinetic' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => 'height:100px; 
								  width:100%;',
				'selectors' => [
					'{{WRAPPER}} textarea' => 'height:auto;',
					'{{WRAPPER}} textarea' => '{{VALUE}}',
				],
			]
		);

		$this->add_control(
			'css_checkbox',
			[
				'label' => __( 'Checkbox/ Radio CSS', 'skinetic' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => 'display: block;',
				'selectors' => [
					'{{WRAPPER}} .wpcf7-list-item' => '{{VALUE}}',
				],
			]
		);	

		$this->add_control(
			'css_select',
			[
				'label' => __( 'Dropdown/ Select Box css', 'skinetic' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => 'width: 100;',
				'selectors' => [
					'{{WRAPPER}} select' => '{{VALUE}}',
				],
			]
		);	
		$this->add_control(
			'css_selectoptions',
			[
				'label' => __( 'Select Options Css', 'skinetic' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => 'color: red;',
				'selectors' => [
					'{{WRAPPER}} select option' => '{{VALUE}}',
				],
			]
		);		

		$this->add_control(
			'css_file',
			[
				'label' => __( 'File CSS', 'skinetic' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => 'display: block;',
				'selectors' => [
					'{{WRAPPER}} input[type="file"]' => '{{VALUE}}',
				],
			]
		);	
		$this->add_control(
			'css_date',
			[
				'label' => __( 'Date CSS', 'skinetic' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => 'display: block;',
				'selectors' => [
					'{{WRAPPER}} .wpcf7-date' => '{{VALUE}}',
				],
			]
		);	
		$this->add_control(
			'css_input_submit',
			[
				'label' => __( 'Submit Button CSS', 'skinetic' ),
				'description' => __( 'Changes might not sometimes show in the live preview but check in the front end to see the changes.', 'skinetic' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => 'width:100%; background:red;',
				'selectors' => [
					'{{WRAPPER}} input[type="submit"], {{WRAPPER}} button[type="submit"]' => '{{VALUE}}',
				],
			]
		);		
		$this->add_control(
			'css_input_submit_hover',
			[
				'label' => __( 'Submit Button Hover CSS', 'skinetic' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => 'background:#fff;',
				'selectors' => [
					'{{WRAPPER}} input[type="submit"]:hover' => '{{VALUE}}',
				],
			]
		);

		$this->add_control(
			'css_responce',
			[
				'label' => __( 'response CSS', 'skinetic' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => 'color:red;',
				'selectors' => [
					'{{WRAPPER}} .wpcf7-response-output' => '{{VALUE}}',
				],
			]
		);


		$this->end_controls_section();

	}


	protected function render() {
		static $v_veriable=0;

		$settings = $this->get_settings();
        if(!empty($settings['cf7'])){
    	   echo'<div class="elementor-shortcode skinetic-cf7-'.$v_veriable.'">';
                echo do_shortcode('[contact-form-7 id="'.$settings['cf7'].'"]');    
           echo '</div>';  
    	}

 		if(!empty($settings['cf7_redirect_page'])) {  ?>
 			<script>
 			        var theform = document.querySelector('.skinetic-cf7-<?php echo esc_js( $v_veriable ); ?>');
						theform.addEventListener( 'wpcf7mailsent', function( event ) {
					    location = '<?php echo get_permalink( $settings['cf7_redirect_page'] ); ?>';
					}, false );
			</script>

		<?php  $v_veriable++;
 		}
    }

    protected function get_contact_form_7_posts(){

	 	$args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);

	    $catlist=[];
	    
	    if( $categories = get_posts($args)){
	    	foreach ( $categories as $category ) {
	    		(int)$catlist[$category->ID] = $category->post_title;
	    	}
	    }
	    else{
	        (int)$catlist['0'] = esc_html__('No contect From 7 form found', 'skinetic');
	    }
	  	return $catlist;
	}

	protected function skinetic_get_all_pages(){

	  	$args = array('post_type' => 'page', 'posts_per_page' => -1);

	    $catlist=[];
	    
	    if( $categories = get_posts($args)){
	      foreach ( $categories as $category ) {
	        (int)$catlist[$category->ID] = $category->post_title;
	      }
	    }
	    else{
	        (int)$catlist['0'] = esc_html__('No Pages Found!', 'skinetic');
	    }
	  	return $catlist;
	}

}
// After the Skinetic_Contact_Form_7 class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Skinetic_Contact_Form_7() );
