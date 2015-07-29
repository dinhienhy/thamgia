<?php
    $activities = $this->requestAction(array('controller' => 'Activities', 'action' => 'getActivites', $user_id));
    //print_r($activities);
?>
<div class="pt-block-agent">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <?php
                foreach ($activities as $activity) {
                    $url_detail = '';
                    $titleOfActivity  = '';
                    if (!$activity['Activity']['is_daily_coupon']){
                        $url_detail = $this->Html->url(array('controller' => 'Events', 
                                                                'action'=>'detail',
                                                                'slug'=>Link::seoTitle($activity['Event']['title']),
                                                                'id' =>$activity['Event']['id']));    
                        $titleOfActivity = $activity['Event']['title'];
                    }else{
                        $url_detail = $this->Html->url(array('controller' => 'DailyCoupons', 
                                                                'action'=>'detail',
                                                                'slug'=>Link::seoTitle($activity['DailyCoupon']['title']),
                                                                'id' =>$activity['DailyCoupon']['id']));
                        $titleOfActivity = $activity['DailyCoupon']['title'];
                    }
                    $image_url = $activity['Event']['image_list_url'] != null ? $activity['Event']['image_list_url'] : $activity['Event']['image_url'];
                    $startDate =  new DateTime($activity['Event']['start']);
                    $thanksEvents = $this->requestAction(array('controller' => 'ThanksEvents', 'action' => 'getThanksEvent', $activity['Event']['id']));
                    $getComments = $this->requestAction(array('controller' => 'Comments', 'action' => 'getCommentActivities', $activity['Event']['id']));
                    
            ?>
            <div class="pt-block-stt">
				<div class="block-user">
					<img src="<?php echo General::getUrlImage($activity['User']['avatar_url']); ?>" alt="">
					<h3 class="title">
                        <a target="_blank" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $activity['User']['id'])); ?>">
                            <?php echo $activity['User']['fullname']; ?>
                        </a>
                        <span><?php echo $activity['Activity']['description']; ?></span>
                    </h3>
					<p><?php echo TimeFormat::TimeToString(time()-strtotime($activity['Activity']['created'])); ?> trước</p>
				</div>
				<div class="block-content-stt">
					<a href="<?php echo $url_detail; ?>" class="img">
                        <img src="<?php echo General::getUrlImage($image_url); ?>" alt=""/>
                    </a>
					<div class="block-content-text">
						<h3 class="title">
                            <a href="<?php echo $url_detail; ?>">
                                <?php echo $titleOfActivity; ?>
                            </a>
                        </h3>
						<span class="days"><?php echo $startDate->format('d'); ?> tháng <?php echo $startDate->format('m'); ?></span>
						<p><?php echo $activity['Event']['address']; ?></p>
					</div>
				</div>
				<div class="block-general">
                    <?php if(!$logged_in){ ?>
    					<div class="like">
    						<a href="#login" class="link-login"><i class="fa fa-heart"></i>  Cảm ơn</a>
    						<span><?php echo count($thanksEvents); ?></span>
    					</div>
    					<div class="comment">
    						<a href="javascript:void(0)"><i class="fa fa-comments"></i> Bình luận</a>
    						<span><?php echo count($getComments); ?></span>
    					</div>
                    <?php }else{ ?>
                        <?php if($activity['ThanksEvent']['id'] == null){ ?>
                        <div class="like">
    						<a id="thanks-link-<?php echo $activity['Event']['id']; ?>" href="javascript:<?php echo 'thanksEvent('. $activity['Event']['id'] . ',' . $users_userid . ')'; ?>">
                                <i class="fa fa-heart"></i>  <span class="nopadding">Cảm ơn</span>
                            </a>
    						<span id="thanks_<?php echo $activity['Event']['id']; ?>"><?php echo count($thanksEvents); ?></span>
    					</div>
                        <?php } else { ?>
                        <div class="like active">
    						<a href="javascript:void(0)">
                                <i class="fa fa-heart"></i>  Đã cảm ơn
                            </a>
    						<span><?php echo count($thanksEvents); ?></span>
    					</div>
                        <?php } ?>
    					<div class="comment">
    						<a href="javascript:void(0)"><i class="fa fa-comments"></i> Bình luận</a>
    						<span><?php echo count($getComments); ?></span>
    					</div>
                    <?php } ?>
					<div class="share">
						<a href="<?php echo $url_detail; ?>"><i class="fa fa-share"></i></a>
					</div>
				</div>
				<div class="pt-info-content-stt">
                    <?php if(!empty($thanksEvents)){ ?>
					<div class="pt-block-user-like">
                        <i class="fa fa-heart"></i>
                        <?php
                            $count = 0;
                            foreach ($thanksEvents as $thanksEvent){
                                if($count > 0){
                                    echo ' và ';
                                }
                                echo '<a target="_blank" href="'.$this->Html->url(array('controller' => 'users', 'action' => 'profile', $thanksEvent['User']['id'])).'">'. $thanksEvent['User']['fullname'].'</a>';
                                $count += 1;
                            }
                        ?>
                    </div>
                    <?php } ?>
					<ul class="pt-list-comment">
                        <?php
                        if(!empty($getComments)){
                            foreach ($getComments as $comment){
                        ?>
                            <li>
								<div class="block-user">
									<img src="<?php echo General::getUrlImage($comment['User']['avatar_url']); ?>" alt="">
									<div class="block-content-text">
										<h3 class="title">
                                            <a target="_blank" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $comment['User']['id'])); ?>">
                                                <?php echo $comment['User']['fullname']; ?>
                                            </a>
                                            <span><?php echo $comment['Comment']['comment']; ?></span></h3>
										<p><?php echo TimeFormat::TimeToString(time()-strtotime($comment['Comment']['created'])); ?> trước</p>
									</div>
								</div>
							</li>
                        <?php
                            }
                        } 
                        ?>
						<li class="comment">
                            <a href="<?php echo $url_detail; ?>">Xem và bình luận <i class="fa fa-arrow-circle-right"></i></a>
						</li>
					</ul>
				</div>
			</div>
            <?php
                }
            ?>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <?php if(!$have_card){ ?>
			<div class="pt-teabreak">
				<a href="<?php echo !$logged_in ? '#login' : $this->Html->url(array("controller" => "BusinessCards", "action" => "add")); ?>" class="<?php echo $logged_in ? '' : 'link-login'; ?>">
                    TẠO NAME CARD
                </a>
				<span class="span1">Tham gia vào cộng đồng Teabreak</span>
				<span class="span2">Tạo ngay một danh thiếp cà nhân bạn !</span>
			</div>
            <?php } ?>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?php echo $this->element('thamgia/activity_new_card'); ?>
                    <?php echo $this->element('thamgia/activity_new_member'); ?>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?php echo $this->element('thamgia/activity-navigation'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    function thanksEvent(eventId, userId){
        $.ajax({
           type:"GET",
           async:true,
           url:'<?php echo $this->Html->url(array("controller" => "thanksEvents", "action" => "thanksEvent"))?>' + '/' + eventId  + '/' + userId,
           dataType: "json",
           success : function(data) {
                if (data.Success){
                    $('#thanks_' + eventId).text(data.Thanks);
                    $('#thanks-link-' + eventId).attr('href','javascript:void(0)');
                    $('#thanks-link-' + eventId).parent('.like').toggleClass('active');
                    $('#thanks-link-' + eventId).find('span.nopadding').text('Đã cảm ơn');
                }     
           },
           error : function() {
               alert('Lỗi cám ơn sự kiện!');
           },
       });
    }
</script>