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
class postTypeSearch_widget_elementore  extends \Elementor\Widget_Base {
	

	public function get_style_depends() {

		wp_register_style( 'postTypeSearch-style', plugins_url( 'assets/css/style.css', __FILE__ ) );

		return [
			'postTypeSearch-style',
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
		return 'postTypeSearch';
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
		return esc_html__( 'postTypeSearch', 'posttype-search-elementor ' );
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
		return [ 'postTypeSearch', 'widgets', 'custom', 'postTypeSearch widgets' ];
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
			$terms[$term->slug] =  $term->name;
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
				'label' => esc_html__( 'postTypeSearch', 'posttype-search-elementor' ),
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
				'type' => \Elementor\Controls_Manager::SELECT,
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
				'type' => \Elementor\Controls_Manager::SELECT,
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
				'type' => \Elementor\Controls_Manager::SELECT,
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
				'type' => \Elementor\Controls_Manager::SELECT,
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
				'type' => \Elementor\Controls_Manager::SELECT,
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
				'type' => \Elementor\Controls_Manager::SELECT,
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
				'type' => \Elementor\Controls_Manager::SELECT,
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
				'type' => \Elementor\Controls_Manager::SELECT,
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
				'type' => \Elementor\Controls_Manager::SELECT,
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
				'type' => \Elementor\Controls_Manager::SELECT,
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
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $this->get_object_taxonomies_custom_post('ex_team'),
				'condition' => [
					'select_postType' => 'ex_team',
				],
			]
		);

		$this->add_control(
			'ajax_item_limit',
			[
				'label'     => esc_html__('Item Limit', 'posttype-search-elementor'),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1,
				'default'       => 4,
				'step'      => 1,
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'ajax_search_query',
			[
				'label' => esc_html__('Terms Query', 'posttype-search-elementor'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'posts_include_terms',
			[
				'label'       => __('Search Terms', 'posttype-search-elementor'),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options'     => $this->get_all_terms(),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ajax_search_styling',
			[
				'label' => esc_html__('Search Styling', 'posttype-search-elementor'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'placeholder',
			[
				'label'     => esc_html__('Placeholder', 'posttype-search-elementor'),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'separator' => 'before',
				'default'   => esc_html__('Search', 'posttype-search-elementor') . '...',
			]
		);

		$this->add_control(
			'input_placeholder_colorinput',
			[
				'label'     => esc_html__('Placeholder Color', 'posttype-search-elementor'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #postTypeSearch #keyword::placeholder' => 'color: {{VALUE}}',
					'#modal-search-{{ID}} #postTypeSearch #keyword::placeholder' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'input_placeholder_colorbg',
			[
				'label'     => esc_html__('Input Color', 'posttype-search-elementor'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #postTypeSearch #keyword' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} #postTypeSearch #keyword' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'search_width',
			[
				'label' => esc_html__('Search Width', 'posttype-search-elementor'),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 150,
						'max' => 1600,
					],
				],
				'selectors' => [
					'{{WRAPPER}} #postTypeSearch #keyword' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);

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
					]
				],
				// 'prefix_class' => 'elementor-align%s-',
				'selectors' => [
					'{{WRAPPER}} #postTypeSearch #keyword' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'toggle_icon_radius',
			[
				'label'      => esc_html__('Radius', 'posttype-search-elementor'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} #postTypeSearch #keyword' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'search_container_shadow',
				'selector' => '{{WRAPPER}} #postTypeSearch #keyword',
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

		// echo "<pre>";
		// var_dump($settings['posts_include_terms']);

		$arg = [];
		$taxonomy = $settings[$settings['select_postType']."_taxonomies"];
		if(!empty($settings['posts_include_terms'])){
			$arg = 	array(
				'taxonomy' => $taxonomy,
				'field' => 'slug',
				'terms' => $settings['posts_include_terms']
			);
		}else{
			$arg = 	array(
				'taxonomy' => $taxonomy,
				'operator' => 'EXISTS'
			);
		}

		$the_query = new WP_Query( 
			array( 
			  'posts_per_page' => $settings['ajax_item_limit'], 
			  'post_type' => $settings['select_postType'],
			  'tax_query' => array(
				$arg,
				),
			) 
		);

		
        ?>
        <div id="postTypeSearch">
			<input placeholder="<?php echo $settings['placeholder'] ?>" type="text" name="keyword" id="keyword" onkeyup="fetch()"></input>
			<div id="datafetch">
<?php
    if( $the_query->have_posts() ) :
        while( $the_query->have_posts() ): $the_query->the_post();

		$myquery = $settings['select_postType'];
		$search = get_the_title();?>
            <a class="s3-card" href="<?php echo esc_url( post_permalink() ); ?>">
                <div >
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                    <img src="<?php echo $image[0]; ?>" class="d-block mx-auto">
                    <h2><?php echo get_the_title();  ?></h2>
                    <div class="divider"></div>
                    <p>
                    <?php echo get_the_excerpt();  ?>
                    </p>
                    <img src="https://www.aiu.edu/university/np/doctorates/images/home/arrow.png" class="d-block mx-auto">
                </div>
            </a>
        <?php
        
    endwhile;
        wp_reset_postdata();  
    endif;
?>
			</div>
        </div>
		<script type="text/javascript">
			function fetch(){
		//	    console.log(jQuery('#keyword').val().length);
				jQuery.ajax({
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					type: 'post',
					data: { action: 'data_fetch', keyword: jQuery('#keyword').val(), postType: '<?php echo esc_attr( $settings['select_postType'] ); ?>', taxonomy: '<?php echo $taxonomy; ?>', terms: JSON.parse('<?php echo json_encode($settings['posts_include_terms']) ?>'), item_nos:'<?php echo $settings['ajax_item_limit']; ?>' },
					success: function(data) {
						if (jQuery('#keyword').val().length > 2) {
							jQuery('#datafetch').html( data );
						}else{
							jQuery('#datafetch').html("");
						}
					}
				});

			}
		</script>
        <?php
	}


}