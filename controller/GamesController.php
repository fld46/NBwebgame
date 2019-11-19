<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class GamesController extends Controller{
    
    function index(){
       
       
        
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
    
    function view($id,$slug){
        
      
        $this->loadModel('Game');
        $condition = array('id'=>$id);
        $d['game'] = $this->Game->findFirst(array(
            'fields'     => '*',            
            'conditions' => $condition
        ));
        
        if(empty($d['game'])){
            $this->e404('Page introuvable');
        }
        if($slug  != $d['game']->slug){
            $this->redirect("games/view/id:$id/slug:".$d['game']->slug,301);
        }
        $this->set($d);
    }
    
    /**
     * ADMIN
     */
    
    
    function admin_index(){
        
        $this->loadModel('Game');
        $d['games'] = $this->Game->find(array(
            'fields' => 'id,titre'));
        $d['total'] = $this->Game->findCount();
        $d['noguide'] = $this->Game->find(array(
            'conditionsspec' => 'liens=""'
        ));
        //Functions::debug($d);
        $this->set($d);   
    }
    
    /**
     * Permet de supprimer un jeu
     * @param type $id id du jeu
     */
    function admin_delete($id){
        $this->loadModel('Game');
        $this->Game->delete($id);
        $this->Session->setFlash('Le jeu a bien été supprimé');
        $this->redirect("admin/games/index");
    }
    
    /**
     * Permet d'éditer un jeu
     */
    function admin_edit($id = null){
        $this->loadModel('Game');
        $d['id']= '';
        if($this->request->data){
             $this->Game->validate = array(
                    
                    'difficulte' => array(
                            'rule' => '(?:[1-9]|0[1-9]|10)',
                            'message' => 'Vous devez rentrer un nombre entre 1 et 10' 
                    ));
   
    
             
            if($this->Game->validates($this->request->data)){
                $this->Game->save($this->request->data);
                $this->Session->setFlash('Le jeu a bien été traité');
                $id = $this->Game->id;
                $this->redirect('admin/games/index');
            }else{
                $this->Session->setFlash('Merci de corriger vos informations','danger');
            }
            
        }else{
             if($id){
                $this->request->data = $this->Game->findFirst(array(
                'conditions' => array('id'=>$id)
                ));
                $d['id'] = $id;
            }
        }
       
        $this->set($d);
    }

    /**
     * Member
     */
    
     function member_index(){
        
        
    }
    
    
    
}
