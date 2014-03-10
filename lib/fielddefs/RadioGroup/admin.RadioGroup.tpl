<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('options')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_multioptions_help')}</em><br />
    	<textarea name="{$actionid}custom_input[options]">{$fielddef->GetOptionValue('options')}</textarea>
    </p>
</div>
	
<div class="pageoverflow">	
    <p class="pagetext">{$fielddef->ModLang('separator')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_separator_help')}</em><br />
    	<input type="text" name="{$actionid}custom_input[separator]" value="{$fielddef->GetOptionValue('separator')}" />
    </p>	
</div>

<div class="pageoverflow">	
    <p class="pagetext">{$fielddef->ModLang('columns')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_columns_help')}</em><br />
    	<input type="text" name="{$actionid}custom_input[columns]" value="{$fielddef->GetOptionValue('columns', 1)}" />
    </p>	
</div>

<div class="pageoverflow">	
    <p class="pagetext">{$fielddef->ModLang('enable_jqui')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_enable_jqui_help')}</em><br />
    	<input type="hidden" name="{$actionid}custom_input[jqui_buttons]" value="0" />
    	<input type="checkbox" name="{$actionid}custom_input[jqui_buttons]" value="1"{if $fielddef->GetOptionValue('jqui_buttons') == 1} checked="checked"{/if} />
    </p>	
</div>