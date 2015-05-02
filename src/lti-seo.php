<?php namespace Lti\Seo;

use Lti\Seo\Generators\JSON_LD;
use Lti\Seo\Helpers\Wordpress_Helper;
use Lti\Seo\Plugin\Plugin_Settings;

class LTI_SEO {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @var      \Lti\SEO\Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @var      string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $LTI_SEO;

	/**
	 * The current version of the plugin.
	 *
	 * @var      string $version The current version of the plugin.
	 */
	protected $version;

	public static $instance;

	/**
	 * @var \Lti\Seo\Plugin\Plugin_Settings
	 */
	private $settings;

	private $file_path;
	public $plugin_path;
	/**
	 * @var \Lti\Seo\Admin
	 */
	public $admin;
	public $frontend;
	private $helper;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 */
	public function __construct() {
		$this->file_path = plugin_dir_path( __FILE__ );
		require_once $this->file_path . 'plugin/form_fields.php';
		require_once $this->file_path . 'plugin/plugin.php';
		$this->name        = 'lti-wp-seo';
		$this->plugin_path = LTI_SEO_PLUGIN_DIR;
		$this->settings    = get_option( "lti_seo_options" );

		if ( $this->settings === false || empty($this->settings) ) {
			$this->settings = new Plugin_Settings( );
		}

		$this->load_dependencies();
		$this->set_locale();
	}

	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function get_settings() {
		return $this->settings;
	}

	public function get_helper() {
		return $this->helper;
	}


	private function load_dependencies() {
		require_once $this->plugin_path . 'vendor/autoload.php';
		require_once $this->file_path . 'helper.php';
		require_once $this->file_path . 'loader.php';
		require_once $this->file_path . 'i18n.php';
		require_once $this->file_path . 'admin/admin.php';
		require_once $this->file_path . 'frontend/frontend.php';
		require_once $this->file_path . 'plugin/postbox.php';
		require_once $this->file_path . 'frontend/helpers/wordpress_helper.php';
		require_once $this->file_path . 'frontend/generators/json_ld.php';
		require_once $this->file_path . 'frontend/generators/generic_meta_tag.php';
		require_once $this->file_path . 'frontend/generators/open_graph.php';
		require_once $this->file_path . 'frontend/generators/twitter_cards.php';
		require_once $this->file_path . 'frontend/generators/keywords.php';
		require_once $this->file_path . 'frontend/generators/description.php';
		require_once $this->file_path . 'frontend/generators/robots.php';
		require_once $this->file_path . 'frontend/generators/link_rel.php';
		require_once $this->file_path . 'activator.php';
		$this->loader = new Loader();
		$this->helper = new Wordpress_Helper( $this->settings );
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the lti-seo_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new i18n($this->name);
		$plugin_i18n->set_domain( $this->get_plugin_name() );
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @access   private
	 */
	private function define_admin_hooks() {
		$this->admin = new Admin( $this->name, $this->version, $this->settings, $this->plugin_path,
			$this->helper );

		$this->loader->add_action( 'admin_init', $this->admin, 'register_setting' );
		$this->loader->add_action( 'admin_enqueue_scripts', $this->admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $this->admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $this->admin, 'admin_menu' );
		$this->loader->add_filter( 'plugin_action_links', $this->admin, 'plugin_actions', 10, 2 );
		$this->loader->add_action( 'add_meta_boxes', $this->admin, 'add_meta_boxes' );
		$this->loader->add_action( 'save_post', $this->admin, 'save_post', 10, 3 );

		if ( apply_filters( 'lti_seo_allow_profile_social_settings', true ) ) {
			$this->loader->add_action( 'show_user_profile', $this->admin, 'show_user_profile' );
			$this->loader->add_action( 'edit_user_profile', $this->admin, 'show_user_profile' );
			$this->loader->add_action( 'personal_options_update', $this->admin, 'personal_options_update',10,1 );
			$this->loader->add_action( 'edit_user_profile_update', $this->admin, 'personal_options_update',10,1 );
		}
	}

	/**
	 * @return \Lti\Seo\Admin
	 */
	public function get_admin() {
		return $this->admin;
	}

	public function get_frontend(){
		return $this->frontend;
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @access   private
	 */
	private function define_public_hooks() {

		$this->frontend = new Frontend( $this->name, $this->version, $this->settings,
			$this->helper );

		$this->loader->add_action( 'wp_head', $this->frontend, 'head' );

//		if ( apply_filters( 'lti_seo_allow_profile_social_settings', true ) ) {
//			$this->loader->add_filter( 'user_contactmethods', $this->frontend, 'user_contactmethods' );
//		}
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 */
	public function run() {
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @return    \Lti\Seo\Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	public static function activate() {
		require_once LTI_SEO_MAIN_CLASS_DIR . 'activator.php';
		Activator::activate();
	}

	public static function deactivate() {
		require_once LTI_SEO_MAIN_CLASS_DIR . 'deactivator.php';
		Deactivator::deactivate();
	}


}