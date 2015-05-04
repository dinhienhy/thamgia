<?php 

?>
<script type="text/javascript">
    function bubbleUsersThanks(e){
        if ($(e).HasBubblePopup())
            $(e).RemoveBubblePopup();
            
        $(e).CreateBubblePopup({

            position : 'top',
            align     : 'center',
            
            innerHtml: $(e).parent().find('.users-thanks').html(),            

            innerHtmlStyle: {
                                color:'#FFFFFF', 
                                'text-align':'center'
                            },

            themeName: 'all-azure',
            themePath: '<?php echo $this->Html->url('/'); ?>' + 'img/jquerybubblepopup-themes'
         
        });
    }
    
</script>    
<ul>
<?php
    foreach($data as $item){
?>
    <li>
		<div class="block-user">
			<img src="<?php echo General::getUrlImage($item['User']['avatar_url']);?>" alt="">
			<div class="block-content-text">
				<h3 class="title">
                    <a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' =>'profile', $item['User']['id'])); ?>">
                        <?php echo $item['User']['fullname']; ?>
                    </a>
                </h3>
				<p><?php echo $item['Comment']['comment'];?></p>
				<div class="pt-how">
					<span><?php echo date(TIME_FORMAT_CLIENT, strtotime($item['Comment']['created']));?></span>
                    <a href="#" <?php   echo $logged_in ? 'onclick="thanked(this,'.$item['Comment']['id'].');return false;"' : 'onclick="login(); return false;"' ?>>
                        <i class="fa fa-heart"></i>
                        Cảm ơn
                    </a>
                    <span class="thank"><strong onmouseover="bubbleUsersThanks(this)"><?php echo $item['Comment']['thanks']; ?> người </strong>đã cảm ơn điều này</span>
                    <div class="users-thanks" style="display: none;">
                        <?php echo $item['Comment']['usersThanks'];?>  
                    </div>
				</div>
			</div>
		</div>
	</li>
<?php        
} 
?>
</ul>
<script type="text/javascript">
    function thanked(e, comment_id){
        $.ajax({
               type:"GET",
               async: false,
               url:'<?php echo $this->Html->url(array("controller" => "Comments", "action" => "thanksComment")) ?>/' + comment_id,
               success : function(data) {
                    $.ajax({
                       type:"GET",
                       async: false,
                       url:'<?php echo $this->Html->url(array("controller" => "Comments", "action" => "getAComment")) ?>/' + comment_id,
                       success : function(data) {
                            $(e).parent().parent().parent().empty().append(data);
                       },
                       error : function() {
                           alert('Lỗi load comment!');
                       },
                   });
               },
               error : function() {
                   //do nothing
               },
           });
    }
</script>
