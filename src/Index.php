


<?php
include_once("DataBase.php");
$kategoria1 = filter_input(INPUT_GET, 'kategoriat1', FILTER_SANITIZE_STRING);
$kategoria2 = filter_input(INPUT_GET, 'kategoriat2', FILTER_SANITIZE_STRING);
$ainesosa = filter_input(INPUT_GET, 'ainesosa', FILTER_SANITIZE_STRING);
$recipename = filter_input(INPUT_GET, 'recipename', FILTER_SANITIZE_STRING);
$reseptiId = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_STRING);
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
                    <option value="Kasvisruoka">Kasvisruoka</option>
                    <option value="Liharuoka">Liharuoka</option>
                    <option value="Gluteeniton">Gluteeniton</option>
                    <option value="Maidoton">Maidoton</option>
                    <option value="Kananmunaton">Kananmunaton</option>
                    <option value="Vegaaninen">Vegaaninen</option>
                    <option value="Sokeriton">Sokeriton</option>
                    <option value="Vähähiilihydraattinen">Vähähiilihydraattinen</option>
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
                    <tbody>
                      <?php
                          $dataBase = new DataBase();
                          $dataBase->searchIngredient("resepti1","56L9R7N6F3Otw3Ur","resepti1","localhost");
                      ?>
                      </tbody>
                  </select>
                </div>
              </div>
            </div>
            <div class="row third">
              <div class="input-field">
              <div class="result-count"></div>
                <div class="group-btn">
                  <button class="btn-delete" id="delete" onclick="hideDiv('reseptilaatikko'); showDiv('uusimmatreseptit');">Tyhjennä</button>
                  <input href="index.php" type="button" value="Etsi" class="btn-search" onclick=" hideDiv('uusimmatreseptit'); showDiv('reseptilaatikko');"></input>
                    <script type="text/javascript">
                      function showDiv(reseptilaatikko){
                      document.getElementById(reseptilaatikko).style.display = 'block';
                      }
                      function hideDiv(reseptilaatikko){
                      document.getElementById(reseptilaatikko).style.display = 'none';
                      }
                      function hideDiv(uusimmatreseptit){
                      document.getElementById(uusimmatreseptit).style.display = 'none';
                      }
                    </script>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      <div>
            <table name="ID" class="table table-striped table-sm">
              
                <div name="ID" class="table-responsive formit" id="uusimmatreseptit" style="display:block">
                  <h2>Uusimmat reseptit</h2>    
                  </br>
                  <?php
                            $dataBase = new DataBase();
                            $dataBase->searchAllRecipes("resepti1","56L9R7N6F3Otw3Ur","resepti1","localhost");
                  ?>
                </div>
                <div  name="ID" class="table-responsive formit" id="reseptilaatikko" style="display:none">
                  <h2>Hakutulokset</h2>
                  </br>
                  <?php
                            $dataBase = new DataBase();
                            $dataBase->searchRecipe("resepti1","56L9R7N6F3Otw3Ur","resepti1","localhost");
                  ?>
                </div>
              
			      </table>
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