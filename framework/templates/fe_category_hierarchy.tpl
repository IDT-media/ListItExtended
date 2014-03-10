<!-- categories hierarchy -->
<ul class="categories">
{foreach from=$categories item=category}

{if $category->depth > $category->prevdepth}
	{repeat string="<ul>" times=$category->depth-$category->prevdepth}
{elseif $category->depth < $category->prevdepth}
	{repeat string="</li></ul>" times=$category->prevdepth-$category->depth}
	</li>
{elseif $category->index > 0}
	</li>
{/if}

{if $category->current}
<li class="category-{$category->alias} current{if $category->parent == true || $category->children|@count > 0} parent{/if}">
	<a href="{$category->url}">{$category->menutext}</a>
{else}
<li class="category-{$category->alias}{if $category->parent == true || $category->children|@count > 0} parent{/if}">
	<a href="{$category->url}">{$category->menutext}</a>
{/if}

{/foreach}

	{repeat string="</li></ul>" times=$category->depth-1}
	</li>
</ul>
<!-- categories hierarchy //-->