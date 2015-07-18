<?php
class ExchangesController extends AppController{
    
    function beforeFilter(){
        parent::beforeFilter();
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