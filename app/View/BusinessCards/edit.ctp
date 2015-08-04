<?php if (isset($error)){?>
    <div class="error"><?php echo $error ?></div>
<?php } ?>
<div class="pt-block-business-card">
	<h2 class="title">Sửa danh thiếp cá nhân</h2>
	<div class="row">
        <form method="post" action="<?php echo $this->Html->url(array('controller'=>'BusinessCards', 'action' => 'edit')) ?>" enctype="multipart/form-data">
    		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
    			<div class="pt-block-business-card-left">
    				<div class="pt-add-avatar" style="background-image: url('<?php echo General::getUrlImage($data['BusinessCard']['avatar_url']); ?>');background-repeat: no-repeat; background-size: cover;">
    					<i class="fa fa-plus"></i>
    					<input type="file" id="fileUpload" name="data[BusinessCard][avatar_url]" class="validate[required]">
    				</div>
    				<div class="pt-block-business-card-from">
    					<ul>
    						<li>
    							<label>Họ và tên</label>
    							<input type="text" name="data[BusinessCard][name]" title="" value="<?php echo isset($data['BusinessCard']['name']) ? $data['BusinessCard']['name'] :''; ?>" class="text" required>
    						</li>
    						<li class="w50">
    							<label>Ngành nghề 1</label>
    							<div class="pt-select">
    								<i class="fa fa-angle-down"></i>
    								<select name="data[BusinessCard][careerid]">
                                        <?php foreach ($careers as $career) {?>
                                        <option value="<?php echo $career['Career']['id']; ?>" <?php if($career['Career']['id'] == $data['BusinessCard']['careerid'] ) echo "selected"; ?>>
                                            <?php echo $career['Career']['name']; ?>
                                        </option>
                                        <?php } ?>
    								</select>
    							</div>
    						</li>
    						<li class="w50">
    							<label>Ngành nghề 2</label>
    							<div class="pt-select">
    								<i class="fa fa-angle-down"></i>
    								<select name="data[BusinessCard][careerid2]">
                                        <option>Chọn</option>
                                        <?php foreach ($careers as $career) {?>
                                        <option value="<?php echo $career['Career']['id']; ?>" <?php if($career['Career']['id'] == $data['BusinessCard']['careerid2'] ) echo "selected"; ?>>
                                            <?php echo $career['Career']['name']; ?>
                                        </option>
                                        <?php } ?>
    								</select>
    							</div>
    						</li>
                            <li class="w100">
    							<label>Chọn loại danh thiếp</label>
    							<div class="pt-select">
    								<i class="fa fa-angle-down"></i>
    								<select name="data[BusinessCard][type_card_id]">
                                        <?php foreach ($typeCards as $typeCard) {?>
                                        <option value="<?php echo $typeCard['TypeCard']['id']; ?>" <?php if($typeCard['TypeCard']['id'] == $data['BusinessCard']['type_card_id'] ) echo "selected"; ?>>
                                            <?php echo $typeCard['TypeCard']['name']; ?>
                                        </option>
                                        <?php } ?>
    								</select>
    							</div>
    						</li>
    						<li>
    							<label>Tên công ty</label>
    							<input type="text" name="data[BusinessCard][name_company]" title="" value="<?php echo isset($data['BusinessCard']['name_company']) ? $data['BusinessCard']['name_company'] :''; ?>" class="text" required>
    						</li>
                            <li>
    							<label>Chức danh</label>
    							<input type="text" name="data[BusinessCard][position]" title="" value="<?php echo isset($data['BusinessCard']['position']) ? $data['BusinessCard']['position'] :''; ?>" class="text" required>
    						</li>
    						<li>
    							<label>Địa chỉ</label>
    							<input type="text" name="data[BusinessCard][address]" title="" value="<?php echo isset($data['BusinessCard']['address']) ? $data['BusinessCard']['address'] :''; ?>" class="text" required> 
    						</li>
    						<li>
    							<label>Số điện thoại</label>
    							<input type="text" name="data[BusinessCard][mobile]" title="" value="<?php echo isset($data['BusinessCard']['mobile']) ? $data['BusinessCard']['mobile'] :''; ?>" class="text" required>
    						</li>
    						<li>
    							<label>Email cá nhân</label>
    							<input type="text" name="data[BusinessCard][email]" title="" value="<?php echo isset($data['BusinessCard']['email']) ? $data['BusinessCard']['email'] :''; ?>" class="text" required>
    						</li>
    						<li>
    							<label>Website</label>
    							<input type="text" name="data[BusinessCard][website]" title="" value="<?php echo isset($data['BusinessCard']['website']) ? $data['BusinessCard']['website'] :''; ?>" class="text">
    						</li>
    						<li class="w50">
    							<label>Facebook</label>
    							<input type="text" name="data[BusinessCard][facebook]" title="" value="<?php echo isset($data['BusinessCard']['facebook']) ? $data['BusinessCard']['facebook'] :''; ?>" class="text" required>
    						</li>
    						<li class="w50">
    							<label>Linked In:</label>
    							<input type="text" name="data[BusinessCard][linkedin]" title="" value="<?php echo isset($data['BusinessCard']['linkedin']) ? $data['BusinessCard']['linkedin'] :''; ?>" class="text">
    						</li>
    						<li class="w100">
    							<label>Chọn mẫu cho thiếp cho bạn</label>
    							<div class="pt-select">
    								<i class="fa fa-angle-down"></i>
    								<select id="your-template" name="data[BusinessCard][template_id]">
                                        <?php foreach ($templates as $template) {?> 
                                        <option value="<?php echo $template['TemplateCard']['id']; ?>" <?php if($template['TemplateCard']['id'] == $data['BusinessCard']['template_id'] ) echo "selected"; ?>>
                                            <?php echo $template['TemplateCard']['name']; ?>
                                        </option>
                                        <?php } ?>
    								</select>
    							</div>
    						</li>
    					</ul>
    				</div>
    			</div>
    		</div>
    		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    			<div class="pt-business-cards-templates">
                    <p class="your-template">MẪU DANH THIẾP CỦA BẠN</p>
    				<div class="pt-exchange-how">
                        <div class="pt-exchange-block pt-exchange-block-style-0<?php echo $data['BusinessCard']['template_id']; ?>" id="template-id">
            				<div class="block-user">
            					<img src="<?php echo General::getUrlImage($data['BusinessCard']['avatar_url']); ?>" alt="<?php echo $data['BusinessCard']['name']; ?>">
            					<h3 class="title"><a href="#"><?php echo $data['BusinessCard']['name']; ?></a></h3>
            					<p><?php echo $data['BusinessCard']['position']; ?></p>
            				</div>
            				<div class="block-content">
            					<h3 class="title"><a href="#"><?php echo $data['BusinessCard']['name_company']; ?></a></h3>
            					<p>Loại Danh Thiếp</p>
            				</div>
            				<div class="block-footer">
            					<a href="#" class="link phone"><i class="fa fa-mobile"></i> <?php echo $data['BusinessCard']['mobile']; ?></a>
            					<a href="#" class="link"><i class="fa fa-envelope-o"></i> mail: <?php echo $data['BusinessCard']['email']; ?></a>
            					<div class="networking">
            						<a href="<?php echo $data['BusinessCard']['linkedin']; ?>"><i class="fa fa-linkedin"></i></a>
            						<a href="<?php echo $data['BusinessCard']['facebook']; ?>"><i class="fa fa-facebook"></i></a>
            					</div>
            				</div>
            			</div>
    				</div>
    				<input type="submit" class="send" value="Cập nhật">
    			</div>
    		</div>
        </form>
	</div>
</div>
<script type="text/javascript">
$('#your-template').on('change',function(){
    $('#template-id').removeClass().addClass('pt-exchange-block').addClass('pt-exchange-block-style-0'+$(this).val());
    
});
</script>