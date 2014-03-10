{function name=tree_manager depth=0 tree=0}
  <ul class="sortableList{if $depth == 0} sortable{/if}">
  {foreach from=$tree item=item}
    <li id="cat_{$item.category_id}">
		<div class="label"><span>&nbsp;</span>{$item.category_name}</div>
		{if isset($item.children)}
			{tree_manager depth=$depth+1 tree=$item.children}
		{/if}
    </li>
  {/foreach}
  </ul>
{/function}

<script type="text/javascript">
function parseTree(ul){

	var tags = [];
	ul.children("li").each(function(){
	
		var subtree =	$(this).children("ul");
		if(subtree.size() > 0)
			tags.push([$(this).attr("id"), parseTree(subtree)]);
		else
			tags.push($(this).attr("id"));
	});
	
	return tags;
}

jQuery(document).ready(function($){

	jQuery('ul.sortable').nestedSortable({
		disableNesting: 'no-nest',
		forcePlaceholderSize: true,
		handle: 'div',
		items: 'li',
		opacity: 6,
		placeholder: 'placeholder',
		tabSize: 35,
		tolerance: 'pointer',
		listType: 'ul',
		toleranceElement: '> div'
	});

	jQuery("#listit2_orderform").submit(function(){

		var tree = $.toJSON(parseTree($('ul.sortable')));
		$('#orderdata').val(tree);
	});

});
</script>
<!-- start tab -->
<div id="page_tabs">
	<div id="reorder_categories">
		{$mod->ModLang('reorder_categories')}
	</div>
</div>
<!-- end tab //-->
<!-- start content -->
<div id="page_content"> 
	<div id="reorder_categories_c"> 

		<div id="listit2_orderform">
			{$formstart}

				<input type="hidden" name="{$actionid}orderdata" value="" id="orderdata" />

				<div class="pageoverflow">
				  <div class="pageinput">
					<div class="reorder-pages">
						{tree_manager tree=$tree}
					</div>
				  </div>
				<div>

				<div class="pageoverflow">
					<p class="pagetext">&nbsp;</p>
					<p class="pageinput">{$submit}{$cancel}</p>
				</div>
				
			{$formend}
		</div>

	</div>
</div>
<!-- end content //-->