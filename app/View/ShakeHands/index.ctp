<div class="content">
    <div class="shake-hand-request">
        <h2 class="titel">Yêu cầu bắt tay</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="card">Danh Thiếp / Người dùng</th>
                    <th>Lời nhắn</th>
                    <th class="action">Xác nhận yêu cầu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $request){ ?>
                    <?php if($request['business_card_id'] == null){ ?>
                    <tr>
                        <td>
                            <div class="block-user">
        						<img src="<?php echo General::getUrlImage($request['avatar_url']); ?>" alt="" />
        						<h3 class="title">
                                    <a href="<?php echo $this->Html->url(array("controller" => "Users", "action" => "profile", $request['user_id'] )); ?>">
                                        <?php echo $request['fullname']; ?>
                                    </a>
                                </h3>
        						<p>Email: <?php echo $request['email']; ?></p>
        					</div>
                        </td>
                        <td>
                            <?php echo $request['message']; ?>
                        </td>
                        <td class="action">
                            <a href="#02" class="btn btn-info">Chấp nhận</a>
                            <button class="btn btn-danger">Hủy</button>
                        </td>
                    </tr>
                    <?php }else{ ?>
                    <tr>
                        <td class="pt-exchange-how">
                            <div class="pt-exchange-block pt-exchange-block-style-0<?php echo $request['template_id']; ?>">
                				<div class="block-user">
                					<img src="<?php echo General::getUrlImage($request['avatar_url']);  ?>" alt="<?php echo $request['name']; ?>">
                					<h3 class="title"><a href="#"><?php echo $request['name']; ?></a></h3>
                					<p><?php echo $request['position']; ?></p>
                				</div>
                				<div class="block-content">
                					<h3 class="title"><a href="#"><?php echo $request['name_company']; ?></a></h3>
                					<p><?php echo $request['type_card']; ?></p>
                				</div>
                				<div class="block-footer">
                					<a href="#" class="link phone"><i class="fa fa-mobile"></i> Tel: <?php echo $request['mobile']; ?></a>
                					<a href="#" class="link"><i class="fa fa-envelope-o"></i> mail: <?php echo $request['email']; ?></a>
                					<div class="networking">
                						<a href="<?php echo ($request['linkedin']=="") ? "#" : $request['linkedin']; ?>"><i class="fa fa-linkedin"></i></a>
                						<a href="<?php echo ($request['facebook']=="") ? "#" : $request['facebook']; ?>"><i class="fa fa-facebook"></i></a>
                					</div>
                				</div>
                			</div>
                        </td>
                        <td>
                            <?php echo $request['message']; ?>
                        </td>
                        <td class="action">
                            <a href="#02" class="btn btn-info accept" id="<?php echo $request['business_card_id'].'-'.$request['shake_hand_id']; ?>">Chấp nhận</a>
                            <button class="btn btn-danger">Hủy</button>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="popup-exchange">
	<div class="popup-exchange-block" id="02">
		<h3 class="title">Gửi ghi chú danh thiếp</h3>
		<div id="this-append" class="popup-exchange-block-left pt-exchange-how">
		</div>
		<div class="popup-exchange-block-right">
            <form method="post" action="<?php echo $this->Html->url(array('controller'=>'ShakeHands', 'action' => 'confirm')) ?>">
                <input type="hidden" name="data[ShakeHand][card_id]" value="" id="card_id" />
                <input type="hidden" name="data[ShakeHand][shake_hand_id]" value="" id="shake_hand_id" />
                <textarea required id="message" name="data[ShakeHand][message]" cols="50" rows="10" class="validate[required]" placeholder="Ghi lưu chú danh thiếp"></textarea>
                <input type="submit" class="send" value="Lưu ghi chú">
            </form>
		</div>
	</div>
</div>
<script type="text/javascript">
    $('.accept').click(function(e){
        $('#this-append').empty();
        $('#card_id').val($(this).attr('id').split('-')[0]);
        $('#shake_hand_id').val($(this).attr('id').split('-')[1]);
        $(this).parent().parent().find('.pt-exchange-how').clone().appendTo('#this-append');
    });
</script>