<!DOCTYPE html>
<html>
    <head>
        <title><?= isset($title_for_layout)?$title_for_layout:'Error';?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" >
        
        <meta charset="UTF-8">
    </head>
    <body>
    
        <div class ="container">
                   
                    <?= $content_for_layout;?>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    </body>
</html>

