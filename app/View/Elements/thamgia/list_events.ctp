<?php 
    $limit = 12;
    $from_id = 0;
    if (!isset($type_id)) $type_id = 0;
    if (!isset($is_search)) $is_search = false;
    
    $data = array();
    if (!$is_search){
        $data = $this->requestAction(array('controller' => 'Events', 'action' => 'getEvents', $city_id, $limit, $type_id,  $user_id, $from_id, 0));
    }else{
        $data = $this->requestAction(array('controller' => 'Events', 'action' => 'getSearchEvents', $city_id, $limit, $type_id, $search['from_date'], $search['to_date'], $search['title'], $user_id, $from_id));
    }
    $index = 0;
?>

<div class="pt-upcoming-events-content" id="events-new">
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
</div>
<div class="view-more">
    <img src="<?php echo $this->Html->url('/'); ?>img/ajax-loader.gif" alt="Image"  />
    <!--<a href="#">Xem Thêm</a> -->
</div>

<script type="text/javascript">
    $(document).ready(function() {
         //lastAddedLiveFunc();
         window.loadMore = true;
        $(window).scroll(function(){

            var wintop = $(window).scrollTop(), docheight = $(document).height(), winheight = $(window).height();
            var  scrolltrigger = 0.75;

            if  ((wintop/(docheight-winheight)) > scrolltrigger) {
                if (window.loadMore){
                    loadMoreEvents();
                }
            }
        });
        
        $('.events-new').addClass('grid-content');
        $(".grid").click(function () {
            $('.grid').addClass('active');
            $('.list').removeClass('active');
            $('ul.events-new').addClass('grid-content').slideDown();
            $('ul.events-new').removeClass('list-content');
            return false;
        });
        
        $(".list").click(function () {
            $('.list').addClass('active');
            $('.grid').removeClass('active');
            $('ul.events-new').addClass('list-content');
            $('ul.events-new').removeClass('grid-content');
            return false;
        });
        
        var $container = $('#events-new');

        $container.imagesLoaded( function(){
          $container.masonry({
             itemSelector : '.item',
             columnWidth: 3
          });
        });
         
    });
    function reorderList(){
        var container = document.querySelector('.pt-upcoming-events-content');
    	var msnry = new Masonry( container, {
    	  // options
    	  itemSelector: '.item'
    	});
    }
    
    function thanksEvent(eventId, userId){
        $.ajax({
           type:"GET",
           async:true,
           url:'<?php echo $this->Html->url(array("controller" => "thanksEvents", "action" => "thanksEvent"))?>' + '/' + eventId  + '/' + userId,
           dataType: "json",
           success : function(data) {
                if (data.Success){
                    $('#thanks_' + eventId).text('Cảm ơn: ' + data.Thanks);
                    $('#thanks-link-' + eventId).removeAttr('href');
                    $('#thanks-link-' + eventId).toggleClass('thanks-disable');
                    $('#thanks-link-' + eventId).find('span').text('Đã Cảm Ơn');
                }     
           },
           error : function() {
               alert('Lỗi cám ơn sự kiện!');
           },
       });
    }
    
    function pinsUser(eventId, userId){
        $.ajax({
           type:"GET",
           async:true,
           url:'<?php echo $this->Html->url(array("controller" => "pinsUsers", "action" => "pinsUser"))?>' + '/' + eventId  + '/' + userId,
           dataType: "json",
           success : function(data) {
                if (data.Success){
                    $('#dotting-link-' + eventId).attr('href', 'javascript:removePinsUser(' + eventId + ',' + userId + ')' );
                    $('#dotting-link-' + eventId).toggleClass('dotting-disable');
                    $('#dotting-link-' + eventId).find('span').text('Gỡ Đánh Dấu');
                    $('#dotting-link-' + eventId).parent().parent().parent().append('<span class="free"> </span>');
                }      
           },
           error : function() {
               alert('Lỗi pin sự kiện!');
           },
       });    
    }
    
    function removePinsUser(eventId, userId){
        $.ajax({
           type:"GET",
           async:true,
           url:'<?php echo $this->Html->url(array("controller" => "pinsUsers", "action" => "removePinsUser"))?>' + '/' + eventId  + '/' + userId,
           dataType: "json",
           success : function(data) {
                if (data.Success){
                    $('#dotting-link-' + eventId).attr('href', 'javascript:pinsUser(' + eventId + ',' + userId + ')' );
                    $('#dotting-link-' + eventId).toggleClass('dotting-disable', false);
                    $('#dotting-link-' + eventId).find('span').text('Đánh Dấu');
                    $('#dotting-link-' + eventId).parent().parent().parent().find("span[class='free']").remove();
                }      
           },
           error : function() {
               alert('Lỗi hủy đánh dấu!');
           },
       });    
    }
   
    function loadMoreEvents(){
        window.loadMore = false;
        $('.view-more img').show();
        $('.view-more a').hide();
        var from = $("#events-new").find("div.item").last().attr("for");
        
        var data = new Array();
        var url = '';
        // get current month
        var currentMonth = $('#month-content li[class="active"]').first().attr('value');
        if (!currentMonth)
            currentMonth = 0;

        <?php if ($is_search){ ?>
            data = {city_id: '<?php echo $city_id; ?>' , limit: 6, type_id: '<?php echo $type_id ?>',  from_date: '<?php echo $search['from_date'] ?>',
                    to_date: '<?php echo $search['to_date']; ?>', title: '<?php echo $search['title']?>', user_id: '<?php echo $user_id; ?>', from: from};
            url = '<?php echo $this->Html->url(array("controller" => "events", "action" => "moreSearchEvents"))?>';
        <?php }else{ ?>
            data = {city_id: '<?php echo $city_id; ?>' , limit: 6, type_id: '<?php echo $type_id ?>', user_id: '<?php echo $user_id; ?>', from: from, month: currentMonth};
            url = '<?php echo $this->Html->url(array("controller" => "events", "action" => "moreEvents"))?>';
        <?php } ?>
        
        $.ajax({
           type:"GET",
           async:false,
           cache: false,
           url: url,
           data: data,
           success : function(data) {
                if (data != ''){
                    $('#events-new').append(data);
                    reorderList();
                    window.loadMore = true;
                    /*$('.view-more img').hide('slow');
                    $('.view-more a').show('slow');*/
                }else{
                    $('.view-more img').hide('slow');
                    /*$('.view-more a').hide('slow');*/
                    window.loadMore = false;
                }
                
           },
           error : function() {
               alert('Lỗi load sự kiện!');
           },
       });    
    }

    function loadEventOfMonth(month){
        $('#events-new').empty();
        $('.view-more a').show('slow');

        data = {city_id: '<?php echo $city_id; ?>' , limit: 12, type_id: '<?php echo $type_id ?>', user_id: '<?php echo $user_id; ?>', month: month};
        url = '<?php echo $this->Html->url(array("controller" => "events", "action" => "moreEvents"))?>';

        $.ajax({
            type:"GET",
            async:false,
            cache: false,
            url: url,
            data: data,
            success : function(data) {
                if (data != ''){
                    $('#events-new').empty().append(data);
                    reorderList();
                    window.loadMore = true;
                    /*$('.view-more img').hide('slow');
                     $('.view-more a').show('slow');*/
                }else{
                    $('.view-more img').hide('slow');
                    /*$('.view-more a').hide('slow');*/
                    window.loadMore = false;
                }

            },
            error : function() {
                alert('Lỗi load sự kiện!');
            },
        });
    }
    
</script>