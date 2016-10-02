{if $info != null}
    {$info}
{/if}
<h2>Our Products</h2>
<div>
    {foreach item=dl from=$dList}
        <div class="item">
            <div>
                <span class="item-title"><a href="{$smarty.const.URL}/download/{$dl.url}">{$dl.title}</a></span>
                |
                <span>{$dl.subtitle}</span>
            </div>
            
            <div class="item-img">
                <a href="{$smarty.const.URL}/download/{$dl.url}">
                    <img src="{$smarty.const.URL}/directories/is/{$dl.image.filepath}" style="width: 100px;" alt="" />
                </a>
            </div>
            <div class="item-desc">
                {$dl.remarks}
                <a href="{$smarty.const.URL}/download/{$dl.url}" class="more">More</a>
            </div>
        </div>
    {/foreach}
</div>
<h2>Other Downloads</h2>
<div>
    {foreach item=dl from=$thirdparty}
        <div class="item">
            <div>
                <span class="item-title">
                    <a href="{$smarty.const.URL}/download/{$dl.url}">{$dl.title}</a>
                </span>
                |
                <span>
                    {$dl.subtitle}
                </span>
            </div>
            
            <div class="item-img">
                <a href="{$smarty.const.URL}/download/{$dl.url}"><img src="{$smarty.const.URL}/directories/is/{$dl.image.filepath}" style="width: 100px;" alt="" /></a>
            </div>
            <div class="item-desc">
                {$dl.remarks}
                <a href="{$smarty.const.URL}/download/{$dl.url}" class="more">More</a>
            </div>
        </div>
    {/foreach}
</div>
<h2>Portfolio</h2>
<div>
    {foreach item=dl from=$portfolio}
        <div class="item">
            <div>
                <span class="item-title">
                    <a href="{$smarty.const.URL}/download/{$dl.url}">{$dl.title}</a>
                </span>
                |
                <span>
                    {$dl.subtitle}
                </span>
            </div>
            
            <div class="item-img">
                <a href="{$smarty.const.URL}/download/{$dl.url}"><img src="{$smarty.const.URL}/directories/is/{$dl.image.filepath}" style="width: 100px;" alt="" /></a>
            </div>
            <div class="item-desc">
                {$dl.remarks}
                <a href="{$smarty.const.URL}/download/{$dl.url}" class="more">More</a>
            </div>
        </div>
    {/foreach}
</div>

<h2>Templates</h2>
<div>
    {foreach item=dl from=$templates}
        <div class="item">
            <div>
                <span class="item-title">
                    <a href="{$smarty.const.URL}/download/{$dl.url}">{$dl.title}</a>
                </span>
                |
                <span>
                    {$dl.subtitle}
                </span>
            </div>
            
            <div class="item-img">
                <a href="{$smarty.const.URL}/download/{$dl.url}"><img src="{$smarty.const.URL}/directories/is/{$dl.image.filepath}" style="width: 100px;" alt="" /></a>
            </div>
            <div class="item-desc">
                {$dl.remarks}
                <a href="{$smarty.const.URL}/download/{$dl.url}" class="more">More</a>
            </div>
        </div>
    {/foreach}
</div>