<?php
  include("DataBase.php");
  include_once("Language.php");
  $kategoria1 = filter_input(INPUT_GET, 'kategoriat1', FILTER_SANITIZE_STRING);
  $kategoria2 = filter_input(INPUT_GET, 'kategoriat2', FILTER_SANITIZE_STRING);
  $recipeID = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_STRING);

    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Jere Leskinen, Matleena Laitila, Samuli Reinikka, Marika Piuva">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recibo - reseptikirja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/tyylit.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title><?php echo $language['title']?></title>

  </head>
  <body class="bg" style="background-image: url('css/salad.jpg');">
  <h1>
  <div><a class="kielet" href="random.php?language=fi"><?php echo $language['language-fi']?></a><a class="kielet" href="random.php?language=en"><?php echo $language['language-en']?></a></div>
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
                    <li class="nav-item">
                      <a class="nav-link" href="index.php">Etusivu</a>
                    </li>
                    <li class="nav-item active">
                      <a class="nav-link" href="random.php">Arvo resepti<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="save.php">Lisää resepti</a>
                    </li>
                  </ul>
                </div>
              </nav>
              <div>
          <form class="formit" role="form" action="random.php" method="get">
      <div>
				<div class="form-group">
					<label for="diet"><?php echo $language['ruokavalio']?></label>
					</br>
					<select name="kategoriat1">
          <option value="Kasvisruoka"><?php echo $language['kasvisruoka']?></option>
                    <option value="Liharuoka"><?php echo $language['liharuoka']?></option>
                    <option value="Gluteeniton"><?php echo $language['gluteeniton']?></option>
                    <option value="Maidoton"><?php echo $language['maidoton']?></option>
                    <option value="Kananmunaton"><?php echo $language['kananmunaton']?></option>
                    <option value="Vegaaninen"><?php echo $language['vegaaninen']?></option>
                    <option value="Sokeriton"><?php echo $language['sokeriton']?></option>
                    <option value="Vähähiilihydraattinen"><?php echo $language['vähähiilihydraattinen']?></option>
					  </select>
				</div>
				<div class="form-group">
					<label for="groupname">
          <?php echo $language['reseptiryhmä']?>
					</label>
					</br>
					<select name="kategoriat2">
                    <option value="Alkuruoka"><?php echo $language['alkuruoka']?></option>
                    <option value="Pääruoka"><?php echo $language['pääruoka']?></option>
                    <option value="Aamu-, väli- ja iltapala"><?php echo $language['välipala']?></option>
                    <option value="Jälkiruoka"><?php echo $language['jälkiruoka']?></option>
                    <option value="Salaatti"><?php echo $language['salaatti']?></option>
                    <option value="Keitto"><?php echo $language['keitto']?></option>
                    <option value="Juoma"><?php echo $language['juoma']?></option>
					  </select>
				</div>
				<button type="submit" class="btn btn-primary">
        <?php echo $language['etsi']?>
        </button>
        </form>
   
  </div>
  <div class="table-responsive formit">
            <table class="table table-striped table-sm">
				<thead>
					<tr>
						<th><?php echo $language['reseptinimi']?></th>
						<th><?php echo $language['käyttäjä']?></th>
						<th><?php echo $language['annoksia']?></th>
						<th><?php echo $language['ohje']?></th>
						<th><?php echo $language['ruokavalio']?></th>
						<th><?php echo $language['reseptiryhmä']?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
                    <?php
                        $dataBase = new DataBase();
                        $dataBase->haerdmResepti("resepti1","56L9R7N6F3Otw3Ur","resepti1","localhost")
                    ?>
                    
				</tbody>
			</table>
          
   	</div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
            $(document).ready(function() {
                console.log("toimii");
                
                $("#new").click(function() {

                  window.location.href = "new.php";
                  
                });
            });
        </script>
  </body>
</html>