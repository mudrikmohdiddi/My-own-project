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
    echo json_encode("tp.png");
}
else{
    echo json_encode("profile/".$profile);
}

?>