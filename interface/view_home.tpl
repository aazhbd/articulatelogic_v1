
 {if $home_cont != null}
    <div id="full">
        {$home_cont}
        <a href="#" id="collapse"> read less</a>
    </div>
    <div id="half">
        {$home_cont2}
        <a href="#" id="clickme"> read more</a>
    </div>
{/if}

{literal}
<script type="text/javascript">
    $(document).ready(function() {
        $("#full").hide();
        
        $("#clickme").click(function(){
                $("#full").show();
                $("#half").hide();
                $("#clickme").hide();
                $("#collapse").show();
        });
        
        $("#collapse").click(function(){
                $("#full").hide();
                $("#half").show();
                $("#collapse").hide();
                $("#clickme").show();
        });
    });
</script>
{/literal}