<?php /* Smarty version 2.6.26, created on 2010-03-17 06:07:25
         compiled from frm_signup.tpl */ ?>
<?php echo '
<script type="text/javascript">
   $(document).ready(function(){
       $("#errors").hide();
        $(\'#datepicker\').datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: \'1900:2010\'
        });       
   });
</script>
'; ?>

<div>
    <div id="errors"></div>
    <br />
    <form id="frmsignup" method="post" action="<?php echo @URL; ?>
/signup.php">
        <fieldset title="Signup form">
            <legend>Please Signup</legend>            
            <div>
                <span>
                    <label for="fname" style="float:left; width:120px;">First Name:</label>
                    <input type="text" name="fname" id="fname" style="width:200px;" />
                </span>
                <div class="subinfo" >Write your first name</div>
            </div>
            <div>
                <span>
                    <label for="lname" style="float:left; width:120px;">Last Name:</label>
                    <input type="text" name="lname" id="lname" style="width:200px;" />
                </span>
                <div class="subinfo">Write your last name</div>
            </div>
            <div>
                <span>
                    <label for="email" style="float:left; width:120px;">Email:</label>
                    <input type="text" name="email" id="email" style="width:200px;" />
                </span>
                <div class="subinfo">Write your email address</div>
            </div>            
            <div>
                <span>
                    <label for="password" style="float:left; width:120px;">Password:</label>
                    <input type="password" name="password" id="password" style="width:200px;" />
                </span>
                <div class="subinfo">Type your password</div>
            </div>
            <div>
                <span>
                    <label for="rpass" style="float:left; width:120px;">Re-type:</label>
                    <input type="password" name="rpass" id="rpass" style="width:200px;" />
                </span>
            </div>
            <div>
                <span>
                    <label for="sex" style="float:left; width:120px;">Sex: </label>
                    <select name="sex" id="sex" style="width:200px;">
                        <option value="">Select</option>
                        <option value="m">Male</option>
                        <option value="f">Female</option>
                    </select>
                </span>
                <div class="subinfo">Select your sex</div>
            </div>
            <div>
                <span>
                    <label style="float:left; width:120px;" for="datepicker">Birth Date: </label>
                    <input type="text" id="datepicker" name="birthdate" style="width:200px;" />
                </span>
                <div class="subinfo">Your birthday</div>
            </div>
            <div>
                <span>
                    <label for="agree"><input type="checkbox" id="agree" name="agree" value="1" />
                    I agree with the <a href='<?php echo @URL; ?>
/a/privacy'>Privacy Policy</a> and <a href='<?php echo @URL; ?>
/a/terms'>Terms and Conditions</a>
                    </label>
                </span>
            </div>
            <div>
                <span>
                    <input type="submit" name="submit" id="button" value="Sign up" class="frmbtn"/>
                    <input type="reset" name="reset" id="reset" value="Clear" class="frmbtn"/>
                </span>
            </div>
        </fieldset>
    </form>
</div>

<?php echo '
<script type="text/javascript">
   
   $(document).ready(function(){      
       $("#frmsignup").validate({
           errorLabelContainer: "#errors",
           rules:{
               fname:{ required: true , maxlength: 50 },
               lname:{ required: true , maxlength: 50 },
               email:{ required: true, email: true , maxlength: 50},
               pass:{ required: true, minlength: 5 , maxlength: 20},
               rpass:{ required: true, minlength: 5, maxlength: 20, equalTo: "#password" },
               sex:{ required: true },
               birthdate:{ required: true },
               agree: { required: true }
           },
           messages:{
               fname: "Please enter your first name.",
               lname: "Please enter your last name.",
               email: "Please enter a valid email address.",
               pass: "Please enter a minimum 5 character password",
               rpass: {
                   required: "Your re-typed password does not match the new password you entered.",
                   minlength: "Password must be at laest 5 characters long"
               },
               sex: "Please select sex",
               birthdate: "Please select your birth date",
               agree: "You must select the checkbox to agree to our terms and conditions before you signup"
           }
       });
   });
</script>
'; ?>
