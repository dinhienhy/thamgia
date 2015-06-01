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
								<span>Sự kiện đã đăng</span>
								<strong><?php echo str_pad($userInformation['count_added_events'], 2, '0', STR_PAD_LEFT); ?></strong>
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
                                <th>Mã Sự Kiện</th>
                                <th>Sự Kiện</th>
                            <?php if ($owner){ ?>
                                <th>Tình trạng</th>
                            <?php } ?>
                                <th>Đăng lúc</th>
                            <?php if ($owner){ ?>
                                <th>Đã tham gia</th>
                                <th>Tác vụ</th>
                            <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data as $event){ ?>
                            <tr>
                                <td><?php echo $event['code']; ?></td>
                                <td>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'Events', 'action' => 'detail', 'slug' => Link::seoTitle($event['title']), 'id' => $event['id'])); ?>" target="_blank" ><?php echo $event['title'] ?></a>
                                </td>
                                <?php if ($owner){ ?>
                                    <td><?php echo $event['approved']; ?></td>
                                <?php } ?>
                                <td>
                                    <?php echo $event['created']; ?>
                                </td>
                                <?php if ($owner){ ?>
                                <td>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'Participations', 'action' => 'participationsOfEvent', $event['id'])) ?>"><p><span class="text-align"><?php echo $event['members']; ?> Thành viên  </span></p></a>
                                </td>
                                <td>
                                    <a title="Chỉnh sửa" href="<?php echo $this->Html->url(array('controller' => 'Events', 'action' => 'edit', $event['id'])); ?>" class="notes"><i class="fa fa-pencil-square"></i> </a>|
                                    <a title="Xóa" onclick="return confirm('Bạn có chắc là muốn xóa sự kiện này?');"  href="<?php echo $this->Html->url(array('controller' => 'Events', 'action' => 'delete', $event['id'])); ?>" class="deleted"> <i class="fa fa-times-circle"></i></a>
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


