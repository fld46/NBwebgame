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
            if(password_verify($data->password, $user->password)){
            if(!empty($user)){
                $this->Session->write('User',$user);
                
            }
            }
            $this->request->data->password = '';
            
        }
        if($this->Session->isLogged()){
            if($this->Session->user('role') == 'A'){
                $this->redirect('gestionsu/games');
            }else{
                $this->redirect('');
            }
        }
    }
    /**
     * logout
     */
    function logout(){
        unset($_SESSION['User']);
        $this->Session->setFlash('Vous etes maintenant déconnecté');
        $this->redirect('');
    }
}
