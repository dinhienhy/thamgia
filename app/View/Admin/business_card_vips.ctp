<h4 class="alert_info">Danh thiếp VIP</h4>

<article class="module width_full">
    <header>
        <h3 class="tabs_involved">DANH THIẾP VIP</h3>
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
            <?php foreach($data as $card_vip){
             ?>
            <tr>
                <td><?php echo $card_vip['name']; ?></td>
                <td><?php echo $card_vip['name_company']; ?></td>
                <td><?php echo $card_vip['mobile']; ?></td>
                <td><?php echo $card_vip['email']; ?></td>
                <td><?php echo $card_vip['career']; ?></td>
                <td>
                    <a href="<?php echo $this->Html->url(array('controller' => 'BusinessCards', 'action' => 'downToNormal', $card_vip['id'])); ?>"><input type="image" src="<?php echo $this->Html->url('/'); ?>images/icn_logout.png" title="Trở thành danh thiếp bình thường"></a>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Admin', 'action' => 'editCard', $card_vip['id'],1)); ?>"><input type="image" src="<?php echo $this->Html->url('/'); ?>images/icn_edit.png" title="Chỉnh sửa"></a>
                    <a onclick="return confirm('Bạn có chắc là muốn xóa danh thiếp này?');" href="<?php echo $this->Html->url(array('controller' => 'Admin', 'action' => 'deleteCard', $card_vip['id'],1)); ?>"><input type="image" src="<?php echo $this->Html->url('/'); ?>images/icn_trash.png" title="Xóa"></a>
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
