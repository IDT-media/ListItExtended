{if count($items) > 0}
<div class="item-search">
<form id="quicksearch_form"> 
	<label class="pagetext">{$mod->ModLang('search')} {$title_plural}: </label>
		<input type="text" name="search" value="" id="item_search" placeholder="{$mod->ModLang('searchfor')} {$title}" /> 
</form>	
</div>
<div class="pageoptions">{$addlink}{if isset($importlink)}{$importlink}{/if}{if isset($exportlink)}{$exportlink}{/if}</div>
<div class="clear"></div>
<div class="pageshowrows">{$pagination}</div>
<table id="sortable_item" data-filter="#item_search" cellspacing="0" class="pagetable {$themeObject->themeName}">
	<thead>
		<tr class="top">
			<th data-toggle="true">{$title}</th>
			{if isset($items.0->alias)}<th data-hide="phone,tablet">{$mod->ModLang('alias')}</th>{/if}
			{foreach from=$items.0->fielddefs item=fielddef}
			<th data-hide="phone.tablet">{$fielddef.name}</th>
			{/foreach}
			{if isset($items.0->create_time)}<th data-hide="phone,tablet" data-type="numeric">{$mod->ModLang('create_time')}</th>{/if}
			{if isset($items.0->modified_time)}<th data-hide="phone,tablet" data-type="numeric">{$mod->ModLang('modified_time')}</th>{/if}
			{if isset($items.0->start_time)}<th data-hide="phone,tablet" data-type="numeric">{$mod->ModLang('start_time')}</th>{/if}
			{if isset($items.0->end_time)}<th data-hide="phone,tablet" data-type="numeric">{$mod->ModLang('end_time')}</th>{/if}
			{if isset($items.0->approve)}<th data-ignore="highlight" data-hide="phone,tablet" data-class="hide-heading" data-sort-ignore="true" class="pageicon"><span class="li2-hidden">{$mod->ModLang('toggle_status')}</span>&nbsp;</th>{/if}
			<th data-ignore="highlight" data-hide="phone,tablet" data-sort-ignore="true" data-class="hide-heading" class="pageicon"><span class="li2-hidden">{$mod->ModLang('copy')}</span>&nbsp;</th>
			<th data-ignore="highlight" data-hide="phone,tablet" data-sort-ignore="true" data-class="hide-heading" class="pageicon"><span class="li2-hidden">{$mod->ModLang('edit')}</span>&nbsp;</th>
			{if isset($items.0->delete)}<th data-ignore="highlight" data-hide="phone,tablet" data-class="hide-heading" data-sort-ignore="true" class="pageicon"><span class="li2-hidden">{$mod->ModLang('delete')}</span>&nbsp;</th>{/if}
			<th data-ignore="highlight" data-hide="phone,tablet" data-sort-ignore="true" data-class="hide-heading"title="{$mod->ModLang('select_all')}" class="pageicon no-sort"><span class="li2-hidden">{$mod->ModLang('select_item')}</span><input id="check_all_item" type="checkbox" /></th>
		</tr>
	</thead>
	<tbody class="content" width="100%">
{foreach from=$items item=entry}
{cycle values="row1,row2" assign='rowclass'}
		<tr id="item_{$entry->item_id}" class="{$rowclass}" style="cursor: move;">
			<td>{$entry->title}</td>
			{if isset($items.0->alias)}<td>{$entry->alias}</td>{/if}
			{foreach from=$entry->fielddefs item=fielddef}
			<td>{$fielddef->RenderForAdminListing($actionid, $returnid)}</td>
			{/foreach}
			{if isset($items.0->create_time)}<td data-value="{$entry->create_time|strtotime}">{$entry->create_time}</td>{/if}
			{if isset($items.0->modified_time)}<td data-value="{$entry->modified_time|strtotime}">{$entry->modified_time}</td>{/if}
			{if isset($items.0->start_time)}<td data-value="{$entry->start_time|strtotime}">{$entry->start_time}</td>{/if}
			{if isset($items.0->end_time)}<td data-value="{$entry->end_time|strtotime}">{$entry->end_time}</td>{/if}
			{if isset($entry->approve)}<td class="init-ajax-toggle approve-item">{$entry->approve}</td>{/if}
			<td>{$entry->copylink}</td>
			<td>{$entry->editlink}</td>
			{if isset($entry->delete)}<td class="init-ajax-delete">{$entry->delete}</td>{/if}
			<td class="item-mass-action">{$entry->select}</td>
		</tr>
{/foreach}
	</tbody>
</table>
<div class="pageshowrows">{$pagination}</div>
<div class="pageoptions" style="float:right;">
<select id="listit2_item_mass_action">
	<option value="">{$mod->ModLang('select_one')}</option>
	<option value="delete">Delete</option>
	<option value="approve">Toggle approve</option>
</select>
</div>
<div class="pageoptions" style="float:right;">{$submitorder}</div>
{/if}

<div class="pageoptions">{$addlink}{if isset($importlink)}{$importlink}{/if}{if isset($exportlink)}{$exportlink}{/if}</div>