<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if($this->request->prefix == 'admin'){
    $this->layout = 'admin';
    if(!$this->Session->isLogged() || $this->Session->user('role') != 'A'){
        $this->redirect('users/index');
    }
}
if($this->request->prefix == 'member'){
    if(!$this->Session->isLogged()){
        $this->redirect('users/index');
    }
}