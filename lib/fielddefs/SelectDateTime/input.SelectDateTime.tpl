<div class="pageoverflow">
	<p class="pagetext">{$fielddef->GetName()}{if $fielddef->IsRequired()}*{/if}:</p>
	<p class="pageinput">
		{if $fielddef->GetDesc()}({$fielddef->GetDesc()})<br />{/if}
		<input type="text" name="{$actionid}customfield[{$fielddef->GetId()}]" id="{$actionid}customfield[{$fielddef->GetId()}]" value="{$fielddef->GetValue()}" size="{$fielddef->GetOptionValue('size')}" />
	</p>
	
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$("#{$actionid}customfield\\\[{$fielddef->GetId()}\\\]")
		{if $fielddef->GetOptionValue('format_type') == 1} {* Date Format *}
		.datepicker({
			dateFormat: "{$fielddef->GetOptionValue('date_format')}"
		});		
		{elseif $fielddef->GetOptionValue('format_type') == 2} {* Time Format *}
		.timepicker({
			timeFormat: "{$fielddef->GetOptionValue('time_format')}",
			{if $fielddef->GetOptionValue('show_seconds')}showSecond: true,{/if}
			hourGrid: 4,
			minuteGrid: 10,
			secondGrid: 10			
		});
		{else} {* Combined *}
		.datetimepicker({
			dateFormat: "{$fielddef->GetOptionValue('date_format')}",
			timeFormat: "{$fielddef->GetOptionValue('time_format')}",
			{if $fielddef->GetOptionValue('show_seconds')}showSecond: true,{/if}
			hourGrid: 4,
			minuteGrid: 10,
			secondGrid: 10
		});		
		{/if}
	});
	</script>
	
</div>