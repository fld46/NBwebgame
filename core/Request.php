<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Request{
    
    public $url; //URL appelé par l'utilisateur
    public $page = 1;
    public $prefix = false;
    public $data = false;
    
    function __construct() {
        //$test = substr($_SERVER['REQUEST_URI'], strlen(BASE_URL), strlen($_SERVER['REQUEST_URI']) - strlen(BASE_URL));
        //$this->url = !NULL==$test?$test:'/';
        $this->url = isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:'/';
        if(isset($_GET['page'])){
            if(is_numeric($_GET['page'])){
                if($_GET['page']> 0){
                    $this->page = round($_GET['page']);    
                }
                
            }
        }
        if(!empty($_POST)){
            $this->data = new stdClass();
            foreach($_POST as $k=>$v){
                $this->data->$k=$v;
            }
        }
    }
}
