<?php
include("DataBase.php");
include("language.php");	
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
    <script>
							function addRow() {
							var table = document.getElementById("container");
							var row = table.insertRow(2);
							var ingredient = row.insertCell(0);
							var amount = row.insertCell(1);
							var measure = row.insertCell(2);
							ingredient.innerHTML = '<input type="text" id="ingredient" name="ingredient[]" />';
							amount.innerHTML = '<input type="number" id="amount" name="amount[]"/>';
							measure.innerHTML = '<input type="text" id="measure" name="measure[]" />';
							}
						</script>
   </head>
  <body class="bg" style="background-image: url('css/salad.jpg');">
  <h1>
  <div><a class="kielet" href="save.php?language=fi"><?php echo $language['language-fi']?></a><a class="kielet" href="save.php?language=en"><?php echo $language['language-en']?></a></div>
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
                <li class="nav-item">
                  <a class="nav-link" href="random.php">Arvo resepti</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="save.php">Lisää resepti<span class="sr-only">(current)</span></a>
                </li>
              </ul>
            </div>
		  </nav>
		  
		  <form class="formit" role="form" action="tallenna.php" method="POST">
				<div class="form-group">
					<label for="recipename">
						Reseptin nimi
					</label>
					<input type="text" class="form-control" id="text1" name="reseptinimi">
				</div>
				<div class="form-group">
					<label for="userid">
						Käyttäjänimesi
					</label>
					<input type="text" class="form-control" id="text1" name="kayttaja">
				</div>
				<div class="form-group">
					<label for="port">
						Annosten määrä
					</label>
					<input type="number" class="form-control" id="text1" name="maara">
				</div>
				<div class="form-group">
					<label for="diet">
						Ruokavalio
					</label>
					</br>
					<select name="kategoriat1">
						<option value="Kasvisruoka">Kasvisruoka</option>
						<option value="Liharuoka">Liharuoka</option>
						<option value="Gluteeniton">Gluteeniton</option>
						<option value="Maidoton">Maidoton</option>
						<option value="Kananmunaton">Kananmunaton</option>
						<option value="Vegaaninen">Vegaaninen</option>
						<option value="Sokeriton">Sokeriton</option>
						<option value="Vahahiilihydraattinen">Vähähiilihydraattinen</option>
					  </select>
				</div>
				<div class="form-group">
					<label for="groupname">
						Reseptiryhmä
					</label>
					</br>
					<select name="kategoriat2">
						<option value="Alkuruoka">Alkuruoka</option>
						<option value="Paaruoka">Pääruoka</option>
						<option value="Aamu-, vali- ja iltapala">Aamu-, väli- ja iltapala</option>
						<option value="Jalkiruoka">Jälkiruoka</option>
						<option value="Salaatti">Salaatti</option>
						<option value="Keitto">Keitto</option>
						<option value="Juoma">Juoma</option>
					  </select>
				</div>
				<div class="form-group">
						<label for="aines1">
							Ainesosat
						</label>
						</br>
						<table id="container">
							<tr>
								<th>Ainesosan nimi</th>
								<th>Määrä</th> 
								<th>Mittayksikkö</th>
							</tr>
							<tr>
								<td><input type="text" id="ingredient" name="ingredient[]" /></td>
								<td><input type="number" id="amount" name="amount[]"/></td>
								<td><input type="text" id="measure" name="measure[]" /></td>
							</tr>
						</table>
						<button type="button" onclick="addRow()">Lisää rivi</button>
						
				</div>
				<div class="form-group">	 
					<label for="instruction">
						Valmistusohje
					</label>
					</br>
					<textarea rows="4" cols="75" name="valmistusohje">
					</textarea>
				</div>
				<div class="form-group">
					<label for="kuvalataus">
						Lataa kuva
					</label>
					<input type="file" class="form-control-file" id="kuva">
					<p class="help-block">
						Lataa kuva reseptin tuotoksesta.
					</p>
				</div> 
				<button type="submit" class="btn btn-primary">
					Tallenna
				
				</button>
			</form>
		
   	</div>
    </div>






    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>