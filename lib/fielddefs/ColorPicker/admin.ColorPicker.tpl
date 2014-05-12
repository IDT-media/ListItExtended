<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('size')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_size_help')}</em><br />
    	<input type="text" name="{$actionid}custom_input[size]" value="{$fielddef->GetOptionValue('size', 20)}" />
    </p>
</div>