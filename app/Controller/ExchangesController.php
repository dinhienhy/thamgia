<?php
class ExchangesController extends AppController{
    
    function beforeFilter(){
        parent::beforeFilter();
        $this->setTotalBusinessCardType();
    }
    
    
    function setTotalBusinessCardType(){
         // get total business card of type
        $this->loadModel('TypeCard');
        $this->loadModel('BusinessCard');
        $typeCards = $this->TypeCard->find('all',array(
            'order' => array('TypeCard.order'),
            'fields' => array(
                'TypeCard.id',
                'TypeCard.class',
            )
        ));
        $options['conditions'] = array();
        if(!empty($typeCards)){
            foreach($typeCards as $typeCard){
                $options['conditions']['BusinessCard.type_card_id'] = $typeCard['TypeCard']['id'];
                $this->set($typeCard['TypeCard']['class'], $this->BusinessCard->find('count', $options));
            }
        }
        $this->set('total_business_card', $this->BusinessCard->find('count'));
        
        $check_exist_card = $this->BusinessCard->find('first',array(
            'conditions' => array(
                'BusinessCard.user_id' => $this->_usersUserID()
            )
        ));
        if(!empty($check_exist_card)){
            $this->set('have_card' , true);
        }
        else{
            $this->set('have_card' , false);
        }
    }
    
    
    function index(){
        $this->layout = "business";
        $this->loadModel('TypeCard');
        $typeCards = $this->TypeCard->find('all',array(
            'order' => array('TypeCard.order')
        ));
        $this->loadModel('Career');
        $careers = $this->Career->find('all');
        $this->set('careers',$careers);
        $this->set('typeCards', $typeCards);
    }
    
    
    function getByType($slug_type ,$card_type_id){
        $this->layout = "business";
        $this->loadModel('TypeCard');
        $typeCards = $this->TypeCard->find('all',array(
            'order' => array('TypeCard.order')
        ));
        $this->set('card_type_id', $card_type_id);
        $this->set('typeCards', $typeCards);
    }
    
    
    function search(){
        $this->layout = "business";
        $this->loadModel('TypeCard');
        $typeCards = $this->TypeCard->find('all',array(
            'order' => array('TypeCard.order')
        ));
        $this->loadModel('Career');
        $careers = $this->Career->find('all');
        $this->set('careers',$careers);
        $this->set('typeCards', $typeCards);
        $this->set('search',$this->request->query('search'));
        $this->set('type_card_id',$this->request->query('type_card'));
        $this->set('career',$this->request->query('career'));
    }
    
    
    function shake_hand1(){
        $this->autoRender = false;
        $data = array();
        if ($this->request->is('post')){
            $shake_hand = array();
            $shake_hand['ShakeHand']['business_card_id'] = $_POST['card_id'];
            $shake_hand['ShakeHand']['user_id'] = $this->_usersUserID();
            $shake_hand['ShakeHand']['created'] = date(TIME_FORMAT_MYSQL);
            $this->loadModel('ShakeHand');
            $this->ShakeHand->save($shake_hand);
            $data['Susscess'] = true;
        }
        else{
            $data['Susscess'] = false;
        }
        $this->RequestHandler->respondAs('json');
        echo json_encode($data);
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
            $this->loadModel('BusinessCard');
            $business_card = $this->BusinessCard->findById($data['card_id']);
            $this->sendNotificationRequest($business_card['BusinessCard']['user_id'], $this->_usersName(), $this->_usersAvatar());
            $this->loadModel('ShakeHand');
            $this->ShakeHand->save($shakeHand);
        }
        $this->Session->setFlash(__('Bạn đã gửi yêu cầu bắt tay thành công!', true));
        $this->redirect(env('HTTP_REFERER'));
    }
    
    
    function sendNotificationRequest($user_id, $sender_name, $image_url){
        $this->autoRender = false;
        $this->loadModel('Notification');
        $linkNotification = Router::url(array(
                                        "controller"=>"ShakeHands", 
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