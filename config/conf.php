<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Conf {
    
    static $debug =1;

    static $databases = array(
            'default' => array(
                'host'      => 'localhost',
                'database'  => 'webfld',
                'login'     => 'root',
                'password'  => 'et2tcmdp'
            )
        );
}

Router::prefix('gestionsu','admin');

Router::connect('','games/index');
Router::connect('gestionsu','gestionsu/games/index');
Router::connect('game/:slug-:id','games/view/id:([0-9]+)/slug:([a-z0-9\-]+)');
Router::connect('game/*','games/*');
