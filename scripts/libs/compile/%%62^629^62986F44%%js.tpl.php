<?php /* Smarty version 2.6.26, created on 2010-03-08 00:52:43
         compiled from subtpl/js.tpl */ ?>

<script type="text/javascript" src="<?php echo @URL; ?>
/scripts/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php echo @URL; ?>
/scripts/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo @URL; ?>
/scripts/js/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="<?php echo @URL; ?>
/scripts/js/jquery.alerts.js" ></script>
<script type="text/javascript" src="<?php echo @URL; ?>
/scripts/js/jquery.form.js" ></script>
<script type="text/javascript" src="<?php echo @URL; ?>
/scripts/js/jquery.livequery.js"></script>

<?php echo '
<script type="text/javascript">
    var site = new Object();
    site.url = "'; ?>
<?php echo @URL; ?>
<?php echo '"; 
    $(document).ready(function() {
        $(\'li\').hover(function() {
                $(this).addClass(\'hover\');
            }, function() {
                $(this).removeClass(\'hover\');
            }
        );
    });
</script>
'; ?>