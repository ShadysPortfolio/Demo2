<?php 

function codevz_headers_preset( $k = 'x' ) {
$h = array();

$h['reset'] = array ( 'header_preset' => '', 'social_hover_fx' => '', 'social_color_mode' => '', 'social_inline_title' => '', 'social_tooltip' => '', '_css_social' => '', '_css_social_tablet' => '', '_css_social_mobile' => '', '_css_social_a' => '', '_css_social_a_tablet' => '', '_css_social_a_mobile' => '', '_css_social_a_hover' => '', '_css_social_a_hover_tablet' => '', '_css_social_a_hover_mobile' => '', '_css_social_inline_titles' => '', '_css_social_inline_titles_tablet' => '', '_css_social_inline_titles_mobile' => '', '_css_social_tooltip' => '', '_css_social_tooltip_tablet' => '', '_css_social_tooltip_mobile' => '', 'row_type_header_1' => '', 'page_as_row_header_1' => '', 'header_1_left' => '', 'header_1_center' => '', 'header_1_right' => '', '_css_container_header_1' => '', '_css_container_header_1_tablet' => '', '_css_container_header_1_mobile' => '', '_css_row_header_1' => '', '_css_row_header_1_tablet' => '', '_css_row_header_1_mobile' => '', '_css_header_1_left' => '', '_css_header_1_left_tablet' => '', '_css_header_1_left_mobile' => '', '_css_header_1_center' => '', '_css_header_1_center_tablet' => '', '_css_header_1_center_mobile' => '', '_css_header_1_right' => '', '_css_header_1_right_tablet' => '', '_css_header_1_right_mobile' => '', '_css_menu_container_header_1' => '', '_css_menu_container_header_1_tablet' => '', '_css_menu_container_header_1_mobile' => '', '_css_menu_li_header_1' => '', '_css_menu_li_header_1_tablet' => '', '_css_menu_li_header_1_mobile' => '', '_css_menu_a_header_1' => '', '_css_menu_a_header_1_tablet' => '', '_css_menu_a_header_1_mobile' => '', '_css_menu_a_hover_header_1' => '', '_css_menu_a_hover_header_1_tablet' => '', '_css_menu_a_hover_header_1_mobile' => '', '_css_menu_a_hover_before_header_1' => '', '_css_menu_a_hover_before_header_1_tablet' => '', '_css_menu_a_hover_before_header_1_mobile' => '', '_css_menu_indicator_a_header_1' => '', '_css_menu_a_indicator_header_1_tablet' => '', '_css_menu_a_indicator_header_1_mobile' => '', '_css_menus_separator_header_1' => '', '_css_menus_separator_header_1_tablet' => '', '_css_menus_separator_header_1_mobile' => '', '_css_menu_ul_header_1' => '', '_css_menu_ul_header_1_tablet' => '', '_css_menu_ul_header_1_mobile' => '', '_css_menu_ul_a_header_1' => '', '_css_menu_ul_a_header_1_tablet' => '', '_css_menu_ul_a_header_1_mobile' => '', '_css_menu_ul_a_hover_header_1' => '', '_css_menu_ul_a_hover_header_1_tablet' => '', '_css_menu_ul_a_hover_header_1_mobile' => '', '_css_menu_ul_indicator_a_header_1' => '', '_css_menu_ul_indicator_a_header_1_tablet' => '', '_css_menu_ul_indicator_a_header_1_mobile' => '', '_css_menu_ul_ul_header_1' => '', '_css_menu_ul_ul_header_1_tablet' => '', '_css_menu_ul_ul_header_1_mobile' => '', '_css_menu_inner_megamenu_header_1' => '', '_css_menu_inner_megamenu_header_1_tablet' => '', '_css_menu_inner_megamenu_header_1_mobile' => '', 'row_type_header_2' => '', 'page_as_row_header_2' => '', 'header_2_left' => '', 'header_2_center' => '', 'header_2_right' => '', '_css_container_header_2' => '', '_css_container_header_2_tablet' => '', '_css_container_header_2_mobile' => '', '_css_row_header_2' => '', '_css_row_header_2_tablet' => '', '_css_row_header_2_mobile' => '', '_css_header_2_left' => '', '_css_header_2_left_tablet' => '', '_css_header_2_left_mobile' => '', '_css_header_2_center' => '', '_css_header_2_center_tablet' => '', '_css_header_2_center_mobile' => '', '_css_header_2_right' => '', '_css_header_2_right_tablet' => '', '_css_header_2_right_mobile' => '', '_css_menu_container_header_2' => '', '_css_menu_container_header_2_tablet' => '', '_css_menu_container_header_2_mobile' => '', '_css_menu_li_header_2' => '', '_css_menu_li_header_2_tablet' => '', '_css_menu_li_header_2_mobile' => '', '_css_menu_a_header_2' => '', '_css_menu_a_header_2_tablet' => '', '_css_menu_a_header_2_mobile' => '', '_css_menu_a_hover_header_2' => '', '_css_menu_a_hover_header_2_tablet' => '', '_css_menu_a_hover_header_2_mobile' => '', '_css_menu_a_hover_before_header_2' => '', '_css_menu_a_hover_before_header_2_tablet' => '', '_css_menu_a_hover_before_header_2_mobile' => '', '_css_menu_indicator_a_header_2' => '', '_css_menu_a_indicator_header_2_tablet' => '', '_css_menu_a_indicator_header_2_mobile' => '', '_css_menus_separator_header_2' => '', '_css_menus_separator_header_2_tablet' => '', '_css_menus_separator_header_2_mobile' => '', '_css_menu_ul_header_2' => '', '_css_menu_ul_header_2_tablet' => '', '_css_menu_ul_header_2_mobile' => '', '_css_menu_ul_a_header_2' => '', '_css_menu_ul_a_header_2_tablet' => '', '_css_menu_ul_a_header_2_mobile' => '', '_css_menu_ul_a_hover_header_2' => '', '_css_menu_ul_a_hover_header_2_tablet' => '', '_css_menu_ul_a_hover_header_2_mobile' => '', '_css_menu_ul_indicator_a_header_2' => '', '_css_menu_ul_indicator_a_header_2_tablet' => '', '_css_menu_ul_indicator_a_header_2_mobile' => '', '_css_menu_ul_ul_header_2' => '', '_css_menu_ul_ul_header_2_tablet' => '', '_css_menu_ul_ul_header_2_mobile' => '', '_css_menu_inner_megamenu_header_2' => '', '_css_menu_inner_megamenu_header_2_tablet' => '', '_css_menu_inner_megamenu_header_2_mobile' => '', 'row_type_header_3' => '', 'page_as_row_header_3' => '', 'header_3_left' => '', 'header_3_center' => '', 'header_3_right' => '', '_css_container_header_3' => '', '_css_container_header_3_tablet' => '', '_css_container_header_3_mobile' => '', '_css_row_header_3' => '', '_css_row_header_3_tablet' => '', '_css_row_header_3_mobile' => '', '_css_header_3_left' => '', '_css_header_3_left_tablet' => '', '_css_header_3_left_mobile' => '', '_css_header_3_center' => '', '_css_header_3_center_tablet' => '', '_css_header_3_center_mobile' => '', '_css_header_3_right' => '', '_css_header_3_right_tablet' => '', '_css_header_3_right_mobile' => '', '_css_menu_container_header_3' => '', '_css_menu_container_header_3_tablet' => '', '_css_menu_container_header_3_mobile' => '', '_css_menu_li_header_3' => '', '_css_menu_li_header_3_tablet' => '', '_css_menu_li_header_3_mobile' => '', '_css_menu_a_header_3' => '', '_css_menu_a_header_3_tablet' => '', '_css_menu_a_header_3_mobile' => '', '_css_menu_a_hover_header_3' => '', '_css_menu_a_hover_header_3_tablet' => '', '_css_menu_a_hover_header_3_mobile' => '', '_css_menu_a_hover_before_header_3' => '', '_css_menu_a_hover_before_header_3_tablet' => '', '_css_menu_a_hover_before_header_3_mobile' => '', '_css_menu_indicator_a_header_3' => '', '_css_menu_a_indicator_header_3_tablet' => '', '_css_menu_a_indicator_header_3_mobile' => '', '_css_menus_separator_header_3' => '', '_css_menus_separator_header_3_tablet' => '', '_css_menus_separator_header_3_mobile' => '', '_css_menu_ul_header_3' => '', '_css_menu_ul_header_3_tablet' => '', '_css_menu_ul_header_3_mobile' => '', '_css_menu_ul_a_header_3' => '', '_css_menu_ul_a_header_3_tablet' => '', '_css_menu_ul_a_header_3_mobile' => '', '_css_menu_ul_a_hover_header_3' => '', '_css_menu_ul_a_hover_header_3_tablet' => '', '_css_menu_ul_a_hover_header_3_mobile' => '', '_css_menu_ul_indicator_a_header_3' => '', '_css_menu_ul_indicator_a_header_3_tablet' => '', '_css_menu_ul_indicator_a_header_3_mobile' => '', '_css_menu_ul_ul_header_3' => '', '_css_menu_ul_ul_header_3_tablet' => '', '_css_menu_ul_ul_header_3_mobile' => '', '_css_menu_inner_megamenu_header_3' => '', '_css_menu_inner_megamenu_header_3_tablet' => '', '_css_menu_inner_megamenu_header_3_mobile' => '', 'sticky_header' => '', 'smart_sticky' => '', 'header_5_left' => '', 'header_5_center' => '', 'header_5_right' => '', '_css_container_header_5' => '', '_css_container_header_5_tablet' => '', '_css_container_header_5_mobile' => '', '_css_row_header_5' => '', '_css_row_header_5_tablet' => '', '_css_row_header_5_mobile' => '', '_css_header_5_left' => '', '_css_header_5_left_tablet' => '', '_css_header_5_left_mobile' => '', '_css_header_5_center' => '', '_css_header_5_center_tablet' => '', '_css_header_5_center_mobile' => '', '_css_header_5_right' => '', '_css_header_5_right_tablet' => '', '_css_header_5_right_mobile' => '', '_css_menu_container_header_5' => '', '_css_menu_container_header_5_tablet' => '', '_css_menu_container_header_5_mobile' => '', '_css_menu_li_header_5' => '', '_css_menu_li_header_5_tablet' => '', '_css_menu_li_header_5_mobile' => '', '_css_menu_a_header_5' => '', '_css_menu_a_header_5_tablet' => '', '_css_menu_a_header_5_mobile' => '', '_css_menu_a_hover_header_5' => '', '_css_menu_a_hover_header_5_tablet' => '', '_css_menu_a_hover_header_5_mobile' => '', '_css_menu_a_hover_before_header_5' => '', '_css_menu_a_hover_before_header_5_tablet' => '', '_css_menu_a_hover_before_header_5_mobile' => '', '_css_menu_indicator_a_header_5' => '', '_css_menu_a_indicator_header_5_tablet' => '', '_css_menu_a_indicator_header_5_mobile' => '', '_css_menus_separator_header_5' => '', '_css_menus_separator_header_5_tablet' => '', '_css_menus_separator_header_5_mobile' => '', '_css_menu_ul_header_5' => '', '_css_menu_ul_header_5_tablet' => '', '_css_menu_ul_header_5_mobile' => '', '_css_menu_ul_a_header_5' => '', '_css_menu_ul_a_header_5_tablet' => '', '_css_menu_ul_a_header_5_mobile' => '', '_css_menu_ul_a_hover_header_5' => '', '_css_menu_ul_a_hover_header_5_tablet' => '', '_css_menu_ul_a_hover_header_5_mobile' => '', '_css_menu_ul_indicator_a_header_5' => '', '_css_menu_ul_indicator_a_header_5_tablet' => '', '_css_menu_ul_indicator_a_header_5_mobile' => '', '_css_menu_ul_ul_header_5' => '', '_css_menu_ul_ul_header_5_tablet' => '', '_css_menu_ul_ul_header_5_mobile' => '', '_css_menu_inner_megamenu_header_5' => '', '_css_menu_inner_megamenu_header_5_tablet' => '', '_css_menu_inner_megamenu_header_5_mobile' => '', 'row_type_header_4' => '', 'page_as_row_header_4' => '', 'mobile_header' => '', 'mobile_sticky' => '', 'header_4_left' => '', 'header_4_center' => '', 'header_4_right' => '', '_css_container_header_4' => '', '_css_container_header_4_tablet' => '', '_css_container_header_4_mobile' => '', '_css_row_header_4' => '', '_css_row_header_4_tablet' => '', '_css_row_header_4_mobile' => '', '_css_header_4_left' => '', '_css_header_4_left_tablet' => '', '_css_header_4_left_mobile' => '', '_css_header_4_center' => '', '_css_header_4_center_tablet' => '', '_css_header_4_center_mobile' => '', '_css_header_4_right' => '', '_css_header_4_right_tablet' => '', '_css_header_4_right_mobile' => '', '_css_menu_container_header_4' => '', '_css_menu_container_header_4_tablet' => '', '_css_menu_container_header_4_mobile' => '', '_css_menu_li_header_4' => '', '_css_menu_li_header_4_tablet' => '', '_css_menu_li_header_4_mobile' => '', '_css_menu_a_header_4' => '', '_css_menu_a_header_4_tablet' => '', '_css_menu_a_header_4_mobile' => '', '_css_menu_a_hover_header_4' => '', '_css_menu_a_hover_header_4_tablet' => '', '_css_menu_a_hover_header_4_mobile' => '', '_css_menu_a_hover_before_header_4' => '', '_css_menu_a_hover_before_header_4_tablet' => '', '_css_menu_a_hover_before_header_4_mobile' => '', '_css_menu_indicator_a_header_4' => '', '_css_menu_a_indicator_header_4_tablet' => '', '_css_menu_a_indicator_header_4_mobile' => '', '_css_menus_separator_header_4' => '', '_css_menus_separator_header_4_tablet' => '', '_css_menus_separator_header_4_mobile' => '', '_css_menu_ul_header_4' => '', '_css_menu_ul_header_4_tablet' => '', '_css_menu_ul_header_4_mobile' => '', '_css_menu_ul_a_header_4' => '', '_css_menu_ul_a_header_4_tablet' => '', '_css_menu_ul_a_header_4_mobile' => '', '_css_menu_ul_a_hover_header_4' => '', '_css_menu_ul_a_hover_header_4_tablet' => '', '_css_menu_ul_a_hover_header_4_mobile' => '', '_css_menu_ul_indicator_a_header_4' => '', '_css_menu_ul_indicator_a_header_4_tablet' => '', '_css_menu_ul_indicator_a_header_4_mobile' => '', '_css_menu_ul_ul_header_4' => '', '_css_menu_ul_ul_header_4_tablet' => '', '_css_menu_ul_ul_header_4_mobile' => '', '_css_menu_inner_megamenu_header_4' => '', '_css_menu_inner_megamenu_header_4_tablet' => '', '_css_menu_inner_megamenu_header_4_mobile' => '', 'fixed_side' => '', 'row_type_fixed_side_1' => '', 'page_as_row_fixed_side_1' => '', 'fixed_side_1_top' => '', 'fixed_side_1_middle' => '', 'fixed_side_1_bottom' => '', '_css_fixed_side_style' => '', '_css_fixed_side_style_tablet' => '', '_css_fixed_side_style_mobile' => '', '_css_fixed_side_1_top' => '', '_css_fixed_side_1_top_tablet' => '', '_css_fixed_side_1_top_mobile' => '', '_css_fixed_side_1_middle' => '', '_css_fixed_side_1_middle_tablet' => '', '_css_fixed_side_1_middle_mobile' => '', '_css_fixed_side_1_bottom' => '', '_css_fixed_side_1_bottom_tablet' => '', '_css_fixed_side_1_bottom_mobile' => '', '_css_menu_container_fixed_side_1' => '', '_css_menu_container_fixed_side_1_tablet' => '', '_css_menu_container_fixed_side_1_mobile' => '', '_css_menu_li_fixed_side_1' => '', '_css_menu_li_fixed_side_1_tablet' => '', '_css_menu_li_fixed_side_1_mobile' => '', '_css_menu_a_fixed_side_1' => '', '_css_menu_a_fixed_side_1_tablet' => '', '_css_menu_a_fixed_side_1_mobile' => '', '_css_menu_a_hover_fixed_side_1' => '', '_css_menu_a_hover_fixed_side_1_tablet' => '', '_css_menu_a_hover_fixed_side_1_mobile' => '', '_css_menu_a_hover_before_fixed_side_1' => '', '_css_menu_a_hover_before_fixed_side_1_tablet' => '', '_css_menu_a_hover_before_fixed_side_1_mobile' => '', '_css_menu_indicator_a_fixed_side_1' => '', '_css_menu_a_indicator_fixed_side_1_tablet' => '', '_css_menu_a_indicator_fixed_side_1_mobile' => '', '_css_menus_separator_fixed_side_1' => '', '_css_menus_separator_fixed_side_1_tablet' => '', '_css_menus_separator_fixed_side_1_mobile' => '', '_css_menu_ul_fixed_side_1' => '', '_css_menu_ul_fixed_side_1_tablet' => '', '_css_menu_ul_fixed_side_1_mobile' => '', '_css_menu_ul_a_fixed_side_1' => '', '_css_menu_ul_a_fixed_side_1_tablet' => '', '_css_menu_ul_a_fixed_side_1_mobile' => '', '_css_menu_ul_a_hover_fixed_side_1' => '', '_css_menu_ul_a_hover_fixed_side_1_tablet' => '', '_css_menu_ul_a_hover_fixed_side_1_mobile' => '', '_css_menu_ul_indicator_a_fixed_side_1' => '', '_css_menu_ul_indicator_a_fixed_side_1_tablet' => '', '_css_menu_ul_indicator_a_fixed_side_1_mobile' => '', '_css_menu_ul_ul_fixed_side_1' => '', '_css_menu_ul_ul_fixed_side_1_tablet' => '', '_css_menu_ul_ul_fixed_side_1_mobile' => '', '_css_menu_inner_megamenu_fixed_side_1' => '', '_css_menu_inner_megamenu_fixed_side_1_tablet' => '', '_css_menu_inner_megamenu_fixed_side_1_mobile' => '', '_css_header_container' => '', '_css_header_container_tablet' => '', '_css_header_container_mobile' => '', 'hidden_top_bar' => '', '_css_hidden_top_bar' => '', '_css_hidden_top_bar_tablet' => '', '_css_hidden_top_bar_mobile' => '', '_css_hidden_top_bar_handle' => '', '_css_hidden_top_bar_handle_tablet' => '', '_css_hidden_top_bar_handle_mobile' => '', );


$h['1'] = array (
  'social_hover_fx' => 'cz_social_fx_10',
  '_css_social_a' => 'color:#0a0a0a;font-size:16px;border-style:solid;border-radius:4px;',
  '_css_social_a_hover' => 'color:#edbb5f;',
  'header_1_right' => 
  array (
    0 => 
    array (
      'element' => 'social',
      'element_id' => 'header_1_right',
      'menu_location' => 'primary',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '9px',
        'bottom' => '7px',
        'left' => '20px',
      ),
    ),
    1 => 
    array (
      'element' => 'icon',
      'element_id' => 'header_1_right',
      'menu_location' => 'primary',
      'it_text' => '001 800-3334455',
      'it_link' => 'tel:0018003334455',
      'sk_it' => 'color:#000000;',
      'it_icon' => 'fa fa-phone',
      'sk_it_icon' => 'color:#000000;',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '6px',
        'bottom' => '10px',
        'left' => '30px',
      ),
    ),
    2 => 
    array (
      'element' => 'icon',
      'element_id' => 'header_1_right',
      'menu_location' => 'primary',
      'it_text' => 'Have any questions ?',
      'sk_it' => 'color:#000000;',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '6px',
        'bottom' => '10px',
      ),
    ),
  ),
  '_css_menu_a_header_1' => 'font-size:16px;padding: 6px  6px;',
  '_css_menu_a_hover_header_1' => 'color:#ffffff;',
  '_css_menu_a_hover_before_header_1' => '_class_menu_fx:cz_menu_fx_fade_in;border-style:solid;border-width:0px;border-radius:4px;',
  'header_2_left' => 
  array (
    0 => 
    array (
      'element' => 'logo',
      'element_id' => 'header_2_left',
      'menu_location' => 'primary',
      'menu_horizontal_dir' => 'inview_left',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '-15px',
        'bottom' => '-30px',
      ),
    ),
  ),
  'header_2_right' => 
  array (
    0 => 
    array (
      'element' => 'search',
      'element_id' => 'header_2_right',
      'menu_location' => 'primary',
      'search_type' => 'icon_dropdown',
      'ajax_search' => '1',
      'search_placeholder' => 'Type a keyword ...',
      'sk_search_input' => 'color:#ffffff;background-color:rgba(255,255,255,0.07);border-style:none;border-radius:0px;',
      'sk_search_con' => 'background-color:#191919;border-radius:0px;',
      'sk_search_icon' => 'color:#ffffff;',
      'sk_search_icon_in' => 'color:#ffffff;',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '8px',
        'bottom' => '8px',
        'left' => '10px',
      ),
    ),
    1 => 
    array (
      'element' => 'menu',
      'element_id' => 'header_2_right',
      'menu_location' => 'primary',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
    ),
  ),
  '_css_container_header_2' => 'background-color:#191919;',
  '_css_menu_a_header_2' => 'font-size:15px;color:#ffffff;padding:17px 17px 18px;margin-right:1px;',
  '_css_menu_a_hover_header_2' => 'color:#edbb5f;',
  '_css_menu_a_hover_before_header_2' => '_class_menu_fx:cz_menu_fx_unroll_h;background-color:rgba(237,187,95,0.1);width:100%;left:0px;border-style:solid;border-width:0px;border-radius:0px;',
  '_css_menu_indicator_a_header_2' => '_class_indicator:fa fa-angle-down;',
  '_css_menu_ul_header_2' => 'background-color:#191919;margin:0px 12px 1px 19px;border-style:solid;border-radius:0px;',
  '_css_menu_ul_a_header_2' => 'color:#ffffff;_class_indicator:fa fa-angle-right;',
  '_css_menu_ul_a_hover_header_2' => 'color:#edbb5f;',
  '_css_menu_ul_indicator_a_header_2' => '_class_indicator:fa fa-angle-right;',
  '_css_menu_ul_ul_header_2' => 'margin-top:-16px;margin-left:10px;',
  'sticky_header' => '2',
  'smart_sticky' => true,
  'header_4_left' => 
  array (
    0 => 
    array (
      'element' => 'logo',
      'element_id' => 'header_4_left',
      'logo_width' => '160px',
      'menu_location' => 'primary',
      'menu_horizontal_dir' => 'inview_left',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
    ),
  ),
  'header_4_right' => 
  array (
    0 => 
    array (
      'element' => 'menu',
      'element_id' => 'header_4_right',
      'menu_location' => 'primary',
      'menu_type' => 'offcanvas_menu_right',
      'menu_horizontal_dir' => 'inview_left',
      'sk_menu_icon' => 'color:#ffffff;',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '16px',
        'right' => '-10px',
        'bottom' => '16px',
      ),
    ),
    1 => 
    array (
      'element' => 'icon',
      'element_id' => 'header_4_right',
      'menu_location' => 'primary',
      'menu_type' => 'offcanvas_menu_right',
      'menu_horizontal_dir' => 'inview_left',
      'sk_menu_icon' => 'color:#ffffff;',
      'it_link' => 'tel:001234567',
      'it_icon' => 'fa fa-phone',
      'sk_it_icon' => 'font-size:22px;color:#ffffff;',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '22px',
        'bottom' => '16px',
      ),
    ),
  ),
  '_css_container_header_4' => 'background-color:#0a0a0a;',
  '_css_menu_a_hover_header_4' => 'color:#edbb5f;',
);


$h['2'] = array (
  'social_hover_fx' => 'cz_social_fx_1',
  'social_color_mode' => 'cz_social_colored_bg_hover',
  '_css_social_a' => 'font-size:16px;color:#ffffff;background-color:rgba(239,174,22,0.04);margin-left:3px;border-style:solid;border-radius:50px;',
  'header_1_left' => 
  array (
    0 => 
    array (
      'element' => 'icon',
      'element_id' => 'header_1_left',
      'menu_location' => 'primary',
      'it_text' => 'Hello, Welcome to Xtra Construnction website',
      'sk_it' => 'font-size:14px;color:#f2f2f2;',
      'it_icon' => 'fa fa-bolt',
      'sk_it_icon' => 'color:#f2f2f2;',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '10px',
        'bottom' => '10px',
        'left' => '20px',
      ),
    ),
  ),
  'header_1_right' => 
  array (
    0 => 
    array (
      'element' => 'icon',
      'element_id' => 'header_1_right',
      'menu_location' => 'primary',
      'it_text' => 'Free Consultation',
      'it_link' => '#popup',
      'sk_it' => 'font-size:14px;color:#f2f2f2;',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '9px',
        'right' => '25px',
      ),
    ),
    1 => 
    array (
      'element' => 'line',
      'element_id' => 'header_1_right',
      'menu_location' => 'primary',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_2',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '10px',
      ),
    ),
    2 => 
    array (
      'element' => 'social',
      'element_id' => 'header_1_right',
      'menu_location' => 'primary',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '11px',
      ),
    ),
  ),
  '_css_container_header_1' => 'background-color:#2e2e2e;',
  '_css_menu_a_header_1' => 'font-size:16px;padding: 6px  6px;',
  '_css_menu_a_hover_header_1' => 'color:#ffffff;',
  '_css_menu_a_hover_before_header_1' => '_class_menu_fx:cz_menu_fx_fade_in;border-style:solid;border-width:0px;border-radius:4px;',
  'header_2_left' => 
  array (
    0 => 
    array (
      'element' => 'logo',
      'element_id' => 'header_2_left',
      'menu_location' => 'primary',
      'menu_horizontal_dir' => 'inview_left',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '10px',
        'bottom' => '10px',
        'left' => '20px',
      ),
    ),
  ),
  'header_2_right' => 
  array (
    0 => 
    array (
      'element' => 'custom_element',
      'element_id' => 'header_2_right',
      'menu_location' => 'primary',
      'menu_horizontal_dir' => 'inview_left',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'header_elements' => '603',
      'margin' => 
      array (
        'top' => '24px',
        'right' => '20px',
        'bottom' => '22px',
      ),
    ),
  ),
  '_css_container_header_2' => 'background-color:#ffffff;',
  '_css_menu_a_header_2' => 'padding: 6px  6px;',
  '_css_menu_a_hover_header_2' => 'color:#ffffff;',
  '_css_menu_a_hover_before_header_2' => '_class_menu_fx:cz_menu_fx_fade_in;border-style:solid;border-width:0px;border-radius:4px;',
  '_css_menu_ul_header_2' => 'background-color:#efae16;margin:1px 12px;border-style:solid;border-radius:4px;',
  '_css_menu_ul_a_header_2' => 'color:#ffffff;',
  '_css_menu_ul_a_hover_header_2' => 'color:#e2e2e2;',
  'header_3_left' => 
  array (
    0 => 
    array (
      'element' => 'menu',
      'element_id' => 'header_3_left',
      'menu_location' => 'primary',
      'menu_horizontal_dir' => 'inview_left',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '8px',
        'bottom' => '8px',
        'left' => '8px',
      ),
    ),
  ),
  'header_3_right' => 
  array (
    0 => 
    array (
      'element' => 'button',
      'element_id' => 'header_3_right',
      'menu_location' => 'primary',
      'menu_horizontal_dir' => 'inview_left',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'btn_title' => 'Start Project',
      'btn_link' => 'http://xtratheme.com/building/contact/',
      'sk_btn' => 'font-size:14px;color:#0a0a0a;font-weight:700;padding:7px 25px 6px;display:block;',
      'wpml_title' => 'translated_name',
      'avatar_size' => '40px',
      'margin' => 
      array (
        'top' => '8px',
        'right' => '8px',
        'bottom' => '8px',
      ),
    ),
  ),
  '_css_container_header_3' => 'margin-bottom:-30px;',
  '_css_row_header_3' => 'background-color:#2e2e2e;border-style:solid;border-radius:50px;',
  '_css_menu_a_header_3' => 'font-size:15px;color:#ffffff;padding:6px 17px 7px;margin:0px 5px 0px 0px;',
  '_css_menu_a_hover_header_3' => 'color:#0a0000;',
  '_css_menu_a_hover_before_header_3' => 'background-color:#efae16;_class_menu_fx:cz_menu_fx_zoom_out;width:100%;left:0px;border-style:solid;border-width:0px;border-radius:50px;',
  '_css_menu_indicator_a_header_3' => '_class_indicator:fa fa-angle-down;',
  '_css_menu_ul_header_3' => 'background-color:#2e2e2e;margin:10px 11px 0px 23px;border-style:solid;border-radius:15px;',
  '_css_menu_ul_a_header_3' => 'font-size:14px;color:#ffffff;',
  '_css_menu_ul_a_hover_header_3' => 'color:#e5e5e5;',
  '_css_menu_ul_indicator_a_header_3' => '_class_indicator:fa fa-angle-right;',
  '_css_menu_ul_ul_header_3' => 'margin-top:-10px;margin-left:12px;',
  'smart_sticky' => true,
  '_css_container_header_5' => 'background-color:#2e2e2e;',
  'header_4_left' => 
  array (
    0 => 
    array (
      'element' => 'logo',
      'element_id' => 'header_4_left',
      'logo_width' => '160px',
      'menu_location' => 'primary',
      'menu_horizontal_dir' => 'inview_left',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '6px',
        'bottom' => '6px',
        'left' => '-10px',
      ),
    ),
  ),
  'header_4_right' => 
  array (
    0 => 
    array (
      'element' => 'menu',
      'element_id' => 'header_4_right',
      'menu_location' => 'primary',
      'menu_type' => 'offcanvas_menu_right',
      'menu_horizontal_dir' => 'inview_left',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '14px',
        'right' => '-10px',
      ),
    ),
    1 => 
    array (
      'element' => 'icon',
      'element_id' => 'header_4_right',
      'menu_location' => 'primary',
      'menu_type' => 'offcanvas_menu_right',
      'menu_horizontal_dir' => 'inview_left',
      'it_link' => 'tel:0018184455666',
      'it_icon' => 'fa fa-phone',
      'sk_it_icon' => 'font-size:22px;',
      'search_type' => 'icon_full',
      'ajax_search' => '1',
      'search_placeholder' => 'Search ...',
      'sk_search_input' => 'padding-top:10px;padding-bottom:10px;margin-top:10px;border-radius:10px;',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '21px',
      ),
    ),
  ),
  '_css_container_header_4' => 'border-style:solid;border-width:0 0 1px;border-color:#f4f4f4;',
  '_css_menu_container_header_4' => 'background-size:cover;background-image:linear-gradient(90deg,rgba(239,174,22,0.8),rgba(239,174,22,0.8)),url(http://xtratheme.com/building/wp-content/uploads/sites/9/2017/06/p5-1.jpg);padding:30px;',
  '_css_menu_a_header_4' => 'margin-bottom:10px;border-radius:32px;',
  '_css_menu_a_hover_header_4' => 'color:#efae16;background-color:#000000;padding-left:30px;',
);


$h['3'] = array (
  'social_hover_fx' => 'cz_social_fx_1',
  '_css_social_a' => 'font-size:13px;color:#ffffff;background-color:#1e4686;padding:2px;margin-left:2px;',
  '_css_social_a_hover' => 'color:#1e4686;background-color:#ffffff;',
  'header_1_left' => 
  array (
    0 => 
    array (
      'element' => 'icon',
      'element_id' => 'header_1_left',
      'menu_location' => 'primary',
      'it_text' => 'Call Us +1 (800) 333 44 55',
      'it_link' => 'tel:0018003334455',
      'sk_it' => 'color:#ffffff;margin-top:2px;',
      'it_icon' => 'fa fa-phone',
      'sk_it_icon' => 'font-size:13px;color:#ffffff;background-color:#1e4686;padding:5px;',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '11px',
        'bottom' => '10px',
        'left' => '2px',
      ),
    ),
  ),
  'header_1_right' => 
  array (
    0 => 
    array (
      'element' => 'social',
      'element_id' => 'header_1_right',
      'menu_location' => 'primary',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '10px',
        'bottom' => '0px',
      ),
    ),
  ),
  '_css_container_header_1' => 'background-color:#86acd1;border-style:solid;border-width:0 0 1px 0;border-color:#eeeeee;',
  '_css_menu_a_header_1' => 'font-size:16px;padding: 6px  6px;',
  '_css_menu_a_hover_header_1' => 'color:#ffffff;',
  '_css_menu_a_hover_before_header_1' => '_class_menu_fx:cz_menu_fx_fade_in;border-style:solid;border-width:0px;border-radius:4px;',
  '_css_menu_ul_header_1' => 'border-radius:0px;',
  'header_2_left' => 
  array (
    0 => 
    array (
      'element' => 'logo',
      'element_id' => 'header_2_left',
      'logo_width' => '190px',
      'menu_location' => 'primary',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '25px',
        'bottom' => '25px',
      ),
    ),
  ),
  'header_2_right' => 
  array (
    0 => 
    array (
      'element' => 'search',
      'element_id' => 'header_2_right',
      'menu_location' => 'primary',
      'search_type' => 'icon_dropdown',
      'ajax_search' => '1',
      'search_placeholder' => 'Type a keyword ...',
      'sk_search_icon' => 'font-size:15px;color:#ffffff;background-color:#1e4686;padding:2px;border-radius:0px;',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '30px',
        'left' => '-10px',
      ),
    ),
    1 => 
    array (
      'element' => 'menu',
      'element_id' => 'header_2_right',
      'menu_location' => 'primary',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '27px',
        'bottom' => '32px',
      ),
    ),
  ),
  '_css_container_header_2' => 'background-color:#ffffff;border-style:solid;border-width:0 0 1px;border-color:#f4f4f4;',
  '_css_menu_a_header_2' => 'color:#383838;font-size:15px;font-weight:500;letter-spacing:1px;padding: 6px  6px;',
  '_css_menu_a_hover_header_2' => 'color:#1e4686;',
  '_css_menu_a_hover_before_header_2' => '_class_menu_fx:cz_menu_fx_fade_in;height:2px;width:15px;left:7px;border-style:solid;border-width:0px;border-radius:0px;',
  '_css_menu_ul_header_2' => 'background-color:#1e4686;margin:1px   27px;border-style:solid;border-radius:0px;',
  '_css_menu_ul_a_header_2' => 'color:#ffffff;',
  '_css_menu_ul_a_hover_header_2' => 'color:#e2e2e2;',
  '_css_menu_ul_ul_header_2' => 'margin:-16px   10px;',
  'sticky_header' => '2',
  'smart_sticky' => true,
  'mobile_sticky' => 'header_is_sticky',
  'header_4_left' => 
  array (
    0 => 
    array (
      'element' => 'logo',
      'element_id' => 'header_4_left',
      'logo_width' => '140px',
      'menu_location' => 'primary',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'left' => '5px',
        'top' => '20px',
        'bottom' => '20px',
      ),
    ),
  ),
  'header_4_right' => 
  array (
    0 => 
    array (
      'element' => 'menu',
      'element_id' => 'header_4_right',
      'menu_location' => 'primary',
      'menu_type' => 'offcanvas_menu_right',
      'sk_menu_icon' => 'font-size:16px;color:#ffffff;background-color:#1e4686;border-radius:0px;',
      'search_type' => 'form',
      'inview_position_widget' => 'inview_left',
      'shopcart_type' => 'cart_1',
      'line_type' => 'header_line_1',
      'wpml_title' => 'translated_name',
      'margin' => 
      array (
        'top' => '22px',
        'right' => '3px',
      ),
    ),
  ),
  '_css_container_header_4' => 'background-color:#ffffff;border-style:solid;border-width:0 0 1px;border-color:#f4f4f4;',
  '_css_menu_container_header_4' => 'background-color:#1e4686;',
  '_css_menu_a_header_4' => 'color:rgba(255,255,255,0.7);',
  '_css_menu_a_hover_header_4' => 'color:#ffffff;',
  '_css_menu_ul_a_header_4' => 'font-size:12px;color:rgba(255,255,255,0.7);',
);


	if ( isset( $h[ $k ] ) ) {
		return $h[ $k ];
	}
}