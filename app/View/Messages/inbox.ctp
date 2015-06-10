<h2 class="title title-center">Hộp tin nhắn</h2>

<div class="pt-content-messages">
  <ul class="pt-list-user-ms tab-links list-user-tab">
    <?php
    if(is_array($all_user)){
        $i =0;
        foreach($all_user as $user_id){
            $userInfo = $this->requestAction(array('controller' => 'Users', 'action' => 'getUserInfo', $user_id));
            //print_r($userInfo);
    ?>
            <li class="<?php echo $i == 0 ? 'active' :''; ?> <?php echo $userInfo['viewed']; ?>" <?php echo isset($userInfo['id_message']) ? 'id="'.$userInfo['id_message'].'"' : ''; ?>>
              <a href="#user_<?php echo $user_id; ?>" class="block-user">
                <img src="<?php echo General::getUrlImage($userInfo['User']['avatar_url']);  ?>" alt="">
                <h3 class="title"><?php echo $userInfo['User']['fullname']; ?></h3>
                <p><?php echo $userInfo['created']; ?></p>
              </a>
            </li>
    <?php
            $i++;
        }
    } 
    ?>
    
  </ul>
  <div class="pt-list-user-ms-content tab-content">
    <?php
        $infoCurrentUser = $this->requestAction(array('controller' => 'Users', 'action' => 'getUserInfo', $users_userid));
        $i = 0;
        foreach($all_user as $user_id){
          $dataOfUsers = $this->requestAction(array('controller' => 'Messages', 'action' => 'getMessageOfUser', $user_id));
          $infoUserSend = $this->requestAction(array('controller' => 'Users', 'action' => 'getUserInfo', $user_id));
          if(is_array($dataOfUsers)){
    ?>
            <div id="user_<?php echo $user_id; ?>" class="tab <?php echo $i == 0 ? 'active':''; ?>">
            <?php
            foreach($dataOfUsers as $dataOfUser){
              if($dataOfUser['Message']['sender'] == $user_id){ ?>
                <div class="pt-block-chat-01">
                  <a href="#" class="avatar"><img src="<?php echo General::getUrlImage($infoUserSend['User']['avatar_url']);  ?>" alt=""></a>
                  <div class="pt-block-chat-01">
                    <h3 class="title">
                        <a href="<?php echo $this->Html->url(array("controller" => "Users", "action" => "profile", $user_id )); ?>">
                        <?php echo $infoUserSend['User']['fullname']; ?>
                        </a>
                    </h3>
                    <div class="pt-block-chat-content-01">
                      <p><?php echo $dataOfUser['Message']['content']; ?></p>
                    </div>
                    <span class="times"><?php echo $dataOfUser['Message']['created']; ?></span>
                  </div>
                </div>
              <?php
              }else{
                ?>
                <div class="pt-block-chat-02">
                  <a href="#" class="avatar"><img src="<?php echo General::getUrlImage($infoCurrentUser['User']['avatar_url']);  ?>" alt=""></a>
                  <div class="pt-block-chat-02">
                    <h3 class="title">
                        <a href="<?php echo $this->Html->url(array("controller" => "Users", "action" => "profile", $users_userid )); ?>">
                        <?php echo $infoCurrentUser['User']['fullname']; ?>
                        </a>
                    </h3>
                    <div class="pt-block-chat-content-02">
                      <p><?php echo $dataOfUser['Message']['content']; ?></p>
                    </div>
                    <span class="times"><?php echo $dataOfUser['Message']['created']; ?></span>
                  </div>
                </div>
                <?php
              }
            }
            ?>
              <div class="pt-comment-chat">
                <form onsubmit="return validateMessage();" action="<?php echo $this->Html->url(array('controller'=>'Messages', 'action' => 'sendMessage')) ?>" method="post">
                    <input id="receiver" name="data[Message][receiver]" type="hidden" value="<?php echo $user_id; ?>" />
                    <textarea id="message" name="data[Message][content]" cols="50" rows="10" class="validate[required]" placeholder="Nhập tin nhắn" required></textarea>
                    <input type="submit" class="send" value="Gửi">
                </form>
              </div> 
            </div>
    <?php
          }
          $i++;
        } 
    ?>
  </div>
</div>
<script type="text/javascript">
	$('.tab-links a').on('click', function(e)  {
        var currentAttrValue = $(this).attr('href');
 
        // Show/Hide Tabs
        $('.tab-content ' + currentAttrValue).show().siblings().hide();
 
        $('.list-user-tab li').removeClass('active');
        // Change/remove current tab to active
        $(this).parent('li').addClass('active').siblings().removeClass('active');
        $(this).addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });
    
    $('.list-user-tab li').each(function(){
       if($(this).hasClass('active') && $(this).hasClass('not-view')){
          var id_message = $(this).attr('id');
          updateViewed(id_message);
       } 
    });
    
    $('.list-user-tab li.not-view').on('click', function(e)  {
        var id_message = $(this).attr('id');
        updateViewed(id_message);
    });
    
    function updateViewed(id){
        $.ajax({
            type:"GET",
            async:true,
            url:'<?php echo $this->Html->url(array("controller" => "Messages", "action" => "updateViewed"))?>' + '/' + id,
            dataType: "json",
            success : function(data) {
                if (data.Success){
                    $('#'+id).removeClass('not-view');
                }     
            },
            error : function() {
               
            },
         });
    }
    
</script>