<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('subtype')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_subtype_help')}</em><br />
		{html_options name="`$actionid`custom_input[subtype]" options=$fielddef->SubTypes() selected=$fielddef->GetOptionValue('subtype', 'Dropdown')}
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
    <p class="pagetext">{$fielddef->ModLang('showall')}:</p>
    <p class="pageinput">
		{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_showall_help')}</em><br />
		<input type="hidden" name="{$actionid}custom_input[showall]" value="0" />
		<input type="checkbox" name="{$actionid}custom_input[showall]" value="1"{if $fielddef->GetOptionValue('showall')}checked="checked"{/if} />
	</p>
</div>