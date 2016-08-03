<?php
// CountryDB is a class which consists all functions that are used
    class CountryDB extends mysqli{
        private static $instance=null;
        
        private $user="root";
        private $pass="";
        private $dbName="countriescities";
        private $dbHost="localhost";
        
        public static function getInstance(){
            if(!self::$instance instanceof self){
                self::$instance=new self;
            }
            return self::$instance;
        }
        public function __clone() {
            trigger_error('Clone is not allowed',E_USER_ERROR);
        }
        public function __wakeup() {
            trigger_error('Deserializing is not allowed',E_USER_ERROR);
        }
        public function __construct() {
            parent::__construct($this->dbHost,$this->user,$this->pass,$this->dbName);
            if(mysqli_connect_error()){
                exit('Connect error ('. mysqli_connect_errno()) .')'.mysqli_connect_error();
            }
            parent::set_charset('utf-8');
        }
//SELECT query for extracting all data from countries table sorted in ASCENDING order by their name
        public function get_all_countries(){
            $query="SELECT * FROM Countries ORDER BY name ASC";
            return $this->query($query);
        }
//SELECT query for extracting all data from cities table for a given criteria and sorted in DESCENDING order by population
        public function get_all_cities_by_countryID($countryID){
            $query="SELECT * FROM Cities WHERE countryID='".$countryID."'ORDER BY population DESC";
            return $this->query($query);
        }
//INSERT INTO query for adding a record to the cities table
        public function add_city($name,$countryID,$population){
            $name=  $this->real_escape_string($name);
            $population=  $this->real_escape_string($population);
            $query="INSERT INTO cities (name,countryID,population)".
                    "VALUES ('".$name."',".$countryID.",".$population.")";
            $this->query($query);
        }
//boolean function that SELECT query for taking the record with given parameters from the database
//and then checks it's row number if it is 0 then there is no such city        
        public function check_if_city_exists($name,$countryID,$population){
            $name=  $this->real_escape_string($name);
            $population=  $this->real_escape_string($population);
            $query="SELECT * FROM cities WHERE name='".$name."' AND countryID=".$countryID." AND population=".$population;
            $result= $this->query($query);
            $num=  mysqli_num_rows($result);
            if($num<1){
                return false;
            }
            return true;
        }
 //DELETE query for deleting a row in the cities table by given countryID      
        public function delete_city($cityID){
            $sqlQuery="DELETE FROM cities WHERE id = ".$cityID;
            $this->query($sqlQuery);
        }
    }

?>

