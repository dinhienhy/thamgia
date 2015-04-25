<?php echo $this->element('thamgia/layout_header'); ?>
<body>
    <?php echo $this->element('thamgia/left-sidebar'); ?>
    <div id="pt-wrapper">
        <?php echo $this->element('thamgia/new-header'); ?>
        <div id="pt-content-container">
			<div class="container-fluid">
                <?php echo $this->element('thamgia/menu'); ?>
                <?php echo $this->element('thamgia/new-navigation'); ?>
                <div class="pt-notification">
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->fetch('content'); ?>
                </div>
            </div>
        </div>
        <?php echo $this->element('thamgia/new-footer'); ?>
    </div>
    <?php //echo $this->element('sql_dump'); ?>
        
</body>
</html>
