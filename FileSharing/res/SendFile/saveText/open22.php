<?php

$namesave = isset($_GET['namesave']) ? $_GET['namesave'] : '';

if(!empty($namesave) && file_exists("Laha/".$namesave)){
   echo json_encode(file_get_contents("Laha/".$namesave));
}
else{
    echo json_encode("No text");
}
?>