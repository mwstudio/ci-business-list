<!-- css -->
<style>
    select.sub-category,
    input.sub-location{
        display: none;
    }
</style>
<!-- end css -->
    
    <div class="row">
        <div class="span12">
            <h1>Business details and contact information</h1>
                        
            <?php if(@$error): ?>
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <?php echo $error; ?>
            </div>
            <?php endif; ?>
    
            <div class="row">
                <form class="form-horizontal" method="post" action="">
                <div class="span6">
                    <div class="well">
                    <h2>Categories</h2>
                        <?php $cat = 3?>
                        <?php for($i=1;$i<=$cat;$i++):?>
                            <div class="control-group">
                                <label class="control-label" for="inputFullName">Category <?= $i?></label>
                                <div class="controls">
                                    <select name="category_<?= $i?>" id="category_<?= $i?>" class="category">
                                        <option value="">Select category <?= $i?></option>
                                        <option value="cat 1">Cat 1</option>
                                        <option value="cat 2">Cat 2</option>
                                    </select>
                                    <select name="sub_category_<?= $i?>" id="sub_category_<?= $i?>" class="sub-category">
                                        <option value="">Select sub category <?= $i?></option>
                                        <option value="sub cat 1">sub cat 1</option>
                                        <option value="sub cat 2">sub cat 2</option>
                                    </select>
                                </div>
                            </div>
                        <?php endfor;?>
                    </div>
                </div>

                <div class="span6">
                    <div class="well">
                        <h2>Business details</h2>
                            
                                <div class="control-group">
                                    <label class="control-label" for="company_name">Company Name(*)</label>
                                    <div class="controls">
                                        <input type="text" id="company_name" value="<?php echo set_value('company_name'); ?>" name="company_name">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="description">Description(*) </label>
                                    <div class="controls">
                                        <textarea type="text" id="description" name="description"><?php echo set_value('description'); ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label" for="logo">Company Logo</label>
                                    <div class="controls">
                                        <input type="file" id="logo" value="<?php echo set_value('logo'); ?>" name="logo">
                                        <em>http://<strong>username</strong>.site.com</em>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label" for="website">Website</label>
                                    <div class="controls">
                                        <input type="text" id="website" value="<?php echo set_value('website'); ?>" name="website">
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label" for="phone">Phone</label>
                                    <div class="controls">
                                        <input type="text" id="phone" value="<?php echo set_value('phone'); ?>" name="phone">
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label" for="location">Location</label>
                                    <div class="controls">
                                        <input type="text" id="location" value="<?php echo set_value('location'); ?>" name="location" class="location">
                                        <input type="text" id="sub_location" value="<?php echo set_value('sub_location'); ?>" name="sub_location" class="sub-location">
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label" for="street">Street Address</label>
                                    <div class="controls">
                                        <input type="text" id="street" value="<?php echo set_value('street'); ?>" name="street">
                                    </div>
                                </div>
                                
                                <!-- <div class="control-group">
                                    <label class="control-label" for="logo">Add map</label>
                                    <div class="controls">
                                        <input type="text" id="logo" value="<?php echo set_value('logo'); ?>" name="logo">
                                    </div>
                                </div> -->
                                
                                <div class="control-group">
                                    <label class="control-label" for="email">Email(*)</label>
                                    <div class="controls">
                                        <input type="text" id="email" value="<?php echo set_value('email'); ?>" name="email">
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label" for="contact_person">Contact Person(*)</label>
                                    <div class="controls">
                                        <input type="text" id="contact_person" value="<?php echo set_value('contact_person'); ?>" name="contact_person">
                                    </div>
                                </div>
                                

                                <div class="control-group">
                                    
                                    <div class="pull-right">
                                        <!-- <?= $this->recaptcha->html();?> -->
                                    </div>
                                </div>
                                
                                
                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit"  class="btn">Sign up</button>
                                    </div>
                                </div>
                            
                        </div>
                </div>
                </form>
            </div>

        </div>
    </div>


<!-- script -->
<script>
$(document).ready(function() {
    $('select.category').change(function() {
        if($(this).val() != ''){
            $(this).parent().find('select.sub-category').show();
        }
        else{
            $(this).parent().find('select.sub-category').hide();   
        }
    });
    $('input.location').blur(function() {
        if($(this).val() != ''){
            $(this).parent().find('input.sub-location').show();
        }
        else{
            $(this).parent().find('input.sub-location').hide();   
        }
    });

});
</script>
<!-- end script -->