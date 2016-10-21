<?php
/*Plugin Name: Test
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

if ( ! session_id() ) {
  session_start();
}

function add_admin_scripts() {
  wp_enqueue_script( 'trello-client-js', 'https://api.trello.com/1/client.js?key=[APP-KEY]', array(), null, true);
  wp_enqueue_script( 'aeglos-admin-js', plugins_url( 'assets/js/aeglos-admin.js', __FILE__), array(), null, true);

  wp_enqueue_style( 'aeglos-admin-css', plugins_url( 'assets/css/aeglos-admin.css', __FILE__));
}

function add_settings_option() {
  add_options_page( 'Aeglos', 'Aeglos', 'manage_options', 'my-plugin-aeglos', 'settings_page');

}

function settings_page() {
  if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( 'You do not have sufficient permissions to access this page.' );
  }

  ?>
  <div id="aeglos" class="wrap">
    <div id="icon-options-general" class="icon32"></div>
    <h2><?php echo 'Aeglos Settings' ?></h2>
    <h1>API Trello</h1>
    <form class="" action="" method="post">
      <a href="https://trello.com/app-key">Obtenir mon APP-KEY</a>
      <input id="connect" class="display" type="button" name="name" value="Se Connecter" />
      <input id="disconnect" class="display" type="button" name="name" value="Se Déconnecter" style="display:none;" />
    </form>


    <div id="getboards" class="display" style="display:none;">

    </div>

    <div id="getlists" class="display" style="display:none;">

    </div>

    <div id="my-cards" class="display" style="display:none;">

    </div>

    <div class="display" style="display:none;">
      <input id="addcard" type="button" name="name" value="Ajouter une card">
    </div>
  </div>
  <?php

}

function no_more_jquery(){
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', "http://code.jquery.com/jquery-1.7.1.min.js", array(), null, true);
}

add_action('admin_enqueue_scripts', 'no_more_jquery');
add_action( 'admin_enqueue_scripts', 'add_admin_scripts');
add_action( 'admin_menu', 'add_settings_option');
