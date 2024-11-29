<?php

/*
 * Plugin Name:       Quick Build Promo Popup
 * Plugin URI:        https://example.com/my-plugin/
 * Description:       Quick Build Promo Popup is a versatile and user-friendly WordPress plugin that simplifies the creation, management, and customization of promotional popups and discounts.
 * VERSION:           1.0.0
 * Author:            Mofazzal Hossain
 * Author URI:        https://github.com/Mofazzal-Hossain
 * License:           GPL v2 or later
 * Text Domain:       quick-build-promo-popup
 * Domain Path:       /languages
*/

// Define a QBPP_VERSION constant
define('QBPP_VERSION', time());
define('QBPP_PLUGIN_DIR', plugin_dir_url(__FILE__));
define('QBPP_PUBLIC_DIR', QBPP_PLUGIN_DIR . 'public');
define('QBPP_ADMIN_DIR', QBPP_PLUGIN_DIR . 'admin');

// text domain load
function qbpp_plugin_loaded()
{
    load_plugin_textdomain('quick-build-promo-popup', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'qbpp_plugin_loaded');


// files require
require_once plugin_dir_path(__FILE__) . 'includes/qbpp-popup-cpt.php';
require_once plugin_dir_path(__FILE__) . 'includes/qbpp-popup-settings-metabox.php';
require_once plugin_dir_path(__FILE__) . 'includes/qbpp-popup-shortcode-metabox.php';


// admin assets enqueue
function qbpp_admin_assets_enqueue($screen)
{
    $current_post_type = get_post_type();

    if (('post-new.php' == $screen || 'post.php' == $screen) && 'qbp-popup' == $current_post_type) {
        wp_enqueue_media();
        wp_enqueue_script('wp-editor');
        wp_enqueue_script('wp-mediaelement');
        wp_enqueue_style('wp-editor');

        wp_enqueue_style('qbpp-admin-style-css', QBPP_ADMIN_DIR . '/css/admin-style.css', array(), QBPP_VERSION);
        wp_enqueue_script('qbpp-admin-gallery-js', QBPP_ADMIN_DIR . '/js/gallery-media.js', array('jquery'), QBPP_VERSION, true);
        wp_enqueue_script('qbpp-admin-main-js', QBPP_ADMIN_DIR . '/js/admin-main.js', array('jquery'), QBPP_VERSION, true);
    }
}
add_action('admin_enqueue_scripts', 'qbpp_admin_assets_enqueue');



// add columns on the popup 
function qbpp_posts_columns($columns)
{
    if ('qbp-popup' === get_post_type()) {
        unset($columns['date']);
        $columns['id'] = __('Popup ID', 'qbpp');
        $columns['shortcode'] = __('Shortcode', 'qbpp');
        $columns['date'] = __('Date', 'qbpp');
    }

    return $columns;
}
add_filter('manage_posts_columns', 'qbpp_posts_columns');


// update column value
function qbpp_popup_update_column($column, $post_id)
{
    if ('qbp-popup' === get_post_type()) {
        if ('id' === $column) {
            echo esc_html($post_id);
        } else if ('shortcode' === $column) {
            echo '[qbp-popup id="' . esc_html($post_id) . '"]';
        }
    }
}
add_action('manage_posts_custom_column', 'qbpp_popup_update_column', 10, 2);

// sortable popups post id 
function qbpp_popup_column_sort($column)
{
    if ('qbp-popup' === get_post_type()) {
        $column['id'] = 'id';
    }

    return $column;
}
add_filter('manage_edit-qbp-popup_sortable_columns', 'qbpp_popup_column_sort');


// popup id filter
function qbpp_filter_by_popup($post_type)
{

    if ('qbp-popup' === $post_type) {
        $args = array(
            'post_type' => 'qbp-popup',
            'post_status' => 'publish'
        );
        $popup_posts = get_posts($args);
        $popup_filter_id = 0;
        if (isset($_GET['qbpp_popup_filter_nonce']) && wp_verify_nonce($_GET['qbpp_popup_filter_nonce'], 'qbpp_filter_by_popup')) {
            $popup_filter_id = isset($_GET['popup_id']) ? sanitize_text_field($_GET['popup_id']) : '';
        }
        wp_nonce_field('qbpp_filter_by_popup', 'qbpp_popup_filter_nonce');

?>

        <select name="popup_id" id="popup_id">
            <option disabled selected><?php echo esc_html_e('Select a popup', 'qbpp'); ?></option>
            <?php foreach ($popup_posts as $popup_post) :
                $selected = ($popup_post->ID == $popup_filter_id) ? __('selected', 'qbpp') : '';
            ?>
                <option value="<?php echo esc_attr($popup_post->ID); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($popup_post->post_title); ?></option>
            <?php endforeach; ?>
        </select>

<?php
    }
}
add_action('restrict_manage_posts', 'qbpp_filter_by_popup');


// qbpp pre get post
function qbpp_pre_post($query)
{
    if (!is_admin()) {
        return false;
    }
    if (!$query->is_main_query()) {
        return;
    }

    if (!isset($_GET['qbpp_popup_filter_nonce']) || !wp_verify_nonce($_GET['qbpp_popup_filter_nonce'], 'qbpp_filter_by_popup')) {
        return;
    }

    if (isset($_GET['qbpp_popup_filter_nonce']) && wp_verify_nonce($_GET['qbpp_popup_filter_nonce'], 'qbpp_filter_by_popup')) {
        $popup_filter_id = isset($_GET['popup_id']) ? sanitize_text_field($_GET['popup_id']) : '';
        if (!empty($popup_filter_id)) {
            $query->set('p', $popup_filter_id);
        }
    }

    // filter by id
    $orderby = $query->get('orderby');
    if ('id' === $orderby) {
        $query->set('orderby', 'ID');
    }
}
add_action('pre_get_posts', 'qbpp_pre_post');


// register qbpp shortcodes
function qbpp_register_popup_shortcodes()
{
    add_shortcode('qbp_popup', 'qbpp_display_popup');
}
add_action('init', 'qbpp_register_popup_shortcodes');