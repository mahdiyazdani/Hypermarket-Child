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
 * @since 		1.0.0
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
		 * @since 1.0.0
		 */
		public function __construct()

		{
			$this->parent_public_assets_url = esc_url(get_template_directory_uri() . '/assets/');
			$this->child_public_assets_url = esc_url(get_stylesheet_directory_uri() . '/assets/');
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
		 * Enqueue scripts and styles.
		 *
		 * @since 1.0.0
		 */
		public function enqueue()

		{
			wp_enqueue_style('hypermarket-styles', $this->parent_public_assets_url . '/css/hypermarket-core.min.css', HypermarketThemeVersion);
		}
		/**
		 * Enqueue scripts and styles.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_child()

		{
			wp_enqueue_style('hypermarket-child-theme-styles', $this->child_public_assets_url . '/css/hypermarket-child.css', HypermarketThemeVersion);
			wp_enqueue_script('hypermarket-child-theme-scripts', $this->child_public_assets_url . 'js/hypermarket-child.js', array(
				'jquery',
				'hypermarket-scripts',
				'hypermarket-theme-scripts'
			) , HypermarketThemeVersion, true);
		}
	}
endif;
return new Hypermarket_Child();