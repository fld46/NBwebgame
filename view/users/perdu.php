<?php $title_for_layout= 'Mot de passe perdu';?>
<div class="page-header">
    <h1>S'inscrire</h1>
</div>

<form action="<?= Router::url('users/perdu');?>" method="POST" enctype="multipart/form-data">
    <?= $this->Form->input('email','E-mail',array('type'=>'email'));?>
    
    <div class="actions">
        <input type="submit" class="btn btn-primary" value="Envoyer">
    </div>
</form> 
