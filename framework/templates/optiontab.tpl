{$startform}
<fieldset>
	<legend>{$mod->ModLang('module_options')}</legend>
	<div class="pagewarning">
		<h3>{$mod->ModLang('notice')}</h3>
		<p>{$mod->ModLang('options_notice')}</p>
	</div>	
    <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_friendlyname')}:</p>
        <p class="pageinput">{$input_friendlyname}</p>
    </div>
    <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_moddescription')}:</p>
        <p class="pageinput">{$input_moddescription}</p>
    </div>      
    <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_adminsection')}:</p>
        <p class="pageinput">{$input_adminsection}</p>
    </div>     
</fieldset> 
<fieldset>
	<legend>{$mod->ModLang('default_options')}</legend>
	<div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_detailpage')}:</p>
        <p class="pageinput">{$input_detailpage}</p>
    </div> 
	<div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_summarypage')}:</p>
        <p class="pageinput">{$input_summarypage}</p>
    </div> 	
</fieldset>
<fieldset>
    <legend>{$mod->ModLang('items_options')}</legend>           
    <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_item_title')}:</p>
        <p class="pageinput">{$input_item_title}</p>
    </div>
    <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_item_singular')}:</p>
        <p class="pageinput">{$input_item_singular}</p>
    </div>
    <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_item_plural')}:</p>
        <p class="pageinput">{$input_item_plural}</p>
    </div>
	<div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_create_date')}</p>
        <p class="pageinput">{$input_create_date}</p>
    </div>    
	<div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_item_cols')}:</p>
        <p class="pageinput">{$input_item_cols}</p>
    </div>
    <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_items_per_page')}:</p>
        <p class="pageinput">{$input_items_per_page}</p>
    </div>
	<div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('text_sortorder')}:</p>
        <p class="pageinput">{$input_sortorder}</p>
    </div>     
</fieldset>
<fieldset>
	<legend>{$mod->ModLang('url_options')}</legend>
	<div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_url_prefix')}:</p>
        <p class="pageinput">{$input_url_prefix}</p>
    </div> 
	<div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_subcategory')}:</p>
        <p class="pageinput">{$input_subcategory}</p>
    </div>	
	<div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_display_inline')}:</p>
        <p class="pageinput">{$input_display_inline}</p>
    </div>
</fieldset>
<fieldset>
	<legend>{$mod->ModLang('xmodule_options')}</legend>
	<div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_reindex_search')}:</p>
        <p class="pageinput">{$input_reindex_search}</p>
    </div> 	
</fieldset>
    <div class="pageoverflow">
        <p class="pagetext">&nbsp;</p>
        <p class="pageinput">
			{$submit}
		</p>
    </div>

{$endform}
