<div class="form-login">
    <h2 class="titel">Đăng nhập</h2>
    <form class="form-horizontal" method="post" action="<?php echo $this->Html->url(array("controller" => "users", "action" => "login")); ?>">
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-4">
              <input type="email" class="form-control" id="email" placeholder="Nhập địa chỉ Email" name="data[User][email]" required="required">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Mật khẩu</label>
            <div class="col-sm-4">
              <input type="password" class="form-control" id="password" name="data[User][password]" required="required">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
              <button type="submit" class="btn btn-info">Đăng Nhập</button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
              <a href="javascript:" onclick="loginFacebook()" class="facebook"><i class="fa fa-facebook"></i> Đăng nhập qua facebook</a>
            </div>
        </div>
    </form>
</div>