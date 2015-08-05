<!-- File: /app/View/Signup/account.ctp -->
<?php
   if (empty($email))
     $email = '';
    
   $hasError = true;   
   if (empty ($error))
     $hasError = false;

?>
<script>
  $(document).ready(function(){
    $("#frm_account").validate();
    $('#acc_email').rules('add', {
        required: true,
        email: true,
        messages: {
            required: "Vui lòng nhập địa chỉ email",
            email: "Vui lòng nhập đúng định dạng email"
        }
    });
    $('#acc_password').rules('add', {
        required: true,
        minlength: 6,
        messages: {
            required: "Vui lòng nhập mật khẩu",
            minlength: "Mật khẩu phải ít nhất 6 ký tự"
        }
    });
    $('#acc-password2').rules('add', {
        required: true,
        minlength: 6,
        equalTo: "#acc_password",
        messages: {
            required: "Vui lòng nhập lại mật khẩu",
            minlength: "Mật khẩu phải ít nhất 6 ký tự",
            equalTo: "Mật khẩu không giống nhau"
        }
    });
    $('#acc_securimage').rules('add', {
        required: true,
        messages: {
            required: "Vui lòng nhập mã code"
        }
    });
    $('#acc_terms').rules('add', {
        required: true,
        messages: {
            required: "Vui lòng chấp nhận điều khoản thamgia.net"
        }
    });
    
  });
</script>
<div class="registered-users">
    <h2 class="titel">ĐĂNG KÝ THÀNH VIÊN</h2>
    <?php if ($hasError){ ?>
    <div class="error"><?php echo $error ?></div>
    <?php } ?>
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <form id="frm_account" name="frm_account" method="post" action="<?php echo $this->Html->url(array('controller' => 'signup', 'action' => 'account')); ?>" class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" name="data[Account][email]" title="" value="<?php echo $email ?>" id="acc_email" class="form-control" required="required"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Mật khẩu</label>
                    <div class="col-sm-6">
                        <input type="password" name="data[Account][password]" title="" value="" id="acc_password" class="form-control acc_password" required="required"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nhập lại mật khẩu</label>
                    <div class="col-sm-6">
                        <input type="password" name="password2" title="" value="" id="acc-password2" class="form-control" required="required"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Code</label>
                    <div class="col-sm-3">
                        <img class="capchar" src="<?php echo $this->Html->url(array('controller' => 'Signup', 'action'=>'captcha_image')); ?>" />
                    </div>
                    <div class="col-sm-3">
                        <input type="text" name="data[Account][captcha_code]" title="" value="" id="acc_securimage" class="form-control" required="required"/> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <div class="checkbox">
                            <label>
                                <input id="acc_terms" name="terms" type="checkbox" checked="checked" required="required"> Tôi đã đọc và đồng ý với  <a target="_blank" href="<?php echo $this->Html->url(array('controller' => 'Home', 'action' => 'terms' )); ?>" style="color: black; font-weight: bolder;"> các điều khoản của  thamgia.net</a>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-info">Tham Gia</button>
                        <button type="button" class="btn btn-info" onclick="$('#frm_account')[0].reset(); return false;">Nhập Lại</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</div>