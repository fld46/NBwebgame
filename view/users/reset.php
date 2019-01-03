<?php $title_for_layout= 'Mot de passe perdu';?>
<div class="page-header">
    <h1>Nouveau mot de passe</h1>
</div>

<form action="<?= Router::url('users/reset/'.$id.'/'.$reset_token);?>" method="POST" enctype="multipart/form-data">
    <?= $this->Form->input('password','Nouveau mot de passe',array('type'=>'password'));?>
    <?= $this->Form->input('conf_password','Confirmation mot de passe',array('type'=>'password'));?>
    <div class="actions">
        <input type="submit" class="btn btn-primary" value="Envoyer">
    </div>
</form> 
