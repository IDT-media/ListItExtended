/************************************************************
 FUNCTIONS
 ************************************************************/

function updateRows() {
    $('table#sortable_item > tbody > tr').removeClass('row1').removeClass('row2');
    $('table#sortable_item > tbody > tr:visible:even').addClass('row2');
    $('table#sortable_item > tbody > tr:visible:odd').addClass('row1');
}

function initTableSorter() {
    
    $('table:not(.no-sorter)').footable().bind({
        'footable_sorted' : function() {
            updateRows();
        },
        'footable_filtered' : function() {
            updateRows();
        },
        'footable_row_expanded' : function() {
            initAjax();
            initAjaxEvents();
            
            $('.footable-row-detail-name:empty').hide();
        },
        // this sucks, but handling breakpoint class depending on window size due to invisible toggle button
        'footable_resized' : function() {
            if ($(window).innerWidth() < 1240) {
                $('table#sortable_item').addClass('breakpoint');
            } else {
                $('table#sortable_item').removeClass('breakpoint');
            }
        }
    });
}

function initDatepicker() {
    $('#m1_start_time, #m1_end_time')
		.datetimepicker({
			dateFormat: 'yy-mm-dd',
			timeFormat: 'HH:mm',
			hourGrid: 4,
			minuteGrid: 10,
			secondGrid: 10
		});	
}

function initSortable() {

    $('body').delegate('#m1_submit_itemorder', 'click', function(event) {

        event.preventDefault();

        var newOrderIds = getOrdering('#sortable_item');
        var callback = ajax_function('SaveItemOrder', newOrderIds);
        callback.success(function(data) {
            show_message(data);
        });

    });

    $('body').delegate('#m1_submit_fielddeforder', 'click', function(event) {

        event.preventDefault();

        var newOrderIds = getOrdering('#sortable_fielddef');
        var callback = ajax_function('SaveFieldDefOrder', newOrderIds);
        callback.success(function(data) {
            show_message(data);
        });

    });

    var getOrdering = function(item) {

        var newOrdering = $(item).find("tbody.content").sortable('toArray');

        if (item == '#sortable_item')
            var l = "item_".length;

        if (item == '#sortable_fielddef')
            var l = "fielddef_".length;

        var newOrderIds = new Array(newOrdering.length);
        var ctr = 0;
        // Loop over each value in the array and get the ID
        $.each(newOrdering, function(intIndex, objValue) {
            //Get the ID of the reordered items
            //- this is sent back to server to save
            newOrderIds[ctr] = objValue.substring(l, objValue.length);
            ctr = ctr + 1;
        });
        return newOrderIds;
    };

    //fix table width on sorting
    var fixHelper = function(e, ui) {
        ui.children().each(function() {
            $(this).width($(this).width());
        });
        return ui;
    };

    //run sortable function
    $("#sortable_item tbody.content, #sortable_fielddef tbody.content").sortable({
        helper : fixHelper,
        update : function(event, ui) {
            $("#sortable_item, #sortable_fielddef").find("tbody.content tr:odd").attr('class', "row2");
            $("#sortable_item, #sortable_fielddef").find("tbody.content tr:even").attr('class', "row1");
        }
    });
    $("#sortable_item, #sortable_fielddef").find("tbody.content").disableSelection();
}

function initSelectAll() {
    $('#check_all_item, #check_all_category, #check_all_fielddef').click(function() {

        $(this).closest('table').find("tbody tr").each(function() {

            $checkbox = $(this).find(':checkbox');
            $checkbox.prop('checked', !$checkbox[0].checked);
        });
    });
}

function initSlug() {

    if ($('#m1_alias').val() == '') {
        $('#m1_alias').addClass('slug');
        // slug alias
        $("#m1_title").slug({
            slug : 'slug', // class of input / span that contains the generated slug
            hide : false, // hide the text input, true by default
            prefix : 'item-'
        });
    }
}

function initQuickSearch() {
    
    $('table#sortable_item').trigger('footable_filter',
        {
            filter: $('input#item_search').val()
        }
    );
    
    $('#quicksearch_form').submit(function(event) {
        event.preventDefault();
    });
}

function initColorBox() {

    if (( $('.cbox').length !== 0 ) && ( typeof $.colorbox === 'function' )) {
        $('.cbox').colorbox({
            scalePhotos : true,
            maxWidth : 800,
            maxHeight : 600,
            rel : 'group',
            opacity : 0.2
        });
    }
}


/************************************************************
 $ INIT (Run initial stuff here)
 ************************************************************/

$(function($) {

    $(".pagemcontainer").each(function() {
        var c = $(this);
        window.setTimeout(function() {
            c.hide();
        }, 9000);
    });
    
    // initialize footable
    $('table#sortable_item').footable({
        breakpoints: {
            phone: 380,
            tablet: 940
        }
    });
    
    // handle breakpoint (quickfix when only title row is shown)
    var $window = $(window),
        $table = $('table#sortable_item');
    
    // this sucks, but handling breakpoint class depending on window size due to invisible toggle button
    if ($(window).innerWidth() < 1240) {
        $('table#sortable_item').addClass('breakpoint');
    } else {
        $('table#sortable_item').removeClass('breakpoint');
    }
    
    initSortable();
    initSelectAll();
    initDatepicker();
    initTableSorter();
    initSlug();
    initQuickSearch();
    initColorBox();
});

/************************************************************
 AJAX LOADING (Only load ajax functions in here)
 ************************************************************/

/**
 * Access module object methods with this
 * @ usr_function: Method of module object
 * @ params: Params to module object
 */
function ajax_function(usr_function, params) {

    return $.post(CMS_ADMIN_DIR + "/moduleinterface.php" + CMS_USER_KEY, {
        mact : MODULE_NAME + ',m1_,ajax,0',
        m1_usr_function : usr_function,
        showtemplate : false,
        m1_params : params
    });
}

$(function($) {

    /**
     * TYPE SELECT
     */
    $('#m1_type').change(function(event) {

        var url = $(this).closest("form").attr("action");
        var params = $(this).closest("form").serialize();
        params += "&showtemplate=false";
        var selector = '.listit2_typeoptions';

        $.ajax({
            type : "POST",
            url : url,
            async : true,
            dataType : "html",
            data : params,
            beforeSend : function() {

                $(selector).empty().append('<div class="pageoverflow"><div class="pageinput"><div class="ajax-loading ajax-loader-type-wide"></div></div></div>');
            },
            error : function(jqXHR, textStatus, errorThrown) {

                alert("Sorry. There was an ListIt2 AJAX error: " + textStatus);
            },
            success : function(data) {

                var my_data = $(selector, data).html();
                $(selector).html(my_data);
            }
        });
    });

    /**
     * MASS ACTION ITEMS
     */
    $('#listit2_item_mass_action').change(function(event) {

        if (confirm('Are your sure?')) {

            var items = $(".item-mass-action :input").serializeArray();

            switch($(this).val()) {
                case 'delete':

                    $.each(items, function(i, field) {
                        ajax_delete($("#item_" + field.value).find(".ajax-delete"));
                    });
                    break;

                case 'approve':

                    $.each(items, function(i, field) {
                        ajax_toggle($("#item_" + field.value).find(".approve-item .ajax-toggle"));
                    });
                    break;
            }

        }

        $(this).val(0);

    });

    /**
     * MASS ACTION CATEGORIES
     */
    $('#listit2_category_mass_action').change(function(event) {

        if (confirm('Are your sure?')) {

            var items = $(".category-mass-action :input").serializeArray();

            switch($(this).val()) {
                case 'delete':

                    $.each(items, function(i, field) {
                        ajax_delete($("#category_" + field.value).find(".ajax-delete"));
                    });
                    break;

                case 'approve':

                    $.each(items, function(i, field) {
                        ajax_toggle($("#category_" + field.value).find(".approve-category .ajax-toggle"));
                    });
                    break;
            }
        }

        $(this).val(0);

    });

    /**
     * MASS ACTION FIELDDEFS
     */
    $('#listit2_fielddef_mass_action').change(function(event) {

        if (confirm('Are your sure?')) {

            var items = $(".fielddef-mass-action :input").serializeArray();

            switch($(this).val()) {
                case 'delete':

                    $.each(items, function(i, field) {
                        ajax_delete($("#fielddef_" + field.value).find(".ajax-delete"));
                    });
                    break;

                case 'require':

                    $.each(items, function(i, field) {
                        ajax_toggle($("#fielddef_" + field.value).find(".ajax-toggle"));
                    });
                    break;
            }
        }

        $(this).val(0);

    });
}); 