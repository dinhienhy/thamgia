<ul>
    <li>
        <a href="<?php echo $this->Html->url(array("controller" => "Exchanges", "action" => "index")); ?>" <?php echo ($card_type_id==0) ? 'class="active"' :''; ?>>
            <i class="fa fa-th"></i>Trang đầu
        </a>
    </li>
    <?php foreach($typeCards as $typeCard){ ?>
        <li>
            <a id="card_type_<?php echo $typeCard['TypeCard']['id']; ?>" 
                href="<?php echo $this->Html->url(array('controller' => 'Exchanges', 
                                            'action' => 'getByType',
                                            'slug_type' => Link::seoTitle($typeCard['TypeCard']['name']),
                                            'card_type_id' => $typeCard['TypeCard']['id'] )); ?>"
            <?php echo ($card_type_id == $typeCard['TypeCard']['id']) ? 'class="active"' : ''; ?>>
                <i class="fa fa-th"></i>
                <?php echo $typeCard['TypeCard']['name']; ?> 
            </a>
        </li>
    <?php } ?>
</ul>