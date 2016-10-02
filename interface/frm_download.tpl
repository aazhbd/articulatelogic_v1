
<div style="width:98%;">

    <div id="errors"></div>
    <div id="reps"></div>
    
    <div  style="background: #eee; padding: 5px;">
        <a href="{$smarty.const.URL}/manage/downloads" title="Download Management"> << Back to Download Management</a> - {if $action == "add"}Add Downloads {else} Edit Downloads {/if}
    </div>
    
    <br />
    
    {if $action == "add"}
        <form method="post" action="{$smarty.const.URL}/adddownload.php" id="frmart" enctype="multipart/form-data">
    {elseif $action == "edit"}
        <form method="post" action="{$smarty.const.URL}/editdownload.php" id="frmart" enctype="multipart/form-data">
    {/if}
        <fieldset>
            {if $action == "add"}
                <legend>Add New Article</legend>
            {elseif $action == "edit"}
                <legend>Edit Article</legend>
            {/if}
            <input type="hidden" name="load_id" id="load_id" value="{$dl.id}"/>
            <input type="hidden" name="imgName" id="imgName" value="{$dl.ipath}"/>
            <input type="hidden" name="action" id="action" value="{$action}"/>
            <div>
                <span>
                    <div style="float:left; width:100px;">
                        <label for="cat">Category:</label>
                    </div>
                    <select name='cat' id='cat'>
                        <option value=''>Select</option>
                        {foreach item=cat from=$catList}
                            {if $dl.category_id == $cat.id}
                                <option value='{$cat.id}' selected="selected">{$cat.cname}</option>
                            {else}
                                <option value='{$cat.id}'>{$cat.cname}</option>
                            {/if}
                        {/foreach}
                    </select>
                </span>
            </div>
            <div>
                <span>
                    <div style="float:left; width:100px;">
                        <label for="dltitle">Title:</label>
                    </div>
                    <input type="text" name="dltitle" id="dltitle" value="{$dl.title}" style="width:45em;" />
                </span>
                <div class="subinfo">Maximum 100 characters</div>
            </div>
            <div>
                <span>
                    <div style="float:left; width:100px;">
                        <label for="subtitle">Sub-title:</label>
                    </div>
                    <input type="text" name="subtitle" id="subtitle" value="{$dl.sub_title}" style="width:45em;"/>
                </span>
                <div class="subinfo">Maximum 200 characters</div> 
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
            {if $action == 'edit'}
                <div>
                    <span>
                        <img src="{$smarty.const.URL}/directories/is/{$dl.ipath}" alt="Download image" width="90%" align="middle" />
                    </span>
                </div>
            {/if}
            <div>
                <span>
                    <div style="float:left; width:100px;">
                        <label for="ifile">Screenshot:</label>
                    </div>
                    <input type="hidden" name="MAX_FILE_SIZE2" value="2097152" />
                    <input type="file" name="ifile" id="ifile" value="" style="width:45em;"/>
                </span>
                <div class="subinfo">Upload screenshot image files for your software only within size limit 2 MB</div>
            </div>
            <div>
                <span>
                    <label for="details">Details:</label>
                    <br />
                    <textarea id="details" name="details" style="height: 60px; width: 61em;">{$dl.details}</textarea>
                </span>
                <div class="subinfo">Maximum 2500 characters</div>
            </div>
            <div>
                <span>
                    <label for="short_details">Short Details:</label>
                    <textarea id="short_details" name="short_details" style="height: 60px; width: 61em;" >{$dl.short}</textarea>
                    <div class="subinfo">Maximum 500 characters</div>
                </span>
            </div>
            <div>
                <span>
                    <input type="submit" value="Upload" class="frmbtn" />
                    <input type="reset" value="Reset" class="frmbtn" />
                    <a href="{$smarty.const.URL}/home">Cancel</a>
                </span>
            </div>
            <div>
                <span>
                    <label for="keywords">Keywords: </label><br />
                    <textarea id="keywords" name="keywords" style="width:61em; height: 60px;">{$dl.meta_tags}</textarea>
                </span>
                <div class="subinfo">Maximum 200 characters. Seperate your keywords with comma (,) to make it available to the search engines</div>
            </div>
            <div>
                <span>
                    <label for="remarks">Remarks: </label><br />
                    <textarea id="remarks" name="remarks" style="width:61em; height: 60px;">{$dl.remarks}</textarea>
                </span>
                <div class="subinfo">Maximum 500 characters</div>
            </div>
        </fieldset>
    </form>
</div>

{literal}
<script type="text/javascript">
$(document).ready(function()
{
    $("#errors").hide();
    $("#reps").hide();
    
    $("#frmart").validate(
    {
        submitHandler: function(form) {
            $(form).ajaxSubmit({
                success: function(response, status) {
                    $("#reps").html($("#errors", response).html());
                    $("#reps").append($("#reports", response).html());
                    $("#reps").show();
                    $("input[type='submit']", form).attr('disabled', '');
                    $("input[type='submit']", form).attr('value', 'Upload');
                },
                beforeSubmit: function() {
                    $("input[type='submit']", form).attr('disabled', 'disabled');
                    $("input[type='submit']", form).attr('value', 'Please wait...');
                }
            });
            return false;
        },
        errorLabelContainer: "#errors",
        wrapper: "p",
        rules:{
            cat: { required: true },
            dltitle: { required: true, maxlength: 100 },
            subtitle: { maxlength: 200 },
            details: { required: true, maxlength: 2500},
            short_details: { required: true, maxlength: 500 },
            keywords: { maxlength: 200},
            remarks: { maxlength: 200 },
            ufile: { required: true, accept: "zip|tar|gz|7z|rar|exe|pdf|txt|doc" },
            ifile: {  accept: "jpg|gif|png" }
        },
        messages:{
            cat: {
                required: "Please select the category for this software."
            },
            dltitle:{
                required: "Please write the title for this software.",
                maxlength: "The title should be within 100 characters"                
            },
            sub_title: { 
                maxlength: "The subtitle should be within 200 characters"
            },
            details: { 
                required: "Please write the details for this software.",
                maxlength: "The details should be within 2500 characters"
            },
            short_details: { 
                required: "Please write the short details for this software.",
                maxlength: "The details should be within 500 characters"
            },            
            remarks: {
                maxlength: "The remarks should be within 500 characters"
            },
            keywords: { 
                maxlength: "The keywords should be within 200 characters" 
            },
            ufile:{
                    required: "Please select a file to upload",
                    accept: "Please upload files only with .zip .tar .gz .7z .rar .exe .pdf .txt .doc extensions"
            },
            ifile:{
                    accept: "Please upload files only with .gif .jpg or .png extensions"
            }            
        }
    });
});
</script>
{/literal}