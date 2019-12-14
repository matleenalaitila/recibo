<?php
    include_once("Language.php");
    include("DataBase.php");


    $database = new DataBase();
    $database->SaveRecipe("resepti1","56L9R7N6F3Otw3Ur","resepti1","localhost");
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
    
   </head>
<body>
  <a href="index.php"><?php echo $language['homepage']?></a>
</body>
</html>