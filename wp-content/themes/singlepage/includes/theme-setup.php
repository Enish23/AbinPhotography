<?php

function singlepage_setup(){
	
	global $content_width;
	
	$lang = get_template_directory(). '/languages';
	load_theme_textdomain('singlepage', $lang);
	add_theme_support( 'post-thumbnails' ); 
	$args = array();
	$header_args = array(
	    'default-image'          => '',
		'default-repeat'         => 'no-repeat',
        'default-text-color'     => 'f0ad4e',
		'url'                    => '',
        'width'                  => 1920,
        'height'                 => 89,
        'flex-height'            => true,
     );
	add_theme_support( 'custom-background', $args );
	add_theme_support( 'custom-header', $header_args );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('nav_menus');
	add_theme_support( "title-tag" );
	register_nav_menus( array('primary' => __( 'Primary Menu', 'singlepage'),'home' => __( 'Home Page Top Menu', 'singlepage' ) ));
	add_editor_style("editor-style.css");
	add_image_size( 'blog', 609, 214 , true);
	if ( !isset( $content_width ) ) $content_width = 1170;
}

add_action( 'after_setup_theme', 'singlepage_setup' );

function singlepage_custom_scripts(){
	
	global $is_IE, $singlepage_options, $singlepage_sections, $singlepage_default_options;
	
	$singlepage_default_options = singlepage_customizer_library_options();
	$singlepage_options = (array)get_option(singlepage_get_option_name());

	//$singlepage_options = array_merge($default_options,$singlepage_options);
	
	$theme_info = wp_get_theme();
	$post_type =  get_post_type( get_the_ID() );
	$detect = new Mobile_Detect;
	$api_key = singlepage_option( 'gmap_api_key' );
	
	$youtube_video_background_section = singlepage_option( 'youtube_video_background_section' );
	$youtube_video                    = singlepage_option( 'youtube_video' );
	
	if( $youtube_video_background_section > 0 && $youtube_video != '' && (is_home() || is_front_page() ) ):
		wp_enqueue_style('jquery-mb-ytplayer',  get_template_directory_uri() .'/assets/vendor/YTPlayer/css/jquery.mb.YTPlayer.min.css', false, '4.0.3', false);
		wp_enqueue_script( 'jquery-mb-ytplayer', get_template_directory_uri().'/assets/vendor/YTPlayer/jquery.mb.YTPlayer.min.js', array( 'jquery' ), '', false );
	endif;
	
	wp_enqueue_style('jquery-fullpage',  get_template_directory_uri() .'/assets/vendor/fullPage.js/jquery.fullpage.min.css', false, '2.9.7', false);
	wp_enqueue_script( 'jquery-fullpage', get_template_directory_uri().'/assets/vendor/fullPage.js/jquery.fullpage.min.js', array( 'jquery', 'jquery-ui-core' ), '2.9.7', false );
	
	$load_google_fonts = singlepage_option('load_google_fonts');
    if( trim($load_google_fonts) !='' ){
		$google_fonts = str_replace(' ','+',trim($load_google_fonts));
		wp_enqueue_style('singlepage-google-fonts', esc_url('//fonts.googleapis.com/css?family='.$google_fonts), false, '', false );
	}
	
	wp_enqueue_style('font-awesome',  get_template_directory_uri() .'/assets/vendor/font-awesome/css/font-awesome.min.css', false, '4.2.0', false);
	wp_enqueue_style('bootstrap',  get_template_directory_uri() .'/assets/vendor/bootstrap/css/bootstrap.css', false, '4.0.3', false);
	wp_enqueue_style( 'singlepage-main', get_stylesheet_uri(), array(),  $theme_info->get( 'Version' ) );
	
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/assets/vendor/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '3.0.3', false );
	wp_enqueue_script( 'respond', get_template_directory_uri().'/assets/vendor/respond.min.js', array( 'jquery' ), '1.4.2', false );
	wp_enqueue_script( 'modernizr-custom', get_template_directory_uri().'/assets/vendor/modernizr.custom.js', array( 'jquery' ), '2.8.2', false );
	wp_enqueue_script( 'jquery-easing', get_template_directory_uri().'/assets/vendor/jquery.easing.1.3.js', array( 'jquery' ), '1.3', false );
	wp_enqueue_script( 'jquery-nav', get_template_directory_uri().'/assets/vendor/jquery.nav.js', array( 'jquery' ), '3.0.0', false );
	
	//wp_enqueue_script( 'smoothscroll', get_template_directory_uri().'/assets/vendor/smoothscroll.js', array( 'jquery' ), '0.0.9', false );
	
	$video_background_section  = singlepage_option( 'video_background_section' );
	if( $video_background_section > 0 && (is_home() || is_front_page() ) ){
	
		wp_enqueue_script( 'video', get_template_directory_uri().'/assets/vendor/video.js', array( 'jquery','jquery-ui-core' ), '4.3.0', false );
		wp_enqueue_script( 'bigvideo', get_template_directory_uri().'/assets/vendor/bigvideo.js', array( 'jquery' ), '', false );
	}
	
	$google_map_section  = singlepage_option( 'google_map_section' );
	if( $google_map_section>0 && (is_home() || is_front_page() ) )
		wp_enqueue_script( 'singlepage-googlemap',esc_url('//maps.googleapis.com/maps/api/js?key='.trim($api_key).'&v=3.exp&signed_in=true'), array( 'jquery' ), '', false );
	
	wp_enqueue_script( 'device', get_template_directory_uri().'/assets/vendor/device.js', array( 'jquery' ),  $theme_info->get( 'Version' ), true );
	wp_enqueue_script( 'singlepage-main', get_template_directory_uri().'/assets/js/common.js', array( 'jquery' ),  $theme_info->get( 'Version' ), true );
	
	if( $is_IE ) {
		wp_enqueue_script( 'html5', get_template_directory_uri().'/assets/vendor/html5.js', array( 'jquery' ), '', false );
	}
	
	$scrolldelay                = singlepage_option('scrolldelay');
	$section_height_mode        = singlepage_option('section_height_mode');
	$section_height_mode_mobile = absint(singlepage_option('section_height_mode_mobile'));
	
	$is_mobile = 0;
	if( $detect->isMobile() && !$detect->isTablet() ){
		$is_mobile = 1;
	}
	
		
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){wp_enqueue_script( 'comment-reply' );}
	
	$background_array  = singlepage_option("blog_background");
    $blog_background   = singlepage_get_background($background_array);
	
	$singlepage_custom_css   =  str_replace('&gt;','>',esc_html(singlepage_option("custom_css")));
	$singlepage_custom_css  .=  'body#template-site{'.esc_html($blog_background).'}';
	
	 $header_image       = get_header_image();
	if (isset($header_image) && ! empty( $header_image )) {
		$singlepage_custom_css .= "header.navbar{background:url(".esc_url($header_image). ");}\n";
	}
	
	 if ( 'blank' != get_header_textcolor() && '' != get_header_textcolor() ){
     	$header_color           =  ' color:#' . get_header_textcolor() . ';';
		$singlepage_custom_css .=  '.site-name,.site-tagline{'.$header_color.'}';
	}
	
	$home_side_nav_circle_color = singlepage_option("home_side_nav_circle_color");
	
	$home_side_nav_circle_image = singlepage_option("home_side_nav_circle_image");
	
	if($home_side_nav_circle_image !='')
		$singlepage_custom_css .=  '.sub_nav .active{background-image:url('.esc_url($home_side_nav_circle_image).');}';
	else
		$singlepage_custom_css .=  '.sub_nav .active{background:url('.get_template_directory_uri().'/assets/images/'.$home_side_nav_circle_color.'.png) 0 50% no-repeat}';
		
	//Sections
	$sections = singlepage_get_sections(array(0,1,2,3,4,5));
	
	$sectionID = array();
	
	foreach( $sections as $key=>$i ){
		if(singlepage_option("section_hide_".$i) != '1'):
		
			$section_content_font  = singlepage_option("section_content_font_".$i);
			$section_hide_nav      = singlepage_option("section_hide_nav_".$i);
			
			if($section_content_font){
				$singlepage_custom_css .=  ".home_section_".$i. ",.home_section_".$i. " p,.home_section_".$i. " div,.home_section_".$i. " li{font-size:".$section_content_font['font-size'].";font-family:".$section_content_font['font-family'].";color:".$section_content_font['color'].";}";
				$singlepage_custom_css .=  "section.home_section_".$i." .section-content,.home_section_".$i. " h1,.home_section_".$i. " h2,.home_section_".$i. " h3,.home_section_".$i. " h4,.home_section_".$i. " h5,.home_section_".$i." h6{font-family:".$section_content_font['font-family'].";color:".$section_content_font['color'].";}";
				$singlepage_custom_css .=  ".home_section_".$i. " i{font-size:".$section_content_font['font-size'].";color:".$section_content_font['color'].";}";
			}
			
			if( $section_hide_nav == '1' ){
				$singlepage_custom_css .=  "body section.section.home_section_".$i. "{z-index:99;}";
			}
			
			$menu_slug          =  singlepage_option('section_menu_slug_'.$i );
			if( !$menu_slug )
				$menu_slug =  'section-'.($i+1);
			
			$sectionIDs[] = $menu_slug;
			
		endif;
	}
	
	$sectionIDs[] = 'section-footer';
	
	////Typography
	
	$content_link_color  = singlepage_option("content_link_color");
	$singlepage_custom_css    .=  'a{color:'.sanitize_hex_color($content_link_color).';}';
	
	$content_link_hover_color  = singlepage_option("content_link_hover_color");
	$singlepage_custom_css    .=  'a:hover,#main #main-content .post .meta a:hover{color:'.sanitize_hex_color($content_link_hover_color).';}';
	
	$footer_background  = singlepage_option("footer_background");
	if($footer_background){
    	$singlepage_custom_css .=  '#featured-template #footer{'.singlepage_get_background($footer_background).'}';
	}
	
	$menu_style_desktop   = absint( singlepage_option( 'menu_style_desktop'));
	$menu_status_desktop  = esc_attr( singlepage_option( 'menu_status_desktop'));
	$menu_style_tablet    = absint( singlepage_option( 'menu_style_tablet'));
	$menu_status_tablet   = esc_attr( singlepage_option( 'menu_status_tablet'));
	$menu_style_mobile    = absint( singlepage_option( 'menu_style_mobile'));
	$menu_status_mobile   = esc_attr( singlepage_option( 'menu_status_mobile'));
	
	
	
	$singlepage_custom_css     .='

	 /* Custom, iPhone Retina */ 
@media only screen and (min-width : 320px) {
   		.sub_nav_style1{ display:none; }
		.sub_nav_style2{ display:none; }
		.sub_nav_style'.$menu_style_mobile.'{ display:block; } 
}
 
/* Extra Small Devices, Phones */ 
@media only screen and (min-width : 480px) {
 
}
 
/* Small Devices, Tablets */
@media only screen and (min-width : 720px) {
	.sub_nav_style1{ display:none; }
	.sub_nav_style2{ display:none; }
	.sub_nav_style'.$menu_style_tablet.'{ display:block; } 
}
 
/* Medium Devices, Desktops */
@media only screen and (min-width : 992px) {
	 
}
 
/* Large Devices, Wide Screens */
@media only screen and (min-width : 1200px) {
	.sub_nav_style1{ display:none; }
	.sub_nav_style2{ display:none; }
	.sub_nav_style'.$menu_style_desktop.'{ display:block; } 
}
	';

		
	wp_add_inline_style( 'singlepage-main', wp_filter_nohtml_kses($singlepage_custom_css) );
	

	$padding = array(
			'mobile'=>singlepage_option('content_container_left_768'),
			'tablet'=>singlepage_option('content_container_left_992'),
			'desktop'=>singlepage_option('content_container_width_1200_2')
			);
	
	wp_localize_script( 'singlepage-main', 'singlepage_params',  array(
			'ajaxurl'        => admin_url('admin-ajax.php'),
			'themeurl' => get_template_directory_uri(),
			'scrolldelay' => $scrolldelay,
			'is_mobile' => $is_mobile,
			'section_height_mode'=>$section_height_mode,
			'section_height_mode_mobile'=>$section_height_mode_mobile,
			'padding' => $padding,
			'sectionIDs'  => $sectionIDs,
		)  );
	
	}

  add_action( 'wp_enqueue_scripts', 'singlepage_custom_scripts' );

// Enqueue backup style
if ( ! function_exists( 'singlepage_extensions_enqueue' ) ) {
	function singlepage_extensions_enqueue() {
		global $wp_customize;
		$current_screen = get_current_screen();

		if( $current_screen->id === "widgets" || $current_screen->id === "customize" || isset( $wp_customize ) ) :
			wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/vendor/font-awesome/css/font-awesome.css', array(), '20170730', 'all' );
			wp_enqueue_style( 'singlepage-extensions-widgets-customizer', get_template_directory_uri() . '/assets/css/widgets-customizer.css', array(), '20170730', 'all' );
			wp_enqueue_script(
				'singlepage-extensions-widgets-customizer',
				get_template_directory_uri() . '/assets/js/widgets-customizer.js',
				array( 'jquery', 'jquery-ui-sortable', 'jquery-ui-autocomplete', 'wp-color-picker' ),
				'20170730', FALSE
			);
		wp_localize_script( 'singlepage-extensions-widgets-customizer', 'singlepage_params', array(
			'ajaxurl'  => admin_url('admin-ajax.php'),
		));
		endif;
	}
}
add_action( 'admin_enqueue_scripts', 'singlepage_extensions_enqueue' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function singlepage_customize_preview_js() {
	wp_enqueue_script( 'singlepage-customizer-preview', get_template_directory_uri() . '/assets/js/customizer-preview.js', array( 'jquery', 'customize-preview' ), '', true );
}
add_action( 'customize_preview_init', 'singlepage_customize_preview_js' );

function singlepage_customize_controls_js() {
	wp_enqueue_script( 'singlepage-customizer-controls', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview', 'jquery-ui-sortable', 'jquery-ui-autocomplete' ), '', true );
	wp_enqueue_style( 'singlepage-customizer-controls', get_template_directory_uri() . '/assets/css/customizer.css', array(), '', '' );
}
add_action( 'customize_controls_init', 'singlepage_customize_controls_js' );