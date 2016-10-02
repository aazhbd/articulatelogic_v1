<?php /* Smarty version 2.6.26, created on 2010-03-09 00:00:40
         compiled from view_download.tpl */ ?>
<?php if ($this->_tpl_vars['pageTitle'] != null): ?>
    <div id="page_title">
        <?php echo $this->_tpl_vars['pageTitle']; ?>

    </div>
<?php endif; ?>
<div id='toptitle'>
    <h3><?php echo $this->_tpl_vars['data']['title']; ?>
</h3>
    <div style="float:right; padding:5px; width: 55%;">
        <a href="<?php echo @URL; ?>
/downloads" id="more" style='float:right;'> Back to Downloads &amp; Portfolio</a>
    </div>
</div>
<h3><?php echo $this->_tpl_vars['data']['subtitle']; ?>
</h3>
<div class="download-desc" >
    <img src="<?php echo @URL; ?>
/directories/is/<?php echo $this->_tpl_vars['img']['filepath']; ?>
" style='width:40%; float:left; padding:10px;' />
    <?php echo $this->_tpl_vars['data']['body']; ?>

</div>