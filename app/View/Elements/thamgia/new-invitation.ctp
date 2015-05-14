<?php 
    $users = $this->requestAction(array('controller' => 'Invitations', 'action' => 'getMaxUsers'));
?>
<div class="pt-invited">
	<h3 class="title">Mời tham gia</h3>
	<ul>
        <?php foreach($users as $user){ ?>
		<li>
			<div class="block-user">
				<img src="<?php echo General::getUrlImage($user['users']['avatar_url']); ?>" alt="">
				<h3 class="title"><a target="_blank" href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'profile', $user['users']['id'])); ?>"><?php echo $user['users']['fullname']; ?></a></h3>
			</div>
			<div class="pt-add-user">
				<a <?php echo !$logged_in ? "href=\"#login\"" : "onclick=\"return invited(this,".$event_id .",'". $user['users']['email']."');\" href=\"#\"";?> class="link-add <?php echo !$logged_in ? "link-login" : ""; ?>"><i class="fa fa-paper-plane"></i>Mời</a>
				<a href="#" onclick="return deleteInvitation(this);" class="delete"><i class="fa fa-times"></i></a>
			</div>
		</li>
        <?php } ?>
	</ul>
</div>
<script type="text/javascript">
    function deleteInvitation(e){
         $.ajax({
            url: '<?php echo $this->Html->url(array('controller' => 'Invitations', 'action' => 'getInvitation', $event_id)); ?>',
            type: 'GET',
            async: false,
            error: function(){
                $(e).parent().parent().fadeOut(500, function(){
                    $(e).parent().css('display','block');
                });
                /*alert('Error load invitation!')*/
            },
            success: function(data){ 
                $(e).parent().parent().fadeOut(500, function(){
                    $(e).parent().parent().css('display','block');
                    $(e).parent().parent().empty().append(data);
                });
            }
        });
        
        return false;
    }
    
    function invited(e, event_id, email){
        // post send contact
        $.post("<?php echo $this->Html->url(array('controller' => 'Invitations','action' => 'sendEmailInvitation')) ?>", {event_id: event_id, email: email});
            
        $.ajax({
            url: '<?php echo $this->Html->url(array('controller' => 'Invitations', 'action' => 'getInvitation', $event_id)); ?>',
            type: 'GET',
            async: false,
            error: function(){
                alert('Error load invitation!')
            },
            success: function(data){ 
                $(e).parent().parent().fadeOut(500, function(){
                    $(e).parent().parent().css('display','block');
                    $(e).parent().parent().empty().append(data);
                });
            }
        });
        return false;
    }
</script>