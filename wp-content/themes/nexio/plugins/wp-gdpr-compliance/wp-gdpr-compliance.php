<?php
/* WP GDPR Compliance support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'nexio_wp_gdpr_compliance_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'nexio_wp_gdpr_compliance_theme_setup9', 9 );
	function nexio_wp_gdpr_compliance_theme_setup9() {
		if ( is_admin() ) {
			add_filter( 'nexio_filter_tgmpa_required_plugins', 'nexio_wp_gdpr_compliance_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'nexio_wp_gdpr_compliance_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('nexio_filter_tgmpa_required_plugins',	'nexio_wp_gdpr_compliance_tgmpa_required_plugins');
	function nexio_wp_gdpr_compliance_tgmpa_required_plugins( $list = array() ) {
		if ( nexio_storage_isset( 'required_plugins', 'wp-gdpr-compliance' ) && nexio_storage_get_array( 'required_plugins', 'wp-gdpr-compliance', 'install' ) !== false ) {
			$list[] = array(
				'name'     => nexio_storage_get_array( 'required_plugins', 'wp-gdpr-compliance', 'title' ),
				'slug'     => 'wp-gdpr-compliance',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if this plugin installed and activated
if ( ! function_exists( 'nexio_exists_wp_gdpr_compliance' ) ) {
	function nexio_exists_wp_gdpr_compliance() {
//		Old way (before v.2.0)
//		Attention! In the v.2.0 and v.2.0.1 this check throw fatal error in their autoloader!
//		return class_exists( 'WPGDPRC\WPGDPRC' );
//		New way (to avoid error in wp_gdpr_compliance autoloader)
//		Check constants:	before v.2.0						after v.2.0
		return defined( 'WP_GDPR_C_ROOT_FILE' ) || defined( 'WPGDPRC_ROOT_FILE' );
	}
}
