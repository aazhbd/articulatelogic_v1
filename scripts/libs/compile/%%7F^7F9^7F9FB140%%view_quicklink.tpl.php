<?php /* Smarty version 2.6.26, created on 2010-03-17 05:57:28
         compiled from subtpl/view_quicklink.tpl */ ?>
<?php if ($this->_tpl_vars['islogin'] == false): ?>
<a href="<?php echo @URL; ?>
/signup">
    <span class="fbox">
        <img src="<?php echo @URL; ?>
/interface/images/signup.png" style="width: 55px;" alt="" />
        <span class="quicktitle">Signup</span>
        <span class="quicklinks">Become a member of ArticulateLogic.com</span>
    </span>
</a>
<?php endif; ?>
<a href="<?php echo @URL; ?>
/contact">
    <span class="fbox">
        <img src="<?php echo @URL; ?>
/interface/images/mail.png" style="width: 55px;" alt="" />
        <span class="quicktitle">Contact</span>
        <span class="quicklinks">Submit your queries and requests</span>
    </span>
</a>

<a href="<?php echo @URL; ?>
/a/submitdownload">
    <span class="fbox">
        <img src="<?php echo @URL; ?>
/interface/images/download2.png" style="width: 55px;" alt="" />
        <span class="quicktitle">Submit Downloads</span>
        <span class="quicklinks">
            Apply to submit your downloads
        </span>
    </span>
</a>

<p>
    <a href="http://validator.w3.org/check?uri=referer">
        <img
        src="http://www.w3.org/Icons/valid-xhtml10"
        alt="Valid XHTML 1.0 Transitional" height="31" width="88" />
    </a>
</p>