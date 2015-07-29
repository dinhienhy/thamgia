<?php $userInformation = $this->requestAction(array('controller' => 'Users', 'action' => 'getUserInformation', $user_id)); ?>
<?php $userAddedEvents = $this->requestAction(array('controller' => 'Events', 'action' => 'getAddedEvents', $user_id)); ?>
<?php $userParticipatedEvents = $this->requestAction(array('controller' => 'Participations', 'action' => 'getParticipatedEvents', $user_id)); ?>

<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <?php 
            echo $this->element('thamgia/personal_information',
            array(
                'user_id' => $user_id,
                'owner' => $owner
            )); 
        ?>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="pt-notification-right ">
			<div class="pt-exchange">
				<div class="pt-exchange-menu">
					<ul class="tab-links profile-tab">
						<li>
							<a href="#added_event" class="active">
								<span>Sự kiện đã đăng</span>
								<strong><?php echo str_pad($userInformation['count_added_events'], 2, '0', STR_PAD_LEFT); ?></strong>
							</a> 
						</li>
						<li>
							<a href="#participated_event">
								<span>Sự kiện đã tham gia</span>
								<strong><?php echo str_pad($userInformation['count_participated_events'], 2, '0', STR_PAD_LEFT); ?></strong>
							</a> 
						</li>
					</ul>
				</div>
			</div>
			<div class="tab-content">
				<ul class="pt-list-event active tab" id="added_event">
					<?php if(!empty($userAddedEvents)){ ?>
						<?php foreach($userAddedEvents as $event){ ?>
						<li>
							<a href="<?php echo $this->Html->url(array('controller' => 'Events', 'action' => 'detail', 'slug' => Link::seoTitle($event['title']), 'id' => $event['id'])); ?>" target="_blank" class="img">
								<img src="<?php echo General::getUrlImage($event['image_list_url']); ?>" alt="">
							</a>
							<div class="pt-list-event-content">
								<h3>
									<a href="<?php echo $this->Html->url(array('controller' => 'Events', 'action' => 'detail', 'slug' => Link::seoTitle($event['title']), 'id' => $event['id'])); ?>" target="_blank">
										<?php echo $event['title'] ?>
									</a>
								</h3>
								<p>Mã sự kiện : <?php echo $event['code']; ?></p>
								<span>Đăng lúc: <?php echo $event['created']; ?></span>
							</div>
						</li>
						<?php } ?>
					<?php }else{ ?>
						<p>Chưa đăng sự kiện nào.</p>
					<?php } ?>
				</ul>
				<ul class="pt-list-event tab" id="participated_event">
					<?php if(!empty($userParticipatedEvents)){ ?>
						<?php foreach($userParticipatedEvents as $event){ ?>
						<li>
							<a href="<?php echo $this->Html->url(array('controller' => 'Events', 'action' => 'detail', 'slug' => Link::seoTitle($event['title']), 'id' => $event['event_id'])); ?>" target="_blank" class="img">
								<img src="<?php echo General::getUrlImage($event['image_list_url']); ?>" alt="">
							</a>
							<div class="pt-list-event-content">
								<h3>
									<a href="<?php echo $this->Html->url(array('controller' => 'Events', 'action' => 'detail', 'slug' => Link::seoTitle($event['title']), 'id' => $event['event_id'])); ?>" target="_blank">
										<?php echo $event['title'] ?>
									</a>
								</h3>
								<p>Mã sự kiện : <?php echo $event['code']; ?></p>
								<span>Tham gia lúc: <?php echo $event['created']; ?></span>
							</div>
						</li>
						<?php } ?>
					<?php } else{ ?>
						<p>Chưa tham gia sự kiện nào.</p>
					<?php } ?>
				</ul>
			</div>
			
		</div>
    </div>
</div>
<script type="text/javascript">
	$('.tab-links a').on('click', function(e)  {
        var currentAttrValue = $(this).attr('href');
 
        // Show/Hide Tabs
        $('.tab-content ' + currentAttrValue).show().siblings().hide();
 
        $('.profile-tab li').removeClass('active');
        $('.profile-tab li a').removeClass('active');
        // Change/remove current tab to active
        $(this).parent('li').addClass('active').siblings().removeClass('active');
        $(this).addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });
</script>