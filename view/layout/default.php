<!DOCTYPE html>
<html>
    <head>
        <title><?= isset($title_for_layout)?$title_for_layout:'Collection de jeux';?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" >
        
        <meta charset="UTF-8">
    </head>
    <body>
       <nav class="navbar navbar-expand-lg navbar-light bg-light ">
        <a class="navbar-brand" href="#">Menu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ">
          <?php $menu = $this->request('Menus', 'getMenu'); ?>
                    <?php foreach($menu as $p):?>
                        <?php $submenu = $this->request('Menus', 'getSMenu',$p->id);
                            if($submenu){ 
                                echo '<li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                '.$p->name.'
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">';    
                                     foreach ($submenu as $s):
                                        echo '<a class="dropdown-item" href="#">'.$s->name.'</a>';
                                     endforeach;    
                                
                            }else{
                                echo '<li class="nav-item"><a href="'.Router::url($p->link).'" class="nav-link">'.$p->name.'</a></li>';
                                
                            }
                            
                    endforeach;?>
        
        </ul>
        </div>
        </nav>
        <div class ="container">
                    <?= $this->Session->flash();?>
                    <?= $content_for_layout;?>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    </body>
</html>
