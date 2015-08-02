<div class="pt-exchange">
	<div class="pt-exchange-menu">
		<ul class="tab-links exchange-tab">
			<li>
				<a href="#activities">
					<span>Họ đang làm gì</span>
					15 hoạt động mới
				</a> 
			</li>
			<li class="active">
				<a href="#giao-luu" class="active">
					<span>Giao lưu</span>
					15 danh thiếp được trao đổi
				</a> 
			</li>
		</ul>
	</div>
    <div class="tab-content">
        
        <div id="giao-luu" class="tab active">
            <?php
                echo $this->element('thamgia/tab_exchanges',
                    array(
                        'user_id' => $users_userid,
                        'type_card_id' => $type_card_id,
                        'career' => $career,
                        'search' => $search,
                        'is_search' => true
                    ));
            ?>
        </div>
        <div id="activities" class="tab">
            <?php
                echo $this->element('thamgia/tab_activities',
                    array(
                        'user_id' => $users_userid
                    ));
            ?>
        </div>
    </div>	
</div>
<div class="popup-exchange">
	<div class="popup-exchange-block" id="01">
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
	$('.tab-links a').on('click', function(e)  {
        var currentAttrValue = $(this).attr('href');
 
        // Show/Hide Tabs
        $('.tab-content ' + currentAttrValue).show().siblings().hide();
 
        $('.exchange-tab li').removeClass('active');
        $('.exchange-tab li a').removeClass('active');
        // Change/remove current tab to active
        $(this).parent('li').addClass('active').siblings().removeClass('active');
        $(this).addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });
    $('.friend').click(function(e){
        $('#this-append').empty();
        $('#card_id').val($(this).attr('id'));
        $(this).parent().parent().clone().appendTo('#this-append');
        $('#this-append .friend').remove();
    });
</script>