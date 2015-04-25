<div class="pt-notification pt-right-user-detail">
	<div class="pt-notification-user">
		<a target="_blank" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $owner_id)) ?>"><img src="<?php echo General::getUrlImage($avatar_url); ?>" alt=""></a>
		<a target="_blank" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $owner_id)) ?>"><h3><?php echo $user_name; ?></h3></a>
		<span class="style">Đã đăng <?php echo $created; ?></span>
		<div class="pt-how">
			<a href="#send-messages" class="pt-message cboxElement"><i class="fa fa-envelope-o"></i></a>
			<a href="#send-messages" class="pt-message cboxElement pt-info-circle"><i class="fa fa-info-circle"></i></a>
		</div>
		<div class="block-general">
			<div class="like">
				<a href="#"><i class="fa fa-heart"></i>  Cảm ơn</a>
				<span><?php echo $thanks; ?></span>
			</div>
		</div>
	</div>
</div>
<div class="pt-times-detail">
	<h3 class="title">Thời gian tham gia</h3>
	<ul>
		<li><span>10</span>Ngày</li>
		<li><span>58</span>Giờ</li>
		<li><span>10</span>Phút</li>
		<li><span>10</span>Ngây</li>
	</ul>
	<p><span><?php echo $totalParticipation; ?> người</span> đã tham gia</p>
	<div class="pt-how">
		<a href="#send-adherence" class="send">Tham gia ngay</a>
	</div>
</div>

<div class="popup-exchange">
	<div class="pt-send-messages" id="send-messages">
		<h3 class="title"><i class="fa fa-paper-plane"></i> Gửi tin nhắn đến <?php echo $user_name; ?></h3>
        <form method="post" action="">
        	<textarea placeholder="Bạn điền nội dung tại đây ..." id="message" name="message" cols="50" rows="10" class="validate[required]"></textarea>
        	<input type="submit" class="send" value="Lưu ghi chú">
        </form>
	</div>
</div>

<div class="popup-exchange">
	<div class="pt-adherence" id="send-adherence">
		<h3 class="title">Đăng ký tham gia sự kiện</h3>
    	<div class="pt-adherence-left">
    		<h4><?php echo isset($data['title']) ? $data['title'] : '';?></h4>
    		<ul>
				<li><strong>Thể loại</strong><span><?php echo isset($data['type'])? $data['type'] : '' ?></span></li>
				<li><strong>Thời gian</strong><span><?php echo isset($data['start']) ? $data['start'] : '';?>   <br />   <?php echo isset($data['end']) ? $data['end'] : '';?></span></li>
				<li><strong>Hotline</strong><span><?php echo isset($data['hotline']) ? $data['hotline'] : '';?></span></li>
				<li><strong><?php echo $data['is_daily_coupon'] ? 'Chiết khấu' : 'Phí tham gia' ?></strong><span><?php echo isset($data['fee'])? $data['fee'] : ''; ?></span></li>
				<li><strong>Địa điểm</strong><div class="pt-how"><span><?php echo isset($data['address']) ? $data['address'] : ''; ?></span></div></li>
			</ul>
    	</div>
    	<div class="pt-adherence-right">
            <form method="post" action="<?php echo $this->Html->url(array("controller" => "Participations", "action" => "participate")); ?>">
        		<ul>
    				<li>
                        <input type="hidden" id="event_id" name="data[Participation][event_id]" value="<?php echo $event_id; ?>" />
    					<label>Điện thoại:</label>
    					<input type="text" name="data[Participation][mobile]" title="" value="<?php echo isset($default_user_mobile) ? $default_user_mobile : ''; ?>" class="validate[required] text" placeholder="Số điện thoại của bạn">
    				</li>
    				
    				<li>
    					<label>Ghi chú</label>
    					<textarea id="message" name="data[Participation][note]" cols="50" rows="10" class="validate[required]"></textarea>
    				</li>
    				<li>
    					<input type="submit" class="send" value="Đăng ký"/>
    				</li>
    			</ul>
            </form>
    	</div>
	</div>
</div>