<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AdminsController extends Controller{
    
    public function admin_index(){
        $this->loadModel('Admin');
        $this->loadModel('Game');
        
        
        
        
        $perPage = 60;
        
        $this->loadModel('Game');
        $d['games'] = $this->Game->find(array(
            'limit' => ($perPage*($this->request->page -1)).','.$perPage
        ));
        $d['total'] = $this->Game->findCount();
        $d['page'] = ceil($d['total']/ $perPage);
        //Functions::debug($d);
        $this->set($d);
        
    }
    
}