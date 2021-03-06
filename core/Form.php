<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Form{
    
    public $controller;
    public $errors;
    
    public function __construct($controller) {
        $this->controller = $controller;
    }
    public function input($name,$label,$options = array()){
        $error = false;
        $classError ='';
        if(isset($this->errors[$name])){
            $error = $this->errors[$name];
            $classError = 'is-invalid';
        }
        
        if(!isset($this->controller->request->data->$name)){
            $value = '';
        }else{
            $value = $this->controller->request->data->$name;
        }
        if($label == 'hidden'){
            return '<input type="hidden" name="'.$name.'" value="'.$value.'">';
        }
        $html = '<div class="form-label-group '.$classError.'">
                <label for="input'.$name.'" >'.$label.'</label>';
        
        $attr = 'class="form-control '.$classError.'" ';
        foreach($options as $k=>$v){ 
            if($k!='type'){
                $attr .= "$k=\"$v\"";
            }    
        }
        
        if(!isset($options['type'])){
            $html .=  '<input type="text" id="input'.$name.'" name="'.$name.'" value="'.$value.'" '.$attr.' >';
        }
       
        elseif($options['type']=='number'){
            $html .=  '<input type="'.$options['type'].'" id="input'.$name.'" name="'.$name.'" value="'.(empty($value)?'0':$value).'" '.$attr.' >';
        }
        elseif($options['type']=='checkbox'){
            $html =  '<div class="checkbox-mb-3 '.$classError.'"><label><input type ="hidden" name"'.$name.'" value="0"><input type="'.$options['type'].'" id="input'.$name.'" name="'.$name.'" value="1" '.(empty($value)?'':'checked').'> '.$label.'</label>';
        }
        elseif($options['type']=='file'){
            $html .=  '<input type="'.$options['type'].'" id="input'.$name.'" name="'.$name.'"'.$attr.'>';
        }
        elseif($options['type']=='password'){
            $html .=  '<input type="'.$options['type'].'" id="input'.$name.'" name="'.$name.'" value="'.$value.'" '.$attr.' >';
        }elseif($options['type']=='email'){
            $html .=  '<input type="email" id="input'.$name.'" name="'.$name.'" value="'.$value.'" '.$attr.' >';
        }
        if($error){
            $html .= '<span class="help-inline">'.$error.'</span';
        }
        $html .= '</div>';
        return $html;
    }
}