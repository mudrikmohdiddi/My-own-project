<?php
$group = isset($_GET['group']) ? $_GET['group'] : '';


if(!empty($group)){

$folderPath = "FileSendMC/CoderMC/".$group; 
deleteFolder($folderPath);


}





function deleteFolder($folderPath) {
    if (!is_dir($folderPath)) {
        return false; // Not a directory
    }

    $items = scandir($folderPath);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }

        $fullPath = $folderPath . DIRECTORY_SEPARATOR . $item;

        if (is_dir($fullPath)) {
            deleteFolder($fullPath); // Recursively delete subfolder
        } else {
            unlink($fullPath); // Delete file
        }
    }
    print json_encode($folderPath."\n  Deleted successfully");
    // Remove the now-empty folder
    return rmdir($folderPath);
}

?>