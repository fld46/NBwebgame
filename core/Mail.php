<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function microtime_float(){list($usec, $sec) = explode(" ", microtime()); 
            return ((float)$usec + (float)$sec);}
            
class Mail{
    
    private $passage_ligne;
    private $header;
    private $boundary; 
   
        public function __construct() {
            
        }
        private function verif($addmail){
           
            if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $addmail))
            {
            $this->passage_ligne = "\r\n";
            }
            else
            {
            $this->passage_ligne = "\n";
            }
            }
        private function header($expediteur, $addmail, $mailuser, $sujet){
            self::verif($mailuser);
            $header = "From: \"$expediteur\"<".$addmail.">".$this->passage_ligne;
            $header .= "Reply-to: ".$addmail .$this->passage_ligne;
            $header.= "Subject: ".$sujet.$this->passage_ligne; 
            $header.= "MIME-Version: 1.0".$this->passage_ligne; 
            $header .= "Content-Type: multipart/alternative;".$this->passage_ligne." boundary=\"$this->boundary\"".$this->passage_ligne ;
            $this->header = $header;
            
        }
        public function create($addmail,$expediteur,$addexp,$sujet,$message_txt,$message_html){
           self::verif($addmail);
           ini_set("sendmail_from",$addexp);
           $this->boundary = "-----=". md5(rand());
           self::header($expediteur,$addexp,$addmail,$sujet);
            $message = $this->passage_ligne."--".$this->boundary.$this->passage_ligne;
            //=====Ajout du message au format texte.
            $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$this->passage_ligne;
            $message.= $this->passage_ligne.$message_txt.$this->passage_ligne;
            //==========
            $message.= $this->passage_ligne."--".$this->boundary.$this->passage_ligne;
            //=====Ajout du message au format HTML
            $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$this->passage_ligne;
            $message.= $this->passage_ligne.$message_html.$this->passage_ligne;
            //==========
            $message.= $this->passage_ligne."--".$this->boundary."--".$this->passage_ligne;
            $message.= $this->passage_ligne."--".$this->boundary."--".$this->passage_ligne;
            //==========
           
            $tentative = 0; 
            $envoi = 0; 
            While ($tentative < 5 AND $envoi == 0){ // 5 tentatives autorisées 
                $tentative++ ; 
                $t0 = microtime_float(); 
                $reponse = mail($addmail, utf8_decode($sujet),utf8_decode($message),$this->header); 
                $t1 = microtime_float(); 
                $duree = $t1-$t0; 
                    if($reponse == 1 AND $duree > 1.50){
                        $envoi = 1;                        
                    } 
                    else{
                        $envoi = 0; 
                        $pause = 0; 
                        while ($pause < 2.00){ // Ne pas descendre plus bas que 2s : moins bons résultats 
                            $t2 = microtime_float(); 
                            $pause = $t2-$t1; 
                            } 
                    } 

            } 
        }
}