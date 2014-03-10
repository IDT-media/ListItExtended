{if count($items) > 0}
<table id="category" cellspacing="0" class="pagetable">
    <thead>
        <tr>
            <th>{$mod->ModLang('category')}</th>
            <th>{$mod->ModLang('alias')}</th>
            <th class="pageicon">&nbsp;</th>
            <th class="pageicon">&nbsp;</th>
            <th class="pageicon">&nbsp;</th>
            <th title="{$mod->ModLang('select_all')}" class="pageicon no-sort"><input id="check_all_category" type="checkbox" /></th>
        </tr>
    </thead>
    <tbody class="content" width="100%">
{foreach from=$items item=entry}
    {cycle values="row1,row2" assign='rowclass'}
        <tr id="category_{$entry->category_id}" class="{$rowclass}">
            <td>{repeat string='>&nbsp;' times=$entry->depth - 1}{$entry->name}</td>
            <td>{$entry->alias}</td>
            <td class="init-ajax-toggle approve-category">{$entry->approve}</td>
            <td>{$entry->editlink}</td>
            <td class="init-ajax-delete">{$entry->delete}</td>
            <td class="category-mass-action">{$entry->select}</td>
        </tr>
{/foreach}
    </tbody>
</table>
<div class="pageoptions" style="float:right;">
<select id="listit2_category_mass_action">
	<option value="">{$mod->ModLang('select_one')}</option>
	<option value="delete">Delete</option>
	<option value="approve">Toggle active</option>
</select>
</div>
{/if}

<div class="pageoptions">{$addlink}{if isset($reorderlink)}&nbsp;{$reorderlink}{/if}</div>