<?php
function findPartFiles($directory) {
    $partFiles = [];

    // Create a RecursiveIterator to go through subfolders
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($directory)
    );

    foreach ($iterator as $file) {
        if ($file->isFile()) {
            if (strtolower($file->getExtension()) === 'part') {
                $partFiles[] = $file->getFilename();
            }
        }
    }

    return $partFiles;
}

// Example usage
$folderPath = 'FileSendMC/CoderMC'; // Change this to your folder path
$files = findPartFiles($folderPath);
$part = "";
foreach ($files as $file) {
    $part .= $file."<br>";
}
$size = file_get_contents("persent.txt");
if(!empty($part)){
    echo json_encode($part."".$size."<br>");
}

?>