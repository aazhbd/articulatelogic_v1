<?php /* Smarty version 2.6.26, created on 2010-03-08 02:35:52
         compiled from view_imagestbl.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'view_imagestbl.tpl', 32, false),)), $this); ?>
<h2 align="center">Images List</h2>
<div style="float:left;width:100%;background:#eee;">
    <span style="float:left;width:80%;" ><a href="<?php echo @URL; ?>
/uhome" class="sidelinks">Home</a> >> Image Management</span>
    <span style="float:left;width:20%;" ><a href="<?php echo @URL; ?>
/add/image" class="sidelinks" >Add Images</a></span>
</div>
<div style="float:left;width:100%;">
<?php if ($this->_tpl_vars['data'] != null): ?> 
    <table class="innertbl" style="width:100%;float:left;border:1px solid #ddd;" >
        <tr style="width:100%;float:left; text-align:left; " class="tblhead" >
            <th style="width:10px;" class="tblfield" >Id</th>
            <th style="width:100px;" class="tblfield" >Image title</th>
            <th style="width:150px;" class="tblfield" >File name</th>
            <th style="width:150px;" class="tblfield" >File path</th>
            <th style="width:60px;" class="tblfield" >Article Id</th>
            <th style="width:80px;" class="tblfield" >Insert Date</th>
            <th style="width:80px;" class="tblfield" >Update Date</th>
            <th style="width:60px;" class="tblfield" >Permission</th>
            <th style="width:30px;" class="tblfield">Edit</th>
            <th style="width:30px;" class="tblfield">Delete</th>
        </tr>
        <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['artname'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['artname']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['art']):
        $this->_foreach['artname']['iteration']++;
?>
            <?php if (!(1 & $this->_foreach['artname']['iteration'])): ?>
            <tr style="width:100%; float:left;" bgcolor="#FFFFFF">
            <?php else: ?>
            <tr style="width:100%; float:left;" bgcolor="#D5E4EA">
            <?php endif; ?>
                <td class="tblfield" style="width:10px;"><?php echo $this->_tpl_vars['art']['id']; ?>
</td>
                <td class="tblfield" style="width:100px;"><?php echo $this->_tpl_vars['art']['ftitle']; ?>
</td>
                <td class="tblfield" style="width:150px;"><?php echo $this->_tpl_vars['art']['filename']; ?>
</td>
                <td class="tblfield" style="width:150px;"><?php echo $this->_tpl_vars['art']['filepath']; ?>
</td>
                <td class="tblfield" style="width:60px;"><?php echo $this->_tpl_vars['art']['article_id']; ?>
 </td>
                <td class="tblfield" style="width:80px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['art']['date_inserted'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
                <td class="tblfield" style="width:80px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['art']['date_updated'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
                <td class="tblfield" style="width:60px;"><?php if ($this->_tpl_vars['art']['state'] == 0): ?> <a href="<?php echo @URL; ?>
/toggle/image/permission/<?php echo $this->_tpl_vars['art']['id']; ?>
">Disable</a><?php elseif ($this->_tpl_vars['art']['state'] == 1): ?> <a href="<?php echo @URL; ?>
/toggle/image/permission/<?php echo $this->_tpl_vars['art']['id']; ?>
">Enable</a><?php endif; ?></td>
                <td class="tblfield" style="width:30px;"><a href="<?php echo @URL; ?>
/edit/image/<?php echo $this->_tpl_vars['art']['id']; ?>
">Edit</a></td>
                <td class="tblfield" style="width:30px;"><a href="<?php echo @URL; ?>
/delete/image/<?php echo $this->_tpl_vars['art']['id']; ?>
" class="del_art">Delete</td>
            </tr>
        <?php endforeach; endif; unset($_from); ?>
    </table>
<?php else: ?>
    <table class="innertbl" style="width:100%;background:#fff;">
        <tr style="width:100%; float:left;background:#684574;" class="tblhead">
            <th class="spanlist" style="width:100%;padding:5px;">No image has been added</th>
        </tr>
    </table>
<?php endif; ?>
</div>
<?php echo '
<script type="text/javascript">
$(document).ready(function(){
    $(\'a.del_art\').click(function(){
       var link = $(this).attr(\'href\');
        jConfirm(\'Are you sure you want to delete this image?\', \'Confirmation Dialog\', function(r) {
            if(r == true){
                window.location.href = link;
            }
            else{
                return false;
            }
        });
        return false;
    });
});
</script>
'; ?>