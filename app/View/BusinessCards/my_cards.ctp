
<div class="pt-exchange">
    <div class="pt-exchange-menu-content">
		<ul class="tab-links cards-tab">
			<li><a href="#box-cards"><i class="fa fa-credit-card"></i> Hội danh thiếp (<?php echo $count; ?>)</a></li>
			<li><a href="#my-cards" class="active"><i class="fa fa-pencil-square-o"></i> Danh thiếp của tôi</a></li>
		</ul>
	</div>
    <div class="tab-content">
        <div id="my-cards" class="tab active">
            <div class="pt-exchange-content">
        		<h3 class="title">DANH THIẾP VIP</h3>
        		<div class="pt-exchange-how row">
                    <?php if(!empty( $my_card_vips )){ ?>
                        <?php foreach( $my_card_vips as $my_card_vip ) { ?>
                            <div class="pt-exchange-block pt-exchange-block-style-0<?php echo $my_card_vip['BusinessCard']['template_id']; ?>">
                				<span class="vip"></span>
                				<div class="block-user">
                					<img src="<?php echo General::getUrlImage($my_card_vip['BusinessCard']['avatar_url']);  ?>" alt="<?php echo $my_card_vip['BusinessCard']['name']; ?>">
                					<h3 class="title"><a href="#"><?php echo $my_card_vip['BusinessCard']['name']; ?></a></h3>
                					<p><?php echo $my_card_vip['BusinessCard']['position']; ?></p>
                				</div>
                				<div class="block-content">
                					<h3 class="title"><a href="#"><?php echo $my_card_vip['BusinessCard']['name_company']; ?></a></h3>
                					<p><?php echo $my_card_vip['TypeCard']['name']; ?></p>
                				</div>
                				<div class="block-footer">
                					<a href="#" class="link phone"><i class="fa fa-mobile"></i> Tel: <?php echo $my_card_vip['BusinessCard']['mobile']; ?></a>
                					<a href="#" class="link"><i class="fa fa-envelope-o"></i> mail: <?php echo $my_card_vip['BusinessCard']['email']; ?></a>
                					<div class="networking">
                						<a href="<?php echo ($my_card_vip['BusinessCard']['linkedin']=="") ? "#" : $my_card_vip['BusinessCard']['linkedin']; ?>"><i class="fa fa-linkedin"></i></a>
                						<a href="<?php echo ($my_card_vip['BusinessCard']['facebook']=="") ? "#" : $my_card_vip['BusinessCard']['facebook']; ?>"><i class="fa fa-facebook"></i></a>
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
                    <?php if(!empty($my_cards)){ ?>
                        <?php foreach($my_cards as $my_card) { ?>
                			<div class="pt-exchange-block pt-exchange-block-style-0<?php echo $my_card['BusinessCard']['template_id']; ?>">
                				<div class="block-user">
                					<img src="<?php echo General::getUrlImage($my_card['BusinessCard']['avatar_url']);  ?>" alt="<?php echo $my_card['BusinessCard']['name']; ?>">
                					<h3 class="title"><a href="#"><?php echo $my_card['BusinessCard']['name']; ?></a></h3>
                					<p><?php echo $my_card['BusinessCard']['position']; ?></p>
                				</div>
                				<div class="block-content">
                					<h3 class="title"><a href="#"><?php echo $my_card['BusinessCard']['name_company']; ?></a></h3>
                					<p><?php echo $my_card['TypeCard']['name']; ?></p>
                				</div>
                				<div class="block-footer">
                					<a href="#" class="link phone"><i class="fa fa-mobile"></i> Tel: <?php echo $my_card['BusinessCard']['mobile']; ?></a>
                					<a href="#" class="link"><i class="fa fa-envelope-o"></i> mail: <?php echo $my_card['BusinessCard']['email']; ?></a>
                					<div class="networking">
                						<a href="<?php echo ($my_card['BusinessCard']['linkedin']=="") ? "#" : $my_card['BusinessCard']['linkedin']; ?>"><i class="fa fa-linkedin"></i></a>
                						<a href="<?php echo ($my_card['BusinessCard']['facebook']=="") ? "#" : $my_card['BusinessCard']['facebook']; ?>"><i class="fa fa-facebook"></i></a>
                					</div>
                				</div>
                			</div>
                        <?php } ?>
                    <?php } ?>
        		</div>
        	</div>
        </div>
        <div id="box-cards" class="tab">
            <div class="pt-exchange-content">
        		<h3 class="title">DANH THIẾP VIP</h3>
        		<div class="pt-exchange-how row">
                    <?php if( isset($box_card_vips) && !empty( $box_card_vips )){ ?>
                        <?php foreach( $box_card_vips as $box_card_vip ) { ?>
                            <div class="pt-exchange-block pt-exchange-block-style-0<?php echo $box_card_vip['BusinessCard']['template_id']; ?>">
                				<span class="vip"></span>
                				<div class="block-user">
                					<img src="<?php echo General::getUrlImage($box_card_vip['BusinessCard']['avatar_url']);  ?>" alt="<?php echo $box_card_vip['BusinessCard']['name']; ?>">
                					<h3 class="title"><a href="#"><?php echo $box_card_vip['BusinessCard']['name']; ?></a></h3>
                					<p><?php echo $box_card_vip['BusinessCard']['position']; ?></p>
                				</div>
                				<div class="block-content">
                					<h3 class="title"><a href="#"><?php echo $box_card_vip['BusinessCard']['name_company']; ?></a></h3>
                					<p><?php echo $box_card_vip['TypeCard']['name']; ?></p>
                				</div>
                				<div class="block-footer">
                					<a href="#" class="link phone"><i class="fa fa-mobile"></i> Tel: <?php echo $box_card_vip['BusinessCard']['mobile']; ?></a>
                					<a href="#" class="link"><i class="fa fa-envelope-o"></i> mail: <?php echo $box_card_vip['BusinessCard']['email']; ?></a>
                					<div class="networking">
                						<a href="<?php echo ($box_card_vip['BusinessCard']['linkedin']=="") ? "#" : $box_card_vip['BusinessCard']['linkedin']; ?>"><i class="fa fa-linkedin"></i></a>
                						<a href="<?php echo ($box_card_vip['BusinessCard']['facebook']=="") ? "#" : $box_card_vip['BusinessCard']['facebook']; ?>"><i class="fa fa-facebook"></i></a>
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
                    <?php if(isset($box_cards) && !empty($box_cards)){ ?>
                        <?php foreach($box_cards as $box_card) { ?>
                			<div class="pt-exchange-block pt-exchange-block-style-0<?php echo $box_card['BusinessCard']['template_id']; ?>">
                				<div class="block-user">
                					<img src="<?php echo General::getUrlImage($box_card['BusinessCard']['avatar_url']);  ?>" alt="<?php echo $box_card['BusinessCard']['name']; ?>">
                					<h3 class="title"><a href="#"><?php echo $box_card['BusinessCard']['name']; ?></a></h3>
                					<p><?php echo $box_card['BusinessCard']['position']; ?></p>
                				</div>
                				<div class="block-content">
                					<h3 class="title"><a href="#"><?php echo $box_card['BusinessCard']['name_company']; ?></a></h3>
                					<p><?php echo $box_card['TypeCard']['name']; ?></p>
                				</div>
                				<div class="block-footer">
                					<a href="#" class="link phone"><i class="fa fa-mobile"></i> Tel: <?php echo $box_card['BusinessCard']['mobile']; ?></a>
                					<a href="#" class="link"><i class="fa fa-envelope-o"></i> mail: <?php echo $box_card['BusinessCard']['email']; ?></a>
                					<div class="networking">
                						<a href="<?php echo ($box_card['BusinessCard']['linkedin']=="") ? "#" : $box_card['BusinessCard']['linkedin']; ?>"><i class="fa fa-linkedin"></i></a>
                						<a href="<?php echo ($box_card['BusinessCard']['facebook']=="") ? "#" : $box_card['BusinessCard']['facebook']; ?>"><i class="fa fa-facebook"></i></a>
                					</div>
                				</div>
                			</div>
                        <?php } ?>
                    <?php } ?>
        		</div>
        	</div>
        </div>
    </div>	
</div>
<script type="text/javascript">
	$('.tab-links a').on('click', function(e)  {
        var currentAttrValue = $(this).attr('href');
 
        // Show/Hide Tabs
        $('.tab-content ' + currentAttrValue).show().siblings().hide();
 
        $('.cards-tab li').removeClass('active');
        $('.cards-tab li a').removeClass('active');
        // Change/remove current tab to active
        $(this).parent('li').addClass('active').siblings().removeClass('active');
        $(this).addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });
</script>