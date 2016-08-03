<?php
    require_once ("./includes/db.php");
?>
<html>
    <head>
        <style>
            table {
    border-collapse: collapse;
    align:center;
    width: 30%;
    margin-left:auto; 
    margin-right:auto
}

th, td {
    padding: 5px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

tr:hover{background-color:#f5f5f5}
</style>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table border="black">
            <?php
//getting countryID from the form that is in index.php
                $countryID=$_GET['countryID'];
//getting all cities which are connected to the given country  
                $citiesResult=  CountryDB::getInstance()-> get_all_cities_by_countryID($countryID);
//checking if the query has rows. If $num has value 0 then there are no cities connected to the country
                $num=  mysqli_num_rows($citiesResult);
                if($num<1){
//Output to tell the user that there are no cities from this country                   
                        echo "<tr><td colspan=2>No cities added</td></tr>";
                }
                else{
//extracting the cities for the given country and storing them in a table
                    echo "<tr><th>City</th><th>Population</th></tr>";
                    while($row=  mysqli_fetch_array($citiesResult)):
                        echo "<tr><td>".$row['name']."</td>";
                        echo "<td>".$row['population']."</td>";
                ?>
            <?php
                echo "</tr>";    
                endwhile;
                }
                mysqli_free_result($citiesResult);
            ?>
            <tr><td colspan="2">
                    <form name="backToMainPage" action="index.php">
                         <input type="submit" value="Back To Main Page"/>
                    </form>
                </td></tr>
            </table>
        
    </body>
</html>
