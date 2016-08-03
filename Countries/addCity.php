<?php
    require_once ("./includes/db.php");
    $cityIsEmpty=false;
    $countryIsEmpty=false;
    $populationIsEmpty=false;
    $existSuchCity=false;
    
    if($_SERVER['REQUEST_METHOD']=="POST"){
//check if city filed in the form is empty
        if($_POST['city']==""){
            $cityIsEmpty=true;
        }
//check if country filed in the form is empty
        if($_POST['country']==""){
            $countryIsEmpty=true;
        }
//check if population filed in the form is empty
        if($_POST['population']==""){
            $populationIsEmpty=true;
        }
//if all fields in the form are filled we should proceed to the next check before adding the record to the databse
        if(!$cityIsEmpty && !$countryIsEmpty && !$populationIsEmpty){
            $city=$_POST['city'];
            $country=$_POST['country'];
            $population=$_POST['population'];
//boolean variable for checking the existence of city with given parameters
            $existSuchCity=CountryDB::getInstance()->check_if_city_exists($city,$country,$population);
//add the city to the database and return back to the main page(index.php) if the boolean has value FALSE
            if(!$existSuchCity){
                CountryDB::getInstance()->add_city($city,$country,$population);
                header('Location: index.php');
                exit;
            }
        }
    }  
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
    <body><table>
            
        <form name="addCity" action="addCity.php" method="POST">
            <tr>
            <td>City:</td> <td><input type="text" name="city" value="">
            <?php
//notifying the user that he did not enter text in the city field
                if($cityIsEmpty)
                    echo "Please enter City";
            ?>
                </td>
            </tr>
            <tr>
                <td>Country:</td> <td><select name="country">
                <option value="">Select country</option>
                <?php
//getting the countries data with a SELECT query
                    $countriesResult=  CountryDB::getInstance()->get_all_countries();
//getting one record from the above SELECT query and proceeding it's values to the variables
                    while($row = mysqli_fetch_array($countriesResult)):
                        $countryID=$row['id'];
                        $countryName=$row['name'];
                ?>
                
                <option value="<?php echo $countryID;?>"><?php echo $countryName ;?></option> 
                <?php
                endwhile;
                ?>
                    </select>
            <?php
//notifying the user that he did not select any of the given values from the dropdown menu
                if($countryIsEmpty)
                    echo "Please select Country";
            ?>
                    </td>
            </tr>
            <tr>
                <td>Population:</td> <td><input type="text" name="population" value="">
            <?php
//notifying the user that he did not enter text in the population field
                if($populationIsEmpty)
                    echo "Please enter Population";
            ?>
                    </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="addCity" value="Add City">
                </td> 
            </tr>
            <?php
//notifying the user that he there is an existing city with the given parameters
                if($existSuchCity){
                    echo "<tr><td colspan=2>This city exist</td></tr>";
                }
            ?>
        </form>
        </table>
        <table>
            <tr>
                <td>
                    
                    <form name="back" action="index.php">
                        <input type="submit" value="Main page">
                    </form>
                </td>
            </tr>
        </table>
    </body>
</html>
