<!-- start tab -->
<div id="page_tabs">
	<div id="editcategory">
		{$title}
	</div>
</div>
<!-- end tab //-->
<!-- start content -->
<div id="page_content"> 
	<div id="editcategory_c"> 
	{$backlink}
	{$startform}

		<div class="pageoverflow">
    		<p class="pagetext">*{$mod->ModLang('category_name')}:</p>
    		<p class="pageinput">{$input_category}</p>
		</div>
		<div class="pageoverflow">
    		<p class="pagetext">{$mod->ModLang('alias')}:</p>
    		<p class="pageinput">{$input_alias}</p>
		</div>
	
		<div class="pageoverflow">
    		<p class="pagetext">{lang('parent')}:</p>
    		<p class="pageinput">{$input_parent}</p>
		</div>

		<div class="pageoverflow">
    		<p class="pagetext">{$mod->ModLang('category_description')}:</p>
    		<p class="pageinput">{$input_category_description}</p>
		</div>
		
		<div class="pageoverflow">
    		<p class="pagetext">{$mod->ModLang('active')}:</p>
    		<p class="pageinput">{$input_active}</p>
		</div>		

		<div class="pageoverflow">
    		<p class="pagetext">&nbsp;</p>
    		<p class="pageinput">
				<input name="{$actionid}submit" id="listit2_submit" value="{lang('submit')}" type="submit" />
				<input name="{$actionid}cancel" id="listit2_cancel" value="{lang('cancel')}" type="submit" />
				<input name="{$actionid}apply" id="listit2_apply" value="{lang('apply')}" type="submit" />
				<input name="{$actionid}save_create" id="listit2_save_create" value="{$mod->ModLang('save_create')}" type="submit" />				
			</p>
		</div>
	
	{$endform}
	</div>
</div>
