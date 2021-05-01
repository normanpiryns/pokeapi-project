<?php 
include('model/entities/Pokemon.php');
include('model/dao/PokemonDAO.php');
include('controller/PokemonController.php');
$pokemonController = new PokemonController ();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Pokémon App</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

<?php

if(isset($_POST) && isset($_POST['delete-pokemon'])) {
	$pokemonController->delete($_POST);
};

if (isset($_POST) && isset($_POST['name']) && isset($_POST['image'])) {
    $obj  = array('name' => $_POST['name'], 'image' => $_POST['image']);
    $pokemonController->add($obj);
}



$pokemonController->showRecherche();
$pokemonController->list();
?>


</body>
</html>