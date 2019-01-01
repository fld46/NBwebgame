<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?= isset($title_for_layout)?$title_for_layout:'Mon site';?></title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" >
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    </head>
    <body>
        <div id="main">
            <div id="centre">
                <div class="onglets_menu"></div>
                    <div class ="menu_gauche">
                        <form method="post" class="form_ident" >
                        <fieldset>
                        <legend> Identification </legend> 
                        <br>
                        <div > 
                        <input class="formin" type="text"  name="username" placeholder="Username" />
                        <input class="formin" type="password"  name="password" placeholder="Your Password" />
                        </div><div class="remember"><input type="checkbox" name="remember" value="1">Se souvenir de moi</div><br>
                        <button type="submit" name="btn-login" >&nbsp;LOGIN</button><br>
                        <div class="register"><a  href="account/register.php" target="register">Creer un compte</a></div><br>
                        <div class="perdu"><a  href="account/perdumdp.php" target="perdu">J'ai oublié mon mot de passe</a></div>
                        <br/>
                        </fieldset>
                        </form>
                        </div> 
                
                 <div class="droite">        
                    <?= $content_for_layout;?>
                </div>
            </div>
        </div>
    </body>
</html>