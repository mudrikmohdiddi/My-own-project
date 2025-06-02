<?php
function scanFile($directory) {
    // Check if the directory exists
    if (!is_dir($directory)) {
        
        return "tp.png";
    }
    else{
        // Scan the directory
    $items = scandir($directory);
    $files = [];

    foreach ($items as $item) {
        // Ignore current (.) and parent (..) directories
        if ($item === '.' || $item === '..') {
            continue;
        }

        // Build full path
        $path = $directory . DIRECTORY_SEPARATOR . $item;

        // Check if it's a file
        if (is_file($path)) {
            $files[] = $item;
        }
    }

    return $files;

    }

    
}



$profile = scanFile('profile')[0];

if(empty($profile)){
    $profile = "tp.png";
}
else{
    $profile = "profile/".$profile;
}

///////////

$name = isset($_GET['name']) ? $_GET['name'] : '';

$conn = new mysqli("localhost","root","");
$conn->query("create database if not exists nameDB");
$conn->select_db("nameDB");
$conn->query("create table if not exists nameTABLE(
ID int auto_increment primary key,
name varchar(200)
)");

if(!empty($name)){
    
    $r = $conn->query("select * from nameTABLE");// order by ID desc
    if($r->num_rows == 0){
        $conn->query("insert into nameTABLE(name) values('$name')");
        echo json_encode($name);
    }
    else{
        $conn->query("UPDATE nameTABLE SET name = '$name'");
        echo json_encode($name);
    }
   
   
}
else{
$r = $conn->query("select * from nameTABLE");
if($r->num_rows > 0){
      
    while($row = $r->fetch_assoc()){
       
        echo json_encode($row["name"]."*".$profile);
    }
}
}
?>