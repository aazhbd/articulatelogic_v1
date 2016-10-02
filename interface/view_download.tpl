{if $pageTitle != null}
    <div id="page_title">
        {$pageTitle}
    </div>
{/if}
<div id='toptitle'>
    <h3>{$data.title}</h3>
    <div style="float:right; padding:5px; width: 55%;">
        <a href="{$smarty.const.URL}/downloads" id="more" style='float:right;'> Back to Downloads &amp; Portfolio</a>
    </div>
</div>
<h3>{$data.subtitle}</h3>
<div class="download-desc" >
    <img src="{$smarty.const.URL}/directories/is/{$img.filepath}" style='width:40%; float:left; padding:10px;' />
    {$data.body}
</div>