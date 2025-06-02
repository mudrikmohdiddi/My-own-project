<?php

$folders = scanFolders("FileSendMC/CoderMC");
echo json_encode($folders);
function scanFolders($directory) {
    // Check if the directory exists
    if (!is_dir($directory)) {
        die("Directory does not exist.");
    }

    // Scan the directory
    $items = scandir($directory);
    $folders = [];

    foreach ($items as $item) {
        // Ignore current (.) and parent (..) directories
        if ($item === '.' || $item === '..') {
            continue;
        }

        // Build full path
        $path = $directory . DIRECTORY_SEPARATOR . $item;

        // Check if it's a directory
        if (is_dir($path)) {
            $folders[] = $item;
        }
    }

    return $folders;
}



?>

<?php
function copyFolder($src, $dst) {
    // Open the source folder
    $dir = opendir($src);

    // Make destination directory if it doesn't exist
    if (!is_dir($dst)) {
        mkdir($dst, 0755, true);
    }

    // Loop through the folder
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            $srcPath = $src . '/' . $file;
            $dstPath = $dst . '/' . $file;

            if (is_dir($srcPath)) {
                // Recursively copy subdirectory
                copyFolder($srcPath, $dstPath);
            } else {
                // Copy file
                copy($srcPath, $dstPath);
            }
        }
    }

    closedir($dir);
}


?>