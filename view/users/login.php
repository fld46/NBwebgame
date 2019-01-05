<?php $title_for_layout= 'Identification';?>
<p></p>
<div class="row ">
    <div class ="col-lg-4 offset-lg-4 col-md-12 offset-md-0 col-sm-12 offset-sm-0">
        <form class="" action="<?= Router::url('users/login');?>" method="post">
        <div class="text-center mb-4">
            <h1 class="h3 mb-3 font-weight-normal">Identification</h1>
        </div>
        <?= $this->Form->input('login','',array('placeholder'=>'identifiant'));?>
        <?= $this->Form->input('password','',array('type'=>'password','placeholder'=>'password'));?>
        <div class="float-left"><?= $this->Form->input('remember','Se souvenir de moi',array('type'=>'checkbox'));?></div>   
        <div class="float-right "><div class="checkbox-mb-3 "><label><a  href="<?= Router::url('users/perdu');?>">Mot de passe perdu</a></label></div></div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">S'identifier</button>
        </form>
        
    </div>
</div>
