<?php /* Smarty version 2.6.26, created on 2010-03-07 21:56:13
         compiled from subtpl/head.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip', 'subtpl/head.tpl', 4, false),)), $this); ?>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-language" content="en" />
<meta name="author" content="www.articulatelogic.com, <?php echo $this->_tpl_vars['author']; ?>
" />
<meta name="description" content="<?php echo ((is_array($_tmp=$this->_tpl_vars['descrip'])) ? $this->_run_mod_handler('strip', true, $_tmp) : smarty_modifier_strip($_tmp)); ?>
" />
<meta name="keywords" content="Articulatelogic, <?php echo $this->_tpl_vars['keys']; ?>
" />
<meta name="robots" content="index, follow, I followed" />