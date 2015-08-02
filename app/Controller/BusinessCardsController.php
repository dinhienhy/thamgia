<?php
CakePlugin::load('Uploader');
App::import('Vendor', 'Uploader.Uploader');
class BusinessCardsController extends AppController{
    public $name = "BusinessCards";
    
    
    function beforeFilter(){
        parent::beforeFilter();
        $this->Uploader = new Uploader(array('tempDir' => TMP, 'uploadDir' => FOLDER_UPLOAD_IMAGE_EVENT));
    }
    
    function add(){
        $this->isAuthenticated();
        $this->layout = "business";
        $this->loadModel('TemplateCard');
        $templates = $this->TemplateCard->find('all');
        $this->set('templates', $templates);
        $this->loadModel('Career');
        $careers = $this->Career->find('all');
        $this->set('careers',$careers);
        $this->loadModel('TypeCard');
        $typeCards = $this->TypeCard->find('all',array(
            'order' => array('TypeCard.order')
        ));
        $this->set('typeCards',$typeCards);
        if ($this->request->is('post')){
            $error = null;
            $data = $this->request->data('BusinessCard');
            try{
                $arrCard['BusinessCard'] = array();
                $arrCard['BusinessCard']['user_id'] = $this->_usersUserID();
                $arrCard['BusinessCard']['name'] = $data['name'];
                $arrCard['BusinessCard']['careerid'] = $data['careerid'];
                $arrCard['BusinessCard']['careerid2'] = $data['careerid2'];
                $arrCard['BusinessCard']['name_company'] = $data['name_company'];
                $arrCard['BusinessCard']['address'] = $data['address'];
                $arrCard['BusinessCard']['mobile'] = $data['mobile'];
                $arrCard['BusinessCard']['email'] = $data['email'];
                $arrCard['BusinessCard']['website'] = $data['website'];
                $arrCard['BusinessCard']['facebook'] = $data['facebook'];
                $arrCard['BusinessCard']['linkedin'] = $data['linkedin'];
                $arrCard['BusinessCard']['template_id'] = $data['template_id'];
                $arrCard['BusinessCard']['type_card_id'] = $data['type_card_id'];
                $arrCard['BusinessCard']['position'] = $data['position'];
                $arrCard['BusinessCard']['level'] = 1;
                $arrCard['BusinessCard']['created'] = date(TIME_FORMAT_MYSQL);
                if ($data['avatar_url']['name'] != ''){
                    if ($dataUpload = $this->Uploader->upload($data['avatar_url'], array('overwrite' => true))) {
                        // Upload successful, do whatever
                        $resized_path = $this->Uploader->resize(array('width' => AVATAR_WIDTH, 'height' => AVATAR_HEIGHT));
                        $this->Uploader->delete($dataUpload['path']);
                        $arrCard['BusinessCard']['avatar_url'] = preg_replace('/^\//', '', $resized_path);
                        
                    }else{
                        $error = 'Lỗi upload ảnh!<br />';
                    }
                }
                $this->BusinessCard->save($arrCard);
                
                
            }catch(Exception $ex){
                $this->set('data', $data);
                $this->set('error', $ex->getMessage());
            }
        }
    }
    
    
    function upToVip($id){
        if ($id){
            $this->isAdminAuthenticated();
            $business_card = $this->BusinessCard->findById($id);
            if(isset($business_card)){
                $business_card['BusinessCard']['level'] = 10;
                $this->BusinessCard->save($business_card);
            }
            $this->redirect(array('controller'=>'admin', 'action'=>'businessCards'));    
        }else{
            $this->flash('Business_Card_ID không dúng!');
            $this->redirect(array('controller'=>'admin', 'action'=>'businessCards'));    
        }
    }
    
    
    function downToNormal($id){
        if ($id){
            $this->isAdminAuthenticated();
            $business_card = $this->BusinessCard->findById($id);
            if(isset($business_card)){
                $business_card['BusinessCard']['level'] = 1;
                $this->BusinessCard->save($business_card);
            }
            $this->redirect(array('controller'=>'admin', 'action'=>'businessCardVips'));    
        }else{
            $this->flash('Business_Card_ID không dúng!');
            $this->redirect(array('controller'=>'admin', 'action'=>'businessCardVips'));    
        }
    }
    
    
    function getCardVips($limit = 4, $card_type_id = 0, $user_id = 0){
        $this->autoRender = false;
        $this->loadModel('ShakeHand');
        $shake_hands = array();
        if($user_id != 0){
            $had_shake_hands = $this->ShakeHand->find('all',array(
                'conditions' => array('ShakeHand.user_id' => $user_id),
                'fields' => array(
                    'ShakeHand.business_card_id'
                )
            ));
            if(is_array($had_shake_hands)){
                foreach($had_shake_hands as $had_shake_hand){
                    $shake_hands[] = $had_shake_hand['ShakeHand']['business_card_id'];
                }
            }
        }
        
        $conditions = array();
        $conditions['BusinessCard.level ='] = 10;
        $conditions['BusinessCard.user_id !='] = $user_id;
        if($card_type_id != 0){
            $conditions['BusinessCard.type_card_id'] = $card_type_id;
        }
        if($shake_hands != null){
            $conditions['NOT'] = array('BusinessCard.id' => $shake_hands);
        }
        
        $this->paginate = array(
            'BusinessCard' => array(
                'limit' => $limit,
                'order' => array('BusinessCard.id' => 'desc'),
                'conditions' => $conditions
            )
        );
        $dataPaginate = $this->paginate('BusinessCard');
        $data = array();
        $index = 0;

        foreach($dataPaginate as $card){
            $data[$index] = array();
            $options['conditions'] = array(
                    'Career.id' => $card['BusinessCard']['careerid']
                );
            $this->loadModel('Career');
            $career = $this->Career->find('first', $options);
            $this->loadModel('TypeCard');
            $typeCard = $this->TypeCard->findById($card['BusinessCard']['type_card_id']);
            
            $data[$index]['name'] = $card['BusinessCard']['name'];
            $data[$index]['id'] = $card['BusinessCard']['id'];
            $data[$index]['name_company'] = $card['BusinessCard']['name_company'];
            $data[$index]['mobile'] = $card['BusinessCard']['mobile'];
            $data[$index]['email'] = $card['BusinessCard']['email'];
            $data[$index]['career'] = $career['Career']['name'];
            $data[$index]['template_id'] = $card['BusinessCard']['template_id'];
            $data[$index]['facebook'] = $card['BusinessCard']['facebook'];
            $data[$index]['linkedin'] = $card['BusinessCard']['linkedin'];
            $data[$index]['position'] = $card['BusinessCard']['position'];
            $data[$index]['type_card'] = $typeCard['TypeCard']['name'];
            $data[$index]['avatar_url'] = $card['BusinessCard']['avatar_url'];
            $index++;
        }
        //$this->set('data', $data);
        return $data;
    }
    
    
    function getCards($limit = 16, $card_type_id = 0, $user_id = 0){
        $this->autoRender = false;
        $shake_hands = array();
        if($user_id != 0){
            $this->loadModel('ShakeHand');
            $had_shake_hands = $this->ShakeHand->find('all',array(
                'conditions' => array('ShakeHand.user_id' => $user_id),
                'fields' => array(
                    'ShakeHand.business_card_id'
                )
            ));
            if(is_array($had_shake_hands)){
                foreach($had_shake_hands as $had_shake_hand){
                    $shake_hands[] = $had_shake_hand['ShakeHand']['business_card_id'];
                }
            }
        }
        
        $conditions = array();
        $conditions['BusinessCard.level ='] = 1;
        $conditions['BusinessCard.user_id !='] = $user_id;
        if($card_type_id != 0){
            $conditions['BusinessCard.type_card_id'] = $card_type_id;
        }
        if($shake_hands != null){
            $conditions['NOT'] = array('BusinessCard.id' => $shake_hands);
        }
        
        $this->paginate = array(
            'BusinessCard' => array(
                'limit' => $limit,
                'order' => array('BusinessCard.id' => 'desc'),
                'conditions' => $conditions
            )
        );
        
        $dataPaginate = $this->paginate('BusinessCard');
        $data = array();
        $index = 0;

        foreach($dataPaginate as $card){
            $data[$index] = array();
            $options['conditions'] = array(
                    'Career.id' => $card['BusinessCard']['careerid']
                );
            $this->loadModel('Career');
            $career = $this->Career->find('first', $options);
            $this->loadModel('TypeCard');
            $typeCard = $this->TypeCard->findById($card['BusinessCard']['type_card_id']);
            
            $data[$index]['name'] = $card['BusinessCard']['name'];
            $data[$index]['id'] = $card['BusinessCard']['id'];
            $data[$index]['name_company'] = $card['BusinessCard']['name_company'];
            $data[$index]['mobile'] = $card['BusinessCard']['mobile'];
            $data[$index]['email'] = $card['BusinessCard']['email'];
            $data[$index]['career'] = $career['Career']['name'];
            $data[$index]['template_id'] = $card['BusinessCard']['template_id'];
            $data[$index]['facebook'] = $card['BusinessCard']['facebook'];
            $data[$index]['linkedin'] = $card['BusinessCard']['linkedin'];
            $data[$index]['position'] = $card['BusinessCard']['position'];
            $data[$index]['type_card'] = $typeCard['TypeCard']['name'];
            $data[$index]['avatar_url'] = $card['BusinessCard']['avatar_url'];
            $index++;
        }
        //$this->set('data', $data);
        return $data;
    }
    
    
    function getSearchCardVips($limit = 4, $card_type_id = 0, $user_id = 0, $career, $search=""){
        $this->autoRender = false;
        $this->loadModel('ShakeHand');
        $shake_hands = array();
        if($user_id != 0){
            $had_shake_hands = $this->ShakeHand->find('all',array(
                'conditions' => array('ShakeHand.user_id' => $user_id),
                'fields' => array(
                    'ShakeHand.business_card_id'
                )
            ));
            if(is_array($had_shake_hands)){
                foreach($had_shake_hands as $had_shake_hand){
                    $shake_hands[] = $had_shake_hand['ShakeHand']['business_card_id'];
                }
            }
        }
        
        $conditions = array();
        $conditions['BusinessCard.level ='] = 10;
        $conditions['BusinessCard.user_id !='] = $user_id;
        if($card_type_id != 0){
            $conditions['BusinessCard.type_card_id'] = $card_type_id;
        }
        if($career != 0){
            $conditions['OR'] = array(
                'BusinessCard.careerid' => $career,
                'BusinessCard.careerid2' => $career,
            );
        }
        if($search != ""){
            $conditions['OR'] = array(
                'BusinessCard.name LIKE' => '%'.$search.'%',
                'BusinessCard.name_company LIKE' => '%'.$search.'%',
                'BusinessCard.position LIKE' => '%'.$search.'%',
            );
        }
        if($shake_hands != null){
            $conditions['NOT'] = array('BusinessCard.id' => $shake_hands);
        }
        
        $this->paginate = array(
            'BusinessCard' => array(
                'limit' => $limit,
                'order' => array('BusinessCard.id' => 'desc'),
                'conditions' => $conditions
            )
        );
        $dataPaginate = $this->paginate('BusinessCard');
        $data = array();
        $index = 0;

        foreach($dataPaginate as $card){
            $data[$index] = array();
            $options['conditions'] = array(
                    'Career.id' => $card['BusinessCard']['careerid']
                );
            $this->loadModel('Career');
            $career = $this->Career->find('first', $options);
            $this->loadModel('TypeCard');
            $typeCard = $this->TypeCard->findById($card['BusinessCard']['type_card_id']);
            
            $data[$index]['name'] = $card['BusinessCard']['name'];
            $data[$index]['id'] = $card['BusinessCard']['id'];
            $data[$index]['name_company'] = $card['BusinessCard']['name_company'];
            $data[$index]['mobile'] = $card['BusinessCard']['mobile'];
            $data[$index]['email'] = $card['BusinessCard']['email'];
            $data[$index]['career'] = $career['Career']['name'];
            $data[$index]['template_id'] = $card['BusinessCard']['template_id'];
            $data[$index]['facebook'] = $card['BusinessCard']['facebook'];
            $data[$index]['linkedin'] = $card['BusinessCard']['linkedin'];
            $data[$index]['position'] = $card['BusinessCard']['position'];
            $data[$index]['type_card'] = $typeCard['TypeCard']['name'];
            $data[$index]['avatar_url'] = $card['BusinessCard']['avatar_url'];
            $index++;
        }
        //$this->set('data', $data);
        return $data;
    }
    
    
    function getSearchCards($limit = 16, $card_type_id = 0, $user_id = 0, $career, $search=""){
        $this->autoRender = false;
        $shake_hands = array();
        if($user_id != 0){
            $this->loadModel('ShakeHand');
            $had_shake_hands = $this->ShakeHand->find('all',array(
                'conditions' => array('ShakeHand.user_id' => $user_id),
                'fields' => array(
                    'ShakeHand.business_card_id'
                )
            ));
            if(is_array($had_shake_hands)){
                foreach($had_shake_hands as $had_shake_hand){
                    $shake_hands[] = $had_shake_hand['ShakeHand']['business_card_id'];
                }
            }
        }
        
        $conditions = array();
        $conditions['BusinessCard.level ='] = 1;
        $conditions['BusinessCard.user_id !='] = $user_id;
        if($card_type_id != 0){
            $conditions['BusinessCard.type_card_id'] = $card_type_id;
        }
        if($career != 0){
            $conditions['OR'] = array(
                'BusinessCard.careerid' => $career,
                'BusinessCard.careerid2' => $career,
            );
        }
        if($search != ""){
            $conditions['OR'] = array(
                'BusinessCard.name LIKE' => '%'.$search.'%',
                'BusinessCard.name_company LIKE' => '%'.$search.'%',
                'BusinessCard.position LIKE' => '%'.$search.'%',
            );
        }
        if($shake_hands != null){
            $conditions['NOT'] = array('BusinessCard.id' => $shake_hands);
        }
        
        $this->paginate = array(
            'BusinessCard' => array(
                'limit' => $limit,
                'order' => array('BusinessCard.id' => 'desc'),
                'conditions' => $conditions
            )
        );
        
        $dataPaginate = $this->paginate('BusinessCard');
        $data = array();
        $index = 0;

        foreach($dataPaginate as $card){
            $data[$index] = array();
            $options['conditions'] = array(
                    'Career.id' => $card['BusinessCard']['careerid']
                );
            $this->loadModel('Career');
            $career = $this->Career->find('first', $options);
            $this->loadModel('TypeCard');
            $typeCard = $this->TypeCard->findById($card['BusinessCard']['type_card_id']);
            
            $data[$index]['name'] = $card['BusinessCard']['name'];
            $data[$index]['id'] = $card['BusinessCard']['id'];
            $data[$index]['name_company'] = $card['BusinessCard']['name_company'];
            $data[$index]['mobile'] = $card['BusinessCard']['mobile'];
            $data[$index]['email'] = $card['BusinessCard']['email'];
            $data[$index]['career'] = $career['Career']['name'];
            $data[$index]['template_id'] = $card['BusinessCard']['template_id'];
            $data[$index]['facebook'] = $card['BusinessCard']['facebook'];
            $data[$index]['linkedin'] = $card['BusinessCard']['linkedin'];
            $data[$index]['position'] = $card['BusinessCard']['position'];
            $data[$index]['type_card'] = $typeCard['TypeCard']['name'];
            $data[$index]['avatar_url'] = $card['BusinessCard']['avatar_url'];
            $index++;
        }
        //$this->set('data', $data);
        return $data;
    }
    
    
    function boxCards(){
        $this->isAuthenticated();
        $this->layout = "business";
        $options['joins'] = array(
            array(
                'table' => 'type_cards',
                'alias' => 'TypeCard',
                'type' => 'LEFT',
                'conditions' => array(
                'TypeCard.id = BusinessCard.type_card_id',
                )
            )
        );
        $options['conditions'] = array(
            'BusinessCard.user_id' => $this->_usersUserID(),
            'BusinessCard.level' => 10
        );
        
        $options['fields'] = array(
            'BusinessCard.id',
            'BusinessCard.name',
            'BusinessCard.name_company',
            'BusinessCard.mobile',
            'BusinessCard.email',
            'BusinessCard.template_id',
            'BusinessCard.facebook',
            'BusinessCard.linkedin',
            'BusinessCard.position',
            'BusinessCard.avatar_url',
            'TypeCard.name'
        );
        $my_card_vips = $this->BusinessCard->find('all', $options);
        $this->set('my_card_vips',$my_card_vips);
        
        $options['conditions'] = array(
            'BusinessCard.user_id' => $this->_usersUserID(),
            'BusinessCard.level' => 1
        );
        $my_cards = $this->BusinessCard->find('all', $options);
        $this->set('my_cards',$my_cards);
        
        $this->loadModel('ShakeHand');
        $had_shake_hands = $this->ShakeHand->find('all',array(
            'conditions' => array('ShakeHand.user_id' => $this->_usersUserID()),
            'fields' => array(
                'ShakeHand.business_card_id'
            )
        ));
        $shake_hands = array();
        if(is_array($had_shake_hands)){
            foreach($had_shake_hands as $had_shake_hand){
                $shake_hands[] = $had_shake_hand['ShakeHand']['business_card_id'];
            }
        }
        $count = 0;
        if($shake_hands != null){
            $options['conditions'] = array(
                'BusinessCard.level' => 10,
                'BusinessCard.id IN' => $shake_hands 
            );
            $box_card_vips = $this->BusinessCard->find('all', $options);
            $this->set('box_card_vips',$box_card_vips);
            $count += count($box_card_vips);
            
            $options['conditions'] = array(
                'BusinessCard.level' => 1,
                'BusinessCard.id IN' => $shake_hands 
            );
            $box_cards = $this->BusinessCard->find('all', $options);
            $this->set('box_cards',$box_cards);
            $count += count($box_cards);
        }
        $this->set('count', $count);
    }
    
    
    function myCards(){
        $this->isAuthenticated();
        $this->layout = "business";
        $options['joins'] = array(
            array(
                'table' => 'type_cards',
                'alias' => 'TypeCard',
                'type' => 'LEFT',
                'conditions' => array(
                'TypeCard.id = BusinessCard.type_card_id',
                )
            )
        );
        $options['conditions'] = array(
            'BusinessCard.user_id' => $this->_usersUserID(),
            'BusinessCard.level' => 10
        );
        
        $options['fields'] = array(
            'BusinessCard.id',
            'BusinessCard.name',
            'BusinessCard.name_company',
            'BusinessCard.mobile',
            'BusinessCard.email',
            'BusinessCard.template_id',
            'BusinessCard.facebook',
            'BusinessCard.linkedin',
            'BusinessCard.position',
            'BusinessCard.avatar_url',
            'TypeCard.name'
        );
        $my_card_vips = $this->BusinessCard->find('all', $options);
        $this->set('my_card_vips',$my_card_vips);
        
        $options['conditions'] = array(
            'BusinessCard.user_id' => $this->_usersUserID(),
            'BusinessCard.level' => 1
        );
        $my_cards = $this->BusinessCard->find('all', $options);
        $this->set('my_cards',$my_cards);
        
        $this->loadModel('ShakeHand');
        $had_shake_hands = $this->ShakeHand->find('all',array(
            'conditions' => array('ShakeHand.user_id' => $this->_usersUserID()),
            'fields' => array(
                'ShakeHand.business_card_id'
            )
        ));
        $shake_hands = array();
        if(is_array($had_shake_hands)){
            foreach($had_shake_hands as $had_shake_hand){
                $shake_hands[] = $had_shake_hand['ShakeHand']['business_card_id'];
            }
        }
        $count = 0;
        if($shake_hands != null){
            $options['conditions'] = array(
                'BusinessCard.level' => 10,
                'BusinessCard.id IN' => $shake_hands 
            );
            $box_card_vips = $this->BusinessCard->find('all', $options);
            $this->set('box_card_vips',$box_card_vips);
            $count += count($box_card_vips);
            
            $options['conditions'] = array(
                'BusinessCard.level' => 1,
                'BusinessCard.id IN' => $shake_hands 
            );
            $box_cards = $this->BusinessCard->find('all', $options);
            $this->set('box_cards',$box_cards);
            $count += count($box_cards);
        }
        $this->set('count', $count);
        
    }
    
    
    function getNewCards(){
        $this->autoRender = false;
        $options['limit'] = 4;
        $options['order'] = array('BusinessCard.id' => 'desc');
        $options['fields'] = array('BusinessCard.id', 'BusinessCard.user_id', 'BusinessCard.name', 'BusinessCard.avatar_url', 'BusinessCard.position');
        $data = $this->BusinessCard->find('all', $options);
        return $data;
    }
    
    
    function countYourBoxCard($user_id){
        $this->loadModel('ShakeHand');
        $count = $this->ShakeHand->find('count',array(
            'conditions' => array('ShakeHand.user_id' => $user_id)
        ));
        return $count;
    }
} 
?>