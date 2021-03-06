<div class='container'>
<div class="row">
    <div class="col-lg-2">
        <?= $total;?>
        <?= count($noguide);?>
    </div>
</div>
<div class="page-header">
    <h1><?= $total;?> Jeux</h1>
</div>
<a href="<?= Router::url('admin/games/edit');?>" class="btn btn-primary">Ajouter un jeu</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($games as $k => $v): ?>
        <tr>
            <td><?= $v->id;?></td>
            <td><?= $v->titre;?></td>
            <td>
                <a href="<?= Router::url('admin/games/edit/'.$v->id);?>">Editer</a>
                <a onclick="return confirm('Voulez vous vraiment supprimer ce jeu');" href="<?= Router::url('admin/games/delete/'.$v->id);?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
</div>