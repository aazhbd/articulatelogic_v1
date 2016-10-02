<?php /* Smarty version 2.6.26, created on 2010-03-08 00:27:47
         compiled from view_home.tpl */ ?>

 <?php if ($this->_tpl_vars['home_cont'] != null): ?>
    <div id="full">
        <?php echo $this->_tpl_vars['home_cont']; ?>

        <a href="#" id="collapse"> read less</a>
    </div>
    <div id="half">
        <?php echo $this->_tpl_vars['home_cont2']; ?>

        <a href="#" id="clickme"> read more</a>
    </div>
<?php endif; ?>

<?php echo '
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
'; ?>