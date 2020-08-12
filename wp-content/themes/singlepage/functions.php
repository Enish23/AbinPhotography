<?php
/**
 * Mobile Detect Library
 **/
if(!class_exists("Mobile_Detect"))
	load_template( trailingslashit( get_template_directory() ) . 'includes/Mobile_Detect.php' );
/**
 * Theme setup
 **/
load_template( trailingslashit( get_template_directory() ) . 'includes/theme-setup.php' );

/**
 * Theme widgets
 **/
load_template( trailingslashit( get_template_directory() ) . 'includes/theme-widgets.php' );

/**
 * Theme Functions
 **/
load_template( trailingslashit( get_template_directory() ) . 'includes/custom-functions.php' );

/**
 * Theme breadcrumb
 */
load_template( trailingslashit( get_template_directory() ) . 'includes/breadcrumbs.php' );

/**
 * Theme Metabox
 */
load_template( trailingslashit( get_template_directory() ) . 'includes/metabox-options.php' );

// Helper library for the theme customizer.
require_once dirname( __FILE__ ) . '/includes/kirki/kirki.php';
require_once dirname( __FILE__ ) . '/includes/options-kirki.php';
