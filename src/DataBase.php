<?php

    class DataBase {
    
       private $username = "resepti1";
       private $password = "56L9R7N6F3Otw3Ur";
       private $database = "resepti1";
       private $host = "localhost";   

       
  
public function haerdmResepti($username, $password, $database, $host) {
        
$kategoria1 = filter_input(INPUT_GET, 'kategoriat1', FILTER_SANITIZE_STRING);
$kategoria2 = filter_input(INPUT_GET, 'kategoriat2', FILTER_SANITIZE_STRING);	
$recipeID = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_STRING);
        
        try {
        
            $conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "";        
            $sql = "SELECT * FROM recipe WHERE diet = '$kategoria1' AND recipegroup = '$kategoria2'  ORDER BY RAND() LIMIT 1";
            $conn->beginTransaction();
            
			$statement = $conn->prepare($sql);
        	$statement->execute();

			// vaihdetaan hakumoodiksi objecti
			$statement->setFetchMode(PDO::FETCH_OBJ);
	
			//haetaan kaikki rivit
			// $result = $statement->fetch();
			$row = $statement->fetch();
	
			//commit (hyväksytään transaktio)
		    
            $conn->commit();

            // foreach($result as $row) {
            
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
                $reseptinimi = "";
                $reseptinimi = $row->recipename;
                
                //printtaa linkin josta ko. reseptin saa koko sivulle
                print "<td><a href='view.php?recipe=$row->ID'>Avaa</a></td>";
                
                // printtaa HTML-dokumenttii </tr> lopetustagin
                print "</tr>";
			// }
    
        }
            catch(PDOException $e)
            {
        
                // rollback eli perutaan transaktio
                $conn->rollback();
                echo "Tietokantavirhe: " . $e->getMessage();
            }
            
     $conn = null;
	}
	
	
    public function searchAllRecipes($username, $password, $database, $host){
		//asetellaan muuttujilla arvot
		
        $servername = "localhost";
        $username = "resepti1";
        $password = "56L9R7N6F3Otw3Ur";
        $dbname = "resepti1";
		$recipename = filter_input(INPUT_GET, 'recipename', FILTER_SANITIZE_STRING);

		try {
			$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// set the PDO error mode to exception
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//aloitetaan transaktio
			$connection->beginTransaction();
	
			// tähän sql-komennot, jossa saadaan talteen tiedot
			$statement = $connection->prepare("SELECT recipename, ID FROM recipe ORDER BY timestamp");
        	$statement->execute();

			// vaihdetaan hakumoodiksi objecti
			$statement->setFetchMode(PDO::FETCH_OBJ);
	
			//haetaan kaikki rivit
			$result = $statement->fetchAll();
	
	
			//commit (hyväksytään transaktio)
            $connection->commit();
            

            foreach($result as $row) {
                print "<a class='klikkaa' href='recipe.php?recipe=$row->ID'>" . $row->recipename . "</a>";
            }
		}
		catch(PDOException $e)
		{
	
			// rollback eli perutaan transaktio
			$connection->rollback();
			echo "Tietokantavirhe: " . $e->getMessage();
		}
	
		// suljetaan tietokantayhteys
        $connection = null;
    }


   public function searchFromDiet($username, $password, $database, $host){
		//asetellaan muuttujilla arvot
		
        $servername = "localhost";
        $username = "resepti1";
        $password = "56L9R7N6F3Otw3Ur";
        $dbname = "resepti1";
	
		try {
			$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// set the PDO error mode to exception
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//aloitetaan transaktio
			$connection->beginTransaction();
	
			// tähän sql-komennot, jossa saadaan talteen tiedot
			$statement = $connection->prepare("SELECT * FROM diet");
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
    }

    
	public function searchRecipe2($username, $password, $database, $host) {
        
		$kategoria1 = filter_input(INPUT_GET, 'kategoriat1', FILTER_SANITIZE_STRING);
			$kategoria2 = filter_input(INPUT_GET, 'kategoriat2', FILTER_SANITIZE_STRING);	
			$ainesosa = filter_input(INPUT_GET, 'ainesosa', FILTER_SANITIZE_STRING);	

			$recipename = filter_input(INPUT_GET, 'recipename', FILTER_SANITIZE_STRING);	
				try {
				
					$conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sql = "";        
					$sql = "SELECT * FROM recipe, ingredient WHERE recipe.ID=ingredient.recipeid AND diet = '$kategoria1' AND recipegroup = '$kategoria2' AND ingredient = '$ainesosa' GROUP BY recipename";
					$conn->beginTransaction();
					
					$statement = $conn->prepare($sql);
					$statement->execute();
		
					// vaihdetaan hakumoodiksi objecti
					$statement->setFetchMode(PDO::FETCH_OBJ);
			
					//haetaan kaikki rivit
					// $result = $statement->fetch();
					$result = $statement->fetchAll();
			
					//commit (hyväksytään transaktio)
					
					$conn->commit();
						
					foreach($result as $row) {
						print "<a class='klikkaa' href='recipe.php?recipe=$row->recipeid'>" . $row->recipename . "</a>";
					}
			
				}
					catch(PDOException $e)
					{
				
						// rollback eli perutaan transaktio
						$conn->rollback();
						echo "Tietokantavirhe: " . $e->getMessage();
					}
					
			 $conn = null;
			}



	public function searchRecipeById($username, $password, $database, $host, $ID){
		//asetellaan muuttujilla arvot
		
        $servername = "localhost";
        $username = "resepti1";
        $password = "56L9R7N6F3Otw3Ur";
		$dbname = "resepti1";
		$reseptiId = filter_input(INPUT_GET, 'recipe', FILTER_SANITIZE_STRING);
		

		try {
			$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// set the PDO error mode to exception
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//aloitetaan transaktio
			$connection->beginTransaction();
	
			// tähän sql-komennot, jossa saadaan talteen tiedot
			$statement = $connection->prepare("SELECT * FROM recipe WHERE ID=:ID");
			$statement->bindParam(':ID', $reseptiId);
        	$statement->execute();

			// vaihdetaan hakumoodiksi objecti
			$statement->setFetchMode(PDO::FETCH_OBJ);
	
			//haetaan kaikki rivit
			$result = $statement->fetchAll();
	
	
			//commit (hyväksytään transaktio)
            $connection->commit();
            
			

            foreach($result as $row) {
				
				print "<h2>$row->recipename</h2>";
				print "<i>$row->instruction</i>";
			}
			
		}
		catch(PDOException $e)
		{
	
			// rollback eli perutaan transaktio
			$connection->rollback();
			echo "Tietokantavirhe: " . $e->getMessage();
		}
	
		// suljetaan tietokantayhteys
        $connection = null;
    }


    public function searchIngredient($username, $password, $database, $host){
		//asetellaan muuttujilla arvot

		$servername = "localhost";
        $username = "resepti1";
        $password = "56L9R7N6F3Otw3Ur";
        $dbname = "resepti1";
	
		try {
			$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// set the PDO error mode to exception
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//aloitetaan transaktio
			$connection->beginTransaction();
	
			// tähän sql-komennot, jossa saadaan talteen tiedot
			$statement = $connection->prepare("SELECT DISTINCT ingredient FROM ingredient");
        	$statement->execute();

			// vaihdetaan hakumoodiksi objecti
			$statement->setFetchMode(PDO::FETCH_OBJ);
	
			//haetaan kaikki rivit
			$result = $statement->fetchAll();
	
	
			//commit (hyväksytään transaktio)
            $connection->commit();
            
            foreach($result as $row) {
                print "<option ingredient=$row->ingredient>$row->ingredient</option>";
            }
            

		
		}
		catch(PDOException $e)
		{
	
			// rollback eli perutaan transaktio
			$connection->rollback();
			echo "Tietokantavirhe: " . $e->getMessage();
		}
	
		// suljetaan tietokantayhteys
        $connection = null;
    }

	public function getRecipeInstruction($username, $password, $database, $host){
		//asetellaan muuttujilla arvot
		
		$servername = "localhost";
        $username = "resepti1";
        $password = "56L9R7N6F3Otw3Ur";
		$dbname = "resepti1";
		
		try {
			$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// set the PDO error mode to exception
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//aloitetaan transaktio
			$connection->beginTransaction();
	
			// tähän sql-komennot, jossa saadaan talteen tiedot
			$statement = $connection->prepare("SELECT instruction FROM recipe");
        	$statement->execute();

			// vaihdetaan hakumoodiksi objecti
			$statement->setFetchMode(PDO::FETCH_OBJ);
	
			//haetaan kaikki rivit
			$result = $statement->fetchAll();
	
	
			//commit (hyväksytään transaktio)
			$connection->commit();
			
			print "</br>";
            foreach($result as $row) {
			print "<p>" . $row->instruction . "</p>";
			}
			
			

		
		}
		catch(PDOException $e)
		{
	
			// rollback eli perutaan transaktio
			$connection->rollback();
			echo "Tietokantavirhe: " . $e->getMessage();
		}
	
		// suljetaan tietokantayhteys
        $connection = null;
	}
	
	public function SaveRecipe($username, $password, $database, $host){
		try {
			$connection = new PDO("mysql:host=$host;dbname=$database", $username, $password);
			// set the PDO error mode to exception
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//aloitetaan transaktio
			$connection->beginTransaction();
	
			// tähän sql-komennot, jossa saadaan talteen tiedot
			$statement = $connection->prepare("SELECT recipename FROM recipe ORDER BY timestamp");
        	$statement->execute();

			// vaihdetaan hakumoodiksi objecti
			$statement->setFetchMode(PDO::FETCH_OBJ);
	
			//haetaan kaikki rivit
			$result = $statement->fetchAll();
	
	
			//commit (hyväksytään transaktio)
            $connection->commit();
            

            foreach($result as $row) {
                print "<a class='klikkaa' href='recipe.php?recipe=recipename'>" . $row->recipename . "</a>";
            }
		}
		catch(PDOException $e)
		{
	
			// rollback eli perutaan transaktio
			$connection->rollback();
			echo "Tietokantavirhe: " . $e->getMessage();
		}
	
		// suljetaan tietokantayhteys
        $connection = null;

	}

	public function viewRecipe($username, $password, $database, $host, $ID){
		//asetellaan muuttujilla arvot
		
        $servername = "localhost";
        $username = "resepti1";
        $password = "56L9R7N6F3Otw3Ur";
		$dbname = "resepti1";
		$reseptiId = filter_input(INPUT_GET, 'recipe', FILTER_SANITIZE_STRING);
		

		try {
			$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// set the PDO error mode to exception
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//aloitetaan transaktio
			$connection->beginTransaction();
	
			// tähän sql-komennot, jossa saadaan talteen tiedot
			$statement = $connection->prepare("SELECT * FROM recipe WHERE ID=:ID");
			$statement->bindParam(':ID', $reseptiId);
			$statement->execute();
			
			$statement = $connection->prepare("SELECT amount, ingredient, measure FROM ingredient where recipeid=ID");
			$statement->bindParam(':ID', $reseptiId);
			$statement->execute();
			

			// vaihdetaan hakumoodiksi objecti
			$statement->setFetchMode(PDO::FETCH_OBJ);
	
			//haetaan kaikki rivit
			$result = $statement->fetchAll();
	
	
			//commit (hyväksytään transaktio)
            $connection->commit();
            
			

            foreach($result as $row) {
				
				print "<h2>$row->recipename</h2>";
				print "<i>$row->instruction</i>";
				print "<i>$row->ingredient</i>";
				//pitäisi saada tulostettua ainesosat, joita on useampi per resepti, kuva olisi myös kiva
			}
			
		}
		catch(PDOException $e)
		{
	
			// rollback eli perutaan transaktio
			$connection->rollback();
			echo "Tietokantavirhe: " . $e->getMessage();
		}
	
		// suljetaan tietokantayhteys
        $connection = null;
    }


}


       