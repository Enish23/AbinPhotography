<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Do not proceed if Kirki does not exist.
if ( ! class_exists( 'Kirki' ) ) {
	return;
}

/**
 *  Add the config.
 *
 */
Kirki::add_config(
	'singlepage', array(
		'capability'  => 'edit_theme_options',
		'option_type' => 'options',
		'option_name'   => 'singlepage'
	)
);

function singlepage_public_section_options($id,$default,$custom = false,$args ){
	
	extract($args);
	$font_size_array = array();
	for($i=9;$i<=71;$i++){
		$font_size_array[$i.'px'] = $i.'px';
	}
	$default_options = array_merge(array(
						  'hide' => $hide,
						  'fullwidth' => '',
						  'section_title' => '',
						  'section_subtitle' => '',
						  'menu_title'  => '',
						  'menu_slug' => 'section-'.$id,
						  'font_size' => '14px',
						  'font' => 'Open Sans, sans-serif',
						  'font_color' => '#666666',
						  'background_color' => '',
						  'background_image' => '',
						  'background_repeat' => 'repeat',
						  'background_position' => 'top left',
						  'background_attachment' => 'scroll',
						  'background_size' => '',
						  'css_class' => '',
						  'content' => '',
						  'section_image' => ''
				),$default);

	extract($default_options);
	$o_section_background = singlepage_option_saved('section_background_'.$id);
	
	$background_size_o = singlepage_option_saved('background_size_'.$id);
	
	if($background_size_o=='yes')
		$background_size = 'cover';
		
	if( $o_section_background )
		$section_background[intval($id)] = array('background-color' => $o_section_background['color'],'background-image' => $o_section_background['image'],'background-repeat' => $o_section_background['repeat'],'background-position' => $o_section_background['position'],'background-attachment'=>$o_section_background['attachment'],'background-size'=> $background_size );
	else
		$section_background[intval($id)] = array('background-color' => $background_color,'background-image' => $background_image,'background-repeat' => $background_repeat,'background-position' => $background_position,'background-attachment'=>$background_attachment,'background-size'=> $background_size );
	
	$typography = array(
		'font-size' => '14px',
		'font-family' => 'Open Sans, sans-serif',
		'color' => '#ffffff'
	);

	$section_content_typography = singlepage_option_saved('section_content_typography_'.$id);
	if($section_content_typography){
		$typography = array(
			'font-size' => $section_content_typography['size'],
			'font-family' => $section_content_typography['face'],
			'color' => $section_content_typography['color'],
		);
	}

	$return = array(
												
			  'section_hide_'.$id => array(
					'type'        => 'checkbox',
					'label'       => esc_attr__('Hide Section', 'singlepage' ),
					'description' => '',
					'default'     => $default_options['hide'],
					  ),
					  
			  'section_hide_nav_'.$id => array(
					'type'        => 'checkbox',
					'label'       => esc_attr__('Hide Sub-nav in This Section', 'singlepage' ),
					'description' => '',
					'default'     => '',
					  ),
					  
			  'section_fullwidth_'.$id => array(
					'type'        => 'checkbox',
					'label'       => esc_attr__('Full Width', 'singlepage' ),
					'description' => '',
					'default'     => '',
					  ),

			  'section_title_'.$id => array(
					'type'        => 'text',
					'label'       => esc_attr__('Section Title', 'singlepage' ),
					'description' => '',
					'default'     => $default_options['section_title'],
					  ),

			 'section_menu_title_'.$id => array(
					'type'        => 'text',
					'label'       => esc_attr__('Section Menu Title', 'singlepage' ),
					'description' =>  '',
					'default'     => $default_options['menu_title'],
					  ),

			  'section_menu_slug_'.$id => array(
					'type'        => 'text',
					'label'       => esc_attr__('Section Menu Slug', 'singlepage' ),
					'description' =>  '',
					'default'     => $default_options['menu_slug'],
					  ),
			'section_content_'.$id => array(
					'type'        => 'editor',
					'label'       => esc_attr__('Section Content', 'singlepage' ),
					'description' =>  '',
					'default'     => $default_options['content'],
					'editor_settings' => array(
						'quicktags' => true,
						'tinymce'   => true,
						'media_buttons' =>  true,
					),
					),
					  
			  'section_content_font_'.$id => array(
					'label'   => __( 'Section Content Typography', 'singlepage' ),
					'type'    => 'typography',
					'default' => $typography
				),
			
			  
/*			  'section_background_color_'.$id => array(
					'label' => __('Section Background Color', 'singlepage'),
					'type' => 'color',
					'description' => '',
					'default'=> $section_background[intval($id)]['background-color'],
					'section' => 'sections_'.$id,
					),
					
			  'section_background_image_'.$id => array(
					'label' => __('Section Background Image', 'singlepage'),
					'type' => 'image',
					'description' => '',
					'default'=> $section_background[intval($id)]['background-image'],
					'section' => 'sections_'.$id,
					),*/
			
			'section_background1_'.$id => array(
					'label' => __('Section Background', 'singlepage'),
					'slug' => 'section_background1_'.$id.'',
					'type' => 'background',
					'description' => '',
					'default'=> $section_background[intval($id)],
					'section' => 'sections_'.$id,
					'output' => array(
										array(
											'element' => 'section.home_section_'.$id,
										),
									),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => 'section.home_section_'.$id,
							'function' => 'css',
							'property' => 'background',
							)
						),
					
					),
			
			'section_image_'.$id => array(
					'label' => __('Content Image', 'singlepage'),
					'default' => $default_options['section_image'],
					'type' => 'image'
					),
			'section_image_link_'.$id => array(
					'label' => __('Content Image Link', 'singlepage'),
					'default' => '',
					'type' => 'text'
					),

			'section_image_link_target_'.$id => array(
					'label' => __('Content Image Link Target', 'singlepage'),
					'default' => '',
					'type' => 'select',
					'choices'=> $target
					),
			'section_content_background_'.$id => array(
					'label' => __('Section Content Background', 'singlepage'),
					'default' => '',
					'type' => 'color',
					),
			'opacity_'.$id => array(
					'label' => __('Opacity', 'singlepage'),
					'default' => '1',
					'type' => 'select',
					'choices'=>  array('0.1'=>'0.1','0.2'=>'0.2','0.3'=>'0.3','0.4'=>'0.4','0.5'=>'0.5','0.6'=>'0.6','0.7'=>'0.7','0.8'=>'0.8','0.9'=>'0.9','1.0'=>'1.0')
					),
			'border_radius_'.$id => array(
					'label' => __('Section Content Border Radius', 'singlepage'),
					'default' => '10px',
					'type' => 'text'
					),
			  
			  'section_css_class_'.$id => array(
					'type'        => 'text',
					'label'       => esc_attr__( 'Css Class', 'singlepage' ),
					'description' =>  '',
					'default'     => $default_options['css_class'],
					'transport' => 'postMessage',
			  ),

			  
	  );
	  
	if (!$custom){
		unset($return['section_content_'.$id]);
	}
	
	if ( isset($excludes) && !empty($excludes) ){
		foreach($excludes as $exclude){
			if(isset($return[$exclude.'_'.$id]))
				unset($return[$exclude.'_'.$id]);
			}
		}
	return $return;
	
	}		
	
function singlepage_customizer_library_options() {
	global $singlepage_sections, $singlepage_sidebars,$singlepage_default_sections;
	$option_name = singlepage_get_option_name();
	
	$args['repeat'] = $repeat = array(
		'no-repeat'   => esc_attr__( 'No Repeat', 'singlepage' ),
		'repeat-x' => esc_attr__( 'Repeat Horizontally', 'singlepage' ),
		'repeat-y'   => esc_attr__( 'Repeat Vertically', 'singlepage' ),
		'repeat' => esc_attr__( 'Repeat All', 'singlepage' ),
		);
		
	$args['position'] = $position = array(
		'top left'   => esc_attr__( 'Top Left', 'singlepage' ),
		'top center' => esc_attr__( 'Top Center', 'singlepage' ),
		'top right'   => esc_attr__( 'Top Right', 'singlepage' ),
		'center left' => esc_attr__( 'Middle Left', 'singlepage' ),
		'center center' => esc_attr__( 'Middle Center', 'singlepage' ),
		'center right' => esc_attr__( 'Middle Right', 'singlepage' ),
		'bottom left' => esc_attr__( 'Bottom Left', 'singlepage' ),
		'bottom center' => esc_attr__( 'Bottom Center', 'singlepage' ),
		'bottom right' => esc_attr__( 'Bottom Right', 'singlepage' ),
		);
		
	$args['attachment'] = $attachment = array(
		'scroll'   => esc_attr__( 'Scroll Normally', 'singlepage' ),
		'fixed' => esc_attr__( 'Fixed in Place', 'singlepage' ),
		);
	
	$args['fonts'] = $fonts = array(
		'Arial, sans-serif'   => esc_attr__( 'Arial', 'singlepage' ),
		'"Avant Garde", sans-serif' => esc_attr__( 'Avant Garde', 'singlepage' ),
		'Cambria, Georgia, serif' => esc_attr__( 'Cambria', 'singlepage' ),
		'Copse, sans-serif' => esc_attr__( 'Copse', 'singlepage' ),
		'Garamond, "Hoefler Text", Times New Roman, Times, serif' => esc_attr__( 'Garamond', 'singlepage' ),
		'Georgia, serif' => esc_attr__( 'Georgia', 'singlepage' ),
		'"Helvetica Neue", Helvetica, sans-serif' => esc_attr__( 'Helvetica Neue', 'singlepage' ),
		'Tahoma, Geneva, sans-serif' => esc_attr__( 'Tahoma', 'singlepage' ),
		);
		
	// Pull all the categories into an array
		$options_categories = array();
		$options_categories_obj = get_categories();
		$options_categories[''] = __( 'All', 'singlepage' );
		foreach ($options_categories_obj as $category) {
			$options_categories[$category->cat_ID] = $category->cat_name;
		}
	
	$singlepage_sidebars['0'] = __( '--Disable--', 'singlepage' );
	for( $i=1;$i<=8;$i++ ):
		$singlepage_sidebars['singlepage-sidebar-'.$i] = sprintf( __( 'Sidebar %d', 'singlepage' ), $i);
	endfor;
	
	$font_size = array();
	for($i=9;$i<=71;$i++){
		$font_size[$i.'px'] = $i.'px';
	}
	
	$args['font_size'] = $font_size;
	$args['choices']   = $choices   = array('yes'=>esc_attr__( 'Yes', 'singlepage' ),'no'=>esc_attr__( 'No', 'singlepage' ));
	$args['target']    = $target    = array('_self'=>esc_attr__( 'Self', 'singlepage' ),'_blank'=>esc_attr__( 'Blank', 'singlepage' ));
	$args['imagepath'] = $imagepath =  get_template_directory_uri() . '/assets/images/';
	
	$options         = singlepage_option_saved($option_name);
	$default_options = array();
	$nav_icon_style  = 'css3';
	$singlepage_lite_sections = array();
	$is_old_version  = false;
	if($options)
		$is_old_version  = true;
	
	// Stores all the controls that will be added
	$options = array();
	
	// Stores all the sections to be added
	$sections = array();
	
	// Stores all the panels to be added
	$panels = array();
		
	// custom frontpage sections
	$section_num = singlepage_option_saved('section_num');
	
	$default_options[0] = array(
							  'hide' => '',
							  'fullwidth' => '',
							  'section_title' => '',
							  'section_subtitle' => '',
							  'menu_title'  => 'SECTION ONE',
							  'menu_slug' => 'section-one',
							  'font_size' => '14px',
							  'font' => 'Open Sans, sans-serif',
							  'font_color' => '#ffffff',
							  'background_color' => '',
							  'background_image' => $imagepath.'bg_01.jpg',
							  'background_repeat' => 'repeat',
							  'background_position' => 'top left',
							  'background_attachment' => 'scroll',
							  'background_size' => 'cover',
							  'css_class' => '',
							  'content' => '<p><h1 class="section-title">Impressive Design</h1><br>
	<ul>
		<li>Lorem ipsum dolor sit amet</li>
		<li>fons et oculorum captans iconibus</li>
		<li> haec omnia faciant ad melioris propositi vestri website</li>
	</ul><br/>
	<a href="#" class="btn btn-white btn-outline btn-lg"> Buy Now </a>
	
	<a href="#" class="btn btn-warning btn-lg" >Download </a>
	</p>',
							  'section_image' => $imagepath.'1.png',
					);
	
	$default_options[1] = array(
							  'hide' => '',
							  'fullwidth' => '',
							  'section_title' => '',
							  'section_subtitle' => '',
							  'menu_title'  => 'SECTION TWO',
							  'menu_slug' => 'section-two',
							  'font_size' => '14px',
							  'font' => 'Open Sans, sans-serif',
							  'font_color' => '#ffffff',
							  'background_color' => '#152431',
							  'background_image' => '',
							  'background_repeat' => 'repeat',
							  'background_position' => 'top left',
							  'background_attachment' => 'scroll',
							  'background_size' => 'cover',
							  'css_class' => '',
							  'content' => '<p><h1 class="section-title">YouTube Video Background</h1><br>
							  
							  <ul>
		<li>Lorem ipsum dolor sit amet</li>
		<li>consectetur adipiscingelit</li>
		<li>Integer sed magna vel </li>
		<li>Dapibus ege-stas turpis.</li>
	</ul>
	</p>',
							  'section_image' => $imagepath.'2.png',
					);
					
	$default_options[2] = array(
							  'hide' => '',
							  'fullwidth' => '',
							  'section_title' => '',
							  'section_subtitle' => '',
							  'menu_title'  => 'SECTION THREE',
							  'menu_slug' => 'section-three',
							  'font_size' => '14px',
							  'font' => 'Open Sans, sans-serif',
							  'font_color' => '#ffffff',
							  'background_color' => '#D73E4D',
							  'background_image' => '',
							  'background_repeat' => 'repeat',
							  'background_position' => 'top left',
							  'background_attachment' => 'scroll',
							  'background_size' => 'cover',
							  'css_class' => '',
							  'content' => '<p><h1 class="section-title">Flexibility</h1><br>
	<ul>
		<li>Lorem ipsum dolor sit amet</li>
		<li>consectetur adipiscingelit</li>
		<li>Integer sed magna vel </li>
		<li>Dapibus ege-stas turpis.</li>
	</ul>
	</p>',
							  'section_image' => $imagepath.'3.png',
					);
	
	$default_options[3] = array(
							  'hide' => '',
							  'fullwidth' => '',
							  'section_title' => '',
							  'section_subtitle' => '',
							  'menu_title'  => 'SECTION FOUR',
							  'menu_slug' => 'section-four',
							  'font_size' => '14px',
							  'font' => 'Open Sans, sans-serif',
							  'font_color' => '#ffffff',
							  'background_color' => '#375099',
							  'background_image' => '',
							  'background_repeat' => 'repeat',
							  'background_position' => 'top left',
							  'background_attachment' => 'scroll',
							  'background_size' => 'cover',
							  'css_class' => '',
							  'content' => '<p><h1 class="section-title">Continuous  Support</h1><br>
	<ul>
		<li>Lorem ipsum dolor sit amet</li>
		<li>consectetur adipiscingelit</li>
		<li>Integer sed magna vel velit</li>
		<li>Dapibus ege-stas turpis.</li>
	</ul>
	</p>',
							  'section_image' => $imagepath.'4.png',
					);
					
	$default_options[4] = array(
							  'hide' => '',
							  'fullwidth' => '',
							  'section_title' => '',
							  'section_subtitle' => '',
							  'menu_title'  => '',
							  'menu_slug' => '',
							  'font_size' => '14px',
							  'font' => 'Open Sans, sans-serif',
							  'font_color' => '#ffffff',
							  'background_color' => '#a8a8a8',
							  'background_image' => '',
							  'background_repeat' => 'repeat',
							  'background_position' => 'top left',
							  'background_attachment' => 'scroll',
							  'background_size' => 'cover',
							  'css_class' => '',
							  'content' => '',
							  'section_image' => '',
					);
	$default_options[5] = array(
							  'hide' => '',
							  'fullwidth' => '',
							  'section_title' => '',
							  'section_subtitle' => '',
							  'menu_title'  => '',
							  'menu_slug' => '',
							  'font_size' => '14px',
							  'font' => 'Open Sans, sans-serif',
							  'font_color' => '#ffffff',
							  'background_color' => '#a8a8a8',
							  'background_image' => '',
							  'background_repeat' => 'repeat',
							  'background_position' => 'top left',
							  'background_attachment' => 'scroll',
							  'background_size' => 'cover',
							  'css_class' => '',
							  'content' => '',
							  'section_image' => '',
					);
					
	$sections_order = singlepage_get_sections(array(0,1,2,3,4,5));
	
	$singlepage_sections = array();
	$args['hide']    = '';
	foreach( $sections_order as $k=>$j){
		$i = $j+1;
		$default_options[$j]['hide'] = '';
	if(is_numeric($section_num)){
		if($i>$section_num)
			$default_options[$j]['hide'] = 1;
	}
	if( $j>3 )
		$default_options[$j]['hide'] = 1;
		
		if(!isset($default_options[$j]))
			$default_options[$j] = array('autoheight' => '1');
			$options = singlepage_public_section_options($j,$default_options[$j],true,$args);
			$singlepage_sections['section-'.$j] = array(
				'name'=>sprintf(__('Custom Section %d', 'singlepage'),$i),
				'fields'=> $options
			);
		}
	
	$panel = 'singlepage_homepage';
	$panels[] = array(
			'settings' => $panel,
			'title' => __( 'SP: Frontpage Sections', 'singlepage' ),
			'priority' => '6'
		);
		
	/*$sortsections_saved  = get_option('singlepage_sortsections',true);
	$singlepage_sections = array();
	if( is_array($sortsections_saved) && !empty($sortsections_saved) ){
		foreach( $sortsections_saved as $sortsection ){
			if(isset($singlepage_lite_sections[$sortsection])){
				$singlepage_sections[$sortsection] = $singlepage_lite_sections[$sortsection];
			}
		}
	
		$singlepage_sections = array_merge($singlepage_sections,$singlepage_lite_sections);
	
	}else{
		$singlepage_sections = 	$singlepage_lite_sections;
	}*/
	$i = 10;
	foreach( $singlepage_sections as $k => $v ){
		
		$section_id = 'singlepage_'.str_replace('-','_',$k);
		$i++;
		$sections[] = array(
			'settings' => $section_id,
			'title' =>  $v['name'],
			'priority' => $i,
			'panel' => $panel
		);
	
	
		foreach( $v['fields'] as $field_id=>$field ){
			if(!isset($field['settings']))
				$field['settings'] = $field_id;
			
			$field['section'] = $section_id;
			$field['priority'] = '-10';
			
			$options[$field_id] = $field;
		}
			
	}
	
	//  Front page
	$panel = 'singlepage_homepage_options';
		
	$panels[] = array(
		'settings' => $panel,
		'title' => __( 'SP: Frontpage Options', 'singlepage' ),
		'priority' => '7'
	);
		
	$section = 'singlepage_frontpage_general';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'General Options', 'singlepage' ),
		'priority' => '9',
		'panel' => $panel
	);
	
	$options['section_height_mode'] = array(
		'type'        => 'radio',
		'settings' => 'section_height_mode',
		'label'       => __( 'Section Height Mode ( Desktop & Tablet )', 'singlepage' ),
		'section'     => $section,
		'default'     => '1',
		'priority'    => 10,
		'choices'     => array(
			'1'   => esc_attr__( 'Full Height', 'singlepage' ),
			'2' => esc_attr__( 'Auto Height', 'singlepage' ),
		),
	);
	
	$options['section_height_mode_mobile'] = array(
		'type'        => 'radio',
		'settings' => 'section_height_mode_mobile',
		'label'       => __( 'Section Height Mode on Mobile', 'singlepage' ),
		'section'     => $section,
		'default'     => '2',
		'priority'    => 10,
		'choices'     => array(
			'1'   => esc_attr__( 'Full Height', 'singlepage' ),
			'2' => esc_attr__( 'Auto Height', 'singlepage' ),
		),
	);
	
	$options['hide_scroll_bar'] = array(
		'settings' => 'hide_scroll_bar',
		'label'    => __( 'Hide Side Navigation', 'singlepage' ),
		'section'  => $section,
		'type'     => 'checkbox',
		'priority' => 10,
		'default'  => '0',
	 );
	
	$options['scrolldelay'] = array(
		'settings' => 'scrolldelay',
		'label'    => __( 'Scrolling Delay', 'singlepage' ),
		'section'  => $section,
		'type'     => 'text',
		'priority' => 10,
		'default'  => '700',
	 );
	
	$featured_homepage_sidebar = singlepage_option_saved('featured_homepage_sidebar');
	if($featured_homepage_sidebar)
	$options['featured_homepage_sidebar'] = array(
		'settings' => 'featured_homepage_sidebar',
		'label'    => __( 'Featured Homepage Sidebar', 'singlepage' ),
		'section'  => $section,
		'type'     => 'textarea',
		'priority' => 10,
		'default'  => "<div class='social-networks'>
	  <ul class='unstyled inline'>\r\n
		<li class='facebook  display-icons'> <a rel='external' title='facebook' href='#'> <i class='fa fa-facebook fa-2x'>&nbsp;</i> </a> </li>\r\n
		<li class='twitter  display-icons'> <a rel='external' title='twitter' href='#'> <i class='fa fa-twitter fa-2x'>&nbsp;</i> </a> </li>\r\n
		<li class='flickr  display-icons'> <a rel='external' title='flickr' href='#'> <i class='fa fa-flickr fa-2x'>&nbsp;</i> </a> </li>\r\n
		<li class='rss  display-icons'> <a rel='external' title='rss' href='#'> <i class='fa fa-rss fa-2x'>&nbsp;</i> </a> </li>\r\n
		<li class='google-plus  display-icons'> <a rel='external' title='google-plus' href='#'> <i class='fa fa-google-plus fa-2x'>&nbsp;</i> </a> </li>\r\n
		<li class='youtube  display-icons'> <a rel='external' title='youtube' href='#'> <i class='fa fa-youtube fa-2x'>&nbsp;</i> </a> </li>\r\n
	  </ul>
	</div>
	",
	 );
	
	$options['content_container_left_768'] = array(
		'settings' => 'content_container_left_768',
		'label'    => __('Padding Left on Mobile (<768px)', 'singlepage' ),
		'section'  => $section,
		'type'     => 'text',
		'priority' => 10,
		'default'  => '30%',
	 );
	
	$options['content_container_left_992'] = array(
		'settings' => 'content_container_left_992',
		'label'    => __('Padding Left on Tablets (<992px)', 'singlepage' ),
		'section'  => $section,
		'type'     => 'text',
		'priority' => 10,
		'default'  => '21%',
	 );
	
	$options['content_container_width_1200_2'] = array(
		'settings' => 'content_container_width_1200_2',
		'label'    => __('Padding Left on Desktops (<1200px)', 'singlepage' ),
		'section'  => $section,
		'type'     => 'text',
		'priority' => 10,
		'default'  => '21%',
	 );
	 
	 $options['home_side_nav_circle_color'] = array(
		'type'        => 'radio-image',
		'settings' => 'home_side_nav_circle_color',
		'label'       => esc_html__( 'Side Nav Dot Image', 'singlepage' ),
		'section'     => $section,
		'default'     => 'nav_cur0',
		'priority'    => 10,
		'choices'     => array(
				'nav_cur0' => $imagepath . 'nav_cur0.png',
				'nav_cur1' => $imagepath . 'nav_cur1.png',
				'nav_cur2' => $imagepath . 'nav_cur2.png',
				'nav_cur3' => $imagepath . 'nav_cur3.png',
				'nav_cur4' => $imagepath . 'nav_cur4.png',
				'nav_cur5' => $imagepath . 'nav_cur5.png',
				'nav_cur6' => $imagepath . 'nav_cur6.png',
				'nav_cur7' => $imagepath . 'nav_cur7.png',
				'nav_cur8' => $imagepath . 'nav_cur8.png',
				'nav_cur9' => $imagepath . 'nav_cur9.png',
				'nav_cur10' => $imagepath . 'nav_cur10.png',
				'nav_cur11' => $imagepath . 'nav_cur11.png',
	),
);

$options['home_side_nav_circle_image'] = array(
	'settings' => 'home_side_nav_circle_image',
	'label'    => __( 'Custom Side Nav Dot Image', 'singlepage' ),
	'section'  => $section,
	'type'     => 'image',
	'priority' => 10,
	'default'  => '',
 );
	
	// YouTube Video Background Options
	$section = 'youtube_video_background';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'YouTube Video Background', 'singlepage' ),
		'priority' => '9',
		'panel' => $panel
	);
	
	$options['youtube_video'] = array(
		'settings' => 'youtube_video',
		'label'    => __( 'YouTube Video', 'singlepage' ),
		'section'  => 'youtube_video_background',
		'type'     => 'text',
		'priority' => 10,
		'default'  => 'r1xohS2u69E',
		"description"=>__('Insert here the ID or the complete URL of the YouTube video','singlepage')
	 );
	
	$options['youtube_video_loop'] = array(
		'settings' => 'youtube_video_loop',
		'label'    => __( 'Video Loop', 'singlepage' ),
		'section'  => 'youtube_video_background',
		'type'     => 'select',
		'priority' => 10,
		'default'  => 'true',
		'choices'     => array('true'=> __( 'Yes', 'singlepage' ),'false'=> __( 'No', 'singlepage' ))
	 );
	
	$options['youtube_video_mute'] = array(
		'settings' => 'youtube_video_mute',
		'label'    => __( 'Mute', 'singlepage' ),
		'section'  => 'youtube_video_background',
		'type'     => 'select',
		'priority' => 10,
		'default'  => 'true',
		'choices'     => array('true'=> __( 'Yes', 'singlepage' ),'false'=> __( 'No', 'singlepage' ))
	 );
	
	$options['youtube_show_controls'] = array(
		'settings' => 'youtube_show_controls',
		'label'    => __( 'Show Controls', 'singlepage' ),
		'section'  => 'youtube_video_background',
		'type'     => 'select',
		'priority' => 10,
		'default'  => 'false',
		'choices'     => array('true'=> __( 'Yes', 'singlepage' ),'false'=> __( 'No', 'singlepage' ))
	 );
	
	$options['youtube_start_at'] = array(
		'settings' => 'youtube_start_at',
		'label'    => __( 'Start At', 'singlepage' ),
		'section'  => 'youtube_video_background',
		'type'     => 'text',
		'priority' => 10,
		'default'  => '10',
	 );
	
	$options['youtube_video_background_section'] = array(
		'settings' => 'youtube_video_background_section',
		'label'    => __( 'Video Background Section', 'singlepage' ),
		'section'  => 'youtube_video_background',
		'type'     => 'select',
		'priority' => 11,
		'default'  => '1',
		'choices' => array(
							'-1'=> __( 'Disable', 'singlepage' ),
							'1'=> sprintf(__( 'Section %d', 'singlepage' ),1),
							'2'=> sprintf(__( 'Section %d', 'singlepage' ),2),
							'3'=> sprintf(__( 'Section %d', 'singlepage' ),3),
							'4'=> sprintf(__( 'Section %d', 'singlepage' ),4),
							)
	 );
	
	// HTML5 Video Background Options
	
	$section = 'html5_video_background';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'HTML5 Video Background Options', 'singlepage' ),
		'priority' => '9',
		'panel' => $panel
	);
	
	$options['mp4_video_url'] = array(
		'settings' => 'mp4_video_url',
		'label'    => __( 'MP4 Video URL', 'singlepage' ),
		'section'  => $section,
		'type'     => 'text',
		'priority' => 10,
		'default'  => '',
	 );
	
	$options['ogv_video_url'] = array(
		'settings' => 'ogv_video_url',
		'label'    => __( 'OGV Video URL', 'singlepage' ),
		'section'  => $section,
		'type'     => 'text',
		'priority' => 10,
		'default'  => '',
	 );
	
	$options['poster_url'] = array(
		'settings' => 'poster_url',
		'label'    => __( 'Poster', 'singlepage' ),
		'section'  => $section,
		'type'     => 'image',
		'priority' => 10,
		'default'  => '',
	 );
	
	$options['video_loop'] = array(
		'settings' => 'video_loop',
		'label'    => __( 'Video Loop', 'singlepage' ),
		'section'  => $section,
		'type'     => 'select',
		'priority' => 10,
		'default'  => '1',
		'choices'     => array('1'=> __( 'Yes', 'singlepage' ),'0'=> __( 'No', 'singlepage' ))
	 );
	
	$options['video_volume'] = array(
		'settings' => 'video_volume',
		'label'    => __( 'Video Volume', 'singlepage' ),
		'section'  => $section,
		'type'     => 'select',
		'priority' => 10,
		'default'  => '0.8',
		'choices'     => array('0.001'=>'0','0.1'=>'0.1','0.2'=>'0.2','0.3'=>'0.3','0.4'=>'0.4','0.5'=>'0.5','0.6'=>'0.6','0.7'=>'0.7','0.8'=>'0.8','0.9'=>'0.9','1.0'=>'1.0')
	 );
	
	$options['video_background_section'] = array(
		'settings' => 'video_background_section',
		'label'    => __( 'Video Background Section', 'singlepage' ),
		'section'  => $section,
		'type'     => 'select',
		'priority' => 10,
		'default'  => '0',
		'choices'     => array(
							'-1'=> __( 'Disable', 'singlepage' ),
							'1'=> sprintf(__( 'Secction %d', 'singlepage' ),1),
							'2'=> sprintf(__( 'Secction %d', 'singlepage' ),2),
							'3'=> sprintf(__( 'Secction %d', 'singlepage' ),3),
							'4'=> sprintf(__( 'Secction %d', 'singlepage' ),4),
							)
	 );
	
	// Full Screen Google Map Options
	
	$section = 'full_screen_google_map';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Full Screen Google Map', 'singlepage'  ),
		'priority' => '9',
		'panel' => $panel
	);
	
	$options['gmap_api_key'] = array(
		'settings' => 'gmap_api_key',
		'label'    => __( 'Google Map API Key', 'singlepage' ),
		'section'  => $section,
		'type'     => 'text',
		'priority' => 10,
		'default'  => '',
		'description'  => '<a href="'.esc_url('https://developers.google.com/maps/documentation/javascript/get-api-key#key').'" target="_blank">'.__( 'Get Google Map API Key', 'singlepage'  ).'</a>',
	 );
	 
	$options['google_map_address'] = array(
		'settings' => 'google_map_address',
		'label'    => __( 'Address', 'singlepage' ),
		'section'  => 'full_screen_google_map',
		'type'     => 'text',
		'priority' => 10,
		'default'  => 'Sydney, NSW',
	 );
	
	$options['google_map_zoom'] = array(
		'settings' => 'google_map_zoom',
		'label'    => __( 'Zoom', 'singlepage' ),
		'section'  => 'full_screen_google_map',
		'type'     => 'text',
		'priority' => 10,
		'default'  => '10',
	 );
	
	$options['google_map_section'] = array(
		'settings' => 'google_map_section',
		'label'    => __( 'Google Map Section', 'singlepage' ),
		'section'  => $section,
		'type'     => 'select',
		'priority' => 10,
		'default'  => '0',
		'choices'     => array(
							'-1'=> __( 'Disable', 'singlepage' ),
							'1'=> sprintf(__( 'Secction %d', 'singlepage' ),1),
							'2'=> sprintf(__( 'Secction %d', 'singlepage' ),2),
							'3'=> sprintf(__( 'Secction %d', 'singlepage' ),3),
							'4'=> sprintf(__( 'Secction %d', 'singlepage' ),4),
							)
	 );
	
	// Full Screen Google Map Options
	
	$section = 'home_page_sidebar_menu';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Home Page Left Menu', 'singlepage'  ),
		'priority' => '9',
		'panel' => $panel
	);
	
	$options['menu_style_desktop'] = array(
		'settings' => 'menu_style_desktop',
		'label'    => __( 'Menu Style ( Desktop )', 'singlepage' ),
		'section'  => $section,
		'type'     => 'select',
		'priority' => 10,
		'default'  => '1',
		'choices'     => array('1'=> __( 'Style 1', 'singlepage' ),'2'=> __( 'Style 2', 'singlepage' ))
	 );
	
	$options['menu_status_desktop'] = array(
		'settings' => 'menu_status_desktop',
		'label'    => __( 'Menu Style Status ( Desktop )', 'singlepage' ),
		'section'  => $section,
		'type'     => 'select',
		'priority' => 10,
		'default'  => 'open',
		'choices'     => array('open'=> __( 'Open', 'singlepage' ),'close'=> __( 'Close', 'singlepage' ))
	 );
	
	$options['menu_style_tablet'] = array(
		'settings' => 'menu_style_tablet',
		'label'    => __( 'Menu Style ( Tablet )', 'singlepage' ),
		'section'  => $section,
		'type'     => 'select',
		'priority' => 10,
		'default'  => '1',
		'choices'     => array('1'=> __( 'Style 1', 'singlepage' ),'2'=> __( 'Style 2', 'singlepage' ))
	 );
	
	$options['menu_status_tablet'] = array(
		'settings' => 'menu_status_tablet',
		'label'    => __( 'Menu Style Status ( Tablet )', 'singlepage' ),
		'section'  => $section,
		'type'     => 'select',
		'priority' => 10,
		'default'  => 'open',
		'choices'     => array('open'=> __( 'Open', 'singlepage' ),'close'=> __( 'Close', 'singlepage' ))
	 );
	
	$options['menu_style_mobile'] = array(
		'settings' => 'menu_style_mobile',
		'label'    => __( 'Menu Style ( Mobile )', 'singlepage' ),
		'section'  => $section,
		'type'     => 'select',
		'priority' => 10,
		'default'  => '2',
		'choices'     => array('1'=> __( 'Style 1', 'singlepage' ),'2'=> __( 'Style 2', 'singlepage' ))
	 );
	
	$options['menu_status_mobile'] = array(
		'settings' => 'menu_status_mobile',
		'label'    => __( 'Menu Style Status ( Mobile )', 'singlepage' ),
		'section'  => $section,
		'type'     => 'select',
		'priority' => 10,
		'default'  => 'close',
		'choices'     => array('open'=> __( 'Open', 'singlepage' ),'close'=> __( 'Close', 'singlepage' ))
	 );
	
	// Basic settings
	$section = 'singlepage_panel_basic_settings';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'SP: Basic Settings', 'singlepage'  ),
		'priority' => '9',
		'panel' => ''
	);
	
	
	$options['logo'] = array(
		'settings' => 'logo',
		'label'    => __( 'Upload Logo', 'singlepage' ),
		'section'  => $section,
		'type'     => 'image',
		'priority' => 11,
		'default'  => '',
	 );
	
	$options['page_404_content'] = array(
		'settings' => 'page_404_content',
		'label'    => __( '404 Page Content', 'singlepage' ),
		'section'  => $section,
		'type'     => 'editor',
		'priority' => 12,
		'default'  => '<div class="text-center">
										<img class="img-404" src="'.$imagepath .'404.png" alt="404 not found" />
										<br/> <br/>
										<a href="'.esc_url(home_url("/")).'"><i class="fa fa-home"></i> Please, return to homepage!</a>
										</div>',
		'editor_settings' => array(
							'quicktags' => true,
							'tinymce'   => true,
						),
	 );
	
	$options['header_code'] = array(
		'settings' => 'header_code',
		'label'    => __( 'Header Tracking Code', 'singlepage' ),
		'section'  => $section,
		'type'     => 'code',
		'priority' => 13,
		'default'  => '',
	 );
	
	$options['footer_code'] = array(
		'settings' => 'footer_code',
		'label'    => __( 'Footer Tracking Code', 'singlepage' ),
		'section'  => $section,
		'type'     => 'code',
		'priority' => 14,
		'default'  => '',
	 );
	
	$options['custom_css'] = array(
		'settings' => 'custom_css',
		'label'    => __( 'Custom CSS', 'singlepage' ),
		'section'  => $section,
		'type'     => 'code',
		'priority' => 15,
		'default'  => '',
	 );
	
	$options['section_order'] = array(
		'settings' => 'section_order',
		'label'    => __('Section Order', 'singlepage' ),
		'section'  => $section,
		'type'     => 'textarea',
		'priority' => 16,
		'default'  => '{"0":"0","1":"1","2":"2","3":"3","4":"4","5":"5"}',
	 );
	
	// Footer
	$section = 'singlepage_footer';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'SP: Footer', 'singlepage'  ),
		'priority' => '9',
		'panel' => ''
	);
	
	$options['footer_widgets_background'] = array(
		'settings' => 'footer_widgets_background',
		'label'    => __('Footer Widgets Background', 'singlepage' ),
		'section'  => $section,
		'type'     => 'background',
		'priority' => 16,
		'default'  => '',
		'output' => array(
										array(
											'element' => '#footer .footer-widgets',
										),
									),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '#footer .footer-widgets',
							'function' => 'css',
							'property' => 'background',
							)
						),
	 );
	 
	 $options['footer_copyright_background'] = array(
		'settings' => 'footer_copyright_background',
		'label'    => __('Footer Copyright Background', 'singlepage' ),
		'section'  => $section,
		'type'     => 'background',
		'priority' => 16,
		'default'  => '',
		'output' => array(
										array(
											'element' => '#footer .footer-copyright',
										),
									),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  =>  '#footer .footer-copyright',
							'function' => 'css',
							'property' => 'background',
							)
						),
	 );
	
	
	
	$default = array();
	
	for($i=0;$i<9;$i++){
		$icon = singlepage_option_saved('social_icon_'.$i);
		if($icon !=''){
			
			$default[] = array(
				'title'  => singlepage_option_saved('social_title_'.$i),
				'icon'  => $icon,
				'link'  => singlepage_option_saved('social_link_'.$i),
				'target'  => '_blank'
			);
			
		}
	}
	
	$options['footer_social_icons'] = array(
		'type'        => 'repeater',
		'label'       => esc_attr__( 'Social Icons', 'singlepage' ),
		'section'     => $section,
		'settings' => 'footer_social_icons',
		'description' => esc_attr__( 'Get social icon string from https://fontawesome.com/v4.7.0/icons/, e.g. facebook.', 'singlepage' ),
		'priority' => 10+$i,
		'row_label' => array(
			'type' => 'field',
			'value' => esc_attr__('Icon', 'singlepage' ),
			'field' => 'title',
		),
		'default'     => $default,
		'fields' => array( 
			'title' => array(
				'type'        => 'text',
				'label'       => esc_attr__( 'Social Title', 'singlepage' ),
				'description' => '',
				'default'     => '',
			),
			'icon' => array(
				'type'        => 'text',
				'label'       => esc_attr__( 'Social Icon', 'singlepage' ),
				'description' => esc_attr__( 'Get social icon string from https://fontawesome.com/v4.7.0/icons/, e.g. facebook.', 'singlepage' ),
				'default'     => '',
			),
			'link' => array(
				'type'        => 'url',
				'label'       => esc_attr__( 'Social Icon Link', 'singlepage' ),
				'description' => '',
				'default'     => '',
			),
			'target' => array(
				'type'        => 'select',
				'label'       => esc_attr__( 'Icon Link Target', 'singlepage' ),
				'description' => '',
				'default'     => '_blank',
				'choices'     => $target
			),
			
		)
	);
	
	$options['frontpage_widgets'] = array(
		'type'     => 'checkbox',
		'settings' => 'frontpage_widgets',
		'label'    => __('Display Footer Widgets on Front Page', 'singlepage'),
		'section'  => $section,
		'default'  => '',
		'priority' => 11+$i,
	);
	
	$options['copyright'] = array(
		'type'     => 'textarea',
		'settings' => 'copyright',
		'label'    => __('Copyright', 'singlepage'),
		'section'  => $section,
		'default'  => '',
		'priority' => 11+$i,
	);
	
// Typography
$page_menu_typography = array(
	'font-size' => '14px',
	'font-family' => 'Open Sans, sans-serif',
	'color' => '#c2d5eb'
	);

$page_menu_typography_ = singlepage_option_saved('page_menu_typography');
if($page_menu_typography_){
	$page_menu_typography = array(
		'font-size' => $page_menu_typography_['size'],
		'font-family' => $page_menu_typography_['face'],
		'color' => $page_menu_typography_['color'],
	);
}

$blog_menu_typography = array(
	'font-size' => '14px',
	'font-family' => 'Open Sans, sans-serif',
	'color' => '#666666'
);

$blog_menu_typography_ = singlepage_option_saved('blog_menu_typography');
if($blog_menu_typography_){
	$blog_menu_typography = array(
		'font-size' => $blog_menu_typography_['size'],
		'font-family' => $blog_menu_typography_['face'],
		'color' => $blog_menu_typography_['color'],
	);
}

$homepage_side_nav_menu_typography = array(
	'font-size' => '14px',
	'font-family' => 'Open Sans, sans-serif',
	'color' => '#ffffff'
	);

$homepage_side_nav_menu_typography_ = singlepage_option_saved('homepage_side_nav_menu_typography');
if($homepage_side_nav_menu_typography_){
	$homepage_side_nav_menu_typography = array(
		'font-size' => $homepage_side_nav_menu_typography_['size'],
		'font-family' => $homepage_side_nav_menu_typography_['face'],
		'color' => $homepage_side_nav_menu_typography_['color'],
	);
	}


$page_post_title_typography = array(
	'font-size' => '24px',
	'font-family' => 'Open Sans, sans-serif',
	'color' => '#555555'
	);

$page_post_title_typography_ = singlepage_option_saved('page_post_title_typography');
if($page_post_title_typography_){
	if($page_post_title_typography_['color'] == '') $page_post_title_typography_['color'] = '#555555';
	$page_post_title_typography = array(
		'font-size' => $page_post_title_typography_['size'],
		'font-family' => $page_post_title_typography_['face'],
		'color' => $page_post_title_typography_['color'],
	);
}

$page_post_content_typography = array(
	'font-size' => '14px',
	'font-family' => 'Open Sans, sans-serif',
	'color' => '#555555'
	);

$page_post_content_typography_ = singlepage_option_saved('page_post_content_typography');
if($page_post_content_typography_){
	if($page_post_content_typography_['color'] == '') $page_post_content_typography_['color'] = '#555555';
	$page_post_content_typography = array(
		'font-size' => $page_post_content_typography_['size'],
		'font-family' => $page_post_content_typography_['face'],
		'color' => $page_post_content_typography_['color'],
	);
}
	
$panel = 'singlepage_typography';
	
$panels[] = array(
	'settings' => $panel,
	'title' => __( 'SP: Typography', 'singlepage' ),
	'priority' => '9'
);

$section = 'singlepage_typography_general';
$sections[] = array(
	'settings' => $section,
	'title' => __( 'General', 'singlepage'  ),
	'priority' => '9',
	'panel' => $panel
);

$options['load_google_fonts'] = array(
	'type'     => 'text',
	'settings' => 'load_google_fonts',
	'label'    => __('Load Google Fonts', 'singlepage' ),
	'section'  => $section,
	'default'  => '',
	'priority' => 10,
	'description'=> __('For example:  Open+Sans:300,400,700|Oswald', 'singlepage')
 );

$section = 'colors';

$options['content_link_color'] = array(
	'type'     => 'color',
	'settings' => 'content_link_color',
	'label'    => __('Content Link Color', 'singlepage' ),
	'section'  => $section,
	'default'  => '#666666',
	'priority' => 10,
 );

$options['content_link_hover_color'] = array(
	'type'     => 'color',
	'settings' => 'content_link_hover_color',
	'label'    => __('Content Link Mouseover Color', 'singlepage' ),
	'section'  => $section,
	'default'  => '#fe8a02',
	'priority' => 10,
 );


$options['home_nav_menu_hover_color'] = array(
	'type'     => 'color',
	'settings' => 'home_nav_menu_hover_color',
	'label'    => __('Home Page Menu Active Color', 'singlepage' ),
	'section'  => $section,
	'default'  => '#ffffff',
	'priority' => 10,
 );

$options['blog_menu_hover_color'] = array(
	'type'     => 'color',
	'settings' => 'blog_menu_hover_color',
	'label'    => __('Page Menu Active Color', 'singlepage' ),
	'section'  => $section,
	'default'  => '#ed9c28',
	'priority' => 10,
	'output' => array(
		array(
			'element'  => '#page-template .site-nav ul li.current_page_parent a,#page-template .site-nav ul li.current-menu-item a',
			'property' => 'color',
		),
		
	) );

$options['home_side_nav_menu_active_color'] = array(
	'type'     => 'color',
	'settings' => 'home_side_nav_menu_active_color',
	'label'    => __('Side Nav Menu Active Color', 'singlepage' ),
	'section'  => $section,
	'default'  => '#23dd91',
	'priority' => 10,
	'output' => array(
		array(
			'element'  => 'body #sub_nav.sub_nav_style1 ul li.active a,body #sub_nav.sub_nav_style2 ul li.active a',
			'property' => 'color',
		),
	),
);

$options['copyright_font_color'] = array(
	'type'     => 'color',
	'settings' => 'copyright_font_color',
	'label'    => __('Copyright Font Color', 'singlepage' ),
	'section'  => $section,
	'default'  => '#ffffff',
	'priority' => 10,
	'output' => array(
		array(
			'element'  => '#footer #footerwrap span#copyright',
			'property' => 'color',
		),
	),
);


$section = 'singlepage_typography_font';
$sections[] = array(
	'settings' => $section,
	'title' => __( 'Font', 'singlepage'  ),
	'priority' => '11',
	'panel' => $panel
);

	
$options['blog_menu_font'] = array(
	'settings' => 'blog_menu_font',
	'label'   => __( 'Blog Menu Typography', 'singlepage' ),
	'section' => $section,
	'type'    => 'typography',
	'default' =>  $blog_menu_typography,
	'output'      => array(
		array(
			'element' => '#page-template .site-nav ul li a',
		),
		)
);


$options['homepage_side_nav_menu_font'] = array(
	'settings' => 'homepage_side_nav_menu_font',
	'label'   => __( 'Homepage Side Nav Menu Typography', 'singlepage' ),
	'section' => $section,
	'type'    => 'typography',
	'default' => $homepage_side_nav_menu_typography,
	'output'      => array(
		array(
			'element' => '#sub_nav ul li a',
		),
		)
);


$options['page_post_title_font'] = array(
	'settings' => 'page_post_title_font',
	'label'   => __( 'Pages & Posts Title Typography', 'singlepage' ),
	'section' => $section,
	'type'    => 'typography',
	'default' => $page_post_title_typography,
	'output'      => array(
		array(
			'element' => '.entry-title',
		),
		)
);


$options['page_post_content_font'] = array(
	'settings' => 'page_post_content_font',
	'label'   => __( 'Pages & Posts Content Typography', 'singlepage' ),
	'section' => $section,
	'type'    => 'typography',
	'default' => $page_post_content_typography,
	'output'      => array(
		array(
			'element' => '.entry-content,.post p,.entry-title,.page p',
		),
		)
);

	return array('options'=>$options,'panels'=>$panels,'sections'=>$sections);
}

$options = singlepage_customizer_library_options();

foreach ( $options['panels'] as $panel ) {
	Kirki::add_panel(
		$panel['settings'], array(
			'priority'    => $panel['priority'],
			'title'       => $panel['title'],
			'description' => '',
		)
	);
}

foreach ( $options['sections'] as $section ) {

	$section_args = array(
		'title'       => $section['title'],
		'description' => '',
		'panel'       => $section['panel'],
	);
	
	Kirki::add_section( $section['settings'], $section_args );
}

foreach ( $options['options'] as $args ) {
	if(isset($args['type']))
		Kirki::add_field( 'singlepage', $args );

}