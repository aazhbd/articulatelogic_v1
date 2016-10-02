{if $articles != null}
    <div style="float:left; width:100%;">
        {foreach item=art from=$articles}
            <div class="artcont" style="height:auto;">
                {if $art.url == null || $art.url == ""}
                    <div class="entry" style="width:98%;"><a href='{$smarty.const.URL}/a/{$art.id}'>{$art.title}</a></div>
                {else}
                    <div class="entry" style="width:98%;"><a href='{$smarty.const.URL}/a/{$art.url}'>{$art.title}</a></div>
                {/if}
                <div class="entry" style="width:75%;">{$art.subtitle}</div>
                <div class="entry" style="width:20%;">{$art.date_inserted|date_format}</div>
            </div>
        {foreachelse}
            <div class="artcont">
                <div class="entry" style="width:90%;">
                    <h3>No Match Found</h3>
                </div>
            </div>
        {/foreach}
    </div>
{else}
    <div class="artcont">
        <div class="entry" style="width:90%;">
            <h3>No Match Found</h3>
        </div>
    </div>
{/if}
