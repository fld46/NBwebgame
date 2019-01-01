<div class="page-header">
    <h1>Zone réservée</h1>
</div>
    <form action="<?= Router::url('users/login');?>" method="post">
        <?= $this->Form->input('login','Identifiant');?>
        <?= $this->Form->input('password','Mot de passe',array('type'=>'password'));?>
    
        <div class="actions">
            <input type="submit" class="btn btn-primary" value="se connecter">
        </div>
    </form>