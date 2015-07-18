<?php
    $data = $this->requestAction(array('controller' => 'BusinessCards', 'action' => 'getNewCards')); 
?>
<div class="pt-business-card">
	<h3 class="title">Danh thiếp mới</h3>
    <?php
        foreach($data as $card){
    ?>
        <div class="block-user">
    		<img src="<?php echo General::getUrlImage($card['BusinessCard']['avatar_url']); ?>" alt="">
    		<div class="block-how">
    			<h3 class="title">
                    <a href="<?php echo $this->Html->url(array("controller" => "Users", "action" => "profile", $card['BusinessCard']['user_id'] )); ?>">
                        <?php echo $card['BusinessCard']['name']; ?>
                    </a>
                </h3>
    			<p><?php echo $card['BusinessCard']['position']; ?></p>
    		</div>
    	</div>
    <?php
        }
    ?>
</div>