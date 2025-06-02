<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["savemaneno"]) && !empty($_POST["savename"])) {
    $savemaneno = $_POST["savemaneno"];
    $savename = $_POST["savename"];

    file_put_contents("Laha/".$savename,$savemaneno,LOCK_EX);
    echo json_encode("$savename Text successfull save!");
    
}
?>