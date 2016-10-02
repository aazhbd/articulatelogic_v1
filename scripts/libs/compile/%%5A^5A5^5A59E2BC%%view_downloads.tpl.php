<?php /* Smarty version 2.6.26, created on 2010-03-17 06:24:44
         compiled from view_downloads.tpl */ ?>
<?php if ($this->_tpl_vars['info'] != null): ?>
    <?php echo $this->_tpl_vars['info']; ?>

<?php endif; ?>
<h2>Our Products</h2>
<div>
    <?php $_from = $this->_tpl_vars['dList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['dl']):
?>
        <div class="item">
            <div>
                <span class="item-title"><a href="<?php echo @URL; ?>
/download/<?php echo $this->_tpl_vars['dl']['url']; ?>
"><?php echo $this->_tpl_vars['dl']['title']; ?>
</a></span>
                |
                <span><?php echo $this->_tpl_vars['dl']['subtitle']; ?>
</span>
            </div>
            
            <div class="item-img">
                <a href="<?php echo @URL; ?>
/download/<?php echo $this->_tpl_vars['dl']['url']; ?>
">
                    <img src="<?php echo @URL; ?>
/directories/is/<?php echo $this->_tpl_vars['dl']['image']['filepath']; ?>
" style="width: 100px;" alt="" />
                </a>
            </div>
            <div class="item-desc">
                <?php echo $this->_tpl_vars['dl']['remarks']; ?>

                <a href="<?php echo @URL; ?>
/download/<?php echo $this->_tpl_vars['dl']['url']; ?>
" class="more">More</a>
            </div>
        </div>
    <?php endforeach; endif; unset($_from); ?>
</div>
<h2>Other Downloads</h2>
<div>
    <?php $_from = $this->_tpl_vars['thirdparty']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['dl']):
?>
        <div class="item">
            <div>
                <span class="item-title">
                    <a href="<?php echo @URL; ?>
/download/<?php echo $this->_tpl_vars['dl']['url']; ?>
"><?php echo $this->_tpl_vars['dl']['title']; ?>
</a>
                </span>
                |
                <span>
                    <?php echo $this->_tpl_vars['dl']['subtitle']; ?>

                </span>
            </div>
            
            <div class="item-img">
                <a href="<?php echo @URL; ?>
/download/<?php echo $this->_tpl_vars['dl']['url']; ?>
"><img src="<?php echo @URL; ?>
/directories/is/<?php echo $this->_tpl_vars['dl']['image']['filepath']; ?>
" style="width: 100px;" alt="" /></a>
            </div>
            <div class="item-desc">
                <?php echo $this->_tpl_vars['dl']['remarks']; ?>

                <a href="<?php echo @URL; ?>
/download/<?php echo $this->_tpl_vars['dl']['url']; ?>
" class="more">More</a>
            </div>
        </div>
    <?php endforeach; endif; unset($_from); ?>
</div>
<h2>Portfolio</h2>
<div>
    <?php $_from = $this->_tpl_vars['portfolio']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['dl']):
?>
        <div class="item">
            <div>
                <span class="item-title">
                    <a href="<?php echo @URL; ?>
/download/<?php echo $this->_tpl_vars['dl']['url']; ?>
"><?php echo $this->_tpl_vars['dl']['title']; ?>
</a>
                </span>
                |
                <span>
                    <?php echo $this->_tpl_vars['dl']['subtitle']; ?>

                </span>
            </div>
            
            <div class="item-img">
                <a href="<?php echo @URL; ?>
/download/<?php echo $this->_tpl_vars['dl']['url']; ?>
"><img src="<?php echo @URL; ?>
/directories/is/<?php echo $this->_tpl_vars['dl']['image']['filepath']; ?>
" style="width: 100px;" alt="" /></a>
            </div>
            <div class="item-desc">
                <?php echo $this->_tpl_vars['dl']['remarks']; ?>

                <a href="<?php echo @URL; ?>
/download/<?php echo $this->_tpl_vars['dl']['url']; ?>
" class="more">More</a>
            </div>
        </div>
    <?php endforeach; endif; unset($_from); ?>
</div>

<h2>Templates</h2>
<div>
    <?php $_from = $this->_tpl_vars['templates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['dl']):
?>
        <div class="item">
            <div>
                <span class="item-title">
                    <a href="<?php echo @URL; ?>
/download/<?php echo $this->_tpl_vars['dl']['url']; ?>
"><?php echo $this->_tpl_vars['dl']['title']; ?>
</a>
                </span>
                |
                <span>
                    <?php echo $this->_tpl_vars['dl']['subtitle']; ?>

                </span>
            </div>
            
            <div class="item-img">
                <a href="<?php echo @URL; ?>
/download/<?php echo $this->_tpl_vars['dl']['url']; ?>
"><img src="<?php echo @URL; ?>
/directories/is/<?php echo $this->_tpl_vars['dl']['image']['filepath']; ?>
" style="width: 100px;" alt="" /></a>
            </div>
            <div class="item-desc">
                <?php echo $this->_tpl_vars['dl']['remarks']; ?>

                <a href="<?php echo @URL; ?>
/download/<?php echo $this->_tpl_vars['dl']['url']; ?>
" class="more">More</a>
            </div>
        </div>
    <?php endforeach; endif; unset($_from); ?>
</div>