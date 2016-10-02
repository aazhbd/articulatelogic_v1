
<script type="text/javascript" src="{$smarty.const.URL}/scripts/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="{$smarty.const.URL}/scripts/js/jquery.validate.js"></script>
<script type="text/javascript" src="{$smarty.const.URL}/scripts/js/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="{$smarty.const.URL}/scripts/js/jquery.alerts.js" ></script>
<script type="text/javascript" src="{$smarty.const.URL}/scripts/js/jquery.form.js" ></script>
<script type="text/javascript" src="{$smarty.const.URL}/scripts/js/jquery.livequery.js"></script>

{literal}
<script type="text/javascript">
    var site = new Object();
    site.url = "{/literal}{$smarty.const.URL}{literal}"; 
    $(document).ready(function() {
        $('li').hover(function() {
                $(this).addClass('hover');
            }, function() {
                $(this).removeClass('hover');
            }
        );
    });
</script>
{/literal}