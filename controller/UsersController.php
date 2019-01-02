<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class UsersController extends Controller{
    
    /**
     * login
     */
    function login(){
        
        if($this->request->data){
            $data = $this->request->data;
            //$data->password = password_hash($data->password, PASSWORD_BCRYPT);
            $this->loadModel('User');
            $user = $this->User->findFirst(array(
                'conditions' => array('login' => $data->login )
            ));
           
            if(!empty($user)){
                 if(password_verify($data->password, $user->password)){
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
                $this->redirect('game');
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
    
    function register(){
        $this->loadModel('User');
        $d['id']= '';
        if($this->request->data){
             
            if($this->User->validates($this->request->data)){
                //$this->User->save($this->request->data);
                $this->Session->setFlash('Le jeu a bien été traité');
                $this->redirect('');
            }else{
                $this->Session->setFlash('Merci de corriger vos informations','danger');
            }
            
        }
        
    }
}
