<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('options')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_multioptions_help')}</em><br />
    	<textarea name="{$actionid}custom_input[options]">{$fielddef->GetOptionValue('options')}</textarea>
    </p>
</div>

