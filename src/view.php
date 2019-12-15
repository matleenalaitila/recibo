<?php
include_once("DataBase.php");
include_once("Language.php");
$reseptiId = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_STRING);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Jere Leskinen, Matleena Laitila, Samuli Reinikka, Marika Piuva">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/tyylit.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title><?php echo $language['title']?></title>
    
   </head>
  <body class="bg" style="background-image: url('css/salad.jpg');">
  <h1>
  <div><a class="kielet" href="recipe.php?language=fi"><?php echo $language['language-fi']?></a><a class="kielet" href="recipe.php?language=en"><?php echo $language['language-en']?></a></div>
    Recibo <small><?php echo $language['title']?></small>
  </h1>
  <div class="container-fluid">
    <div class="row">
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item active">
                    <a class="nav-link" href="index.php"><?php echo $language['homepage']?><span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="random.php"><?php echo $language['random']?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="save.php"><?php echo $language['add']?></a>
                  </li>
                </ul>
              </div>
            </nav>
      </div>
    </div>

    <div>
    <div id="ohje">
        <table class="table table-striped table-sm">
            <div class="table-responsive formit" id="reseptiohje" style="display:block">
                    <?php
                            $dataBase = new DataBase();
                            $dataBase->viewRecipe("resepti1","56L9R7N6F3Otw3Ur","resepti1","localhost",$reseptiId);
                    ?>
                <a href="index.php"><?php echo $language['homepage']?></a>
            </div>
        </table>
    </div>
    </div>
            
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>