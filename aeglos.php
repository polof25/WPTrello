<?php
/*Plugin Name: Aeglos
Plugin URI: https://github.com/polof25/aeglos/
Description: Plugin for Trello
Version: 0.1
Author: Paul-Arthur FRADIN
Author URI: http://paularthurfradin.fr/

Aeglos is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Aeglos is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Aeglos. If not, see https://www.gnu.org/licenses/licenses.html.
*/


if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_aeglos() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-aeglos-activator.php';
	Aeglos_Activator::activate();
}
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_aeglos() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-aeglos-deactivator.php';
	Aeglos_Deactivator::deactivate();
}
register_activation_hook( __FILE__, 'activate_aeglos' );
register_deactivation_hook( __FILE__, 'deactivate_aeglos' );
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-aeglos.php';
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_aeglos() {
	$plugin = new Aeglos();
	$plugin->run();
}
run_aeglos();
