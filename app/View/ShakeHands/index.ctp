<div class="content">
    <div class="shake-hand-request">
        <h2 class="titel">Yêu cầu bắt tay</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Danh Thiếp / Người dùng</th>
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
                        <td class="action">
                            <button class="btn btn-info">Chấp nhận</button>
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
                        <td class="action">
                            <button class="btn btn-info">Chấp nhận</button>
                            <button class="btn btn-danger">Hủy</button>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>