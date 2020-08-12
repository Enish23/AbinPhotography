<?php

/*
*  get option name
*
*/
function singlepage_get_option_name(){
	
	//$themename = get_option( 'stylesheet' );
	//$themename = preg_replace("/\W/", "_", strtolower($themename) );
	//return $themename;
	return 'singlepage';
}

/**
 * Get option
 */
function singlepage_option($name){
	
	global $singlepage_options, $singlepage_default_options;
	
	if( isset($singlepage_options[$name]) )
		return $singlepage_options[$name];
	elseif(isset($singlepage_default_options['options'][$name]['default']))
		return $singlepage_default_options['options'][$name]['default'];
	else
		return '';
	}
  
function singlepage_option_saved($name){
	
	$singlepage_options = get_option(singlepage_get_option_name());
	
	if( isset($singlepage_options[$name]) )
		return $singlepage_options[$name];
	else
		return '';
	}


if(!function_exists('of_get_option')){
	function of_get_option($name, $default = '' ){
		
		return singlepage_option($name);
		
		}
	}
/*
*  Custom comments list
*
*/
   
  function singlepage_comment($comment, $args, $depth) {
   ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ;?>">
     <div id="comment-<?php comment_ID(); ?>">
	 
	 <div class="comment-avatar"><?php echo get_avatar($comment,'52','' ); ?></div>
			<div class="comment-info">
			<div class="reply-quote">
             <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ;?>
			</div>
      <div class="comment-author vcard">
        
			<span class="fnfn"><?php printf(__('<cite> %s </cite><span class="says">says:</span>','singlepage'), get_comment_author_link()) ;?></span>
								<span class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ;?>">
<?php printf(__('%1$s at %2$s','singlepage'), get_comment_date(), get_comment_time()) ;?></a>
<?php edit_comment_link(__('(Edit)','singlepage'),'  ','') ;?></span>
				<span class="comment-meta">
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ;?>">-#<?php echo $depth?></a>				</span>

      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.','singlepage') ;?></em>
         <br />
      <?php endif; ?>
      
      <?php comment_text() ;?>
</div>
   <div class="clear"></div>
     </div>
<?php
        }

/*
*  title filter
*
*/
function singlepage_the_title( $title ) {
  if ( $title == '' ) {
		return __( 'Untitled', 'singlepage' );
	} else {
		return $title;
	}
}
add_filter( 'the_title', 'singlepage_the_title' );

/*	
*	get background 
*	---------------------------------------------------------------------
*/
function singlepage_get_background($args){
$background = "";
 if (is_array($args)) {
	if (isset($args['image']) && $args['image']!="") {
		$background .=  "background:url(".esc_url($args['image']). ")  ".esc_attr($args['repeat'])." ".esc_attr($args['position'])." ".esc_attr($args['attachment']).";";
	}

	if(isset($args['color']) && $args['color'] !=""){
		$background .= "background-color:".sanitize_hex_color($args['color']).";";
	}

	}
return $background;
}

// allow script & iframe tag within posts
add_action('init', 'singlepage_html_tags_code', 10);
function singlepage_html_tags_code() {
	
	global $allowedposttags;

    $allowed_atts = array(
		'align'      => array(),
		'class'      => array(),
		'type'       => array(),
		'id'         => array(),
		'dir'        => array(),
		'lang'       => array(),
		'style'      => array(),
		'xml:lang'   => array(),
		'src'        => array(),
		'alt'        => array(),
		'href'       => array(),
		'rel'        => array(),
		'rev'        => array(),
		'target'     => array(),
		'novalidate' => array(),
		'type'       => array(),
		'value'      => array(),
		'name'       => array(),
		'tabindex'   => array(),
		'action'     => array(),
		'method'     => array(),
		'for'        => array(),
		'width'      => array(),
		'height'     => array(),
		'data'       => array(),
		'title'      => array(),
	);
	$allowedposttags['form']     = $allowed_atts;
    $allowedposttags["script"] = array("src" => array(),"name" => array(),"id" => array(),"type" => array());
	$allowedposttags['iframe'] = array (
		'align'       => true,
		'frameborder' => true,
		'height'      => true,
		'width'       => true,
		'sandbox'     => true,
		'seamless'    => true,
		'scrolling'   => true,
		'srcdoc'      => true,
		'src'         => true,
		'class'       => true,
		'id'          => true,
		'style'       => true,
		'border'      => true,
	);
	
	$allowedposttags["object"] = array("height" => array(), "width" => array());
	$allowedposttags["param"] = array("name" => array(), "value" => array());
	
	$allowedposttags["embed"] = array(
		"src" => array(),
		"type" => array(),
		"allowfullscreen" => array(),
		"allowscriptaccess" => array(),
		"height" => array(),
		"width" => array()
		);
    $allowedposttags["style"] = array("type" => array());
	$allowedposttags["link"] = array("rel" => array(),"href" => array(),"id" => array(),"type" => array(),"media" => array());
	$allowedposttags["input"] = array("name" => array(),"id" => array(),"value" => array(),"class" => array(),"placeholder" => array(),"required" => array(),"type" => array(),'aria-required' => array());
	$allowedposttags["select"] = array("name" => array(),"id" => array(),"value" => array(),"class" => array(),"required" => array(),"type" => array(),'aria-required' => array());
	$allowedposttags["textarea"] = array("name" => array(),"id" => array(),"value" => array(),"class" => array(),"placeholder" => array(),"required" => array(),"type" => array(),'aria-required' => array());
}

//** fonts **//

/**
* Returns an array of system fonts
* Feel free to edit this, update the font fallbacks, etc.
*/

function singlepage_options_typography_get_os_fonts() {

  // OS Font Defaults

  $os_faces = array(

      'Arial, sans-serif' => 'Arial',

      '"Avant Garde", sans-serif' => 'Avant Garde',

      'Cambria, Georgia, serif' => 'Cambria',

      'Copse, sans-serif' => 'Copse',

      'Garamond, "Hoefler Text", Times New Roman, Times, serif' => 'Garamond',

      'Georgia, serif' => 'Georgia',

      '"Helvetica Neue", Helvetica, sans-serif' => 'Helvetica Neue',

      'Tahoma, Geneva, sans-serif' => 'Tahoma'

  );

  return $os_faces;

}

/*
* Returns a typography option in a format that can be outputted as inline CSS
*/
function singlepage_options_typography_font_styles($option, $selectors) {

      $output = $selectors . ' {';

      $output .= ' color:' . $option['color'] .'; ';

      $output .= 'font-family:' . $option['face'] . '; ';

      $output .= 'font-weight:' . $option['style'] . '; ';

      $output .= 'font-size:' . $option['size'] . '; ';

      $output .= '}';

      $output .= "\n";
      return $output;

}

function singlepage_options_typography_font_styles2($option) {

      $output = '';
      $output .= ' color:' . $option['color'] .'; ';
      $output .= 'font-family:' . $option['face'] . '; ';
      $output .= 'font-weight:' . $option['style'] . '; ';
      $output .= 'font-size:' . $option['size'] . '; ';
      return $output;
}

/**
 * Convert Hex Code to RGB
 * @param  string $hex Color Hex Code
 * @return array       RGB values
 */
 
function singlepage_hex2rgb( $hex ) {
		if ( strpos( $hex,'rgb' ) !== FALSE ) {

			$rgb_part = strstr( $hex, '(' );
			$rgb_part = trim($rgb_part, '(' );
			$rgb_part = rtrim($rgb_part, ')' );
			$rgb_part = explode( ',', $rgb_part );

			$rgb = array($rgb_part[0], $rgb_part[1], $rgb_part[2], $rgb_part[3]);

		} elseif( $hex == 'transparent' ) {
			$rgb = array( '255', '255', '255', '0' );
		} else {

			$hex = str_replace( '#', '', $hex );

			if( strlen( $hex ) == 3 ) {
				$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
				$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
				$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
			} else {
				$r = hexdec( substr( $hex, 0, 2 ) );
				$g = hexdec( substr( $hex, 2, 2 ) );
				$b = hexdec( substr( $hex, 4, 2 ) );
			}
			$rgb = array( $r, $g, $b );
		}

		return $rgb; // returns an array with the rgb values
	}

/**
* Standard fonts
*/
function singlepage_standard_fonts(){
	$standard_fonts = array(
			
			'open-sans' => array(
				'label' => 'Open Sans',
				'stack' => 'Open Sans, sans-serif',
			),
			'arial' => array(
				'label' => 'Arial',
				'stack' => 'Arial, sans-serif',
			),
			'cambria' => array(
				'label'  => 'Cambria',
				'stack'  => 'Cambria, Georgia, serif',
			),
			'calibri' => array(
				'label' => 'Calibri',
				'stack' => 'Calibri,sans-serif',
			),
			'copse' => array(
				'label' => 'Copse',
				'stack' => 'Copse, sans-serif',
			),
			'garamond' => array(
				'label' => 'Garamond',
				'stack' => 'Garamond, "Hoefler Text", Times New Roman, Times, serif',
			),
			'georgia' => array(
				'label' => 'Georgia',
				'stack' => 'Georgia, serif',
			),
			'helvetica-neue' => array(
				'label' => 'Helvetica Neue',
				'stack' => '"Helvetica Neue", Helvetica, sans-serif',
			),
			'tahoma' => array(
				'label' => 'Tahoma',
				'stack' => 'Tahoma, Geneva, sans-serif',
			),
			'lustria' => array(
				'label' => 'Lustria',
				'stack' => 'Lustria,serif',
			),
		);
	return $standard_fonts;	
	}
		
add_filter( 'kirki/fonts/standard_fonts', 'singlepage_standard_fonts' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function singlepage_customize_register( $wp_customize ) {
	
	$wp_customize->get_section ('colors')->panel = 'singlepage_typography';
	
	}
add_action( 'customize_register', 'singlepage_customize_register',999 );

/**
 * home page secations order
 */
function singlepage_get_sections( $default ){
	
	$sections = $default;
	$section_order = singlepage_option_saved('section_order');

	if($section_order!=''){
		$new_sections = json_decode( trim(str_replace('&quot;','"',$section_order)), true);

		if( is_array($new_sections ) ) {
			foreach($default as $k=>$v){
				//$sections = array_merge($default, $new_sections);
				if(isset($new_sections[$k]))
					$sections[$k] = $new_sections[$k];
				}
			
		}
	}
	
	return $sections;
}