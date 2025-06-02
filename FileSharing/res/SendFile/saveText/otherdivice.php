<?php
$name = isset($_GET['name']) ? $_GET['name'] : '';


grtFolder("Laha");

//$name = "Mudrik";
if(!empty($name)){
  
        if(!file_exists("Laha/".$name.".txt")){
        file_put_contents("Laha/".$name.".txt","",LOCK_EX);
       
        echo json_encode("{$name} successfull recorded!");
        
    }
    else{
        echo json_encode("{$name} alread recorded!");
    }
}
    
function grtFolder($folder){
   
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
        if(file_exists($folder)){
            return true;
        }
        else{
            return false;
        }
    }
    else{
        return true;
    }
}
?>