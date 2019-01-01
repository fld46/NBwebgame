<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Game extends Model{
    
    public $validate = array(
                    'titre' => array(
                            'rule' => 'notEmpty',
                            'message' => 'Vous devez specifier un titre'
                    ),
                    'difficulte' => array(
                            'rule' => '(?:[1-9]|0[1-9]|10)',
                            'message' => 'Vous devez rentrer un nombre entre 1 et 10' 
                    )
    );
    
    
   
    
    
    
}