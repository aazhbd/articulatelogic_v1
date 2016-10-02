{literal}
<script type="text/javascript">
   $(document).ready(function(){
       $("#errors").hide();
   });
</script>
{/literal}
{if $cont != null}
    {$cont}
{/if}
<div id="errors"></div>
<div>
<form id="expressform" method="post" action="{$smarty.const.URL}/sendexpressmail.php">
    <fieldset title="Express your need">
    <legend>Feel free to send us your query</legend>
        <div>
            <span>
                <label for="fname" style="float:left; width:150px;" >Name:</label>
                <input type="text" name="fname" id="fname" style="width:400px;" />
            </span>
        </div>
        <div>
            <span>
                <label for="email" style="float:left; width:150px;">Email:</label>
                <input type="text" name="email" id="email" style="width:400px;" />
            </span>
        </div>
        <div>
            <span>
                <label for="phone" style="float:left; width:150px;">Phone:</label>
                <input type="text" name="phone" id="phone" style="width:400px;" />
            </span>
        </div>
        <div>
            <span>
                <label for="comp" style="float:left; width:150px;">Company Name:</label>
                <input type="text" name="comp" id="comp" style="width:400px;" />
            </span>
        </div>
        <div>
            <span>
                <label for="web" style="float:left; width:150px;">Website (if applicable):</label>
                <input type="text" name="web" id="web" style="width:400px;" />
            </span>
        </div>
        <div>
            <span>
                <label for="serv" style="float:left; width:150px;">Services:</label>
                <div style="float: left;">{html_checkboxes name='serv' values=$serv_names output=$serv_names separator='<br />'}</div>
            </span>
        </div>
        <div>
            <span>
                <label for="oview" style="float:left; width:150px;">Quick overview of your project:</label>
                <textarea type="text" name="oview" id="oview" style="width:400px; height: 100px;" ></textarea>
            </span>
        </div>
        <div>
            <span>
                <label for="budget" style="float:left; width:150px;">Budget:</label>
                <select name="budget" id="budget" style="width: 200px;">
                    <option value="">Select</option>
                    {foreach item=i from=$bgt_range}
                        <option value="{$i}">{$i}</option>
                    {/foreach}                    
                </select>
            </span>
        </div>
        <div>
            <span>
                <label for="time" style="float:left; width:150px;">How soon are you ready to start? </label>
                <select name="time" id="time" style="width: 200px;">
                    <option value="">Select</option>
                    {foreach item=i from=$time_range}
                        <option value="{$i}">{$i}</option>
                    {/foreach}
                </select>
            </span>
        </div>        
        <div>
            <span>
                <input type="submit" name="submit" id="button" value="Submit" class="frmbtn"/>
                <input type="reset" name="reset" id="button" value="Reset" class="frmbtn"/>
            </span>
        </div>
    </fieldset>
</form>
</div>
{literal}
<script language="javascript">
   
   $(document).ready(function(){       
       $("#expressform").validate({
           errorLabelContainer: "#errors",
           rules:{
               fname:   { required: true, maxlength: 100},
               email:   { required: true, email: true, maxlength: 100 },
               phone:   { required: true, digits: true, maxlength: 20 },
               comp:    { required:true, maxlength: 100 },
               web:     { url: true , maxlength: 250},
               serv:    { required: true},
               oview:   { required: true, maxlength: 2500}
           },
           messages:{
               fname: 
               {
                    required: "Please enter your first name."
               },
               email: 
               {
                   required: "Please type an email address to contact you.",
                   email: "Please enter a valid email address.",
                   maxlength: "The email address you typed is too long. Please provide any email address within 100 characters"
               },
               phone: 
               {
                   required: "Please enter your phone number.",
                   digits: "Please type digits only for phone numbers",
                   maxlength: "Please type phone numbers of length less than or equal to 20 digits"
               },
               comp: 
               {
                   required: "Please type the name of your company",
                   maxlength: "The company name you provided is too long. Please shorten the name of your company to less than or equal to 100 characters"
               },
               web:
               {
                   url: "Please type a valid url",
                   maxlength: "The url you typed is too long. Please type url of length less than or equal to 250 charcters"
               },
               serv:
               {
                   required: "Please select atleast one service that you wish articulatelogic to provide you"
               },
               oview:
               {
                   required: "Please write an overview of your needs or request.",
                   maxlength: "Please shorten your text of overview to less than or equal to 2500 characters. To write in more details about your needs please send us an email with all your details."
               }
           }
       });
   });
</script>
{/literal}