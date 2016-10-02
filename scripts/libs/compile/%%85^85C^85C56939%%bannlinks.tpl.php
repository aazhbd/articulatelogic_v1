<?php /* Smarty version 2.6.26, created on 2010-03-07 21:47:08
         compiled from subtpl/bannlinks.tpl */ ?>
<div style="width: 30%;">
    <?php if ($this->_tpl_vars['islogin'] == false): ?>
        <div id="toplinks" style="width: 300px;"><a href="<?php echo @URL; ?>
/login">Login</a>&nbsp;|&nbsp;<a href="<?php echo @URL; ?>
/signup"> Signup </a> </div>
    <?php else: ?>
        <div id="toplinks" style="width: 300px;"><a href="<?php echo @URL; ?>
/logout"> Logout </a> &nbsp;|&nbsp;
        <a href="<?php echo @URL; ?>
/uhome"> Member Home </a></div>
    <?php endif; ?>
    <div style="float: left;">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "frm_search.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>
</div>