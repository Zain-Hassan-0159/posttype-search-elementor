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
class headerCustom_widget_elementore  extends \Elementor\Widget_Base {
	
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
		return 'Header-Custom';
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
		return esc_html__( 'Header-Custom', 'posttype-search-elementor ' );
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
		return [ 'Header-Custom', 'widgets', 'custom', 'Header-Custom widgets' ];
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
				'label' => esc_html__( 'Header-Custom', 'posttype-search-elementor' ),
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

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'link_title', [
				'label' => esc_html__( 'Title', 'posttype-search-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'posttype-search-elementor' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'item_link',
			[
				'label' => esc_html__( 'Link', 'posttype-search-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'posttype-search-elementor' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);


		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Custom Links', 'posttype-search-elementor' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'prevent_empty' => false,
				'title_field' => '{{{ link_title }}}',
			]
		);
		
		
		$this->end_controls_section();

		$this->start_controls_section(
			'ajax_search_styling',
			[
				'label' => esc_html__('Menu Styling', 'posttype-search-elementor'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'font_family',
			[
				'label' => esc_html__( 'Font Family', 'posttype-search-elementor' ),
				'type' => \Elementor\Controls_Manager::FONT,
				'selectors' => [
					'{{WRAPPER}} .submenu-wrapper li a' => 'font-family: {{VALUE}}',
				],
			]
		);
	

		$this->add_control(
			'input_placeholder_colorbg',
			[
				'label'     => esc_html__('Select Text Color', 'posttype-search-elementor'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label_block' => true,
				'selectors' => [
					'{{WRAPPER}} .submenu-wrapper li a' => 'color: {{VALUE}} !important'
				],
			]
		);

		$this->add_control(
			'link_placeholder_colorbg',
			[
				'label'     => esc_html__('Card Background Color', 'posttype-search-elementor'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label_block' => true,
				'selectors' => [
					'{{WRAPPER}} .submenu-wrapper > .submenu' => 'background-color: {{VALUE}} !important'
				],
			]
		);

		$this->add_responsive_control(
			'search_align',
			[
				'label'   => esc_html__('Alignment', 'posttype-search-elementor'),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'right' => [
						'title' => esc_html__('Left', 'posttype-search-elementor'),
						'icon'  => 'fas fa-align-left',
					],
					'left' => [
						'title' => esc_html__('Right', 'posttype-search-elementor'),
						'icon'  => 'fas fa-align-right',
					]
				],
				// 'prefix_class' => 'elementor-align%s-',
				'selectors' => [
					'{{WRAPPER}} .submenu-wrapper > .submenu' => 'margin-{{VALUE}}: auto;',
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
		// var_dump($settings['menu']);

		?>
        <style>
            .elementor-container{
                position: relative;
            }
            .submenu-wrapper ul{
                list-style: none;
                padding: 0;
                margin: 0;
            }
            .submenu-wrapper li{
                list-style: none;
                margin: 0;
            }
            .submenu-wrapper li a{
                font-style: normal;
                font-weight: bold;
                font-size: 14px;
                line-height: 16px;
                letter-spacing: .4px;
                color: #222;
                padding: 10px;
                display: block;
                position: relative;
            }
            .submenu-wrapper .submenu-wrapper {
				position: absolute;
				left: 298px;
				top: 0;
				overflow-y: auto;
				overflow-x: hidden;
				height: -webkit-fill-available;
            }

            .submenu-wrapper .submenu{
                /* display: none; */
                flex-direction: column;
                background: #fff;
                width: 300px;
                min-height: 400px;
            }

            .submenu-wrapper > .submenu{
                background: #eaedf1;
				position: relative;
            }

            .submenu-wrapper .submenu .submenu{
                display: none;
                background: #fff;
            }
             .submenu-wrapper > .submenu > li{
                position: initial;
            }

            .submenu-wrapper > .submenu  >  li > a:after{
                content: "";
                width: 12px;
                height: 24px;
                position: absolute;
                left: 0px;
                background-color: #286dc0;
                bottom: 0;
                top: -5px;
                margin: auto 0;
                display: none;
            }

            .submenu-wrapper > .submenu  >  li:hover > a:after{
                display: block;
            }

            .submenu-wrapper a:hover{
                color: #286dc0;
            }

            .submenu-wrapper > .submenu  >  li:hover > a{
                color: #286dc0;
            }
            
            .submenu-wrapper > .submenu  >  li:hover > .submenu-wrapper > .submenu{
                display: block;
            }

            .submenu-wrapper > .submenu  >  li > a{
                padding: 13px 25px;
            }

            .submenu-wrapper > .submenu  >  li.menu-item-has-children > a:before{
                content: "";
                display: block;
                width: 10px;
                height: 5px;
                position: absolute;
                right: 10px;
                top: calc(50% - 2px);
                transform: rotate(-90deg);
                background-image: url(https://wp.aiu.edu/wp-content/themes/mws/assets/img/icons/arrow-drop-down.svg);
            }

        </style>
        <div class="submenu-wrapper">
            <ul class="submenu">
				<?php
				if ( $settings['list'] ){
					foreach($settings['list'] as $list){
						if ( ! empty( $list['item_link']['url'] ) ) {
							//$this->add_link_attributes( 'item_link', '' );
							$this->add_link_attributes( 'item_link', $list['item_link'] );
						}
						?>
						<li>
							<a href="<?php echo $list['item_link']['url']; ?>"><?php echo $list['link_title']; ?></a>
						</li>
						<?php
					}
				}
				// echo "<pre>";
				// var_dump($terms);
				// exit;
				foreach($terms as $term){
					$term_name = get_term($term->term_id)->name;
					$taxonomy1 = get_term($term->term_id)->taxonomy;
					$resultArray = explode(" ", $term_name);
					$searchArray = $settings['select_postType'] === "programas" ? end($resultArray) : $resultArray[0];
				
					// var_dump($searchArray);
					// exit;
					if($searchArray === "Maestría"){
					   $searchArray  = "Maestr";
					}
				
				
					$the_query = new WP_Query( array(
						'post_type'      => $settings['select_postType'],
						'post_status'    => 'publish',
						'posts_per_page' => -1,
						's' => $searchArray, 
						'orderby'        => 'title',
						'order'          => 'ASC',
						'tax_query'      => array(
							'taxonomy' => $taxonomy1,
							'field'    => 'term_id',
							'terms'    => $term->term_id,
						)
					) );
					?>
					<li class="<?php echo $the_query->have_posts() ? "menu-item-has-children" : ""; ?>">
						<a href="#"><?php echo $term->name; ?></a>
						<?php

							if( $the_query->have_posts() ) :
								?>
								<div class="submenu-wrapper">
									<ul class="submenu">
										<?php
										while( $the_query->have_posts() ){ 
											$the_query->the_post();
											?>
											<li>
												<a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
											</li>
											<?php
										}
										?>
									</ul>
								</div>
								<?php 
							endif;
						?>
					</li>
					<?php
					wp_reset_postdata();
				}
				?>
            </ul>
        </div>
        <?php
	}


}