<img src="<?php echo General::getUrlImage($data['User']['avatar_url']);?>" alt="">
<div class="block-content-text">
	<h3 class="title">
        <a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' =>'profile', $data['User']['id'])); ?>">
            <?php echo $data['User']['fullname']; ?>
        </a>
    </h3>
	<p><?php echo $data['Comment']['comment'];?></p>
	<div class="pt-how">
		<span><?php echo date(TIME_FORMAT_CLIENT, strtotime($data['Comment']['created']));?></span>
        <a href="#" <?php   echo $logged_in ? 'onclick="thanked(this,'.$data['Comment']['id'].');return false;"' : 'onclick="login(); return false;"' ?>>
            <i class="fa fa-heart"></i>
            Cảm ơn
        </a>
        <span class="thank"><strong onmouseover="bubbleUsersThanks(this)"><?php echo $data['Comment']['thanks']; ?> người </strong>đã cảm ơn điều này</span>
        <div class="users-thanks" style="display: none;">
            <?php echo $data['Comment']['usersThanks'];?>  
        </div>
	</div>
</div>