
{if $islogin === true}
    <a href="{$smarty.const.URL}/logout">Logout</a>
    |
    <a href="{$smarty.const.URL}/uhome">Member Home</a>
{else}
    <a href="{$smarty.const.URL}/login">Login</a>
    |
    <a href="{$smarty.const.URL}/signup">Signup</a>
{/if}