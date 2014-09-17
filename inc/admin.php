<?php

// Default options values
$sa_options = array(
    'footer_copyright' => '&copy; ' . date('Y') . ' Study Group',
    'intro_text' => 'Provider Name: Study Group Australia Pty Limited. CRICOS Provider Codes: 01682E (NSW), 01755D (QLD)',
    'intro_text2' => 'Provider Name: Taylors Institute of Advanced Studies. CRICOS Provider Code: 01160J (VIC)',
    'author_credits' => false
);

if ( is_admin() ) : // Load only if we are viewing an admin page

function sa_register_settings() {
    // Register settings and call sanitation functions
    register_setting( 'sa_theme_options', 'sa_options', 'sa_validate_options' );
}

add_action( 'admin_init', 'sa_register_settings' );

// LET'S MAKE THE EDITORS CAPABLE TO EDIT THEME OPTIONS!
$role = get_role('editor');
$role->add_cap('edit_theme_options');


function sa_theme_options() {
    // Add theme options page to the addmin menu
    add_menu_page( 'Blog Settings', 'Blog Options', 'edit_theme_options', 'theme_options', 'sa_theme_options_page', 'dashicons-edit', 1 );
}

add_action( 'admin_menu', 'sa_theme_options' );

// Function to generate options page
function sa_theme_options_page() {
    global $sa_options, $sa_categories, $sa_layouts;

    if ( ! isset( $_REQUEST['updated'] ) )
        $_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

    <div class="wrap">

    <?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options' ) . "</h2>";
    // This shows the page's name and an icon if one has been provided ?>

    <?php if ( false !== $_REQUEST['updated'] ) : ?>
    <div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
    <?php endif; // If the form has just been submitted, this shows the notification ?>

    <form method="post" action="options.php">

    <?php $settings = get_option( 'sa_options', $sa_options ); ?>
    
    <?php settings_fields( 'sa_theme_options' );
    /* This function outputs some hidden fields required by the form,
    including a nonce, a unique number used to ensure the form has been submitted from the admin page
    and not somewhere else, very important for security */ ?>

    <table class="form-table"><!-- Grab a hot cup of coffee, yes we're using tables! -->

    <tr valign="top"><th scope="row"><label for="footer_copyright">Footer Copyright Notice</label></th>
    <td>
    <input id="footer_copyright" name="sa_options[footer_copyright]" type="text" value="<?php  esc_attr_e($settings['footer_copyright']); ?>" />
    </td>
    </tr>

    <tr valign="top"><th scope="row"><label for="intro_text">Footer text - Line 1</label></th>
    <td>
    <textarea id="intro_text" name="sa_options[intro_text]" rows="5" cols="30"><?php echo stripslashes($settings['intro_text']); ?></textarea>
    </td>
    </tr>

    <tr valign="top"><th scope="row"><label for="intro_text_2">Footer text - Line 2</label></th>
    <td>
    <textarea id="intro_text_2" name="sa_options[intro_text_2]" rows="5" cols="30"><?php echo stripslashes($settings['intro_text_2']); ?></textarea>
    </td>
    </tr>

    <tr valign="top"><th scope="row">Banner image overlay</th>
    <td>
    <input type="checkbox" id="author_credits" name="sa_options[author_credits]" value="1" <?php checked( true, $settings['author_credits'] ); ?> />
    <label for="author_credits">Show subscribe overlay (Not implemented yet)</label>
    </td>
    </tr>

    </table>

    <p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>

    </form>

    </div>

    <?php
}

function sa_validate_options( $input ) {
    global $sa_options, $sa_categories, $sa_layouts;

    $settings = get_option( 'sa_options', $sa_options );
    
    // We strip all tags from the text field, to avoid vulnerablilties like XSS
    $input['footer_copyright'] = wp_filter_nohtml_kses( $input['footer_copyright'] );
    
    // We strip all tags from the text field, to avoid vulnerablilties like XSS
    $input['intro_text'] = wp_filter_post_kses( $input['intro_text'] );

    // We strip all tags from the text field, to avoid vulnerablilties like XSS
    $input['intro_text_2'] = wp_filter_post_kses( $input['intro_text_2'] );
    
    // If the checkbox has not been checked, we void it
    if ( ! isset( $input['author_credits'] ) )
        $input['author_credits'] = null;
    // We verify if the input is a boolean value
    $input['author_credits'] = ( $input['author_credits'] == 1 ? 1 : 0 );
    
    return $input;
}

endif;  // EndIf is_admin()