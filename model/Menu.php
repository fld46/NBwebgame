<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Menu extends Model{
 
    /**
     * Permet de recuperer les menus
     * @return type
     */
    public function getMenu(){
        $sql = $this->find();
        return $sql;
    }
    
    /**
     * Permet de recuperer la liste des sous menus
     * @param type $id id du composant du menu
     * @param type $allow Droits du sous-menu 
     * @return type
     */
    public function getSMenu($id, $role=null){        
        if($role){
            $role = 'and role='.$role;
        }
        $sql = "SELECT * 
        FROM menus m
        INNER JOIN submenus s ON m.id = s.id_menus $role
        WHERE m.id=".$id."";
        $pre = $this->db->prepare($sql);
        $pre->execute();
        //Functions::debug($pre->fetchAll(PDO::FETCH_OBJ));
        return $pre->fetchAll(PDO::FETCH_OBJ);          
    }
    
    
}


