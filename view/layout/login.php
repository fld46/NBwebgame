<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title><?= isset($title_for_layout)?$title_for_layout:'Collection de jeux - identification';?></title>
  </head>
  <body>
         <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Menu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?= Router::url('');?>">Accueil<span class="sr-only"></span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?= Router::url('users/register');?>">Register<span class="sr-only"></span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?= Router::url('users/perdu');?>">Mot de passe perdu<span class="sr-only"></span></a>
            </li>
          </ul>
            <form class="form-inline my-2 my-lg-0" action="<?= Router::url('');?>" method="post">
             <?= $this->Form->input('login','',array('placeholder'=>'identifiant'));?>
             <?= $this->Form->input('password','',array('type'=>'password','placeholder'=>'password'));?>
             <?= $this->Form->input('remember','Se souvenir de moi',array('type'=>'checkbox'));?>   
            <button class="btn-xs btn-primary my-2 my-sm-0 " type="submit">Login</button>
          </form>
        </div>
        
    </nav>
    
    <div class ="container">
    
    <?= $content_for_layout;?>   
    
                    
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>