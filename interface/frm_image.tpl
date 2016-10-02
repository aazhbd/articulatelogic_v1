{literal}
<script type="text/javascript">
   $(document).ready(function(){
       $("#errors").hide();
   });
</script>
{/literal}
<div style="width:98%;" > 
    
    <div id="errors"></div>
    <div id="reps"></div>
    
    <br />
    <div  style="background: #eee; padding: 5px;">
        <a href="{$smarty.const.URL}/manage/images" title="Image Management"> << Back to Image Management</a> - {if $action == "add"}Add Image {else} Edit Image {/if}
    </div>
    <br />
    
        <form method="post" action="{$smarty.const.URL}/submitimage.php" id="frmart" enctype="multipart/form-data">
        <fieldset>
            {if $action == "add"}
                <legend>Add New Image</legend>
            {else}
                <legend>Edit Image</legend>
            {/if}
            
            <input type="hidden" name="img_id" id="img_id" value="{$data.id}"/>
            <input type="hidden" name="oldpath" id="oldpath" value="{$data.filepath}"/>
            <input type="hidden" name="action" id="action" value="{$action}"/>
            <div style="width: 500px;" align="center">
                <img src="{$smarty.const.URL}/directories/is/{$data.filepath}" style="max-width:98%;"/>
            </div>
            <div>
                <span>
                    <div style="float:left; width:80px;">
                        <label for="ifile">Image:</label>
                    </div>
                    <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
                    <input type="file" name="ifile" id="ifile" value="" style="width:45em;"/>
                </span>
                <div class="subinfo">Upload image files for your article only within size limit 2 MB</div>
            </div>
            <div>
                <span>
                    <div style="float:left; width:80px;">
                        <label for="arttitle">Title:</label>
                    </div>
                    <input type="text" name="arttitle" id="arttitle" value="{$data.ftitle}" style="width:45em;" />
                    <div class="subinfo">Maximum 100 characters</div>
                </span>
            </div>
            <div>
                <span>
                    <div style="float:left; width:80px;">
                        <label for="art_id">Articles:</label>
                    </div>
                    <select name='art_id' id='art_id'>
                        <option value=''> Select </option>
                        {if $data.article_id == $art.id && $data != null && $art.id != null}
                            <option value='{$art.id}' selected="selected" style="color: maroon;">url :{$art.url}&nbsp;<{$art.id}></option>
                        {/if}                        
                        {foreach item=a from=$artList}
                            <option value='{$a.id}'>url : {$a.url}&nbsp;<{$a.id}></option>
                        {/foreach}
                    </select>
                </span>
            </div>
            <div>
                <span style="float:left; width:90%;">
                    <input name="submit" id="submit" type="submit" value="Submit" class="frmbtn" />
                    <input name="reset" id="reset" type="reset" value="Reset" class="frmbtn" />
                    <a href="{$smarty.const.URL}/uhome">Cancel</a>
                </span>
            </div>
        </fieldset>
    </form>
</div>
{literal}
<script type="text/javascript">
   $(document).ready(function(){
        
        $("#errors").hide();
        $("#reps").hide();
       $("#frmart").validate({
           errorLabelContainer: "#errors",
           wrapper: "h4",
           rules:{
               art_id: { required: true },
               arttitle: { required: true, maxlength: 100, minlength: 1 },
               ifile: { required: true, accept: "jpg|png|gif" }
           },
           messages:{
               art_id: { required: "Select a article for this image" },
               arttitle: { 
                        required: "Please write the title for this article",
                        maxlength: "The title should be within 100 characters",
                        minlength: "Please write the title for this article"
               },
               ifile:{
                    required: "Please select a images to upload",
                    accept: "Please upload images only with .jpg, .png and .gif extensions"
               }               
           }
       });
   });
</script>
{/literal}
