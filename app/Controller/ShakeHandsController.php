<?php
class ShakeHandsController extends AppController{
    
    function beforeFilter(){
        parent::beforeFilter();
    }
    
    
    function index(){
        $this->isAuthenticated();
        $this->layout = "business";
        $this->loadModel('BusinessCard');
        $this->loadModel('ShakeHand');
        $this->loadModel('TypeCard');
        $this->loadModel('User');
        $my_card = $this->BusinessCard->find('first',array(
            'conditions' => array('BusinessCard.user_id' => $this->_usersUserID()),
            'fields' => array(
                'BusinessCard.id'
            )
        ));
        $data = array();
        if(!empty($my_card)){
            $requests = $this->ShakeHand->find('all',array(
                'conditions' => array(
                    'ShakeHand.business_card_id' => $my_card['BusinessCard']['id'],
                    'ShakeHand.status' => 0,
                ),
                'fields' => array(
                    'ShakeHand.user_id'
                ),
                'order' => array('ShakeHand.created')
            ));
            if(!empty($requests)){
                $index = 0;
                foreach ( $requests as $request){
                    $data[$index] = array();
                    $card = $this->BusinessCard->findByUserId($request['ShakeHand']['user_id']);
                    if(!empty($card)){
                        $data[$index]['business_card_id'] = $card['BusinessCard']['id'];
                        $data[$index]['name'] = $card['BusinessCard']['name'];
                        $data[$index]['position'] = $card['BusinessCard']['position'];
                        $data[$index]['name_company'] = $card['BusinessCard']['name_company'];
                        $type_card = $this->TypeCard->findById($card['BusinessCard']['type_card_id']);
                        $data[$index]['type_card'] = $type_card['TypeCard']['name'];
                        $data[$index]['email'] = $card['BusinessCard']['email'];
                        $data[$index]['mobile'] = $card['BusinessCard']['mobile'];
                        $data[$index]['facebook'] = $card['BusinessCard']['facebook'];
                        $data[$index]['linkedin'] = $card['BusinessCard']['linkedin'];
                        $data[$index]['user_id'] = $card['BusinessCard']['user_id'];
                        $data[$index]['fullname'] = "";
                        $data[$index]['avatar_url'] = $card['BusinessCard']['avatar_url'];
                        $data[$index]['template_id'] = $card['BusinessCard']['template_id'];
                    }else{
                        $user = $this->User->findById($request['ShakeHand']['user_id']);
                        
                        $data[$index]['business_card_id'] = null;
                        $data[$index]['name'] = null;
                        $data[$index]['position'] = null;
                        $data[$index]['name_company'] = null;
                        $data[$index]['type_card'] = null;
                        $data[$index]['email'] = $user['User']['email'];
                        $data[$index]['mobile'] = null;
                        $data[$index]['facebook'] = null;
                        $data[$index]['linkedin'] = null;
                        $data[$index]['user_id'] = $request['ShakeHand']['user_id'];
                        $data[$index]['fullname'] = $user['User']['fullname'];
                        $data[$index]['avatar_url'] = $user['User']['avatar_url'];
                    }
                    $index++;
                }
            }
        }
        
        
        $this->set('data', $data);
    }
    
    
    function shake_hand(){
        $this->isAuthenticated();
        $this->autoRender = false;
        if ($this->request->is('post')){
            $data = $this->request->data('ShakeHand');
            $shakeHand['ShakeHand'] = array();
            $shakeHand['ShakeHand']['user_id'] = $this->_usersUserID();
            $shakeHand['ShakeHand']['business_card_id'] = $data['card_id'];
            $shakeHand['ShakeHand']['message'] = $data['message'];
            $shakeHand['ShakeHand']['status'] = 0;
            $shakeHand['ShakeHand']['created'] = date(TIME_FORMAT_MYSQL);
            $this->loadModel('ShakeHand');
            
            $this->loadModel('BusinessCard');
            $business_card = $this->BusinessCard->findById($data['card_id']);
            $this->sendNotificationRequest($business_card['BusinessCard']['user_id'], $this->_usersName(), $this->_usersAvatar());
            $this->ShakeHand->save($shakeHand);
        }
        $this->Session->setFlash(__('Bạn đã gửi yêu cầu bắt tay thành công!', true));
        $this->redirect(env('HTTP_REFERER'));
    }
    
    
    function sendNotificationRequest($user_id, $sender_name, $image_url){
        $this->autoRender = false;
        $this->loadModel('Notification');
        $linkNotification = Router::url(array(
                                        "controller"=>"ShakeHand", 
                                        "action"=> "index"));
                                        
        $recordNotification['Notification'] = array();
        $recordNotification['Notification']['link'] = $linkNotification;
        $recordNotification['Notification']['notification'] = '<strong>'. $sender_name . '</strong> vừa gởi yêu cầu bắt tay đến bạn';
        $recordNotification['Notification']['image_url'] = $image_url != null ? $image_url : NO_IMG_URL;
        $recordNotification['Notification']['user_id'] = $user_id;
        $recordNotification['Notification']['viewed'] = false;
        $recordNotification['Notification']['created'] = date(TIME_FORMAT_MYSQL);
        $this->Notification->saveAll($recordNotification);    
    }
    
} 
?>