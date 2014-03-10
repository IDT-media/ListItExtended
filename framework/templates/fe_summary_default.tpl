{if $items|@count > 0}

	{if $pagecount > 1}
	<!-- pagination -->
	<p>
		{if $pagenumber > 1}
			{$firstpage}&nbsp;{$prevpage}&nbsp;
		{/if}
			{foreach from=$pagelinks item=page}
				{$page->link}
			{/foreach}
		{if $pagenumber < $pagecount}
			&nbsp;{$nextpage}&nbsp;{$lastpage}
		{/if}
	</p>
	<!-- pagination //-->
	{/if}
	
	<!-- items -->
	{foreach from=$items item=item}
	<!-- item -->
	<div class="item">
	
		<h2 class="item-title">{$item->title}</h2>
	
		{if !empty($item->fielddefs)}
		<!-- field definitions -->
		<div class="item-properties">
			{foreach from=$item->fielddefs item=fielddef}
	
			{*
				Categories were moved to field definitions.
				If you need Categories, create new Field definition with alias "category"
				and Categories will be available again.
			*}
	
			{if $fielddef.type == 'Categories' && ($fielddef.value != '')}
	
			{* use ListIt2Loader plugin if you need Category information in default module action templates *}
			{ListIt2Loader item='category' force_array=1 value=$fielddef.value assign='cats'}
	
			<!-- categories -->
			<div class="item-category">
				Category: {$cats|implode:','}
			</div>
			<!-- categories //-->
			{/if}
	
			{if $fielddef.value && $fielddef.type != 'Categories'}
				{if $fielddef.type == 'SelectFile' || $fielddef.type == 'FileUpload'}
					{$fielddef.name}: <a href="{$fielddef->GetImagePath(true)}/{$fielddef.value}">{$fielddef.value}</a><br />
				{elseif $fielddef.type == 'SelectDateTime'}
					{$fielddef.name}: {$fielddef.value|cms_date_format}<br />
				{else}
					{$fielddef.name}: {$fielddef.value}<br />
				{/if}
			{/if}
	
			{/foreach}
		</div>
		<!-- field definitions //-->
		{/if}
	
		<a href="{$item->url}">more</a>
	</div>
	<!-- item //-->
	{/foreach}
	<!-- items //-->

{/if}