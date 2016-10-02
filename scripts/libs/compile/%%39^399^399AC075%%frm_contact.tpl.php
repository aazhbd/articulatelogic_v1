<?php /* Smarty version 2.6.26, created on 2011-03-01 18:03:52
         compiled from frm_contact.tpl */ ?>
<?php echo '
<script type="text/javascript">
   $(document).ready(function(){
       $("#errors").hide();
   });
</script>
'; ?>

<?php if ($this->_tpl_vars['cont'] != null): ?>
    <?php echo $this->_tpl_vars['cont']; ?>

<?php endif; ?>
<div id="errors"></div>
<h3>Contact Form</h3>
<form name="contactform" id="contactform" method="post" action="<?php echo @URL; ?>
/sendcontactmail.php">
    <fieldset title="Contact Us">
    <legend>Feel free to send us any query</legend>
        <div>
            <apsn>
                <div style="float:left; width:80px;">
                    <label for="name">Name:</label>
                </div>
                <input type="text" name="name" id="name" style="width:450px;" />
            </span>
        </div>
        <div>
            <span> 
                <div style="float:left; width:80px;">
                    <label for="email">Email:</label>
                </div>
                <input type="text" name="email" id="email" style="width:450px;"/>
            </span>
        </div>
        <div>
            <span>
                <div style="float:left; width:80px;">
                    <label for="subj">Subject:</label>
                </div>
                <input type="text" name="subj" id="subj" style="width:450px;" />
            </span>
        </div>
        <div>
            <span>
                <div style="float:left; width:80px;">
                    <label for="body">Message:</label>
                </div>
                <textarea type="text" name="body" id="body" style="width:450px; height: 100px;"  ></textarea>
            </span>
        </div>
        <div>
            <span>
                <div style="float:left;">
                    <input type="submit" name="submit" id="button" value="Send Message" class="frmbtn"/><input type="reset" name="reset" id="button" value="Reset" class="frmbtn"/>
                </div>
            </span>
        </div>
    </fieldset>
</form>

<script language="javascript">
   <?php echo '
   $(document).ready(function(){       
       $("#contactform").validate({
           errorLabelContainer: "#errors",
           rules:{
               name:{ required: true, maxlength: 100 },
               email:{ required: true, email: true , maxlength: 100}, 
               subj:{ required: true, maxlength: 250},
               body:{ required: true, maxlength: 2500}
           },
           messages:{
               name: 
               {
                   required: "Please enter your name.",
                   maxlength: "Please type a name less than 100 characters long"
               },
               email: 
               {
                   required: "Please enter an email address.",
                   email: "Please enter a valid email address.",
                   maxlength: "Please enter a shorter email address within 100 characters"
               },
               subj: 
               {
                   required: "Please enter a subject",
                   maxlength: "Please enter a shorter subject within 250 characters"
               },
               body: 
               {
                   required: "Please enter your messsage",
                   maxlength: "Please enter a shorter message within 2500 characters"
               }
           }
       });
   });
   '; ?>

</script>
