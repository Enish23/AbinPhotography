jQuery(document).ready(function($){
    'use strict';
	var customize = wp.customize;
	$('#sub-accordion-panel-singlepage_homepage > li.control-section > .accordion-section-title').append('<i class="fa fa-arrows">&nbsp;</i>');
	
	var sections_container = $('#sub-accordion-panel-singlepage_homepage');
		
    update_order();
    sections_container.sortable({
        axis: 'y',
        items: '> li[id^="accordion-section-singlepage_section"]',
        handle: '> h3',
        update: function(){
			
            update_order();
        },
        helper : 'clone',
        placeholder: 'ui-state-highlight'
    });

    function update_order(){
        var values = {};
        var idsInOrder = sections_container.sortable({
            axis: 'y',
            items: '> li[id^="accordion-section-singlepage_section"]',
            handle: '> h3',
            helper : 'clone',
            placeholder: 'ui-state-highlight'
        });
        var sections = idsInOrder.sortable('toArray');
		
        for(var i = 0; i < sections.length; i++){
            var section_id =  sections[i].replace('accordion-section-singlepage_section_','');
            values[i] = section_id;
        }
		
        var data_to_send = JSON.stringify(values);

		customize.instance('singlepage[section_order]').set(data_to_send)
        customize.instance('singlepage[section_order]').previewer.refresh();

    }
	
	var singlepage_customize_scroller = function ( $ ) {
    'use strict';

    $( function () {
        var customize = wp.customize;

        $('ul[id*="accordion-section-singlepage_section"] .accordion-section').not('.panel-meta').each( function () {
            $( this ).on( 'click', function() {
                var section = $( this ).attr('aria-owns').split( '_' ).pop();
                customize.previewer.send('clicked-customizer-section', section);
            });
        });
    } );
};

singlepage_customize_scroller( jQuery );

});