<?php 
    echo $this->Html->script('validationEngine');
    echo $this->Html->script('validationEngine-en');
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#frm_type_card").validationEngine();   
    })
</script>
<article class="module width_full">
    <header><h3>Sửa loại danh thiếp</h3></header>
        <div class="module_content">
            <form id="frm_type_card" name="frm_type_card" method="post" action="<?php echo $this->Html->url(array('controller' => 'Admin', 'action' =>'editTypeCard',$data['id'])) ?>" class="login-subscription">
                <fieldset>
                    <label>Loại danh thiếp *</label>
                    <input name="data[TypeCard][name]" id="name" class="validate[required]" type="text" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>"  />
                </fieldset>
                
                <fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
                    <label>Order *</label>
                    <input type="text" style="width:92%;" value="<?php echo isset($data['order']) ? $data['order'] : '' ?>" id="order" name="data[TypeCard][order]" class="validate[required]" />
                </fieldset>
                <fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
                    <label>Class *</label>
                    <input type="text"  style="width:92%;" id="class" name="data[TypeCard][class]" value="<?php echo isset($data['class']) ? $data['class'] : '' ?>" class="validate[required]" />
                </fieldset>
                <div class="clear"></div>
                <input type="submit" class="alt_btn" value="Cập nhật">
                <div class="clear"></div>
            </form>
        </div>
    <footer>
        <div class="submit_link">
        </div>
    </footer>
</article>