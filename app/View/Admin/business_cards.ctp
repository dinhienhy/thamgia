<h4 class="alert_info">Danh thiếp</h4>

<article class="module width_full">
    <header>
        <h3 class="tabs_involved">DANH THIẾP</h3>
    </header>

    <div class="tab_container">
        <div id="tab1" class="tab_content">
        <table class="tablesorter" cellspacing="0"> 
        <thead> 
            <tr> 
                <th>Họ và tên</th> 
                <th>Công ty</th> 
                <th>Số điện thoại</th> 
                <th>Email</th> 
                <th>Ngành nghề</th>
                <th>Tương tác</th>
            </tr> 
        </thead> 
        <tbody> 
            <?php foreach($data as $card){
             ?>
            <tr>
                <td><?php echo $card['name']; ?></td>
                <td><?php echo $card['name_company']; ?></td>
                <td><?php echo $card['mobile']; ?></td>
                <td><?php echo $card['email']; ?></td>
                <td><?php echo $card['career']; ?></td>
                <td>
                    <a href="<?php echo $this->Html->url(array('controller' => 'BusinessCards', 'action' => 'upToVip', $card['id'])); ?>"><input type="image" src="<?php echo $this->Html->url('/'); ?>images/icn_alert_success.png" title="Lên danh thiếp VIP"></a>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Admin', 'action' => 'editCard', $card['id'])); ?>"><input type="image" src="<?php echo $this->Html->url('/'); ?>images/icn_edit.png" title="Chỉnh sửa"></a>
                    <a onclick="return confirm('Bạn có chắc là muốn xóa danh thiếp này?');" href="<?php echo $this->Html->url(array('controller' => 'Admin', 'action' => 'deleteCard', $card['id'])); ?>"><input type="image" src="<?php echo $this->Html->url('/'); ?>images/icn_trash.png" title="Xóa"></a>
                </td>
            </tr>
            <?php  } ?>
        </tbody> 
        </table>
        </div><!-- end of #tab1 -->

    </div><!-- end of .tab_container -->

    <footer>
    </footer>
            
</article><!-- end of content manager article -->

<div class="paging">
<?php
  echo $this->Paginator->prev(__(''), array('tag' => 'span'));
  echo $this->Paginator->numbers(array('separator'=>'<span>-</span>'));      
  echo $this->Paginator->next(__(''), array('tag' => 'span'));
?>
</div>
