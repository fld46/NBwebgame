<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Controller{
    
    private $vars     = array();
    public $request;
    public $layout    = 'default';
    private $rendered = false;
    
    /**
     * Constructeur
     * @param type $request Objet request de notre application
     */
    function __construct($request = null){
        $this->Session = new Session();
        $this->Form = new Form($this);
        $this->Mail = new Mail();
        if($request){
            $this->request = $request;
            require ROOT.DS.'config'.DS.'hook.php'; 
        }
         if($this->Session->user('role')=='A'){
           $this->layout="admin"; 
        }
        if(!$this->Session->isLogged()){
           $this->layout="login"; 
        }
    }
    
    /**
     * Permet de rendre une vue
     * @param type $view Fichier à rendre (chemin depuis view ou nom de la vue)
     * @return boolean
     */
    public function render($view){
        if($this->rendered){ return false;}
        extract($this->vars);
        if(strpos($view, '/')===0){
            $view = ROOT.DS.'view'.$view.'.php'; 
        }else{
            $view = ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php'; 
        }
        ob_start();
        require($view);
        $content_for_layout = ob_get_clean();
        require ROOT.DS.'view'.DS.'layout'.DS.$this->layout.'.php';
        $this->rendered = true;        
    }
   /**
    * Permet de passer une ou plusieurs variable à la vue
    * @param type $key nom de la variable OU tableau de variables
    * @param type $value Valeur de la variable
    */
    public function set($key,$value=null){
        if(is_array($key)){
            $this->vars += $key;
        }else{
            $this->vars[$key] = $value;
        }
    }
    /**
     * Permet de charger un model
     * @param type $name nom du model
     */
    public function loadModel($name){
        
        if(!isset($this->$name)){
            $file = ROOT.DS.'model'.DS.$name.'.php';
            require_once($file);
            $this->$name = new $name();
            if(isset($this->Form)){
                $this->$name->Form = $this->Form;
            }
        }
    }
     /**
      * Permet de gérer les erreurs 404
      * @param type $message
      */
     public function e404($message){
        header("HTTP/1.0 404 Not Found");
        $this->set('message',$message);
        $this->render('/errors/404');               
     }
     /**
      * Permet d'appeler un controller depuis une vue
      * @param type $controller Nom du controller
      * @param type $action Method du controller
      */
     
     public function request($controller,$action,$param = null){
         $controller .= 'Controller';
         require_once ROOT.DS.'controller'.DS.$controller.'.php';
         $c = new $controller;
         if($param){
         return $c->$action($param);    
         }else{
         return $c->$action();
         }
     }
     /**
      * Permet de rediriger
      * @param type $url url où rediriger
      * @param type $code code de redirection
      */
     public function redirect($url,$code = null){
         if($code == 301){
             header("HTTP/1.1 301 Moved Perlanently");
         }
         header("Location:".Router::url($url));
     }
     
    
}