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

function create_insert_ads_game_play_option()
{
  if ('not-exists' === get_option('insert_ads_game_play', 'not-exists')) {
    add_option('insert_ads_game_play', '');
  }
}

register_activation_hook(__FILE__, 'create_insert_ads_game_play_option');

function insert_ads_game_play()
{
  if (is_single()) {
    add_action('wp_footer', 'add_script_for_insert_ads', 100);
    add_action('wp_head', 'add_style_for_insert_ads', 100);
  }
}
add_action('wp', 'insert_ads_game_play');

function add_style_for_insert_ads()
{
  echo '<style>
  .right {
    margin: 20px auto;
    width: 300px;
  }

  .skip-button {
    padding: 5px 10px;
    border: none;
  }
  </style>';
}

function add_script_for_insert_ads()
{
  echo '
    <script>
    var iframe = jQuery("#playframe");
    iframe.css("display", "none");

    const popupOverlay = document.querySelector(".popup-overlay");
    const skipButton = document.querySelector(".popup-container .skip-button");

    let remainingTime = 5;
    let allowedToSkip = false;
    let popupTimer;

    const showAd = () => {
      popupOverlay.classList.add("active");
      popupTimer = setInterval(() => {
      skipButton.innerHTML = `Skip in ${remainingTime}s`;
      remainingTime--;

      if (remainingTime < 0) {
        allowedToSkip = true;
        skipButton.innerHTML = "Skip";
        clearInterval(popupTimer);
        }
      }, 1000);
    };

    const skipAd = () => {
      popupOverlay.classList.remove("active");
      iframe.css("display", "block");
      jQuery(".popup-overlay").css("display", "none");
    };

    skipButton.addEventListener("click", () => {
      console.log("1");
      if (allowedToSkip) {
        skipAd();
      }
    });

    const startTimer = () => {
      showAd();
    };

    window.addEventListener("DOMContentLoaded", startTimer);

    </script>';
}

remove_action('shutdown', 'wp_ob_end_flush_all', 1);
add_action('shutdown', function () {
  while (@ob_end_flush());
});
