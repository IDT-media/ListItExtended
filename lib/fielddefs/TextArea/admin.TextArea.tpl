<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('max_length')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_max_length_help')}</em><br />
    	<input type="text" name="{$actionid}custom_input[max_length]" value="{$fielddef->GetOptionValue('max_length', 6000)}" />
    </p>
</div>

<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('wysiwyg')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_wysiwyg_help')}</em><br />
		<input type="hidden" name="{$actionid}custom_input[wysiwyg]" value="0" />
		<input type="checkbox" name="{$actionid}custom_input[wysiwyg]" value="1"{if $fielddef->GetOptionValue('wysiwyg')}checked="checked"{/if} />
	</p>
</div>