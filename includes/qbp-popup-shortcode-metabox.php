<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly

function qbpp_public_assets_enqueue()
{
    wp_enqueue_style('qbpp-public-style-css', QBPP_PUBLIC_DIR . '/css/public-style.css', null, QBPP_VERSION);
    wp_enqueue_style('qbpp-public-boostrap-css', QBPP_PUBLIC_DIR . '/css/bootstrap.min.css', null, '5.3.3');
    wp_enqueue_script('qbpp-public-bootstrap-bundle', QBPP_PUBLIC_DIR . '/js/bootstrap.bundle.min.js', array('jquery'), '5.3.3', true);
    wp_enqueue_script('qbpp-public-main-js', QBPP_PUBLIC_DIR . '/js/public-main.js', array('jquery'), QBPP_VERSION, true);
}

// shortcode metabox
function qbpp_shortcode_metabox()
{
    global $post;

    if ($post && get_post_status($post->ID) == 'publish') {
        add_meta_box(
            'qbp_popup_shortcode',
            __('Popup Shortcode', 'quick-build-promo-popup'),
            'qbpp_shortcode_metabox_display',
            array('qbp-popup'),
            'side',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'qbpp_shortcode_metabox');

// display shortcode metabox
function qbpp_shortcode_metabox_display($post)
{
    $shortcode = '[qbp_popup id="' . $post->ID . '"]';
?>
    <div class="qbp-popup-shortcode-box">
        <input type="text" readonly="readonly" id="qbppPopupShortcode" class="qbp-popup-shortcode" value="<?php echo esc_attr($shortcode); ?>">
        <button id="qbppCopyButton" class="qbp-popup-copy" type="button"><?php esc_html_e('Copy', 'quick-build-promo-popup'); ?></button>
        <div id="qbppPopupMessage" class="qbp-popup-message"></div>
    </div>
    <?php
}


// display shortcode popup
function qbpp_display_popup($atts)
{

    qbpp_public_assets_enqueue();

    static $instance = 0;
    $instance++;

    $atts = shortcode_atts(
        [
            'id' => '',
        ],
        $atts,
        'qbp_popup'
    );

    $post_id = $atts['id'];
    $post = get_post($post_id);

    if (!$post) {
        return '';
    }

    // Fetch meta data
    $qbpp_active = get_post_meta($post->ID, '_qbp_popup_active', true);
    $qbpp_thumbnail_id = absint(get_post_meta($post->ID, '_qbpp_image_id', true));
    $qbpp_url = sanitize_url(get_post_meta($post->ID, '_qbp_popup_url', true));
    $qbp_popup_content_heading = get_post_meta($post->ID, '_qbp_popup_content_heading', true);
    $qbp_popup_content_desc = get_post_meta($post->ID, '_qbp_popup_content_desc', true);
    $qbpp_custom_content_active = get_post_meta($post->ID, '_qbpp_custom_content_active', true);
    $qbp_popup_custom_content = get_post_meta($post->ID, '_qbp_popup_custom_content', true);
    $qbpp_heading_align = get_post_meta($post->ID, '_qbpp_heading_align', true) ?: 'left';
    $qbpp_desc_align = get_post_meta($post->ID, '_qbpp_desc_align', true) ?: 'left';
    $qbpp_display = absint(get_post_meta($post->ID, '_qbp_popup_display', true));
    $qbpp_auto_hide = get_post_meta($post->ID, '_qbp_popup_auto_hide', true);
    $qbpp_thumbnail_size = sanitize_text_field(get_post_meta($post->ID, '_qbp_popup_size', true));
    $qbpp_custom_width = get_post_meta($post->ID, '_qbpp_custom_width', true);
    $qbpp_custom_height = get_post_meta($post->ID, '_qbpp_custom_height', true);
    $qbpp_custom_size = $qbpp_custom_width . 'x' . $qbpp_custom_height;

    // Conditional meta data
    $qbpp_display_delay = $qbpp_display == 1 ? absint(get_post_meta($post->ID, '_qbpp_display_popup_delay', true)) : '';
    $qbpp_element_selector = $qbpp_display == 2 ? sanitize_text_field(get_post_meta($post->ID, '_qbpp_element_selector', true)) : '';
    $qbpp_hide_delay = $qbpp_auto_hide ? absint(get_post_meta($post->ID, '_qbp_popup_hide_delay', true)) : '';

    // Get thumbnail
    $qbpp_thumbnail = wp_get_attachment_image_src($qbpp_thumbnail_id, 'full');

    // Unique modal ID
    $unique_modal_id = 'qbpPopupModal-' . $post->ID . '-' . $instance;

    // Check for custom content
    $has_custom_content = $qbpp_custom_content_active && !empty($qbp_popup_custom_content);

    // Image class
    $image_class = ($has_custom_content || $qbp_popup_content_heading) ? 'qbpp_exist_content' : '';



    ob_start();
    if ($qbpp_active) : ?>
        <div class="modal fade qbpp-modal qbpp-<?php echo ('custom' == $qbpp_thumbnail_size) ? esc_attr($qbpp_thumbnail_size . '-' . $qbpp_custom_size) : esc_attr($qbpp_thumbnail_size); ?>" id="<?php echo esc_attr($unique_modal_id); ?>" aria-hidden="true" aria-labelledby="qbp-popup-<?php echo esc_attr($post_id); ?>-label" tabindex="-1" data-display="<?php echo esc_attr($qbpp_display); ?>" data-delay="<?php echo esc_attr($qbpp_display_delay); ?>" data-close="<?php echo isset($qbpp_hide_delay) ? esc_attr($qbpp_hide_delay) : ''; ?>" data-selector="<?php echo esc_attr($qbpp_element_selector); ?>">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header justify-content-between">
                        <?php
                        $qbpp_header_content = '
                                <h2 class="modal-title" id="qbp-popup-' . esc_attr($post_id) . '-label">' . esc_html(get_the_title($post_id)) . '</h2>
                            ';
                        echo wp_kses_post(apply_filters('qbpp_modal_header_content', $qbpp_header_content, $post_id));
                        ?>
                        <button type="button" class="p-0 border-0 bg-transparent" data-bs-dismiss="modal" aria-label="Close">
                            <svg height="20"  width="20"  id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512"xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path d="M443.6,387.1L312.4,255.4l131.5-130c5.4-5.4,5.4-14.2,0-19.6l-37.4-37.6c-2.6-2.6-6.1-4-9.8-4c-3.7,0-7.2,1.5-9.8,4  L256,197.8L124.9,68.3c-2.6-2.6-6.1-4-9.8-4c-3.7,0-7.2,1.5-9.8,4L68,105.9c-5.4,5.4-5.4,14.2,0,19.6l131.5,130L68.4,387.1  c-2.6,2.6-4.1,6.1-4.1,9.8c0,3.7,1.4,7.2,4.1,9.8l37.4,37.6c2.7,2.7,6.2,4.1,9.8,4.1c3.5,0,7.1-1.3,9.8-4.1L256,313.1l130.7,131.1  c2.7,2.7,6.2,4.1,9.8,4.1c3.5,0,7.1-1.3,9.8-4.1l37.4-37.6c2.6-2.6,4.1-6.1,4.1-9.8C447.7,393.2,446.2,389.7,443.6,387.1z" />
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php $qbpp_modal_body_content = '
                            <a href="' . esc_url($qbpp_url) . '" aria-label="' . esc_url($qbpp_url) . '" title="' . esc_url($qbpp_url) . '">
                                <img class="qbp-popup-image ' . esc_attr($image_class) . '" src="' . esc_url($qbpp_thumbnail[0]) . '"  alt="">
                            </a>
                            <div class="qbp-popup-content">
                                <h3 class="qbp-popup-heading align-' . $qbpp_heading_align . '">' . esc_html($qbp_popup_content_heading) . '</h3>
                                <p class="qbp-popup-desc align-' . $qbpp_desc_align . '">' . wp_kses_post($qbp_popup_content_desc) . '</p>
                            </div>
                        ';
                        if ($has_custom_content) {
                            $qbpp_modal_body_content .= '<div class="qbp-popup-custom-content">' . wp_kses_post($qbp_popup_custom_content) . '</div>';
                        }

                        echo wp_kses_post(apply_filters('qbpp_modal_body_content', $qbpp_modal_body_content, $post_id));
                        ?>
                    </div>
                    <?php if (has_filter('qbpp_modal_footer_content')) : ?>
                        <div class="modal-footer">
                            <?php echo wp_kses_post(apply_filters('qbpp_modal_footer_content', '', $post_id)); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

<?php endif;
    $modal_content = ob_get_clean();
    return apply_filters('qbpp_modal', $modal_content, $post_id);
}
