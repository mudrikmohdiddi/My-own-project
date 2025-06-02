<?php
$group = isset($_GET['group']) ? $_GET['group'] : '';
$arrange = isset($_GET['arrange']) ? $_GET['arrange'] : '';

grtFolder("FileSendMC/");
grtFolder("FileSendMC/Laha/");
grtFolder("FileSendMC/CoderMC/");

if(!empty($group)) {
    if(!is_dir("FileSendMC/CoderMC/".$group)){
        echo json_encode("del");
    }
    else{
        $files = scanFiles("FileSendMC/CoderMC/".$group);
        sort($files);
        if(!empty($arrange) && $arrange == "reverse"){
            $reverseFile = array_reverse($files);
            echo json_encode($reverseFile);
        }
        else{
            echo json_encode($files);
        }
}
   
}

function scanFiles($directory) {
   // Check if the directory exists
    if (!is_dir($directory)) {
        
        die("Directory does not exist.");
    }

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