<?php
/**
 * Plugin Name:    Form Quiz ActiveCampaing
 * Plugin URI:     https://criacaocriativa.com
 * Description:    Formulário com multiplas escolhas para captura de Leeds - ActiveCampaing.
 * Version:        1.0.0
 * Text Domain:    form-quiz-active-campaing
 * Domain Path:    /languages/
 * Author:         carlosramosweb
 * Author URI:     http://plugins.criacaocriativa.com
 * Donate link:    https://donate.criacaocriativa.com
 * Requires at least: 3.5.0
 * Tested up to: 6.0.1
 * @package        form-quiz-active-campaing
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

define( 'WP_FORM_QUIZ_ACTIVE_CAMPAING_VERSION', '1.0' );

if ( ! defined( 'WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_PATH' ) ) {
	define( 'WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_PATH', plugin_dir_path( __FILE__ )  );
}
if ( ! defined( 'WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL' ) ) {
	define( 'WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_URL', plugin_dir_url( __FILE__ )  );
}

if ( ! defined( 'WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_BASENAME' ) ) {
	define( 'WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_BASENAME', plugin_basename( __FILE__ )  );
}

if ( ! defined( 'WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_FILE' ) ) {
	define( 'WP_FORM_QUIZ_ACTIVE_CAMPAING_PLUGIN_FILE', __FILE__  );
}

if ( ! class_exists('WP_FORM_QUIZ_ACTIVE_CAMPAING') ) {
	include_once( 'includes/setup.php' );
}



