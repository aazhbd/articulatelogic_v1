<h2 align="center">Files List</h2>
<div style="float:left;width:100%;background:#eee;">
    <span style="float:left;width:80%;" ><a href="{$smarty.const.URL}/uhome" class="sidelinks">Home</a> >> Files Management</span>
    <span style="float:left;width:20%;" ><a href="{$smarty.const.URL}/add/file" class="sidelinks" >Add Files</a></span>
</div>
<div style="float:left;width:100%;">
{if $data!= null} 
    <table class="innertbl" style="width:100%;float:left;border:1px solid #ddd;" >
        <tr style="width:100%;float:left; text-align:left; " class="tblhead" >
            <th style="width:10px;" class="tblfield" >Id</th>
            <th style="width:70px;" class="tblfield" >File title</th>
            <th style="width:100px;" class="tblfield" >File name</th>
            <th style="width:120px;" class="tblfield" >File path</th>
            <th style="width:80px;" class="tblfield" >URL</th>
            <th style="width:35px;" class="tblfield" >Hit count</th>
            <th style="width:50px;" class="tblfield">Category</th>
            <th style="width:80px;" class="tblfield" >Insert Date</th>
            <th style="width:80px;" class="tblfield" >Update Date</th>
            <th style="width:60px;" class="tblfield" >Permission</th>
            <th style="width:30px;" class="tblfield">Edit</th>
            <th style="width:30px;" class="tblfield">Delete</th>
        </tr>
        {foreach from=$data item=art name=artname}
            {if $smarty.foreach.artname.iteration is even}
            <tr style="width:100%; float:left;" bgcolor="#FFFFFF">
            {else}
            <tr style="width:100%; float:left;" bgcolor="#D5E4EA">
            {/if}
                <td class="tblfield" style="width:10px;">{$art.id}</td>
                <td class="tblfield" style="width:70px;"><a href='{$smarty.const.URL}/getfile.php?f={$art.url}'>{$art.ftitle|wordwrap:12:"<br />\n":true}</a></td>
                <td class="tblfield" style="width:100px;"><a href='{$smarty.const.URL}/getfile.php?f={$art.url}'>{$art.filename|wordwrap:15:"<br />\n":true}</a></td>
                <td class="tblfield" style="width:120px;"><a href='{$smarty.const.URL}/getfile.php?f={$art.url}'>{$art.filepath|wordwrap:15:"<br />\n":true}</a></td>
                <td class="tblfield" style="width:80px;"><a href='{$smarty.const.URL}/getfile.php?f={$art.url}'>{if $art.url != null}{$art.url|wordwrap:15:"<br />\n":true} {else} (Not given){/if}</a></td>
                <td class="tblfield" style="width:35px;"><span style="float: right; width: 20px;">{$art.hitcount}</span></td>
                {foreach item=c from=$catList}
                    {if $c.id == $art.category_id}
                        <td class="tblfield" style="width:50px;">{$c.catname}</td>
                    {/if}
                {/foreach}
                <td class="tblfield" style="width:80px;">{$art.date_inserted|date_format}</td>
                <td class="tblfield" style="width:80px;">{$art.date_updated|date_format}</td>
                <td class="tblfield" style="width:60px;">{if $art.state == 0} <a href="{$smarty.const.URL}/toggle/file/permission/{$art.id}">Disable</a>{elseif $art.state == 1} <a href="{$smarty.const.URL}/toggle/file/permission/{$art.id}">Enable</a>{/if}</td>
                <td class="tblfield" style="width:30px;"><a href="{$smarty.const.URL}/edit/file/{$art.id}">Edit</a></td>
                <td class="tblfield" style="width:30px;"><a href="{$smarty.const.URL}/delete/file/{$art.id}" class="del_art">Delete</td>
            </tr>
        {/foreach}
    </table>
{else}
    <table class="innertbl" style="width:100%;background:#fff;">
        <tr style="width:100%; float:left;background:#684574;" class="tblhead">
            <th class="spanlist" style="width:100%;padding:5px;">No file has been added</th>
        </tr>
    </table>
{/if}
</div>
{literal}
<script type="text/javascript">
$(document).ready(function(){
    $('a.del_art').click(function(){
       var link = $(this).attr('href');
        jConfirm('Are you sure you want to delete this file?', 'Confirmation Dialog', function(r) {
            if(r == true){
                window.location.href = link;
            }
            else{
                return false;
            }
        });
        return false;
    });
});
</script>
{/literal}