<div id="{$modulealias}_filter">

	<h3>{$filterprompt}</h3>

	{$formstart}

		{foreach from=$fielddefs item=fielddef}
		<div class="filter form-row">

		{if $fielddef.type != 'Categories'}
		
			<label>{$fielddef->name}</label><br />
			{if $fielddef.type == 'Checkbox'}
				
				<input type="checkbox" name="{$actionid}search_{$fielddef->alias}" id="filter_{$fielddef->alias}" value="{$fielddef->value}" />
			{else}
				
				<select name="{$actionid}search_{$fielddef->alias}[]" size="5" multiple="multiple">
					{foreach from=$fielddef->values item='value'}
					<option value="{$value}">{$value}</option>
					{/foreach}
				</select>
			{/if}
		{/if}
		</div>
		{/foreach}

		<input class="search-button" name="submit" value="{$mod->ModLang('filter')}" type="submit" />

	{$formend}
</div>