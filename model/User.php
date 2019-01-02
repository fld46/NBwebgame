<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class User extends Model{
  
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
