<div class="pageoverflow">
	<p class="pagetext">{$fielddef->GetName()}{if $fielddef->IsRequired()}*{/if}:</p>
	<p class="pageinput">
		{if $fielddef->GetDesc()}({$fielddef->GetDesc()})<br />{/if}
		<input type="hidden" name="{$actionid}customfield[{$fielddef->GetId()}]" value="0" />
		<input type="checkbox" name="{$actionid}customfield[{$fielddef->GetId()}]" value="1"{if $fielddef->GetValue("string")} checked="checked"{/if} />		
	</p>
</div>