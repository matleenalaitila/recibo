<?php
include_once("DataBase.php");
$kategoria1 = filter_input(INPUT_GET, 'kategoriat1', FILTER_SANITIZE_STRING);
$kategoria2 = filter_input(INPUT_GET, 'kategoriat2', FILTER_SANITIZE_STRING);
$ainesosa = filter_input(INPUT_GET, 'ainesosa', FILTER_SANITIZE_STRING);
$recipename = filter_input(INPUT_GET, 'recipename', FILTER_SANITIZE_STRING);
//miten saan oikean reseptin tiedot näkymään tällä sivulla?
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Jere Leskinen, Matleena Laitila, Samuli Reinikka, Marika Piuva">
    <title>Recibo - reseptikirja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/tyylit.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
   </head>

  <body class="bg" style="background-image: url('css/salad.jpg');">
  <h1>
    Recibo <small>Reseptejä joka hetkeen</small>
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
                    <a class="nav-link" href="index.php">Etusivu<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="random.php">Arvo resepti</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="save.php">Lisää resepti</a>
                  </li>
                </ul>
              </div>
            </nav>
      </div>
    </div>

    <div>
        <table class="table table-striped table-sm">
            <div class="table-responsive formit" id="reseptiohje" style="display:block">
                    <?php
                            $dataBase = new DataBase();
                            $dataBase->searchRecipe("resepti1","56L9R7N6F3Otw3Ur","resepti1","localhost");
                            $dataBase->getRecipeInstruction("resepti1","56L9R7N6F3Otw3Ur","resepti1","localhost");
                    ?>
                <a href="index.php">Etusivulle</a>
            </div>
        </table>
    </div>

            
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>