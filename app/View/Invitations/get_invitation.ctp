<div class="block-user">
	<img src="<?php echo General::getUrlImage($user['users']['avatar_url']); ?>" alt="">
	<h3 class="title"><a target="_blank" href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'profile', $user['users']['id'])); ?>"><?php echo $user['users']['fullname']; ?></a></h3>
</div>
<div class="pt-add-user">
	<a <?php echo !$logged_in ? "href=\"#login\"" : "onclick=\"return invited(this,".$event_id .",'". $user['users']['email']."');\" href=\"#\"";?> class="link-add <?php echo !$logged_in ? "link-login cboxElement" :"";  ?>"><i class="fa fa-paper-plane"></i>Mời</a>
	<a href="#" onclick="return deleteInvitation(this);" class="delete"><i class="fa fa-times"></i></a>
</div>


