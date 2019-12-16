<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://semantify.it
 * @since      1.0.0
 *
 * @package    Semantifyit_Dzt_Uri
 * @subpackage Semantifyit_Dzt_Uri/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Semantifyit_Dzt_Uri
 * @subpackage Semantifyit_Dzt_Uri/admin
 * @author     Semantify <dev@semantify.it>
 */
class Semantifyit_Dzt_Uri_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Semantifyit_Dzt_Uri_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Semantifyit_Dzt_Uri_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

    $curScreenId = get_current_screen()->id;
		$post_types = get_post_types(array(
			'public'   => true,
		));

		if (array_key_exists ($curScreenId, $post_types)) {
			wp_register_style( 'prefix_css_ia', 'https://cdn.jsdelivr.net/gh/semantifyit/instant-annotator/css/instantAnnotations.css' );
			wp_enqueue_style( 'prefix_css_ia' );
			
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/semantifyit-dzt-uri-admin.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Semantifyit_Dzt_Uri_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Semantifyit_Dzt_Uri_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
        
        $curScreenId = get_current_screen()->id;
        $post_types = get_post_types(array(
			'public'   => true,
		));

		if (array_key_exists ($curScreenId, $post_types)) {
			wp_register_script( 'prefix_bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js' );
			wp_enqueue_script( 'prefix_bootstrap', array( 'jquery' ) );

			wp_register_script( 'prefix_instantannotation', 'https://cdn.jsdelivr.net/gh/semantifyit/instant-annotator/dist/instantAnnotation.bundle.js', array( 'jquery' ), time() );
			//wp_register_script( 'prefix_instantannotation', 'http://localhost:8080/main.js', array( 'jquery' ), time() );

			wp_localize_script( 'prefix_instantannotation', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
      wp_enqueue_script( 'prefix_instantannotation' );
            
    	wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/semantifyit-dzt-uri-admin.js', array( 'jquery' ), $this->version, false );
		}

    }
    
    public function add_plugin_admin_menu() {

		/*
		 * Add a settings page for this plugin to the Settings menu.
		 *
		 * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
		 *
		 *        Administration Menus: http://codex.wordpress.org/Administration_Menus
		 *
		 */

		$post_types = get_post_types( array( 'public' => true ) );

		foreach ( $post_types as $post_type ) {
			add_meta_box(
				$this->plugin_name, // $id
				__( 'Semantify-DZT-URI' ), // $title
				array( $this, 'meta_boxes_display' ), // $callback
				$post_type,
				'normal',
				'high'
			);
		}
    }
    
    function meta_boxes_display( $post ) {
			include_once 'partials/meta-boxes-display.php';
		}

}
