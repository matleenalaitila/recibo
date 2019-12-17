<?php
// Author: Marika Piuva, Matleena Laitila, Samuli Reinikka
    class DataBase {
    
    

       
// haerdmResepti
// gets a random recipe from database depending on search values
// prints on table in random.php
// Author: Marika Piuva
public function haerdmResepti($username, $password, $database, $host) {
        
$kategoria1 = filter_input(INPUT_GET, 'kategoriat1', FILTER_SANITIZE_STRING);
$kategoria2 = filter_input(INPUT_GET, 'kategoriat2', FILTER_SANITIZE_STRING);	
$recipeID = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_STRING);

        try {
        
            $conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               
            $sql = ("SELECT * FROM recipe WHERE diet = '$kategoria1' AND recipegroup = '$kategoria2'  ORDER BY RAND() LIMIT 1");
            $conn->beginTransaction();
            
			$statement = $conn->prepare($sql);
        	$statement->execute();

			//haetaan kaikki rivit
			$row = $statement->fetch(PDO::FETCH_OBJ);
	
			//commit (hyväksytään transaktio)
            $conn->commit();

            // printtaa taulukkoon arvot
            if($row != null){
                echo "<tr>";
				echo "<td>";	
                    echo $row->recipename;
                echo "</td>";
                echo "<td>";
                    print $row->userid;
                echo "</td>";
                echo "<td>" . $row->port . "</td>";
                echo "<td>" . $row->instruction . "</td>";
                echo "<td>" . $row->diet . "</td>";
                echo "<td>" . $row->recipegroup . "</td>";
                $reseptinimi = "";
                $reseptinimi = $row->recipename;
                
                //printtaa linkin josta ko. reseptin saa koko sivulle
                print "<td><a href='view.php?recipe=$row->ID'>Avaa</a></td>";
                
                // printtaa HTML-dokumenttii </tr> lopetustagin
                print "</tr>";
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
	
	/**
	 * searchAllRecipes
	 * gets all recipenames and their ID:s from database and 
	 * creates links of them to use on index.php
	 * Author: Matleena Laitila
	 * 
	 */
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
			$statement = $connection->prepare("SELECT recipename, ID FROM recipe ORDER BY timestamp DESC LIMIT 0, 3");
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



		/**
	 * gets all of the ingredients from database and creates options of them to
	 * use on index.php Ainesosa-category
	 * Author: Matleena Laitila
	 * 
	 */

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
	
// viewRecipe
// link to recipe from random.php opens to view.php where more details are shown from database
// Author: Marika Piuva
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

			// vaihdetaan hakumoodiksi objecti
			$statement->setFetchMode(PDO::FETCH_OBJ);
	
			//haetaan kaikki rivit
			$result = $statement->fetchAll();
            
            foreach($result as $row) {
				print "<p>";
				print "<div id='ohje'>";
				print "<h2>$row->recipename</h2>";
				print "<p><img src='$row->image' />";
				print "<i>$row->instruction</i>";
				print "</div>";
				print "</p>";
			}
			
			$statement2 = $connection->prepare("SELECT amount, ingredient, measure FROM ingredient where recipeid=:ID");
            $statement2->bindParam(':ID', $reseptiId);
            $statement2->execute();
    
            // vaihdetaan hakumoodiksi objecti
            $statement2->setFetchMode(PDO::FETCH_OBJ);

            //haetaan kaikki rivit
			$result = $statement2->fetchAll();
			
			//commit
			$connection->commit();
            
            foreach($result as $row) {
				print "<p>";
				print "<div id='ohje2'>";
				print "<i>$row->ingredient </i>";
                print "<i>$row->amount </i>";
				print "<i>$row->measure </i>";
				print "</div>";
                print "</p>";
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


	    /**
		 * searchRecipe2
		 * gets recipes from database according to selected categories and
		 * creates links of their names to use on index.php
		 * Author: Matleena Laitila
		 * 
		 */
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




	/**
	 * searchRecipeById
	 * gets and shows recipename, instruction and ingredients from database according 
	 * to recipe that has been selected on index page
	 * Author: Matleena Laitila
	 * 
	 */
		public function searchRecipeById($username, $password, $database, $host, $reseptiId){
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
	
	
			

            foreach($result as $row) {
				
				print "<h2>$row->recipename</h2>";
				print "<i>$row->instruction</i>";
			}

					$sql2 = "SELECT amount, ingredient, measure FROM ingredient where recipeid=:ID";
					$statement2 = $connection->prepare($sql2);
					$statement2->bindParam(':ID', $reseptiId);

					$statement2->execute();
		
					// vaihdetaan hakumoodiksi objecti
					$statement2->setFetchMode(PDO::FETCH_OBJ);
			
					//haetaan kaikki rivit
					$result = $statement2->fetchAll();
			
					//commit (hyväksytään transaktio)
					
					$connection->commit();

					foreach($result as $row) {
						print "<p>";
						print "<div id='maarat'>";
						print "<i>$row->ingredient </i>";
						print "<i>$row->amount </i>";
						print "<i>$row->measure </i>";
						print "</div>";
						print "</p>";
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
	
/*author Samuli Reinikka */
	
	public function SaveRecipe($username, $password, $database, $host){
		
		$recipename = filter_input(INPUT_POST, 'reseptinimi', FILTER_SANITIZE_STRING);
		$inputUserName = filter_input(INPUT_POST, 'kayttaja', FILTER_SANITIZE_STRING);
		$diet = filter_input(INPUT_POST, 'kategoriat1', FILTER_SANITIZE_STRING);
		$recipegroup =filter_input(INPUT_POST, 'kategoriat2', FILTER_SANITIZE_STRING);
		$port = filter_input(INPUT_POST, 'maara', FILTER_SANITIZE_NUMBER_INT);
		$instruction = filter_input(INPUT_POST, 'valmistusohje', FILTER_SANITIZE_STRING);
		
		// $ingredient= implode(", ",$_POST['ingredient']); 
		// $amount= implode(", ",$_POST['amount']);
		// $measure= implode(", ",$_POST['measure']);
		// $ingredient = $_POST['ingredient'];
		$ingredient= implode(", ",$_POST['ingredient']); 
		$amount = $_POST['amount'];
		$measure = $_POST['measure'];
		// echo "Testi: " . $numIngredients;
	
		// $amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_INT);
		// $measure = filter_input(INPUT_POST, 'measure', FILTER_SANITIZE_STRING);

		try {
			
			$connection = new PDO("mysql:host=$host;dbname=$database;", $username, $password);
			// set the PDO error mode to exception
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//aloitetaan transaktio
			$connection->beginTransaction();
			
//recipe TABLE	
	//Find userID;
			$sqlFindUser = "SELECT ID FROM rk_user WHERE username = '$inputUserName'";
			$userID = $connection -> prepare($sqlFindUser);
			$userID -> execute();
			$resultUser = $userID -> fetch();
			$userid = $resultUser['ID'];
			

	//Find rk_groupID;
			$sqlFindGroup = "SELECT ID FROM rk_group WHERE groupname = '$recipegroup'";
			$groupID = $connection -> prepare($sqlFindGroup);
			$groupID -> execute();
			$resultGroup = $groupID -> fetch();
			$rk_groupID = $resultGroup['ID'];
			
	//Timestamp
			$date = date("Y-m-d H:i:s");  

	// tähän sql-komennot, jossa saadaan talteen tiedot
				
			$sql = "INSERT INTO recipe (recipename,timestamp,userid,port,instruction,diet,recipegroup,rk_group) 
			VALUE (:recipename,:timestamp, $userid ,:port,:instruction,:diet,:recipegroup, $rk_groupID );";
		
			$statement = $connection->prepare($sql);

			$statement->bindValue(":recipename", $recipename, PDO::PARAM_STR);
			$statement->bindValue(":timestamp", $date);
			$statement->bindValue(":port", $port, PDO::PARAM_INT);
			$statement->bindValue(":instruction", $instruction, PDO::PARAM_STR);
			$statement->bindValue(":diet", $diet, PDO::PARAM_STR);
			$statement->bindValue(":recipegroup", $recipegroup, PDO::PARAM_STR);
		
			$statement->execute();	

//ingredient TABLE			
	//Catch last inserted id
			// $queryLastId ="SELECT AUTO_INCREMENT FROM information_schema.TABLES
			// WHERE TABLE_SCHEMA = 'resepti1' 
			// AND TABLE_NAME = 'recipe';";
			
	//Find recipeID
			$sqlFindId = "SELECT ID FROM recipe WHERE recipename = '$recipename'";
			$recipeID = $connection -> prepare($sqlFindId);
			$recipeID -> execute();
			$result = $recipeID -> fetch();
			$recipeid = $result['ID'];
			
		
	//Asetetaan ingredient taulukkoon käyttäjän syöttämien  rivien mukaan arvot		
			$ingredient = $_POST['ingredient'];
			$amount = $_POST['amount'];
			$measure = $_POST['measure'];

			$dataToInsert = array();
			$tblName = "ingredient";
			$colNames = array("recipeid","ingredient","amount","measure"); 
			
			$ingredientCount= count($ingredient);
	// Voi tarkistaa kuinka monta ainesosaa on lisätty(montako riviä löytyy)
			// print $ingredientCount;
	
	//otetaan tarvittava määrä rivejä talteen
			$i=0;
			while($i<$ingredientCount){
				$dataVals[] = array('recipeid' => $recipeid, 'ingredient' => $ingredient[$i], 'amount' => $amount[$i], 'measure' => $measure[$i] );
				$i++;
			}

	// Voi tarksitaa taulukon rakenteen
	// print_r($dataVals);

			foreach ($dataVals as $row => $data) {
				foreach($data as $val) {
					$dataToInsert[] = $val;
				}
			}
	
	// setup the placeholders - a fancy way to make the long "(?, ?, ?)..." string
			$rowPlaces = '(' . implode(', ', array_fill(0, count($colNames), '?')) . ')';
			$allPlaces = implode(', ', array_fill(0, count($dataVals), $rowPlaces));
			
			$sql = "INSERT INTO $tblName (" . implode(', ', $colNames) . 
				") VALUES " . $allPlaces;
			
	// and then the PHP PDO boilerplate
			$stmt = $connection->prepare ($sql);
			
			try {
			   $stmt->execute($dataToInsert);
			} catch (PDOException $e){
			   echo $e->getMessage();
			}
			

			//commit (hyväksytään transaktio)
			$connection->commit();
			echo "Tiedot tallennettiin onnistuneesti!";
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

       