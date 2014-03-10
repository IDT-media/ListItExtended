<div class="pageoverflow">
	<p class="pagetext">{$fielddef->GetName()}{if $fielddef->IsRequired()}*{/if}:</p>
	<p class="pageinput">
		{if $fielddef->GetDesc()}({$fielddef->GetDesc()})<br />{/if}
		{html_options name="`$actionid`customfield[`$fielddef->GetId()`]" options=$fielddef->GetFiles() selected=$fielddef->GetValue()}
	</p>
</div>