{literal}
<script type="text/javascript">
   $(document).ready(function(){
       $("#reports").hide();
   });
</script>
{/literal}
<div style="width:98%;" > 

    <div id="reports"></div>
    
    <br />
    <div  style="background: #eee; padding: 5px;">
        <a href="{$smarty.const.URL}/manage/files" title="File Management"> << Back to File Management</a> - {if $action == "add"}Add File {else} Edit File {/if}
    </div>
    <br />
    
    <form method="post" action="{$smarty.const.URL}/submitfile.php" id="frmart" enctype="multipart/form-data">
        <fieldset>
            {if $action == "add"}
                <legend>Add New File</legend>
            {else}
                <legend>Edit File</legend>
            {/if}
            
            <input type="hidden" name="art_id" id="art_id" value="{$data.id}"/>
            <input type="hidden" name="action" id="action" value="{$action}"/>
            
            <div>
                <span>
                    <div style="float:left; width:100px;">
                        <label for="cat">Category:</label>
                    </div>
                    <select name='cat' id='cat'>
                        <option value=''> Select </option>
                        {foreach item=cat from=$catList}
                            {if $data.category_id == $cat.id}
                                <option value='{$cat.id}' selected="selected">{$cat.catname}</option>
                            {else}
                                <option value='{$cat.id}'> {$cat.catname} </option>
                            {/if}
                        {/foreach}
                    </select>
                </span>
            </div>
            {if $action == 'add'}
                <div>
                    <span>
                        <div style="float:left; width:100px;">
                            <label for="ufile">File:</label>
                        </div>
                        <input type="hidden" name="MAX_FILE_SIZE" value="20971520" />
                        <input type="file" name="ufile" id="ufile" value="" style="width:45em;"/>
                    </span>
                    <div class="subinfo">Upload files only with size limit 20 MB</div>
                </div>
            {/if}
            <div>
                <span>
                    <div style="float:left; width:100px;">
                        <label for="arttitle">Title:</label>
                    </div>
                    <input type="text" name="arttitle" id="arttitle" value="{$data.ftitle}" style="width:45em;" />
                    <div class="subinfo">Maximum 100 characters</div>
                </span>
            </div>
            
            <div>
                <span style="float:left; width:90%;">
                    <input type="submit" value="Submit" class="frmbtn" />
                    <input name="reset" id="reset" type="reset" value="Reset" class="frmbtn" />
                    <a href="{$smarty.const.URL}/home">Cancel</a>
                </span>
            </div>

            <div>
                <span>
                    <div><label  style="float:left; width:100px;" for="arturl">File URL:</label></div>
                    <p>http://articulatelogic.com/f/<input type="text" name="arturl" id="arturl" value="{$data.url}" style="width:410px;" />&nbsp;<strong><a href="#" id="checkavail" >Check Availability</a></strong></p>
                    <div class="subinfo">Maximum 250 characters</div>
                    <div style="width:500px;color:#F93; font-size:larger; font-stretch:semi-expanded; font-weight:bolder;" id ="availresponse"></div><br/>
                </span>
            </div>
            <div>
                <span style="float:left; width: 50%;" >
                    <label for="keywords">Keywords: </label><br />
                    <textarea id="keywords" name="keywords" style="width:28em;" rows="8" >{$data.meta_tags}</textarea>
                    <div class="subinfo">Maximum 200 characters. Seperate your keywords with comma (,) to make it available to the search engines</div>
                </span>
                <span style="float:left; width: 40%;">
                    <label for="remarks">Remarks: </label><br />
                    <textarea id="remarks" name="remarks" style="width:28em;" rows="8" >{$data.remarks}</textarea>
                    <div class="subinfo">Maximum 500 characters</div>
                </span>
            </div>
        </fieldset>
    </form>
</div>
{literal}
<script type="text/javascript">
   $(document).ready(function(){
        $("#reports").hide();
        $("#availresponse").hide();
        
        $('input#arturl').keyup(function () {
          var n = $(this).val();
          var murl = n.replace(/[\s/\:*?"><|%()$#;',+=@^!&`]/g, '_');
          $('input#arturl').val(murl);
        }); 
        
        $('#checkavail').click(function(){
            var url = $('#arturl').val();
            var typ = 'art';
            var dataString = 'name='+ url + 'type='+typ;
            var aurl = site.url + "/zproc.php";
            
            if(url.length > 0)
            {
                $.ajax({
                    type: "POST",
                    url: aurl,
                    data: dataString,
                    cache: false,
                    dataType: "html",
                    success: function(response){
                        $("#availresponse").show();
                        $("#availresponse").fadeIn(400).html('Your selected url is ' + response);
                    }
                });
            }
            return false;
        });
        
       $("#frmart").validate({
            submitHandler: function(form) {
                $(form).ajaxSubmit({
                    success: function(response, status) {
                        $("#reports").html($("#errors", response).html());
                        $("#reports").append($("#reports", response).html());
                        $("#reports").show();
                        $("input[type='submit']", form).attr('disabled', '');
                        $("input[type='submit']", form).attr('value', 'Submit');
                        
                        
                    },
                    beforeSubmit: function() {
                        //$("input[type='submit']", form).attr('disabled', 'disabled');
                        //$("input[type='submit']", form).attr('value', 'Please wait...');
                    }
                });
                return false;
            },
           errorLabelContainer: "#reports",
           wrapper: "h4",
           rules:{
               cat: { required: true },
               arttitle: { required: true, maxlength: 100, minlength: 1 },
               remarks: { maxlength: 200 },
               keywords: { maxlength: 200},
               arturl: { maxlength: 250},
               ufile: { required: true, accept: "zip|tar|gz|7z|rar|exe|pdf|txt|doc|docx|jar" }
           },
           messages:{
               cat: { required: "Select a category for this file" },
               arttitle: { 
                        required: "Please write the title for this file",
                        maxlength: "The title should be within 100 characters",
                        minlength: "Please write the title for this file"
               },
               remarks: {
                        maxlength: "The remarks should be within 200 characters"
               },
               keywords: { 
                        maxlength: "The keywords should be within 200 characters" 
               },
               arturl: {
                        maxlength: "The url should be within 250 characters"
               },
               ufile:{
                    required: "Please select a file to upload",
                    accept: "Please upload files only with .zip, .tar, .gz, .7z, .rar, .exe, .pdf, .txt, .doc, .docx or .jar extensions"
               }               
           }
       });
   });
</script>
{/literal}