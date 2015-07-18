<?php $highlights = $this->requestAction(array('controller' => 'Highlights', 'action' => 'getHighlights'));  ?>
<?php $count = 1; ?>
<div class="pt-sponsored-events-01">
	<h2 class="title">Sự kiện được tài trợ</h2>
    <?php foreach($highlights as $highlight){ 
        if($count != 4){
    ?>
	<div class="content-block">
		<div class="img">
			<img src="<?php echo $this->Html->url('/'). ($highlight['Highlight']['image_url'] != '' ? $highlight['Highlight']['image_url'] : HIGHLIGHT_NO_IMG_URL); ?>" alt="">
		</div>
		<h3 class="title">
            <a href="<?php echo $highlight['Highlight']['event_url']?>">
                <?php echo $highlight['Highlight']['title']; ?>
            </a>
        </h3>
		<p>Xem chương trình tài trợ Xem chương trình tài trợ</p>
	</div>
    <?php } $count += 1; ?>
    <?php } ?>
</div>