<!-- categories -->
<ul>
{foreach from=$categories item=category}
	<li class="category-{$category->alias}">
		<a class="category-name" href="{$category->url}">{$category->name} ({$category->items|count})</a>
			{if !empty($category->description)}
			<div class="category-description">
				{eval var=$category->description}
			</div>
			{/if}
	</li>
{/foreach}
<ul>
<!-- categories //-->