<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "community_gis";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM image";
$result = $conn->query($sql);

$arr = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // $arr['id'] = $row['id'];
        $arr[] = $row['name'];
    }
// } else {
//     echo "0 results";
 }
    json_encode($arr);
$conn->close();
?>
