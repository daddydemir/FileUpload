<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$db = "notes";
$mysqli = new mysqli($servername, $username, $password, $db);

if ($mysqli->connect_errno) {
    echo "DB connection error . ";
}

$id = $_GET['id'];

$sql = "delete from note where id=$id";


if($mysqli -> query($sql) === TRUE){
    echo "Not deleted succesfully .";
}else{
    echo "Error" . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();

header('Location: '."index.php");
?>