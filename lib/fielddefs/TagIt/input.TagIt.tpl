<div class="pageoverflow">
	<p class="pagetext">{$fielddef->GetName()}{if $fielddef->IsRequired()}*{/if}:</p>
	<div class="pageinput">
		{if $fielddef->GetDesc()}({$fielddef->GetDesc()})<br />{/if}
		<input type="hidden" name="{$actionid}customfield[{$fielddef->GetId()}]" />
		<ul id="{$actionid}customfield[{$fielddef->GetId()}]-value">
			{foreach from=$fielddef->GetValue() item=value}
				<li>{$value}</li>
			{/foreach}
		</ul>			
	</div>
	
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$("#{$actionid}customfield\\\[{$fielddef->GetId()}\\\]-value").tagit({
			fieldName: "{$actionid}customfield[{$fielddef->GetId()}][]",
			removeConfirmation: {$fielddef->GetOptionValue('remove_confirmation', 'false')},
			allowSpaces: {$fielddef->GetOptionValue('allow_spaces', 'false')},
			tagLimit: {$fielddef->GetOptionValue('limit')|default:'null'}
		})
		.sortable();
	});
	</script>	

</div>