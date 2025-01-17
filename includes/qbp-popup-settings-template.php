<?php

if (! defined('ABSPATH')) exit; // Exit if accessed directly
$qbp_tab_buttons = [
    'template' => esc_html__('Templates', 'quick-build-promo-popup'),
    'settings' => esc_html__('Settings Panel', 'quick-build-promo-popup'),
    'design' => esc_html__('Design Panel', 'quick-build-promo-popup'),
]
?>
<!-- tabs wrap -->
<div class="qbpp-tabs-wrap">
    <ul class="nav nav-tabs" id="qbppTabs" role="tablist">
        <!-- nav item -->
        <?php foreach ($qbp_tab_buttons as $key => $qbpp_tab_button):
            // icon based on key
            switch ($key) {
                case 'template':
                    $icon = 'terminal-window-fill';
                    break;
                case 'settings':
                    $icon = 'settings-2-line';
                    break;
                case 'design':
                    $icon = 'palette-fill';
                    break;
            }
            $qbpp_active = ($key == 'design') ? 'active' : '';
        ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?php echo esc_attr($qbpp_active); ?>" id="qbpp-<?php echo esc_attr($key); ?>-tab">
                    <i class="ri-<?php echo esc_attr($icon); ?>"></i>
                    <?php echo esc_html($qbpp_tab_button); ?>
                </button>
            </li>
        <?php endforeach; ?>
    </ul>
    <!-- tab content -->
    <div class="tab-content" id="qbppTabsContent">
        <?php foreach ($qbp_tab_buttons as $key => $qbpp_tab_button): 
            $qbpp_active = ($key == 'design') ? 'active' : '';
            ?>
            <div class="tab-pane <?php echo esc_attr($qbpp_active); ?>" id="qbpp-<?php echo esc_attr($key); ?>">
                <!-- include template panel -->
                <?php include 'templates/qbp-popup-' . $key . '-panel.php'; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>