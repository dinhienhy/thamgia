<div class="pt-exchange">
    <div class="pt-exchange-menu-content">
		<ul class="tab-links cards-tab">
			<li><a href="#box-cards" class="active"><i class="fa fa-credit-card"></i> Hội danh thiếp (<?php echo $count; ?>)</a></li>
			<li><a href="#my-cards"><i class="fa fa-pencil-square-o"></i> Danh thiếp của tôi</a></li>
		</ul>
	</div>
    <div class="tab-content">
        <div id="my-cards" class="tab">
            <div class="pt-exchange-content">
                <?php if(!empty( $my_card )){ ?>
            		<div class="pt-exchange-how row">
                        <div class="pt-exchange-block pt-exchange-block-style-0<?php echo $my_card['BusinessCard']['template_id']; ?>">
            				<?php if($my_card['BusinessCard']['level'] == 10){ ?>
                            <span class="vip"></span>
                            <?php } ?>
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
                        <div>
            				<a href="<?php echo $this->Html->url(array('controller'=>'BusinessCards', 'action' => 'edit')) ?>" class="btn btn-info">Sửa danh thiếp</a>
            			</div>
                    </div>
                <?php } ?>
        	</div>
        </div>
        <div id="box-cards" class="tab active">
            <div class="pt-exchange-content">
                <?php if( isset($box_card_vips) && !empty( $box_card_vips )){ ?>
            		<h3 class="title">DANH THIẾP VIP</h3>
            		<div class="pt-exchange-how row">
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
  		            </div>
                <?php } ?>
        		<div class="pt-selected">
                  <form action="<?php echo $this->Html->url(array('controller'=>'BusinessCards', 'action' => 'searchBoxCards')) ?>" method="get">
        			<div class="pt-search">
        				<button class="button-search" title="Search" type="submit"><i class="fa fa-search"></i></button>
        				<input name="search" class="text-name" type="text" placeholder="Tìm kiếm..." value="">
        			</div>
        			<div class="pt-select">
        				<i class="fa fa-angle-down"></i>
        				<select name="type_card">
                            <option value="0"> Loại danh thiếp</option>
                            <?php foreach ($typeCards as $typeCard){ ?>
                                <option value="<?php echo $typeCard['TypeCard']['id']; ?>"><?php echo $typeCard['TypeCard']['name']; ?></option>
                            <?php } ?>
            			</select>
        			</div>
        			<div class="pt-select">
        				<i class="fa fa-angle-down"></i>
        				<select name="career">
                            <option value="0"> Ngành nghề</option>
                            <?php foreach($careers as $careerfe){ ?>
                                <option value="<?php echo $careerfe['Career']['id']; ?>"><?php echo $careerfe['Career']['name']; ?></option>
                            <?php } ?>
            			</select>
        			</div>
                  </form>
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