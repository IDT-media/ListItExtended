<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('size')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_size_help')}</em><br />
    	<input type="text" name="{$actionid}custom_input[size]" value="{$fielddef->GetOptionValue('size', 20)}" />
    </p>
</div>

<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('format_type')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_format_type_help')}</em><br />
    	{html_options name="{$actionid}custom_input[format_type]" options=$fielddef->FormatTypes() selected=$fielddef->GetOptionValue('format_type', 0)}
    </p>
</div>

<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('date_format')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_date_format_help')}</em><br />
    	<input type="text" name="{$actionid}custom_input[date_format]" value="{$fielddef->GetOptionValue('date_format', 'dd-mm-yy')}" />
    </p>
</div>

<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('time_format')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_time_format_help')}</em><br />
    	<input type="text" name="{$actionid}custom_input[time_format]" value="{$fielddef->GetOptionValue('time_format', 'HH:mm')}" />
    </p>
</div>

<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('show_seconds')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_show_seconds_help')}</em><br />
		<input type="hidden" name="{$actionid}custom_input[show_seconds]" value="0" />
		<input type="checkbox" name="{$actionid}custom_input[show_seconds]" value="1"{if $fielddef->GetOptionValue('show_seconds')}checked="checked"{/if} />
	</p>
</div>