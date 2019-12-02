<?php
    
    print "Tietokanta auki</br></br>";

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

        // sql-komennot, esimerkki tuoteryhmä
        $statement = $connection->prepare("SELECT * FROM diet");
        $statement->execute();

        // vaihdetaan hakumoodiksi objecti
        $statement->setFetchMode(PDO::FETCH_OBJ);

        //haetaan kaikki rivit
        $result = $statement->fetchAll();

        //printataan rivejä
        foreach($result as $row) {
            print "$row->dietname";
            print "</br>";
            
        }


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