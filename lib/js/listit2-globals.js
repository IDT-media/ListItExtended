/************************************************************
 FUNCTIONS
************************************************************/

function show_message(text) {

	if(text != ''){
		var message = jQuery('<div class="pagemcontainer"><p class="pagemessage">' + text + '</p></div>').insertBefore('#page_tabs');
		window.setTimeout(function(){ message.hide(); }, 9000);
	} 
}

function initAjax(){

	jQuery('.init-ajax-toggle').children("a").addClass('ajax-toggle');
	jQuery('.init-ajax-delete').children("a").addClass('ajax-delete');
}

function initAjaxEvents() {

	jQuery('.ajax-toggle').click(function (event) {

		event.preventDefault();		
		ajax_toggle($(this));
	});
	
	jQuery('.ajax-delete').click(function (event) {

		event.preventDefault();
	
		if(confirm('Are you sure?')) {
	
			ajax_delete($(this));
		}
	});		
}

/************************************************************
 JQUERY INIT (Run initial stuff here)
************************************************************/

jQuery(function($){

	initAjax();
	initAjaxEvents();
});

/************************************************************
 AJAX LOADING (Only load ajax functions in here)
************************************************************/

/**
* DELETE ITEM
* @ obj : jQuery DOM object
*/
function ajax_delete(obj) {

	var url = obj.attr("href");
	url += "&showtemplate=false";
		
	jQuery.ajax({
		type: "GET",
		url: url,
		async: true,
		dataType: "html",
		beforeSend: function() {
		
			obj.empty().append('<div class="ajax-loading ajax-loader-type-16"></div>');
		},
		error: function(jqXHR, textStatus, errorThrown) {
			
			//alert("Sorry. There was an ListIt2 AJAX error: " + textStatus);
		},			
		success: function(data) {
			
			show_message(data);
		},
		complete: function() {
		
			obj.closest("tr").fadeOut(500, function() {

				var table = $(this).closest("table");
				var totalrows = table.find("tbody tr").size();					
				
				$(this).remove();
				
				table.find("tbody tr").removeClass();
				table.find("tbody tr:nth-child(2n+1)").addClass("row1");
				table.find("tbody tr:nth-child(2n)").addClass("row2");					
				
			});
		}		
		
	});

}

/**
* TOGGLE ACTIVE
* @ obj : jQuery DOM object
*/
function ajax_toggle(obj) {

	var url = obj.attr("href");
	url += "&showtemplate=false";
		
	jQuery.ajax({
		type: "GET",
		url: url,
		async: true,
		dataType: "json",
		beforeSend: function() {
		
			obj.empty().append('<div class="ajax-loading ajax-loader-type-16"></div>');
		},
		error: function(jqXHR, textStatus, errorThrown) {
			
			//alert("Sorry. There was an ListIt2 AJAX error: " + textStatus);
		},			
		success: function(data) {
			
			obj.html(data.image);				
			obj.attr("href", data.href);
		},
		complete: function() {
		
			$(this, ".ajax-loading").remove();
		}		
		
	});
}