<?php
/**
 * Required plugins
 *
 * @package NEXIO
 * @since NEXIO 1.76.0
 */

// THEME-SUPPORTED PLUGINS
// If plugin not need - remove its settings from next array
//----------------------------------------------------------
$nexio_theme_required_plugins_groups = array(
	'core'          => esc_html__( 'Core', 'nexio' ),
	'page_builders' => esc_html__( 'Page Builders', 'nexio' ),
	'ecommerce'     => esc_html__( 'E-Commerce & Donations', 'nexio' ),
	'socials'       => esc_html__( 'Socials and Communities', 'nexio' ),
	'events'        => esc_html__( 'Events and Appointments', 'nexio' ),
	'content'       => esc_html__( 'Content', 'nexio' ),
	'other'         => esc_html__( 'Other', 'nexio' ),
);
$nexio_theme_required_plugins        = array(
	'trx_addons'                 => array(
		'title'       => esc_html__( 'ThemeREX Addons', 'nexio' ),
		'description' => esc_html__( "Will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'nexio' ),
		'required'    => true,
		'logo'        => 'trx_addons.png',
		'group'       => $nexio_theme_required_plugins_groups['core'],
	),
	'elementor'                  => array(
		'title'       => esc_html__( 'Elementor', 'nexio' ),
		'description' => esc_html__( "Is a beautiful PageBuilder, even the free version of which allows you to create great pages using a variety of modules.", 'nexio' ),
		'required'    => false,
		'logo'        => 'elementor.png',
		'group'       => $nexio_theme_required_plugins_groups['page_builders'],
	),
	'gutenberg'                  => array(
		'title'       => esc_html__( 'Gutenberg', 'nexio' ),
		'description' => esc_html__( "It's a posts editor coming in place of the classic TinyMCE. Can be installed and used in parallel with Elementor", 'nexio' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'gutenberg.png',
		'group'       => $nexio_theme_required_plugins_groups['page_builders'],
	),
	'js_composer'                => array(
		'title'       => esc_html__( 'WPBakery PageBuilder', 'nexio' ),
		'description' => esc_html__( "Popular PageBuilder which allows you to create excellent pages", 'nexio' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'js_composer.jpg',
		'group'       => $nexio_theme_required_plugins_groups['page_builders'],
	),
	'woocommerce'                => array(
		'title'       => esc_html__( 'WooCommerce', 'nexio' ),
		'description' => esc_html__( "Connect the store to your website and start selling now", 'nexio' ),
		'required'    => false,
                'install'     => false,
		'logo'        => 'woocommerce.png',
		'group'       => $nexio_theme_required_plugins_groups['ecommerce'],
	),
	'elegro-payment'             => array(
		'title'       => esc_html__( 'Elegro Crypto Payment', 'nexio' ),
		'description' => esc_html__( "Extends WooCommerce Payment Gateways with an elegro Crypto Payment", 'nexio' ),
		'required'    => false,
                'install'     => false,
		'logo'        => 'elegro-payment.png',
		'group'       => $nexio_theme_required_plugins_groups['ecommerce'],
	),
	'instagram-feed'             => array(
		'title'       => esc_html__( 'Instagram Feed', 'nexio' ),
		'description' => esc_html__( "Displays the latest photos from your profile on Instagram", 'nexio' ),
		'required'    => false,
		'logo'        => 'instagram-feed.png',
		'group'       => $nexio_theme_required_plugins_groups['socials'],
	),
	'mailchimp-for-wp'           => array(
		'title'       => esc_html__( 'MailChimp for WP', 'nexio' ),
		'description' => esc_html__( "Allows visitors to subscribe to newsletters", 'nexio' ),
		'required'    => false,
		'logo'        => 'mailchimp-for-wp.png',
		'group'       => $nexio_theme_required_plugins_groups['socials'],
	),
	'booked'                     => array(
		'title'       => esc_html__( 'Booked Appointments', 'nexio' ),
		'description' => '',
		'required'    => false,
                'install'     => false,
		'logo'        => 'booked.png',
		'group'       => $nexio_theme_required_plugins_groups['events'],
	),
	'the-events-calendar'        => array(
		'title'       => esc_html__( 'The Events Calendar', 'nexio' ),
		'description' => '',
		'required'    => false,
                'install'     => false,
		'logo'        => 'the-events-calendar.png',
		'group'       => $nexio_theme_required_plugins_groups['events'],
	),
	'contact-form-7'             => array(
		'title'       => esc_html__( 'Contact Form 7', 'nexio' ),
		'description' => esc_html__( "CF7 allows you to create an unlimited number of contact forms", 'nexio' ),
		'required'    => false,
		'logo'        => 'contact-form-7.png',
		'group'       => $nexio_theme_required_plugins_groups['content'],
	),

	'latepoint'                  => array(
		'title'       => esc_html__( 'LatePoint', 'nexio' ),
		'description' => '',
		'required'    => false,
                'install'     => false,
		'logo'        => nexio_get_file_url( 'plugins/latepoint/latepoint.png' ),
		'group'       => $nexio_theme_required_plugins_groups['events'],
	),
	'advanced-popups'                  => array(
		'title'       => esc_html__( 'Advanced Popups', 'nexio' ),
		'description' => '',
		'required'    => false,
		'logo'        => nexio_get_file_url( 'plugins/advanced-popups/advanced-popups.jpg' ),
		'group'       => $nexio_theme_required_plugins_groups['content'],
	),
	'devvn-image-hotspot'                  => array(
		'title'       => esc_html__( 'Image Hotspot by DevVN', 'nexio' ),
		'description' => '',
		'required'    => false,
                'install'     => false,
		'logo'        => nexio_get_file_url( 'plugins/devvn-image-hotspot/devvn-image-hotspot.png' ),
		'group'       => $nexio_theme_required_plugins_groups['content'],
	),
	'ti-woocommerce-wishlist'                  => array(
		'title'       => esc_html__( 'TI WooCommerce Wishlist', 'nexio' ),
		'description' => '',
		'required'    => false,
                'install'     => false,
		'logo'        => nexio_get_file_url( 'plugins/ti-woocommerce-wishlist/ti-woocommerce-wishlist.png' ),
		'group'       => $nexio_theme_required_plugins_groups['ecommerce'],
	),
	'woo-smart-quick-view'                  => array(
		'title'       => esc_html__( 'WPC Smart Quick View for WooCommerce', 'nexio' ),
		'description' => '',
		'required'    => false,
                'install'     => false,
		'logo'        => nexio_get_file_url( 'plugins/woo-smart-quick-view/woo-smart-quick-view.png' ),
		'group'       => $nexio_theme_required_plugins_groups['ecommerce'],
	),
	'twenty20'                  => array(
		'title'       => esc_html__( 'Twenty20 Image Before-After', 'nexio' ),
		'description' => '',
		'required'    => false,
        	'install'     => false,
		'logo'        => nexio_get_file_url( 'plugins/twenty20/twenty20.png' ),
		'group'       => $nexio_theme_required_plugins_groups['content'],
	),
	'essential-grid'             => array(
		'title'       => esc_html__( 'Essential Grid', 'nexio' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'essential-grid.png',
		'group'       => $nexio_theme_required_plugins_groups['content'],
	),
	'revslider'                  => array(
		'title'       => esc_html__( 'Revolution Slider', 'nexio' ),
		'description' => '',
		'required'    => false,
        	'install'     => false,
		'logo'        => 'revslider.png',
		'group'       => $nexio_theme_required_plugins_groups['content'],
	),
	'sitepress-multilingual-cms' => array(
		'title'       => esc_html__( 'WPML - Sitepress Multilingual CMS', 'nexio' ),
		'description' => esc_html__( "Allows you to make your website multilingual", 'nexio' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'sitepress-multilingual-cms.png',
		'group'       => $nexio_theme_required_plugins_groups['content'],
	),
	'wp-gdpr-compliance'         => array(
		'title'       => esc_html__( 'Cookie Information', 'nexio' ),
		'description' => esc_html__( "Allow visitors to decide for themselves what personal data they want to store on your site", 'nexio' ),
		'required'    => false,
		'logo'        => 'wp-gdpr-compliance.png',
		'group'       => $nexio_theme_required_plugins_groups['other'],
	),
	'trx_updater'                => array(
		'title'       => esc_html__( 'ThemeREX Updater', 'nexio' ),
		'description' => esc_html__( "Update theme and theme-specific plugins from developer's upgrade server.", 'nexio' ),
		'required'    => false,
		'logo'        => 'trx_updater.png',
		'group'       => $nexio_theme_required_plugins_groups['other'],
	),
);

if ( NEXIO_THEME_FREE ) {
	unset( $nexio_theme_required_plugins['js_composer'] );
	unset( $nexio_theme_required_plugins['booked'] );
	unset( $nexio_theme_required_plugins['the-events-calendar'] );
	unset( $nexio_theme_required_plugins['calculated-fields-form'] );
	unset( $nexio_theme_required_plugins['essential-grid'] );
	unset( $nexio_theme_required_plugins['revslider'] );
	unset( $nexio_theme_required_plugins['sitepress-multilingual-cms'] );
	unset( $nexio_theme_required_plugins['trx_updater'] );
	unset( $nexio_theme_required_plugins['trx_popup'] );
}

// Add plugins list to the global storage
nexio_storage_set( 'required_plugins', $nexio_theme_required_plugins );
