<?php 
    echo $this->Html->script('jquery-ui-timepicker-addon.js');
    echo $this->Html->script('jquery-ui-sliderAccess.js');
    echo $this->Html->script('validationEngine');
    echo $this->Html->script('validationEngine-en');
    
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#frm_business_card").validationEngine();   
    })
</script>
<?php if (isset($error)){?>
    <h4 class="alert_error"><?php echo $error ?></h4>
<?php } ?>
<article class="module width_full">
    <header><h3>Chỉnh sửa danh thiếp</h3></header>
        <div class="module_content">
            <form id="frm_business_card" name="frm_business_card" method="post" action="<?php echo $this->Html->url(array('controller' => 'Admin', 'action' =>'editCard', $data['id'],$is_vip)) ?>" class="login-subscription" enctype="multipart/form-data">
                <fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
                    <label>Họ và tên *</label>
                    <input type="text" style="width:92%;"  value="<?php echo isset($data['name']) ? $data['name'] : '' ?>" id="name" name="data[BusinessCard][name]" class="validate[required]" />
                </fieldset>
                <fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
                    <label>email *</label>
                    <input type="text" class="validate[required]" style="width:92%;" value="<?php echo isset($data['email']) ? $data['email'] : '' ?>" id="email" name="data[BusinessCard][email]"  />
                    <input type="hidden" name="data[BusinessCard][id]" value="<?php echo $data['id']; ?>" />
                </fieldset>
                <fieldset style="width:48%; float:left;  margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
                    <label>Ngành nghề 1 *</label>
                    <select name="data[BusinessCard][careerid]">
                        <?php foreach($careers as $career){ ?>
                        <option <?php if ($career['Career']['id'] == $data['careerid']) echo 'selected="selected"';  ?>  value="<?php echo $career['Career']['id']; ?>" > <?php echo $career['Career']['name'];  ?></option>
                        <?php } ?>
                    </select>
                </fieldset>
                
                <fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
                    <label>Ngành nghề 2</label>
                    <select name="data[BusinessCard][careerid2]">
                        <option>Chọn ngành nghề 2</option>
                        <?php foreach($careers as $career){ ?>
                        <option <?php if ($career['Career']['id'] == $data['careerid2']) echo 'selected="selected"';  ?>  value="<?php echo $career['Career']['id']; ?>" > <?php echo $career['Career']['name'];  ?></option>
                        <?php } ?>
                    </select>
                </fieldset>
                <fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
                    <label>Tên công ty *</label>
                    <input type="text" style="width:92%;"  value="<?php echo isset($data['name_company']) ? $data['name_company'] : '' ?>" id="name_company" name="data[BusinessCard][name_company]" class="validate[required]" />
                </fieldset>
                <fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
                    <label>Chức danh *</label>
                    <input type="text" style="width:92%;" value="<?php echo isset($data['position']) ? $data['position'] : '' ?>" id="position" name="data[BusinessCard][position]" class="validate[required]" />
                </fieldset>
                <fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
                    <label>Loại danh thiếp *</label>
                    <select name="data[BusinessCard][type_card_id]">
                        <?php foreach($typeCards as $typeCard){ ?>
                        <option <?php if ($typeCard['TypeCard']['id'] == $data['type_card_id']) echo 'selected="selected"';  ?>  value="<?php echo $typeCard['TypeCard']['id']; ?>" > <?php echo $typeCard['TypeCard']['name'];  ?></option>
                        <?php } ?>
                    </select>
                </fieldset>
                <fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
                    <label>Số điện thoại *</label>
                    <input type="text" style="width:92%;" value="<?php echo isset($data['mobile']) ? $data['mobile'] : '' ?>" id="mobile" name="data[BusinessCard][mobile]" class="validate[required]" />
                </fieldset>
                <fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
                    <label>Địa chỉ *</label>
                    <input type="text" style="width:92%;"  value="<?php echo isset($data['address']) ? $data['address'] : '' ?>" id="address" name="data[BusinessCard][address]" class="validate[required]" />
                </fieldset>
                <fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
                    <label>Website</label>
                    <input type="text" style="width:92%;" value="<?php echo isset($data['website']) ? $data['website'] : '' ?>" id="website" name="data[BusinessCard][website]"  />
                </fieldset>
                <fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
                    <label>Facebook *</label>
                    <input type="text" style="width:92%;"  value="<?php echo isset($data['facebook']) ? $data['facebook'] : '' ?>" id="facebook" name="data[BusinessCard][facebook]" class="validate[required]" />
                </fieldset>
                <fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
                    <label>Linked In</label>
                    <input type="text" style="width:92%;" value="<?php echo isset($data['linkedin']) ? $data['linkedin'] : '' ?>" id="linkedin" name="data[BusinessCard][linkedin]" />
                </fieldset>
                
                <fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
                    <label>Mẫu danh thiếp *</label>
                    <select name="data[BusinessCard][template_id]">
                        <?php foreach($templates as $template){ ?>
                        <option <?php if ($template['TemplateCard']['id'] == $data['template_id']) echo 'selected="selected"';  ?>  value="<?php echo $template['TemplateCard']['id']; ?>" > <?php echo $template['TemplateCard']['name'];  ?></option>
                        <?php } ?>
                    </select>
                </fieldset>                
                <div class="clear"></div>

                <fieldset> <!-- to make two field float next to one another, adjust values accordingly -->
                    <label>Banner</label>
                    <input  style="width:92%;"  type="file" name="data[BusinessCard][avatar]"  id="FileImage" />
                </fieldset>
                <div class="clear"></div>
                <input type="submit" class="alt_btn" value="Update">
                <div class="clear"></div>
            </form>
        </div>
    <footer>
        <div class="submit_link">
        </div>
    </footer>
</article>