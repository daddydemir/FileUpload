<?php

$title = $_POST["baslik"];
$content = $_POST["icerik"];

$path0 = "documents/";
$path0 = $path0 . basename($_FILES["dosya"]["name"]);

if(move_uploaded_file($_FILES["dosya"]["tmp_name"] , $path0)){
    echo "Dosya : " . basename($_FILES["dosya"]["name"]) . " yüklendi . <br/>";
    echo $path0;
}else{
    echo "Dosya yüklenemedi . ";
}

$servername = "127.0.0.1"; 
$username = "root"; 
$password = ""; 
$db = "notes"; 


$mysqli = new mysqli($servername , $username , $password , $db);

if($mysqli -> connect_errno){
    echo "DB connection error . ";

}else{
    echo "DB connection success . ";
}
$var = mysqli_real_escape_String($mysqli , $_POST["icerik"]);

$sqlquery = "insert into note (title , content , path) values ('$title' , '$var' , '$path0')";

echo "<br>". $sqlquery;

if($mysqli -> query($sqlquery) === TRUE){
    echo "New note created successfully .";
}else{
    echo "Error" . $sqlquery . "<br>" . $mysqli->error;
}


$mysqli->close();

header('Location: '."index.php");


?>
