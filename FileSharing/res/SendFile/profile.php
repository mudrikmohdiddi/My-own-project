<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp','image/jpg'];
    $fileType = mime_content_type($_FILES['image']['tmp_name']);
    $originalName = basename($_FILES['image']['name']);
    $uploadDir = 'profile/';

    // Check if folder exists, if not create it
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    if(file_exists('profile/'.scanFile('profile')[0])){
        unlink( 'profile/'.scanFile('profile')[0]);
    }


    if (in_array($fileType, $allowedTypes)) {
        $uploadPath = $uploadDir . $originalName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            echo "Image uploaded successfully as $originalName";
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "Only image files (JPG, PNG, GIF, WEBP) are allowed.";
    }
}


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

<!-- HTML form for uploading -->
<form method="post" enctype="multipart/form-data">
    <label>Select image to change profile:</label><br><br>
    <input type="file" name="image" accept="image/*" required><br><br>
    <input type="submit" value="Upload change">
</form>

