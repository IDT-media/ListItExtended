<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('allowed')}:</p>
    <p class="pageinput">
    	{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_allow_help')}</em><br />
		<input type="text" name="{$actionid}custom_input[allowed]" value="{$fielddef->GetOptionValue('allowed', 'pdf,gif,jpeg,jpg')}" />
	</p>
</div>

<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('dir')}:</p>
    <p class="pageinput">
		{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_dir_help')}</em><br />
		<input type="text" name="{$actionid}custom_input[dir]" value="{$fielddef->GetOptionValue('dir','images')}" />
	</p>
</div>

<div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('exclude_prefix')}:</p>
    <p class="pageinput">
		{$themeObject->DisplayImage('icons/system/info.gif')}<em> {$fielddef->ModLang('fielddef_exclude_prefix_help')}</em><br />
		<input type="text" name="{$actionid}custom_input[exclude_prefix]" value="{$fielddef->GetOptionValue('exclude_prefix')}" />
	</p>
</div>
