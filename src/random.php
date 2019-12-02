<?php
  $kategoria1 = filter_input(INPUT_GET, 'kategoriat1', FILTER_SANITIZE_STRING);
  $kategoria2 = filter_input(INPUT_GET, 'kategoriat2', FILTER_SANITIZE_STRING);
    function haerdmResepti() {
        
        $username = "demo1234";
        $password = "6-js72&2tYE##NX";
        $database = "reseptikanta";
        $host = "localhost";
        
        try {
            $conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
            
            $sql = "SELECT * FROM recipe WHERE diet.id = $kategoria1 AND rk_group.id = $kategoria2 ORDER BY RAND() LIMIT"
          
            
            $query = $conn->query($sql);
            $query->setFetchMode(PDO::FETCH_OBJ);
            
            while($row = $query->fetch()) {
                // printtaa HTML-dokumenttiin <tr> tagin
                print "<tr>";
				
				print "<td>";	
                    print $row->recipename;
                print "</td>";
                
                print "<td>";
                    print $row->userid;
                print "</td>";
            
                print "<td>" . $row->port . "</td>";
                print "<td>" . $row->instruction . "</td>";
                print "<td>" . $row->diet . "</td>";
                print "<td>" . $row->recipegroup . "</td>";
                
                $reseptinimi = $row->recipename;
                
                //printtaa linkin josta ko. reseptin saa koko sivulle
                print "<td><a href='edit.php?astunnus=$reseptinimi'>Avaa</a></td>";
                
                // printtaa HTML-dokumenttii </tr> lopetustagin
                print "</tr>";
            }
            
            
        } catch(PDOException $pdoex) {
            print "Tietokannan avaus epäonnistui " . $pdoex->getMessage();
        }
        
        $conn = null;

    }
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

  </head>
  <body class="bg" style="background-image: url('css/salad.jpg');">
    <h1>
        Recibo  <small>Reseptejä joka hetkeen</small>
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
					<label for="diet">
						Ruokavalio
					</label>
					</br>
					<select name="kategoriat1">
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
				<div class="form-group">
					<label for="groupname">
						Reseptiryhmä
					</label>
					</br>
					<select name="kategoriat2">
						<option value="Alkuruoka">Alkuruoka</option>
						<option value="Pääruoka">Pääruoka</option>
						<option value="Aamu-, väli- ja iltapala">Aamu-, väli- ja iltapala</option>
						<option value="Jälkiruoka">Jälkiruoka</option>
						<option value="Salaatti">Salaatti</option>
						<option value="Keitto">Keitto</option>
						<option value="Juoma">Juoma</option>
					  </select>
				</div>
				<button type="submit" class="btn btn-primary">
					Hae
        </button>
        </form>
   
  </div>
  <div class="table-responsive formit">
            <table class="table table-striped table-sm">
				<thead>
					<tr>
						<th>Reseptinimi</th>
						<th>Käyttäjä</th>
						<th>Annoksia</th>
						<th>Ohje</th>
						<th>Ruokavalio</th>
						<th>Reseptiryhmä</th>
						<th>Avaa</th>
					</tr>
				</thead>
				<tbody>
                    <?php
                        haerdmResepti();
                    ?>
                    
				</tbody>
			</table>
				
			<button id="new">Avaa</button>
          </div>
          
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