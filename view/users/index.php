<div class="text-center mb-4 ">
    <h1>La liste de jeux </h1>
</div>
<?php foreach ( $games as $k => $v ):?>
    <div class="row border border-light ">
        <div class="col-lg-2 col-sm-12 " style='padding-left:0;'><img src="<?= '/img/games/'.$v->id.DS.$v->image;?>" alt="" class="img-fluid img-thumbnail"></div>
        <div class="col-lg-10 col-sm-12"><h3><?= $v->titre;?></h3><p><a href="<?= Router::url("games/view/id:{$v->id}/slug:$v->slug");?>">Lire la suite &rarr;</a></p></div>
    </div>

<?php endforeach ?>

    <div >
        <ul class="pagination">
        <?php for($i=1; $i <= $page; $i++):?>    
            <li class="page-item"><a class="page-link" href="?page=<?= $i;?>"><?= $i;?></a></li>
        <?php endfor;?>    
            
        </ul>
    </div>
