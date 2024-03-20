<?php
/**
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage fungames
 * @version    2.5.0
 * @author     Daniel Bakovic <contact@myarcadeplugin.com>
 * @copyright  Copyright (c) 2015, Daniel Bakovic
 * @license    https://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
get_template_part( 'inc/admin/class-tgm-plugin-activation' );

add_action( 'tgmpa_register', 'fungames_register_required_plugins' );

function fungames_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */

    $plugins = array(

      array(
        'name'      => 'Breadcrumb NavXT',
        'slug'      => 'breadcrumb-navxt',
      ),

      array(
        'name'      => 'BuddyPress',
        'slug'      => 'buddypress',
      ),


      array(
        'name'      => 'WP Lightbox 2',
        'slug'      => 'wp-lightbox-2',
      ),

      array(
        'name'               => 'MyArcadePlugin',
        'slug'               => 'myarcadeplugin',
        'source'             => 'https://myarcadeplugin.com/',
        'required'           => true,
        'version'            => '',
        'force_activation'   => false,
        'force_deactivation' => false,
        'external_url'       => 'https://myarcadeplugin.com/',
      ),

      array(
        'name'               => 'MyGameListCreator',
        'slug'               => 'mygamelistcreator',
        'source'             => 'https://myarcadeplugin.com/',
        'required'           => false,
        'version'            => '',
        'force_activation'   => false,
        'force_deactivation' => false,
        'external_url'       => 'https://myarcadeplugin.com/',
      ),

      array(
        'name'               => 'MyScoresPresenter',
        'slug'               => 'myscorespresenter',
        'source'             => 'https://myarcadeplugin.com/',
        'required'           => false,
        'version'            => '',
        'force_activation'   => false,
        'force_deactivation' => false,
        'external_url'       => 'https://myarcadeplugin.com/',
      ),

      array(
        'name'      => 'WP-PageNavi',
        'slug'      => 'wp-pagenavi',
      ),

      array(
        'name'      => 'WP-PostRatings',
        'slug'      => 'wp-postratings',
      ),

      array(
        'name'      => 'WP-PostViews',
        'slug'      => 'wp-postviews',
      ),

      array(
        'name'      => 'WP Favorite Posts',
        'slug'      => 'wp-favorite-posts',
      ),
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id'           => 'fungames',         // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'fungames-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => ( class_exists('redux') ) ? true : false,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
          'page_title'                      => esc_html__( 'Install Required Plugins', 'tgmpa' ),
          'menu_title'                      => esc_html__( 'Install Plugins', 'tgmpa' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'tgmpa' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'tgmpa' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
            )
  );

  tgmpa( $plugins, $config );
}