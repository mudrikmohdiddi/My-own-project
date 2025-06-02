<?php
header("Access-Control-Allow-Origin: *"); // Allow requests from any origin
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$phone = isset($_GET['phone']) ? $_GET['phone'] : '';

$output = shell_exec("ipconfig");
//echo "<pre>{$output}</pre>";
$part1 = explode("Wi-Fi", $output);
$part2 = explode("IPv4 Address. . . . . . . . . . . : ", $part1[1]);
$datasend = "";

$conn = new mysqli("localhost","root","");
$conn->query("create database if not exists phoneDB");
$conn->select_db("phoneDB");
$conn->query("create table if not exists phoneTABLE(
ID int auto_increment primary key,
phone varchar(200)
)");
if(!empty($part2[1])){
    $part3 = substr($part2[1],0,20);
    $part4 = str_replace("\n","m",$part3);
    $part5 = explode("m",$part4);
    $ip = $part5[0];
    $datasend = '<small>Wow 🎉 Device connected🎉<br><div style="background-color: blue; color:cyan;">'.$ip.' => '.letterIP($ip).'</div>';
    if(!empty($phone)){
        
        $r = $conn->query("select * from phoneTABLE");// order by ID desc
        if($r->num_rows == 0){
            $conn->query("insert into phoneTABLE(phone) values('$phone')");
        }
        else{
            $conn->query("UPDATE phoneTABLE SET phone = '$phone'");
        }
       
        include("connDevice.php");
        
    }
    else{
        
        $r = $conn->query("select * from phoneTABLE");// order by ID desc
        if($r->num_rows > 0){
            
        while($row = $r->fetch_assoc()){
           
            $datasend .= '<br>Last visitor 🎉'.$row["phone"];
        }
        
    }
        echo json_encode($datasend);
        
    }
}
else{
    $conn->query("DELETE FROM phoneTABLE");
    echo json_encode("<small>Mmm😢 No Device connected</small>");
}
   
function letterIP($ip){
    $letter = array("1"=>"m","2"=>"s","3"=>"i","4"=>"u","5"=>"d","6"=>"r","7"=>"k","8"=>"p","9"=>"f","0"=>"w","."=>",");
    $msim = "";
        for($m = 0; $m < strlen($ip); $m++){
            $msim .= $letter[$ip[$m]];

        }

    return $msim;

}

function upo($v){
    $exist = true;
    $conn = new mysqli("localhost","root","","phoneDB");
    $r = $conn->query("select * from phoneTABLE");
    if($r->num_rows > 0){
        while($rows = $r->fetch_assoc()){
            if($rows["phone"] == $v){
                $exist = false;
            }
        }
        
        
    }
    if(empty($v)){
        $exist = false;
    }
    return $exist;
}
?>