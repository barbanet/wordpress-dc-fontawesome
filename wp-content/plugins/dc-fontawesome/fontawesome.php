<?php
/*
Plugin Name: DC FontAwesome
Description: Integrate FontAwesome to Wordpress to be used with any theme in a non-intrusive way.
Version: 0.1.0
Author: Damián Culotta
Author URI: http://www.damianculotta.com.ar
License: GPL3
*/

function getFontAwesomeStyles()
{
    $_settings_mode = get_option('fontawesome_mode', 'disable');
    switch($_settings_mode) {
        case 'local':
            wp_enqueue_style('font-awesome', plugin_dir_url(__FILE__) . 'css/font-awesome.min.css');
            break;
        case 'remote':
            wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
            break;
    }
}
add_action('wp_enqueue_scripts', 'getFontAwesomeStyles');

function getFontawesomeAdmin()
{
    if ($_POST['fontawesome_mode']) {
        update_option('fontawesome_mode', $_POST['fontawesome_mode']);
        ?>
        <div id="message" class="updated fade"><p><strong><?php _e('Options saved.') ?></strong></p></div>
        <?php
    }
    $_settings_mode = get_option('fontawesome_mode', 'disable');
    ?>
    <div class="wrap">
        <h2><?php _e('DC Font Awesome'); ?></h2>
        <p><?php _e('It allows to include the <a href="http://fontawesome.io/" target="_blank">FontAwesome</a> library in a non-intrusive way.'); ?></p>
        <h3><?php _e('Library Source'); ?></h3>
        <form method="post" action="<?php echo admin_url('options-general.php?page=fontawesome'); ?>">
            <table class="form-table">
                <tr>
                    <td>
                        <label>
                            <input type="radio" name="fontawesome_mode" value="local" <?php if ($_settings_mode == 'local') { ?>checked="checked" <?php } ?>/> <?php _e('<strong>Local:</strong> Serve files from your own server.'); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <input type="radio" name="fontawesome_mode" value="remote" <?php if ($_settings_mode == 'remote') { ?>checked="checked" <?php } ?>/> <?php _e('<strong>Remote:</strong> Get files from maxcdn.bootstrapcdn.com.'); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <input type="radio" name="fontawesome_mode" value="disable" <?php if ($_settings_mode == 'disable') { ?>checked="checked" <?php } ?>/> <?php _e('<strong>Disable:</strong> Library will not be included.'); ?>
                        </label>
                    </td>
                </tr>
            </table>
            <p class="submit"><input class="button" type="submit" name="submit" value="<?php _e('Update &raquo;'); ?>" /></p>
        </form>
    </div>
    <?php
}

function getFontawesomeAdminMenu()
{
    add_options_page('Font Awesome', 'Font Awesome', 8, 'fontawesome', 'getFontawesomeAdmin');
}

add_action('admin_menu', 'getFontawesomeAdminMenu'); 

?>
