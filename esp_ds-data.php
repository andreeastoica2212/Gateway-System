<html><body>
<?php
$servername = “192.168.0.73”;
$dbname = “esp_ds_data”;
$username = "admin";
$password = "parola";

//realizeaza conexiunea la baza de date
$conn = new mysqli($servername, $username, $password, $dbname);
//verifica daca s-a putut conecta
if ($conn->connect_error) {
    die(“Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT id, sensor, location, value1, reading_time FROM SensorData ORDER BY id DESC";
//creaza un tabel in care va afisa datele
echo '<table cellspacing="5" cellpadding="5">
      <tr> 
        <td>ID</td> //header pt coloane
        <td>Senzor</td> 
        <td>Locatie</td> 
        <td>Temperatura (grade Celsius)</td> 
        <td>Timp</td> 
      </tr>';
 
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_id = $row[“id"];
        $row_sensor = $row["sensor"];
        $row_location = $row["location"];
        $row_value1 = $row[“value1"]; //preia in variabila valoarea temperaturii
        $row_reading_time = $row["reading_time"];
      
        echo '<tr>  //afiseaza valorile preluate din baza de date
                <td>' . $row_id . '</td> 
                <td>' . $row_sensor . '</td> 
                <td>' . $row_location . '</td> 
                <td>' . $row_value1 . '</td> 
                <td>' . $row_reading_time . '</td> 
              </tr>';
    }
    $result->free(); //elibereaza obiectul rezultate de datele redundante acum
}
$conn->close(); //inchide conexiunea
?> 
</table>
</body>
</html>
