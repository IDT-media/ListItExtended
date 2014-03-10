<div class="pageoverflow">
	<p class="pagetext">{$fielddef->GetName()}{if $fielddef->IsRequired()}*{/if}:</p>
	<p class="pageinput">
		{if $fielddef->GetDesc()}({$fielddef->GetDesc()})<br />{/if}
		<input type="hidden" name="{$actionid}customfield[{$fielddef->GetId()}]" value="" />
		<select name="{$actionid}customfield[{$fielddef->GetId()}][]" size="{$fielddef->GetOptionValue('size', 5)}" multiple="multiple">
			{foreach from=$fielddef->GetOptions() key=value item=key}
				<option value="{$value}"{if in_array($value, $fielddef->GetValue("array"))} selected="selected"{/if}>{$key}</option>
			{/foreach}
		</select>
	</p>
</div>