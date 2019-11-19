<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class UsersController extends Controller{
    
    public $layout = 'login';
    
    public function index(){
       
        $this->loadModel('User');
        if(!$this->Session->isLogged()&& isset($_COOKIE['remember'])){
            $user = $this->User->findFirst(array(
               'conditions' => array('id' => $this->User->connectFromcookie())
            ));
           $this->Session->write('User',$user);
           $this->Session->setFlash('Vous etes maintenant connecté'); 
        }
        
        if($this->Session->isLogged()){
            if($this->Session->user('role') == 'A'){
                $this->redirect('gestionsu');
            }else{
                $this->redirect('member');
            }
        }else{
            $perPage = 50;
            $this->loadModel('Game');
            $d['games'] = $this->Game->find(array(
                'limit' => ($perPage*($this->request->page -1)).','.$perPage
                ));
                $d['total'] = $this->Game->findCount();
                $d['page'] = ceil($d['total']/ $perPage);
                $this->set($d);
            }
    }
        
    
    
    
    /**
     * login
     */
    function login(){
        
        if($this->request->data){
            $data = $this->request->data;
            $this->loadModel('User');
            $user = $this->User->findFirst(array(
                'conditions' => array('login' => $data->login )
            ));
           
            if(!empty($user)){
                 if(password_verify($data->password, $user->password)&&!empty($user->confirmed_at)){
                    $this->Session->write('User',$user);
                        if($data->remember){
                            $this->User->remember($user->id);
                            $this->Session->setFlash('Vous etes maintenant connecté');
                    }
                }
            }
            $this->request->data->password = '';
            
        }
        $this->loadModel('User');
        if(!$this->Session->isLogged()&& isset($_COOKIE['remember'])){
            $user = $this->User->findFirst(array(
               'conditions' => array('id' => $this->User->connectFromcookie())
            ));
           $this->Session->write('User',$user);
           $this->Session->setFlash('Vous etes maintenant connecté'); 
        }
        
        if($this->Session->isLogged()){
            if($this->Session->user('role') == 'A'){
                $this->redirect('gestionsu');
            }else{
                $this->redirect('member');
            }
        }else{
            $perPage = 50;
            $this->loadModel('Game');
            $d['games'] = $this->Game->find(array(
                'limit' => ($perPage*($this->request->page -1)).','.$perPage
                ));
                $d['total'] = $this->Game->findCount();
                $d['page'] = ceil($d['total']/ $perPage);
                $this->set($d);
            }
    }
    /**
     * logout
     */
    function logout(){
       
        setcookie('remember',NULL,-1);
        unset($_SESSION['User']);
        $this->redirect('lgt.php');
    }
    
    /**
     * creation d'un compte
     */
    function register(){
        
        $this->loadModel('User');
        if($this->request->data){
            $this->User->validate = array(
                    
                    'login' => array(
                            'rule' => 'isUnique',
                            'message' => 'Identifiant deja pris'
                    ),
                    'password' => array(
                            'rule' => '([a-z0-9]{8,}+)',
                            'message' => 'Vous devez rentrer un mot de passe de 8 caracteres minimum' 
                    ),
                    'conf_password' => array(
                            'rule' => 'isSimilar',
                            'message' => 'Vous devez rentrer le meme mot de passe' 
                    ),
                    'email' => array(
                            'rule' => '(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))',
                            'message' => 'Vous devez rentrer un mail valide' 
                    ),
                    'email' => array(
                            'rule' => 'isUnique',
                            'message' => 'Cet e-mail est déjà pris' 
                    )
        
    );
            if($this->User->validates($this->request->data)){
                $d=array();
                foreach($this->request->data as $k=>$v){if($k!='conf_password'){
                    $d[$k]=$v;
                }}
                $d['password'] = password_hash($d['password'], PASSWORD_BCRYPT);
                $token = Functions::random(60);
                $d['confirmation_token'] = $token;
                $this->User->save($d);
                $user_id= $this->User->db->lastInsertId();
                $message_txt="Afin de completer votre inscription, merci de cliquer sur ce lien : \n\n http://webfld.ddns.net/users/confirm/".$user_id."/".$token."";
                $message_html="<html><head></head><body><b>Bonjour</b>,<p>Afin de completer votre inscription, merci de cliquer sur ce lien :</p><p><a href=\"http://webfld.ddns.net/users/confirm/".$user_id."/".$token."\">Cliquez ici</a></p></body></html>";
                $this->Mail->create($d['email'], 'collection','fld46@wanadoo.fr','Confirmation de votre inscription', $message_txt, $message_html);
                $this->Session->setFlash('Une demande de confirmation vous a été envoyé');
                $this->redirect('');
            }else{
                $this->Session->setFlash('Merci de corriger vos informations','danger');
            }
            
        }
        
    }
    /**
     * Permet de confirmer un compte
     */
    function confirm(){
        $this->loadModel('User');
        
        If((count($this->request->params))==2){
            $id = $this->request->params[0];
            $token = $this->request->params[1];
            $user = $this->User->findFirst(array(
                'conditions' => array(
                    'id'=> $id,
                    'confirmation_token' => $token
                )));
            if($user){
                $update=array();
                           
                $user->confirmation_token = NULL;      
                $user->confirmed_at = date('Y-m-d H:i:s');
                    
                Functions::debug($update);
                $this->User->save($user);
                //$this->User->db->query('UPDATE users SET confirmation_token=NULL,confirmed_at=NOW() WHERE id='.$update['id'] );
                $this->Session->setFlash('Votre compte est bien confirmé');
                $this->Session->write('User',$user);
                                 
            }else{
                $this->Session->setFlash('Données fausses ou obseletes','danger');
            }
                //$db->query('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?',[$user_id]);
                //$this->session->write('auth', $user);
        }
        $this->redirect('');
        
        
    }
    
    /**
     * Envoie du mail quand le mot de passe est perdu
     */
    public function perdu(){
        
        $this->loadModel('User');
        if($this->request->data){
           $this->User->validate = array(                    
                   
                    'email' => array(
                            'rule' => 'Exist',
                            'message' => 'Cet e-mail n\'est pas inscrit' 
                    ));
            if($this->User->validates($this->request->data)){
                if($this->User->findFirst((array('conditions' => array('email'=> $this->request->data->email))))){
                    $d=array();
                    $user= $this->User->findFirst((array('conditions' => array('email'=> $this->request->data->email))));
                    foreach($user as $k=>$v){
                        if($k=='reset_token'){
                        $d[$k] = Functions::random(60);
                    }elseif($k=='reset_at'){
                        $d[$k] = date('Y-m-d H:i:s');
                    }else{
                        $d[$k] = $v;
                    }}
                    $user->reset_token = Functions::random(60);
                    $user->reset_at = date('Y-m-d H:i:s');
                    //Functions::debug($user);
                    $this->User->save($user);
                    $message_txt="Afin de réinitialiser votre mot de passe merci de cliquer sur ce lien : \n\n http://webfldddns.net/users/reset/".$d['id']."/".$d['reset_token']."";
                    $message_html="<html><head></head><body><b>Bonjour</b>,<p>Afin de réinitialiser votre mot de passe merci de cliquer sur ce lien :</p><p><a href=\"http://webfld.ddns.net/users/reset/".$d['id']."/".$d['reset_token']."\">Cliquez ici</a></p></body></html>";
                    $this->Mail->create($user->email, 'collection','fld46@wanadoo.fr','Réinitiatilisation de votre mot de passe', $message_txt, $message_html);
                    $this->Session->setFlash('Une demande de confirmation vous a été envoyé');
            
                }else{
                    $this->Session->setFlash('Merci de corriger vos informations','danger');
                }
            $this->redirect('');    
            }
        }
    }
    
    public function reset(){
        $this->loadModel('User');
        $this->User->validate = array(                    
                   
                    'password' => array(
                            'rule' => '([a-z0-9]{8,}+)',
                            'message' => 'Vous devez rentrer un mot de passe de 8 caracteres minimum' 
                    ),
                    'conf_password' => array(
                            'rule' => 'isSimilar',
                            'message' => 'Vous devez rentrer le meme mot de passe' 
                    ));
        If((count($this->request->params))==2){
            $id = $this->request->params[0];
            $reset_token = $this->request->params[1];
            $user = $this->User->findFirst(array(
                'conditions' => array(
                    'id'=> $id,
                    'reset_token' => $reset_token
                    
                ),
                'conditionsspec' => array(
                   'temps' => 'reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)'
                )));
            
            $this->set('id',$user->id);
            $this->set('reset_token',$user->reset_token);
            
        if($user){
            if($this->request->data){
                if($this->User->validates($this->request->data)){
                    $password = password_hash($this->request->data->password, PASSWORD_BCRYPT);
                    $user->password = $password;
                    $this->User->save($user);
                    $this->Session->setFlash("Votre mot de passe a bien été modifié");
                    $this->Session->write('User',$user);
                    $this->redirect('');
                }else {
                     $this->Session->setFlash("Merci de corriger vos informations",'danger');
                }
                
            }
        }else{
            $this->redirect('');   
        }
    }
    }
    
    /**
     * ADMIN
     */
    
     public function admin_index(){
           $this->loadModel('User');
            $d['users'] = $this->User->find();
            $d['total'] = $this->User->findCount();
            
            
            $this->set($d);   
    
     }
     
      /**
     * Permet de supprimer un utilisateur
     * @param type $id id de l'utilisateur
     */
    function admin_delete($id){
        $this->loadModel('User');
        $this->User->delete($id);
        $this->Session->setFlash('L\'utilisateur a bien été supprimé');
        $this->redirect("gestionsu/users/index");
    }
    
     function admin_edit($id = null){
        $this->loadModel('User');
        $d['id']= '';
        if($this->request->data){
        
            if($this->User->validates($this->request->data)){
                $this->User->save($this->request->data);
                $this->Session->setFlash('Le jeu a bien été traité');
                $id = $this->User->id;
                $this->redirect('gestionsu/users/index');
            }else{
                $this->Session->setFlash('Merci de corriger vos informations','danger');
            }
            
        }else{
             if($id){
                $this->request->data = $this->User->findFirst(array(
                'conditions' => array('id'=>$id)
                ));
                $d['id'] = $id;
            }
        }
       
        $this->set($d);
    } 
    
    /**
     * member
     */
    
    public function member_index(){
        
    }
}
