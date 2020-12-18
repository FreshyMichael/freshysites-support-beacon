<?php
//Simple Security
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * @internal never define functions inside callbacks.
 * these functions could be run multiple times; this would result in a fatal error.
 */

/**
 * custom option and settings
 */

function fs_support_settings_init() {
    // Register a new setting for "fs_support" page.
    register_setting( 'freshysites-support-beacon/includes/fs_support_settings.php', 'fs_support_options' );

    // Register a new section in the "fs_support" page.
    add_settings_section(
        'fs_support_section_developers',
        __( 'FreshySites Support Settings', 'freshysites-support-beacon/includes/fs_support_settings.php' ), 'fs_support_section_developers_callback',
        'freshysites-support-beacon/includes/fs_support_settings.php'
    );

    // Register a new field in the "fs_support_section_developers" section, inside the "fs_support_settings" page.
    add_settings_field(
        'fs_support_field_admin_theme', // As of WP 4.6 this value is used only internally.
                                // Use $args' label_for to populate the id inside the callback.
            __( 'Dashboard Theme', 'fs_support_options' ),
        'fs_support_field_admin_theme_cb',
        'freshysites-support-beacon/includes/fs_support_settings.php',
        'fs_support_section_developers',
        array(
            'label_for'         => 'fs_support_field_admin_theme',
            'class'             => 'fs_support_row',
            'fs_support_custom_data' => 'custom',
        )
    );
	
	add_settings_field(
		'fs_support_hide_threat_notice',
		__('Hide Jetpack Threat Notice', 'fs_support_options'),
		'fs_support_section_developers',
        array(
            'label_for'         => 'fs_support_field_admin_theme',
            'class'             => 'fs_support_row',
            'fs_support_custom_data' => 'custom',
			)
	);
}

/**
 * Register our fs_support_settings_init to the admin_init action hook.
 */
add_action( 'admin_init', 'fs_support_settings_init' );


/**
 * Custom option and settings:
 *  - callback functions
 */


/**
 * Developers section callback function.
 *
 * @param array $args  The settings array, defining title, id, callback.
 */
function fs_support_section_developers_callback( $args ) {
    ?>
    <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Please remember to save settings when done'); ?></p>
    <?php
}

/**
 * admin_theme field callbakc function.
 *
 * WordPress has magic interaction with the following keys: label_for, class.
 * - the "label_for" key value is used for the "for" attribute of the <label>.
 * - the "class" key value is used for the "class" attribute of the <tr> containing the field.
 * Note: you can add custom key value pairs to be used inside your callbacks.
 *
 * @param array $args
 */
function fs_support_field_admin_theme_cb( $args ) {
    // Get the value of the setting we've registered with register_setting()
    $options = get_option( 'fs_support_options' );
    ?>
   
    <select
            id="<?php echo esc_attr( $args['label_for'] ); ?>"
            data-custom="<?php echo esc_attr( $args['fs_support_custom_data'] ); ?>"
            name="fs_support_options[<?php echo esc_attr( $args['label_for'] ); ?>]">
        <option value="White" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'white', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'FS White', 'freshysites-support-beacon/includes/fs_support_settings.php' ); ?>
        </option>
        <option value="Green" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'green', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'FS Green', 'freshysites-support-beacon/includes/fs_support_settings.php' ); ?>
        </option>
        <option value="Dark" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'dark', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'FS Dark', 'freshysites-support-beacon/includes/fs_support_settings.php' ); ?>
        </option>
    </select>
	
    <?php
}


/**
 * Top level menu callback function
 */
function fs_support_options_page_html() {
    // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // add error/update messages

    // check if the user have submitted the settings
    // WordPress will add the "settings-updated" $_GET parameter to the url
    if ( isset( $_GET['settings-updated'] ) ) {
        // add settings saved message with the class of "updated"
        add_settings_error( 'fs_support_messages', 'fs_support_message', __( 'Settings Saved', 'freshysites-support-beacon/includes/fs_support_settings.php' ), 'updated' );
    }

    // show error/update messages
    settings_errors( 'fs_support_messages' );
    ?>
    <div class="wrap">
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "fs_support"
            settings_fields( 'freshysites-support-beacon/includes/fs_support_settings.php' );
            // output setting sections and their fields
            // (sections are registered for "fs_support", each field is registered to a specific section)
            do_settings_sections( 'freshysites-support-beacon/includes/fs_support_settings.php' );
            // output save settings button
            submit_button( 'Save Settings' );
            ?>
        </form>
    </div>
    <?php
}
