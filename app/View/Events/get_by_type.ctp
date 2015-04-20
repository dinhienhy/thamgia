<div class="pt-upcoming-events">
    <h2 class="title">Sự kiện sắp diễn ra tại <?php echo isset($city_name) ? $city_name : ''; ?>
        <?php echo isset($type_name) ? ' - '.$type_name: '';  ?>
    </h2>
    <?php
        echo $this->element('thamgia/month_navigation');
        echo $this->element('thamgia/list_events',
            array(
                'city_id' => $city_id,
                'user_id' => $users_userid,
                'type_id' => $type_id
            ));
    ?>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#type_<?php echo $type_id; ?>').toggleClass('active');
    });
</script>
