<!-- start tab -->
<div id="page_tabs">
	<div id="edittemplate">
		{$title}
	</div>
</div>
<!-- end tab //-->
<!-- start content -->
<div id="page_content"> 
	<div id="edittemplate_c"> 
	<div id="edittemplate_result"></div>
	{$backlink}
	{$startform}

		<div class="pageoverflow">
    		<p class="pagetext">* {$mod->ModLang('template_name')}:</p>
    		<p class="pageinput">{$input_name}</p>
		</div>
		
		<div class="pageoverflow">
    		<p class="pagetext">{$mod->ModLang('default_templates')}:</p>
    		<p class="pageinput tpl_list">{$input_tpl_list}</p>
		</div>

		<div class="pageoverflow">
    		<p class="pagetext">{$mod->ModLang('template')}:</p>
    		<div class="pageinput tpl_content">{$input_template}</div>
		</div>

		<div class="pageoverflow">
    		<p class="pagetext">&nbsp;</p>
    		<p class="pageinput">{if isset($idfield)}{$idfield}{/if}{$submit}{$cancel}{$apply}{if isset($reset)}{$reset}{/if}</p>
		</div>

	{$endform}
	</div>
</div>

<script type="text/javascript">{literal}
jQuery(document).ready(function() {

	jQuery('.tpl_list select').change(function() {
		var callback = ajax_function('ModGetTemplateFromFile', $(this).val());
		callback.success(function(data) {
			jQuery('.tpl_content textarea').val(data);
		});
	});

    jQuery('[name=m1_apply]').live('click', function() {
        if (typeof tinyMCE != 'undefined') {
            tinyMCE.triggerSave();
        }
        var data = jQuery('form').find('input:not([type=submit]), select, textarea').serializeArray();
        data.push({
            'name': 'm1_ajax',
            'value': 1
        });
        data.push({
            'name': 'm1_apply',
            'value': 1
        });
        data.push({
            'name': 'showtemplate',
            'value': 'false'
        });
        var url = jQuery('form').attr('action');
		
        jQuery.post(url, data, function(resultdata, text) {
            var resp = jQuery(resultdata).find('Response').text();
            var details = jQuery(resultdata).find('Details').text();
            var htmlShow = '';
            if (resp === 'Success' && details !== '') {
                htmlShow = '<div class="pagemcontainer"><p class="pagemessage">' + details + '<\/p><\/div>';
            }
            else {
                htmlShow = '<div class="pageerrorcontainer"><ul class="pageerror">';
                htmlShow += details;
                htmlShow += '<\/ul><\/div>';
            }
            jQuery('#edittemplate_result').html(htmlShow);
            window.setTimeout(function(){ 
            	$('.pagemcontainer').hide(); 
            	}, 9000)
        }, 'xml');
        return false;
    });
});
{/literal}</script>
