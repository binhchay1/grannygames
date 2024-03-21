<?php
class Admin_Form
{
    const ID = 'config-seo';

    public function init()
    {
        add_action('admin_menu', array($this, 'add_menu_pages'), 1);
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
        add_action('wp_ajax_save_insert_ads', array($this, 'save_insert_ads'));
    }

    public function get_id()
    {
        return self::ID;
    }

    public function admin_enqueue_scripts($hook_suffix)
    {
        if (strpos($hook_suffix, $this->get_id()) === false) {
            return;
        }

        wp_enqueue_media();

        wp_enqueue_style('config-admin-form-bs', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css', INSERT_ADS_ADMIN_VERSION);
        wp_enqueue_script(
            'config-admin-form-bs',
            'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js',
            array('jquery'),
            INSERT_ADS_ADMIN_VERSION,
            true
        );

        wp_enqueue_script(
            'config-admin-form-bs',
            'https://code.jquery.com/jquery-3.7.1.slim.js'
        );

        echo '
        <style>
            .button-submit {
                border: 1px solid black !important;
            }

            .post-title {
                font-weight: bold !important;
                font-size: 19px !important;
            }

            #alert-post {
                display: none;
            }
        </style>';
    }

    function add_menu_pages()
    {
        add_menu_page('Insert Ads', 'Insert Ads', 10, $this->get_id() . '_general', array(&$this, 'load_view_general'), plugins_url('insert-ads/images/icon.png'));
    }

    public function load_view_general()
    {
        $insertAdsGamePlay = get_option('insert_ads_game_play');
        $nonce = wp_create_nonce("get_game_nonce");
        $link = admin_url('admin-ajax.php');

        echo '<div class="container mt-5">';
        echo "<div class='alert' role='alert' id='alert-post'></div>";
        echo '<h3>Insert Ads to game play</h3>';
        echo '<div>';
        echo '<span style="margin-top: 10px;">
        <textarea id="insert_ads_game_play" style="width: 400px; height: 200px">' . $insertAdsGamePlay . '</textarea>
        </span><br>';
        echo '<button class="btn btn-primary mt-4 w-10" type="button" id="save-general">Save</button>';
        echo '</div></div>';

        echo '<script>
        jQuery("#save-general").on("click", function() {
            var result = jQuery("#insert_ads_game_play").val();
            console.log(typeof result);
            jQuery.post("' . $link . '", 
                        {
                            "action": "save_insert_ads",
                            "dataType": "json",
                            "data": result,
                            "nonce": "' . $nonce . '"
                        }, 
                        function(response) {
                            let alert = document.getElementById("alert-post");
                            alert.classList.add("alert-success");
                            alert.style.display = "block";
                            alert.innerHTML = "Save successfully!";
                        }
                    )
        });
        
        </script>';
    }

    public function save_insert_ads()
    {
        if (!wp_verify_nonce($_REQUEST['nonce'], "get_game_nonce")) {
            exit("Please don't fucking hack this API");
        }

        $data = $_REQUEST['data'];
        $insertAdsGamePlay = get_option('insert_ads_game_play');

        if ($insertAdsGamePlay == false) {
            add_option('insert_ads_game_play', htmlentities($data));
        } else {
            update_option('insert_ads_game_play', htmlentities($data));
        }

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            echo 'success';
        } else {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
}
