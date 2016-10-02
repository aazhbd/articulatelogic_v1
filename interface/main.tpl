<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {include file="subtpl/head.tpl"}
    <title>{$ttitle}</title>
    {include file="subtpl/mlinks.tpl"}
    {include file="subtpl/js.tpl"}
</head>

<body>    
    <div id="wrapper">
        <div id="banner">
            {include file="subtpl/logo.tpl"}
            {include file="subtpl/bannlinks.tpl"}
        </div>
        <div id="navigatemenu">
            {include file="subtpl/menu.tpl"}
        </div>
        <div id="contents">            
            {if $rep != null}
                <div id="reports">{$rep}</div>
            {/if}        
            
            {if $title!= null}
                <h2 class="title">{$title}</h2>
            {/if}
            
            {if $subtitle != null}
                <div class="subtitle">{$subtitle}</div>
            {/if}
            
            {if $body != null}
                <div class="textbody">{$body}</div>
            {/if}            
        </div>        
        <div id="sidebar">
            {include file="subtpl/view_quicklink.tpl"}
        </div>
        {if $home != ""}
            {include file="subtpl/buttons.tpl"}
        {/if}        
    </div>
    <div id="footer">
        {include file="subtpl/footer.tpl"}
    </div>
    {literal}
    <script type="text/javascript">
    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
    try {
    var pageTracker = _gat._getTracker("UA-10149323-1");
    pageTracker._trackPageview();
    } catch(err) {}</script>
    {/literal}
</body>
</html>
