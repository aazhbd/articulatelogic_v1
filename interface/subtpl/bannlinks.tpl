<div style="width: 30%;">
    {if $islogin == false}
        <div id="toplinks" style="width: 300px;"><a href="{$smarty.const.URL}/login">Login</a>&nbsp;|&nbsp;<a href="{$smarty.const.URL}/signup"> Signup </a> </div>
    {else}
        <div id="toplinks" style="width: 300px;"><a href="{$smarty.const.URL}/logout"> Logout </a> &nbsp;|&nbsp;
        <a href="{$smarty.const.URL}/uhome"> Member Home </a></div>
    {/if}
    <div style="float: left;">
        {include file="frm_search.tpl"}
    </div>
</div>