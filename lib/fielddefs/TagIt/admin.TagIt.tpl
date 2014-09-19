<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('limit')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_limit_help')}</em><br />
    	<input type="text" name="{$actionid}custom_input[limit]" value="{$fielddef->GetOptionValue('limit')}" />
    </p>
</div>

<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('remove_confirmation')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_remove_confirmation_help')}</em><br />
		<input type="hidden" name="{$actionid}custom_input[remove_confirmation]" value="false" />
		<input type="checkbox" name="{$actionid}custom_input[remove_confirmation]" value="true"{if $fielddef->GetOptionValue('remove_confirmation') == 'true'}checked="checked"{/if} />
	</p>
</div>

<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('allow_spaces')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_allow_spaces_help')}</em><br />
		<input type="hidden" name="{$actionid}custom_input[allow_spaces]" value="false" />
		<input type="checkbox" name="{$actionid}custom_input[allow_spaces]" value="true"{if $fielddef->GetOptionValue('allow_spaces') == 'true'}checked="checked"{/if} />
	</p>
</div>