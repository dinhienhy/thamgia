<?php
    $data = $this->requestAction(array('controller' => 'Users', 'action' => 'getNewMember')); 
?>
<div class="pt-new-members">
	<h3 class="title">Thành viên mới</h3>
    <?php
        foreach($data as $member){
    ?>
        <div class="block-user">
    		<img src="<?php echo General::getUrlImage($member['User']['avatar_url']); ?>" alt="">
    		<div class="block-how">
    			<h3 class="title">
                    <a href="<?php echo $this->Html->url(array("controller" => "Users", "action" => "profile", $member['User']['id'] )); ?>">
                        <?php echo $member['User']['fullname']; ?>
                    </a>
                </h3>
    			<p>1 giờ trước</p>
    		</div>
    	</div>
    <?php
        } 
    ?>
</div>