<!-- start tab -->
<div id="page_tabs">
	<div id="edititem">
		{$title}
	</div>
</div>
<!-- end tab //-->
<!-- start content -->
<div id="page_content"> 
	<div id="edititem_c"> 
	<div id="edititem_result"></div>

		{$backlink}
		{$startform}

		<div class="pageoverflow">
    		<p class="pageinput">
				<input name="{$actionid}submit" id="listit2_submit" value="{lang('submit')}" type="submit" />
				<input name="{$actionid}cancel" id="listit2_cancel" value="{lang('cancel')}" type="submit" />
				<input name="{$actionid}apply" id="listit2_apply" value="{lang('apply')}" type="submit" />
				<input name="{$actionid}save_create" id="listit2_save_create" value="{$mod->ModLang('save_create')}" type="submit" />				
			</p>
		</div>

		{if $mod->GetPreference('display_create_date', 0) == 1}
		<div class="pageoverflow">
    		<p class='pagetext'>{$mod->ModLang('create_time', '')}: <em style='font-weight: normal;'>{$itemObject->create_time}</em></p>
		</div>
		{/if}

		<div class="pageoverflow">
    		<p class="pagetext">{$mod->GetPreference('item_title', '')}*:</p>
    		<p class="pageinput">{$input_title}</p>
		</div>

		<div class="pageoverflow">
    		<p class="pagetext">{$mod->ModLang('alias')}:</p>{$alias|default:''}
    			<p class="pageinput">{$input_alias}</p>
		</div>

		{if count($itemObject)}
			{foreach from=$itemObject->fielddefs item='fielddef'}
				{$fielddef->RenderInput($actionid, $returnid)}
			{/foreach}
		{/if}

		{if isset($input_active)}
		<div class="pageoverflow">
    		<p class="pagetext">{$mod->ModLang('active')}:</p>
    		<p class="pageinput">{$input_active}</p>
		</div>
		{/if}

		<div class="pageoverflow">
    		<p class="pagetext">{$mod->ModLang('time_control')}:</p>
    		<p class="pageinput">{$input_time_control}</p>
		</div>

		<div id="expiryinfo"{if $use_time_control != true} style="display:none;"{/if}>
			<div class="pageoverflow">
				<p class="pagetext">{$mod->ModLang('start_time')}:</p>
				<p class="pageinput">{$input_start_time}</p>
			</div>
	
			<div class="pageoverflow">
				<p class="pagetext">{$mod->ModLang('end_time')}:</p>
				<p class="pageinput">{$input_end_time}</p>
			</div>
		</div>

		<div class="pageoverflow">
    		<p class="pagetext">&nbsp;</p>
    		<p class="pageinput">
				<input name="{$actionid}submit" id="listit2_submit" value="{lang('submit')}" type="submit" />
				<input name="{$actionid}cancel" id="listit2_cancel" value="{lang('cancel')}" type="submit" />
				<input name="{$actionid}apply" id="listit2_apply" value="{lang('apply')}" type="submit" />
				<input name="{$actionid}save_create" id="listit2_save_create" value="{$mod->ModLang('save_create')}" type="submit" />			
			</p>
		</div>

	{$endform}
	</div>
</div>
<!-- end content //-->
<script type="text/javascript">{literal}
jQuery(document).ready(function() {
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
            jQuery('#edititem_result').html(htmlShow);
            window.setTimeout(function(){ 
            	$('.pagemcontainer').hide(); 
            	}, 9000)
        }, 'xml');
        return false;
    });
});
{/literal}</script>