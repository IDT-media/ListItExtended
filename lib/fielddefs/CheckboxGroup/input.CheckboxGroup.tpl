<div class="pageoverflow">
	<p class="pagetext">{$fielddef->GetName()}{if $fielddef->IsRequired()}*{/if}:</p>
	<div class="pageinput">
		{if $fielddef->GetDesc()}({$fielddef->GetDesc()})<br />{/if}
		<input type="hidden" name="{$actionid}customfield[{$fielddef->GetId()}]" value="" />
		
		{if $fielddef->GetOptionValue('jqui_buttons') == '1'}
		<div class="listit2-checkbox-buttons" id="{$actionid}customfield{$fielddef->GetId()}-checkboxes">
		{foreach $fielddef->GetOptions() as $value => $option}
			<input type="checkbox" name="{$actionid}customfield[{$fielddef->GetId()}][]" id="{$actionid}customfield[{$fielddef->GetId()}]{$option@iteration}" value="{$value}"{if in_array($value, $fielddef->GetValue("array"))} checked="checked"{/if} />
			<label for="{$actionid}customfield[{$fielddef->GetId()}]{$option@iteration}">{$option}</label>
		{/foreach}
		</div>
		
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			$("#{$actionid}customfield{$fielddef->GetId()}-checkboxes").buttonset();	
		});
		</script>
		
		{else}
		
		{html_checkboxes name="`$actionid`customfield[`$fielddef->GetId()`]" options=$fielddef->GetOptions() selected=$fielddef->GetValue("array") separator=$fielddef->Separator() assign='li2boxes'}
		{math equation='x/y' x=$li2boxes|count y=$fielddef->GetOptionValue('columns', 1) assign='counter'}

		<ul class="listit2-column-list">
		{foreach from=$li2boxes item='box'}
			{if $box@first}<li>{elseif $box@index % $counter|ceil == 0}</li><li>{/if}
			{$box}
			{if $box@last}</li>{/if}
		{/foreach}
		</ul>
		
		{/if}
	</div>
</div>