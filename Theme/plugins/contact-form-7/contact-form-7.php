<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('prolingua_cf7_theme_setup9')) {
	add_action( 'after_setup_theme', 'prolingua_cf7_theme_setup9', 9 );
	function prolingua_cf7_theme_setup9() {
		
		if (prolingua_exists_cf7()) {
			add_action( 'wp_enqueue_scripts', 								'prolingua_cf7_frontend_scripts', 1100 );
			add_filter( 'prolingua_filter_merge_styles',						'prolingua_cf7_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'prolingua_filter_tgmpa_required_plugins',			'prolingua_cf7_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'prolingua_cf7_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('prolingua_filter_tgmpa_required_plugins',	'prolingua_cf7_tgmpa_required_plugins');
	function prolingua_cf7_tgmpa_required_plugins($list=array()) {
		if (prolingua_storage_isset('required_plugins', 'contact-form-7')) {
			// CF7 plugin
			$list[] = array(
					'name' 		=> prolingua_storage_get_array('required_plugins', 'contact-form-7'),
					'slug' 		=> 'contact-form-7',
					'required' 	=> false
			);
		}
		return $list;
	}
}



// Check if cf7 installed and activated
if ( !function_exists( 'prolingua_exists_cf7' ) ) {
	function prolingua_exists_cf7() {
		return class_exists('WPCF7');
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'prolingua_cf7_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'prolingua_cf7_frontend_scripts', 1100 );
	function prolingua_cf7_frontend_scripts() {
		if (prolingua_is_on(prolingua_get_theme_option('debug_mode')) && prolingua_get_file_dir('plugins/contact-form-7/contact-form-7.css')!='')
			wp_enqueue_style( 'prolingua-contact-form-7',  prolingua_get_file_url('plugins/contact-form-7/contact-form-7.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'prolingua_cf7_merge_styles' ) ) {
	//Handler of the add_filter('prolingua_filter_merge_styles', 'prolingua_cf7_merge_styles');
	function prolingua_cf7_merge_styles($list) {
		$list[] = 'plugins/contact-form-7/contact-form-7.css';
		return $list;
	}
}
?>