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
				<h3 class="title"><a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'profile', $user['users']['id'])); ?>"><?php echo $user['users']['fullname']; ?></a></h3>
			</div>
			<div class="pt-add-user">
				<a href="#" class="link-add"><i class="fa fa-paper-plane"></i>Mời</a>
				<a href="#" class="delete"><i class="fa fa-times"></i></a>
			</div>
		</li>
        <?php } ?>
	</ul>
</div>