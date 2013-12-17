<?php
/*
Plugin Name: Barometer Feedback 
Version: 0.1-alpha
Description: A quick plugin to use the awesome Barometer Feedback JS Service - wwww.getbarometer.com
Author: Tarei King @tareiking
Author URI: http://tarei.me
Plugin URI: http://tarei.me/barometer
Text Domain: barometer-feedback
Domain Path: /languages
*/

/**
 *  Waaat namespace?!
 */


class TK_Barometer {

	private static $instance;

	private $barometer_string;

	static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new TK_Barometer;
		}

		return self::$instance;
	}

	function __construct() {
		add_action( 'admin_menu', array( $this, 'add_admin_menu_item' ) );

		if ( ! is_admin() ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'load_barometer_scripts' ) );
		}
	}

	// Add admin pages to settings menu item
	public function add_admin_menu_item() {
		add_options_page(
			'Page Title', 'Barometer Feedback', 'manage_options', 'barometer-feedback.php', array(
				$this,
				'render_settings_page'
			)
		);
	}

	public function render_settings_page() {
		include( plugin_dir_path( __FILE__ ) . 'admin-page/index.php' );
	}

	// Lets load some scripts eh -- but only on the front-end
	public function load_barometer_scripts() {
		wp_enqueue_style( 'barometer-css', 'http://getbarometer.s3.amazonaws.com/assets/barometer/css/barometer.css' );
		wp_enqueue_script( 'barometer', 'http://getbarometer.s3.amazonaws.com/assets/barometer/javascripts/barometer.js', array(), '1.0', true );
		add_action( 'wp_footer', array( $this, 'generate_barometer_script' ), 20 );
	}

	private function get_barometer_string() {
	}

	// Generate a script tag that we can adjust in PHP code
	// Gets the entered string from the options table if set
	public function generate_barometer_script() {
		?>

		<script>
			<?php echo 'BAROMETER.load(\'' . $this->barometer_string . '\');'?>
		</script>

	<?php
	}
}

TK_Barometer::get_instance();