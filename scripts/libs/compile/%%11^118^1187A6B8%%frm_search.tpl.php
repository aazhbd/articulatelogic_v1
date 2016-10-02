<?php /* Smarty version 2.6.26, created on 2010-03-07 21:47:08
         compiled from frm_search.tpl */ ?>

<form action="<?php echo @URL; ?>
/searchcontent.php" id="frmsearch" method="post" class="search">
    <span>
        <input type="text" id="search" name="search" <?php if ($this->_tpl_vars['token'] != null): ?> value="<?php echo $this->_tpl_vars['token']; ?>
" <?php else: ?> value="Search" <?php endif; ?> onclick="this.value=''" class="search" />
        <input type="image" name="submit" id="submit" value="submit" class="btnsearch"  src="<?php echo @URL; ?>
/interface/images/search.png"/>
    </span>
</form>