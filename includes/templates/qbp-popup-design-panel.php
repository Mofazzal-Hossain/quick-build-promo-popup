<?php
$qbpp_color_fields = [
    'qbpp_background_color' => [
        'label' => __('Popup Background', 'quick-build-promo-popup'),
        'default' => '',
    ],
    'qbpp_paragraph_color' => [
        'label' => __('Color of all Paragraph / Text', 'quick-build-promo-popup'),
        'default' => '',
    ],
    'qbpp_heading_color' => [
        'label' => __('Color of all Headings', 'quick-build-promo-popup'),
        'default' => '',
    ],
    'qbpp_title_color' => [
        'label' => __('Popup Title Color', 'quick-build-promo-popup'),
        'default' => '',
    ],
    'qbpp_close_btn_bg' => [
        'label' => __('Close Button Background', 'quick-build-promo-popup'),
        'default' => '',
    ],
    'qbpp_close_icon_color' => [
        'label' => __('Close Button Icon Color', 'quick-build-promo-popup'),
        'default' => '',
    ],
    'qbpp_accent_color' => [
        'label' => __('Popup Accent Color', 'quick-build-promo-popup'),
        'default' => '',
    ],
    'qbpp_accent_hover_color' => [
        'label' => __('Popup Accent Hover Color', 'quick-build-promo-popup'),
        'default' => '',
    ],
];

foreach ($qbpp_color_fields as $name => $field) : ?>
    <div class="qbpp-group-wrap">
        <div class="qbpp-label-box">
            <label class="col-form-label"><?php echo esc_html($field['label']); ?></label>
        </div>
        <div class="qbpp-field-box">
            <input type="text" name="<?php echo esc_attr($name); ?>" class="qbpp-color-picker" value="<?php echo esc_attr($field['default']); ?>" />
        </div>
    </div>
<?php endforeach; ?>