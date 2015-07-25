<div class="forgot-password">
    <h2 class="titel">Quên mật khẩu</h2>
    <div class="info">
        Vui lòng nhập địa chỉ email bạn đã đăng ký tại thamgia.net. Hệ thống sẽ gửi một email xác nhận yêu cầu Thiết lập lại mật khẩu vào email này
    </div>
    <form class="form-horizontal" method="post" action="<?php echo $this->Html->url(array("controller" => "users", "action" => "forgotPassword")) ?>">
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-4">
              <input type="email" class="form-control" id="email" placeholder="Nhập địa chỉ Email" name="data[User][email]" required="required">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
              <button type="submit" class="btn btn-success">Nhận mật khẩu</button>
            </div>
        </div>
    </form>
</div>

