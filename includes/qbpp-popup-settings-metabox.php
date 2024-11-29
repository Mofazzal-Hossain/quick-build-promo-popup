<?php

// Register meta box
function qbpp_add_meta_box()
{
    add_meta_box(
        'qbpp_popup_settings',
        __('Popup Settings', 'quick-build-promo-popup'),
        'qbpp_popup_settings_display',
        'qbp-popup',
        'advanced',
        'high'
    );
}
add_action('add_meta_boxes', 'qbpp_add_meta_box');

// Meta box callback function
function qbpp_popup_settings_display($post)
{

    $meta_fields = [
        'qbpp_popup_active', 'qbpp_image_id', 'qbpp_popup_url',
        'qbpp_popup_content_heading', 'qbpp_popup_content_desc',
        'qbpp_custom_content_active', 'qbpp_popup_custom_content',
        'qbpp_heading_align', 'qbpp_desc_align',
        'qbpp_popup_display', 'qbpp_display_popup_delay',
        'qbpp_popup_auto_hide', 'qbpp_popup_hide_delay',
        'qbpp_element_selector', 'qbpp_popup_size',
        'qbpp_custom_width', 'qbpp_custom_height',
    ];

    foreach ($meta_fields as $field) {
        ${$field} = get_post_meta($post->ID, '_' . $field, true);
    }

    $qbpp_heading_align = $qbpp_heading_align ?: 'left';
    $qbpp_desc_align = $qbpp_desc_align ?: 'left';


    $qbpp_size_options = [
        'fit-screen' => __('Fit Screen', 'quick-build-promo-popup'),
        'original' => __('Original', 'quick-build-promo-popup'),
        'landscape' => __('Landscape', 'quick-build-promo-popup'),
        'portrait' => __('Portrait', 'quick-build-promo-popup'),
        'custom' => __('Custom Size', 'quick-build-promo-popup')
    ];

    $qbpp_align_options = [
        'left' => __('Left', 'quick-build-promo-popup'),
        'center' => __('Center', 'quick-build-promo-popup'),
        'right' => __('Right', 'quick-build-promo-popup')
    ];


    // settings template
    include 'qbpp-popup-settings-template.php';
}

// Save meta box data
function qbpp_save_meta_box_data($post_id)
{
    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'update-post_' . $post_id)) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = [
        'qbpp_popup_active', 'qbpp_image_id', 'qbpp_popup_url',
        'qbpp_popup_content_heading', 'qbpp_heading_align',
        'qbpp_popup_content_desc', 'qbpp_desc_align',
        'qbpp_custom_content_active', 'qbpp_popup_custom_content',
        'qbpp_popup_display', 'qbpp_display_popup_delay',
        'qbpp_popup_auto_hide', 'qbpp_popup_hide_delay',
        'qbpp_element_selector', 'qbpp_popup_size',
        'qbpp_custom_width', 'qbpp_custom_height',
    ];

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $value = $field === 'qbpp_popup_custom_content' || $field === 'qbpp_popup_content_desc'
                ? wp_kses_post($_POST[$field])
                : sanitize_text_field($_POST[$field]);
            update_post_meta($post_id, '_' . $field, $value);
        }
    }
}
add_action('save_post', 'qbpp_save_meta_box_data');
