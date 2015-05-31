<?php 
    $data = $this->requestAction(array('controller' => 'Users', 'action' => 'getUser', $user_id));
?>
<?php $userInformation = $this->requestAction(array('controller' => 'Users', 'action' => 'getUserInformation', $user_id)); ?>
<div class="pt-notification-user">
	<a href="<?php echo $logged_in ? '#send-messages' : '#login' ?>" class="pt-message"><i class="fa fa-envelope-o"></i></a>
    <?php if ($owner){ ?>
        <a title="Chỉnh sửa thông tin" href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'editProfile')); ?>" class="pt-edit-profile"><i class="fa fa-pencil-square"></i></i></a>
        <a title="Thay đổi mật khẩu" href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'changePassword')); ?>" class="pt-change-password"><i class="fa fa-pencil-square-o"></i></i></a>
    <?php } ?>
	<img src="<?php echo General::getUrlImage($data['User']['avatar_url']); ?>" alt="">
	<h3><?php echo $data['User']['fullname']; ?></h3>
	<span class="style">Đã đăng <?php echo $userInformation['count_added_events']; ?> sự kiện và Tham gia <?php echo $userInformation['count_participated_events']; ?> sự kiện</span>
	<strong>Đến từ:</strong>
	<span><?php echo $data['City']['name']; ?></span>
	<strong>Nghành nghề:</strong>
	<span><?php echo $data['Career']['name']; ?></span>
</div>
<div class="popup-exchange">
    <div class="pt-send-messages" id="send-messages">
      <h3 class="title"><i class="fa fa-paper-plane"></i> Gửi tin nhắn đến <?php echo $data['User']['fullname']; ?></h3>
        <form onsubmit="return validateMessage();" action="<?php echo $this->Html->url(array('controller'=>'Messages', 'action' => 'sendMessage')) ?>" method="post">
          <input id="receiver" name="data[Message][receiver]" type="hidden" value="<?php echo $user_id; ?>" />
          <textarea id="message" name="data[Message][content]" cols="50" rows="10" class="validate[required]" placeholder="Bạn điền nội dung tại đây ..."></textarea>
          <input type="submit" class="send" value="Lưu ghi chú">
        </form>
    </div>
  </div>



<script type="text/javascript">
    function composeMessageBox(defalutReceiver){
        $.ajax({
           type:"GET",
           url:'<?php echo $this->Html->url(array('controller' => 'Messages', 'action' => 'getComposeMessageBox'))?>/' + defalutReceiver,
           success : function(data) {
                $('#content-modal').empty().html(data);
                $("#click-modal").fancybox({modal:false}).trigger('click');
           },
           error : function() {
               alert('error load compose message box');
           },
        });        
    }
</script>