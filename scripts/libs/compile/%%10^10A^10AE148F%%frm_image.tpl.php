<?php /* Smarty version 2.6.26, created on 2010-03-08 08:20:43
         compiled from frm_image.tpl */ ?>
<?php echo '
<script type="text/javascript">
   $(document).ready(function(){
       $("#errors").hide();
   });
</script>
'; ?>

<div style="width:98%;" > 
    
    <div id="errors"></div>
    <div id="reps"></div>
    
    <br />
    <div  style="background: #eee; padding: 5px;">
        <a href="<?php echo @URL; ?>
/manage/images" title="Image Management"> << Back to Image Management</a> - <?php if ($this->_tpl_vars['action'] == 'add'): ?>Add Image <?php else: ?> Edit Image <?php endif; ?>
    </div>
    <br />
    
        <form method="post" action="<?php echo @URL; ?>
/submitimage.php" id="frmart" enctype="multipart/form-data">
        <fieldset>
            <?php if ($this->_tpl_vars['action'] == 'add'): ?>
                <legend>Add New Image</legend>
            <?php else: ?>
                <legend>Edit Image</legend>
            <?php endif; ?>
            
            <input type="hidden" name="img_id" id="img_id" value="<?php echo $this->_tpl_vars['data']['id']; ?>
"/>
            <input type="hidden" name="oldpath" id="oldpath" value="<?php echo $this->_tpl_vars['data']['filepath']; ?>
"/>
            <input type="hidden" name="action" id="action" value="<?php echo $this->_tpl_vars['action']; ?>
"/>
            <div style="width: 500px;" align="center">
                <img src="<?php echo @URL; ?>
/directories/is/<?php echo $this->_tpl_vars['data']['filepath']; ?>
" style="max-width:98%;"/>
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
                    <input type="text" name="arttitle" id="arttitle" value="<?php echo $this->_tpl_vars['data']['ftitle']; ?>
" style="width:45em;" />
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
                        <?php if ($this->_tpl_vars['data']['article_id'] == $this->_tpl_vars['art']['id'] && $this->_tpl_vars['data'] != null && $this->_tpl_vars['art']['id'] != null): ?>
                            <option value='<?php echo $this->_tpl_vars['art']['id']; ?>
' selected="selected" style="color: maroon;">url :<?php echo $this->_tpl_vars['art']['url']; ?>
&nbsp;<<?php echo $this->_tpl_vars['art']['id']; ?>
></option>
                        <?php endif; ?>                        
                        <?php $_from = $this->_tpl_vars['artList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a']):
?>
                            <option value='<?php echo $this->_tpl_vars['a']['id']; ?>
'>url : <?php echo $this->_tpl_vars['a']['url']; ?>
&nbsp;<<?php echo $this->_tpl_vars['a']['id']; ?>
></option>
                        <?php endforeach; endif; unset($_from); ?>
                    </select>
                </span>
            </div>
            <div>
                <span style="float:left; width:90%;">
                    <input name="submit" id="submit" type="submit" value="Submit" class="frmbtn" />
                    <input name="reset" id="reset" type="reset" value="Reset" class="frmbtn" />
                    <a href="<?php echo @URL; ?>
/uhome">Cancel</a>
                </span>
            </div>
        </fieldset>
    </form>
</div>
<?php echo '
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
'; ?>
