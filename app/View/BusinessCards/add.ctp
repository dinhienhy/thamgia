<?php if (isset($error)){?>
    <div class="error"><?php echo $error ?></div>
<?php } ?>
<div class="pt-block-business-card">
	<h2 class="title">Tạo danh thiếp cá nhân</h2>
	<div class="row">
        <form method="post" action="<?php echo $this->Html->url('/') ?>businessCards/add" enctype="multipart/form-data">
    		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
    			<div class="pt-block-business-card-left">
    				<div class="pt-add-avatar" style="background-image: url('<?php echo General::getUrlImage(NO_IMG_URL); ?>');background-repeat: no-repeat; background-size: cover;">
    					<i class="fa fa-plus"></i>
    					<input type="file" id="fileUpload" name="data[BusinessCard][avatar_url]" class="validate[required]" required>
    				</div>
    				<div class="pt-block-business-card-from">
    					<ul>
    						<li>
    							<label>Họ và tên</label>
    							<input type="text" name="data[BusinessCard][name]" title="" value="" class="text" required>
    						</li>
    						<li class="w50">
    							<label>Ngành nghề 1</label>
    							<div class="pt-select">
    								<i class="fa fa-angle-down"></i>
    								<select name="data[BusinessCard][careerid]">
                                        <?php foreach ($careers as $career) {?>
                                        <option value="<?php echo $career['Career']['id']; ?>">
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
                                        <option value="<?php echo $career['Career']['id']; ?>" >
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
                                        <option value="<?php echo $typeCard['TypeCard']['id']; ?>">
                                            <?php echo $typeCard['TypeCard']['name']; ?>
                                        </option>
                                        <?php } ?>
    								</select>
    							</div>
    						</li>
    						<li>
    							<label>Tên công ty</label>
    							<input type="text" name="data[BusinessCard][name_company]" title="" value="" class="text" required>
    						</li>
                            <li>
    							<label>Chức danh</label>
    							<input type="text" name="data[BusinessCard][position]" title="" value="" class="text" required>
    						</li>
    						<li>
    							<label>Địa chỉ</label>
    							<input type="text" name="data[BusinessCard][address]" title="" value="" class="text" required> 
    						</li>
    						<li>
    							<label>Số điện thoại</label>
    							<input type="text" name="data[BusinessCard][mobile]" title="" value="" class="text" required>
    						</li>
    						<li>
    							<label>Email cá nhân</label>
    							<input type="text" name="data[BusinessCard][email]" title="" value="" class="text" required>
    						</li>
    						<li>
    							<label>Website</label>
    							<input type="text" name="data[BusinessCard][website]" title="" value="" class="text">
    						</li>
    						<li class="w50">
    							<label>Facebook</label>
    							<input type="text" name="data[BusinessCard][facebook]" title="" value="" class="text" required>
    						</li>
    						<li class="w50">
    							<label>Linked In:</label>
    							<input type="text" name="data[BusinessCard][linkedin]" title="" value="" class="text">
    						</li>
    						<li class="w100">
    							<label>Chọn mẫu cho thiếp cho bạn</label>
    							<div class="pt-select">
    								<i class="fa fa-angle-down"></i>
    								<select id="your-template" name="data[BusinessCard][template_id]">
                                        <?php foreach ($templates as $template) {?>
                                        <option value="<?php echo $template['TemplateCard']['id']; ?>">
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
                        <div class="pt-exchange-block pt-exchange-block-style-01" id="template-id">
            				<div class="block-user">
            					<img src="<?php echo General::getUrlImage(NO_IMG_URL); ?>" alt="Họ và Tên">
            					<h3 class="title"><a href="#">Họ và Tên</a></h3>
            					<p>Chức danh</p>
            				</div>
            				<div class="block-content">
            					<h3 class="title"><a href="#">Tên công ty</a></h3>
            					<p>Loại Danh Thiếp</p>
            				</div>
            				<div class="block-footer">
            					<a href="#" class="link phone"><i class="fa fa-mobile"></i> Số điện thoại</a>
            					<a href="#" class="link"><i class="fa fa-envelope-o"></i> mail: email</a>
            					<div class="networking">
            						<a href="#"><i class="fa fa-linkedin"></i></a>
            						<a href="#"><i class="fa fa-facebook"></i></a>
            					</div>
            				</div>
            			</div>
    				</div>
    				<input type="submit" class="send" value="Tạo danh thiếp">
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