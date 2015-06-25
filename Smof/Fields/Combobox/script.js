 (function( $ ) {
$.widget( "ui.combobox", {
	_create: function() {
		
		this.wrapper = $( "<span>" )
		.addClass( "smof-combobox" ).insertBefore( this.element );
		
		this.wrapper.append( this.element );

		
		console.log( this.element );
	
		this._createAutocomplete();
		this._createShowAllButton();
	},
	_createAutocomplete: function() {
		
		console.log( window[ this.element.data( 'smof-source-name' ) ] );

		this.element.autocomplete({
			delay: 0,
			minLength: 0,
			source: window[ this.element.data( 'smof-source-name' ) ]
		})
		.tooltip({
			tooltipClass: "ui-state-highlight"
		});
		/*
		this._on( this.input, {
			autocompleteselect: function( event, ui ) {
				ui.item.option.selected = true;
				this._trigger( "select", event, {
				item: ui.item.option
				});
				this._selectTriggerChange();
			},
			autocompletechange: "_removeIfInvalid"
		});
		*/
	},
	_createShowAllButton: function() {
		var input = this.element,
		wasOpen = false;
		$( "<a>" )
		.attr( "tabIndex", -1 )
		.attr( "title", "Show All Items" )
		.tooltip()
		.appendTo( this.wrapper )
		.button({
		icons: {
		primary: "ui-icon-triangle-1-s"
		},
		text: false
		})
		.removeClass( "ui-corner-all" )
		.addClass( "smof-combobox-toggle ui-corner-right" )
		.mousedown(function() {
		wasOpen = input.autocomplete( "widget" ).is( ":visible" );
		})
		.click(function() {
		input.focus();
		console.log( wasOpen );
		// Close if already visible
		if ( wasOpen ) {
		return;
		}
		// Pass empty string as value to search for, displaying all results
		input.autocomplete( "search", "" );
		});
	},
	/*
	_source: function( request, response ) {
		var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
		response( this.element.children( "option" ).map(
				function() {
					var text = $( this ).text();
					
					if ( this.value && ( !request.term || matcher.test(text) )  )
						return {
							label: text,
							value: text,
							option: this
						};
				}
			) 
		);
	},
	*/
	/*
	_removeIfInvalid: function( event, ui ) {

		// Selected an item, nothing to do
		if ( ui.item ) {
			return;
		}
		
		// Search for a match (case-insensitive)
		var value = this.input.val(),
		valueLowerCase = value.toLowerCase(),
		valid = false;
		this.element.children( "option" ).each(function() {
			if ( $( this ).text().toLowerCase() === valueLowerCase ) {
				this.selected = valid = true;
				return false;
			}
		});
		
		// Found a match, nothing to do
		if ( valid ) {
			this._selectTriggerChange();
			return;
		}
		
		// Remove invalid value
		this.input
		.val( "" )
		.attr( "title", value + " didn't match any item" )
		.tooltip( "open" );
		this.element.val( "" );
		this._delay(function() {
			this.input.tooltip( "close" ).attr( "title", "" );
		}, 2500 );
		this._selectTriggerChange();
		this.input.autocomplete( "instance" ).term = "";
		
	},

	_destroy: function() {
		this.wrapper.remove();
		this.element.show();
	},
	*/
	_selectTriggerChange: function(){
		this.element.trigger( "change" );
	}
});
})( jQuery );

var SmofCombobox = function(){
	
}

SmofCombobox.addEvent = function( prefix ){
	
	prefix = SmofEvents.getPrefix( prefix );
	
	jQuery( document.getElementsByTagName('html')[0].getElementsByClassName( "smof-field-combobox" ) ).each(function(index, value) {
		
		if( jQuery( this ).parents( '.smof-repeatable-pattern-item' ).first().get( 0 ) ) {
			
		}else{
			jQuery( this ).combobox();
		}

	});
	
}

jQuery(function() {

	SmofCombobox.addEvent();

});

/*
 $(function() {
    var projects = [
      {
        value: "jquery",
        label: "jQuery",
        desc: "the write less, do more, JavaScript library",
        icon: "jquery_32x32.png"
      },
      {
        value: "jquery-ui",
        label: "jQuery UI",
        desc: "the official user interface library for jQuery",
        icon: "jqueryui_32x32.png"
      },
      {
        value: "sizzlejs",
        label: "Sizzle JS",
        desc: "a pure-JavaScript CSS selector engine",
        icon: "sizzlejs_32x32.png"
      }
    ];
 
    $( "#project" ).autocomplete({
      minLength: 0,
      source: projects,
      focus: function( event, ui ) {
        $( "#project" ).val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
        $( "#project" ).val( ui.item.label );
        $( "#project-id" ).val( ui.item.value );
        $( "#project-description" ).html( ui.item.desc );
        $( "#project-icon" ).attr( "src", "images/" + ui.item.icon );
 
        return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a>" + item.label + "<br>" + item.desc + "</a>" )
        .appendTo( ul );
    };
  });

*/
