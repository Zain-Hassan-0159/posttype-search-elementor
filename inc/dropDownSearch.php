<?php

/**
 * Elementor posttype-search-elementor
 *
 * @package           Elementor posttype-search-elementor
 * @author            Zain Hassan
 *
 */
   


/**
 * Elementor List Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class dropDown_widget_elementore  extends \Elementor\Widget_Base {
	

	public function get_style_depends() {

		wp_register_style( 'dropDown-style', plugins_url( 'assets/css/dropdown.css', __FILE__ ) );

		return [
			'dropDown-style',
		];

	}
	

	/**
	 * Get widget name.
	 *
	 * Retrieve company widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'dropDown Filter';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve company widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'dropDown Filter', 'posttype-search-elementor ' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve company widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-wordpress';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://developers.elementor.com/widgets/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the company of categories the company widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'el-postypeSearch' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the company of keywords the company widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'dropDown', 'widgets', 'filter', 'dropDown widgets' ];
	}

	public function get_all_custom_post_type(){
		// this is all custom post types
		$args       = array(
			'public' => true,
		);
		$post_types = get_post_types( $args, 'objects' );
		$posts = array();
		foreach ($post_types as $post_type) {
			$posts[$post_type->name] = $post_type->labels->singular_name;
		}

		return $posts;
		// this is all custom post types
	}

	public function get_object_taxonomies_custom_post($program='program'){
		$taxonomies = get_object_taxonomies($program);
		$taxonomiesarray = [];
		foreach($taxonomies as $tax){
			$taxonomiesarray[$tax] = $tax;
		}
		return $taxonomiesarray;
	}


	public function get_all_terms(){
		// get a list of available taxonomies for a post type
		$terms = [];
		foreach(get_terms() as $term){
			$terms[$term->term_id] =  $term->name;
		}
		return $terms;
	}


	/**
	 * Register company widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Drop Down', 'posttype-search-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'select_postType',
			[
				'label' => esc_html__( 'Select Post Type', 'posttype-search-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => $this->get_all_custom_post_type()['programas'],
				'options' => $this->get_all_custom_post_type(),
			]
		);
		
		$this->add_control(
			'program_taxonomies',
			[
				'label' => esc_html__( 'Select taxonomy', 'posttype-search-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options' => $this->get_object_taxonomies_custom_post('program'),
				'condition' => [
					'select_postType' => 'program',
				],
			]
		);
		
		$this->add_control(
			'post_taxonomies',
			[
				'label' => esc_html__( 'Select taxonomy', 'posttype-search-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options' => $this->get_object_taxonomies_custom_post('post'),
				'condition' => [
					'select_postType' => 'post',
				],
			]
		);
		
		$this->add_control(
			'page_taxonomies',
			[
				'label' => esc_html__( 'Select taxonomy', 'posttype-search-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options' => $this->get_object_taxonomies_custom_post('page'),
				'condition' => [
					'select_postType' => 'page',
				],
			]
		);
		
		$this->add_control(
			'tp_event_taxonomies',
			[
				'label' => esc_html__( 'Select taxonomy', 'posttype-search-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options' => $this->get_object_taxonomies_custom_post('tp_event'),
				'condition' => [
					'select_postType' => 'tp_event',
				],
			]
		);
		
		$this->add_control(
			'faq_taxonomies',
			[
				'label' => esc_html__( 'Select taxonomy', 'posttype-search-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options' => $this->get_object_taxonomies_custom_post('faq'),
				'condition' => [
					'select_postType' => 'faq',
				],
			]
		);
		
		$this->add_control(
			'aiu_videos_taxonomies',
			[
				'label' => esc_html__( 'Select taxonomy', 'posttype-search-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options' => $this->get_object_taxonomies_custom_post('aiu_videos'),
				'condition' => [
					'select_postType' => 'aiu_videos',
				],
			]
		);
		
		$this->add_control(
			'aiu_videos_sp_taxonomies',
			[
				'label' => esc_html__( 'Select taxonomy', 'posttype-search-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options' => $this->get_object_taxonomies_custom_post('aiu_videos_sp'),
				'condition' => [
					'select_postType' => 'aiu_videos_sp',
				],
			]
		);
		
		$this->add_control(
			'programas_taxonomies',
			[
				'label' => esc_html__( 'Select taxonomy', 'posttype-search-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options' => $this->get_object_taxonomies_custom_post('programas'),
				'condition' => [
					'select_postType' => 'programas',
				],
			]
		);
		
		$this->add_control(
			'campus_mundi_taxonomies',
			[
				'label' => esc_html__( 'Select taxonomy', 'posttype-search-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options' => $this->get_object_taxonomies_custom_post('campus_mundi'),
				'condition' => [
					'select_postType' => 'campus_mundi',
				],
			]
		);
		
		$this->add_control(
			'campus_mundi_sp_taxonomies',
			[
				'label' => esc_html__( 'Select taxonomy', 'posttype-search-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options' => $this->get_object_taxonomies_custom_post('campus_mundi_sp'),
				'condition' => [
					'select_postType' => 'campus_mundi_sp',
				],
			]
		);
		
		$this->add_control(
			'ex_team_taxonomies',
			[
				'label' => esc_html__( 'Select taxonomy', 'posttype-search-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options' => $this->get_object_taxonomies_custom_post('ex_team'),
				'condition' => [
					'select_postType' => 'ex_team',
				],
			]
		);

		$this->add_control(
			'exclude__taxonomies',
			[
				'label' => esc_html__( 'Exclude Terms', 'posttype-search-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options' => $this->get_all_terms(),
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'ajax_search_styling',
			[
				'label' => esc_html__('Dropdown Styling', 'posttype-search-elementor'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'placeholder1',
			[
				'label'     => esc_html__('Dropdown One Placeholder', 'posttype-search-elementor'),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'default'   => esc_html__('Degree', 'posttype-search-elementor'),
			]
		);
		$this->add_control(
			'placeholder2',
			[
				'label'     => esc_html__('Dropdown Two Placeholder', 'posttype-search-elementor'),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'default'   => esc_html__('Program', 'posttype-search-elementor'),
			]
		);
		$this->add_control(
			'placeholder3',
			[
				'label'     => esc_html__('Search Placeholder', 'posttype-search-elementor'),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'default'   => esc_html__('Search', 'posttype-search-elementor'),
			]
		);

		$this->add_control(
			'input_placeholder_colorbg',
			[
				'label'     => esc_html__('Select Placeholder Background Color', 'posttype-search-elementor'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label_block' => true,
				'selectors' => [
					'{{WRAPPER}} #dropdownFilter select' => 'background-color: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'link_placeholder_colorbg',
			[
				'label'     => esc_html__('Search Button Color', 'posttype-search-elementor'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label_block' => true,
				'selectors' => [
					'{{WRAPPER}} #dropdownFilter a' => 'background-color: {{VALUE}} !important'
				],
			]
		);

		// $this->add_responsive_control(
		// 	'search_width',
		// 	[
		// 		'label' => esc_html__('Search Width', 'posttype-search-elementor'),
		// 		'type'  => \Elementor\Controls_Manager::SLIDER,
		// 		'range' => [
		// 			'px' => [
		// 				'min' => 150,
		// 				'max' => 1600,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} #postTypeSearch #keyword' => 'width: {{SIZE}}{{UNIT}};',
		// 		]
		// 	]
		// );

		$this->add_responsive_control(
			'search_align',
			[
				'label'   => esc_html__('Alignment', 'posttype-search-elementor'),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'posttype-search-elementor'),
						'icon'  => 'fas fa-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'posttype-search-elementor'),
						'icon'  => 'fas fa-align-center',
					],
					'right' => [
						'title' => esc_html__('Center', 'posttype-search-elementor'),
						'icon'  => 'fas fa-align-right',
					]
				],
				// 'prefix_class' => 'elementor-align%s-',
				'selectors' => [
					'{{WRAPPER}} #dropdownFilter' => 'justify-content: {{VALUE}};',
				],
			]
		);


		$this->end_controls_section();


	}

	/**
	 * Render company widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$taxonomies = $settings[$settings['select_postType']."_taxonomies"];
		$taxonomies2 = $settings[$settings['select_postType']."_taxonomies2"];
		$taxonomies3 = $settings[$settings['select_postType']."_taxonomies3"];

		$terms = [];
		if($taxonomies !== NULL){
			$args = array(
				'parent' => 0,
				'hide_empty' => true,
				'exclude' => $settings["exclude__taxonomies"]
			
			);
			$terms = get_terms( $taxonomies, $args );
		}



		// echo "<pre>";
		// var_dump($taxonomies2);

		
        ?>
		<style>
			.disabled{
				pointer-events: none;
				opacity: 0.5;
			}
			#dropdownFilter{
				display: flex;
				text-align: center;
				justify-content: center;
				flex-wrap: wrap;
			}
			#dropdownFilter a{
				display: block;
				margin-top: 0 !important;
				padding: 10px 20px 10px 20px; 
				border-radius: 0px;
				background-color: #294290;
				color: #ffffff;
				margin-top: 20px;
				font-size: 13px;
				font-weight: 400;
			}
			#dropdownFilter select{
				display: block;
				margin-top: 0 !important;
				width: 280px;
			}
			#dropdownFilter .option1, #dropdownFilter .option2{
				margin: 0 15px 15px 0;
			}
		</style>
        <div id="dropdownFilter">
            <div class="option1"  >
				<select name="degrees" id="Degrees"  onchange="optionsValues(event)" >
					<option value="" selected="true" disabled="disabled" ><?php echo $settings['placeholder1']; ?></option>
					<?php
					foreach($terms as $term1){
					    if($term1->term_id == "135" || $term1->term_id == "208"){
						?>
						<option value="<?php echo $term1->term_id; ?>"><?php echo $term1->name; ?></option>
						<?php
					    }
					}
					foreach($terms as $term){
					    if($term->term_id != "135" AND $term->term_id != "208"){
						?>
						<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
						<?php
					    }
					}
					?>
				</select>
			</div>
            <div class="option2" >
				<select name="programs" id="programs" class="disabled" onchange="options2Values(event)"  >
					<option value="" selected="true" disabled="disabled" ><?php echo $settings['placeholder2']; ?></option>
					<?php
					foreach($terms2 as $term){
						?>
						<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
						<?php
					}
					?>
				</select>
			</div>
			<div class="search">
				<a class="disabled" href="#" class="serach_button"><?php echo $settings['placeholder3']; ?></a>
			</div>
        </div>
		<script>
			function optionsValues(event){
				document.querySelector("#dropdownFilter .option2 select").classList.add("disabled");
				document.querySelector("#dropdownFilter a").classList.add("disabled");
				jQuery.ajax({
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					type: 'post',
					data: { action: 'data_fetch_dropdown', term_id1: event.target.value, postType:'<?php echo $settings['select_postType']; ?>', placeholder2:'<?php echo $settings['placeholder2']; ?>'  },
					success: function(data) {
						document.querySelector("#dropdownFilter .option2 select").innerHTML = data;
						document.querySelector("#dropdownFilter .option2 select").classList.remove("disabled");
						
					}
				});
			}
			function options2Values(event){
				document.querySelector("#dropdownFilter a").href = event.target.value;
				document.querySelector("#dropdownFilter a").classList.remove("disabled");
			}
		</script>
        <?php
	}


}