<?php
$servername = “192.168.0.73”; /*adresa alocata raspberryului de 
catre routerul Wi-Fi*/
PHP
//numele bazei de date in care se insereaza informatia
$dbname = “esp_ds_data”;
//userul ce acceseaza baza de date - admin are drepturi depline
//toate cele pe care le are si root
$username = "admin";
//parola pentru acces la baza de date
$password = "parola";

//cheie de autentificare pentru accesul la interfata php
$api_key_value = "tPmAT5Ab3j7F9";

$api_key= $sensor = $location = $value1 = "";

//preia valorile trimise de esp2866 si le retine in format
//html prin functia test_input (ultima functie)
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) 
	{
        $sensor = test_input($_POST["sensor"]);
        $location = test_input($_POST["location"]);
        $value1 = test_input($_POST["value1"]);
        
        //crearea conexiunii la baza de date
        $conn = new mysqli($servername, $username, $password, $dbname);
        // verifica daca conexiunea s-a facut si printeaza eroarea in cazul in care nu s-a realizat
        if ($conn->connect_error) {
            die(“Connection failed: " . $conn->connect_error);
        } 
        
	   //insereaza valorile primite de la sensor in baza de date
        $sql = "INSERT INTO SensorData (sensor, location, value1)
        VALUES ('" . $sensor . "', '" . $location . "', '" . $value1 . "')";
        
	   //verifica daca querryul a fost executat cu succes
        if ($conn->query($sql) === TRUE) 
            echo “New record created successfully!”;
        else 
            echo "Error: " . $sql . "<br>" . $conn->error;
    
	   //inchide conexiunea la baza de date
        $conn->close();
    }
    else 
        echo “Wrong API Key provided!"; //caz pentru care api keyul nu coincide cu cel trimise de esp8266
	
}
else 
    echo “No data posted with HTTP POST!.”;

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
