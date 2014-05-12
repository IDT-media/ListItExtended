<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('address_field')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_address_field_help')}</em><br />
		{html_options name="{$actionid}custom_input[address_field]" options=$fielddef->Siblings() selected=$fielddef->GetOptionValue('address_field')}
	</p>
</div>

<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('size')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_size_help')}</em><br />
    	<input type="text" name="{$actionid}custom_input[size]" value="{$fielddef->GetOptionValue('size', 20)}" />
    </p>
</div>