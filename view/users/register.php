<?php $title_for_layout= 'Inscription';?>
<div class="page-header">
    <h1>S'inscrire</h1>
</div>

<form action="<?= Router::url('users/register');?>" method="POST" enctype="multipart/form-data">
    
    <?= $this->Form->input('login','Identifiant');?>
    <?= $this->Form->input('password','Mot de passe',array('type'=>'password'));?>
     <?= $this->Form->input('conf_password','Confirmation du mot de passe',array('type'=>'password'));?>
    <?= $this->Form->input('email','E-mail',array('type'=>'email'));?>
    
    <div class="actions">
        <input type="submit" class="btn btn-primary" value="Envoyer">
    </div>
</form> 