<div class="notification">
    <h2 class="titel">Thông báo</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">Nội Dung</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $item){ ?>
            <tr>
                <td>
                    <a onclick="return viewNotification(this, <?php echo $item['Notification']['id']; ?>);" class="message-box <?php echo $item['Notification']['viewed'] ? 'viewed' : ''; ?>" href="<?php echo $item['Notification']['link']; ?>"><?php echo $item['Notification']['notification']; ?></span></a>
                </td>
                <td>
                    <a class="delete btn btn-danger btn-sm"  onclick="return confirm('Bạn có muốn xóa thông báo này không?');"  href="<?php echo $this->Html->url(array('controller' => 'Notifications', 'action' => 'delete', $users_userid, $item['Notification']['id'])); ?>"><i class="fa fa-times"></i></a> 
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="paging">
    <?php
      echo $this->Paginator->prev(__(''), array('tag' => 'span'));
      echo $this->Paginator->numbers(array('separator'=>'<span>-</span>'));      
      echo $this->Paginator->next(__(''), array('tag' => 'span'));
    ?>
    </div>
</div>