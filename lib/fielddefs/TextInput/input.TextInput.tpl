<div class="pageoverflow">
	<p class="pagetext">{$fielddef->GetName()}{if $fielddef->IsRequired()}*{/if}:</p>
	<p class="pageinput">
		{if $fielddef->GetDesc()}({$fielddef->GetDesc()})<br />{/if}
		<input type="text" name="{$actionid}customfield[{$fielddef->GetId()}]" value="{$fielddef->GetValue()}" size="{$fielddef->GetOptionValue('size')}" maxlength="{$fielddef->GetOptionValue('max_length')}" />
	</p>
</div>