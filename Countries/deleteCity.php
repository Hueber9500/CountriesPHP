<?php
require_once ('./includes/db.php');
$cityID=$_POST['cityID'];
CountryDB::getInstance()->delete_city($cityID);
header('Location: viewCities.php' );
?>
