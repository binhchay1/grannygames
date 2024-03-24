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
    add_action('wp_body_open', 'add_element_for_insert_ads', 1);
    add_action('wp_footer', 'add_script_for_insert_ads', 100);
    add_action('wp_head', 'add_style_for_insert_ads', 1);
  }
}
add_action('wp', 'insert_ads_game_play');

function add_element_for_insert_ads()
{
  $insertAds = get_option('insert_ads_game_play');

  echo '
  <div class="popup-overlay">
    <div class="popup-container">
      <div class="ads-place">
      ' . html_entity_decode($insertAds) . '
      </div>

      <div class="right">
          <button class="skip-button">Skip in 5s</button>
      </div>
    </div>
  </div>';
}

function add_style_for_insert_ads()
{
  echo '<style>
  .right {
    margin: 20px auto;
    width: 300px;
    text-align: center;
  }

  .skip-button {
    padding: 5px 10px;
    border: none;
    box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
  }

  .popup-overlay {
    position: absolute;
    z-index: 10000;
  }

  .ads-place {
    height: auto;
  }
  </style>';
}

function add_script_for_insert_ads()
{
  echo '
    <script>
    var iframe = jQuery("#playframe");
    var 
    if(iframe.length) {
      var parent = iframe.parent();
      var widthParent = parent.width();
      var heightParent = parent.height();
      var offset = iframe.offset();
      var popup = jQuery(".popup-overlay");
  
      popup.css("left", offset.left);
      popup.css("top", offset.top);
      
      const popupOverlay = document.querySelector(".popup-overlay");
      const skipButton = jQuery(".skip-button");
  
      let remainingTime = 5;
      let allowedToSkip = false;
      let popupTimer;
  
      const showAd = () => {
        iframe.css("visibility", "hidden");
        jQuery("#game_buttons").css("display", "none");
        popupOverlay.classList.add("active");
        popupTimer = setInterval(() => {
        skipButton.html(`Skip in ${remainingTime}s`);
        remainingTime--;
  
        if (remainingTime < 0) {
          allowedToSkip = true;
          skipButton.html("Skip");
          clearInterval(popupTimer);
          }
        }, 1000);
      };
  
      const skipAd = () => {
        popupOverlay.classList.remove("active");
        iframe.css("visibility", "visible");
        jQuery(".popup-overlay").css("display", "none");
        jQuery("#game_buttons").css("display", "block");
        parent.css("height", heightAdsPlace + 100);
      };
  
      skipButton.click(function() {
        if (allowedToSkip) {
          skipAd();
        }
      });
  
      const startTimer = () => {
        showAd();
      };
  
      window.addEventListener("DOMContentLoaded", startTimer);
    }

    </script>';
}

remove_action('shutdown', 'wp_ob_end_flush_all', 1);
add_action('shutdown', function () {
  while (@ob_end_flush());
});
