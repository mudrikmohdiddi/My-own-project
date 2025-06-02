<?php
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
       
        echo json_encode($row["name"]);
    }
}
}
?>