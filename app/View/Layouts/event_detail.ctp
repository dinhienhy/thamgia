<?php echo $this->element('thamgia/layout_header'); ?>
<body>
    <?php //echo $this->element('thamgia/footer'); ?>
    <?php echo $this->element('thamgia/left-sidebar'); ?>
    <div id="pt-wrapper">
        <?php echo $this->element('thamgia/new-header'); ?>
        <div id="pt-content-container">
			<div class="container-fluid">
                <?php echo $this->element('thamgia/menu'); ?>
                <?php echo $this->element('thamgia/new-navigation'); ?>
                <div class="pt-event-detail">
					<div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <?php echo $this->Session->flash(); ?>
                            <?php echo $this->fetch('content'); ?>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
							<?php
                                if(isset($hasEvent)){
                                    echo $this->element('thamgia/new-event_summary',
                                        array(
                                            'event_id' => $data['id'],
                                            'totalParticipation' => $totalParticipation,
                                            'participated'=>$participated,
                                            'user_name'=>$data['user_name'],
                                            'timeCountDown'=>$timeCountDown,
                                            'owner_id'=> $data['owner_id'],
                                            'eventStatus'=>$eventStatus,
                                            'is_daily_coupon' => $data['is_daily_coupon'],
                                            'avatar_url' => $data['avatar_url'],
                                            'created' => $data['created'],
                                            'thanks' => $data['thanks']
                                        )
                                    );
                                }
                            ?>
                            <?php
                                echo $this->element('thamgia/new-invitation',
                                                array('event_id' => $data['id'])
                                            ); 
                            ?>
                            <?php
                                echo $this->element('thamgia/new-import_contact',
                                                array('event_id' => $data['id'],
                                                      'event_address' => $data['address'],
                                                      'event_title' => $data['title']
                                                )
                                            ); 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->element('thamgia/new-footer'); ?>
    </div>
    <?php //echo $this->element('sql_dump'); ?>
        
</body>
</html>
