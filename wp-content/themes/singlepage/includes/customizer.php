<?php

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function singlepage_customize_register( $wp_customize ) {
	
	global $singlepage_sections;
	
	$option_name = singlepage_get_option_name();

	/* Custom panel type - used for multiple levels of panels */
	if ( class_exists( 'WP_Customize_Panel' ) ) {

		class Avata_WP_Customize_Panel extends WP_Customize_Panel {

			public $panel;

			public $type = 'singlepage_panel';

			public function json() {
				
				$array = wp_array_slice_assoc( (array) $this, array(
					'id',
					'description',
					'priority',
					'type',
					'panel',
				) );
				$array['title']          = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
				$array['content']        = $this->get_content();
				$array['active']         = $this->active();
				$array['instanceNumber'] = $this->instance_number;

				return $array;

			}

		}

	}

	$wp_customize->register_panel_type( 'Avata_WP_Customize_Panel' );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'custom_logo' )->transport      = 'postMessage';


	/********************************************************************/
	/*************  FRONTPAGE SECTIONS PANEL ****************************/
	/********************************************************************/
	if ( singlepage_check_if_wp_greater_than_4_7() ) {

		$singlepage_frontpage_sections_panel = new Avata_WP_Customize_Panel( $wp_customize, 'singlepage_frontpage_sections_panel', array(
			'title'    => __( 'SP: Frontpage Sections', 'singlepage' ),
			'priority' => 1,
		) );

		$wp_customize->add_panel( $singlepage_frontpage_sections_panel );
	}

	/********************************************************************/
	/*************  SECTIONS        **********************************/
	/*******************************************************************/
	/***** old version sections *****/
	
	
	$i = 0;

	foreach( $singlepage_sections as $k => $v ){
	
	$section_id = 'singlepage_'.str_replace('-','_',$k);

	if ( singlepage_check_if_wp_greater_than_4_7() ) {
		$wp_customize->get_section( $section_id )->panel = 'singlepage_frontpage_sections_panel';
	}
	
	
	$section = $wp_customize->get_section( 'sidebar-widgets-'.$k.'' );
	
	if ( ! empty( $section ) ) {

		if ( singlepage_check_if_wp_greater_than_4_7() ) {
			$section->panel = 'singlepage_frontpage_sections_panel';
		} else {
			$section->panel = '';
		}
		$section->title     = $v['name'];
		$section->priority  = $i+10;
		
		$n = 0;
		foreach( $v['fields'] as $field_id => $field ){
			if(isset($field['settings']))
				$field_id = $field['settings'];
			$wp_customize->get_control( $option_name.'['.$field_id.']' )->section  = 'sidebar-widgets-'.$k.'';
			
			if ( $n < 4 ){
				$wp_customize->get_control( $option_name.'['.$field_id.']' )->priority = -4;
			}
			
			$n++;
		}
	}

	
	$i++;
	
	}

}
add_action( 'customize_register', 'singlepage_customize_register',999 );



function singlepage_sanitize_input($input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function singlepage_sanitize_checkbox( $input ){
	return ( isset( $input ) && true == $input ? true : false );
}

/**
 * Function to check if WordPress is greater or equal to 4.7
 */
function singlepage_check_if_wp_greater_than_4_7() {

	$wp_version_nr = get_bloginfo('version');

	if ( function_exists( 'version_compare' ) ) {
		if ( version_compare( $wp_version_nr, '4.7', '>=' ) ) {
			return true;
		}
	}
	return false;

}