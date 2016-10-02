<?php /* Smarty version 2.6.26, created on 2011-01-16 12:42:24
         compiled from error.tpl */ ?>
<html>
<head>
    <title>Error Occured</title>
</head>

<body>
<p style="background:aqua;">
    Error:
    <?php $_from = $this->_tpl_vars['errmsg']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['msg']):
?>
        <?php echo $this->_tpl_vars['msg']; ?>
 <br />
    <?php endforeach; endif; unset($_from); ?>
</p>
</body>
</html>