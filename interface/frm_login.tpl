
<div>
    <form action="loginpost.php" method="post" id ="frmlogin">
        <fieldset> 
        <legend>User Login</legend>
            <div>
                <span>
                    <label for="email" style="float:left; width:80px;">eMail:</label>
                    <input type="text" name="email" class="log" id="email" />
                </span>
            </div>
            <div>
                <span>
                    <label for="pass" style="float:left; width:80px;">Password:</label>
                    <input type="password" name="pass" class="log" id="pass"/>
                </span>
            </div>
            <div>
                <span>
                    <input type="submit" class="frmbtn" name="submit" value="Login" />
                    <label><input type="checkbox" name="remember[]" value="1"/> Remember Me.</label>
                </span>
            </div>
            <div>
                <span>
                    Not a member yet? <a href="{$smarty.const.URL}/signup">Sign Up</a>
                </span>
            </div>
        </fieldset>
    </form>
</div>