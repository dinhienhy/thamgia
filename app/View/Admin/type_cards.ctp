<h4 class="alert_info">Loại danh thiếp</h4>

<article class="module width_full">
    <header>
        <h3 class="tabs_involved">LOẠI DANH THIẾP</h3>
    </header>

    <div class="tab_container">
        <div id="tab1" class="tab_content">
        <table class="tablesorter" cellspacing="0"> 
        <thead> 
            <tr> 
                <th>Loại danh thiếp</th> 
                <th>Order</th> 
                <th>Class</th>
                <th>Tương tác</th>
            </tr> 
        </thead> 
        <tbody> 
            <?php foreach($data as $type_card){
             ?>
            <tr>
                <td><?php echo $type_card['TypeCard']['name']; ?></td>
                <td><?php echo $type_card['TypeCard']['order']; ?></td>
                <td><?php echo $type_card['TypeCard']['class']; ?></td>
                <td>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Admin', 'action' => 'editTypeCard', $type_card['TypeCard']['id'])); ?>"><input type="image" src="<?php echo $this->Html->url('/'); ?>images/icn_edit.png" title="Chỉnh sửa"></a>
                </td>
            </tr>
            <?php  } ?>
        </tbody> 
        </table>
        </div><!-- end of #tab1 -->

    </div><!-- end of .tab_container -->

    <footer>
        <div class="submit_link">
            <input type="submit" class="alt_btn" onclick="window.location='<?php echo $this->Html->url(array('controller' => 'Admin', 'action' => 'addTypeCard')); ?>'" value="Add">
        </div>
    </footer>
            
</article><!-- end of content manager article -->

