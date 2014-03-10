<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('options')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_multioptions_help')}</em><br />
    	<textarea name="{$actionid}custom_input[options]">{$fielddef->GetOptionValue('options')}</textarea>
    </p>
</div>

<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('size')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_size_help')}</em><br />
    	<input type="text" name="{$actionid}custom_input[size]" value="{$fielddef->GetOptionValue('size', 5)}" />
    </p>
</div>