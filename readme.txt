=== Quick Build Promo Popup ===
Contributors: mofazzalhossain
Donate link: https://www.fiverr.com/mofazzal98
Tags: popup, promotion, discount, marketing
Requires at least: 4.7
Tested up to: 6.7.1
Stable tag: 1.0.0
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A versatile and user-friendly WordPress plugin that simplifies the creation, management, and customization of promotional popups and discounts.

== Description ==
Quick Build Promo Popup is a versatile and user-friendly WordPress plugin that simplifies the creation, management, and customization of promotional popups and discounts. This powerful tool empowers users to effortlessly design and control popups to suit their needs. 

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/quick-build-promo-popup` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the Quick Build Promo Popup settings page to configure the plugin.

== Features ==
1. **Create Unlimited Popups** – Design and display as many popups as needed without limitations.
2. **Customizable Content** – Add personalized text, images, and other elements to suit your needs.
3. **Flexible Display Events** – Trigger popups on page load, click, exit intent, or custom user interactions.
4. **Popup Display Delay** – Set a specific delay time before the popup appears.
5. **Automatic Closing** – Configure popups to close automatically after a set duration.
6. **Pre-designed Templates** – Choose from a variety of popup templates for quick setup.
7. **Responsive and Mobile-friendly** – Ensure popups look great on all devices, including desktops, tablets, and smartphones.

== Frequently Asked Questions ==

= How do I create a new popup? =
To create a new popup, go to the Quick Build Promo Popup settings page and follow the instructions to design and configure your popup.

= Can I use custom popup image? =
Yes, the plugin allows you to use custom images for your popups. You can upload and specify any image you want to display in your popup, enhancing its visual appeal and effectiveness.

= Can I use custom popup image size? =
Yes, the plugin allows you to customize the size of the popup images. You can specify the dimensions or aspect ratio that best suits your design and layout preferences.
= Can I use custom popup content? =
Yes, you can use custom content for your popups. The plugin allows you to fully customize the content, including text, images, videos, and more, to create unique and engaging promotional messages.

= Can the popup auto-show after a page load? =
Yes, the plugin includes an option to set the popup to automatically display when a page loads. You can configure this setting in the popup configuration options.

= Can I show popup after few seconds delay? =
Yes, the plugin includes an option to set the popup to display after a specified delay when a page loads. You can configure this setting in the popup configuration options.

= Can the popup show onclick? =
Yes, the plugin includes an option to set the popup to display when triggered by an onclick event. You can configure this setting by specifying the element/event selector name in the popup configuration options. For example, you can set it as `.demoElement` or `#demoElement` depending on your HTML structure and needs.

= Can the popup auto-hide after a few seconds? =
Yes, the plugin includes an option to set the popup to auto-hide after a specified number of seconds. You can configure this setting in the popup configuration options.

= How do I modify the modal header content? =
You can modify the modal header content by applying a filter in your theme or plugin code. Use the following example code snippet:

`<?php
function custom_qbcp_modal_header($header_content, $post_id) {
    // Modify the modal header content here
    $modified_content = 'Modified Modal Header Content';
    return $modified_content;
}
add_filter('qbpp_modal_header_content', 'custom_qbcp_modal_header',10,2);
?>`

= How do I modify the modal body content? =
You can modify the modal body content by applying a filter in your theme or plugin code. Use the following example code snippet:

`<?php
function custom_qbcp_modal_body($body_content, $post_id) {
    // Modify the modal body content here
    $modified_content = 'Modified Modal Body Content';
    return $modified_content;
}
add_filter('qbpp_modal_body_content', 'custom_qbcp_modal_body', 10, 2);
?>`


== Screenshots ==

1. **Popup Configuration** – This screenshot shows the popup configuration options available in the plugin.
   ![Popup Configuration](assets/screenshot-1.png) (assets/screenshot-3.png)
2. **Popup Templates** – This screenshot highlights the available popup templates in the plugin.
   ![Popup Templates](assets/screenshot-2.png)
3. **Popup List** – This screenshot highlights the list of popups in the plugin.
   ![Popup List](assets/screenshot-4.png)
3. **Popup Example** – This screenshot shows an example of a popup created with the plugin.
   ![Popup Example](assets/screenshot-4.png)

== Changelog ==


= 1.0.0 =
* Initial Release

== Upgrade Notice ==

= 1.0.0 =
* Initial release of Quick Build Promo Popup.


Modify The modal header content by applay filter:

`<?php code(); ?>`