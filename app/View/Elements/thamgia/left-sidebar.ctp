<div id="pt-left-thamgia">
	<a href="#" class="icon-menu-link"><i class="fa fa-bars"></i></a>
	<h1 id="pt-logo"><a href="<?php echo $this->Html->url('/'); ?>">Tham Gia</a></h1>
	<ul class="pt-menu-left">
		<li>
			<a href="<?php echo $this->Html->url('/'); ?>"><i class="fa icon-flag"></i>Sự kiện</a>
		</li>
		<li>
			<a href="<?php echo $this->Html->url(array("controller" => "exchanges", "action" => "index")); ?>"><i class="fa icon-coffee"></i>Teabreak</a>
		</li>
		<li>
			<a href="#"><i class="fa icon-bullhorn"></i>Chợ phiên</a>
		</li>
	</ul>
	<ul class="pt-list-info-thamgia">
		<li>
			<h3><i class="fa icon-square"></i> Thamgia.net là gì ?</h3>
			<p>Là cộng đồng năng động chia sẻ thông tin sự kiện, hội thảo, khuyến mãi, khóa học,... Nơi kết nối và tạo cơ hội kinh doanh. <a href="<?php echo $this->Html->url(array('controller' => 'Home', 'action' => 'introduction')); ?>">Xem tiếp <i class="fa fa-angle-double-right"></i></a></p>
		</li>
		<li>
			<h3><i class="fa icon-credit-card"></i> 1600 Card Visit đã tạo</h3>
		</li>
		<li>
			<h3><i class="fa icon-flag"></i> 9122 sự kiện đã được chia sẻ</h3>
		</li>
	</ul>
	<div class="pt-add-event">
		<h3>Bạn cần quảng bá sự kiện</h3>
		<a <?php  echo $logged_in ? 'onclick="addEvent()"  href="#"' : ' href="#login"' ?> type="button" class="btn btn-lg <?php  echo $logged_in ? '' : 'link-login' ?>"><i class="fa fa-plus-circle"></i></span> Đăng sự kiện mới</a>
	</div>
</div>