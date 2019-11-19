<div class='container'>
<div class="page-header">
    <h1><?= $total;?> Utilisateurs</h1>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>login</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $k => $v): ?>
        <tr>
            <td><?= $v->id;?></td>
            <td><?= $v->login;?></td>
            <td>
                
                <a href="<?= Router::url('admin/users/edit/'.$v->id); ?>">Editer</a>
                <a onclick="return confirm('Voulez vous vraiment supprimer ce jeu');" href="<?= Router::url('admin/users/delete/'.$v->id);?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
</div>

