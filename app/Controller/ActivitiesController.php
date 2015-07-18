<?php
class ActivitiesController extends AppController{
    function getActivitesbk(){
        $this->autoRender = false;
        
        $options['joins'] = array(
                array(
                        'table' => 'users',
                        'alias' => 'User',
                        'type' => 'LEFT',
                        'conditions' => array(
                        'User.id = Activity.user_id',
                        )
                ),
                array(
                        'table' => 'events',
                        'alias' => 'Event',
                        'type' => 'LEFT',
                        'conditions' => array(
                        'Event.id = Activity.event_id',
                        )
                ),
                array(
                        'table' => 'daily_coupons',
                        'alias' => 'DailyCoupon',
                        'type' => 'LEFT',
                        'conditions' => array(
                        'DailyCoupon.id = Activity.event_id',
                        )
                ),
                array(
                        'table' => 'cities',
                        'alias' => 'City',
                        'type' => 'LEFT',
                        'conditions' => array(
                        'City.id = Activity.city_id',
                        )
                )
        );
        
        $options['order'] = array(
            'Activity.created DESC'
        );
        $options['fields'] = array(
            'User.id',
            'User.fullname',
            'User.avatar_url',
            'Event.id',
            'DailyCoupon.title',
            'DailyCoupon.id',
            'Event.title',
            'Activity.description',
            'Activity.created',
            'Activity.is_daily_coupon',
            'Activity.city_id',
            'City.id',
            'City.name'
        );
        $options['limit'] = 20;
        $data = $this->Activity->find('all', $options);
        return $data;
    }
    
    
    function getActivites($user_id){
        $this->autoRender = false;
        
        $options['joins'] = array(
                array(
                        'table' => 'users',
                        'alias' => 'User',
                        'type' => 'LEFT',
                        'conditions' => array(
                        'User.id = Activity.user_id',
                        )
                ),
                array(
                        'table' => 'events',
                        'alias' => 'Event',
                        'type' => 'LEFT',
                        'conditions' => array(
                        'Event.id = Activity.event_id',
                        )
                ),
                array(
                        'table' => 'daily_coupons',
                        'alias' => 'DailyCoupon',
                        'type' => 'LEFT',
                        'conditions' => array(
                        'DailyCoupon.id = Activity.event_id',
                        )
                ),
                array(
                        'table' => 'cities',
                        'alias' => 'City',
                        'type' => 'LEFT',
                        'conditions' => array(
                        'City.id = Activity.city_id',
                        )
                ),
                array(
                        'table' => 'thanks_events',
                        'alias' => 'ThanksEvent',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'ThanksEvent.event_id = Activity.event_id',
                            'ThanksEvent.user_id' => $user_id
                        )
                )
        );
        
        $options['order'] = array(
            'Activity.created DESC'
        );
        $options['fields'] = array(
            'User.id',
            'User.fullname',
            'User.avatar_url',
            'Event.id',
            'DailyCoupon.title',
            'DailyCoupon.id',
            'Event.title',
            'Event.image_url', 
            'Event.image_list_url',
            'Event.start',
            'Event.address',
            'Activity.description',
            'Activity.created',
            'Activity.is_daily_coupon',
            'Activity.city_id',
            'City.id',
            'City.name',
            'ThanksEvent.id'
        );
        $options['limit'] = 10;
        $data = $this->Activity->find('all', $options);
        return $data;
    }
}  
?>
