<?php
/*
Plugin Name: Barometer Feedback 
Version: 1.0
Description: Add a Feedback tab to your website to gather intel directly from your visitors via email. Uses the - wwww.getbarometer.com services, you will need an account and code.
Author: Tarei King @tareiking
Author URI: http://tarei.me
Plugin URI: http://tarei.me
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
		$this->barometer_string = "";

		add_action( 'admin_menu', array( $this, 'add_admin_menu_item' ) );

		// Loads scripts on frontpage
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

	// Display the option page if user has 'update_plugins' capabilities
	public function render_settings_page() {
		if( (current_user_can( 'update_plugins' ) ) ) {
			include( plugin_dir_path( __FILE__ ) . 'admin-page/index.php' );
		}
	}

	// Updates the barometer string used for getbarometer.com
	public function update_barometer_string( $string ){
		if ( get_option( 'tk_barometer_string' ) !== false ){
			update_option( 'tk_barometer_string', $string );
		} else {
			add_option( 'tk_barometer_string', $this->barometer_string, '', 'yes' );
		}
	}

	// Lets load some scripts eh -- but only on the front-end
	public function load_barometer_scripts() {
		wp_enqueue_style( 'barometer-css', 'https://getbarometer.s3.amazonaws.com/assets/barometer/css/barometer.css' );
		wp_enqueue_script( 'barometer', 'https://getbarometer.s3.amazonaws.com/assets/barometer/javascripts/barometer.js', array(), '1.0', true );
		add_action( 'wp_footer', array( $this, 'generate_barometer_script' ), 20 );
	}

	// Getter for barometer string: Used in admin form
	public function get_barometer_string() {
		return get_option( 'tk_barometer_string' );
	}

	// Generate a script tag that we can adjust in PHP code
	// Gets the entered string from the options table if set
	public function generate_barometer_script() {
		?>

		<script>
			<?php echo 'BAROMETER.load(\'' . $this->get_barometer_string() . '\');'?>
		</script>

	<?php
	}
}

TK_Barometer::get_instance();