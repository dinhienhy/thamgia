<div class="pt-posts">
	<h3 class="title">Gửi sự kiện này đến bạn bè</h3>
	<div class="pt-list">
		<a <?php   echo $logged_in ? 'onclick="return requestYahoo();" href="#"' : 'href="#login" class="link-login"'; ?>>
            <img src="<?php echo $this->Html->url('/'); ?>img/images/g1.jpg" alt="">
        </a>
		<a <?php   echo $logged_in ? 'onclick="return requestGmail();" href="#"' : 'href="#login" class="link-login"' ?>>
            <img src="<?php echo $this->Html->url('/'); ?>img/images/g2.jpg" alt="">
        </a>
		<a id="sms" href="#">
            <img src="<?php echo $this->Html->url('/'); ?>img/images/g3.jpg" alt="">
        </a>
	</div>
	<h3 class="title">Lưu sự kiện vào điện thoại</h3>
	<div class="code">
        <?php echo $this->QrCode->text($event_address . '-' . $event_title, array('size' => '100x100')); ?>
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
     $(document).ready(function(){
        
        $('#sms').on('click',function(){
            alert("Xin vui lòng liên hệ 0985 684 772 để được tư vấn thông tin về chức năng SMS Marketing");
            return false;
        });
     })
</script>