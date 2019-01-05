<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$title_for_layout = $game->titre;
?>

<div class="text-center mb-4 ">
<h1><?= $game->titre;?></h1>   
</div>

<div class="row border">
    <div class="col-lg-3 col-sm-12 " style='padding-left:0;'><img src="<?= '/img/games/'.$game->id.'/'.$game->image;?>" alt="" class="img-fluid img-thumbnail"></div>
    <div class="col-lg-9 col-sm-12 " >
        <br>
        <div class="float-left ">Difficulté : <?= $game->difficulte;?></div>
        <div class="float-right ">Durée : <?= $game->temps;?> H</div><br>       
        <div class="float-left ">Multi : <?= $game->multi;?></div>
        <div class="float-right ">PSVita : <?= $game->psvita;?> PS3 : <?= $game->ps3;?> PS4 :<?= $game->ps4;?></div><br>
        <div>Guide : <?= $game->liens;?></div>        
        <div>Cross-save : <?= $game->crosssav;?> Cross-trophy : <?= $game->crosstrophy;?> Cross-multi : <?= $game->crossmulti;?></div>
        <div>Commentaire : <?= $game->comments;?></div>
    </div>
</div>

