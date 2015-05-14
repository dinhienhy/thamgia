<script type="text/javascript">
     $(document).ready(function(){
        loadComment(<?php echo $data['id']; ?>);
     });
     
     
     function loadComment(event_id){
        $.ajax({
               type:"GET",
               async:false,
               url:'<?php echo $this->Html->url('/')?>' + 'comments/getComments/' + event_id,
               success : function(data) {
                    $('#list-comments').empty();
                    $('#list-comments').append(data); 
               },
               error : function() {
                   alert('Lỗi load sự kiện bình luận!');
               },
           });
           
           loadHeaderComment(<?php echo $data['id']; ?>);
           loadUsersLike(<?php echo $data['id']; ?>);    
     }
     
     function sendComment(id){
        var comment = $('#comment-content').val();
        if ($('#comment-content').val() != ''){
            showLoading();
            
            dataString = 'comment=' + comment;
            $.ajax({
                url: '<?php echo $this->Html->url('/')?>' + 'comments/sendComment/'+id,
                type: 'POST',
                data: dataString,
                async: false,
                cache: false,
                timeout: 30000,
                error: function(){
                    return true;
                },
                success: function(msg){ 
                    loadComment(id);
                    loadHeaderComment(id);
                    hideLoading();
                    $('#comment-content').val(''); 
                }
            });
            
            
            dataString = 'event_id=' + id + '&comment=' + comment + '&commenter_id=' + '<?php echo $users_userid; ?>' + '&commenter=' + '<?php echo $users_name; ?>';
            $.ajax({
                url: '<?php echo $this->Html->url(array('controller' => 'Comments', 'action' => 'sendMailNotificationComment'))?>',
                type: 'POST',
                data: dataString,
                async: true,
                cache: false,
                timeout: 1000,
                global: false,
                error: function(){
                    // do nothing
                }
                /*success: function(msg){ 
                    // do nothing
                } */
            });
            
               
        }else{
            alert('Vui lòng nhập nội dung bình luận!');
        }
        
     }
     
     function loadHeaderComment(event_id){
        $.ajax({
               type:"GET",
               async: false,
               url:'<?php echo $this->Html->url('/')?>' + 'comments/getHeaderComments/' + event_id,
               success : function(data) {
                    $('#sumary-comments').empty();
                    $('#sumary-comments').append(data); 
               },
               error : function() {
                   alert('Lỗi load header comment!');
               },
           });
     }
     
     function loadUsersLike(event_id){
        $.ajax({
               type:"GET",
               async: false,
               url:'<?php echo $this->Html->url('/')?>' + 'likes/getUsersLike/' + event_id,
               success : function(data) {
                    $('#users-like').empty();
                    $('#users-like').append(data); 
               },
               error : function() {
                   alert('lỗi load số like!');
               },
           });   
     }
     
     function like(event_id){
        $.ajax({
               type:"GET",
               async: false,
               url:'<?php echo $this->Html->url('/')?>' + 'likes/addLike/' + event_id + '/1',
               success : function(data) {
                    $('#users-like').empty();
                    $('#users-like').append(data); 
               },
               error : function() {
                   alert('lỗi like!');
               },
        });    
     }
     
     function disLike(event_id){
        $.ajax({
               type:"GET",
               async: false,
               url:'<?php echo $this->Html->url('/')?>' + 'likes/addLike/' + event_id + '/0',
               success : function(data) {
                    $('#users-like').empty();
                    $('#users-like').append(data); 
               },
               error : function() {
                   alert('lỗi dislike!');
               },
        });    
     }
     
     function showLoading(){
        $('#loading').css('display','inline-block');
     }
     
     function hideLoading(){
        $('#loading').css('display','none');
     }
     
     
</script>
<div class="pt-block-left-event">
	<div class="custom-container">
        <?php  echo $this->element('thamgia/events_other', array(
                                                'type_id'=> $data['type_id'],
                                                'type_name' => $data['type_name'],
                                                'event_id'=> $data['id']
                                            )); ?>
    </div>
	<div class="pt-block-content-event">
		<h2 class="title"><?php echo isset($data['title']) ? $data['title'] : '';?></h2>
		<div class="pt-block-info-user-event">
			<div class="block-user">
				<img src="<?php echo General::getUrlImage($data['avatar_url'] ); ?>" alt="">
				<h3 class="title">
            <a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'profile', $data['owner_id'])); ?>">
                <?php echo isset($data['user_name']) ? $data['user_name'] : '';  ?>
            </a>
            <span>đã đăng <?php echo isset($data['created']) ? $data['created'] : '';  ?></span>
        </h3>
			</div>
            <?php
            $number_review = $this->requestAction(array('controller' => 'comments', 'action' => 'getNumberReview', $data['id']));
            ?>
			<ul class="pt-list-reviews">
				<li><strong>123</strong><span>Chia sẻ</span></li>
				<li><strong><?php echo $number_review; ?></strong><span>Nhận xét</span></li>
			</ul>
            <?php $url = $this->Html->url(null, true); ?>
			<ul class="pt-list-socially">
				<li>
                    <a onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?php echo $url; ?>">
                        <img src="<?php echo $this->Html->url('/'); ?>img/images/h1.jpg" alt="">
                    </a>
                </li>
				<li>
                    <a onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>">
                        <img src="<?php echo $this->Html->url('/'); ?>img/images/h2.jpg" alt="">
                    </a>
                </li>
				<li>
                    <a onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" href="https://plus.google.com/share?url=<?php echo $url; ?>">
                        <img src="<?php echo $this->Html->url('/'); ?>img/images/h3.jpg" alt="">
                    </a>
                </li>
				<li>
                    <a onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" href="https://www.linkedin.com/cws/share?url=<?php echo $url; ?>">
                        <img src="<?php echo $this->Html->url('/'); ?>img/images/h4.jpg" alt="">
                    </a>
                </li>
			</ul>
		</div>
		<div class="pt-block-content-event-text">
			<div class="pt-block-content-event-title">
				<img src="<?php echo $this->Html->url('/') . (isset($data['image']) ? $data['image'] : NO_IMG_URL);  ?>" alt="">
                <?php if($data['is_daily_coupon'] && $logged_in && $participated) echo $this->element('thamgia/voucher',array('event_id' => $data['id'])); ?>
				<div class="pt-block-content-event-left">
					<ul>
						<li>
              <strong>Thể loại</strong>
              <span>
                  <a href="<?php echo $this->Html->url(array('controller' => 'Events', 
                                                      'action' => 'getByType', 
                                                      'slug_city' => Link::seoTitle($data['city_name']), 
                                                      'city_id' => $data['city_id'],
                                                      'slug_type' => Link::seoTitle($data['type_name']),
                                                      'type_id' => $data['type_id'])); ?>">
                      <?php echo isset($data['type'])? $data['type'] : '' ?>
                  </a>
              </span>
            </li>
						<li><strong>Thời gian</strong><span><?php echo isset($data['start']) ? $data['start'] : '';?>   <br />   <?php echo isset($data['end']) ? $data['end'] : '';?></span></li>
						<li><strong>Hotline</strong><span><?php echo isset($data['hotline']) ? $data['hotline'] : '';?></span></li>
						<li><strong><?php echo $data['is_daily_coupon'] ? 'Chiết khấu' : 'Phí tham gia' ?></strong><span><?php echo isset($data['fee'])? $data['fee'] : ''; ?></span></li>
						<li><strong>Địa điểm</strong><div class="pt-how"><span><?php echo isset($data['address']) ? $data['address'] : ''; ?></span><a href="#"><i class="fa fa-map-marker"></i> XEM BẢN ĐỒ</a></div></li>
					</ul>
				</div>
			</div>
			<div class="pt-block-content-event-content">
				<?php 
                    $description = isset($data['description']) ? $data['description'] : '';
                    $summary = General::getSummary($description);
                    if ($summary != ''){
                ?>
                <div id="summary" style="display:block;">
                    <?php 
                        /*preg_match('/^([^.!?\s]*[\.!?\s]+){0,30}/', strip_tags($description), $abstract);
                        echo $abstract[0];*/
                        echo $summary;
                    ?>
                </div>
                <div id="full" style="display: none;">
                    <?php echo $description; ?>
                </div>
                <div class="view-more">
                    <span></span><a id="link" onclick="return show_hide()" href="#" class="open">Xem thêm</a>
                </div>       
                <?php } else { ?>
                <div id="full" style="display: block;">
                    <?php echo $description; ?>
                </div>
                <?php } ?>
			</div>
		</div>
	</div>
</div>
<div class="pt-block-stt pt-list-comment-detail">
	<h4 class="title" id="sumary-comments">Bình luận (3)</h4>
	<ul class="pt-list-comment">
		<li class="comment">
            <?php if ($logged_in){ ?>
			<div class="block-user">
				<img src="<?php echo General::getUrlImage($users_avatar); ?>" alt="">
				<div class="block-content-text">
					<textarea id="comment-content" name="message" cols="50" rows="10" class="validate[required]"  placeholder="Type comment"></textarea>
				</div>
                <input onclick="sendComment(<?php echo $data['id'] ?>)" type="button" class="send" value="Gửi bình luận" />
			</div>
            <?php } else { ?>
                <p><span>Bạn vui lòng <a class="message" href="#" onclick="login(); return false;" >đăng nhập</a> trước để có thể tham gia bình luận</span></p>
            <?php } ?>
			
		</li>
	</ul>
    <ul class="pt-list-comment" id="list-comments">
        <li>
			<div class="block-user">
				<img src="<?php echo $this->Html->url('/'); ?>img/images/sk2.jpg" alt="">
				<div class="block-content-text">
					<h3 class="title"><a href="#">Hồng Nhung</a></h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea</p>
					<div class="pt-how">
						<span>12:00 20-11-2105</span><a href="#"><i class="fa fa-heart"></i>Cảm ơn</a>
					</div>
				</div>
			</div>
		</li>
    </ul>
</div>



