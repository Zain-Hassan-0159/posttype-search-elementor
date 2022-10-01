<?php

/**
 * Plugin Name:       posttype-search-elementor
 * Description:       posttype-search-elementor is created by Zain Hassan.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Zain Hassan
 * Author URI:        https://hassanzain.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       posttype-search-elementor 
*/

if(!defined('ABSPATH')){
exit;
}


function add_postTypeSearch_category( $elements_manager ) {

	$elements_manager->add_category(
		'el-postypeSearch',
		[
			'title' => esc_html__( 'Postype Search', 'posttype-search-elementor' ),
			'icon' => 'fa fa-plug',
		]
	);



}
add_action( 'elementor/elements/categories_registered', 'add_postTypeSearch_category' );

/**
 *  postTypeSearch Elementor Custom Widget
*/
function register_postTypeSearch_elementor_widgets( $widgets_manager ) {
    /** search Widget **/
	require_once( __DIR__ . '/inc/postTypeSearch.php' );
	$widgets_manager->register( new \postTypeSearch_widget_elementore );
    /** Dropdown Widget **/
	require_once( __DIR__ . '/inc/dropDownSearch.php' );
	$widgets_manager->register( new \dropDown_widget_elementore );
    /** Header Widget **/
	require_once( __DIR__ . '/inc/header-custom.php' );
	$widgets_manager->register( new \headerCustom_widget_elementore );

}
add_action( 'elementor/widgets/register', 'register_postTypeSearch_elementor_widgets' );



// function plugin_scripts_postTypeSearch() {

// 	wp_enqueue_script( 'postTypeSearch-script', plugins_url( 'inc/assets/js/script.js', __FILE__ ), [], '1.0.0', true );

// }
// add_action( 'wp_footer', 'plugin_scripts_postTypeSearch' );

// the ajax function
add_action('wp_ajax_data_fetch' , 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch','data_fetch');
function data_fetch(){

    $arg = [];
    if( !empty(  $_POST['terms'] ) ){
        $arg = 	array(
            'taxonomy' => esc_attr( $_POST['taxonomy'] ),
            'field' => 'slug',
            'terms' => $_POST['terms']
        );
    }else{
        $arg = 	array(
            'taxonomy' => esc_attr( $_POST['taxonomy'] ),
            'operator' => 'EXISTS'
        );
    };

    $the_query = new WP_Query( 
      array( 
        'posts_per_page' => -1, 
        's' => esc_attr( $_POST['keyword'] ), 
        'post_type' => esc_attr( $_POST['postType'] ),
        'tax_query' => array(
            $arg,
        ),
      ) 
    );




    if( $the_query->have_posts() ) :
        while( $the_query->have_posts() ): $the_query->the_post();

		$myquery = esc_attr( $_POST['keyword'] );
		$a = $myquery;
		$search = get_the_title();
		if( stripos("/{$search}/", $a) !== false) {?>
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
        }
    endwhile;
        wp_reset_postdata();  
        else:
        ?>
        <h4><a href="#">No Results Found Against (<?php echo esc_attr( $_POST['keyword'] ) ?>)</a></h4>
        <?php
    endif;
    die();
}

// the ajax function
add_action('wp_ajax_data_fetch_dropdown' , 'data_fetch_dropdown');
add_action('wp_ajax_nopriv_data_fetch_dropdown','data_fetch_dropdown');
function data_fetch_dropdown(){
    $term_name = get_term(esc_attr($_POST['term_id1']))->name;
    $taxonomy1 = get_term(esc_attr($_POST['term_id1']))->taxonomy;
    $resultArray = explode(" ", $term_name);
    $searchArray = esc_attr($_POST['postType']) === "programas" ? end($resultArray) : $resultArray[0];

    // var_dump($searchArray);
    // exit;
    if($searchArray === "Maestría"){
       $searchArray  = "Maestr";
    }


    $the_query = new WP_Query( array(
        'post_type'      => esc_attr($_POST['postType']),
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        's' => $searchArray, 
        'orderby'        => 'title',
        'order'          => 'ASC',
        'tax_query'      => array(
            'taxonomy' => $taxonomy1,
            'field'    => 'term_id',
            'terms'    => esc_attr($_POST['term_id1']),
        )
    ) );



    if( $the_query->have_posts() ) :
        ?>
        <option value="" selected="true" disabled="disabled" ><?php echo esc_attr($_POST['placeholder2']); ?></option>
        <?php
        while( $the_query->have_posts() ): $the_query->the_post();
        ?>
        <option value="<?php echo get_the_permalink(); ?>" ><?php echo get_the_title(); ?></option>
        <?php
        endwhile;
        wp_reset_postdata();  
        die();
        else:
        ?>
        <h4><a href="#">No Results Found Against (<?php echo esc_attr( $_POST['keyword'] ) ?>)</a></h4>
        <?php
    endif;
    die();
}