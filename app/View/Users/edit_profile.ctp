<script type="text/javascript">
    function changePassword(){
        var current_pass = $('#current_password').val();
        var pass = $('#password_new').val();
        var pass2 = $('#password_new2').val();
        if(current_pass == ""){
            alert('Vui lòng nhập mật khẩu cũ');
        }
        else if(pass == ""){
            alert('Vui lòng nhập mật khẩu mới');
        }
        else if(pass2 == ""){
            alert('Vui lòng nhập lại mật khẩu mới');
        }
        else if(pass != pass2){
            alert('Vui lòng nhập lại mật khẩu mới');
        }
        else{
            $.ajax({
               type:"GET",
               async:true,
               url:'<?php echo $this->Html->url(array("controller" => "users", "action" => "changePassword"))?>' + '/' + current_pass  + '/' + pass,
               dataType: "json",
               success : function(data) {
                    alert(data.Message);
                    $('#current_password').val('');
                    $('#password_new').val('');
                    $('#password_new2').val('');
               },
               error : function() {
                   alert('Lỗi thay đổi mật khẩu!');
               },
           });
        }
    }
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
                            <input type="text" name="data[User][fullname]" title="" value="<?php echo isset($data['User']['fullname']) ? $data['User']['fullname'] : ''; ?>" class="text" placeholder="" required>
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
                                <a onclick="changePassword()" href="javascript:void(0);">Đổi mật khẩu</a>
                                <input id="current_password" type="password" name="data[User][current_password]" title="" value="" class="text" placeholder="Mật khẩu cũ" >
                                <input id="password_new" type="password" name="data[User][password]" title="" value="" class="text" placeholder="Mật khẩu mới">
                                <input id="password_new2" type="password" name="data[User][password2]" title="" value="" class="text" placeholder="Nhập lại mật khẩu mới">
                                <input type="submit" class="send" value="Cập nhật">
                            </div>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</div>

