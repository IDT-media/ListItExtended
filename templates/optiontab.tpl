{$startform}
<fieldset>
	<legend>{$mod->ModLang('fielddefs')}</legend>
	
	<div class="pagewarning">
		<h3>{$mod->ModLang('notice')}</h3>
		<p>{$mod->ModLang('notice_allow_autoscan')}</p>
	</div>	
	
    <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_allow_autoscan')}:</p>
        <p class="pageinput">{$input_allow_autoscan}</p>
    </div>
 
</fieldset>

<fieldset>
	<legend>{$mod->ModLang('instances')}</legend>
	
    <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_allow_autoinstall')}:</p>
        <p class="pageinput">{$input_allow_autoinstall}</p>
    </div>
 
</fieldset>

    <div class="pageoverflow">
        <p class="pagetext">&nbsp;</p>
        <p class="pageinput">
			{$submit}
		</p>
    </div>

{$endform}
