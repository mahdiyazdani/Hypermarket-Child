<?php
/**
 * Hypermarket Child functions and definitions
 *
 * For more information on hooks, actions, and filters,
 *
 * @see 		https://codex.wordpress.org/Theme_Development
 * @see 		https://codex.wordpress.org/Child_Themes
 * @see 		https://codex.wordpress.org/Plugin_API
 * @author  	Mahdi Yazdani
 * @package 	Hypermarket Child
 * @since 		1.0.3
 */
if (!defined('ABSPATH')):
	exit;
endif;
if (!class_exists('Hypermarket_Child')):
	/**
	 * The setup Hypermarket Child class
	 */
	class Hypermarket_Child

	{
		private $parent_public_assets_url;
		private $child_public_assets_url;
		/**
		 * Setup class.
		 *
		 * @since 1.0.1
		 */
		public function __construct()

		{
			$this->parent_public_assets_url = esc_url(get_template_directory_uri() . '/assets/');
			$this->child_public_assets_url = esc_url(get_stylesheet_directory_uri() . '/assets/');
			add_action('after_setup_theme', array(
				$this,
				'setup'
			) , 10);
			add_action('wp_enqueue_scripts', array(
				$this,
				'enqueue'
			) , 10);
			add_action('wp_enqueue_scripts', array(
				$this,
				'enqueue_child'
			) , 99);
		}
		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 *
		 * @since 1.0.3
		 */
		public function setup()

		{
			/**
			 *  This theme styles the visual editor to resemble the theme style,
			 *  specifically font, colors, icons, and column width.
			 */
			add_editor_style( array( $this->child_public_assets_url . '/css/editor-style.css', add_query_arg(apply_filters('hypermarket_child_default_font_family', array(
				'family' => urlencode('Work Sans:400,300,500,600'),
				'subset' => urlencode('latin,latin-ext')
			)) , 'https://fonts.googleapis.com/css')));
		}
		/**
		 * Enqueue scripts and styles.
		 *
		 * @since 1.0.2
		 */
		public function enqueue()

		{
			wp_enqueue_style('hypermarket-styles', $this->parent_public_assets_url . '/css/hypermarket.css', HypermarketThemeVersion);
			if (is_rtl()):
				wp_enqueue_style('hypermarket-rtl-styles', get_template_directory_uri() . '/rtl.css', HypermarketThemeVersion);
			endif;
		}
		/**
		 * Enqueue scripts and styles.
		 *
		 * @since 1.0.2
		 */
		public function enqueue_child()

		{
			wp_enqueue_style('hypermarket-child-styles', $this->child_public_assets_url . '/css/hypermarket-child.css', HypermarketThemeVersion);
			wp_enqueue_script('hypermarket-child-scripts', $this->child_public_assets_url . '/js/hypermarket-child.js', array(
				'jquery',
				'hypermarket-scripts'
			) , HypermarketThemeVersion, true);
		}
	}
endif;
return new Hypermarket_Child();
