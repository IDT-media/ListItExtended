<div class="pageoverflow">
	<p class="pagetext">{$fielddef->GetName()}{if $fielddef->IsRequired()}*{/if}:</p>
	<div class="pageinput">
		{if $fielddef->GetDesc()}({$fielddef->GetDesc()})<br />{/if}
		<input type="text" name="{$actionid}customfield[{$fielddef->GetId()}]" id="{$actionid}customfield[{$fielddef->GetId()}]" value="{$fielddef->GetValue()}" size="{$fielddef->GetOptionValue('size')}" />
		<div class="listit2-colorpicker-value" style="background-color: #{$fielddef->GetValue()}"></div>
	</div>
	
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$("#{$actionid}customfield\\\[{$fielddef->GetId()}\\\]")
		.ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn(300);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(300);
				return false;
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			},
			onChange: function (hsb, hex, rgb) {
				$("#{$actionid}customfield\\\[{$fielddef->GetId()}\\\]").val(hex).next("div").css({
					"backgroundColor" : "#" + hex
				});
			}
		})

	});
	</script>
	
</div>