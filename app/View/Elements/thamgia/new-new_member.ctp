<?php
    $data = $this->requestAction(array('controller' => 'Users', 'action' => 'getNewMember')); 
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
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
					<div class="block-user">
						<img src="img/images/t1.jpg" alt="" />
						<a href="#" class="friend"></a>
						<div class="block-how">
							<h3 class="title"><a href="#">Hồng Nhung</a></h3>
							<p>Kỹ sư xây dụng đà nẵng</p>
						</div>
					</div>
					<div class="block-user">
						<img src="img/images/t2.jpg" alt="" />
						<a href="#" class="friend"></a>
						<div class="block-how">
							<h3 class="title"><a href="#">Hồng Nhung</a></h3>
							<p>Kỹ sư xây dụng đà nẵng</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
					<div class="block-user">
						<img src="img/images/t3.jpg" alt="" />
						<a href="#" class="friend"></a>
						<div class="block-how">
							<h3 class="title"><a href="#">Hồng Nhung</a></h3>
							<p>Kỹ sư xây dụng đà nẵng</p>
						</div>
					</div>
					<div class="block-user">
						<img src="img/images/t4.jpg" alt="" />
						<a href="#" class="friend"></a>
						<div class="block-how">
							<h3 class="title"><a href="#">Hồng Nhung</a></h3>
							<p>Kỹ sư xây dụng đà nẵng</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> <!--   Thành viên mới - Danh thiếp mới  -->