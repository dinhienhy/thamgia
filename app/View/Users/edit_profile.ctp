<?php echo $this->Html->script('jquery.charsleft-0.1.js'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#fullname").charsLeft({
            maxChars: 50,
            attachment: "after",
            charPrefix: "(Còn lại",
            charSuffix: "ký tự)"
        });
        $("#frm_profile").validationEngine();
    });
</script>
<?php if (isset($error)){?>
    <div class="error"><?php echo $error ?></div>
    <?php } ?>
<h2 class="title title-center">Sửa thông tin cá nhân</h2>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="pt-block-business-card-left pt-block-business-card-center pt-block-edit-profile">
            <div class="pt-block-business-card-from">
                <form method="post" action="<?php echo $this->Html->url(array('controller' =>'Users', 'action' => 'editProfile'))?>" enctype="multipart/form-data">
                    <div class="pt-avatar-edit">
                        <img src="<?php echo General::getUrlImage($data['User']['avatar_url']);  ?>" alt="">
                    </div>
                    <div class="pt-fileupload">
                        <span><i class="fa fa-picture-o"></i>Upload hình ảnh</span>
                        <input type="file" id="fileUpload" name="data[User][avatar]" class="validate[required]">
                    </div>
                    <ul>
                        <li>
                            <label>Họ và tên</label>
                            <input type="text" name="data[User][fullname]" title="" value="<?php echo isset($data['User']['fullname']) ? $data['User']['fullname'] : ''; ?>" class="text" placeholder="">
                        </li>
                        <li>
                            <label>Đến từ</label>
                            <div class="pt-select">
                                <i class="fa fa-angle-down"></i>
                                <select name="data[User][cityid]">
                                    <?php foreach ($cities as $city) {?>
                                    <option value="<?php echo $city['City']['id']; ?>" <?php if ($city['City']['id'] == $data['User']['cityid']) echo 'selected="selected"'; ?>>
                                        <?php echo $city['City']['name']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </li>
                        <li>
                            <label>Lĩnh vực</label>
                            <div class="pt-select">
                                <i class="fa fa-angle-down"></i>
                                <select name="data[User][careerid]">
                                    <?php foreach ($careers as $career) {?>
                                        <option value="<?php echo $career['Career']['id']; ?>" <?php if ($career['Career']['id'] == $data['User']['careerid']) echo 'selected="selected"'; ?>>
                                            <?php echo $career['Career']['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </li>
                        <li>
                            <label>Email</label>
                            <input type="text" name="data[User][email]" title="" value="<?php echo isset($data['User']['email']) ? $data['User']['email'] : ''; ?>" class="text" readonly="readonly">
                        </li>
                        <li>
                            <label>Mật khẩu</label>
                            <div class="pt-how">
                                <a href="#">Đổi mật khẩu</a>
                                <input type="text" name="is_name5" title="" value="" class="text" placeholder="Mật khẩu củ">
                                <input type="text" name="is_name5" title="" value="" class="text" placeholder="Mật khẩu mới">
                                <input type="text" name="is_name5" title="" value="" class="text" placeholder="Nhập lại mật khẩu mới">
                                <input type="submit" class="send" value="Cập nhật">
                            </div>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</div>

