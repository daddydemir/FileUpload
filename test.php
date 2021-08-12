# not tested 
<?php

$title = $_POST["title"];
$content = $_POST["content"];
$path = "documents/"
$file = $path . basename($_FILES["file"]["name"]);
$uploadStatus = 1;

$fileType = strtolower(pathinfo($path , PATHINFO_EXTENSION));

if(isset($_POST["submit"])){
	
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    
    if($check !== false){
    	
        echo "File is an image - " . $check["mime"] . ".";
        $uploadStatus = 1;
    }else{
    	
        echo "File is not image .";
        $uploadStatus = 0;
    }
}

?>
