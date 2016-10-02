
<form action="{$smarty.const.URL}/searchcontent.php" id="frmsearch" method="post" class="search">
    <span>
        <input type="text" id="search" name="search" {if $token != null} value="{$token}" {else} value="Search" {/if} onclick="this.value=''" class="search" />
        <input type="image" name="submit" id="submit" value="submit" class="btnsearch"  src="{$smarty.const.URL}/interface/images/search.png"/>
    </span>
</form>