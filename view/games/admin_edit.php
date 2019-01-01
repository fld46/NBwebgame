<div class="page-header">
    <h1>Editer un jeu</h1>
</div>

<form action="<?= Router::url('admin/games/edit/'.$id);?>" method="POST" enctype="multipart/form-data">
    <?= $this->Form->input('id','hidden',array('type'=>'hidden'));?>
    <?= $this->Form->input('titre','Titre');?>
    <?= $this->Form->input('difficulte','Difficulté',array('type'=>'number'));?>
    <?= $this->Form->input('temps','Temps',array('type'=>'number'));?>
    <?= $this->Form->input('multi','Multi',array('type'=>'checkbox'));?>
    <?= $this->Form->input('liens','Guide');?>
    <?= $this->Form->input('comments','Commentaire');?>
    <?= $this->Form->input('image','Image',array('type'=>'file'));?>
    <?= $this->Form->input('crosssav','Cross-save',array('type'=>'checkbox'));?>
    <?= $this->Form->input('crosstrophy','Cross-trophies',array('type'=>'checkbox'));?>
    <?= $this->Form->input('crossmulti','Cross-multi',array('type'=>'checkbox'));?>
    <?= $this->Form->input('slug','Slug');?>
    <div class="actions">
        <input type="submit" class="btn btn-primary" value="Envoyer">
    </div>
</form>   

