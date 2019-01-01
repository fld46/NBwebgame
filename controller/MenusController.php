<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class MenusController extends Controller{
    
    
    /**
     * Permet de recuperer les éléments du menu
     * @return type les elements du menus
     */
    public function getMenu(){
        $this->loadModel('Menu');
        return $this->Menu->getMenu();
    }
    
    public function getSMenu($id){
        $this->loadModel('Menu');
        return $this->Menu->getSMenu($id);
    }
    /**
     * ADMIN
     */
    public function admin_getMenu(){
        $this->loadModel('Menu');
        return $this->Menu->getMenu();
    }
    
    public function admin_getSMenu($id){
        $this->loadModel('Menu');
        return $this->Menu->getSMenu($id);
    }
}
