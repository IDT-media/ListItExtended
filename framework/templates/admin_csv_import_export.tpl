<!-- start tab -->
<div id="page_tabs">
	<div id="edititem">
		{$title}
	</div>
</div>
<!-- end tab //-->
<!-- start content -->
<div id="page_content"> 
	<div id="edititem_c"> 
	<div id="edititem_result"></div>

		{$backlink}
		{$startform}

		{if isset($input_exportvalues)}
		<div class="pageoverflow">
			<div class="pagetext">{$mod->ModLang('values')}:</div>
			<div class="pageinput">{$input_exportvalues}</div>
		</div>
		{/if}	

		<div class="pageoverflow">
			<div class="pagetext">{$mod->ModLang('file')}:</div>
			<div class="pageinput">{$input_file}</div>
		</div>
	
		<div class="pageoverflow">
			<div class="pagetext">{$mod->ModLang('separator')}:</div>
			<div class="pageinput">{$input_separator}</div>
		</div>

		<div class="pageoverflow">
			<div class="pagetext">{$mod->ModLang('enclouser')}:</div>
			<div class="pageinput">{$input_enclouser}</div>
		</div>

		<div class="pageoverflow">
			<div class="pagetext">&nbsp;</div>
			<div class="pageinput">{$submit}{$cancel}</div>
		</div>

		{$endform}
	</div>
</div>
<!-- end content //-->