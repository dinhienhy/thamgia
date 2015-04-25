<div class="pt-posts">
	<h3 class="title">Gửi sự kiện này đến bạn bè</h3>
	<div class="pt-list">
		<a href="#" <?php   echo $logged_in ? 'onclick="return requestYahoo();"' : 'onclick="login(); return false;"' ?>>
            <img src="<?php echo $this->Html->url('/'); ?>img/images/g1.jpg" alt="">
        </a>
		<a href="#" <?php   echo $logged_in ? 'onclick="return requestGmail();"' : 'onclick="login(); return false;"' ?>>
            <img src="<?php echo $this->Html->url('/'); ?>img/images/g2.jpg" alt="">
        </a>
		<a href="javascript:alert('Xin vui lòng liên hệ 0985 684 772 để được tư vấn thông tin về chức năng SMS Marketing'); return false;">
            <img src="<?php echo $this->Html->url('/'); ?>img/images/g3.jpg" alt="">
        </a>
	</div>
	<h3 class="title">Lưu sự kiện vào điện thoại</h3>
	<div class="code">
        <?php echo $this->QrCode->text($event_address . '-' . $event_title); ?>
	</div>
</div>
<script type="text/javascript">
    function requestYahoo(){
        var openWin = window.open('<?php echo $this->Html->url(array('controller' => 'Contacts', 'action' => 'requestYahooContacts', $event_id)); ?>', '_blank', 'toolbar=0,scrollbars=1,location=0,status=1,menubar=0,resizable=1,width=500,height=500');  
        return false;    
     }
     
     function requestGmail(){
         var openWin = window.open('<?php echo $this->Html->url(array('controller' => 'Contacts', 'action' => 'requestGmailContacts', $event_id)); ?>', '_blank', 'toolbar=0,scrollbars=1,location=0,status=1,menubar=0,resizable=1,width=500,height=500');  
         return false;
     }
</script>