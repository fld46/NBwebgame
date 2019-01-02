<?php $this->layout = 'login';?>
<?php foreach ( $games as $k => $v ):?>
    <div class="ligne"><h2><?= $v->titre;?></h2>
    <?= $v->image;?>
        <p><a href="<?= Router::url("games/view/id:{$v->id}/slug:$v->slug");?>">Lire la suite &rarr;</a></p></div>
<?php endforeach ?>
    <div>
        <ul class="pagination">
        <?php for($i=1; $i <= $page; $i++):?>    
            <li class="page-item"><a class="page-link" href="?page=<?= $i;?>"><?= $i;?></a></li>
        <?php endfor;?>    
        </ul>
    </div>