<?php require_once ("./includes/db.php");?>
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
         <th>Country</th>
         <th>Cities</th>
             <?php
            $result=  CountryDB::getInstance()->get_all_countries();
            while($row = mysqli_fetch_array($result)):
                $countryID=$row['id'];    
                echo "<tr><td>".$row['name']."</td>";
            ?>
         <td>
             <form name="viewCities" action="viewCities.php" method="GET">
                 <input type="hidden" name="countryID" value="<?php echo $countryID; ?>">
                 <input type="submit" name="viewCities" value="View Cities">
             </form>
         </td>
         <?php
            echo "</tr>\n";
            endwhile;
            mysqli_free_result($result);
            ?>
         <tr><td colspan="2"><form name="addCity" action="addCity.php" method="GET" >
            <input type="submit" name="addCity" value="Add City">
        </form></td></tr>
    </table>
        
        
    </body>
</html>
