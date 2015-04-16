<?php
    $index = $from;
?>
<?php foreach($data as $event){
    $url_detail = $this->Html->url(array(
                                        "controller"=>"Events", 
                                        "action"=> "detail",
                                        'slug' => Link::seoTitle($event['Event']['title']),
                                        'id'=> $event['Event']['id']));
    $startDate =  new DateTime($event['Event']['start']);
    $image_url = $event['Event']['image_list_url'] != null ? $event['Event']['image_list_url'] : $event['Event']['image_url'];
?>
    <div class="item" for="<?php echo $index++; ?>">
		<div class="content-block">
			<div class="block-user">
				<img src="<?php echo $event['User']['avatar_url'] != '' ? General::getUrlImage($event['User']['avatar_url']) : $this->Html->url('/') .  NO_IMG_URL; ?>" alt=""/>
				<h3 class="title">
                    <a target="_blank" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $event['Event']['user_id'])); ?>">
                        <?php echo $event['User']['fullname']; ?>
                    </a>
                </h3>
				<p>Tham gia: <?php echo date_format ( new DateTime($event['User']['created']) , 'd/m/Y' ); ?></p>
			</div>
			<div class="img">
				<img src="<?php echo $this->Html->url('/') . ($event['Event']['image_url'] != '' ? $event['Event']['image_url'] : NO_IMG_URL); ?>" alt="" />
				<div class="times">
					<strong><?php echo $startDate->format('d'); ?></strong>
					<span>THÁNG <?php echo $startDate->format('m'); ?></span>
				</div>
			</div>
			<h3 class="title"><a href="<?php echo $url_detail; ?>"><?php echo $event['Event']['title']; ?></a></h3>
			<p><?php echo $event['Event']['address']; ?></p>
			<div class="block-general">
				<div class="like">
					<a href="#"><i class="fa fa-heart"></i>  Cảm ơn</a>
					<span><?php echo $event['Event']['thanks']; ?></span>
				</div>
				<div class="tack">
					<a href="#"><i class="fa fa-thumb-tack"></i>  Đánh dấu</a>
				</div>
				<div class="share">
					<a href="#"><i class="fa fa-share"></i></a>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
