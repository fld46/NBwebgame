<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 Class Functions{
     
     static function debug($var){
        if (Conf::$debug>=1){
            $debug = debug_backtrace();
            echo '<p>&nbsp;</p><p><a href="#" onclick="$(this).parent().next(\'ol\').slideToggle(); return false;"><strong>'.$debug[0]['file'].' </strong> l.'.$debug[0]['line'].'</a></p>';
            echo '<ol stule="display:none;">';
            foreach ($debug as $k => $v) {
                if($k>0){
                    echo '<li>'.$v['file'].'  l.'.$v['line'].'</li>';
                }
            }
            echo '</ol>';
            echo '<pre>';
            print_r($var);
            echo'</pre>';
        }
     }
 }
