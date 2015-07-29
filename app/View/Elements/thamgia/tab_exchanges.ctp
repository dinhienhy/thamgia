<?php
if(!isset($card_type_id)) $card_type_id = 0;
if($logged_in){
    $count_box_card = $this->requestAction(array('controller' => 'BusinessCards', 'action' => 'countYourBoxCard', $user_id));
}
?>
<?php $card_vips = $this->requestAction(array('controller' => 'BusinessCards', 'action' => 'getCardVips', 4,$card_type_id, $user_id)); ?>
<?php $cards = $this->requestAction(array('controller' => 'BusinessCards', 'action' => 'getCards', 16, $card_type_id, $user_id)); ?>
<div class="pt-exchange-menu-list">
    <?php
    echo $this->element('thamgia/menu-type-card',
        array(
            'typeCards' => $typeCards,
            'card_type_id' => $card_type_id
        ));
    ?>
</div>
<div class="pt-exchange-menu-content">
	<ul>
		<li><a class="<?php echo $logged_in ? '':'link-login'; ?>" href="<?php echo $logged_in ? $this->Html->url(array('controller'=>'BusinessCards', 'action' => 'boxCards')) : '#login' ?>"><i class="fa fa-credit-card"></i> Hội danh thiếp <?php echo isset($count_box_card) ? "(".$count_box_card.")" :""; ?></a></li>
		<li><a class="<?php echo $logged_in ? '':'link-login'; ?>" href="<?php echo $logged_in ? $this->Html->url(array('controller'=>'BusinessCards', 'action' => 'myCards')) : '#login' ?>"><i class="fa fa-pencil-square-o"></i> Danh thiếp của tôi</a></li>
	</ul>
</div>
<?php if(!$have_card){ ?>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-6 col-md-offset-6">
        <div class="pt-teabreak" style="margin: 3px 0;">
        	<a href="<?php echo !$logged_in ? '#login' : $this->Html->url(array("controller" => "BusinessCards", "action" => "add")); ?>" class="<?php echo $logged_in ? '' : 'link-login'; ?>">
                TẠO NAME CARD
            </a>
        	<span class="span1">Tham gia vào cộng đồng Teabreak</span>
        	<span class="span2">Tạo ngay một danh thiếp cà nhân bạn !</span>
        </div>
    </div>
</div>
<?php } ?>
<div class="pt-exchange-content">
	<h3 class="title">DANH THIẾP VIP</h3>
	<div class="pt-exchange-how row">
        <?php if(!empty( $card_vips )){ ?>
            <?php foreach( $card_vips as $card_vip ) { ?>
                <div class="pt-exchange-block pt-exchange-block-style-0<?php echo $card_vip['template_id']; ?>">
    				<span class="vip"></span>
    				<div class="block-user">
    					<img src="<?php echo General::getUrlImage($card_vip['avatar_url']);  ?>" alt="<?php echo $card_vip['name']; ?>">
    					<a href="#<?php echo $logged_in ? '01' : 'login'; ?>" class="friend"></a>
    					<h3 class="title"><a href="#"><?php echo $card_vip['name']; ?></a></h3>
    					<p><?php echo $card_vip['position']; ?></p>
    				</div>
    				<div class="block-content">
    					<h3 class="title"><a href="#"><?php echo $card_vip['name_company']; ?></a></h3>
    					<p><?php echo $card_vip['type_card']; ?></p>
    				</div>
    				<div class="block-footer">
    					<a href="#" class="link phone"><i class="fa fa-mobile"></i> Tel: <?php echo $card_vip['mobile']; ?></a>
    					<a href="#" class="link"><i class="fa fa-envelope-o"></i> mail: kết bạn để xem email</a>
    					<div class="networking">
    						<a href="<?php echo ($card_vip['linkedin']=="") ? "#" : $card_vip['linkedin']; ?>"><i class="fa fa-linkedin"></i></a>
    						<a href="<?php echo ($card_vip['facebook']=="") ? "#" : $card_vip['facebook']; ?>"><i class="fa fa-facebook"></i></a>
    					</div>
    				</div>
    			</div>
            <?php } ?>
        <?php } ?>
	</div>
	<div class="pt-selected">
		<div class="pt-search">
			<button class="button-search" title="Search" type="submit"><i class="fa fa-search"></i></button>
			<input class="input-text" type="text" onblur="if(this.value=='') this.value='Tìm kiếm...'" onfocus="if(this.value=='Tìm kiếm...') this.value='';" value="Tìm kiếm...">
		</div>
		<div class="pt-select">
			<i class="fa fa-angle-down"></i>
			<select>
				<option value="0"> Danh mục 01</option>
				<option value="0"> Danh mục 02</option>
				<option value="0"> Danh mục 03</option>
				<option value="0"> Danh mục 04</option>
				<option value="0"> Danh mục 05</option>
			</select>
		</div>
		<div class="pt-select">
			<i class="fa fa-angle-down"></i>
			<select>
				<option value="0"> Danh mục 02</option>
				<option value="0"> Danh mục 02</option>
				<option value="0"> Danh mục 03</option>
				<option value="0"> Danh mục 04</option>
				<option value="0"> Danh mục 05</option>
			</select>
		</div>
		<div class="pt-select">
			<i class="fa fa-angle-down"></i>
			<select>
				<option value="0"> Khu vực</option>
				<option value="0"> Danh mục 02</option>
				<option value="0"> Danh mục 03</option>
				<option value="0"> Danh mục 04</option>
				<option value="0"> Danh mục 05</option>
			</select>
		</div>
	</div>
	<div class="pt-exchange-how row">
        <?php if(!empty($cards)){ ?>
            <?php foreach($cards as $card) { ?>
    			<div class="pt-exchange-block pt-exchange-block-style-0<?php echo $card['template_id']; ?>">
    				<div class="block-user">
    					<img src="<?php echo General::getUrlImage($card['avatar_url']);  ?>" alt="<?php echo $card['name']; ?>">
    					<a href="#<?php echo $logged_in ? '01' : 'login'; ?>" class="friend" id="<?php echo $card['id']; ?>"></a>
    					<h3 class="title"><a href="#"><?php echo $card['name']; ?></a></h3>
    					<p><?php echo $card['position']; ?></p>
    				</div>
    				<div class="block-content">
    					<h3 class="title"><a href="#"><?php echo $card['name_company']; ?></a></h3>
    					<p><?php echo $card['type_card']; ?></p>
    				</div>
    				<div class="block-footer">
    					<a href="#" class="link phone"><i class="fa fa-mobile"></i> Tel: <?php echo $card['mobile']; ?></a>
    					<a href="#" class="link"><i class="fa fa-envelope-o"></i> mail: kết bạn để xem email</a>
    					<div class="networking">
    						<a href="<?php echo ($card['linkedin']=="") ? "#" : $card['linkedin']; ?>"><i class="fa fa-linkedin"></i></a>
    						<a href="<?php echo ($card['facebook']=="") ? "#" : $card['facebook']; ?>"><i class="fa fa-facebook"></i></a>
    					</div>
    				</div>
    			</div>
            <?php } ?>
        <?php } ?>
	</div>
</div>