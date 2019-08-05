<?php
$target_dir = "uploads/";
$name = date('Y-m-d')."_". basename($_FILES["file"]["name"]);
$target_file = $target_dir . $name;
// echo $_POST['lat'];
$uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
    // $check = getimagesize($_FILES["file"]["tmp_name"]);
    if(!empty($_FILES["file"]["name"])) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is empty.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
	}

$lat = $_POST['lat'];
$sep_lat = explode(',', $lat);
$final_lat = $sep_lat[0] + (($sep_lat[1] / 60) + ($sep_lat[2] / 3600));


$lon = $_POST['lon'];

$sep_lon = explode(',', $lon);
$final_lon = $sep_lon[0] + (($sep_lon[1] / 60) + ($sep_lon[2] / 3600));

// $name = $_POST['name'];
// fclose($myfile);
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

$sql = "INSERT INTO image (id , name, lat, lon)
VALUES ('','$name', '$final_lat', '$final_lon')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();    
// }
?>