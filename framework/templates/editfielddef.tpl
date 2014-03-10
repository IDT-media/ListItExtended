<!-- start tab -->
<div id="page_tabs">
	<div id="editfielddef">
		{$title}
	</div>
	{if isset($input_extra)}
	<div id="fielddefextra">
		{$mod->ModLang('extra')}
	</div>	
	{/if}
</div>
<!-- end tab //-->
<!-- start content -->
{$startform}
<div id="page_content"> 

	{$backlink}
	<div id="editfielddef_c"> 

		<div class="pageoverflow">
    		<p class="pagetext">{$mod->ModLang('fielddef_type')}:</p>
    		<p class="pageinput">{$inputtype}</p>
		</div>

		<div class="pageoverflow">
			<p class="pagetext">*{$mod->ModLang('fielddef_name')}:</p>
			<p class="pageinput">{$inputname}</p>
		</div>
		<div class="pageoverflow">
			<p class="pagetext">{$mod->ModLang('alias')}:</p>
			<p class="pageinput">{$input_alias}</p>
		</div>
		
		<div class="pageoverflow">
			<p class="pagetext">{$mod->ModLang('fielddef_help')}:</p>
			<p class="pageinput">{$inputhelp}</p>
		</div>
		<div class="pageoverflow">
			<p class="pagetext">{$mod->ModLang('fielddef_required')}:</p>
			<p class="pageinput">{$input_required}</p>
		</div>

		<div class="listit2_typeoptions">
		{if isset($fielddef)}	
			{$fielddef->RenderForEdit($actionid, $returnid)}
		{/if}
		</div>
          
	</div>
{if isset($input_extra)}
	<div id="fielddefextra_c"> 

		<div class="pageoverflow">
    		<p class="pagetext">{$mod->ModLang('extra')}:</p>
    		<p class="pageinput">{$input_extra}</p>
		</div>
		
	</div>
{/if}	
	<div class="pageoverflow">
		<p class="pagetext">&nbsp;</p>
		<p class="pageinput">
			<input name="{$actionid}submit" id="listit2_submit" value="{lang('submit')}" type="submit" />
			<input name="{$actionid}cancel" id="listit2_cancel" value="{lang('cancel')}" type="submit" />
			<input name="{$actionid}apply" id="listit2_apply" value="{lang('apply')}" type="submit" />
			<input name="{$actionid}save_create" id="listit2_save_create" value="{$mod->ModLang('save_create')}" type="submit" />				
		</p>
	</div>		
</div>
{$endform}