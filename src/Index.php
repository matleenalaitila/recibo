

<script type="text/javascript">
function showDiv(reseptilaatikko){
document.getElementById(reseptilaatikko).style.display = 'block';
}
</script>
<?php

$kategoria1 = filter_input(INPUT_GET, 'kategoriat1', FILTER_SANITIZE_STRING);
$kategoria2 = filter_input(INPUT_GET, 'kategoriat2', FILTER_SANITIZE_STRING);
$ainesosa = filter_input(INPUT_GET, 'kategoriat2', FILTER_SANITIZE_STRING);
    
    // Miten saan alasvetovalikkoon ainesosat vain kerran?
    // Miten saan hakutulokset näkymään?
    

    //asetellaan muuttujilla arvot
    $servername = "localhost";
    $username = "demoxUser";
    $password = "HQWWltVOQrsAe9qd";
    $dbname = "resepti1";

  

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //aloitetaan transaktio
        $connection->beginTransaction();

        // sql-komennot, hakee ingredient-taulusta ingredient-sarakkeen
        $statement = $connection->prepare("SELECT ingredient, recipename FROM ingredient, recipe");
        $statement->execute();

        // vaihdetaan hakumoodiksi objecti
        $statement->setFetchMode(PDO::FETCH_OBJ);

        //haetaan kaikki rivit
        $result = $statement->fetchAll();

        //commit (hyväksytään transaktio)
        $connection->commit();
    
    }
    catch(PDOException $e)
    {

        // rollback eli perutaan transaktio
        $connection->rollback();
        echo "Tietokantavirhe: " . $e->getMessage();
    }

    // suljetaan tietokantayhteys
    $connection = null;
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

    <div class="s009">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="inner-form indexform">
          <div class="basic-search">
            
          </div>
          <div class="advance-search">
            <h2 class="desc">Etsi reseptejä</h2>
            <div class="row">
              <div class="input-field">
                <div class="input-select">
                  <select data-trigger="" name="choices-single-defaul kategoriat1">
                    <option placeholder="" value="">Ruokavalio</option>
                    <option value="Alkuruoka">Kasvisruoka</option>
                    <option value="Pääruoka">Liharuoka</option>
                    <option value="Aamu-, väli- ja iltapala">Gluteeniton</option>
                    <option value="Jälkiruoka">Maidoton</option>
                    <option value="Salaatti">Kananmunaton</option>
                    <option value="Keitto">Vegaaninen</option>
                    <option value="Juoma">Sokeriton</option>
                    <option value="Juoma">Vähähiilihydraattinen</option>
                  </select>
                </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                  <select data-trigger="" name="choices-single-defaul kategoriat2">
                    <option placeholder="" value="">Reseptiryhmä</option>
                    <option value="Alkuruoka">Alkuruoka</option>
                    <option value="Pääruoka">Pääruoka</option>
                    <option value="Aamu-, väli- ja iltapala">Aamu-, väli- ja iltapala</option>
                    <option value="Jälkiruoka">Jälkiruoka</option>
                    <option value="Salaatti">Salaatti</option>
                    <option value="Keitto">Keitto</option>
                    <option value="Juoma">Juoma</option>
                  </select>
                </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                  <select data-trigger="" name="choices-single-defaul ainesosa">
                    <option placeholder="" value="">Ainesosa</option>
                    <?php  foreach($result as $row) {
                    print "<option ingredient=$row->ingredient>$row->ingredient</option>";
                    }?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row third">
              <div class="input-field">
              <div class="result-count"></div>
                <div class="group-btn">
                  <button class="btn-delete" id="delete">Tyhjennä</button>
                  <input type="button" value="Etsi" class="btn-search" onclick="showDiv('reseptilaatikko')"></input>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      <div id="reseptilaatikko" style="display:none" class="table-responsive formit">
            <table class="table table-striped table-sm">
              <thead>
                <div>
                <?php  foreach($result as $row) {
                    print "<h2 recipe=$row->recipename>$row->recipename</h2>";
                    }?>
                  <a>reseptin kuva tähän</a>
                </div>
              </thead>
			      </table>
			      <button href='recipe.php?recipe=$recipename' id="new">Avaa</button>
      </div>
          
   	</div>
    </div>
    <script src="js/extention/choices.js"></script>
    <script>
      const customSelects = document.querySelectorAll("select");
      const deleteBtn = document.getElementById('delete')
      const choices = new Choices('select',
      {
        searchEnabled: false,
        itemSelectText: '',
        removeItemButton: true,
      });
      deleteBtn.addEventListener("click", function(e)
      {
        e.preventDefault()
        const deleteAll = document.querySelectorAll('.choices__button')
        for (let i = 0; i < deleteAll.length; i++)
        {
          deleteAll[i].click();
        }
      });

    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>