{if $items|@count > 0}

{if $pagecount > 1}
<!-- pagination -->
<p>
{if $pagenumber > 1}
    {$firstpage}&nbsp;{$prevpage}
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

{if !empty($actionparams.search)}
    <h2>{$mod->ModLang('searchresultsfor')} &quot;{$actionparams.search}&quot;</h2>
{/if}

<ul>
{foreach from=$items item=item}
    <li class="item searchresult">
        <a href="{$item->url}">{$item->title}</a>
    </li>
{/foreach}
</ul>

{/if}