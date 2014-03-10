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

		<table cellspacing="0" class="pagetable">
			<thead>
				<tr class="top">
					<th>{$mod->ModLang('import_alias')}</th>
					<th>{$mod->ModLang('file_alias')}</th>
					<th>{lang('help')}</th>
					<th class="pageicon">{$mod->ModLang('required')}</th>
				</tr>
			</thead>
			<tbody class="content" width="100%">
		{foreach from=$database_values item=obj}
				<tr class="{cycle values='row1,row2'}">
					<td>{$obj->alias}</td>
					<td>{html_options name="`$actionid`import_values[`$obj->alias`]" options=$file_values}</td>
					<td>{$obj->help}</td>
					<td>{$obj->required_image}</td>
				</tr>
		{/foreach}		
			</tbody>
		</table>		

		<div class="pageoverflow">
			<div class="pagetext">&nbsp;</div>
			<div class="pageinput">{$previous}{$do_import}{$cancel}</div>
		</div>

		{$endform}
	</div>
</div>
<!-- end content //-->