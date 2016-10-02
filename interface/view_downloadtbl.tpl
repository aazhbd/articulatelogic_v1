<h2 align="center">Downloads List</h2>
<div style="float:left;width:100%;background:#eee;">
    <span style="float:left;width:80%;" ><a href="{$smarty.const.URL}/home" class="sidelinks">Home</a> >> Download Management</span>
    <span style="float:left;width:20%;" ><a href="{$smarty.const.URL}/download/add" class="sidelinks" >Add Downloads</a></span>
</div>
<div style="float:left;width:100%;">
{if $downloads!= null} 
    <table class="innertbl" style="width:100%;float:left;border:1px solid #ddd;" >
        <tr style="width:100%;float:left; text-align:left; " class="tblhead" >
            <th style="width:10px;" class="tblfield" >Id</th>
            <th style="width:60px;" class="tblfield" >Title</th>
            <th style="width:150px;" class="tblfield" >File Path</th>
            <th style="width:50px;" class="tblfield">Category</th>
            <th style="width:50px;" class="tblfield">Download count</th>
            <th style="width:80px;" class="tblfield" >Insert Date</th>
            <th style="width:80px;" class="tblfield" >Update Date</th>
            <th style="width:60px;" class="tblfield" >Permission</th>
            <th style="width:30px;" class="tblfield">Edit</th>
            <th style="width:30px;" class="tblfield">Delete</th>
        </tr>
        {foreach from=$downloads item=dl name=dlname}
            {if $smarty.foreach.dlname.iteration is even}
            <tr style="width:100%; float:left;" bgcolor="#FFFFFF">
            {else}
            <tr style="width:100%; float:left;" bgcolor="#D5E4EA">
            {/if}
                <td class="tblfield" style="width:10px;">{$dl.id}</td>                
                <td class="tblfield" style="width:60px;"><a href="{$smarty.const.URL}/download/view/{$dl.id}" class="sidelinks">{$dl.title}</a></td>
                <td class="tblfield" style="width:150px;">{if $dl.fpath != null}{$dl.fpath|wordwrap:26:"\n":true} {/if}</td>
                <td class="tblfield" style="width:50px;">{$dl.category}</td>
                <td class="tblfield" style="width:50px;">{$dl.dcount}</td>
                <td class="tblfield" style="width:80px;">{$dl.ins_date|date_format}</td>
                <td class="tblfield" style="width:80px;">{$dl.upd_date|date_format}</td>
                <td class="tblfield" style="width:60px;">{if $dl.admin_perm == 0} <a href="{$smarty.const.URL}/toggle/download/permission/{$dl.id}">Disable</a>{elseif $art.admin_perm == 1} <a href="{$smarty.const.URL}/toggle/download/permission/{$dl.id}">Enable</a>{/if}</td>
                <td class="tblfield" style="width:30px;"><a href="{$smarty.const.URL}/download/edit/{$dl.id}">Edit</a></td>
                <td class="tblfield" style="width:30px;"><a href="{$smarty.const.URL}/download/delete/{$dl.id}" class="del_art">Delete</td>
            </tr>
        {/foreach}
    </table>
{else}
    <table class="innertbl" style="width:100%;background:#fff;">
        <tr style="width:100%; float:left;background:#684574;" class="tblhead">
            <th class="spanlist" style="width:100%;padding:5px;">No download has been been submitted</th>
        </tr>
    </table>
{/if}
</div>
{literal}
<script type="text/javascript">
$(document).ready(function(){
    $('a.del_art').click(function(){
       var link = $(this).attr('href');
        jConfirm('Are you sure you want to delete this page?', 'Confirmation Dialog', function(r) {
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