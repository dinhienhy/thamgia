<?php 
    $userInformation = $this->requestAction(array('controller' => 'Users', 'action' => 'getUserInformation', $user_id)); 
?>
<div class="row">
    <div class="col-lg-4 col-lg-offset-4 col-md-offset-4 col-md-4 col-sm-12 col-xs-12">
        <?php 
            echo $this->element('thamgia/personal_information',
            array(
                'user_id' => $user_id,
                'owner' => $owner
            )); 
        ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
        <div class="pt-notification-right ">
			<div class="pt-exchange">
				<div class="pt-exchange-menu">
                    <ul>
						<li>
							<a href="#" class="active">
								<span>Sự kiện đã tham gia</span>
								<strong><?php echo str_pad($userInformation['count_participated_events'], 2, '0', STR_PAD_LEFT); ?></strong>
							</a> 
						</li>
                    </ul>
                </div>
            </div>
            <div class="pt-list-event">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Mã sự kiện</th>
                                <th>Sự kiện</th>
                                <th>Bắt đầu</th>
                                <th>Kết thúc</th>
                                <th>Tham gia lúc</th>
                            <?php if ($owner){ ?>
                                <th>Tương tác</th>
                            <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data as $participation){ ?>
                            <tr>
                                <td><?php echo $participation['code']; ?></td>
                                <td>
                                    <?php if ($owner){ ?>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'Events', 'action' => 'detail', 'slug' => Link::seoTitle($participation['title']) , "id" => $participation['event_id'])); ?>" target="_blank" ><?php echo $participation['title'] ?></a>
                                    <?php }else{ ?>
                                    <a href="#" ><?php echo $participation['title'] ?></a>
                                    <?php } ?>
                                </td>
                                <td><?php echo $participation['start']; ?></td>
                                <td><?php echo $participation['end']; ?></td>
                                <td><?php echo $participation['created']; ?></td>
                                <?php if ($owner){ ?>
                                <td>
                                    <a class="delete" onclick="return confirm('Bạn có chắc là muốn xóa đăng ký sự kiện này?');"  href="<?php echo $this->Html->url(array('controller' => 'Participations', 'action' => 'delete',$users_userid ,$participation['event_id'])); ?>"><img src="<?php echo $this->Html->url('/')?>images/icn_trash.png" /></a>
                                </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="paging">
                   <?php
                      echo $this->Paginator->prev(__(''), array('tag' => 'span'));
                      echo $this->Paginator->numbers(array('separator'=>'<span>-</span>'));      
                      echo $this->Paginator->next(__(''), array('tag' => 'span'));
                   ?>
                </div>
            </div>
        </div>
    </div>
</div>

