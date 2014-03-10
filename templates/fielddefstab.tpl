{if count($fielddefs) > 0}
<fieldset>
	<legend>{$mod->ModLang('registered_fielddefs')}</legend>
	<table cellspacing="0" class="pagetable">
    	<thead>
        	<tr>
            	<th>{$mod->ModLang('fielddef_type')}</th>
            	<th>{$mod->ModLang('fielddef_friendlytype')}</th>
            	<th>{$mod->ModLang('fielddef_originator')}</th>
            	<th>{$mod->ModLang('fielddef_deps')}</th>
            	<th class="pageicon">{$mod->ModLang('active')}</th>
        	</tr>
    	</thead>
    	<tbody>
	{foreach from=$fielddefs item='entry' name='fielddefs'}
    	    <tr class="{cycle values='row1,row2' name='summary'}">
        	    <td>{$entry->GetType()}</td>
        	    <td>{$entry->GetFriendlyType()}</td>
            	<td>{$entry->GetOriginator()}</td>
				<td>
				{if !is_null($entry->GetModuleDeps())}
					{foreach from=$entry->GetModuleDeps() key='module' item='version' name='deps'}
						{$module} ({$version}){if !$smarty.foreach.deps.last},{/if}
					{/foreach}					
				{else}
					{'none'|lang}
				{/if}
				</td>
            	<td class="init-ajax-toggle">{$entry->active_link}</td>
        	</tr>
	{/foreach}
    	</tbody>
	</table>
</fieldset>
{/if}
{$startform}

    <div class="pageoverflow">
        <p class="pageinput">
				{$scan}
		</p>
    </div>
 
{$endform}