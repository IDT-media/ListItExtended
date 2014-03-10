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
    <p class="pagetext">{$fielddef->ModLang('size')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_size_help')}</em><br />
    	<input type="text" name="{$actionid}custom_input[size]" value="{$fielddef->GetOptionValue('size', 5)}" />
    </p>
</div>