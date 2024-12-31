<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

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
                    <div class="modal-header">
                        <?php
                        $qbpp_header_content = '
                                <h5 class="modal-title" id="qbp-popup-' . esc_attr($post_id) . '-label">' . esc_html(get_the_title($post_id)) . '</h5>
                            ';
                        echo wp_kses_post(apply_filters('qbpp_modal_header_content', $qbpp_header_content, $post_id));
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        if($has_custom_content){
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
