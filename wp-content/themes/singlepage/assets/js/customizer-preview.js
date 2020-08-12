/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-name' ).text( to );
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-tagline' ).text( to );
		} );
	} );
	
	/* Header text color. */
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-name, .site-tagline' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'display': 'none'
				} );
			} else {
				$( '.site-name, .site-tagline' ).css( {
					'clip': 'auto',
					'color': to,
					'display': 'block'
				} );
			}
		} );
	} );


var singlepage_customizer_section_scroll = function ( $ ) {
    'use strict';
    $( function () {
        var customize = wp.customize;

        customize.preview.bind( 'clicked-customizer-section', function( data ) {
			data = data.replace('sub-accordion-section-singlepage_section_','');
            var sectionId = '';
            switch (data) {
				case '0':
                    sectionId = 'section.home_section_0';
                    break;
               case '1':
                    sectionId = 'section.home_section_1';
                    break;
				case '2':
                    sectionId = 'section.home_section_2';
                    break;
				case '3':
                    sectionId = 'section.home_section_3';
                    break;
                default:
                    sectionId = 'section.home_section_' + data;
                    break;
            }
            if ( $(sectionId).length > 0) {
                $('html, body').animate({
                    scrollTop: $(sectionId).offset().top
                }, 1000);
            }
        } );
    } );
};

singlepage_customizer_section_scroll( jQuery );
	

} )( jQuery );