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
            $shakeHand['ShakeHand']['created'] = date(TIME_FORMAT_MYSQL);
            $this->loadModel('ShakeHand');
            $this->ShakeHand->save($shakeHand);
            
        }
        $this->redirect(env('HTTP_REFERER'));
    }
    
} 
?>