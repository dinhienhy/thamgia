<?php
    $data = $this->requestAction(array('controller' => 'Users', 'action' => 'getNewMember')); 
    $new_cards = $this->requestAction(array('controller' => 'BusinessCards', 'action' => 'getNewCards')); 
?>
<div class="pt-new-members">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h2 class="title">Thành viên mới</h2>
			<div class="content-block row">
                <?php
                    $i = 1; 
                    foreach($data as $member){ 
                    $createdDate = new DateTime($member['User']['created']);
                    if($i%2 != 0){
                ?>
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <?php } ?>
					<div class="block-user">
						<img src="<?php echo General::getUrlImage($member['User']['avatar_url']); ?>" alt="" />
						<h3 class="title">
                            <a href="<?php echo $this->Html->url(array("controller" => "Users", "action" => "profile", $member['User']['id'] )); ?>">
                                <?php echo $member['User']['fullname']; ?>
                            </a>
                        </h3>
						<p>Tham gia: <?php echo $createdDate->format('d/m/Y') ?></p>
					</div>
                    <?php if($i%2 == 0){ ?>
				</div>
                <?php 
                    }
                    $i +=1;
                } 
                ?>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h2 class="title">Danh thiếp mới</h2>
			<div class="content-block row">
                <?php
                    $j = 1;  
                    foreach ($new_cards as $new_card) { 
                        if($j%2 != 0){
                ?>
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
					<?php } ?>
                    <div class="block-user">
						<img src="<?php echo General::getUrlImage($new_card['BusinessCard']['avatar_url']); ?>" alt="" />
						<a href="<?php echo $logged_in ? '#home-01' : '#login'; ?>" class="friend" id="<?php echo $new_card['BusinessCard']['id']; ?>"></a>
						<div class="block-how">
							<h3 class="title">
                                <a href="<?php echo $this->Html->url(array("controller" => "Users", "action" => "profile", $new_card['BusinessCard']['user_id'] )); ?>">
                                    <?php echo $new_card['BusinessCard']['name']; ?>
                                </a>
                            </h3>
							<p><?php echo $new_card['BusinessCard']['position']; ?></p>
						</div>
					</div>
                <?php if($j%2 == 0){ ?>
                </div>
                <?php }$j +=1;?>
                    <?php } ?>
			</div>
		</div>
	</div>
</div> <!--   Thành viên mới - Danh thiếp mới  -->
<div class="popup-exchange">
	<div class="popup-exchange-block pt-new-members" id="home-01">
		<h3 class="title">Gửi ghi chú danh thiếp</h3>
		<div id="this-append" class="popup-exchange-block-left pt-exchange-how">
		</div>
		<div class="popup-exchange-block-right">
            <form method="post" action="<?php echo $this->Html->url(array('controller'=>'Exchanges', 'action' => 'shake_hand')) ?>">
                <input type="hidden" name="data[ShakeHand][card_id]" value="" id="card_id" />
                <textarea required id="message" name="data[ShakeHand][message]" cols="50" rows="10" class="validate[required]" placeholder="Ghi lưu chú danh thiếp"></textarea>
                <input type="submit" class="send" value="Lưu ghi chú">
            </form>
		</div>
	</div>
</div>
<script type="text/javascript">
$('.friend').click(function(e){
    $('#this-append').empty();
    $('#card_id').val($(this).attr('id'));
    $(this).parent().clone().appendTo('#this-append');
    $('#this-append .friend').remove();
});
</script>