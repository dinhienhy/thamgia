<ul>
    <li>
        <a href="<?php echo $this->Html->url(array("controller" => "Exchanges", "action" => "index")); ?>" <?php echo ($card_type_id==0) ? 'class="active"' :''; ?>>
            <i class="fa fa-th"></i>Trang đầu
            <span><?php echo $total_business_card; ?></span>
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
                <span>
                    <?php 
                        switch($typeCard['TypeCard']['class']) {
                            case 'khuvuctochuc':
                                echo $khuvuctochuc;
                                break;
                            case 'amthanhanhsang':
                                echo $amthanhanhsang;
                                break;
                            case 'tuvansukien':
                                echo $tuvansukien;
                                break;
                            case 'thuetrangphuc':
                                echo $thuetrangphuc;
                                break;
                            case 'trangtrisankhau':
                                echo $trangtrisankhau;
                                break;
                            case 'dienvienmua':
                                echo $dienvienmua;
                                break;
                            case 'trangphucbieudien':
                                echo $trangphucbieudien;
                                break;
                            case 'dichvuvanchuyen':
                                echo $dichvuvanchuyen;
                                break;
                            case 'sanbai':
                                echo $sanbai;
                                break;
                            default:
                                echo "0";
                                break;
                        }
                    ?>
                </span>
            </a>
        </li>
    <?php } ?>
</ul>