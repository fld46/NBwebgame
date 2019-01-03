<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class User extends Model{
  
    public $validate = array(
                    
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
    
    public function remember($user_id){
      
        $remember_token = Functions::random(250);
        $this->db->query('UPDATE users SET remember_token ="'.$remember_token.'" WHERE id='.$user_id);
        setcookie('remember', $user_id . '==' . $remember_token . sha1($user_id . 'ratonlaveurs'), time() + 60 * 60 * 24 * 7);
           
     }
     
     public function connectFromcookie(){
         if(isset($_COOKIE['remember'])){
        
            $remember_token = $_COOKIE['remember'];
            $parts = explode('==', $remember_token);
            $user_id = $parts[0];
            $user = $this->db->query('SELECT * FROM users WHERE id ='.$user_id )->fetch();
            if($user){
                $expected = $user_id . '==' . $user['remember_token'] . sha1($user_id . 'ratonlaveurs');
                Functions::debug($expected);
                Functions::debug($remember_token);
                if($expected == $remember_token){
                    setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);
                    return $user_id;
                }else{
                    setcookie('remember', null, -1);
                    return false;
                }
            }else{
                setcookie('remember', null, -1);
                return false;
            }
        }   
    }
    
}
