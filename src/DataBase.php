<?php
    
    class DataBase {
    
       private $username = "demoxUser";
       private $password = "HQWWltVOQrsAe9qd";
       private $database = "resepti1";
       private $host = "localhost";   

       
  
public function haerdmResepti($username, $password, $database, $host) {
        
 
        
        try {
        
            $conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //print "Tietokannan avaus onnistui";
            // SELECT * FROM recipe
            // WHERE diet.id = 4 AND rk_group.id = '4'
            // ORDER BY RAND()
            // LIMIT 1 -->
            //miten saan hakemaan mikä diet.id ja rk_group.id on valittu formilta?
            $sql = "";        
            $sql = ("SELECT * FROM recipe ORDER BY RAND() LIMIT 1");
            $conn->beginTransaction();
            
			$statement = $conn->prepare($sql);
        	$statement->execute();

			// vaihdetaan hakumoodiksi objecti
			$statement->setFetchMode(PDO::FETCH_OBJ);
	
			//haetaan kaikki rivit
			$row = $statement->fetch();
	
	
			//commit (hyväksytään transaktio)
		    
            $conn->commit();


            
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
                print "<td><a href='edit.php?astunnus=$reseptinimi'>Avaa</a></td>";
                
                // printtaa HTML-dokumenttii </tr> lopetustagin
                print "</tr>";
             
        
            
        }
            catch(PDOException $e)
            {
        
                // rollback eli perutaan transaktio
                $conn->rollback();
                echo "Tietokantavirhe: " . $e->getMessage();
            }
            
     $conn = null;
    }
   public function searchFromDiet(){
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

    public function searchRecipe(){
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
	
			// tähän sql-komennot, jossa saadaan talteen tiedot
			$statement = $connection->prepare("SELECT recipename FROM recipe");
        	$statement->execute();

			// vaihdetaan hakumoodiksi objecti
			$statement->setFetchMode(PDO::FETCH_OBJ);
	
			//haetaan kaikki rivit
			$result = $statement->fetchAll();
	
	
			//commit (hyväksytään transaktio)
            $connection->commit();
            

            foreach($result as $row) {
                
                print "<h2>" . $row->recipename . "</h2>";
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


    public function searchIngredient(){
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

}

       