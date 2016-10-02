<?php /* Smarty version 2.6.26, created on 2010-03-07 22:42:40
         compiled from view_result.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'view_result.tpl', 11, false),)), $this); ?>
<?php if ($this->_tpl_vars['articles'] != null): ?>
    <div style="float:left; width:100%;">
        <?php $_from = $this->_tpl_vars['articles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['art']):
?>
            <div class="artcont" style="height:auto;">
                <?php if ($this->_tpl_vars['art']['url'] == null || $this->_tpl_vars['art']['url'] == ""): ?>
                    <div class="entry" style="width:98%;"><a href='<?php echo @URL; ?>
/a/<?php echo $this->_tpl_vars['art']['id']; ?>
'><?php echo $this->_tpl_vars['art']['title']; ?>
</a></div>
                <?php else: ?>
                    <div class="entry" style="width:98%;"><a href='<?php echo @URL; ?>
/a/<?php echo $this->_tpl_vars['art']['url']; ?>
'><?php echo $this->_tpl_vars['art']['title']; ?>
</a></div>
                <?php endif; ?>
                <div class="entry" style="width:75%;"><?php echo $this->_tpl_vars['art']['subtitle']; ?>
</div>
                <div class="entry" style="width:20%;"><?php echo ((is_array($_tmp=$this->_tpl_vars['art']['date_inserted'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</div>
            </div>
        <?php endforeach; else: ?>
            <div class="artcont">
                <div class="entry" style="width:90%;">
                    <h3>No Match Found</h3>
                </div>
            </div>
        <?php endif; unset($_from); ?>
    </div>
<?php else: ?>
    <div class="artcont">
        <div class="entry" style="width:90%;">
            <h3>No Match Found</h3>
        </div>
    </div>
<?php endif; ?>