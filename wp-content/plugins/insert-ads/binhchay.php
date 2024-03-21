<?php if (!defined('ABSPATH')) die;
/*
Plugin Name: Insert Ads to game play
Description: Insert ads to iframe of game play
Author: binhchay
Version: 1.0
License: GPLv2 or later
*/

define('INSERT_ADS_ADMIN_VERSION', '1.0.0');
define('INSERT_ADS_ADMIN_DIR', 'insert-ads');

require plugin_dir_path(__FILE__) . 'admin-form.php';
function run_ct_wp_admin_form()
{
    $plugin = new Admin_Form();
    $plugin->init();
}
run_ct_wp_admin_form();
