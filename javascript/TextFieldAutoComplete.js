/**
 * Register Autocomplete functions with fields.
 */

(function($) {
	$.entwine('ss.textfieldautocomplete', function($){
		$('.field.textfieldautocomplete input.text').entwine({
    		onmatch: function() {
    			var input = $(this);
    			input.autocomplete({
    				source: JSON.parse(input.attr('data-source'))
    			});
    		},
		});
	});
})(jQuery);
