<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Model{
    
    static $connections = array();
    public $conf = 'default';
    public $table = false;
    public $db;
    public $primaryKey = 'id';
    public $id;
    public $errors = array();
    public $form;






    public function __construct() {
        //j'initialise quelques variables
        if($this->table === false){
            $this->table = strtolower(get_class($this)).'s';
        }
        // Je me connecte à la base
        $conf = Conf::$databases[$this->conf];
        if(isset(Model::$connections[$this->conf])){
            $this->db = Model::$connections[$this->conf];
            return true;
        }
        try{
            $pdo = new PDO('mysql:dbname='.$conf['database'].';host='.$conf['host'].'',
                    $conf['login'],
                    $conf['password'],
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
                    );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            Model::$connections[$this->conf] = $pdo;
            $this->db = $pdo;
        }catch(PDOException $e){
            if(Conf::$debug >= 1){
                die($e->getMessage());  
            }else{
                die('Impossible de se connecter a la base de donnée');
            }
        }
        
    }
    
    /**
     * Permet de chercher dans la base de donnée
     * @param array $req tableau des conditions de la requete sql 
     * @return objet
     */
    public function find($req = null){
        $sql = 'SELECT ';
        
        if(isset($req['fields'])){
            if(is_array($req['fields'])){
                $sql .= implode(', ',$req['fields']);
            }else{
                $sql .= $req['fields'];
            }
        }else{
            $sql .= '*';
        }
        $sql .= ' FROM '.$this->table.' as '.get_class($this).' ';
        
        // Construction de la condition
        if(isset($req['conditions'])){
            $sql .= 'WHERE ';
            if(!is_array($req['conditions'])){
                $sql .=$req['conditions'];
            }else{
                $cond = array();
                foreach($req['conditions'] as $k=>$v){
                    if(!is_numeric($v)){
                        $v = $this->db->quote($v);
                    }
                    $cond[] = "$k=$v";
                }
                $sql .= implode(' AND ', $cond);
            }            
        }
        if(isset($req['conditionsspec'])){
            if (isset($req['conditions'])){
                $sql .= ' AND ';
            }else{
                $sql .= 'WHERE ';
            }
            if(!is_array($req['conditionsspec'])){
                $sql .=$req['conditionsspec'];
            }else{
                $cond = array();
                foreach($req['conditionsspec'] as $k=>$v){
                    if(!is_numeric($v)){
                        $v = ($v);
                    }
                    $cond[] = "$v";
                }
                $sql .= implode(' AND ', $cond);
            }            
        }
        if(isset($req['order'])){
            $sql .= 'ORDER BY '.$req['limit'];
        }
        if(isset($req['limit'])){
            $sql .= 'LIMIT '.$req['limit'];
        }
        $pre = $this->db->prepare($sql);
        
        $pre->execute();
        return $pre->fetchAll(PDO::FETCH_OBJ);
        
    }
    
    /**
     * Permet de chercher dans la base de donnée le premier element
     * @param array $req tableau des conditions de la requete sql 
     * @return objet 
     */
    public function findFirst($req = null){
        return current($this->find($req));
    }
    /**
     * Permet de recuperer le compte d'enregistrement
     * @param array $condition condition de la requete sql
     */
    public function findCount($condition = null){
        if(isset($condition)){
            $res = $this->findFirst(array(
                'fields' => 'COUNT('.$this->primaryKey.') as count',
                'conditions' => $condition
            ));
        }
        else{
            $res = $this->findFirst(array(
               'fields' => 'COUNT('.$this->primaryKey.') as count' 
            ));
        }
        return $res->count;
    }
    /**
     * Supprime une donnée de la bdd
     * @param type $id id de la donnée a supprimer
     */
    public function delete($id){
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} =$id";
        $this->db->query($sql);
    }
       
    public function save($data){
        $key = $this->primaryKey;
        $fields=array();
        $d=array();
                
        foreach($data as $k=>$v){
            if($k!=$this->primaryKey){
                $fields[] = "$k=:$k";
                $d[":$k"] = $v;    
            }elseif(!empty($v)){
                $d[":$k"] = $v; 
            }
            
        }
      
        if(isset($data->$key) && !empty($data->$key)){
            $sql = 'UPDATE '.$this->table.' SET '.implode(',',$fields).' WHERE '.$key.'=:'.$key;
            $this->id = $data->$key;
            $action = 'update';
        }else{
            $sql = 'INSERT INTO '.$this->table.' SET '.implode(',',$fields);
            $action = 'insert';
        }
        $pre = $this->db->prepare($sql);
        $pre->execute($d);
        if($action == 'insert'){
            $this->id = $this->db->lastInsertId();
        }
        return true;
    }
    
    
    public function validates($data){
        $errors = array();
        foreach($this->validate as $k=>$v){
            
            if(!isset($data->$k)){
                $errors[$k] = $v['message'];
            }elseif(empty($data->$k)){
                    $errors[$k] = 'Vous devez remplir ce champ';
                }elseif($v['rule'] == 'isUnique'){
                    $sql=$this->findCount(array($k => $data->$k));
                    if($sql!=0 ){
                        $errors[$k] = $v['message'];
                    }
                }elseif($v['rule'] == 'isSimilar'){
                    $field = explode('_', $k);
                    if($data->$k!==$data->{$field[1]}){
                        $errors[$k] = $v['message'];
                    }
                }elseif(!preg_match('/^'.$v['rule'].'$/',$data->$k)){
                    $errors[$k] = $v['message'];
                    }
            }
        
        $this->errors = $errors;
        if(isset($this->Form)){
            $this->Form->errors = $errors;
        }
        if(empty($errors)){
            return true;
        }
        return false;
    }
    
    
}
