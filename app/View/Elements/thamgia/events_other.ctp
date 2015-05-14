<?php
    $city_id = isset($city_id) ? $city_id : DEFAULT_CITY_ID;
    $data = $this->requestAction(array('controller' => 'Events', 'action' => 'getEventsOther', $city_id, $type_id, $event_id));
?>
<?php if(!empty($data)){ ?>
<a href="#" class="prev"><i class="fa fa-chevron-left"></i></a>
<div class="block-carousel">
    <div class="carousel">
        <ul>
            <?php
                $index=1; 
                foreach($data as $item){
                    $url_detail =  $this->Html->url(array('controller' => 'Events', 
                                                    'action'=>'detail',
                                                    'slug'=>Link::seoTitle($item['Event']['title']),
                                                    'id' =>$item['Event']['id'])); 
            ?>
                <li <?php if($index == 1) echo 'class="active"' ?>>
                    <a href="<?php echo $url_detail;?>">
                        <h3 class="title">
                            <?php echo $item['Event']['title']; ?>
                        </h3>
                        <span><?php echo $item['Event']['start']; ?></span>
                    </a>
                </li>
            <?php
                $index++; 
            } 
            ?>
        </ul>
    </div>
</div>
<a href="#" class="next"><i class="fa fa-chevron-right"></i></i></a>
<?php } ?>