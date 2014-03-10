{if $archives|@count > 0}

    <!-- archives -->
    <ul>
        {foreach from=$archives item='archive'}
            <li><a href="{$archive->url}">{$archive->month}/{$archive->year} ({$archive->count})</a> [{$archive->timestamp|cms_date_format:'%B %Y'}]</li>    
        {/foreach}
    </ul>
    <!-- archives //-->
    
{/if}