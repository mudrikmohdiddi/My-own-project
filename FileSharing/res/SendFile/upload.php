<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["group"])) {
    $group = $_POST["group"];
    $uploadDir = "FileSendMC/CoderMC/".$group."/"; // Change this to your desired folder
    grtFolders($uploadDir);
 
    $fileName = $_POST["fileName"];
    $filePath = $uploadDir . $fileName;

  if(file_exists($filePath)){
    echo "mmmm";
  }
  else{
    if(upload()){
        echo "File uploaded successfully to ".$filePath;
        
    } else {
        file_put_contents("persent.txt",percent(),LOCK_EX);
        echo percent();
        
    }
}
} else {
    echo "No file received";
}

function upload(){
    $group = $_POST["group"];
    $uploadDir = "FileSendMC/CoderMC/".$group."/";
    $fileName = $_POST["fileName"];
    $chunkIndex = $_POST["chunkIndex"];
    $totalChunks = $_POST["totalChunks"];

    $filePath = $uploadDir . $fileName;
    $tempPath = $filePath . ".part"; // Temporary file

    // Append chunk data
    $file = fopen($tempPath, "ab");
    fwrite($file, file_get_contents($_FILES["file"]["tmp_name"]));
    fclose($file);

    // If last chunk, rename the temporary file to final file
    if ($chunkIndex == $totalChunks - 1) {
        rename($tempPath, $filePath);
        return true;
    } else {
        return false;
    }
    }

function percent(){
    $chunkIndex = $_POST["chunkIndex"];
    $totalChunks = $_POST["totalChunks"];

    return "<h1>".round((($chunkIndex + 1) / $totalChunks) * 100) . "%<br>".$_POST["fileName"]." </h1>";
}

function grtFolders($folder){
   
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
