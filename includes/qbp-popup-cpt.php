<?php

function qbpp_register_popup_cpt()
{

    /**
     * Post Type: qbp popup
     */

    $labels = [
        "name" => esc_html__("Popup", "quick-build-promo-popup"),
        "singular_name" => esc_html__("qbp-popup", "quick-build-promo-popup"),
        "menu_name" => esc_html__("Promo Popup", "quick-build-promo-popup"),
        "all_items" => esc_html__("All Popup", "quick-build-promo-popup"),
        "add_new" => esc_html__("Add New", "quick-build-promo-popup"),
        "add_new_item" => esc_html__("Add New", "quick-build-promo-popup"),
        "edit_item" => esc_html__("Edit Popup", "quick-build-promo-popup"),
        "new_item" => esc_html__("New Popup", "quick-build-promo-popup"),
        "view_item" => esc_html__("View Popup", "quick-build-promo-popup"),
        "view_items" => esc_html__("View Popups", "quick-build-promo-popup"),
        "search_items" => esc_html__("Search Popup", "quick-build-promo-popup"),
        "not_found" => esc_html__("No Popup Found", "quick-build-promo-popup"),
        "not_found_in_trash" => esc_html__("No Popups found in trash", "quick-build-promo-popup"),
        "parent" => esc_html__("Parent Popup", "quick-build-promo-popup"),
        "featured_image" => esc_html__("Popup image", "quick-build-promo-popup"),
        "set_featured_image" => esc_html__("Set Popup image", "quick-build-promo-popup"),
        "remove_featured_image" => esc_html__("Remove Popup image", "quick-build-promo-popup"),
        "use_featured_image" => esc_html__("Use as a Popup image", "quick-build-promo-popup"),
        "archives" => esc_html__("Popup Archives", "quick-build-promo-popup"),
        "parent_item_colon" => esc_html__("Parent Popup", "quick-build-promo-popup"),
    ];

    $args = [
        "label" => esc_html__("qbp Popup", "quick-build-promo-popup"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => true,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "can_export" => false,
        "rewrite" => ["slug" => "qbp-popup", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-plus-alt",
        "supports" => ["title"],
        "show_in_graphql" => false,
    ];

    register_post_type("qbp-popup", $args);
}

add_action('init', 'qbpp_register_popup_cpt');
