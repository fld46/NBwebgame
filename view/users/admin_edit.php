<div class="page-header">
    <h1>Editer un jeu</h1>
</div>

<form action="<?= Router::url('admin/users/edit/'.$id);?>" method="POST" enctype="multipart/form-data">
    <?= $this->Form->input('id','hidden',array('type'=>'hidden'));?>
    <?= $this->Form->input('login','Identifiant');?>
    <?= $this->Form->input('email','e-mail');?>
    <?= $this->Form->input('role','Role');?>
   
    <div class="actions">
        <input type="submit" class="btn btn-primary" value="Envoyer">
    </div>
</form>   

