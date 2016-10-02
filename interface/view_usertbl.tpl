<h2 align="center">Users List</h2>
<div style="float:left;width:100%;background:#eee;">
    <span style="float:left;width:80%;" ><a href="{$smarty.const.URL}/uhome" class="sidelinks">Home</a> >> User Management </span>
    <span style="float:left;width:20%;" ><a href="{$smarty.const.URL}/add/user" class="sidelinks" >Add User</a></span>
</div>
<div style="float:left;width:100%;">
{if $data!= null} 
    <table class="innertbl" style="width:100%;float:left;border:1px solid #ddd;" >
        <tr style="width:100%;float:left; text-align:left; " class="tblhead" >
            <th style="width:20px;" class="tblfield" >Id</th>
            <th style="width:130px;" class="tblfield" >Email</th>
            <th style="width:80px;" class="tblfield" >Create Date</th>
            <th style="width:80px;" class="tblfield" >Update Date</th>
            <th style="width:60px;" class="tblfield">Permission</th>
            <th style="width:100px;" class="tblfield">Type</th>
            <th style="width:60px;" class="tblfield">Status</th>            
            <th style="width:50px;" class="tblfield">Edit</th>
            <th style="width:50px;" class="tblfield">Delete</th>
        </tr>
        {foreach from=$data item=user name=artname}
            {if $smarty.foreach.artname.iteration is even}
            <tr style="width:100%; float:left;" bgcolor="#FFFFFF">
            {else}
            <tr style="width:100%; float:left;" bgcolor="#D5E4EA">
            {/if}
                <td class="tblfield" style="width:20px;">{$user.id}</td>
                <td class="tblfield" style="width:130px;">{$user.email}</td>
                <td class="tblfield" style="width:80px;">{$user.date_inserted|date_format}</td>
                <td class="tblfield" style="width:80px;">{$user.date_updated|date_format}</td>
                <td class="tblfield" style="width:60px;">
                    {if $user.email != $email}
                        {if $user.state == 0 }<a href="{$smarty.const.URL}/toggle/user/permission/{$user.id}">Block</a>{elseif $user.state == 1 } <a href="{$smarty.const.URL}/toggle/user/permission/{$user.id}">Allow</a> {/if}
                    {else}
                        0 = Yes
                    {/if}    
                </td>
                <td class="tblfield" style="width:100px;">
                    {if $user.email != $email}
                        {if $user.utype == 0 }<a href="{$smarty.const.URL}/toggle/user/type/{$user.id}">Make Admin</a>{elseif $user.utype == 1 } <a href="{$smarty.const.URL}/toggle/user/type/{$user.id}">Make General</a> {/if}
                    {else}
                        {$user.utype} = Admin
                    {/if}
                </td>
                <td class="tblfield" style="width:60px;">
                    {if $user.email != $email}
                        {if $user.ustatus == 0 } <a href="{$smarty.const.URL}/toggle/user/status/{$user.id}">Activate</a>{elseif $user.ustatus == 1 } <a href="{$smarty.const.URL}/toggle/user/status/{$user.id}">Deactivate</a> {/if}
                    {else}
                        {$user.ustatus} = Active
                    {/if}
                </td>
                <td class="tblfield" style="width:50px;">
                    {if $user.email != $email}
                        <a href="{$smarty.const.URL}/edit/user/{$user.id}">Edit</a>
                    {else}
                        <a href="{$smarty.const.URL}/edit/account">Edit</a>
                    {/if}
                </td>
                <td class="tblfield" style="width:50px;">
                    {if $user.email != $email}
                        <a href="{$smarty.const.URL}/delete/user/{$user.id}" class="contdel">Delete
                    {else}
                        (Not Applicable)
                    {/if}
                </td>
            </tr>
        {/foreach}
    </table>
{else}
    <table class="innertbl" style="width:100%;background:#fff;">
        <tr style="width:100%; float:left;background:#684574;" class="tblhead">
            <th class="spanlist" style="width:100%;padding:5px;">No article has been added</th>
        </tr>
    </table>
{/if}
</div>
{literal}
<script type="text/javascript">
$(document).ready(function(){
    $('a.contdel').click(function(){
       var link = $(this).attr('href');
        jConfirm('Are you sure you want to delete this user?', 'Confirmation Dialog', function(r) {
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
