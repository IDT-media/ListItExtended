<div class="pageoverflow">
	<p class="pagetext">{$fielddef->GetName()}{if $fielddef->IsRequired()}*{/if}:</p>
	<p class="pageinput">
		{if $fielddef->GetDesc()}({$fielddef->GetDesc()})<br />{/if}
		{if $fielddef->HasValue()}<em>{$mod->ModLang('value')}: {$fielddef->GetValue()}</em><br />{/if}
		{if $fielddef->GetOptionValue('image')}{$fielddef->RenderForAdminListing($actionid, $returnid)}{/if}
		<input type="hidden" name="{$actionid}customfield[{$fielddef->GetId()}]" value="{$fielddef->GetValue()}" />
		<input type="file" name="{$actionid}customfield[{$fielddef->GetId()}]" size="{$fielddef->GetOptionValue('size')}">{if !$fielddef->IsRequired() && $fielddef->HasValue()}<!--
		--><input type="checkbox" name="{$actionid}delete_customfield[{$fielddef->GetId()}]" value="delete" title="{$mod->ModLang('delete')}" />{/if}
	</p>
</div>