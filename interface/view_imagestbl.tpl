<h2 align="center">Images List</h2>
<div style="float:left;width:100%;background:#eee;">
    <span style="float:left;width:80%;" ><a href="{$smarty.const.URL}/uhome" class="sidelinks">Home</a> >> Image Management</span>
    <span style="float:left;width:20%;" ><a href="{$smarty.const.URL}/add/image" class="sidelinks" >Add Images</a></span>
</div>
<div style="float:left;width:100%;">
{if $data!= null} 
    <table class="innertbl" style="width:100%;float:left;border:1px solid #ddd;" >
        <tr style="width:100%;float:left; text-align:left; " class="tblhead" >
            <th style="width:10px;" class="tblfield" >Id</th>
            <th style="width:100px;" class="tblfield" >Image title</th>
            <th style="width:150px;" class="tblfield" >File name</th>
            <th style="width:150px;" class="tblfield" >File path</th>
            <th style="width:60px;" class="tblfield" >Article Id</th>
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
                <td class="tblfield" style="width:100px;">{$art.ftitle}</td>
                <td class="tblfield" style="width:150px;">{$art.filename}</td>
                <td class="tblfield" style="width:150px;">{$art.filepath}</td>
                <td class="tblfield" style="width:60px;">{$art.article_id} </td>
                <td class="tblfield" style="width:80px;">{$art.date_inserted|date_format}</td>
                <td class="tblfield" style="width:80px;">{$art.date_updated|date_format}</td>
                <td class="tblfield" style="width:60px;">{if $art.state == 0} <a href="{$smarty.const.URL}/toggle/image/permission/{$art.id}">Disable</a>{elseif $art.state == 1} <a href="{$smarty.const.URL}/toggle/image/permission/{$art.id}">Enable</a>{/if}</td>
                <td class="tblfield" style="width:30px;"><a href="{$smarty.const.URL}/edit/image/{$art.id}">Edit</a></td>
                <td class="tblfield" style="width:30px;"><a href="{$smarty.const.URL}/delete/image/{$art.id}" class="del_art">Delete</td>
            </tr>
        {/foreach}
    </table>
{else}
    <table class="innertbl" style="width:100%;background:#fff;">
        <tr style="width:100%; float:left;background:#684574;" class="tblhead">
            <th class="spanlist" style="width:100%;padding:5px;">No image has been added</th>
        </tr>
    </table>
{/if}
</div>
{literal}
<script type="text/javascript">
$(document).ready(function(){
    $('a.del_art').click(function(){
       var link = $(this).attr('href');
        jConfirm('Are you sure you want to delete this image?', 'Confirmation Dialog', function(r) {
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