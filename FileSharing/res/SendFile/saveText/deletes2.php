<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["deletename"])) {
    $deletename = $_POST["deletename"];
   
        $fileFolder = "Laha/".$deletename;

        if(deleteFile($fileFolder)) {
            echo $deletename."  Deleted successfully";
            }
            else{
                echo $deletename."have error not deleted";
            }
    
}

function deleteFile($path){
    if(file_exists($path)) {
        if(unlink( $path)){
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