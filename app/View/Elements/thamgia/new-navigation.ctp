<?php $highlights = $this->requestAction(array('controller' => 'Highlights', 'action' => 'getHighlights'));  ?>
<div class="pt-sponsored-events">
	<h2 class="title">Sự kiện được tài trợ
        <a href="<?php echo $this->Html->url(array('controller' => 'Home', 'action' => 'advertisement')); ?>">Xem chương trình tài trợ</a>
    </h2>
	<div class="block row">
        <?php foreach($highlights as $highlight){ 
            $startDate = new DateTime($highlight['Highlight']['start_event']);
        ?>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<div class="content-block">
				<div class="img">
					<img src="<?php echo $this->Html->url('/'). ($highlight['Highlight']['image_url'] != '' ? $highlight['Highlight']['image_url'] : HIGHLIGHT_NO_IMG_URL); ?>" alt="" />
                    <?php if($highlight['Highlight']['start_event'] != ''){ ?>
                        <div class="times">
    						<strong><?php echo $startDate->format('d'); ?></strong>
    						<span>THÁNG <?php echo $startDate->format('m'); ?></span>
                        </div>
                    <?php } ?>
				</div>
				<h3 class="title"><a href="<?php echo $highlight['Highlight']['event_url']?>"><?php echo $highlight['Highlight']['title']; ?></a></h3>
				<p>Xem chương trình tài trợ Xem chương trình tài trợ</p>
			</div>
		</div>
        <?php } ?>
	</div>
</div>	<!--   Sự kiện được tài trợ  -->