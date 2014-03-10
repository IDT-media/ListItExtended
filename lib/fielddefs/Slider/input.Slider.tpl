<div class="pageoverflow">
	<p class="pagetext">{$fielddef->GetName()}{if $fielddef->IsRequired()}*{/if}:</p>
	<div class="pageinput">
		{if $fielddef->GetDesc()}({$fielddef->GetDesc()})<br />{/if}
		<p><em>{$fielddef->ModLang('value')}: </em><span id="{$actionid}customfield[{$fielddef->GetId()}]-visible-value">{$fielddef->GetValue()|default:$fielddef->GetOptionValue('min')}</span></p>
		<div class="listit2-slider-container" style="width: {$fielddef->GetOptionValue('width')}">
			<div class="listit2-slider" id="{$actionid}customfield[{$fielddef->GetId()}]-slider"></div>
			<input type="hidden" name="{$actionid}customfield[{$fielddef->GetId()}]" id="{$actionid}customfield[{$fielddef->GetId()}]-value" value="{$fielddef->GetValue()|default:$fielddef->GetOptionValue('min')}" />
		</div>
	</div>
	
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$("#{$actionid}customfield\\\[{$fielddef->GetId()}\\\]-slider")
		.slider({
            range: "min",
            min: {$fielddef->GetOptionValue('min')},
            max: {$fielddef->GetOptionValue('max')},
            {if $fielddef->GetOptionValue('increment') != ''}step: {$fielddef->GetOptionValue('increment')},{/if}
			value: $( "#{$actionid}customfield\\\[{$fielddef->GetId()}\\\]-value" ).val(),
			slide: function(event, ui) {
			
				$( "#{$actionid}customfield\\\[{$fielddef->GetId()}\\\]-visible-value" ).text( ui.value );
				$( "#{$actionid}customfield\\\[{$fielddef->GetId()}\\\]-value" ).val( ui.value );
			}		
		});
	});
	</script>
	
</div>