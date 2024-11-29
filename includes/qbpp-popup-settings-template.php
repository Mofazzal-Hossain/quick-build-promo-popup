<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="qbpp-popup-settings">
    <!-- Popup Active -->
    <div class="qbpp-group-wrap">
        <div class="qbpp-label-box">
            <label class="col-form-label"><?php esc_html_e('Popup Active', 'quick-build-promo-popup'); ?></label>
        </div>
        <div class="qbpp-field-box">
            <input type="hidden" name="qbpp_popup_active" value="0">
            <input type="checkbox" id="qbpp_popup_active" name="qbpp_popup_active" value="1" <?php checked($qbpp_popup_active, '1'); ?>>
            <label for="qbpp_popup_active" class="form-check-label"><?php esc_html_e('Active', 'quick-build-promo-popup'); ?></label>
        </div>
    </div>

    <!-- Popup Image -->
    <div class="qbpp-group-wrap">
        <div class="qbpp-label-box">
            <label class="col-form-label" for="qbpp_popup_image"><?php esc_html_e('Popup Image', 'quick-build-promo-popup'); ?></label>
        </div>
        <div class="qbpp-field-box">
            <div class="qbpp-image-container">
                <span id="qbpp-no-image"><?php esc_html_e('No image selected', 'quick-build-promo-popup'); ?></span>
                <button id="qbppAddImage" type="button" class="qbpp-add-image"><?php esc_html_e('Add Image', 'quick-build-promo-popup'); ?></button>
                <span id="qbppEditImage" class="dashicons dashicons-edit" style="display:none; cursor: pointer;"></span>
                <span id="qbppDeleteImage" class="dashicons dashicons-no-alt" style="display:none; cursor: pointer;"></span>
                <input type="hidden" id="qbpp_image_id" name="qbpp_image_id" value="<?php echo esc_attr($qbpp_image_id); ?>">
                <div class="qbpp-image-preview">
                    <div class="qbpp-loader"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup Image URL -->
    <div class="qbpp-group-wrap">
        <div class="qbpp-label-box">
            <label class="col-form-label" for="qbpp_popup_url"><?php esc_html_e('Popup Image URL', 'quick-build-promo-popup'); ?></label>
        </div>
        <div class="qbpp-field-box">
            <input type="url" id="qbpp_popup_url" name="qbpp_popup_url" placeholder="https://www.google.com/" value="<?php echo esc_attr($qbpp_popup_url); ?>" class="form-control">
        </div>
    </div>

    <!-- Popup Content -->
    <div class="qbpp-group-wrap">
        <div class="qbpp-label-box">
            <label class="col-form-label"><?php esc_html_e('Popup Content', 'quick-build-promo-popup'); ?></label>
        </div>
        <div class="qbpp-field-box">
            <div class="qbpp-content-wrap">
                <!-- Heading -->
                <div class="form-group">
                    <div class="qbpp-d-flex">
                        <label for="qbpp_popup_content_heading"><?php esc_html_e('Heading', 'quick-build-promo-popup'); ?></label>
                        <span id="qbppPopupContentHeadingAlign" class="qbpp-popup-content-align">
                            <?php foreach ($qbpp_align_options as $key => $qbpp_align_option) :
                                $active = ($key == $qbpp_heading_align) ? __('active', 'quick-build-promo-popup') : '';
                            ?>
                                <span id="align<?php echo esc_attr($qbpp_align_option); ?>" class="align-<?php echo esc_attr($key) . (!empty($active) ? ' active' : ''); ?>" data-align="<?php echo esc_attr($key); ?>" title="<?php echo esc_attr($key); ?>">
                                    <i class="mce-ico mce-i-align<?php echo esc_attr($key); ?>"></i>
                                </span>
                            <?php endforeach; ?>
                        </span>
                    </div>
                    <input type="hidden" id="qbpp_heading_align" name="qbpp_heading_align" value="<?php echo esc_attr($qbpp_heading_align); ?>">
                    <input type="text" class="form-control align<?php echo (!empty($qbpp_heading_align) ? '-' . esc_attr($qbpp_heading_align) : ''); ?>" id="qbpp_popup_content_heading" name="qbpp_popup_content_heading" value="<?php echo esc_attr($qbpp_popup_content_heading); ?>">
                </div>
                <!-- Description -->
                <div class="form-group">
                    <div class="qbpp-d-flex">
                        <label for="qbpp_popup_content_desc"><?php esc_html_e('Description', 'quick-build-promo-popup'); ?></label>
                        <span id="qbppPopupContentDescAlign" class="qbpp-popup-content-align">
                            <?php foreach ($qbpp_align_options as $key => $qbpp_align_option) :
                                $active = ($key == $qbpp_desc_align) ? __('active', 'quick-build-promo-popup') : '';
                            ?>
                                <span id="align<?php echo esc_attr($qbpp_align_option); ?>" class="align-<?php echo esc_attr($key) . (!empty($active) ? ' active' : ''); ?>" data-align="<?php echo esc_attr($key); ?>" title="<?php echo esc_attr($key); ?>">
                                    <i class="mce-ico mce-i-align<?php echo esc_attr($key); ?>"></i>
                                </span>
                            <?php endforeach; ?>
                        </span>
                    </div>
                    <input type="hidden" id="qbpp_desc_align" name="qbpp_desc_align" value="<?php echo esc_attr($qbpp_desc_align); ?>">
                    <textarea id="qbpp_popup_content_desc" class="align-<?php echo esc_attr($qbpp_desc_align); ?>" name="qbpp_popup_content_desc" rows="6"><?php echo wp_kses_post($qbpp_popup_content_desc); ?></textarea>
                    <span class="qbpp-label-info">
                        <?php echo esc_html_e('[ You can use HTML tags. e.g: <span style="color:red;">red</span>]', 'quick-build-promo-popup'); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup Custom Content -->
    <div class="qbpp-group-wrap">
        <div class="qbpp-label-box">
            <label class="col-form-label" for="qbpp_custom_content_active"><?php esc_html_e('Popup custom content', 'quick-build-promo-popup'); ?></label>
        </div>
        <div class="qbpp-field-box">
            <div class="qbpp-custom-content-box" id="qbppCustomContentActive">
                <input type="hidden" name="qbpp_custom_content_active" value="0">
                <input type="checkbox" id="qbpp_custom_content_active" name="qbpp_custom_content_active" value="1" <?php echo '1' == $qbpp_custom_content_active ? esc_attr_e('checked', 'quick-build-promo-popup') : ''; ?>>
                <label class="form-check-label" for="qbpp_custom_content_active"><?php esc_html_e('Yes', 'quick-build-promo-popup'); ?></label>
            </div>
            <div id="qbppCustomContent" class="qbpp-custom-content" style="<?php echo ('1' !== $qbpp_custom_content_active) ? 'display:none;' : ''; ?>">
                <?php
                $settings = array(
                    'textarea_name' => 'qbpp_popup_custom_content',
                    'textarea_rows' => 10,
                );

                wp_editor($qbpp_popup_custom_content, 'qbpp_popup_custom_content', $settings);
                ?>
            </div>
        </div>
    </div>

    <!-- Popup Display -->
    <div class="qbpp-group-wrap">
        <div class="qbpp-label-box">
            <label class="col-form-label"><?php esc_html_e('Popup Display', 'quick-build-promo-popup'); ?></label>
        </div>
        <div class="qbpp-field-box" id="qbppDisplay">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="qbpp_popup_display" id="qbpp_display_load" value="1" <?php checked($qbpp_popup_display, '1'); ?> checked>
                <label class="form-check-label" for="qbpp_display_load"><?php esc_html_e('Display on page load', 'quick-build-promo-popup'); ?></label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="qbpp_popup_display" id="qbpp_display_click" value="2" <?php checked($qbpp_popup_display, '2'); ?>>
                <label class="form-check-label" for="qbpp_display_click"><?php esc_html_e('Display on click', 'quick-build-promo-popup'); ?></label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="qbpp_popup_display" id="qbpp_display_exit" value="3" <?php checked($qbpp_popup_display, '3'); ?>>
                <label class="form-check-label" for="qbpp_display_exit"><?php esc_html_e('Display on exit', 'quick-build-promo-popup'); ?></label>
            </div>
        </div>
    </div>

    <!-- Popup Display Delay -->
    <div class="qbpp-group-wrap" id="qbppDisplayDelay" style="<?php echo ('1' !== $qbpp_popup_display && !empty($qbpp_popup_display)) ? 'display:none;' : ''; ?>">
        <div class="qbpp-label-box">
            <label for="qbpp_display_popup_delay"><?php esc_html_e('Display Popup Delay', 'quick-build-promo-popup'); ?></label>
            <span class="qbpp-label-info"><?php esc_html_e('[ e.g. 3 seconds ]', 'quick-build-promo-popup'); ?></span>
        </div>
        <div class="qbpp-field-box">
            <input type="number" class="form-control" id="qbpp_display_popup_delay" placeholder="3" name="qbpp_display_popup_delay" value="<?php echo esc_attr($qbpp_display_popup_delay); ?>">
        </div>
    </div>

    <!-- Popup Element Selector -->
    <div class="qbpp-group-wrap" id="qbppElementSelector" style="<?php echo ('2' !== $qbpp_popup_display) ? 'display:none;' : ''; ?>">
        <div class="qbpp-label-box">
            <label for="qbpp_element_selector"><?php esc_html_e('Popup Element Selector', 'quick-build-promo-popup'); ?></label>
        </div>
        <div class="qbpp-field-box">
            <input type="text" class="form-control" id="qbpp_element_selector" name="qbpp_element_selector" placeholder="#demoElement" value="<?php echo esc_attr($qbpp_element_selector); ?>">
        </div>
    </div>

    <!-- Auto Hide Popup -->
    <div class="qbpp-group-wrap">
        <div class="qbpp-label-box">
            <label class="col-form-label"><?php esc_html_e('Auto Hide Popup', 'quick-build-promo-popup'); ?></label>
        </div>
        <div class="qbpp-field-box">
            <input type="hidden" name="qbpp_popup_auto_hide" value="0">
            <input type="checkbox" id="qbpp_popup_auto_hide" name="qbpp_popup_auto_hide" value="1" <?php echo 1 == $qbpp_popup_auto_hide ? esc_attr_e('checked', 'quick-build-promo-popup') : ''; ?>>
            <label class="form-check-label" for="qbpp_popup_auto_hide"><?php esc_html_e('Hide', 'quick-build-promo-popup'); ?></label>

            <!-- Popup Hide Delay -->
            <div class="qbpp-group-wrap qbpp-popup-hide-delay" id="qbppPopupHideDelay" style="<?php echo (1 != $qbpp_popup_auto_hide) ? 'display:none;' : ''; ?>">
                <label for="qbpp_popup_hide_delay"><?php esc_html_e('Hide Popup Delay:', 'quick-build-promo-popup'); ?></label>
                <input type="number" class="form-control" id="qbpp_popup_hide_delay" placeholder="3" name="qbpp_popup_hide_delay" value="<?php echo esc_attr($qbpp_popup_hide_delay); ?>">
                <span class="qbpp-label-info"><?php esc_html_e('[ e.g. 3 seconds ]', 'quick-build-promo-popup'); ?></span>
            </div>
        </div>
    </div>

    <!-- Popup Image Size -->
    <div class="qbpp-group-wrap">
        <div class="qbpp-label-box">
            <label class="col-form-label" for="qbpp_popup_size"><?php esc_html_e('Popup Image Size', 'quick-build-promo-popup'); ?></label>
        </div>
        <div class="qbpp-field-box qbpp-popup-size">
            <select id="qbpp_popup_size" name="qbpp_popup_size" class="form-control">
                <?php foreach ($qbpp_size_options as $key => $qbpp_size_option) :
                    $selected = ($key == $qbpp_popup_size) ? 'selected' : '';
                ?>
                    <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($qbpp_size_option); ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Custom Size Options -->
            <div class="qbpp-custom-size" id="qbppCustomSize" style="<?php echo ('custom' != $qbpp_popup_size) ? 'display:none;' : ''; ?>">
                <div class="pull-left">
                    <label for="qbpp_custom_width"><?php esc_html_e('Width', 'quick-build-promo-popup'); ?></label>
                    <input type="number" class="form-control" id="qbpp_custom_width" name="qbpp_custom_width" placeholder="700" value="<?php echo esc_attr($qbpp_custom_width); ?>">
                </div>
                <div class="pull-right">
                    <label for="qbpp_custom_height"><?php esc_html_e('Height', 'quick-build-promo-popup'); ?></label>
                    <input type="text" class="form-control" id="qbpp_custom_height" name="qbpp_custom_height" placeholder="500" value="<?php echo esc_attr($qbpp_custom_height); ?>">
                </div>
            </div>

            <!-- Information Labels -->
            <div class="qbpp-label-info" id="qbppFitScreenInfo" style="<?php echo ('fit-screen' != $qbpp_popup_size && !empty($qbpp_popup_size)) ? 'display:none;' : ''; ?>"><?php esc_html_e('[ e.g. uploaded image is size to fit the screen. ]', 'quick-build-promo-popup'); ?></div>
            <div class="qbpp-label-info" id="qbppOriginalInfo" style="<?php echo ('original' != $qbpp_popup_size) ? 'display:none;' : ''; ?>"><?php esc_html_e('[ e.g. uploaded the image in its actual size. ]', 'quick-build-promo-popup'); ?></div>
            <div class="qbpp-label-info" id="qbppLandscapeInfo" style="<?php echo ('landscape' != $qbpp_popup_size) ? 'display:none;' : ''; ?>"><?php esc_html_e('[ e.g. width: 800px; height: calc(800px * 2 / 3) ]', 'quick-build-promo-popup'); ?></div>
            <div class="qbpp-label-info" id="qbppPortraitInfo" style="<?php echo ('portrait' != $qbpp_popup_size) ? 'display:none;' : ''; ?>"><?php esc_html_e('[ e.g. width: 1024px; height: calc(1024px * 2 / 3) ]', 'quick-build-promo-popup'); ?></div>
        </div>
    </div>
</div>