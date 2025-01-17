<?php
$qbpp_template_lists = [
    'template1' => esc_html__('Template 1', 'quick-build-promo-popup'),
    'template2' => esc_html__('Template 2', 'quick-build-promo-popup')
]
?>

  <!-- Popup Template -->
<div class="qbpp-group-wrap">
    <div class="qbpp-label-box">
        <label class="col-form-label"><?php esc_html_e('Select a template', 'quick-build-promo-popup'); ?></label>
    </div>
    <div class="qbpp-field-box">
        <div class="template-wrapper grid-col-auto">
            <?php foreach ($qbpp_template_lists as $key => $template):
                $qbpp_template = get_post_meta($post->ID, '_qbpp_template', true);
                $qbpp_checked = ($key === $qbpp_template) ? 'checked' : '';
            ?>
                <label for="<?php echo esc_attr($key); ?>" class="radio-card">
                    <input type="radio" name="qbpp_template" id="<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($qbpp_checked); ?> />
                    <div class="card-content-wrapper">
                        <span class="check-icon"></span>
                        <div class="card-content">
                            <img src="<?php echo esc_url(QBPP_ADMIN_DIR . '/images/' . esc_attr($key) . '.png'); ?>" alt="Template image" />
                        </div>
                    </div>
                </label>
            <?php endforeach; ?>

            <!-- cooming soon -->
            <?php for ($i = 1; $i <= 4; $i++) : ?>
                <label class="radio-card qbpp-cooming-soon">
                    <div class="card-content-wrapper">
                        <h3><?php echo esc_html_e('Cooming Soon', 'quick-build-promo-popup'); ?></h3>
                    </div>
                </label>
            <?php endfor; ?>
        </div>
    </div>
</div>