<?php
// Delete from strored folder
$file = isset($_GET['file']) ? $_GET['file'] : '';
$group = isset($_GET['group']) ? $_GET['group'] : '';
// Delete file from folder
if (!empty($file) && !empty($group)) {
$fileFolder = "FileSendMC/CoderMC/".$group."/".$file;
if(deleteFile($fileFolder)) {
echo json_encode($file."  Deleted successfully");
}
else{
    echo json_encode($file."have error not deleted");
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