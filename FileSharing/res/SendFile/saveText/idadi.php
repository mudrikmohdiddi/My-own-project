<?php

function newnumber(){
    $files = scanFile("Laha");
    return count($files);

}
echo json_encode(newnumber());


function scanFile($directory) {
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

?>